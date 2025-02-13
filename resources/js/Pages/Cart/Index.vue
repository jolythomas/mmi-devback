<template>
    <Section title="Mon Panier">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-6">Mon Panier</h2>
                    
                    <div v-if="cartItems.length > 0">
                        <div class="space-y-4">
                            <div v-for="item in cartItems" :key="item.id" class="flex items-center justify-between border-b pb-4">
                                <div class="flex items-center space-x-4">
                                    <img :src="item.product.image" class="w-20 h-20 object-cover rounded" />
                                    <div>
                                        <h3 class="font-semibold">{{ item.product.name }}</h3>
                                        <p class="text-gray-600">{{ item.price }}€</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-4">
                                    <input 
                                        type="number" 
                                        v-model="item.quantity"
                                        @change="updateQuantity(item)"
                                        min="1"
                                        :max="item.product.stock"
                                        class="w-20 border rounded p-1"
                                    />
                                    <button @click="removeItem(item.id)" class="text-red-600">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-right">
                            <p class="text-xl font-bold">
                                Total: {{ calculateTotal }}€
                            </p>
                            <button class="mt-4 bg-blue-600 text-white px-6 py-2 rounded">
                                Procéder au paiement
                            </button>
                        </div>
                    </div>
                    
                    <div v-else class="text-center py-12">
                        <p class="text-gray-500">Votre panier est vide</p>
                        <Link :href="route('products')" class="text-blue-600 hover:underline">
                            Continuer vos achats
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import Section from '@/Components/Section.vue'
import { computed } from 'vue'

const props = defineProps({
    cartItems: Array
})

const calculateTotal = computed(() => {
    if (!props.cartItems || !props.cartItems.length) return 0
    return props.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0)
})

const removeItem = (itemId) => {
    router.delete(route('cart.remove', itemId))
}

const updateQuantity = (item) => {
    router.patch(route('cart.update', item.id), {
        quantity: item.quantity
    })
}
</script> 