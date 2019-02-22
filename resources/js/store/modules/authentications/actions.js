import AuthenticationServices from "Services/authentication-services";
import Router from "Router";
import { removeState } from "../../plugins/persist-states";

export default {

    init ({ commit, getters }) {

        const authentication = AuthenticationServices.init();

        if (authentication) {

            commit("SET_AUTHENTICATION", authentication);

        }

        if (getters.isAuthenticated) {

            Router.push("/dashboard");
            
        }

    },

    login ({ commit }, credential) {
        
        commit("SET_IS_AUTHENTICATING", true);

        return AuthenticationServices.login(credential)
        .then(response => {
                
            commit("SET_AUTHENTICATION", response.data.result);

            Router.push("dashboard");

        })
        .catch(errors => {

            if (errors.response.status === 401) {
                
                commit("SET_ERROR_MESSAGE", errors.response.data.message);

            }
            
        })
        .then(() => {

            commit("SET_IS_AUTHENTICATING", false);

        });
    
},

    logout ({ commit }) {

        return AuthenticationServices.logout()
        .then(response => {

            Router.push("logout");

            removeState("authentications");

            commit("SET_AUTHENTICATION", { accessToken: "", expiration: "", userFullName: "" });
            
        })
        .catch(errors => {

            console.log(errors);

        });

    }
};