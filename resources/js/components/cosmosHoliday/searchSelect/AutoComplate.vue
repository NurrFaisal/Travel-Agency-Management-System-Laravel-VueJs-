<template>
    <div class="autocomplate" >
        <div class="input" @click="toggleVisible" ><span class="spanText" v-text="selectedItem ? selectedItem[filterby]+' '+ selectedItem['last_name'] : ''"></span></div>
        <div class="placeholder" v-if="selectedItem == null" >{{ title || ' Select One...'}}</div>
        <div class="popover1" v-show="visible">
            <input v-model="query"
                   type="text"
                   @keyup="onchangefunction"
                   ref="inputbox"
                   @keydown.up="up"
                   @keydown.down="down"
                   @keydown.enter.prevent="selectedItems"
                   placeholder="Start Typing"/>
            <div class="options" ref="optionList">
                <ul>
                    <li
                            v-for="(match, index) in matches"
                            :key="match[filterby]"
                            @click="itemClick(index)"
                            v-text="match['first_name'] + ' ' + match['last_name']"
                            :class="{'selected' : (selected == index)}"

                    ></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['items', 'filterby', 'title', 'shouldReset'],
        name: "AutoComplate",
        data(){
            return{
                itemHeight:39,
                selectedItem: null,
                selected:0,
                visible: false,
                query:'',
            }
        },
        computed:{
            matches(){

                if(this.query == ''){
                    return []
                }
                if(this.items !=  ''){
                    return this.items.filter((item) => item[this.filterby].toLowerCase().includes(this.query.toLowerCase()))
                }



            }
        },
        methods:{
            onchangefunction(){
                this.$emit('change', this.query)
            },
            toggleVisible(){
                this.visible = !this.visible

                setTimeout(()=>{
                    this.$refs.inputbox.focus()
                }, 50)

            },
            itemClick(index){
                this.selected = index
                this.selectedItems()
            },
            selectedItems(){
                this.selectedItem = this.matches[this.selected]
                this.visible = false
                if(this.shouldReset){
                    this.query = ''
                    this.selected = 0
                }
                this.$emit('Selected', JSON.parse(JSON.stringify(this.selectedItem)))
            },
            up(){
                if(this.selected == 0){
                    return;
                }
                this.selected -=1
                this.scrollToItem
            },
            down(){
                if(this.selected > this.matches.length -1){
                    return;
                }
                this.selected += 1
                this.scrollToItem
            },
            scrollToItem(){
                this.$refs.optionList.scrollTop = this.selected * this.itemHeight
            },

        }
    }
</script>

<style scoped>
    .autocomplate{
        width:100%;
        /*position: relative;*/
    }
    .input{
        width: 489px;
        height: 31px;
        border-radius: 3px;
        border: 2px solid lightgray;
        cursor: text;
        background: #dff0d8;
        font-size: 16px;

    }
    .popover1{
        min-height: 50px;
        border: 2px solid lightgray;
        width: 489px;
        margin-top: 4px;
        /*position: absolute;*/
        border-radius: 3px;
        text-align: center;
        background: #ddd;
    }
    .popover1 input{
        width: 91%;
        border: 2px solid lightgray;
        margin-top: 5px;
        background: #dff0d8;
    }
    .options{
        max-height: 150px;
        overflow-y: scroll;
        margin-right: 20px;
        margin-bottom: 20px;
    }
    .options ul{
        list-style-type: none;
        text-align: left;
        padding-left: 0;
    }
    .options ul li{
        border-bottom: 1px solid lightgray;
        padding: 10px;
        cursor: pointer;
        background: aliceblue;
        margin-left: -3px;
    }
    .selected{
        background-color: #6fb3e0!important;
        color: white;

    }
    .placeholder {
        position: absolute;
        top: 6px;
        left: 10px;
        font-size: 14px;
        font-weight: 700;
        pointer-events: none;
    }
    .spanText{
        top: 6px;
        left: 10px;
        font-size: 14px;
        font-weight: 700;
        pointer-events: none;
        margin-left: 15px;
    }
    .options ul li:hover{
        background: #e7e7e7;
    }


</style>