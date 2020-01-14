export default {
    namespace:true,
    state:{
        work_visa: ' '
    },
    getters:{
        get_work_visa(state){
            return state.work_visa
        }
    },
    actions:{
        allWorkVisa(payload){
            axios.get('/api/get-all-work-visa')
                .then((response) =>{
                    payload.commit('work_visa', response.data.work_visa.data)
                })
        }
    },
    mutations:{
        work_visa(state, data){
            return state.work_visa = data
        }
    }
}