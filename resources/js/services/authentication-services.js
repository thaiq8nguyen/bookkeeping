import Vue from "vue";
import Plugins from "Plugins";
import { loadState } from "../store/plugins/persist-states";

let Services = new Vue();
Vue.use(Plugins);

export default {

    init () {

        if (loadState("authentications")) {

            return loadState("authentications");

        } else {

            return null;
            
        }

    },

    login (credential) {

        return Services.apiClient.post("/login", credential);

    },

    logout () {

        return Services.apiClient.post("/logout");

    },

    user () {

        return Services.apiClient.get("/user");
        
    }
};
