<template>
    <GuestLayout>
        <div class="flex flex-col mx-4">
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg py-8">
                <div class="mx-auto p-4">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200/90 rounded-[10px] p-2 mb-2">
                            {{ post.title }}
                        </h1>
                </div>
                <div class="px-4 ">
                        <img :src="imagePath" alt="Blog Featured Image" class="max-w-2xl rounded-md h-auto shadow-md shadow-gray-600">
                </div>
                <div class="rounded-lg bg-gray-200/90 dark:text-gray-200 dark:bg-gray-700">
                    <div class="">
                        <div class="p-2">
                            <div class="prose  mb-4 text-gray-900 dark:bg-gray-600/40 rounded-xl shadow-xl p-5 dark:text-gray-200 ">
                                <p>{{ post.content }}</p>
                                <p class="text-gray-600 text-right dark:text-gray-400">Создано {{ post.created_at }}</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-200 w-full dark:bg-gray-700 rounded-lg mt-4">

                </div>
                <div class="bg-gray-200 flex flex-auto  dark:bg-gray-700  rounded-lg  mt-4 py-8">
                    <div>
                        <div class="flex  gap-4 flex-wrap">
                            <div v-for="(tag) in post.tags" :key="tag.id"
                                class="font-bold py-2 px-4 rounded   opacity-50">
                                <span
                                    class="text-gray-900 text-2xl p-2 font-bold rounded-md dark:hover:text-white shadow-inner shadow-black dark:text-gray-200">
                                    {{ tag.name }} </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    post: Object,
})
console.log(props.post)
const imagePath = `/storage/${props.post.image}`

</script>
