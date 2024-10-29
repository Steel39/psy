<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    </div>
                </div>
                <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { provide, ref } from "vue";


const status = ref('Создаем новый пост =)')
provide('status', {
    status
})

</script>
