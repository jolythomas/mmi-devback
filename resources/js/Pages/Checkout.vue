<template>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Finaliser la commande</h1>
        
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Choisir une adresse existante</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            v-model="form.use_existing_address"
                            :value="true"
                            class="form-radio"
                            @change="handleAddressChange"
                        />
                        <span class="ml-2">Utiliser une adresse existante</span>
                    </label>
                </div>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input
                            type="radio"
                            v-model="form.use_existing_address"
                            :value="false"
                            class="form-radio"
                            @change="handleAddressChange"
                        />
                        <span class="ml-2">Saisir une nouvelle adresse</span>
                    </label>
                </div>
            </div>

            <div v-if="form.use_existing_address">
                <label class="block text-sm font-medium text-gray-700">Adresse existante</label>
                <select
                    v-model="form.address_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                    @change="handleAddressChange"
                >
                    <option value="">Sélectionnez une adresse</option>
                    <option v-for="address in addresses" :key="address.id" :value="address.id">
                        {{ address.address }}, {{ address.city }} {{ address.postal_code }}
                    </option>
                </select>
            </div>

            <div v-else>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input
                        v-model="form.address"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ville</label>
                    <input
                        v-model="form.city"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Code postal</label>
                    <input
                        v-model="form.postal_code"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pays</label>
                    <input
                        v-model="form.country"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    />
                </div>
            </div>

            <div class="text-xl font-bold">
                Total: {{ total }}€
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Traitement...' : 'Confirmer la commande' }}
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    total: Number,
    addresses: Array
});

const form = useForm({
    use_existing_address: true,
    address_id: '',
    address: '',
    city: '',
    postal_code: '',
    country: ''
});

const handleAddressChange = () => {
    if (form.use_existing_address && form.address_id) {
        const selectedAddress = props.addresses.find(addr => addr.id === form.address_id);
        if (selectedAddress) {
            form.address = selectedAddress.address;
            form.city = selectedAddress.city;
            form.postal_code = selectedAddress.postal_code;
            form.country = selectedAddress.country;
        }
    } else {
        form.address = '';
        form.city = '';
        form.postal_code = '';
        form.country = '';
        form.address_id = '';
    }
};

const submit = () => {
    form.post(route('orders.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // La redirection sera gérée automatiquement par Inertia
        },
        onError: (errors) => {
            console.error('Erreurs de validation:', errors);
        }
    });
};
</script> 