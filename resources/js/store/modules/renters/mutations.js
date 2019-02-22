export default {

    SET_RENTERS (state, renters) {

        state.renters = renters;
        
    },

    SELECT_RENTER (state, renterID) {

        state.renterID = renterID;

    },

    UNSELECT_RENTER (state) {

        state.renterID = "";
        
    }
}