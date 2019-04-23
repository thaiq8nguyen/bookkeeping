<template>
    <div id="dashboard">
        <v-app>
            <top-navigation-bar :title="'Dashboard'"></top-navigation-bar>
            <v-content>
                <recent-transactions></recent-transactions>
            </v-content>
            <v-dialog
                v-model="createInvoiceDialog"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
                >
                <v-card>
                    <create-invoice></create-invoice>
                </v-card>
            </v-dialog>
        </v-app>
    </div>
</template>

<script>
    import TopNavigationBar from "Components/TopNavigationBar";
    import RecentTransactions from "Components/RecentTransactions";
    import CreateInvoice from "Components/CreateInvoice";

    export default {
        name: "Dashboard",
        components: { TopNavigationBar, RecentTransactions, CreateInvoice },
        data () {

            return {

            };

        },
        computed: {
            createInvoiceDialog () {

                return this.$store.getters["Dialogs/showCreateInvoiceDialog"];

            }
        },
        mounted () {
        },
        methods: {

        }
    };
</script>

<style scoped>

</style>
