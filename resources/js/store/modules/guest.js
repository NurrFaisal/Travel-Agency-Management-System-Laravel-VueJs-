export default {
    namespace:true,
    state:{
        guest: ' '
    },
    getters:{
        get_guest(state){
            return state.guest
        }
    },
    actions:{
        allGuest(payload){
            axios.get('/api/get-all-guest')
                .then((response) =>{
                    payload.commit('guest', response.data.guest)
                })
        }
    },
    mutations:{
        guest(state, data){
            return state.guest = data
        }
    }
}