import Vue from "vue";
import Plugins from "../plugins";

let Services = new Vue();
Vue.use(Plugins);

export default ({

    getRenters () {

        return Services.apiClient.get("/renters");

    },

    createRenter (renter) {
    
    }
});