<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <div v-if="links.length > 3">
        <div class="mb-1 flex flex-wrap justify-center">
            <template v-for="(link, p) in links" :key="p">
                <div
                    v-if="link.url == null"
                    v-bind:class="p == 0 || p == linksLength ? 'hidden' : ''"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="linksLength + ' ' + link.label"
                />
                <span
                    @click="chnageHndler(link.url)"
                    v-else
                    v-bind:class="p == 0 || p == (linksLength - 1) ? 'hidden' : ''"
                    class="mr-1 cursor-pointer mb-1 px-4 py-3 text-sm leading-4 border rounded hover:text-white hover:bg-green-800 focus:border-green-500 focus:text-green-500"
                    :class="{ 'bg-green-700 text-white': p == activelink }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            linksLength: 0,
        };
    },
    props: {
        links: Array,
        chnageHndler: { type: Function },
        activelink: Number,
    },
    mounted() {
        this.linksLength = this.links.length;
    },
};
</script>
