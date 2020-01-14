export default {
    namespace:true,
    state:{
        guest_query: ' '
    },
    getters:{
        get_guest_query(state){
            return state.guest_query
        }
    },
    actions:{
        allGuestQuery(payload){
            axios.get('/api/get-all-guest-query')
                .then((response) =>{
                    payload.commit('guestQuery', response.data.guest_query)
                })
        }
    },
    mutations:{
        guestQuery(state, data){
            return state.guest_query = data
        }
    }
}