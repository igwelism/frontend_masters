<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Subscription Date</th>
                    <th scope="col">Subscription Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in order">
                    <th scope="row">{{item.created_at}}</th>
                    <td>{{item.order_no}}</td>
                    <td>
                        {{item.payment_status}}
                        <select  @change="onChange($event, item.order_no)" class="form-control">
                            <option selected disabled>Update Status</option>
                            <option v-for="(status, index) in options" v-bind:value="index">{{status}}</option>
                        </select>
                    </td>
                    <td>GBP {{item.total}}</td>
                    <td>{{item.start_date}}</td>
                    <td>{{item.end_date}}</td>
                    <td>
                        <button type="button" v-on:click="setActiveOrderItems(item.order_no)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">View Details</button>
                    </td>
                </tr>
                <tr v-if="order.length <= 0">
                    <td colspan="7" style="text-align: center">No Subscription</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Service</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in activeOrderItem">
                                        <td>{{item.name}}</td>
                                        <td>{{item.price}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['order'],
        data: function () {
            return {
                orderItems: {},
                activeOrderItem: {},
                selected:'PaymentCompleted',
                options: ["PaymentCompleted"]
            }
        },
        mounted() {
            for (const items of this.order) {
                this.orderItems[items.order_no] = items.order_items
            }
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
            })
        },
        methods: {
            setActiveOrderItems(orderNumber) {
                this.activeOrderItem = this.orderItems[orderNumber]
            },
            onChange(event, orderNo) {
                let selectedStatus = this.options[event.target.value]
                axios.put('api/order/' + orderNo, {
                        "status": selectedStatus,
                }).then(response => {
                    if (response.status === 200) {
                        this.order = response.data
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>
