<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    products: {
        type: String,
        required: true,
    },
});

</script>


<template>
<AppLayout>
    <div>
        <li v-for="product in products" :key="products.id">
            <a href="products">
                <p>{{product.name}}</p>
            </a>
        </li>
    </div>
</AppLayout>
</template>
