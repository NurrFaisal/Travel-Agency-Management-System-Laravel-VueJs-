export default {
    namespace:true,
    state:{
        staff_designation_name: ' '
    },
    getters:{
        get_staff_designation_name(state){
            return state.staff_designation_name
        }
    },
    actions:{
        allStaffDesignation(payload){
            axios.get('/api/get-all-staff-designation')
                .then((response) =>{
                    payload.commit('guest_designation', response.data.staff_designations)
                })
        }
    },
    mutations:{
        guest_designation(state, data){
            return state.staff_designation_name = data
        }
    }
}