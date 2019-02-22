import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

const state = {
    expenseAccounts: [],
    invoiceItems: [],
    invoice: "",
    newTransactionID: "",
    memo: "",

    saving: false,
};
export default ({
    namespaced: true,
    state,
    getters,
    actions,
    mutations
});