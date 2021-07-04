<template>
    <div>
        <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="rice-tab" data-toggle="tab" href="#rice" role="tab" aria-controls="rice" aria-selected="true">Rice/Grains</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="brunch-tab" data-toggle="tab" href="#brunch" role="tab" aria-controls="brunch" aria-selected="false">Brunch</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="beans-tab" data-toggle="tab" href="#beans" role="tab" aria-controls="beans" aria-selected="false">Beans</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#swallow" role="tab" aria-controls="swallow" aria-selected="false">Swallow</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="rice" role="tabpanel" aria-labelledby="rice-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in grains">
                        <input type="checkbox" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="checkedFoods" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/food/'+item.img" /><br/><br/>
                            {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="brunch" role="tabpanel" aria-labelledby="brunch-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in brunches">
                        <input type="checkbox" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="checkedFoods" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/food/'+item.img" /><br/><br/>
                            {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="beans" role="tabpanel" aria-labelledby="contact-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in beans">
                        <input type="checkbox" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="checkedFoods" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/food/'+item.img" /><br/><br/>
                            {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="swallow" role="tabpanel" aria-labelledby="contact-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in swallows">
                        <input type="checkbox" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="checkedFoods" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/food/'+item.img" /><br/><br/>
                        {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
        <div class="card">
            <div class="content-flow">
                <div class="faq-layout">
                    <div class="col">
                        <strong style="font-size: xx-large">The Food Plans: <br>
                            Don't Stress.<br>
                            Just Eat.
                        </strong>
                        <p style="margin-top: 50px">Enjoy all the deliciousness of healthy food, right on time, with none of the stress.</p>
                    </div>
                    <div class="col">
                        <SubscribeComponent :items="checkedFoods" :type="'Food'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SubscribeComponent from "./SubscribeComponent";
    export default {
        props:['food', 'cartcontents'],
        components: {
          SubscribeComponent
        },
        data: function () {
            return {
                grains: [],
                brunches: [],
                beans: [],
                swallows: [],
                checkedFoods: []
            }
        },
        methods: {
          truncateTextLength(text) {
              return text.length > 34 ? text.substring(0, 30) + '...' : text
          }
        },
        mounted() {
            for (const foodItem of this.food) {
                if(foodItem.category === 'rice') {
                    this.grains.push(foodItem);
                    if(this.cartcontents.includes(foodItem.sku)) {
                        this.checkedFoods.push(foodItem)
                    }
                } else if (foodItem.category === 'brunch') {
                    this.brunches.push(foodItem);
                    if(this.cartcontents.includes(foodItem.sku)) {
                        this.checkedFoods.push(foodItem)
                    }
                } else if (foodItem.category === 'beans') {
                    this.beans.push(foodItem)
                    if(this.cartcontents.includes(foodItem.sku)) {
                        this.checkedFoods.push(foodItem)
                    }
                } else if (foodItem.category === 'swallow') {
                    this.swallows.push(foodItem)
                    if(this.cartcontents.includes(foodItem.sku)) {
                        this.checkedFoods.push(foodItem)
                    }
                }
            }
        }
    }
</script>

<style scoped>
ul {
    list-style-type: none;
}

li {
    display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
    display: none;
}

label {
    border: 1px solid #fff;
    padding: 10px;
    display: block;
    position: relative;
    margin: 10px;
    cursor: pointer;
}

label:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
}

label img {
    height: 100px;
    width: 100px;
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
}

:checked + label {
    border-color: #ddd;
}

:checked + label:before {
    content: "✓";
    background-color: grey;
    transform: scale(1);
}

:checked + label img {
    transform: scale(0.9);
    /* box-shadow: 0 0 5px #333; */
    z-index: -1;
}
</style>
