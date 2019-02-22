<template>
    <div id="transaction-detail">
        <v-app v-if="transaction">
            <v-toolbar class="primary" app>
                <v-toolbar-title>
                    <span class="headline white--text">Invoice</span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn
                    flat
                    class="white--text subheading"
                    @click="downloadInvoice"
                    >
                    Download Invoice
                    </v-btn>
                    <v-btn
                    flat
                    class="white--text subheading"
                    @click="deleteInvoice"
                    >
                        Delete Invoice
                    </v-btn>
                    <v-btn
                    flat
                    icon
                    to="/dashboard"
                    >
                    <v-icon class="white--text">close</v-icon>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-content>
                <v-container fluid grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm4 md2>
                            <v-card>
                                <v-card-text>
                                    <p class="primary_text--text subheading ">{{ transaction.renter.full_name }}</p>
                                    <p class="primary_text--text subheading">{{ transaction.renter.phone_number }}</p>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex sm12 md12 mt-3>
                            <v-data-table
                                :headers="headers"
                                :items="transaction.lineItems"
                                hide-actions
                                class="elevation-1"
                                item-key="id"
                            >
                                <template slot="items" slot-scope="props">
                                    <td class="text-sm-center primary_text--text subheading">{{ props.item.account }}</td>
                                    <td class="text-sm-center primary_text--text subheading">{{ $dollar.format(props.item.amount) }}</td>
                                </template>
                            </v-data-table>
                        </v-flex>
                        <v-flex sm12 md12 mt-2>
                            <v-card>
                                <v-card-title>
                                    <span class="title">Total: {{ $dollar.format(totalTransactionAmount) }} </span>
                                </v-card-title>
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
        name: "TransactionDetail",
        components: {},
        data () {

            return {
                headers: [
                    { text: "Account", value: "account", sortable: false, class: "text-sm-center secondary_text--text subheading" },
                    { text: "Amount", value: "amount", sortable: false, class: "text-sm-center secondary_text--text subheading" }
                ],
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

            }
            
        },

        mounted () {

            this.$store.dispatch("Transactions/getTransaction", this.$route.params.id);

        },

        methods: {
            downloadInvoice () {

                this.$store.dispatch("Invoices/downloadInvoiceOnly", this.$route.params.id);

            },

            deleteInvoice () {

                this.$store.dispatch("Invoices/deleteInvoice", this.$route.params.id);

            }
        },
    };
</script>

<style scoped>

</style>