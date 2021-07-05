<template>
    <div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">City</th>
                    <th scope="col">PostCode</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in customers">
                    <th scope="row">{{item.user_additional_information.title}}</th>
                    <td>{{item.name}}</td>
                    <td>{{item.email}}</td>
                    <td>{{item.user_additional_information.mobile}}</td>
                    <td>{{item.address.city}}</td>
                    <td>{{item.address.post_code}}</td>
                </tr>
                <tr v-if="customers.length <= 0">
                    <td colspan="4" style="text-align: center">No Customer</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props:['customers'],
        data: function () {
            return {
                name: '',
                email: '',
            }
        },

    }
</script>
