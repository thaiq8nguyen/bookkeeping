import AuthenticationServices from "Services/authentication-services";
import router from "Router";

export default {
    init ({ commit }) {

        commit("SET_ERROR_MESSAGE", "");

    },

    login ({ commit, dispatch }, credential) {

        return AuthenticationServices.login(credential)
        .then(response => {

            commit("SET_AUTHENTICATION", response.data.result);

            let url = router.currentRoute.query.url;

            if (url !== undefined) {

                router.push(url);

            } else {

                router.push("dashboard");

            }

        })
        .catch(errors => {

            if (errors.response.status === 401) {

                commit("SET_ERROR_MESSAGE", "Incorrect email or password");

            }

            console.log(errors);
            dispatch("resetAuthentication");

        })
        .then(() => {

            commit("SET_IS_AUTHENTICATING", false);

        });

},

    logout ({ dispatch }) {

        return AuthenticationServices.logout()
        .then(response => {

            router.push({ path: "login", query: { action: "logout" } });
            dispatch("resetAuthentication");

        })
        .catch(errors => {

            console.log(errors);

        });

    },

    resetAuthentication ({ commit }) {

        commit("SET_AUTHENTICATION", { accessToken: "", expiration: "", userFullName: "" });
        localStorage.removeItem("state");

    }
};
