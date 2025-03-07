

<template>
    <AppLayout title="Mes Adresses">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes Adresses
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Mes Adresses</h1>

                <div v-if="addresses.length === 0" class="text-center py-12">
                    <p class="text-gray-500">Vous n'avez pas encore d'adresses enregistrées.</p>
                    <Link
                        :href="route('addresses.create')"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Ajouter une adresse
                    </Link>
                </div>

                <div v-else class="space-y-6">
                    <div v-for="address in addresses" :key="address.id" class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ address.street }}
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        {{ address.city }}, {{ address.postal_code }}
                                    </p>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        {{ address.country }}
                                    </p>
                                </div>
                                <div>
                                    <span v-if="address.is_default" class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                        Par défaut
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <div class="flex justify-end space-x-3">
                                <Link
                                    :href="route('addresses.edit', address.id)"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Modifier
                                </Link>
                                <Link
                                    :href="route('addresses.destroy', address.id)"
                                    method="delete"
                                    as="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                >
                                    Supprimer
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 
<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    addresses: {
        type: Array,
        required: true
    }
});
</script> 