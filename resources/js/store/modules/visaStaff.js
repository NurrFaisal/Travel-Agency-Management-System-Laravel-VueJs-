export default {
    namespace:true,
    state:{
        visaStaff: ' '
    },
    getters:{
        get_visa_staff(state){
            return state.visaStaff
        }
    },
    actions:{
        allVisaStaff(payload){
            axios.get('/api/get-all-staff')
                .then((response) =>{
                    payload.commit('visaStaff', response.data.all_visa_staff)
                })
        }
    },
    mutations:{
        visaStaff(state, data){
            return state.visaStaff = data
        }
    }
}