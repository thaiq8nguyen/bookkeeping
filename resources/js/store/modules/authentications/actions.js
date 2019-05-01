import AuthenticationServices from "Services/authentication-services";
import router from "Router";

export default {

    login ({ commit, dispatch }, credential) {

        return new Promise((resolve, reject) => {

            return AuthenticationServices.login(credential)
                .then(response => {

                    commit("SET_AUTHENTICATION", response.data.result);
                    resolve();

                })
                .catch(errors => {

                    if (errors.response) {

                        reject(errors.response);

                    }

                });

        });

    },

    logout ({ dispatch }) {

        return AuthenticationServices.logout()
        .then(response => {

            router.push({ name: "Login", query: { action: "logout" } });
            dispatch("resetAuthentication");

        })
        .catch(errors => {

            console.log(errors);

        });

    },

    resetAuthentication ({ commit }) {

        commit("SET_AUTHENTICATION", { accessToken: "", expiration: "", userFullName: "", role: "" });
        localStorage.removeItem("state");

    }
};
