<template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Mes commandes</h1>

            <div v-if="orders.length === 0" class="text-center py-12">
                <p class="text-gray-500">Vous n'avez pas encore de commandes.</p>
                <Link
                    :href="route('products.index')"
                    class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Voir les produits
                </Link>
            </div>

            <div v-else class="space-y-6">
                <div v-for="order in orders" :key="order.id" class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Commande #{{ order.id }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    {{ new Date(order.created_at).toLocaleDateString('fr-FR') }}
                                </p>
                            </div>
                            <div>
                                <span class="px-2 py-1 text-sm rounded-full" :class="{
                                    'bg-yellow-100 text-yellow-800': order.status === 'pending',
                                    'bg-blue-100 text-blue-800': order.status === 'processing',
                                    'bg-green-100 text-green-800': order.status === 'completed',
                                    'bg-red-100 text-red-800': order.status === 'cancelled'
                                }">
                                    {{ order.status }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Adresse de livraison</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ order.address }}<br>
                                    {{ order.postal_code }} {{ order.city }}<br>
                                    {{ order.country }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Articles</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <ul class="divide-y divide-gray-200">
                                        <li v-for="item in order.items" :key="item.id" class="py-3">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img v-if="item.product.image" :src="item.product.image" :alt="item.product.name" class="h-10 w-10 rounded-full object-cover">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ item.product.name }}</div>
                                                        <div class="text-sm text-gray-500">Quantité: {{ item.quantity }}</div>
                                                    </div>
                                                </div>
                                                <div class="text-sm text-gray-900">{{ (item.price * item.quantity).toFixed(2) }}€</div>
                                            </div>
                                        </li>
                                    </ul>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Total</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ order.total_amount }}€
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    orders: {
        type: Array,
        required: true
    }
});
</script> 