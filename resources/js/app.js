
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import colors from "vuetify/es5/util/colors";
import store from "./store";
import router from "./router";
import Plugins from "Plugins";
import VeeValidate from "vee-validate";

import App from "Components/App";

Vue.use(Vuetify, {
    theme: {
        dark_primary: colors.red.darken2,
        light_primary: colors.red.lighten4,
        primary: colors.red.base,
        text_icon: colors.shades.white,
        accent: colors.blue.accent2,
        primary_text: colors.grey.darken4,
        secondary_text: colors.grey.darken1,
        divider_color: colors.grey.lighten1,

    }
});

Vue.use(Plugins);
Vue.use(VeeValidate);

Vue.config.productionTip = false;

// Filters
Vue.filter("capitalize", (value) => {

    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);

});

const app = new Vue({
    el: "#app",
    store,
    router,
    components: { App },
    template: "<App/>",
});
