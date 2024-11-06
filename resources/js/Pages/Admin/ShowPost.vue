<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {defineProps, ref, provide} from 'vue';

const status = ref('Хорошего дня!')
provide('status', {
    status
})
const props = defineProps({
    post: Object,
})
const imagePath = `/storage/${props.post.image}`
console.log(imagePath)
</script>
<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="bg-gray-200 dark:bg-gray-700  rounded-lg py-8">
                        <div class="grid grid-cols-2 gap-6 rounded-lg bg-gray-200 dark:text-gray-200 dark:bg-gray-700">
                            <div class="container  mx-auto p-4">
                                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg  rounded-[10px] p-2 mb-2">
                                    {{ post.title }}</h1>
                                <p class="text-gray-400 text-right dark:text-gray-400">Создано {{ post.time }}</p>
                            </div>
                            <div class="container p-2 w-4/5 mx-auto md:items-center bg-gradient-to-br from-zinc-200 shadow-md to-gray-400 px-4
                             dark:bg-gradient-to-br dark:from-gray-600 dark:to-zinc-600 rounded-xl ">
                                <h4 class="font-semibold text-gray-800 text-right  dark:text-gray-300 mb-2">
                                    {{ post.description }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="bg-gray-200 flex flex-auto  dark:bg-gray-700  rounded-lg  mt-4 py-8">
                            <div class="p-4 w-full">
                                <img :src="imagePath" alt="Blog Featured Image"
                                     class="mb-8 rounded-md shadow-md shadow-gray-600">
                            </div>
                        </div>
                        <div class="bg-gray-200 ml-4  dark:bg-gray-700  rounded-lg p-4  mt-4 py-8">
                            <div class="flex flex-auto flex-wrap gap-4 flex-wrap mt-10">
                                <div v-for="(tag) in post.tags" :key="tag.id"
                                     class="font-bold py-2 px-4rounded text-right opacity-50">
                                    <span class="text-gray-900 text-2xl font-bold shadow-lg dark:text-gray-200"> {{ tag.name }} </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-200 dark:bg-gray-700  rounded-lg  mt-4">
                        <div class="container mx-auto mt-10 px-4 flex flex-col md:flex-row">
                            <div class="w-full md:w-3/4 px-4">

                                <div class="prose max-w-none mb-4 text-gray-900 dark:bg-gray-600/40 rounded-xl shadow-xl p-5 dark:text-gray-200 ">
                                    <p>{{ post.content }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
