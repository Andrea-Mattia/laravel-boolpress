// Dipendenze
import Vue from "vue";
import VueRouter from "vue-router";

// Componenti per le pagine
import Home from "./pages/Home.vue";
import About from "./pages/About.vue";
import Blog from "./pages/Blog.vue";

// Registrazione del router con vue
Vue.use(VueRouter);

// Definizione rotte app
const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/blog",
            name: "blog",
            component: Blog
        }
    ]
});

export default router;
