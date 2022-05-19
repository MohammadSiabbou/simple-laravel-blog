<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ArticleCard from '@/Components/ArticleCard.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import JetInput from '@/Jetstream/Input.vue';
</script>

<template>
    <AppLayout title="Articles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles
                <Link :href="route('articles')"
                    class="text-sm float-right font-semibold bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-700 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900">
                Show Articles
                </Link>
            </h2>
        </template>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Creat a New Article !</h2>
                </div>
                <div v-if="errors !== undefined && (errors.title || errors.content)" class="bg-red-500 p-4 rounded-lg">
                    <div v-if="errors.title" class="text-white">{{ errors.title }}</div>
                    <div v-if="errors.content" class="text-white">{{ errors.content }}</div>
                </div>
                <form class="mt-8 space-y-6" @submit.prevent="submit">
                    <input type="hidden" name="remember" value="true" />
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label class="sr-only">Title </label>
                            <JetInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"
                                placeholder="Title" required autofocus />
                        </div>
                        <div>

                            <label for="content" class="sr-only">Content</label>
                            <textarea rows="10" v-model="form.content" placeholder="Wha't On Your Mind...."
                                class="mt-2 appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
<script>
export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            form: {
                title: null,
                content: null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/new-article', this.form)
        },
    },
}
</script>