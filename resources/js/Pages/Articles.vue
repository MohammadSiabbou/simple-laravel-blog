<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ArticleCard from '@/Components/ArticleCard.vue';
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
                <div class="grid grid-cols-3 gap-3">
                    <div v-for="article in articles.data" :key="article.id" class="bg-white p-5 rounded-md">
                        <h3 class="text-lg font-bold">{{ article.title }}</h3>
                        <p class="mt-4 text-sm leading-4 text-zinc-700">{{ article.content }}</p>
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
    props: {
        articles: Object,
    },
}
</script>