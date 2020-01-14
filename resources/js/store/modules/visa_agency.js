export default {
    namespace:true,
    state:{
        visa_agency: ' '
    },
    getters:{
        get_visa_agency(state){
            return state.visa_agency
        }
    },
    actions:{
        allVisaAgency(payload){
            axios.get('/api/get-all-visa-agency')
                .then((response) =>{
                    payload.commit('visaAgency', response.data.visa_agency)
                })
        }
    },
    mutations:{
        visaAgency(state, data){
            return state.visa_agency = data
        }
    }
}