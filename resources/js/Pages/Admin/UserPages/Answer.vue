<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages />
            <div class="grid grid-cols-2">
                <div>
                    <form @submit.prevent="submit">
                        <InputField
                            name="question"
                            v-model="form.question"
                            type="text" />

                        <InputField
                            name="answer"
                            v-model="form.answer"
                            type="text" />
                        <SecondaryButton :disabled="form.processing" @click="submit">
                            Добавить ответ
                        </SecondaryButton>
                    </form>
                </div>
                <div>
                    <div class="flex w-1/2 flex-col dark:text-white border mt-2 text-left p-2 rounded-md" v-for="answer in answers">
                        <label class="font-bold">{{ answer.question }}</label>
                        <label>{{ answer.answer }}</label>
                        <button class="p-2 w-1/4 hover:text-red-500"  @click="deleteAnswer(answer.id)">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import HeaderForPages from "@/Components/HeaderForPages.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputField from "@/Components/InputField.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { provide, ref } from "vue";

const status = ref('Хорошего дня!')

provide('status', {
    status
})

const form = useForm({
    question: '',
    answer: '',
})

const props = defineProps({
    answers: Object,
})

const submit = () => {
    form.post(route('admin.page.answer.store'), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Ответ добавлен'
        }
    })
}

const deleteAnswer = (id) => {
    form.delete(route('admin.page.answer.delete', {id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Ответ удален'
        }
    })
}
</script>
