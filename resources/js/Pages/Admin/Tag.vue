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
                           <input v-if="isEdit[index]?.name" v-model="tag.name" type="text" class="rounded-md 
                           bg-gradient-to-r from-cyan-200 to-emerald-300 text-black"
                           @blur="stopEdit(index, 'name')"
                           @keyup.enter="updateTag(tag.id)" />
                        <span v-else @click="editTag(index, 'name')">
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
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
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

const editTag = (index, field) => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: true }
    status.value = 'Редактируем тег...'
}
const stopEdit = () => {
    isEdit.value[index] = { ...isEdit.value[index], [field]: false }
}

const updateTag = (id) => {
    const tag = props.tags.find(tag => tag.id === id)
    if(tag) {
        Inertia.put(route('tag.update', { 
        id: tag.id,
        name: tag.name }))
    }
    
}

const deleteTag = (id) => {
    Inertia.delete(route('tag.delete', { id: id }), {
        preserveScroll: true
    })
}

console.log(props.tags)
const submit = () => {
    form.post(route('tag.store'), {
        preserveScroll: true
    })
}



</script>
