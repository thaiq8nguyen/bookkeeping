import Vue from "vue";
import Plugins from "Plugins";

let Services = new Vue();
Vue.use(Plugins);

export default ({

    getTodaysDate () {

        return Services.moment().format("MM/DD/YYYY");

    },

    getDateFromToday (numberOfDay) {

        return Services.moment().add(numberOfDay, "days").format("MM/DD/YYYY");

    },
    
    getCurrentMonthAndYear () {

        return Services.moment().format("MMMM YYYY");

    },

    isAfterToday (date) {

        return Services.moment().isAfter(date);

    },

    isSameOrBeforeToday (date) {

        return Services.moment().isSameOrBefore(date);

    }

});