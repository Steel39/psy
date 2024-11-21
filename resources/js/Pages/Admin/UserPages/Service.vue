<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages/>
            <InputField/>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import HeaderForPages from "@/Components/HeaderForPages.vue";
import InputField from "@/Components/InputField.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { provide, ref } from "vue";
const status = ref('Хорошего дня!')
provide('status', {
    status
})
</script>
