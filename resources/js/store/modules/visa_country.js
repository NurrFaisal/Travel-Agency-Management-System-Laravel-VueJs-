export default {
    namespace:true,
    state:{
        visa_country: ' '
    },
    getters:{
        get_visa_country(state){
            return state.visa_country
        }
    },
    actions:{
        allVisaCountry(payload){
            axios.get('/api/get-all-visa-country')
                .then((response) =>{
                    payload.commit('visaCountry', response.data.visa_country)
                })
        }
    },
    mutations:{
        visaCountry(state, data){
            return state.visa_country = data
        }
    }
}