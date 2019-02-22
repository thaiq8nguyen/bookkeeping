<template>
    <div id="login">
        <v-app>
            <v-content>
                <v-container fluid fill-height>
            <v-layout justify-center align-center>
                <v-flex sm4>
                    <v-card>
                        <v-card-title class="dark_primary">
                            <span class="headline white--text">Login</span>
                        </v-card-title>
                        <v-form>
                            <v-card-text>
                                <v-text-field
                                    v-model="email"
                                    label="Email"
                                >
                                </v-text-field>
                                <v-text-field
                                    v-model="password"
                                    label="Password"
                                >
                                </v-text-field>
                            </v-card-text>
                            <v-card-text v-if="errorMessage">
                                <p class="danger--text">{{ errorMessage }}</p>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn class="info" :loading="isAuthenticating" @click.prevent="login">Login</v-btn>
                            </v-card-actions>
                        </v-form>
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
    name: "Login",
    data () {

        return {
            email: "",
            password: ""
        };
    
    },
    computed: {
        
        isAuthenticating () {

            return this.$store.getters["Authentications/isAuthenticating"];

        },

        errorMessage () {

            return this.$store.getters["Authentications/errorMessage"];
        
}
    },
    created () {

        this.$store.dispatch("Authentications/init");

    },
    methods: {
        
        login () {

            this.$store.dispatch("Authentications/login", { email: this.email, password: this.password });

        }
    },
};
</script>

<style>

</style>
