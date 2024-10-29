<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Link :href="route('createPost')">
                            Создадим новывй пост
                        </Link>
                    </div>
                </div>
                <slot/>
                <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b 
                                        dark:bg-gray-800 dark:border-gray-700
                                        hover:bg-gray-50 dark:hover:bg-gray-600">

                                <td scope="row" class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                    пост 1

                                </td>
                                <td>
                                    <button click=""></button>
                                </td>
                                <td>
                                    Действие1
                                </td>
                                <td>
                                    Действие1
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
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";
import { provide, ref } from "vue";


const status = ref('Хорошего дня!')
provide('status', {
    status
})

const showPost = (id) => {
    Inertia.get(route('post.index', { id: id }))
}

const createPost = () => {
    Inertia.get(route('post.create', {
    })
    )
}

</script>
