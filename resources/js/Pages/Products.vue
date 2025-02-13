<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'

const props = defineProps({
    products: Array,
    categories: Array
})

const search = ref('')
const selectedCategory = ref('')

const filteredProducts = computed(() => {
    return props.products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(search.value.toLowerCase())
        const matchesCategory = !selectedCategory.value || product.category?.id === parseInt(selectedCategory.value)
        return matchesSearch && matchesCategory
    })
})

const addToCart = (product) => {
    router.post(route('cart.add', product.id), {
        quantity: 1
    }, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Produit ajouté au panier')
        },
        onError: (errors) => {
            console.error(errors)
            alert('Erreur lors de l\'ajout au panier')
        }
    })
}

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
    <Section title="Nos Produits">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Filtres -->
                <div class="mb-8 flex flex-wrap gap-4">
                    <input 
                        type="text" 
                        v-model="search" 
                        placeholder="Rechercher un produit..." 
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <select 
                        v-model="selectedCategory" 
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Toutes les catégories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Grille de produits -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="product in filteredProducts" :key="product.id" 
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <img :src="product.image_url" :alt="product.name" class="w-full h-48 object-cover">
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">{{ product.name }}</h3>
                                <span 
                                    v-if="product.category"
                                    :class="[getCategoryColor(product.category.id), 'px-2 py-1 rounded-full text-white text-xs']"
                                >
                                    {{ product.category.name }}
                                </span>
                            </div>
                            <p class="text-gray-600 mt-2 text-sm line-clamp-2">{{ product.description }}</p>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xl font-bold text-blue-600">{{ product.price }}€</span>
                                <button 
                                    @click="addToCart(product)"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                                >
                                    Ajouter au panier
                                </button>
                            </div>
                            
                            <div class="mt-2 text-sm text-gray-500">
                                Stock: {{ product.stock }} unités
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</template>
