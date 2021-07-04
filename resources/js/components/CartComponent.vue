<template>
    <div>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">Service Name</th>
                <th scope="col">Service Content</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in cartItem">
                <th scope="row">
                    <button v-on:click="removeItem(index, item.id)" type="button" class="btn btn-danger">
                        <font-awesome-icon icon="trash" />
                    </button>
                </th>
                <td>{{item.name}}</td>
                <td v-html="itemContent[item.id]"></td>
                <td>GBP {{item.price}}</td>
            </tr>
            <tr v-if="cartItem.length <= 0">
                <td colspan="4" style="text-align: center">Cart Contains No Value</td>
            </tr>
            </tbody>
        </table>
        <div>
            <div class="content-flow">
                <div class="cart-layout">
                    <div class="col">
                    </div>
                    <div class="col">
                        <h4><strong>Cart Totals</strong></h4>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td style="background-color: #f7f7f7">Subtotal</td>
                                <td>GBP {{calculateTotal()}}</td>
                            </tr>
                            <tr>
                                <td style="background-color: #f7f7f7">Total (12.5% VAT)</td>
                                <td>GBP {{Math.ceil(calculateTotal() + (calculateTotal() * 0.125)) }}</td>
                            </tr>
                        </table>
                        <button v-on:click="checkout()" type="button" class="btn btn-secondary btn-lg">Complete Subscription</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props:['cart', 'cartitemcontent'],
        data: function () {
            return {
                cartItem: [],
                itemContent: {},
            }
        },
        mounted() {
            this.cartItem = this.cart.cart_items
            let content =''
            for (const item of this.cartItem) {
                for (const value of this.cartitemcontent) {
                    if(value.cart_item_id === item.id) {
                        content += value.name + " |" + "<br>"
                        this.itemContent[value.cart_item_id] = content
                    }
                }
                this.total += item.price
                content = ''
            }

        },
        methods: {
            removeItem(index, cartId) {
                axios.delete('api/cartItem/' + cartId)
                .then(response => {
                    if (response.status === 200) {
                        for (const item of this.cartItem) {
                            if (item.id === cartId) {
                                this.cartItem.splice(index, 1)
                            }
                        }
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            },
            calculateTotal() {
                let total = 0
                for (const item of this.cartItem) {
                    total += item.price
                }
                return total;
            },
            checkout() {
                axios.post('api/order', {})
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = '/postcheckout/' + response.data.order_no;
                        //console.log(response.data.order_no);
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
    }
</script>
<style scoped>
.cart-layout {
    display: flex;
    flex-wrap: wrap;
}

.cart-layout > *:nth-child(2) {
    flex: 1 1 40%;
    min-width: 15ch;
}

.cart-layout > *:nth-child(1) {
    flex: 1 1 60%;
    min-width: 30ch;
}
</style>
