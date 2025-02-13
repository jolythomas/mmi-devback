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

        <!-- Hero Section -->
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
                <a
                class="block w-full rounded-sm bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-3 focus:outline-hidden sm:w-auto"
                href="#"
                >
                Découvrir
                </a>


            
            </div>
            </div>
        </div>
    </section>

        <!-- Featured Products -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Produits en vedette</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <!-- Product Card -->
                <div v-for="product in products.slice(0, 4)" :key="product.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="aspect-w-3 aspect-h-4">
                        <img :src="product.image_url || 'https://via.placeholder.com/300'" :alt="product.name" class="w-full h-64 object-cover" />
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ product.name }}</h3>
                        <p class="text-gray-500 mt-1">{{ product.description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-900 font-bold">{{ product.price }} €</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-gray-50 py-12" >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Nos catégories</h2>
                <div class="flex flex-wrap gap-4">
                    <div 
                        v-for="category in categories" 
                        :key="category.id" 
                        class="px-4 py-2 bg-white rounded-full shadow-sm border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition-colors cursor-pointer"
                    >
                        <span class="text-gray-700 font-medium">{{ category.name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="bg-blue-600 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-white mb-4">
                        Inscrivez-vous à notre newsletter
                    </h2>
                    <div class="max-w-md mx-auto">
                        <div class="flex gap-2">
                            <input type="email" placeholder="Votre email" class="flex-1 px-4 py-2 rounded-md" />
                            <button class="bg-white text-blue-600 px-6 py-2 rounded-md font-semibold">
                                S'inscrire
                            </button>
                        </div>
                    </div>
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
