<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
</script>

<template>
    <AppLayout title="Articles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles
                <Link
                    :href="route('new-article')"
                    class="text-sm float-right font-semibold bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-700 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900"
                >
                    Add A New Article
                </Link>
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    v-if="articleCreated !== null && isShown"
                    class="bg-green-600 mb-2 rounded-md"
                >
                    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                        <div
                            class="flex items-center justify-between flex-wrap"
                        >
                            <div class="w-0 flex-1 flex items-center">
                                <p class="ml-3 font-medium text-white truncate">
                                    <span class="hidden md:inline">{{
                                        articleCreated
                                    }}</span>
                                </p>
                            </div>
                            <div
                                class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto"
                            >
                                <Link
                                    :href="route('new-article')"
                                    class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50"
                                >
                                    Add Another One !
                                </Link>
                            </div>
                            <div
                                class="order-2 flex-shrink-0 sm:order-3 sm:ml-3"
                            >
                                <button
                                    type="button"
                                    class="-mr-1 flex p-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2"
                                >
                                    <span @click="hide()" class="sr-only"
                                        >Dismiss</span
                                    >
                                    <span
                                        @click="hide()"
                                        class="h-6 w-6 text-white"
                                    >
                                        &times;
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-if="
                        typeof ActiveArticles.data == 'undefined' ||
                        ActiveArticles.data.length === 0
                    "
                >
                    <div class="bg-gray-600 mb-2 rounded-md p-5 text-white">
                        No Articles Here Yet!
                    </div>
                </div>
                <div v-if="isLoading">Working on it.... Please Wait !</div>
                <div v-else class="grid grid-cols-3 gap-3">
                    <div
                        v-for="article in ActiveArticles.data"
                        :key="article.id"
                        class="bg-white p-5 rounded-lg"
                    >
                        <h3 class="text-lg font-bold">{{ article.title }}</h3>
                        <p class="mt-4 text-sm leading-4 text-zinc-700">
                            {{
                                article.content.length > 230
                                    ? article.content.slice(0, 220) + "...."
                                    : article.content
                            }}
                        </p>
                    </div>
                </div>
            </div>
            <pagination
                class="mt-6"
                :chnageHndler="addnewpage"
                :activelink="activepage"
                :links="articles.links"
            />
        </div>
    </AppLayout>
</template>
<script>
import Pagination from "@/Components/Pagination";
export default {
    components: {
        Pagination,
    },
    data() {
        return {
            activepage: 1,
            isShown: true,
            isLoading: false,
            loadedPages: [],
            ActiveArticles: [],
        };
    },
    // actions
    methods: {
        hide() {
            // hide the alert message
            this.isShown = false;
        },
        articlesupdater(data) {
            // update the articles
            this.articles = data;
        },
        addnewpage(url) {
            // change page without reloading old data
            const convertedurl = new URL(url);
            const page = convertedurl.searchParams.get("page");
            this.activepage = page;
            if (!this.loadedPages[page]) {
                this.isLoading = true;
                fetch(url + "&request=api")
                    .then((response) => response.json())
                    .then((data) => {
                        this.loadedPages[page] = data;
                        this.ActiveArticles = data;
                        this.isLoading = false;
                    })
                    .catch((err) => console.error(err));
            } else {
                this.ActiveArticles = this.loadedPages[page];
            }
        },
    },
    props: {
        articles: Object,
        articleCreated: String,
    },
    mounted() {
        this.loadedPages[this.articles.current_page] = this.articles;
        this.ActiveArticles = this.articles;
    },
};
</script>
