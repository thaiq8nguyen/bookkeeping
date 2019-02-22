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

import { saveState } from "./plugins/persist-states";

// Plugins

const persistStates = (store) => {

    store.subscribe((mutation, state) => {

        switch (mutation.type) {

            case "Authentications/SET_AUTHENTICATION": saveState("authentications", mutation.payload);

        }
        
    });

};

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Invoices, Renters, Dialogs, Transactions, Authentications
    },
    state: {

        date: new Date()

    },
    getters,
    
    actions,

    mutations,

    plugins: [persistStates],

});