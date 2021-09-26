<template>
    <div>
        <div v-if="showMessage">
            <div v-if="status === 'success'"  class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ success }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div v-else-if="status === 'error'"  class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error: </strong> {{ error }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="mt-4 center mb-4" style="width: 50rem;">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="id">Employee Id</label>
                        <input type="number" v-model="id" class="form-control" id="id">
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="name">FullName</label>
                        <input type="text" v-model="name" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="email">Email</label>
                        <input type="email" v-model="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 col-auto">
                        <label for="password">Password</label>
                        <input type="password" v-model="password" class="form-control" id="password">
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" v-model="confirmPassword" class="form-control" id="confirmpassword">
                    </div>
                </div>
            </form>
            <button @click="update()" type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                id:'',
                name: '',
                email: '',
                success: '',
                error: '',
                password: '',
                confirmPassword: '',
                showMessage: false,
                status:'',
            }
        },
        methods: {
            update() {
                const data = new FormData();
                data.append('id', 'EMP' + this.id);
                data.append('name', this.name);
                data.append('email', this.email);
                data.append('password', this.password);
                data.append('password_confirmation', this.confirmPassword);

                axios.post("/api/admin_create", data)
                .then(response => {
                    if(response.status === 200) {
                        this.success = "Employee successfully saved"
                        this.status = "success"
                        this.showMessage = true
                        setTimeout(function(){
                            window.location.href = '/admin_registration';
                            }, 5000);
                    }
                })
                .catch(error => {
                    console.log(error.response)
                    this.error = "Employee wasn't successfully saved"
                    this.showMessage = true
                    this.status = "error"
                })
            },
        },
    }
</script>
