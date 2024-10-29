<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="flex flex-auto p-6 text-gray-900 dark:text-gray-800">
                            <input id="name" v-model="form.name" type="text"
                                class="mt-1 block w-full rounded-md bg-gray-500 border-transparent
                                 focus:border-gray-500 focus:bg-white focus:ring-0">
                            <button type="submit" @click="click" :disabled="form.processing"
                                class="mt-1 ml-2 block w-1/4 rounded-md bg-green-700 border-transparent
                                 focus:border-gray-800 focus:bg-emerald-800 focus:ring-0">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-gray-500 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                            <tbody>
                                <tr v-for="(category, index) in categories" :key="category.id" class="bg-white border-b 
                                        dark:bg-gray-800 dark:border-gray-700
                                        hover:bg-gray-50 dark:hover:bg-gray-600">

                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                        <input v-if="isEdit[index]?.name" v-model="category.name" type="text"
                                            class="rounded-md bg-gradient-to-r from-cyan-200 to-emerald-300 text-black"
                                            @blur="stopEdit(index, 'name')"
                                            @keyup.enter="updateCategory(category.id)" />
                                        <span v-else @click="editCategory(index, 'name')">{{ category.name }}</span>
                                    </td>
                                    <td>
                                        <button class="rounded-md w-1/2 h-8 shadow-md hover:shadow-xl
                                         hover:shadow-lime-500 shadow-pink-400  text-black 
                                         font-bold bg-gradient-to-r from-red-400 to-pink-400"
                                            @click="deleteCategory(category.id)">DEL</button>
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
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    categories: Object
})
const isEdit = ref(Array(props.categories.length).fill({}))
const status = ref('Все хорошо =)')
const categories = ref(props.categories)
const form = useForm({
    id: null,
    name: ''
})

const deleteCategory = (id) => {
    Inertia.delete(route('category.delete', { id: id }), {
        preserveScroll: true,
    })
    status.value = 'Удаляем...'
}
const editCategory = (index, field) => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: true }
    status.value = 'Редактируем категорию...'
}

const stopEdit = (index, field) => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
}
const updateCategory = (id) => {
    const category = props.categories.find(category => category.id === id)
    if (category) {
        Inertia.put(route('category.update', {
            id: category.id,
            name: category.name
        }))
    }
    status.value = 'Обновляем...'
}

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
