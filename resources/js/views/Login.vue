<template>
    <div id="login">
        <v-app>
            <v-content class="grey lighten-2">
                <v-alert :value="alert" class="subheading success">You have logged out</v-alert>
                <v-container fluid fill-height>
                    <v-layout justify-center align-center>
                        <v-flex sm4>
                    <v-card>
                        <v-card-title class="dark_primary">
                            <span class="headline white--text">Login</span>
                        </v-card-title>
                        <v-form @submit.prevent="validate">
                            <v-card-text>
                                <v-text-field
                                    v-model="email"
                                    v-validate="'required'"
                                    data-vv-name="email"
                                    :error-messages="errors.collect('email')"
                                    label="Email"
                                    name="email"
                                    type="text"
                                >
                                </v-text-field>
                                <v-text-field
                                    v-model="password"
                                    v-validate="'required'"
                                    data-vv-name="password"
                                    :error-messages="errors.collect('password')"
                                    label="Password"
                                    name="password"
                                    type="password"
                                >
                                </v-text-field>
                            </v-card-text>
                            <v-card-text v-if="authenticatingError">
                                <p class="subheading primary--text">{{ authenticatingError }}</p>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn class="info" :loading="isAuthenticating" type="submit">Login</v-btn>
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
            password: "",
            remember: false,
            authenticatingError: "",
            isAuthenticating: false,
            dictionary: {
                custom: {
                    email: {
                        required: "Enter your email",
                    },
                    password: {
                        required: "Enter your password",
                    },
                }
            }
        };

    },
    computed: {

        alert () {

            return this.$route.query.action === "logout";

        },
        url () {

            return this.$router.currentRoute.query.url;

        }
    },
    mounted () {

        this.$validator.localize("en", this.dictionary);

    },
    methods: {
        validate () {

            this.$validator.validateAll().then((result) => {

                if (result) {

                    this.login();

                }

            });

        },

        login () {

            this.isAuthenticating = true;
            this.$store.dispatch("Authentications/login", { email: this.email, password: this.password })
                    .then(() => {

                        let role = this.$store.getters["Authentications/role"];

                        if (role === "admin") {

                            if (this.url !== undefined) {

                                this.$router.push(this.url);

                            } else {

                                this.$router.push({ name: "Dashboard" });

                            }

                        } else {

                            if (this.url !== undefined) {

                                this.$router.push(this.url);

                            } else {

                                this.$router.push({ name: "UserDashboard" });

                            }

                        }

                    })
                    .catch((errors) => {

                        if (errors.status === 401) {

                            this.authenticatingError = "Incorrect email or password";

                        }
                        this.$store.dispatch("Authentications/resetAuthentication");

                    })
                    .then(() => {

                        this.isAuthenticating = false;

                    });

        }
    },
};
</script>

<style>

</style>
