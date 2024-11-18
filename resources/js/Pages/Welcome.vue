<template class="transition duration-500">
    <GuestLayout>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <!-- Заголовок визитки психолога -->
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-lg py-8">
                        <div class="flex flex-grow gap-6 mt-4   p-4 ">
                            <div>
                                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg rounded-[10px] p-2 mb-4">
                                    {{ psychologistName }}
                                </h1>
                                <p class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">{{
                                        psychologistTagline
                                    }}</p>
                            </div>
                            <img :src="imagePath" alt="Post Image" class="rounded-md shadow-md">
                        </div>
                    </div>

                    <!-- Описание и услуги -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div class="bg-gray-200 dark:bg-gray-700 rounded-lg p-4">
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
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-lg mt-4 p-4">
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
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-lg mt-4 p-4">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-400">О себе</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">{{ aboutMe }}</p>
                    </div>

                    <!-- Кнопка записи на прием -->
                    <div class="text-right mt-6">
                        <button
                            class="shadow-md focus:shadow-inner shadow-black hover:shadow-pink-200 hover:text-pink-400 rounded-lg bg-gradient-to-br from-gray-300 duration-200 text-gray-600 to-gray-200 p-4">
                            Задать вопрос
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>

</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    components: {GuestLayout},
    data() {
        return {
            psychologistName: 'Любой заголовок, Имя Фамилию',
            psychologistTagline: '«Психотерапия» в переводе с латинского — «лечение души». Тем, кто никогда не обращался за помощью к психотерапевту, кажется, что его работа сродни волшебству: моментально избавляет от всех проблем. К сожалению, чудесных одномоментных исцелений не бывает. В то же время при определенных условиях помощь психотерапевта может оказаться очень эффективной.\n' +
                '\n' +
                'Я — психотерапевт и постараюсь вам помочь в сложных жизненных ситуациях. Но важно понять, что путь к внутреннему равновесию долог. И этот путь, порой извилистый и нелегкий, потребует кропотливой работы как с моей, так и с вашей стороны.\n' +
                '\n' +
                'Прежде чем обратиться за помощью, задайте себе вопрос: готовы ли вы эту помощь принять, готовы ли взять на себя ответственность за свою судьбу и личное счастье? Увы, но кому-то действительно легче лелеять свои неудачи и смиряться под ударами судьбы.\n' +
                '\n' +
                'Если вы сомневаетесь, нужна ли вам психотерапевтическая помощь, посмотрите мой сайт. Здесь собраны основные ситуации, с которыми ко мне обращаются люди. Быть может, вы узнаете ответы на свои вопросы и найдете здесь источник сил, чтобы справиться с проблемами самостоятельно.\n' +
                '\n' +
                'Если же вопросы остались без ответа, вы может обратиться ко мне, чтобы найти ответы вместе.',
            phoneNumber: '+7 (123) 456-78-90',
            email: 'psychologist@example.com',
            aboutMe: 'Добро пожаловать! Я профессиональный психолог, специализируюсь на помощи людям в трудные времена.',
            imagePath: 'https://via.placeholder.com/600',
        };
    },
};
</script>
