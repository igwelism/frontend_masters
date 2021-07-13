<template>
    <div>
        <div v-if="showMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success: </strong> {{ success }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="mt-4 center mb-4" style="width: 50rem;">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-2 col-auto">
                        <label for="sku">SKU</label>
                        <input type="text" v-model="sku" class="form-control" id="sku">
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="name">Name</label>
                        <input type="text" v-model="name" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-4 col-auto">
                        <label for="img">Upload Image</label>
                        <input type="file" @change="selectFile" class="form-control" id="img">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3 col-auto">
                        <label for="status">Status</label>
                        <select v-model="status" id="status" class="form-control">
                            <option disabled value="">Choose</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5 col-auto">
                        <label for="category">Category</label>
                        <select v-model="category" @change="onChange(category)" id="category" class="form-control">
                            <option disabled value="">Choose</option>
                            <option v-for="(category, index) in allCategories">{{category}}</option>
                        </select>
                    </div>
                    <div v-if="active" class="form-group col-md-2 col-auto">
                        <label for="quantity">Quantity</label>
                        <input type="number" v-model="quantity" class="form-control" id="quantity">
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
                sku:'',
                name: '',
                status: '',
                category: '',
                quantity: '',
                image: null,
                allCategories: {},
                active: true,
                foodCategories: {},
                success: '',
                showMessage: false
            }
        },
        methods: {
            update() {
                const data = new FormData();
                data.append('image', this.image);
                data.append('sku', this.sku);
                data.append('name', this.name);
                data.append('status', this.status);
                data.append('category', this.category);
                if(this.quantity) data.append('quantity', this.quantity);

                axios.post("/api/upload", data)
                .then(response => {
                    if(response.status === 200) {
                        this.success = "Item successfully saved"
                        this.showMessage = true
                        setTimeout(function(){
                            window.location.href = '/uploads';
                            }, 5000);
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            },
            selectFile(event) {
                // `files` is always an array because the file input may be in multiple mode
                this.image = event.target.files[0];
            },

            onChange(item) {
                this.active = !Object.values(this.foodCategories).includes(item);
            }

        },
        mounted() {
            axios.get("/api/categories")
                .then(response => {
                    if(response.status === 200) {
                        this.allCategories = response.data.categories
                        this.foodCategories = (response.data.food)
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
</script>
