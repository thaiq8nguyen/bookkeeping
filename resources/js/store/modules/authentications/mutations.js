export default {

    SET_IS_AUTHENTICATING (state, value) {

        state.isAuthenticating = value;

    },

    SET_AUTHENTICATION (state, authentication) {

        state.accessToken = authentication.accessToken;
        state.expiration = authentication.expiration;
        state.userFullName = authentication.userFullName;
        state.role = authentication.role;
        state.renterID = authentication.renterID;

    },

    SET_ERROR_MESSAGE (state, message) {

        state.errorMessage = message;

    }
};
