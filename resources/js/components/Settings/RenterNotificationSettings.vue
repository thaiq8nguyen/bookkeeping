<template>
	<div id="renter-notification-settings">
		<v-card>
			<v-card-title>
				<span class="title">Renter Notifications</span>
			</v-card-title>
			<v-card-text>
				<v-list>
					<v-list-tile @click="show">
						<v-list-tile-content>Update</v-list-tile-content>
					</v-list-tile>
				</v-list>
			</v-card-text>
		</v-card>
		<v-dialog
				v-model="updateRenterNotificationDialogVisibility"
				fullscreen
				hide-overlay
				transition="dialog-bottom-transition"
		>
			<update-renter-notifications></update-renter-notifications>
		</v-dialog>
	</div>
</template>

<script>
	import UpdateRenterNotifications from "Components/Settings/UpdateRenterNotificationSettings";
	export default {
		name: "RenterNotifications",
		components: { UpdateRenterNotifications },
		data () {

			return {

			};

		},
		computed: {
			updateRenterNotificationDialogVisibility () {

				return this.$store.getters["Settings/updateRenterNotificationDialog"];

			}
		},
		mounted () {

			this.$store.dispatch("Settings/getRenterNotificationSettings");

		},
		methods: {
			show () {

				this.$store.dispatch("Settings/updateRenterNotificationDialog", true);

			}
		},
	};

</script>

<style scoped>

</style>
