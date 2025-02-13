<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    categories: {
        type: String,
        required: true,
    },
});

</script>


<template>
<AppLayout>
    <div>
        <li v-for="categorie in categories" :key="categories.id">
            <a href="categories">
                <p>{{categorie.name}}</p>
            </a>
        </li>
    </div>
</AppLayout>
</template>
