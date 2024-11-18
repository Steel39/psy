<template>
    <GuestLayout>
        <div class="mx-auto max-w-7xl mt-10 sm:px-6 lg:px-8 ">
                <div v-for="certificate in certificates" class=" bg-gray-200/90 dark:bg-gray-700/50 mt-5 shadow-lg
                                                                  shadow-black rounded-lg py-6">
                    <div class="flex flex-col mx-4 ">
                        <div class="px-6  text-left">
                            <h1 class="text-3xl rounded-md font-bold text-gray-800 dark:text-gray-400 bg-gray-300
                                       dark:bg-gray-800/40 shadow-inner rounded-[10px] p-2 mb-2">
                                {{ certificate.name }}</h1>
                        </div>
                        <div class="bg-gray-200 mx-6 dark:bg-gray-700  rounded-lg  mt-4">
                            <div class="">
                                <img :src="`/storage/${certificate.image}`" alt="certificate"
                                     class="mb-8 rounded-md shadow-sm shadow-gray-600">
                            </div>
                        </div>
                        <div class="mx-6  bg-gradient-to-br from-zinc-200 shadow-inner to-gray-400 dark:bg-gradient-to-br dark:from-gray-600 dark:to-zinc-600 rounded-md ">
                            <h4 class="font-semibold mx-2 text-gray-800 text-left dark:text-gray-300 mb-2">
                                {{ certificate.description }}</h4>
                        </div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>
<script setup>

import GuestLayout from '@/Layouts/GuestLayout.vue';
import {defineProps, ref, provide} from 'vue';

const status = ref('Сертификаты')
const props = defineProps({
    certificates: Object,
})

provide('status', {
    status
})


</script>

