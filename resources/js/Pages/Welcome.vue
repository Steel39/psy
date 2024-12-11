<template>
    <GuestLayout>
        <div v-for="data in mainData" class="flex flex-col gap-4 p-4 md:flex-col">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-300 drop-shadow-xl rounded-[10px] p-2 mb-4">
                    {{ data.header }}
                </h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 p-2">
                <div>
                    <img :src="`/storage/${data.image}`" alt="image" class="rounded-md shadow-md">
                </div>
                <div class="col-span-2 mx-5">
                    <p class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">{{ data.content }}</p>
                </div>

            </div>

        </div>
        <div v-if="isQuestion">
            <div class="flex mx-auto flex-col w-1/2 sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div class="flex flex-col ">
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" placeholder="Как к Вам обращаться?">
                        </TextInput>
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autofocus autocomplete="email" placeholder="Почтовый адрес">
                        </TextInput>
                        <TextInput id="contact" type="text" class="mt-1 block w-full" v-model="form.contact" required
                            autofocus autocomplete="contact" placeholder="Любой другой способ связи">
                        </TextInput>
                        <TextInput id="question" type="text" class="mt-1 block w-full" v-model="form.question" required
                            autofocus autocomplete="question" placeholder="Ваш вопрос">
                        </TextInput>
                        <div class="grid grid-cols-2 gap-4">
                            <button @click="closeQuestion" class="shadow-md focus:shadow-inner shadow-black hover:shadow-pink-200
                         hover:text-pink-400 rounded-lg bg-gradient-to-br from-gray-300
                         duration-200 text-gray-600  to-gray-200 p-2 mt-2 ">
                                Закрыть
                            </button>
                            <button @click="submit" class="shadow-md focus:shadow-inner shadow-black hover:shadow-cyan-200
                         hover:text-cyan-400 rounded-lg bg-gradient-to-br from-gray-300
                         duration-200 text-gray-600  to-gray-200 p-2 mt-2 ">
                                Отправить
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Кнопка записи на прием -->
        <div v-if="!isQuestion" class="text-center mt-4 mx-4">
            <button @click="getQuestion"
                class="shadow-md focus:shadow-inner shadow-black hover:shadow-pink-200 hover:text-pink-400 rounded-lg bg-gradient-to-br from-gray-300 duration-200 text-gray-600 to-gray-200 p-4">
                Задать вопрос
            </button>
        </div>


    </GuestLayout>

</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
const form = useForm({
    name: '',
    email: '',
    contact: '',
    question: ''
})
const isQuestion = ref(false)
const props = defineProps({
    mainData: Object,
})
console.log(props.mainData)

const getQuestion = () => {
    isQuestion.value = true
}
const closeQuestion = () => {
    isQuestion.value = false
}
const submit = () => {
    form.post(route('user.question.store'), {
        preserveScroll: true,
        onSuccess: () => {
            isQuestion.value = false
        }
    })
}
</script>
<style></style>
