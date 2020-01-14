export default {
    namespace:true,
    state:{
        airTicketStaff: ' '
    },
    getters:{
        get_air_ticket_staff(state){
            return state.airTicketStaff
        }
    },
    actions:{
        allAirTicketStaff(payload){
            axios.get('/api/get-all-air-ticket-staff')
                .then((response) =>{
                    payload.commit('airTicketStaff', response.data.air_ticket_staff)
                })
        }
    },
    mutations:{
        airTicketStaff(state, data){
            return state.airTicketStaff = data
        }
    }
}