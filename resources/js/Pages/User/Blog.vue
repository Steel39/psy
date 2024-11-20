<template>
    <GuestLayout>
        <div class="py-4">
            <div class="mx-4">
                <label for="post" class="text-2xl  font-bold text-gray-700/90
                                         dark:text-stone-200/80 shadow-inner text-left p-2">
                    Категории
                </label>
                <div class="flex flex-wrap gap-4 mt-4">
                    <div v-for="category in categories"
                        class="text-gray-800/80 dark:text-stone-200 rounded-md hover:shadow-black shadow-md duration-300 ">
                        <button @click="categoryPosts(category)" :key="category.id">
                            <p class="p-2">{{ category.name }}</p>
                        </button>
                    </div>
                </div>
                <transition :duration="500" name="slide-fade" mode="out-in">
                <div v-if="!selectedPost" class="mt-5 lg:grid lg:grid-cols-2 sm:grid sm:grid-cols-1 gap-4 ">
                    <div v-for="post in posts"
                        class="text-left bg-stone-300/90 dark:text-white dark:bg-gray-600/70 rounded-md shadow-md duration-200  hover:shadow-black">

                        <h1
                        class="text-2xl  font-bold text-gray-700/70 dark:text-gray-200/90 text-left mx-8 p-2  ">
                        {{ post.title }}</h1>
                        <button @click="showPost(post)">
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
                <PostComponent v-else :post="selectedPost" :scrollPosition="scrollPosition" @back="handleBack" />
                </transition>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import PostComponent from "@/Components/PostComponent.vue";
const props = defineProps({
    posts: Object,
    categories: Object,
})
const form = useForm({})
const selectedPost = ref(null)
const scrollPosition = ref(0)
const categoryPosts = (category) => {
    form.get(route('category.posts', {
        category_name: category.name,
        id: category.id
    }), {
        preserveScroll:true,
    })
}
const showPost = (post) => {
    scrollPosition.value = window.scrollY;
    console.log(scrollPosition.value + 'send')
    selectedPost.value = post;
    window.scrollTo({ top: 300, behavior: 'smooth'});
}


const handleBack = () => {
    window.scrollTo({ top: scrollPosition.value , behavior: 'smooth'});
    console.log(window.scrollY + 'end')
    selectedPost.value = null;
}

</script>



<style>
.slide-fade-enter-active, .slide-fade-leave-active {
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}
.slide-fade-enter, .slide-fade-leave-to /* .slide-fade-leave-active в <2.1.8 */ {
  opacity: 0;
  transform: translateZ(-100px) scale(0.8); /* Элемент будет уменьшаться и перемещаться к пользователю */
}

.slide-fade-leave {
  opacity: 0;
  transform: translateZ(100px) scale(1.2); /* Элемент будет увеличиваться и уходить */
}
</style>
