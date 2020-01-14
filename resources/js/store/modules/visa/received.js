export default {
    namespace:true,
    state:{
        received_visa: ' '
    },
    getters:{
        get_received_visa(state){
            return state.received_visa
        }
    },
    actions:{
        allReceivedVisa(payload){
            axios.get('/api/get-all-recieved-visa')
                .then((response) =>{
                    payload.commit('received_visa', response.data.recieved_visa.data)
                })
        }
    },
    mutations:{
        received_visa(state, data){
            return state.received_visa = data
        }
    }
}