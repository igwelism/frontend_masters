<template>
    <div>
        <div v-if="active" class="center mt-4 mb-4" style="width: 50rem; font-weight: bolder">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="starthouse">House Number</label>
                        <input type="text" v-model="house_no" id="starthouse" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-8 col-auto">
                        <label for="startstreet">Street Name</label>
                        <input type="text" v-model=street_name class="form-control" id="startstreet" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 col-auto">
                        <label for="startcity">City</label>
                        <input type="email" v-model="city" class="form-control" id="startcity" disabled>
                    </div>
                    <div class="form-group col-md-3 col-auto">
                        <label for="startpostcode">Postcode</label>
                        <input type="text" v-model="postcode" class="form-control" id="startpostcode" disabled>
                    </div>
                    <div class="form-group col-md-3 col-auto">
                        <label for="startcountry">Country</label>
                        <input type="text" value="United Kingdom" class="form-control" id="startcountry" disabled>
                    </div>
                </div>
            </form>
            <button v-on:click="toggle()" type="button" class="btn btn-secondary">Edit</button>
        </div>
        <div v-if="!active" class="mt-4 center mb-4" style="width: 50rem;">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="house">House Number</label>
                        <input type="text" v-model="house_no" id="house" class="form-control">
                    </div>
                    <div class="form-group col-md-8 col-auto">
                        <label for="street">Street Name</label>
                        <input type="text" v-model=street_name class="form-control" id="street">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 col-auto">
                        <label for="city">City</label>
                        <input type="email" v-model="city" class="form-control" id="city">
                    </div>
                    <div class="form-group col-md-3 col-auto">
                        <label for="postcode">Postcode</label>
                        <input type="text" v-model="postcode" class="form-control" id="postcode">
                    </div>
                    <div class="form-group col-md-3 col-auto">
                        <label for="country">Country</label>
                        <input type="text" value="United Kingdom" class="form-control" id="country" disabled>
                    </div>
                </div>
            </form>
            <button v-on:click="cancel()" type="submit" class="btn btn-danger">Cancel</button>
            <button v-on:click="update()" type="submit" class="btn btn-primary" :disabled="!house_no.length || !street_name.length || !city.length || !postcode.length">Save</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data: function () {
            return {
                id:'',
                house_no: '',
                street_name: '',
                city:'',
                postcode: '',
                active: true,
            }
        },
        mounted() {
            let address = this.user.address
            this.id = this.user.id
            if( address !== null) {
                this.house_no = address.house_no
                this.street_name = address.street_name
                this.city = address.city
                this.postcode = address.post_code
            }
        },
        methods: {
            toggle() {
                this.active = false
            },
            cancel() {
                this.active = true
            },
            update() {
                axios.post('api/address/' + this.id, {
                    "house_no": this.house_no,
                    "street_name": this.street_name,
                    "city": this.city,
                    "post_code": this.postcode
                })
                .then(response => {
                    if (response.status === 200) {
                        let user = user.data
                        this.house_no = user.address.house_no
                        this.street_name = user.address.street_name
                        this.city = user.address.city
                        this.postcode = user.address.postcode
                    }
                })
                .catch(error => {
                    console.log(error)
                })
                this.active = true;
            }
        }
    }
</script>
