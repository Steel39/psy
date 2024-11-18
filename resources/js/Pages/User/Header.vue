<template>
    <header class="bg-transparent p-4">
        <div class="flex flex-grow mx-10 justify-between items-end">
            <div class="text-gray-500 dark:text-gray-200  text-2xl font-bold">
                <Link :href="route('welcome')" class="hover:text-gray-800 ">Логотип</Link>
            </div>
            <nav class="space-x-4 text-right font-sans  text-stone-500  dark:text-stone-200">
                <Link :href="route('blog')" class=" hover:text-black dark:hover:text-white">Блог</Link>
                <Link href="/services" class=" hover:text-black dark:hover:text-white">Услуги</Link>
                <Link href="/contact" class=" hover:text-black dark:hover:text-white">Контакты</Link>
                <Link href="/certificates" class=" hover:text-black dark:hover:text-white">Сертификаты</Link>
                <Link href="/answers" class=" hover:text-black dark:hover:text-white">Ответы</Link>
                <Link href="/feedbacks" class=" hover:text-black dark:hover:text-white">Отзывы</Link>
            </nav>
        </div>
    </header>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Link } from '@inertiajs/vue3';

</script>
