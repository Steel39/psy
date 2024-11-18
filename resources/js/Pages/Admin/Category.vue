<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="flex flex-auto p-6 text-gray-900 dark:text-gray-800">
                            <input id="name" v-model="form.name" type="text"
                                class="mt-1 block w-full rounded-md bg-gray-200 border-transparent
                                 focus:border-gray-500 focus:text-gray-600 focus:bg-white focus:ring-0
                                 dark:bg-gray-600 dark:text-gray-200 font-semibold focus:shadow-inner focus:shadow-gray-600 ">
                            <button type="submit" @click="click" :disabled="form.processing"
                                class="mt-1 ml-2 block w-1/4 rounded-md bg-gray-200 border-transparent
                                 focus:bg-transparent focus:text-white focus:ring-0
                                 hover:shadow-lg hover:shadow-green-400 hover:text-green-500
                                 dark:bg-gray-600 dark:text-gray-200 font-semibold duration-200  ease-in-out ">
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
                                        hover:bg-gray-50 dark:hover:bg-gray-600 duration-200  ease-in-out ">

                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900
                                                         whitespace-nowrap dark:text-white">
                                        <input v-if="isEdit[index]?.name" v-model="form.name" type="text"
                                            class="rounded-md bg-gradient-to-r from-cyan-200 to-emerald-300 text-black"
                                            @blur="stopEdit(index, 'name')"
                                            @keyup.enter="updateCategory(category.id, index, 'name')" />
                                        <span v-else @click="editCategory(category.id, index, 'name')">{{ category.name
                                            }}</span>
                                    </td>
                                    <td>
                                        <button class="rounded-md w-1/2 h-8 hover:shadow-lg
                                         font-bold hover:duration-200 duration-200 ease-in-out hover:shadow-red-500
                                          hover:text-red-500 hover:shadow-inner  text-black"
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

import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { provide, ref } from "vue";


const props = defineProps({
    categories: Object
})
const isEdit = ref(Array(props.categories.length).fill({}))
const status = ref('Все хорошо =)')
const form = useForm({
    id: null,
    name: ''
})

const deleteCategory = (id) => {
    status.value = 'Удаляем...'
    form.delete(route('category.delete', { id: id }), {
        preserveScroll: true,
    })
    status.value = 'Категория удалена'
}
const editCategory = (id, index, field) => {
    const category = props.categories.find(category => category.id === id)
    isEdit.value[index] = { ...isEdit.value[index], [field]: true }
    form.name = category.name
    status.value = 'Редактируем категорию...'
}

const stopEdit = (index, field) => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
    status.value = 'Все хорошо =)'
}
const updateCategory = (id, index, field) => {
    const category = props.categories.find(category => category.id === id)
    if (category) {
        form.put(route('category.update', { id: id }))
    }
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
    status.value = 'Категория обновлена'
    form.reset()
}

const submit = () => {
    if (form.name !== '') {
        form.post('category/store', {
            preserveScroll: true
        })
        status.value = 'Добавлена новая категория =)'
        form.reset()
    } else {
        status.value = 'Поле не должно быть пустым...'
    }

}
provide('status', {
    status,
    submit
})


</script>
