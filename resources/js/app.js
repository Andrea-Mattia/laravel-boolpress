/**
 * FRONT OFFICE
 */

window.Vue = require("vue");

import App from "./App.vue";

// Creating new Vue instance
const root = new Vue({
    el: "#root",
    render: h => h(App)
});
