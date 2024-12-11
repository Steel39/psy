<template>
    <GuestLayout>
        <div class="mx-auto  mt-10 sm:px-6 lg:px-8 ">
            <div v-for="about in abouts" class="mt-5 py-6">
                <div class="grid md:grid-cols-3   flex-cols-1 ">
                    <div class="rounded-md col-span-2">
                        <h4 class="font-semibold mx-2 text-gray-800 text-left dark:text-gray-300 mb-2">
                            {{ about.content }}</h4>
                    </div>
                    <div class="rounded-lg">
                        <img :src="`/storage/${about.image}`"
                            class="mb-8 rounded-md shadow-sm shadow-gray-600 animate-[wiggle_1s_ease-in-out_infinite]">
                    </div>

                </div>
                <div class="border border-slate-400">
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

import { defineProps, ref, provide } from 'vue';


const props = defineProps({
    abouts: Object,
})



</script>
