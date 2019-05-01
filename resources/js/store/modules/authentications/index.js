import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

const state = {

    isAuthenticating: false,
    userFullName: "",
    accessToken: "",
    expiration: "",
    errorMessage: "",
    role: "",
    renterID: "",

};
export default ({
    namespaced: true,
    state,
    getters,
    actions,
    mutations
});
