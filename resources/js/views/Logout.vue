<template>
    <div id="logout">
        <v-app>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout justify-center align-center>
                        <v-flex md4>
                            <v-card>
                                <v-card-text class="text-sm-center">
                                    <p class="subheading">You have logged out. To login again, click on the button below</p>
                                    <p><v-btn class="info" to="/login">Login</v-btn></p>
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

        name: "Logout"

    };
</script>

<style scoped>

</style>