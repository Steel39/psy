<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Link :href="route('createPost')">
                            <button class="rounded-md bg-stone-200 dark:bg-indigo-800 border-lime-400 font-bold px-2 py-2
                                           hover:text-cyan-400 hover:shadow-md hover:shadow-cyan-400">
                                Новый пост
                            </button>
                        </Link>
                    </div>
                </div>
                <slot/>
                <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="bg-white border-b font-bold
                                        dark:bg-gray-800 dark:border-gray-700
                                        hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                Название
                            </td>
                            <td class="px-6 py-4">
                                Описание
                            </td>
                            <td class="px-6 py-4">
                                Опции
                            </td>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts" key='post.id' class="bg-white border-b
                                        dark:bg-gray-800 dark:border-gray-700
                                        hover:bg-gray-50 dark:hover:bg-gray-600">

                                <td scope="row" class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                    {{ post.title }}

                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                    {{ post.description }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                    <button @click="showPost(post.id)" class="text-green-500 hover:shadow-lg 
                                        hover:shadow-green-400 p-2 rounded-md"  >
                                        Show
                                    </button>
                                    <button class="ml-10 text-black p-2 rounded-md hover:shadow-lg hover:shadow-red-400">
                                        Del
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { provide, ref } from "vue";

const form = useForm({})
const status = ref('Хорошего дня!')
provide('status', {
    status
})

const props = defineProps ({
    posts: Object
})

const showPost = (id) => {
    form.get(route('post.show', { id: id }))
}
const deletePost = (id) => {
    form.delete(route('post.delete', { id: id}))
}

const createPost = () => {
    form.get(route('post.create', {
    })
    )
}
console.log(props.posts)
</script>
