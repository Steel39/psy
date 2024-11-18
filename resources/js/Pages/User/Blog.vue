<template>
    <GuestLayout>
        <div class="">
            <div class="mx-auto sm:px-6 lg:px-8">
                <label for="post" class="text-2xl  font-bold text-gray-700/90
                                         dark:text-stone-200/80 shadow-inner text-left p-2">
                    Категории
                </label>
                <div class="flex flex-wrap gap-4 mt-4">
                    <div v-for="category in categories"
                        class="text-gray-800/80 dark:text-stone-200 rounded-md hover:shadow-black shadow-md duration-300 ">
                        <p class="p-2">{{ category.name }}</p>
                    </div>
                </div>
                <div class="mt-5 lg:grid lg:grid-cols-2 sm:grid sm:grid-cols-1 gap-4 ">
                    <div v-for="post in posts"
                        class="text-left bg-stone-300/90 dark:text-white dark:bg-gray-600/70 rounded-md shadow-md duration-200  hover:shadow-black">

                        <h1
                        class="text-2xl  font-bold text-gray-700/70 dark:text-gray-200/90 text-left mx-8 p-2  ">
                        {{ post.title }}</h1>
                        <button @click="showPost(post.id)">
                        <div class="mb-4">
                            <div class="flex flex-grow">
                                <img :src="`/storage/${post.image}`" alt="Post Image" class="rounded-md mx-10 hover:shadow-md duration-200
                                hover:shadow-black w-72 max-w-full h-auto sepia  backdrop-blur-md">
                                <p class="text-gray-600 w-1/2 dark:text-gray-200/90">{{ post.description }}</p>
                            </div>
                        </div>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    posts: Object,
    categories: Object,
})

const form = useForm({
})

const showPost = (id) => {
    form.get(route('post', { id: id }), {

    })
}

</script>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-enter-to {
    opacity: 0;
}
</style>
