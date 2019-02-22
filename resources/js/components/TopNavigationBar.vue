<template>
    <div id="top-navigation-bar">
        <v-toolbar
			class="primary"
			app
			absolute
			clipped-left
			>
			<v-toolbar-side-icon class="white--text"></v-toolbar-side-icon>
			<v-toolbar-title>
				<span class="headline white--text">Dashboard</span>
			</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-menu offset-y>
				<v-btn
					slot="activator"
					color="primary"
					icon
				>
					<v-icon>add</v-icon>
				</v-btn>
				<v-list>
					<v-list-tile
						v-for="(dialog, index) in newDialogs"
						:key="index"
						@click="showDialog(dialog.component)"
					>
						<v-list-tile-title>{{ dialog.name }}</v-list-tile-title>
					</v-list-tile>
				</v-list>
			</v-menu>
			<v-menu offset-y>
				<v-btn slot="activator" class="white--text" flat>
                    {{ userFullName }}
					<v-icon right>keyboard_arrow_down</v-icon>
				</v-btn>
				<v-list>
					<template v-for="(item, key) in items">
						<v-list-tile :key="key">
							<v-list-tile-title @click="logout">{{ item.name }}</v-list-tile-title>
						</v-list-tile>
					</template>
				</v-list>
			</v-menu>
		</v-toolbar>
    </div>
</template>

<script>
    export default {
        name: "TopNavigationBar",
        data () {

            return {
                newDialogs: [

					{ name: "Invoice", component: "createInvoice" }
					
				],
				items: [
					{ name: "Logout" }
				]
			};
			
		},

		computed: {

			userFullName () {

				return this.$store.getters["Authentications/userFullName"];

			}
		},
		methods: {

			showDialog (dialog) {

				this.$store.dispatch("Dialogs/showDialog", { name: dialog, visibility: true });

			},
			logout () {

				this.$store.dispatch("Authentications/logout");
				
			}
		}

    };
</script>

<style scoped>

</style>