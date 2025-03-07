<template>
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-center mb-8">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Merci pour votre commande !</h1>
                <p class="text-green-600 mt-2">Votre commande a été enregistrée avec succès</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Détails de la commande</h2>
                    <div class="space-y-2">
                        <p><span class="font-medium">Numéro de commande :</span> #{{ order.id }}</p>
                        <p><span class="font-medium">Date :</span> {{ new Date(order.created_at).toLocaleDateString('fr-FR') }}</p>
                        <p><span class="font-medium">Statut :</span> 
                            <span class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                                En attente
                            </span>
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Adresse de livraison</h2>
                    <div class="space-y-1">
                        <p>{{ order.address }}</p>
                        <p>{{ order.postal_code }} {{ order.city }}</p>
                        <p>{{ order.country }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Articles commandés</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix unitaire</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in order.items" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img v-if="item.product.image" :src="item.product.image" :alt="item.product.name" class="h-10 w-10 rounded-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ item.product.name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ item.quantity }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ item.price }}€</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ (item.price * item.quantity).toFixed(2) }}€</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <div class="text-right">
                    <p class="text-lg font-semibold">Total de la commande : {{ order.total_amount }}€</p>
                </div>
            </div>

            <div class="mt-8 text-center">
                <Link
                    :href="route('products')"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Retour à la boutique
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    order: {
        type: Object,
        required: true
    }
});
</script> 