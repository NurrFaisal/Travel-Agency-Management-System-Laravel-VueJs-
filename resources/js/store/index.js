import staffDesignation from './modules/staff-designation'
import department from "./modules/department";
import staff from "./modules/staff";
import guest from "./modules/guest";
import guestQuery from "./modules/guestQuery";
import agency from "./modules/agency";
import air_line from "./modules/air_line";
import visaCategory from "./modules/visaCategory";
import visa_agency from "./modules/visa_agency";
import visa_country from "./modules/visa_country";
import suplier from "./modules/suplier";
import reference from "./modules/reference";
import visaStaff from "./modules/visaStaff";
import received from "./modules/visa/received";
import airTicketStaff from "./modules/airTicketStaff";
import bank from "./modules/bank";

export default {
    modules:{
        staffDesignation: staffDesignation,
        department: department,
        staff: staff,
        guest: guest,
        guest_query: guestQuery,
        agency: agency,
        air_line: air_line,
        visa_category: visaCategory,
        visa_agency: visa_agency,
        visa_country: visa_country,
        suplier: suplier,
        reference: reference,
        visaStaff: visaStaff,
        received: received,
        airTicketStaff: airTicketStaff,
        bank: bank


    },
    state:{
        guest_title: " ",
        guest_designation: " "
    },
    getters:{
        getGuestTitle(state){
            return state.guest_title
        },
        getGuestDesignation(state){
            return state.guest_designation
        }
    },
    actions:{
        allGuestTitle(payload){
            axios.get('/api/get-all-guest-title')
                .then((response) =>{
                    payload.commit('guest_title', response.data.all_guest_titles)
                })
        },
        allGuestDesignation(payload){
            axios.get('/api/get-all-guest-designation')
                .then((response) => {
                    payload.commit('guest_designation', response.data.all_guest_designations)
                })
        }
    },
    mutations:{
        guest_title(state, data){
            return state.guest_title = data
        },
        guest_designation(state, data){
            return state.guest_designation = data
        }
    }
}