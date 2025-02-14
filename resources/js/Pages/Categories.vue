<script setup>
import { Link } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'

defineProps({
    categories: Array
})

const getCategoryColor = (categoryId) => {
    const colors = {
        1: 'bg-red-500',
        2: 'bg-blue-500',
        3: 'bg-green-500',
        4: 'bg-purple-500',
        5: 'bg-yellow-500',
        6: 'bg-pink-500',
        7: 'bg-indigo-500',
        8: 'bg-orange-500',
    }
    return colors[categoryId] || 'bg-gray-500'
}
</script>


<template>
    <Section title="Catégories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="category in categories" :key="category.id" 
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-gray-800 capitalize">{{ category.name }}</h3>
                                <span :class="[getCategoryColor(category.id), 'px-3 py-1 rounded-full text-white text-sm']">
                                    {{ category.products_count || 0 }} produits
                                </span>
                            </div>
                            
                            <p class="text-gray-600 flex-1">{{ category.description }}</p>
                            
                            <Link 
                                :href="route('categories.show', category.id)" 
                                class="mt-6 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700"
                            >
                                Voir les produits
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</template>
