<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Header from "@/Pages/User/Header.vue";
</script>

<template class="w-full">
    <Header/>
    <div class="flex  flex-wrap mx-auto  w-full bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div class="w-full  bg-stone-100 px-6 py-4 shadow-md  sm:rounded-lg dark:bg-gray-800">
            <slot />
        </div>
    </div>
</template>
