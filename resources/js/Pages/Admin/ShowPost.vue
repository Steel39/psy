<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref, provide } from 'vue';

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
                    <div class="bg-gradient-to-bl from-gray-400 to-gray-100  rounded-lg py-8">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="container mx-auto  p-4">

                                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ post.title }}</h1>
                                <p class="text-gray-600">Создано {{ post.created_at }}</p>
                            </div>
                            <div class="container bg-gray-300 rounded-xl mx-auto p-4">
                                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ post.description }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-200 rounded-lg mt-4 py-8">
                        <div class="container mx-auto px-4 flex flex-col md:flex-row">
                            <div class="w-full md:w-3/4 px-4">
                                <img :src="imagePath" alt="Blog Featured Image" class="mb-8 rounded-md">
                                <div class="prose max-w-none">
                                    <p>{{ post.content }}</p>
                                </div>
                            </div>
                            <div class="w-full md:w-1/4 px-4">
                                <div v-if="post.tags" class="bg-gray-300 rounded-md p-4">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4">Теги</h2>
                                    <ul v-for="tag in post.tags" class="list-none">
                                        <li class="mb-2">
                                            <p href="#" class="text-gray-700 hover:text-gray-900">{{ tag.name }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="bg-gray-100 p-4 mt-4">
                                    <h2 class="text-xl font-bold text-gray-800 mb-4">Categories</h2>
                                    <ul class="list-none">
                                        <li class="mb-2">
                                            <a href="#" class="text-gray-700 hover:text-gray-900">Category 1</a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-gray-700 hover:text-gray-900">Category 2</a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-gray-700 hover:text-gray-900">Category 3</a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-gray-700 hover:text-gray-900">Category 4</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>