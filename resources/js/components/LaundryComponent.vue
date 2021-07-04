<template>
    <div>
        <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="fold-tab" data-toggle="tab" href="#fold" role="tab" aria-controls="fold" aria-selected="true">Wash & Fold</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="iron-tab" data-toggle="tab" href="#iron" role="tab" aria-controls="iron" aria-selected="false">Wash & Iron</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="fold" role="tabpanel" aria-labelledby="fold-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in fold">
                        <input type="radio" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="selectedBasket" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/laundry/'+item.img" /><br/><br/>
                            {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="iron" role="tabpanel" aria-labelledby="iron-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in iron">
                        <input type="radio" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="selectedBasket" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/laundry/'+item.img" /><br/><br/>
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
                        <strong style="font-size: xx-large">The Laundry Plans: <br>
                            We handle the laundry.<br>
                            You enjoy the leisure.
                        </strong>
                        <p style="margin-top: 50px">Enjoy out laundry services, right on time, with none of the stress.
                        </p>
                    </div>
                    <div class="col">
                        <SubscribeComponent :items=" (selectedBasket) ? [selectedBasket] : []" :type="'Laundry'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SubscribeComponent from "./SubscribeComponent";
    export default {
        props:['laundry', 'cartcontents'],
        components: {
          SubscribeComponent
        },
        data: function () {
            return {
                fold: [],
                iron: [],
                selectedBasket: ''
            }
        },
        methods: {
          truncateTextLength(text) {
              return text.length > 34 ? text.substring(0, 30) + '...' : text
          }
        },
        mounted() {
            for (const laundryItem of this.laundry) {
                if(laundryItem.category === 'fold') {
                    this.fold.push(laundryItem);
                    if(this.cartcontents.includes(laundryItem.sku)) {
                        this.selectedBasket = laundryItem
                    }
                } else if (laundryItem.category === 'iron') {
                    this.iron.push(laundryItem);
                    if (this.cartcontents.includes(laundryItem.sku)) {
                        this.selectedBasket = laundryItem
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
