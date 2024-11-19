<template>
    <div class="flex flex-col my-4  rounded-lg">
        <div class="bg-gray-200/40  dark:bg-gray-700 shadow-lg shadow-black rounded-lg py-4">
            <div class="mx-auto px-4">
                <h1 class="text-3xl font-semibold  text-gray-800 dark:text-gray-100/60 ">
                    {{ post.title }}
                </h1>
            </div>
            <div class="p-4 mb-2">
                <img :src="imagePath" alt="Image"
                    class="max-w-lg rounded-md h-auto shadow-md shadow-gray-600">
            </div>
            <div class="rounded-lg dark:text-gray-200 dark:bg-gray-700">
                <div class="">
                    <div class="px-4 ">
                        <div class="prose bg-white  mb-4 text-gray-900/90 dark:bg-gray-600/40
                                    rounded-xl shadow-inner shadow-black p-5 dark:text-gray-200/90 ">
                            <p class="drop-shadow-md">{{ props.post.content }}</p>
                            <p class="text-gray-600 text-right dark:text-gray-400">Создано {{ post.created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 ">

            <div class="bg-gray-200 flex flex-auto  dark:bg-gray-700  rounded-lg  mt-4 py-2">
                <div>
                    <div class="flex  gap-4 flex-wrap">
                        <div v-for="(tag) in post.tags" :key="tag.id" class="font-bold py-2 px-4 rounded   opacity-50">
                            <span
                                class="text-gray-900 text-2xl p-2 font-bold rounded-md dark:hover:text-white shadow-inner shadow-black dark:text-gray-200">
                                {{ tag.name }} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 w-full text-right dark:bg-gray-700 rounded-lg mt-4">
                <button
                    class="text-gray-800/80 dark:text-stone-200 p-2 mx-2 my-2 rounded-md hover:shadow-black shadow-md duration-300 "
                    @click="$emit('back')">Back to Posts</button>
            </div>
        </div>
    </div>
</template>
<script setup>

import { defineProps, ref } from 'vue';


const props = defineProps({
    post: Object,
})

const imagePath = `/storage/${props.post.image}`

</script>
