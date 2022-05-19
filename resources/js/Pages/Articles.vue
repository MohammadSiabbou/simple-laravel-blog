<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
</script>

<template>
    <AppLayout title="Articles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles
                <Link :href="route('new-article')"
                    class="text-sm float-right font-semibold bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-700 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900">
                Add A New Article
                </Link>
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="articleCreated !== null && isShown" class="bg-green-600 mb-2 rounded-md">
                    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between flex-wrap">
                            <div class="w-0 flex-1 flex items-center">
                                <p class="ml-3 font-medium text-white truncate">
                                    <span class="hidden md:inline">{{ articleCreated }}</span>
                                </p>
                            </div>
                            <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                <Link :href="route('new-article')"
                                    class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-green-50">
                                Add Another One ! </Link>
                            </div>
                            <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                                <button type="button"
                                    class="-mr-1 flex p-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                                    <span @click="hide()" class="sr-only">Dismiss</span>
                                    <span @click="hide()" class="h-6 w-6 text-white">
                                        &times;
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div v-for="article in articles.data" :key="article.id" class="bg-white p-5 rounded-lg">
                        <h3 class="text-lg font-bold">{{ article.title }}</h3>
                        <p class="mt-4 text-sm leading-4 text-zinc-700">
                            {{ article.content.length > 230 ? article.content.slice(0, 220) + "...." : article.content }}
                        </p>
                    </div>
                </div>
            </div>
            <pagination class="mt-6" :links="articles.links" />
        </div>
    </AppLayout>
</template>
<script>
import Pagination from '@/Components/Pagination'
export default {
    components: {
        Pagination
    },
    data() {
        return {
            isShown: true
        }
    },
    // actions
    methods: {
        hide() {
            this.isShown = false
        }
    },
    props: {
        articles: Object,
        articleCreated: String,
    },
}
</script>