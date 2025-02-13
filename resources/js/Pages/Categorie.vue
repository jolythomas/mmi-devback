<script setup>
import { Link } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'

defineProps({
    categories: Array
})
</script>


<template>
    <Section title="Catégories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="category in categories" :key="category.id" 
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <Link :href="route('categories.show', category.id)">
                            <img 
                                :src="category.image" 
                                :alt="category.name" 
                                class="w-full h-48 object-cover"
                            >
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800">{{ category.name }}</h3>
                                <p class="mt-2 text-gray-600">{{ category.description }}</p>
                                
                                <div class="mt-4 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                    </svg>
                                    {{ category.products_count }} produits
                                </div>
                                
                                <div class="mt-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Voir les produits
                                    </span>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</template>
