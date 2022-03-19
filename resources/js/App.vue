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
                        {{ post.excerpt }}
                    </div>
                    <div>{{ formatDate(post.created_at) }}</div>
                    <!-- Go to detail page -->
                    <a href="">Read more</a>
                </article>

                <!-- NAVIGATION -->
                <section class="navigation">
                    <button
                        v-show="pagination.current > 1"
                        @click="getPosts(pagination.current - 1)"
                    >
                        Prev
                    </button>
                    <button
                        v-for="i in pagination.last"
                        :key="`page-${i}`"
                        @click="getPosts(i)"
                        :class="{ 'active-page': i == pagination.current }"
                    >
                        {{ i }}
                    </button>
                    <button
                        v-show="pagination.current < pagination.last"
                        @click="getPosts(pagination.current + 1)"
                    >
                        Next
                    </button>
                </section>
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
        getPosts(page = 1) {
            // Get posts from api
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {
                    console.log(res.data);
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    };
                })
                .catch(err => {
                    console.log(err);
                });
        },
        formatDate(date) {
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            const year = postDate.getFullYear();

            if (day < 10) {
                day = "0" + day;
            }

            if (month < 10) {
                month = "0" + month;
            }

            return `${day}/${month}/${year}`;
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
