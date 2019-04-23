<template>
    <div id="index">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App",
    created () {

        this.$store.commit("INITIALIZE_STATE");

    }
};
</script>

<style>

</style>
