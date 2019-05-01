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
    getRenterTransactions (renterID) {

        return Services.apiClient.get("/transactions/renters/" + renterID);

    },
    getRenterTransaction (request) {

        return Services.apiClient.get(`/renters/${request.renterID}/transactions/${request.transactionID}`);

    }

});
