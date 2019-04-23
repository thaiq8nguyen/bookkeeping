import Vue from "vue";
import Plugins from "../plugins";

let Services = new Vue();
Vue.use(Plugins);

export default ({

	getRenterNotificationSettings () {

		return Services.apiClient.get("/settings/renters-notifications");

	},
	updateRenterNotificationSettings ($settings) {

		return Services.apiClient.put("/settings/renters-notifications", $settings);

	},
	createRenter (renter) {

	}
});
