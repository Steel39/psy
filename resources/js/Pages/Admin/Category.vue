<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="flex flex-auto p-6 text-gray-900 dark:text-gray-800">
                            <input id="name" v-model="form.name" type="text"
                                class="mt-1 block w-full rounded-md bg-gray-500 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                            <button type="submit" @click="click" :disabled="form.processing"
                                class="mt-1 ml-2 block w-1/4 rounded-md bg-green-700 border-transparent focus:border-gray-800 focus:bg-emerald-800 focus:ring-0">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-gray-500 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody v-for="category in categories">
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{  category.name }}
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#"
                                            class="font-medium ml-10 text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <a href="#"
                                            class="font-medium ml-10 text-white-600 dark:text-blue-500 hover:underline">Del</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
<script setup>

import { useForm } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { provide, ref } from "vue";

const props = defineProps({
    categories: Object
})
const categories = props.categories
const status = ref('Все хорошо =)')
const form = useForm({
    name: null
})
console.log(categories)

const submit = () => {

    form.post('category/store', {
        preserveScroll: true
    })
}
provide('status', {
    status,
    submit
})
</script>
