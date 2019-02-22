<template>
    <div id="recent-transactions">
        <v-container fluid grid-list-md>
            <v-layout row wrap>
                <v-flex md12></v-flex>
                <v-flex md8>
                    <v-toolbar flat>
                        <v-toolbar-title>Invoices</v-toolbar-title>
                    </v-toolbar>
                    <v-data-table
                        :headers="headers"
                        :items="transactions"
                        :rows-per-page-items="[5, 10, 15]"
                    >
                        <template slot="items" slot-scope="props">
                            <td class="text-sm-center primary_text--text subheading">{{ props.item.date }}</td>
                            <td class="text-sm-center primary_text--text subheading">{{ props.item.renter.full_name }}</td>
                            <td class="text-sm-center primary_text--text subheading">{{ $dollar.format(props.item.totalAmount) }}</td>
                            <td class="text-sm-center primary_text--text subheading">
                                <v-btn
                                icon
                                :to="{ name:'TransactionDetail', params:{ id: props.item.transactionID } }"
                                >
                                <v-icon class="primary--text">list</v-icon>
                                </v-btn>
                            </td>
                            <td class="text-sm-center primary_text--text subheading">
                                <v-btn
                                v-if="props.item.file"
                                icon
                                @click="downloadInvoice(props.item.file.id)"
                                >
                                <v-icon class="primary--text">save_alt</v-icon>
                                </v-btn>
                            </td>
                        </template>
                    </v-data-table>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>
<script>
    export default {
        name: "RecentTransactions",
        data () {

            return {
                headers: [
                    { text: "Date", value: "renter", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Renter", value: "renter", sortable: false, class: "text-sm-center secondary_text--text subheading" },
                    { text: "Amount", value: "amount", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Details", value: "details", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Report", value: "report", class: "text-sm-center secondary_text--text subheading" }
                ]
            };

        },

        computed: {

            transactions () {

                return this.$store.getters["Transactions/transactions"];

            }
        },

        created () {

            this.$store.dispatch("Transactions/getTransactions");
            
        },

        methods: {
            downloadInvoice (transactionID) {
                
                this.$store.dispatch("Invoices/downloadInvoiceOnly", transactionID);

            }
        }
    };
</script>

<style scoped>

</style>