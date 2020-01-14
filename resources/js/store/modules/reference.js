export default {
    namespace:true,
    state:{
        reference: ' '
    },
    getters:{
        get_reference(state){
            return state.reference
        }
    },
    actions:{
        allReference(payload){
            axios.get('/api/get-all-reference')
                .then((response) =>{
                    payload.commit('reference', response.data.all_reference)
                })
        }
    },
    mutations:{
        reference(state, data){
            return state.reference = data
        }
    }
}