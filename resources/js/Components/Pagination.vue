<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <div v-if="links.length > 3">
        <div class="mb-1 flex flex-wrap justify-center	">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-green-800 focus:border-green-500 focus:text-green-500"
                    :class="{ 'bg-green-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        links: Array
    },
}
</script>