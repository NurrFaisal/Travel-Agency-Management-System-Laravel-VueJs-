export default {
    namespace:true,
    state:{
        suplier: ' '
    },
    getters:{
        get_suplier(state){
            return state.suplier
        }
    },
    actions:{
        allSuplier(payload){
            axios.get('/api/get-all-suplier')
                .then((response) =>{
                    payload.commit('suplier', response.data.all_suplier)
                })
        }
    },
    mutations:{
        suplier(state, data){
            return state.suplier = data
        }
    }
}