<template>
    <header class="bg-transparent p-4 ">
        <div class="flex flex-grow mx-10 justify-between items-end">
            <div class="text-gray-500 dark:text-gray-200  text-2xl font-bold">
                <Link :href="route('welcome')" class="hover:text-gray-800 ">LOGO</Link>
            </div>
            <nav class="space-x-4 text-right font-sans  text-stone-500  dark:text-stone-200">
                <Link :href="route('blog')" class=" hover:text-black dark:hover:text-white">Блог</Link>
                <Link :href="route('service')" class=" hover:text-black dark:hover:text-white">Услуги</Link>
                <Link :href="route('contact')" class=" hover:text-black dark:hover:text-white">Контакты</Link>
                <Link :href="route('certificate')" class=" hover:text-black dark:hover:text-white">Сертификаты</Link>
                <Link :href="route('answer')" class=" hover:text-black dark:hover:text-white">Ответы</Link>
                <Link :href="route('about')" class=" hover:text-black dark:hover:text-white">Обо мне</Link>
            </nav>
        </div>
    </header>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Link } from '@inertiajs/vue3';

</script>
