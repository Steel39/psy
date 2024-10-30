<template>
    <authenticated-layout>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="flex flex-auto p-6 text-gray-900 dark:text-gray-800">
                            <input id="name" v-model="form.name" type="text" class="mt-1 block w-full rounded-md bg-gray-500 border-transparent
                                 focus:border-gray-500 focus:bg-white focus:ring-0">
                            <button type="submit" @click="click" :disabled="form.processing" class="mt-1 ml-2 block w-1/4 rounded-md bg-green-700 border-transparent
                                 focus:border-gray-800 focus:bg-emerald-800 focus:ring-0">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex flexauto flex-wrap gap-4 flex-wrap mt-10">
                    <div v-for="(tag, index) in tags" :key="tag.id" class="bg-gradient-to-tl from-cyan-300
                           to-lime-300 text-black  font-bold py-2 px-4 rounded opacity-50">
                           <input v-if="isEdit[index]?.name" v-model="form.name" type="text" class="rounded-md 
                           bg-gradient-to-r from-cyan-200 to-emerald-300 text-black"
                           @blur="stopEdit(index, 'name')"
                           @keyup.enter="updateTag(tag.id, index, 'name')" />
                        <span v-else @click="editTag(tag.id, index, 'name')">
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
import { useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { provide, ref } from "vue";


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
    isEdit.value[index] = { ...isEdit.value[index], [field]: true }
    
    status.value = 'Редактируем тег...'
}
const stopEdit = (index, field) => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
    status.value = 'Все хорошо =)'
    form.reset()
}

const updateTag = (id, index, field) => {
    const tag = props.tags.find(tag => tag.id === id)
    if(tag) {
        form.patch(route('tag.update', tag.id))
        console.log
    }
    status.value = 'Тег обновлен ;)'
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
    form.reset()
}

const deleteTag = (id) => {
    form.delete(route('tag.delete', { id: id }), {
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
