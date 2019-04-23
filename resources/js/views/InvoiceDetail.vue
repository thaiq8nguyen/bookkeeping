<template>
	<div id="invoice-detail">
		<v-app>
			<v-content v-if="transaction">
				<v-container grid-list-md>
					<v-layout
							row
							wrap
							justify-center
					>
						<v-flex md12>
							<v-toolbar flat>
								<v-toolbar-title>
									<span :class="fontSize">{{ invoicingMonth }}</span>
								</v-toolbar-title>
								<v-spacer></v-spacer>
								<span :class="fontSize">Due: {{ transaction.due_date }}</span>
							</v-toolbar>
							<v-layout row wrap>
								<v-flex>
									<v-card flat>
										<v-card-title>
											<span class="title">{{ transaction.renter.full_name }}</span>
										</v-card-title>
									</v-card>
								</v-flex>
								<v-flex>
									<v-list>
										<v-list-tile v-for="(item, key) in transaction.lineItems" :key="key">
											<v-list-tile-content>{{ item.account }}</v-list-tile-content>
											<v-list-tile-content class="align-end">{{ $dollar.format(item.amount) }}</v-list-tile-content>
										</v-list-tile>
									</v-list>
									<v-divider></v-divider>
									<v-list>
										<v-list-tile>
											<v-list-tile-content>Total Due:</v-list-tile-content>
											<v-list-tile-content class="align-end title">{{ $dollar.format(totalTransactionAmount) }}</v-list-tile-content>
										</v-list-tile>
									</v-list>
								</v-flex>
							</v-layout>
						</v-flex>
						<v-flex md12>
							<v-card v-if="transaction.memo" class="my-3" flat>
								<v-card-title class="info">
									<span class="title white--text">Memo</span>
								</v-card-title>
								<v-card-text>
									<span class="subheading">{{ transaction.memo }}</span>
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
	name: "InvoiceDetail",
	data () {

		return {
			headers: [
				{ text: "Account", value: "account", sortable: false, class: "text-sm-center secondary_text--text subheading" },
				{ text: "Amount", value: "amount", sortable: false, class: "text-sm-center secondary_text--text subheading" }
			]
		};

	},
	computed: {
        transaction () {

			return this.$store.getters["Transactions/transaction"];

        },
        totalTransactionAmount () {

            return this.transaction.lineItems.reduce((sum, lineItem) => {

                return sum + parseFloat(lineItem.amount);

            }, 0);

        },
		invoicingMonth () {

			return this.transaction.invoicing_month;

		},
		fontSize () {

			let size = "";
			switch (this.$vuetify.breakpoint.name) {

				case "md":
					size = "title";
					break;
				case "lg":
					size = "title";
					break;
					default: size = "subheading";

			}
			return size;

		}
	},

    mounted () {

      this.$store.dispatch("Transactions/getTransaction", this.$route.params.id);

    },
	methods: {},
};

</script>

<style scoped>

</style>
