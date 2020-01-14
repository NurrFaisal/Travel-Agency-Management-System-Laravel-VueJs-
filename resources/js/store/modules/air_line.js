export default {
    namespace:true,
    state:{
        air_line: ' '
    },
    getters:{
        getAirLine(state){
            return state.air_line
        }
    },
    actions:{
        allAirLine(payload){
            axios.get('/api/get-all-air-line')
                .then((response) =>{
                    payload.commit('air_line', response.data.air_line)
                })
        }
    },
    mutations:{
        air_line(state, data){
            return state.air_line = data
        }
    }
}