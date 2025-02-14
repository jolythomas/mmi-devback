<script setup>
import { router } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'

const props = defineProps({
    product: Object,
    similarProducts: Array
})

const addToCart = () => {
    router.post(route('cart.add', props.product.id), {
        quantity: 1
    }, {
        preserveScroll: true,
        onSuccess: () => {
            alert('Produit ajouté au panier')
        }
    })
}
</script>

<template>
    <Section :title="product.name">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                        <!-- Image du produit -->
                        <div class="relative">
                            <img :src="product.image_url" :alt="product.name" class="w-full h-96 object-cover rounded-lg">
                        </div>

                        <!-- Informations du produit -->
                        <div class="space-y-6">
                            <h1 class="text-3xl font-bold text-gray-900 capitalize">{{ product.name }}</h1>
                            <p class="text-gray-600">{{ product.description }}</p>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-blue-600">{{ product.price }}€</span>
                                <span class="text-sm text-gray-500">
                                    Stock: {{ product.stock }} unités disponibles
                                </span>
                            </div>

                            <button 
                                @click="addToCart"
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors"
                                :disabled="product.stock === 0"
                            >
                                {{ product.stock === 0 ? 'Rupture de stock' : 'Ajouter au panier' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</template> 