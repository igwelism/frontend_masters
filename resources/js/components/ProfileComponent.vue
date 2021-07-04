<template>
    <div>
        <div v-if="active" class="center mt-4 mb-4" style="width: 50rem; font-weight: bolder">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="starttitle">Title</label>
                        <select v-model="title" id="starttitle" class="form-control" disabled>
                            <option disabled value=""></option>
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                            <option>Ms</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8 col-auto">
                        <label for="startinputname">FullName</label>
                        <input type="text" v-model=name class="form-control" id="startinputname" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-auto">
                        <label for="startemail">Email</label>
                        <input type="email" v-model="email" class="form-control" id="startemail" disabled>
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="startmobile">Mobile</label>
                        <input type="text" v-model="mobile" class="form-control" id="startmobile" disabled>
                    </div>
                </div>
            </form>
            <button v-on:click="toggle()" type="button" class="btn btn-secondary">Edit</button>
        </div>
        <div v-if="!active" class="mt-4 center mb-4" style="width: 50rem;">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="title">Title</label>
                        <select v-model="title" id="title" class="form-control">
                            <option disabled value="">Choose</option>
                            <option>Mr</option>
                            <option>Mrs</option>
                            <option>Miss</option>
                            <option>Ms</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8 col-auto">
                        <label for="inputname">FullName</label>
                        <input type="text" v-model=name class="form-control" id="inputname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-auto">
                        <label for="email">Email</label>
                        <input type="email" v-model="email" class="form-control" id="email" disabled>
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="mobile">Mobile</label>
                        <input type="text" v-model="mobile" class="form-control" id="mobile">
                    </div>
                </div>
            </form>
            <button v-on:click="cancel()" type="submit" class="btn btn-danger">Cancel</button>
            <button v-on:click="update()" type="submit" class="btn btn-primary" :disabled="!title.length || !mobile.length">Save</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data: function () {
            return {
                id:'',
                name: '',
                email: '',
                title: '',
                mobile: '',
                active: true,
            }
        },
        mounted() {
            let additionalInformation = this.user.user_additional_information
            this.name = this.user.name
            this.email = this.user.email
            this.id = this.user.id
            if( additionalInformation !== null) {
                this.title = additionalInformation.title
                this.mobile = additionalInformation.mobile
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
                axios.post('api/profile/' + this.id, {
                    "title": this.title,
                    "mobile": this.mobile,
                })
                .then(response => {
                    if (response.status === 200) {
                        let user = user.data
                        this.name = user.name
                        this.email = user.email
                        this.title = user.user_additional_information.title
                        this.mobile = user.user_additional_information.mobile
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
