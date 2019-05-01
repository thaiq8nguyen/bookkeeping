<template>
	<div id="user-dashboard">
		<v-app>
			<v-toolbar class="primary">
				<v-toolbar-side-icon class="headline white--text"></v-toolbar-side-icon>
				<v-spacer></v-spacer>
				<v-btn flat class="white--text" @click="logout">Logout</v-btn>
			</v-toolbar>
			<v-content>
				<v-container fluid grid-md-list>
					<v-layout
							row
							wrap
					>
						<v-flex md6>
							<v-card>
								<v-card-title>
									<span class="title">Recent Invoices</span>
								</v-card-title>
								<v-divider></v-divider>
								<v-card-text>
									<v-data-table
											:headers="headers"
											:items="transactions"
											:rows-per-page-items="[5, 10, 15]"
									>
										<template slot="items" slot-scope="props">
											<td class="text-sm-center primary_text--text subheading">{{ props.item.date }}</td>
											<td class="text-sm-center primary_text--text subheading">{{ $dollar.format(props.item.totalAmount) }}</td>
											<td class="text-sm-center primary_text--text subheading">
												<v-btn
														icon
														@click="getInvoiceDetails(props.item.transactionID)"
												>
													<v-icon class="primary--text">list</v-icon>
												</v-btn>
											</td>
										</template>
									</v-data-table>
								</v-card-text>
							</v-card>
						</v-flex>
					</v-layout>
				</v-container>
			</v-content>
			<v-dialog v-model="invoiceDetailDialog" fullscreen>
				<v-card>
					<v-card-title>
						<span class="title">{{ transaction.invoicingMonth }} Invoice</span>
						<v-spacer></v-spacer>
						<span class="title">Due: {{ transaction.dueDate }}</span>
					</v-card-title>
					<v-divider></v-divider>
					<v-card-text>
						<v-data-table
								:headers="transactionDetailHeaders"
								:items="transaction.items"
								hide-actions
								class="elevation-1"
								item-key="id"
						>
							<template slot="items" slot-scope="props">
								<td class="text-sm-center primary_text--text subheading">{{ props.item.account }}</td>
								<td class="text-sm-center primary_text--text subheading">{{ $dollar.format(props.item.amount) }}</td>
							</template>
						</v-data-table>
						<div class="text-md-center pt-3">
							<span class="headline">Total: {{ $dollar.format(totalTransactionAmount) }}</span>
						</div>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn @click="invoiceDetailDialog = false">Close</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		</v-app>
	</div>
</template>

<script>

	export default {
		name: "RenterDashboard",
		components: { },
		data () {

			return {
				headers: [
					{ text: "Date", value: "renter", class: "text-sm-center secondary_text--text subheading" },
					{ text: "Amount", value: "amount", class: "text-sm-center secondary_text--text subheading" },
					{ text: "Details", value: "details", class: "text-sm-center secondary_text--text subheading" },
				],
				transactionDetailHeaders: [
					{ text: "Bill", value: "account", sortable: false, class: "text-sm-center secondary_text--text subheading" },
					{ text: "Amount", value: "amount", sortable: false, class: "text-sm-center secondary_text--text subheading" }
				],
				invoiceDetailDialog: false,
			};

		},
		computed: {

			name () {

				return this.$store.getters["Authentications/userFullName"];

			},
			transactions () {

				return this.$store.getters["Transactions/transactions"];

			},
			transaction () {

				return this.$store.getters["Transactions/transaction"];

			},
			renterID () {

				return this.$store.getters["Authentications/renterID"];

			},
			totalTransactionAmount () {

				if (this.transaction) {

					return this.transaction.items.reduce((sum, item) => {

						return sum + parseFloat(item.amount);

					}, 0);

				} else {

					return 0;

				}

			}
		},
		created () {

			this.$store.dispatch("Transactions/getRenterTransactions", this.renterID);

		},
		methods: {

			logout () {

				this.$store.dispatch("Authentications/logout");

			},
			getInvoiceDetails (transactionID) {

				this.$store.dispatch("Transactions/getRenterTransaction", { renterID: this.renterID, transactionID: transactionID });
				this.invoiceDetailDialog = true;

			}

		},
	};

</script>

<style scoped>

</style>
