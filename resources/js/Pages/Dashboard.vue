<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {provide, ref} from "vue";
import StatusWindow from "@/Components/StatusWindow.vue";
const status = ref('Good day');

function click() {
    status.value = 'click'
}
provide('status', {
    click,
    status
})


</script>

<template>
    <AuthenticatedLayout>
    <Head title="Dashboard" />


        <template #header>
            <h2
                class="text-xl font-semibold leading-tight bg-gray-800 text-gray-800 dark:text-gray-200"

            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg bg-gray-300 dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button @click="click">
                            Click
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
