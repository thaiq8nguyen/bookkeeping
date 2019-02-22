import RenterServices from "Services/renter-services";

export default {

    getRenters ({ commit }) {

        RenterServices.getRenters()
        .then(response => {

            commit("SET_RENTERS", response.data);
            
        })
        .catch(errors => {

        });

    },

    selectRenter ({ commit }, renterID) {

        commit("SELECT_RENTER", renterID);

    },

    unSelectRenter ({ commit }) {

        commit("UNSELECT_RENTER");

    }

};