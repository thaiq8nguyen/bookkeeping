// SETTINGS

export default {

	SET_RENTER_NOTIFICATION_SETTINGS (state, settings) {

		state.renterNotificationSettings = settings;

	},
	UPDATE_RENTER_NOTIFICATION_DIALOG (state, visibility) {

		state.updateRenterNotificationDialog = visibility;

	}
};
