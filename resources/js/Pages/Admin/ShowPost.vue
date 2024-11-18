<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref, provide } from 'vue';
import {useForm} from "@inertiajs/vue3";

const status = ref('Хорошего дня!')
provide('status', {
    status
})
const props = defineProps({
    post: Object,
})

const form = useForm({

})
const editPost = (id) => {
    form.get(route('post.edit', { id: id}), {
        preserveScroll: true
    })
}
const deletePost = (id) => {
    form.delete(route('post.delete', { id: id}), {
        preserveScroll: true
    })
}

const imagePath = `/storage/${props.post.image}`

</script>
<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="bg-gray-200 dark:bg-gray-700  rounded-lg py-8">
                        <div class="grid grid-cols-2 gap-6 rounded-lg bg-gray-200 dark:text-gray-200 dark:bg-gray-700">
                            <div class="container  mx-auto p-4">
                                <h1
                                    class="text-3xl font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg  rounded-[10px] p-2 mb-2">
                                    {{ post.title }}</h1>
                                </div>
                                <div class="container p-2 w-4/5 mx-auto md:items-center bg-gradient-to-br from-zinc-200 shadow-md to-gray-400 px-4
                                dark:bg-gradient-to-br dark:from-gray-600 dark:to-zinc-600 rounded-xl ">
                                <h4 class="font-semibold text-gray-800 text-right  dark:text-gray-300 mb-2">
                                    {{ post.description }}</h4>
                                    <p class="text-gray-600 text-right dark:text-gray-400">Создано {{ post.time }}</p>
                                </div>
                            </div>
                        </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-200 dark:bg-gray-700 rounded-lg mt-4">
                            <div class="container mx-auto mt-10 px-4 flex flex-col md:flex-row">
                                <div class="flex flex-1 md:w-3/4 px-2">
                                    <div
                                        class="prose w-full mb-4 text-gray-900 dark:bg-gray-600/40 rounded-xl shadow-xl p-5 dark:text-gray-200 ">
                                        <p>{{ post.content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-200  flex flex-auto  dark:bg-gray-700  rounded-lg  mt-4 py-8">
                            <div>
                                <div class="p-4 w-full">
                                    <img :src="imagePath" alt="Blog Featured Image"
                                         class="mb-8 rounded-md shadow-md shadow-gray-600">
                                </div>
                                <div class="flex  gap-4 flex-wrap">
                                    <div v-for="(tag) in post.tags" :key="tag.id"
                                         class="font-bold py-2 px-4 rounded   opacity-50">
                                        <span class="text-gray-900 text-2xl p-2 font-bold rounded-md dark:hover:text-white shadow-inner shadow-black dark:text-gray-200"> {{ tag.name }} </span>
                                    </div>
                                </div>
                                <div class="flex text-right p-4 justify-between">
                                    <button class="border border-gray-400 focus:shadow-inner  focus:shadow-black hover:text-black font-sans
                                     rounded-lg duration-200 p-2" @click="editPost(post.id)">
                                        Редактировать
                                    </button>
                                    <button class="ml-4 border border-gray-400 focus:shadow-inner hover:bg-red-500 hover:text-indigo-300  focus:shadow-black hover:text-black font-sans
                                     rounded-lg duration-200 p-2" @click="deletePost(post.id)">
                                        Удалить
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
