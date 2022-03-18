<template>
    <div>
        <Header />

        <main>
            <div class="container">
                <h1>Blog</h1>

                <!-- Print posts -->
                <article v-for="post in posts" :key="post.id">
                    <h2>{{ post.title }}</h2>
                    <div class="excerpt">
                        Excerpt goes here
                    </div>
                    <div>{{ post.created_at }}</div>
                    <!-- Go to detail page -->
                    <a href="">Read more</a>
                </article>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script>
import axios from "axios";
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

export default {
    name: "App",
    components: {
        Header,
        Footer
    },
    data() {
        return {
            api: "http://127.0.0.1:8000/api/posts",
            posts: []
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios
                .get(this.api)
                .then(res => {
                    this.posts = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss">
@import "../sass/frontoffice/_utilities.scss";
body {
    font-family: sans-serif;
    article {
        .excerpt {
            margin: 1rem auto;
        }
    }
}
</style>
