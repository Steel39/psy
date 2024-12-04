<template class="">
    <GuestLayout class="">
        <div class="flex flex-grow gap-6  p-4">
            <div>
                <h1
                    class="text-4xl font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg rounded-[10px] p-2 mb-4">
                    {{ props.mainData.header }}
                </h1>
                <p class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">{{

                }}</p>
            </div>
            <img :src="imagePath" alt="image" class="rounded-md shadow-md size-80">
        </div>

        <!-- Описание и услуги -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6  p-8 ">
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400">Услуги</h2>
                <ul class="list-disc list-inside mt-2 text-gray-600 dark:text-gray-300">
                    <li>Индивидуальные консультации</li>
                    <li>Семейная терапия</li>
                    <li>Групповые занятия</li>
                    <li>Поддержка в кризисных ситуациях</li>
                </ul>
            </div>
            <div class="bg-gray-200 dark:bg-gray-700 rounded-lg p-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400">Контактная информация</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Телефон: <span class="font-semibold">{{ phoneNumber }}</span>
                </p>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Email: <span class="font-semibold">{{ email }}</span>
                </p>
            </div>
        </div>
        <div class="dark:bg-gray-700 rounded-lg mx-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400">Категории</h2>
            <ul class="list-disc list-inside mt-2 text-gray-500 dark:text-gray-300">
                <li><a class="hover:text-black" href="">Психологическая помощь</a></li>
                <li><a class="hover:text-black" href="">Личностный рост</a></li>
                <li><a class="hover:text-black" href="">Семейные отношения</a></li>
                <li><a class="hover:text-black" href="">Стрессы и выгорание</a></li>
                <li><a class="hover:text-black" href="">Детская и подростковая психология</a></li>
            </ul>
        </div>
        <!-- Краткая информация о психологе -->
        <div class="bg-gray-200 dark:bg-gray-700 rounded-lg mx-4 mt-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400">О себе</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">{{  }}</p>
        </div>

        <!-- Кнопка записи на прием -->
        <div class="text-right mt-4 mx-4">
            <button
                class="shadow-md focus:shadow-inner shadow-black hover:shadow-pink-200 hover:text-pink-400 rounded-lg bg-gradient-to-br from-gray-300 duration-200 text-gray-600 to-gray-200 p-4">
                Задать вопрос
            </button>
        </div>
    </GuestLayout>

</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { ref } from "vue";

const props = defineProps({
    mainData: Object,
})
console.log(props.mainData)

const imagePath = ref(`/storage/${props.mainData.image}`)

</script>
<style></style>
