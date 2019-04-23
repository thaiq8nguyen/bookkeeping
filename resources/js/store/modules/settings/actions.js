// SETTINGS

import SettingServices from "Services/setting-services";

export default {

	getRenterNotificationSettings ({ commit }) {

		SettingServices.getRenterNotificationSettings()
			.then((response) => {

				commit("SET_RENTER_NOTIFICATION_SETTINGS", response.data);

			})
			.catch((errors) => {

				console.log(errors);

			});

	},
	updateRenterNotificationDialog ({ commit }, visibility) {

		commit("UPDATE_RENTER_NOTIFICATION_DIALOG", visibility);

	},
	updateRenterNotificationSettings ({ commit }, $settings) {

		return new Promise((resolve, reject) => {
			SettingServices.updateRenterNotificationSettings($settings)
				.then((response) => {
					resolve();
				})
				.catch((errors) => {

					reject(errors);

				});

		})


	},
};
