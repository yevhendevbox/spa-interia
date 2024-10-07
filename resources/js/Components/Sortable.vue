<script setup>
import { computed } from 'vue';
import { router } from "@inertiajs/vue3";

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    }
})


const sortClass = computed(() => {
    const urlParams = new URLSearchParams(window.location.search)
    let sortBy = urlParams.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)
    return sortBy.replace(/^\-+/, "") === props.name ?
        (sortDir === '-' ? 'desc' : 'asc') :
        ""
})

function navigate () {
    const urlParams = new URLSearchParams(window.location.search)
    let sortBy = urlParams.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)
    sortBy = !sortBy || sortDir === '-' ? props.name : `-${props.name}`
    urlParams.set('sort_by', sortBy)
    const params = Object.fromEntries(urlParams.entries())
    router.get(route(route().current()), params)
}
</script>

<template>
    <a href="#" class="sortable" @click.prevent="navigate">{{ props.label }}</a>
</template>

<style scoped>

</style>
