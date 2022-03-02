<template>
    <div>
        <Header />

        <main>
            <h1>WORK IN FROGRESS</h1>
        </main>

        <footer>
            FOOTER HERE
        </footer>
    </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    name: "App",
    components: {
        Header
    }
};
</script>

<style lang="scss">
body {
    font-family: sans-serif;
}
</style>
