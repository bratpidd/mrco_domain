<template>
    <div id="app">
        <a href="/">Home</a>
        <!--router-link v-bind:to="'/vue_retarded'">Home (Bullshit)</router-link>
        -->
        <router-link v-bind:to="'/vue_retarded/about'">About</router-link>
        <!-- the router outlet, where all matched components would ber viewed -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'app',
    }
</script>
<!-- styling for the component -->
<style>

    #app {
        font-family: 'Raleway', 'sans-serif';
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

</style>