<template>
	<div id="settings">
		<v-app>
			<top-navigation-bar :title="'Settings'"></top-navigation-bar>
			<v-content>
				<v-container fluid grid-md-list>
					<v-layout row wrap>
						<v-flex md3>
							<renter-notification-settings></renter-notification-settings>
						</v-flex>
					</v-layout>
				</v-container>
			</v-content>
		</v-app>
	</div>

</template>

<script>
	import TopNavigationBar from "Components/TopNavigationBar";
	import RenterNotificationSettings from "Components/Settings/RenterNotificationSettings";
	export default {
		name: "Settings",
		components: { TopNavigationBar, RenterNotificationSettings },
		data () {

			return {

			};

		},
		computed: {},
		methods: {},
	};

</script>

<style scoped>

</style>
