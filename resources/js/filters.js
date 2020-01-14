// moment js
import moment from 'moment'
import Vue from 'vue'
Vue.filter('timeformate', (arg) =>{
    return moment(arg).format("Do MMM YYYY");
})