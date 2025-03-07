<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    products: {
        type: Array,
        required: true,
    }
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Boutique en ligne" />
    
    <div class="min-h-screen bg-gray-100">

    <section class="bg-gray-50 header">
        <div class="mx-auto max-w-screen-xl px-4 py-32 lg:flex lg:h-screen lg:items-center">
            <div class="mx-auto max-w-xl text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Découvrez nos produits et
                <strong class="font-extrabold text-blue-700 sm:block"> nos meilleures offres. </strong>
            </h1>

            <p class="mt-4 sm:text-xl/relaxed">
                Laissez vous tenter par notre gamme de produits de qualité. Naviguez parmis les différentes catégories et découvrez les meilleures offres.
            </p>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <Link
                    class="block w-full rounded-lg bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-3 focus:outline-hidden sm:w-auto"
                    :href="route('products')"
                    >
                    Découvrir
                    </Link>
                </div>
            </div>
        </div>
    </section>

        <div class="bg-gray-50 py-12" >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Nos catégories</h2>
                <div class="flex flex-wrap gap-4">
                    <Link 
                        v-for="category in categories" 
                        :key="category.id" 
                        :href="route('categories.show', category.id)"
                        class="px-4 py-2 bg-white rounded-full shadow-sm border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition-colors"
                    >
                        <span class="text-gray-700 font-medium">{{ category.name }}</span>
                    </Link>
                </div>
            </div>
        </div>

    </div>

</template>

<style scoped>
.header {
  background: radial-gradient(circle at 70% 10%, rgba(0, 123, 255, 0.15) 0%, transparent 70%),
              radial-gradient(circle at 80% 20%, rgba(0, 123, 255, 0.12) 0%, transparent 50%);
}
</style>
