export default {
    namespace:true,
    state:{
        visa_category: ' '
    },
    getters:{
        get_visa_category(state){
            return state.visa_category
        }
    },
    actions:{
        allVisaCategory(payload){
            axios.get('/api/get-all-visa-category')
                .then((response) =>{
                    payload.commit('visaCategory', response.data.visa_category)
                })
        }
    },
    mutations:{
        visaCategory(state, data){
            return state.visa_category = data
        }
    }
}