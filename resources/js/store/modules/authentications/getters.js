import DateServices from "Services/date-services";

export default {

    isAuthenticating (state) {

        return state.isAuthenticating;

    },

    isAuthenticated (state) {

        return state.accessToken && DateServices.isSameOrBeforeToday(state.tokenExpiration);

    },

    userFullName (state) {

        return state.userFullName;

    },

    accessToken (state) {

        return state.accessToken;

    },

    errorMessage (state) {

        return state.errorMessage;

    },
    role (state) {

        return state.role;

    },
    renterID (state) {

        return state.renterID;

    },
};
