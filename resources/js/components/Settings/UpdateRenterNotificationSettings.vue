<template>
	<div id="update-renter-notification-settings">
		<v-app>
			<v-toolbar class="primary">
				<v-toolbar-title>
					<span class="headline white--text">Update</span>
				</v-toolbar-title>
				<v-spacer></v-spacer>
				<v-btn icon><v-icon class="white--text" @click="close">close</v-icon></v-btn>
			</v-toolbar>
			<v-content>
				<v-container fluid grid-md-list>
					<v-layout row wrap>
						<v-flex v-for="renter in renters" :key="renter.id" md3>
							<v-card>
								<v-card-title>
									<span class="title">{{ renter.full_name }}</span>
								</v-card-title>
								<v-divider></v-divider>
								<v-card-text>
									<notification v-for="notification in renter.notifications" :key="notification.id" :notification="notification"></notification>
								</v-card-text>
							</v-card>
						</v-flex>
					</v-layout>
				</v-container>
			</v-content>
		</v-app>
	</div>
</template>

<script>
	import Notification from "./Notification";
	export default {
		name: "UpdateRenterNotificationSettings",
		components: { Notification },
		data () {

			return {};

		},
		computed: {
			renters () {

				return this.$store.getters["Settings/renterNotificationSettings"];

			},
		},
		watch: {

		},
		methods: {
			close () {

				this.$store.dispatch("Settings/updateRenterNotificationDialog", false);

			}
		},
	};

</script>

<style scoped>

</style>
