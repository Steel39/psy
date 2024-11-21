<template>
    <div class=" mx-auto px-8">
                <div class="">
                    <NavLink :href="route('admin.page.service')">Услуги</NavLink>
                    <NavLink :href="route('admin.page.about')">Обо мне</NavLink>
                    <NavLink :href="route('admin.page.answer')">Ответы</NavLink>
                    <NavLink :href="route('admin.page.feedback')">Отзывы</NavLink>
                    <NavLink :href="route('admin.page.contact')">Котнтакты</NavLink>
                </div>
            </div>
</template>
<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>
