<template>
    <GuestLayout>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class=" lg:grid lg:grid-cols-2 sm:grid sm:grid-cols-1 gap-4 ">
                    <div  v-for="post in posts" class="text-left bg-gray-200/90 dark:text-white dark:bg-gray-600/70 rounded-md shadow-inner duration-200  hover:shadow-black">
                        <h1 class="text-4xl  font-bold text-gray-800 dark:text-gray-200/90 text-left mx-8 p-2 hover:animate-fadeIn ">{{ post.title }}</h1>
                        <div class="mb-4">
                            <div class="flex flex-grow">
                                <img :src="`/storage/${post.image}`" alt="Post Image" class="rounded-md mx-10 hover:shadow-md duration-200 hover:shadow-black w-72 max-w-full h-auto sepia  backdrop-blur-md">
                                <p class="text-gray-600 w-1/2 dark:text-gray-200/90">{{ post.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    posts: Object
})

const postContent = 'Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста Здесь будет текст краткого описания поста '

</script>
