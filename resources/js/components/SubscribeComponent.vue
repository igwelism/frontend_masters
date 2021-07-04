<template>
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div v-if="displayErrorMessage" class="alert alert-danger" role="alert">
                            You have not selected an Service
                            <button v-on:click="resetErrorMessage()"type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="true">Daily</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">Weekly</a>
                            </li>
                            <li v-if="type !== 'Food'" class="nav-item" role="presentation">
                                <a class="nav-link" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false">Monthly</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab" style="margin-top: 10px;">
                                <div class="content-flow">
                                    <div class="calculate-layout">
                                        <div class="col">
                                            <p>{{ displayText }}</p>
                                            <input style="text-align: center" class="form-control input-number" type="text" :value="displayItem" readonly>
                                            <h5 style="margin-top: 20px">
                                                <span>Price: </span>
                                                <span style="font-weight: bold">GBP {{ calculateDaily() }}</span>
                                                Monthly
                                            </h5>
                                        </div>
                                        <div class="col subscript-daily">
                                            <button  v-on:click="subscribeToService('Daily ' + type + ' Subscription', dailyTotal)" type="button" class="btn btn-primary btn-lg btn-block">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="weekly" role="tabpanel" aria-labelledby="weekly-tab" style="margin-top: 10px;">
                                <div class="content-flow">
                                    <div class="calculate-layout">
                                        <div class="col">
                                            <p>{{ displayText }}</p>
                                            <input style="text-align: center" class="form-control input-number" type="text" :value="displayItem" readonly>
                                            <div v-if="type === 'Food'">
                                                <hr />
                                                <p>Should all your food delivered be once or twice in a week?</p>
                                                <div class="input-group">
                                                     <span class="input-group-btn">
                                                         <button v-on:click="decrement()" type="button" class="btn btn-danger btn-number">
                                                             <font-awesome-icon icon="minus-square" />
                                                        </button>
                                                    </span>
                                                    <input type="text" style="text-align: center" class="form-control input-number" :value="counter" min="1" max="2" readonly>
                                                    <span class="input-group-btn">
                                                        <button v-on:click="increment()" type="button" class="btn btn-success btn-number">
                                                            <font-awesome-icon icon="plus-square" />
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <h5 style="margin-top: 20px">
                                                <span>Price: </span>
                                                <span style="font-weight: bold">GBP {{ calculateWeekly(counter) }}</span>
                                                Monthly
                                            </h5>
                                        </div>
                                        <div :class="type === 'Food' ? 'col subscript-weekly' : 'col subscript-daily'">
                                            <button v-on:click="subscribeToService('Weekly ' + type + ' Subscription', weeklyTotal)" type="button" class="btn btn-primary btn-lg btn-block">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  v-if="type !== 'Food'" class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab" style="margin-top: 10px;">
                                <div class="content-flow">
                                    <div class="calculate-layout">
                                        <div class="col">
                                            <p>{{ displayText }}</p>
                                            <input style="text-align: center" class="form-control input-number" type="text" :value="displayItem" readonly>
                                            <h5 style="margin-top: 20px">
                                                <span>Price: </span>
                                                <span style="font-weight: bold">GBP {{ calculateMonthly() }}</span>
                                                Monthly
                                            </h5>
                                        </div>
                                        <div class="col subscript-daily">
                                            <button v-on:click="subscribeToService('Monthly ' + type + ' Subscription', monthlyTotal)" type="button" class="btn btn-primary btn-lg btn-block">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['items', 'type'],
        methods: {
            calculateDaily() {
                if(this.type === "Food") {
                    this.dailyTotal = this.items.length * 60
                    return this.dailyTotal
                } else if(this.type === "Laundry" && this.items.length !== 0) {
                    if(this.items[0].category === 'fold') {
                        this.dailyTotal = this.items[0].quantity * 1
                        return this.dailyTotal
                    }
                    this.dailyTotal = this.items[0].quantity * 1.5
                    return this.dailyTotal
                } else if(this.type === "Cleaning" && this.items.length !== 0) {
                    if(this.items[0].category === 'light') {
                        this.dailyTotal = this.items[0].quantity * 100
                        return this.dailyTotal
                    }
                    this.dailyTotal = this.items[0].quantity * 200
                    return this.dailyTotal
                } else {
                    return this.dailyTotal = 0
                }
            },
            calculateWeekly(noOfWeeks) {
                if(this.type === "Food") {
                    if(noOfWeeks > 1) {
                        this.weeklyTotal = this.items.length * 180;
                        return this.weeklyTotal
                    }
                    this.weeklyTotal = this.items.length * 60;
                    return this.weeklyTotal
                } else if (this.type === "Laundry" && this.items.length !== 0) {
                    if(this.items[0].category === 'fold') {
                        this.weeklyTotal = this.items[0].quantity * 0.5
                        return this.weeklyTotal
                    }
                    this.weeklyTotal = this.items[0].quantity * 1
                    return this.weeklyTotal
                } else if(this.type === "Cleaning" && this.items.length !== 0) {
                    if(this.items[0].category === 'light') {
                        this.weeklyTotal = this.items[0].quantity * 80
                        return this.weeklyTotal
                    }
                    this.weeklyTotal = this.items[0].quantity * 180
                    return this.weeklyTotal
                } else {
                    return this.dailyTotal = 0
                }
            },
            calculateMonthly() {
                if (this.items.length !== 0) {
                    if(this.type === "Cleaning") {
                        if (this.items[0].category === 'light') {
                            this.monthlyTotal = this.items[0].quantity * 60
                            return this.monthlyTotal
                        }
                        this.monthlyTotal = this.items[0].quantity * 160
                        return this.monthlyTotal
                    }
                    if (this.items[0].category === 'fold') {
                        this.monthlyTotal = this.items[0].quantity * 0.25
                        return this.monthlyTotal
                    }
                    this.monthlyTotal = this.items[0].quantity * 0.5
                    return this.monthlyTotal
                }
                return this.monthlyTotal = 0
            },
            decrement() {
                if(this.counter > 1) {
                    this.counter -= 1
                }
            },
            increment() {
                if(this.counter <= 1) {
                    this.counter += 1
                }
            },
            subscribeToService(subscribedItem, price) {
                if(price > 0) {
                    axios.post('api/cart', {
                        service: subscribedItem,
                        price: price,
                        items: this.items,
                    })
                    .then( response => {
                        if (response.status === 200) {
                            window.location.href = '/cart';
                        }
                    })
                    .catch( error => {
                        console.log(error)
                    })
                } else {
                    this.displayErrorMessage = true;
                }
            },
            resetErrorMessage() {
                this.displayErrorMessage = false;
            }
        },
        data: function() {
            return {
                counter: 1,
                dailyTotal: 0,
                weeklyTotal: 0,
                monthlyTotal: 0,
                displayText: 'Number of items selected:',
                displayItem: '',
                displayErrorMessage: false,
            }
        },
        mounted() {
            if (this.type === 'Food') {
                this.displayItem = this.items.length
            } else {
                this.displayText = 'Item Selected:'
                this.displayItem = this.items[0].name
            }
        },
        watch: {
            items: function () {
                if (this.type === 'Food') {
                    this.displayItem = this.items.length
                } else {
                    this.displayItem = this.items[0].name
                }
            }
        }
    }
</script>
<style scoped>
.calculate-layout {
    display: flex;
    flex-wrap: wrap;
}

.calculate-layout > *:nth-child(1) {
    flex: 1 1 60%;
    /*min-width: 15ch;*/
}

.calculate-layout > *:nth-child(2) {
    flex: 1 1 40%;
    /*min-width: 30ch;*/
}

.subscript-daily {
    margin-top: 35px;
}

.subscript-weekly {
    margin-top: 85px;
}
</style>
