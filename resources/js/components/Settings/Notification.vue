<template>
	<div id="notification">
		<v-list>
			<v-list-tile>
				<v-list-tile-content>{{ notification.name }}</v-list-tile-content>
				<v-list-tile-action>
					<v-switch
							v-model="notification.setting.is_active"
							:loading="loading"
					>
					</v-switch>
				</v-list-tile-action>
			</v-list-tile>
		</v-list>



	</div>
</template>

<script>
	export default {
		name: "Notification",
		props: {
			notification: {
				type: Object
			}
		},
		data () {

			return {
				loading: false,
			};

		},

		computed: {},
		watch: {
			notification: {

				handler (oldSettings, newSettings) {


					let settings = {
						renterID: newSettings.setting.renter_id,
						notificationID: newSettings.setting.notification_id,
						isActive: newSettings.setting.is_active ? 1 : 0
					};
					this.loading = true;
					this.$store.dispatch("Settings/updateRenterNotificationSettings", settings)
						.then(() => {

							this.loading = false;

						})
						.catch(() => {

						});

				},
				deep: true
			}
		},
		methods: {},
	};

</script>

<style scoped>

</style>
