export default {
    namespace:true,
    state:{
        department: ' '
    },
    getters:{
        get_department(state){
            return state.department
        }
    },
    actions:{
        allDepartment(payload){
            axios.get('/api/get-all-department')
                .then((response) =>{
                    payload.commit('department', response.data.department)
                })
        }
    },
    mutations:{
        department(state, data){
            return state.department = data
        }
    }
}