<template>
    <authenticated-layout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-inner shadow-black sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="flex flex-auto p-6 text-gray-900 dark:text-gray-800">
                            <input id="name" v-model="form.name" type="text" class="mt-1 block w-full shadow-inner rounded-md bg-gray-200 border-none
                                 focus:border-gray-500 focus:bg-white focus:shadow-inner focus:shadow-gray-600  focus:ring-0
                                 focus:border-transparent">
                            <button type="submit" @click="click" :disabled="form.processing" class="mt-1 ml-2 block w-1/4 font-semibold rounded-md bg-gradient-to-tl from-gray-300 to gray-500
                                 hover:text-green-500 hover:shadow-lg hover:shadow-green-200 focus:shadow-inner focus:shadow-black duration-200 ease-in-out focus:ring-0">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex flex-wrap gap-4  mt-10">
                    <div v-for="(tag, index) in tags" :key="tag.id" class="bg-gradient-to-tl h-14   from-gray-400
                           to-gray-100 font-sans shadow-inner shadow-black font-semibold text-black p-4  rounded-lg  duration-200">
                        <input v-if="isEdit[index]?.name" v-model="form.name" type="text" class="rounded-lg
                           bg-gradient-to-r h-10 px-10 w-3/4 -my-3 from-yellow-200 to-amber-200 text-gray-900 shadow-inner shadow-black
                            duration-200 "
                               @blur="stopEdit(index, 'name')"
                               @keyup.enter="updateTag(tag.id, index, 'name')"/>
                        <span class="text-black  p-2  transition duration-200" v-else
                              @click="editTag(tag.id, index, 'name')">
                            {{ tag.name }}
                        </span>

                        <button class="ml-5 text-red-700" @click="deleteTag(tag.id)">
                            х
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>

</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {defineProps} from "vue";
import {provide, ref} from "vue";


const props = defineProps({
    tags: Object
})
const isEdit = ref(Array(props.tags.length).fill({}))
const status = ref('Страница тегов')
provide('status', {
    status
})
const form = useForm({
    id: null,
    name: ''
})

const editTag = (id, index, field) => {
    const tag = props.tags.find(tag => tag.id === id)
    form.name = tag.name
    isEdit.value[index] = {...isEdit.value[index], [field]: true}

    status.value = 'Редактируем тег...'
}
const stopEdit = (index, field) => {
    isEdit.value[index] = {...isEdit.value[index], [field]: false}
    status.value = 'Все хорошо =)'
    form.reset()
}

const updateTag = (id, index, field) => {
    const tag = props.tags.find(tag => tag.id === id)
    if (tag) {
        form.patch(route('tag.update', tag.id))
        console.log
    }
    status.value = 'Тег обновлен ;)'
    isEdit.value[index] = {...isEdit.value[index], [field]: false}
    form.reset()
}

const deleteTag = (id) => {
    form.delete(route('tag.delete', {id: id}), {
        preserveScroll: true,
    })
    status.value = 'Тег удален =)'
}

const submit = () => {
    status.value = 'Добавляем...'
    form.post(route('tag.store'), {
        preserveScroll: true,
    })
    form.reset()
    status.value = 'Добавили новый тег =)'
}

</script>
