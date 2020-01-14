export default {
    namespace:true,
    state:{
        banks: ' '
    },
    getters:{
        get_banks(state){
            return state.banks
        }
    },
    actions:{
        allBanks(payload){
            axios.get('/api/get-all-module-banks')
                .then((response) =>{
                    payload.commit('banks', response.data.banks)
                })
        }
    },
    mutations:{
        banks(state, data){
            return state.banks = data
        }
    }
}