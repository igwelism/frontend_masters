<template>
    <div>
        <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="light-tab" data-toggle="tab" href="#light" role="tab" aria-controls="light" aria-selected="true">Light Cleaning</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="deep-tab" data-toggle="tab" href="#deep" role="tab" aria-controls="deep" aria-selected="false">Deep Cleaning</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="light" role="tabpanel" aria-labelledby="light-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in light">
                        <input type="radio" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="selectedCategory" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/cleaning/'+item.img" /><br/><br/>
                            {{ truncateTextLength(item.name) }}</label>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="deep" role="tabpanel" aria-labelledby="deep-tab">
                <ul>
                    <li style="width:200px" v-for="(item, index) in deep">
                        <input type="radio" :id="'myCheckboxindex' + (item.id)" :value="item" v-model="selectedCategory" />
                        <label :for="'myCheckboxindex' + (item.id)"><img :src="'/images/cleaning/'+item.img" /><br/><br/>
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
                        <strong style="font-size: xx-large">The Cleaning Plans: <br>
                            Sparkling space.<br>
                            Zero stress.
                        </strong>
                        <p style="margin-top: 50px">You deserve a home where you just sit back and relax.<br>
                            No cleaning. No stress.
                        </p>
                    </div>
                    <div class="col">
                        <SubscribeComponent :items=" (selectedCategory) ? [selectedCategory] : []" :type="'Cleaning'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SubscribeComponent from "./SubscribeComponent";
    export default {
        props:['cleaning', 'cartcontents'],
        components: {
          SubscribeComponent
        },
        data: function () {
            return {
                light: [],
                deep: [],
                selectedCategory: ''
            }
        },
        methods: {
          truncateTextLength(text) {
              return text.length > 34 ? text.substring(0, 30) + '...' : text
          }
        },
        mounted() {
            for (const cleaningItem of this.cleaning) {
                if(cleaningItem.category === 'light') {
                    this.light.push(cleaningItem);
                    if(this.cartcontents.includes(cleaningItem.sku)) {
                        this.selectedCategory = cleaningItem
                    }
                } else if (cleaningItem.category === 'deep') {
                    this.deep.push(cleaningItem);
                    if (this.cartcontents.includes(cleaningItem.sku)) {
                        this.selectedCategory = cleaningItem
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
