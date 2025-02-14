<script setup>
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'

const props = defineProps({
    category: Object,
    products: Array
})

const addToCart = (product) => {
    router.post(route('cart.add', product.id), {
        quantity: 1
    }, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Produit ajouté au panier')
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
    <Section :title="category.name">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Description de la catégorie -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <p class="text-gray-600">{{ category.description }}</p>
                    <div class="mt-4">
                        <span :class="[getCategoryColor(category.id), 'px-3 py-1 rounded-full text-white text-sm']">
                            {{ products.length }} produits
                        </span>
                    </div>
                </div>

                <!-- Grille de produits -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="product in products" :key="product.id" 
                        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <Link :href="route('products.show', product.id)">
                            <img :src="product.image_url" :alt="product.name" class="w-full h-48 object-cover">
                        </Link>
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">{{ product.name }}</h3>
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

                <!-- Lien retour -->
                <div class="mt-8 text-center">
                    <Link 
                        :href="route('categories')" 
                        class="text-blue-600 hover:text-blue-800 font-medium"
                    >
                        ← Retour aux catégories
                    </Link>
                </div>
            </div>
        </div>
    </Section>
</template> 