import Vue from "vue";
import Plugins from "../plugins";

let Services = new Vue();
Vue.use(Plugins);

export default ({

    getTransactions () {

        return Services.apiClient.get("/transactions");

    },

    getTransaction (id) {

        return Services.apiClient.get("/transactions/" + id);

    },

    createTransaction (transaction) {
    
    },

});