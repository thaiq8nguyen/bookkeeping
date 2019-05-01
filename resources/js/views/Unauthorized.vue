<template>
	<div id="authorized">
		<v-app>
			<v-content>
				<v-container fill-height>
					<v-layout row justify-center align-center>
						<v-flex>
							<v-card>
								<v-card-title>
									<span class="headline">Unauthorized</span>
								</v-card-title>
								<v-divider></v-divider>
								<v-card-text>
									<span class="title">You are not authorized to access this page</span>
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
	export default {
		name: "Unauthorized",
		data () {

			return {};

		},
		computed: {},
		methods: {},
	};

</script>

<style scoped>

</style>
