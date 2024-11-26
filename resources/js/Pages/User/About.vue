<template>
    <GuestLayout>
        <div class="mx-auto max-w-7xl mt-10 sm:px-6 lg:px-8 ">
            <div v-for="about in abouts" class="  mt-5  py-6">
                <div class="flex flex-cols-2 mx-4 items-start">
                    <div class=" mx-6  rounded-lg  mt-4">
                        <div class="w-3/4">
                            <img :src="`/storage/${about.image}`" alt="about"
                                class="mb-8 rounded-md shadow-sm shadow-gray-600 animate-[wiggle_1s_ease-in-out_infinite]">
                        </div>
                    </div>
                    <div
                        class="mx-6 rounded-md ">
                        <h4 class="font-semibold mx-2 text-gray-800 text-left dark:text-gray-300 mb-2">
                            {{ about.content }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { defineProps, ref, provide } from 'vue';

const status = ref('Сертификаты')
const props = defineProps({
    abouts: Object,
})

provide('status', {
    status
})

</script>
