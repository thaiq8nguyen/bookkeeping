<template>
    <div id="create-invoice">
        <v-app>
            <v-toolbar class="primary" app>
                <v-toolbar-title>
                    <span class="headline white--text">Create Invoice</span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon><v-icon class="white--text" @click="close">close</v-icon></v-btn>
            </v-toolbar>
            <v-content>
                <v-container fluid grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm4 md3>
                            <v-card>
                                <v-card-title class="dark_primary">
                                    <span class="headline white--text">Renter</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-form>
                                        <v-select
                                            v-model="renter"
                                            label="Renter"
                                            :items="renters"
                                            item-value="id"
                                            item-text="full_name"
                                        >
                                        </v-select>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex md3>
                            <v-card height="100%">
                                <v-card-text>
                                    <v-menu
                                        v-model="showCalendar"
                                        lazy
                                        :close-on-content-click="true"
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        :nudge-left="0"
                                    >
                                        <v-text-field
                                            slot="activator"
                                            label="Date"
                                            :value="formattedDate"
                                            readonly
                                        ></v-text-field>
                                        <v-date-picker
                                            v-model="date"
                                            no-title
                                            scrollable
                                            actions
                                        >
                                        </v-date-picker>
                                    </v-menu>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex sm12 md12 mt-3>
                            <v-card height="100%">
                                <v-card-title class="dark_primary">
                                    <span class="headline white--text">Create Invoice Items</span>
                                </v-card-title>
                                <v-form>
                                    <v-card-text>
                                        <v-layout row justify-start>
                                            <v-flex sm2>
                                                <v-select
                                                    v-model="invoiceItem.accountID"
                                                    label="Account"
                                                    :items="expenseAccounts"
                                                    item-value="accountID"
                                                    item-text="accountName"
                                                >
                                                </v-select>
                                            </v-flex>
                                            <v-flex sm2 ml-2>
                                                <v-text-field
                                                    v-model.number="invoiceItem.amount"
                                                    label="Amount"
                                                    prefix="$"
                                                >
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex sm3 ml-2>
                                                <v-text-field
                                                    v-model="invoiceItem.memo"
                                                    label="Memo"
                                                >
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex sm2 ml-2>
                                                <v-text-field
                                                    v-model="invoiceItem.reference"
                                                    label="Reference"
                                                >
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex sm1 ml-2>
                                                <v-btn icon @click="createInvoiceItem"><v-icon>add</v-icon></v-btn>
                                            </v-flex>
                                        </v-layout>
                                    </v-card-text>
                                </v-form>
                                <v-card-text>
                                    <v-data-table
                                        :headers="invoiceItemHeaders"
                                        :items="invoiceItems"
                                        hide-actions
                                    >
                                    <template slot="items" slot-scope="props">
                                        <td class="text-sm-center primary_text--text subheading">{{ expenseAccountsLookUp(props.item.accountID) | capitalize }}</td>
                                        <td class="text-sm-center primary_text--text subheading">{{ $dollar.format(props.item.amount) }}</td>
                                        <td class="text-sm-center primary_text--text subheading">{{ props.item.memo }}</td>
                                        <td class="text-sm-center primary_text--text subheading">{{ props.item.reference }}</td>
                                        <td class="text-sm-center primary_text--text subheading">
                                            <v-icon class="primary--text" @click="deleteInvoiceItem(props.item)">delete</v-icon>
                                        </td>
                                    </template>
                                    </v-data-table>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex md12 mt-3>
                            <v-card-text>
                                <v-text-field
                                    v-model="memo"
                                    label="Memo"
                                ></v-text-field>
                            </v-card-text>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer height="auto">
                <v-layout>
                    <v-flex md12>
                        <v-card>
                    <v-list>
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title class="title">
                                <span class="secondary_text--text">Total: </span><span class="primary_text--text">{{ $dollar.format(totalInvoiceAmount) }}</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-spacer></v-spacer>
                        <v-list-tile-action>
                            <v-btn class="info" :loading="saving" @click="createInvoice">Create</v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
                </v-card>
                    </v-flex>
                </v-layout>
            </v-footer>
            <v-dialog
                :value="invoiceCreatedConfirmation"
                max-width="500"
                >
                <v-card>
                    <v-card-title class="primary">
                        <span class="headline white--text">Confirmation</span>
                        <v-spacer></v-spacer>
                        <v-btn icon class="white--text" @click="invoiceCreatedConfirmation = false"><v-icon>close</v-icon></v-btn>
                    </v-card-title>
                    <v-card-text class="text-md-center">
                        <p class="subheading">The invoice has been created!</p>
                        <v-btn @click="downloadInvoice">Download Invoice</v-btn>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </v-app>
    </div>
