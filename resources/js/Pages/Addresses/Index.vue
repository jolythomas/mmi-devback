<script setup>
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    addresses: Array,
});
</script>

<template>
    <AppLayout title="Mes Adresses">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes Adresses
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Liste de mes adresses</h3>
                        <Link
                            :href="route('addresses.create')"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                        >
                            Ajouter une adresse
                        </Link>
                    </div>

                    <div v-if="addresses.length === 0" class="text-center py-8">
                        <p class="text-gray-500">Vous n'avez pas encore d'adresses enregistrées.</p>
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="address in addresses" :key="address.id" class="border rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ address.street }}</h4>
                                    <p class="text-sm text-gray-500">{{ address.city }}, {{ address.postal_code }}</p>
                                    <p class="text-sm text-gray-500">{{ address.country }}</p>
                                </div>
                                <span v-if="address.is_default" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Par défaut
                                </span>
                            </div>
                            <div class="flex justify-end space-x-2 mt-4">
                                <Link
                                    :href="route('addresses.edit', address.id)"
                                    class="text-sm text-indigo-600 hover:text-indigo-900"
                                >
                                    Modifier
                                </Link>
                                <Link
                                    :href="route('addresses.destroy', address.id)"
                                    method="delete"
                                    as="button"
                                    class="text-sm text-red-600 hover:text-red-900"
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