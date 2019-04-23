// SETTINGS
import getters from "./getters";
import actions from "./actions";
import mutations from "./mutations";

const state = {

	renterNotificationSettings: [],

	// Dialog
	updateRenterNotificationDialog: true,

};

export default {

	namespaced: true,
	state,
	getters,
	actions,
	mutations

};