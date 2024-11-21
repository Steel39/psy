<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages/>
        </div>

    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { provide, ref } from "vue";
import HeaderForPages from "@/Components/HeaderForPages.vue";
const status = ref('Хорошего дня!')
provide('status', {
    status
})
</script>
