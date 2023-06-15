<template>
<v-app>
    <v-app-bar :elevation="4" color="blue-grey-darken-4">
        <v-toolbar-title>LaraEC</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-app-bar>

    <v-main>
        <v-container>
            <router-view></router-view>
        </v-container>
    </v-main>

</v-app>
</template>

<script setup>
</script>

<style scoped>
.v-toolbar-title {
    font-size: 25px;
}
</style>