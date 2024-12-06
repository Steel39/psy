<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div v-for="question in questions"
                         class="mt-4 text-gray-500 p-2 dark:text-gray-200 overflow-hidden bg-gray-200
                        shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div class="relative overflow-x-auto shadow-md p-2 sm:rounded-lg">
                            {{ question.name }}
                        </div>
                        <div class="relative overflow-x-auto p-2 shadow-md sm:rounded-lg">
                            {{ question.email }}
                        </div>
                        <div class="relative overflow-x-auto p-2 shadow-md sm:rounded-lg">
                            {{ question.contact }}
                        </div>
                        <div class="relative overflow-x-auto p-2 shadow-md sm:rounded-lg ">
                            {{ question.question }}
                        </div>
                        <div class="relative flex flex-wrap overflow-x-auto justify-end p-2 shadow-md sm:rounded-lg">
                            <div class="">
                                {{ question.created_at }}
                            </div>
                            <div>
                                <button class="text-gray-700 ml-4 p-1 shadow-lg hover:shadow-red-500
                                       font-medium rounded-md border-gray-400 hover:text-red-700 duration-200"
                                        @click="deleteQuestion(question.id)" :disabled="form.processing">
                                    Удалить
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import {useForm} from '@inertiajs/vue3';
import {ref, provide} from 'vue';

const props = defineProps({
    questions: Object
})

const form = useForm({
    name: '',
    email: '',
    contact: '',
    question: ''
})

const status = ref('Что такое вопрос?')
provide('status', {
    status
})

const deleteQuestion = (id) => {
    form.delete(route('admin.question.delete', {id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Удалено..'
        }
    })
}

</script>
