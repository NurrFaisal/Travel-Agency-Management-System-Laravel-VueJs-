export default {
    namespace:true,
    state:{
        agency: ' '
    },
    getters:{
        get_agency(state){
            return state.agency
        }
    },
    actions:{
        allAgency(payload){
            axios.get('/api/get-all-agency')
                .then((response) =>{
                    payload.commit('agency', response.data.agency)
                })
        }
    },
    mutations:{
        agency(state, data){
            return state.agency = data
        }
    }
}