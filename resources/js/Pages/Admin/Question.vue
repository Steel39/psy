<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <form @submit.prevent="submit">
                        <div class="w-1/4">
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name">
                            </TextInput>
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="email">
                            </TextInput>
                            <TextInput id="contact" type="text" class="mt-1 block w-full" v-model="form.contact"
                                required autofocus autocomplete="contact">
                            </TextInput>
                            <TextInput id="question" type="text" class="mt-1 block w-full" v-model="form.question"
                                required autofocus autocomplete="question">
                            </TextInput>
                            <button @click="submit">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="grid grid-cols-4 gap-4">
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
                        <div class="relative overflow-x-auto p-2 shadow-md sm:rounded-lg">
                            {{ question.question }}
                        </div>
                        <div class="relative overflow-x-auto p-2 shadow-md sm:rounded-lg">
                            {{ question.created_at }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, provide } from 'vue';

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

const submit = () => {
    form.post(route('user.question.store'), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Вопрос добавлен'
        }
    })

}
</script>
