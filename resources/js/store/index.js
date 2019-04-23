import Vue from "vue";
import Vuex from "vuex";
import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

// Modules
import Invoices from "./modules/invoices";
import Renters from "./modules/renters";
import Dialogs from "./modules/dialogs";
import Transactions from "./modules/transactions";
import Authentications from "./modules/authentications";
import Settings from "./modules/settings";

import Plugins from "Plugins";

let Services = new Vue();
Vue.use(Plugins);

// Plugins

const persistStates = (store) => {

    store.subscribe((mutation, state) => {

        Services.persistState.save(state);

    });

};

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Invoices, Renters, Dialogs, Transactions, Authentications, Settings
    },
    state: {

        date: new Date()

    },
    getters,

    actions,

    mutations,

    plugins: [persistStates],

});
