<template>
    <div>
        <Head :title="title" />
        
        <div class="min-h-screen bg-gray-100">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ title }}
                    </h1>
                </div>
            </header>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
    title: String
})
</script> 