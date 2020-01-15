export default {
    namespace:true,
    state:{
        staffs: ''
    },
    getters:{
        get_staffs(state){
            return state.staffs
        }
    },
    actions:{

        allStaffs(payload){
            axios.get('/api/get-all-staffs-for-select')
                .then((response) =>{
                    payload.commit('staffs', response.data.staffs)
                })
        }
    },
    mutations:{
        staffs(state, data){
            return state.staffs = data
        }
    }
}
