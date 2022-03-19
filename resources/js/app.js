/**
 * FRONT OFFICE
 */

window.Vue = require("vue");

import App from "./App.vue";
import router from "./routes";

// Creating new Vue instance
const root = new Vue({
    el: "#root",
    router,
    render: h => h(App)
});