</template>

<script>
    export default {
        name: "CreateInvoice",
        data () {

            return {
                invoiceItemHeaders: [
                    { text: "Expense", value: "expense", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Amount", value: "amount", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Memo", value: "memo", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Reference", value: "reference", class: "text-sm-center secondary_text--text subheading" },
                    { text: "Actions", value: "action", class: "text-sm-center secondary_text--text subheading" }
                ],
                invoiceItem: {
                    accountID: "",
                    amount: "",
                    memo: "",
                    reference: ""
                },
                defaultInvoiceItem: {
                    accountID: "",
                    amount: "",
                    memo: "",
                    reference: ""
                },
                showCalendar: false,
                sheet: true,
            };

        },
        computed: {
            date: {

                get () {

                    return this.$store.getters.date;

                },
                set (date) {

                    this.$store.dispatch("setDate", date);

                }
            },
            formattedDate () {

                return this.$store.getters.formattedDate;

            },
            renters () {

                return this.$store.getters["Renters/renters"];

            },
            renter: {

                get () {

                    return this.$store.getters["Renters/renter"];

                },
                set (renter) {

                    return this.$store.dispatch("Renters/selectRenter", renter);

                }
            },
            invoiceItems () {

                return this.$store.getters["Invoices/invoiceItems"];

            },
            expenseAccounts () {

                return this.$store.getters["Invoices/expenseAccounts"];

            },
            saving () {

                return this.$store.getters["Invoices/saving"];

            },
            invoiceCreatedConfirmation: {

                get () {

                    return this.$store.getters["Dialogs/showInvoiceCreatedConfirmation"];

                },
                set (value) {

                    this.$store.dispatch("Dialogs/showDialog", { name: "invoiceCreatedConfirmation", visibility: value });

                }

            },
            totalInvoiceAmount () {

                return this.$store.getters["Invoices/totalInvoiceAmount"];

            },

            memo: {
                get () {

                    return this.$store.getters["Invoices/memo"];

                },
                set (memo) {

                    this.$store.dispatch("Invoices/createMemo", memo);

                }
            }

        },
        created () {

            this.$store.dispatch("Renters/getRenters");
            this.$store.dispatch("Invoices/getExpenseAccounts");

        },
        methods: {

            createInvoiceItem () {

                this.$store.dispatch("Invoices/createInvoiceItem", this.invoiceItem)
                .then(() => {

                    this.invoiceItem = Object.assign({}, this.defaultInvoiceItem);

                });

            },
            deleteInvoiceItem (item) {

                this.$store.dispatch("Invoices/deleteInvoiceItem", item);

            },
            createInvoice () {

                this.$store.dispatch("Invoices/createAndUploadInvoice");

            },
            downloadInvoice () {

                this.$store.dispatch("Invoices/downloadInvoice");

            },
            expenseAccountsLookUp (accountID) {

                return this.expenseAccounts.find(account => account.accountID === accountID).accountName;

            },
            close () {

                this.$store.dispatch("Dialogs/showDialog", { name: "createInvoice", visibility: false });

            }

        }
    };
</script>

<style scoped>

</style>
