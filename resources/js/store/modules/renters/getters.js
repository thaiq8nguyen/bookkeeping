export default {

    renters (state) {

        return state.renters;
        
    },

    renterID (state) {

        return state.renterID;
        
    },

    renterFullName (state) {

        if (state.renterID) {

            return state.renters.find(renter => renter.id === state.renterID).full_name;

        }
        
    }
}