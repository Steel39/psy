<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages />
            <div class="grid grid-cols-2">
                <div>
                    <form @submit.prevent="submit">
                        <InputField
                            name="name"
                            v-model="form.name"
                            type="text" />

                        <InputField
                            name="description"
                            v-model="form.description"
                            type="text" />
                        <SecondaryButton :disabled="form.processing" @click="submit">
                            Добавить услугу
                        </SecondaryButton>
                    </form>
                </div>
                <div>
                    <div class="flex w-1/2 flex-col dark:text-white border mt-2 text-left p-2 rounded-md" v-for="service in services">
                        <label class="font-bold">{{ service.name }}</label>
                        <label>{{ service.description }}</label>
                        <button class="p-2 w-1/4 hover:text-red-500"  @click="deleteService(service.id)">
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
import InputField from "@/Components/InputField.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { provide, ref } from "vue";

const status = ref('Хорошего дня!')
provide('status', {
    status
})

const props = defineProps({
    services: Object,
})
console.log(props.services)
const form = useForm({
    name: '',
    description: '',
})

const deleteService = (id) => {
    form.delete(route('admin.page.service.delete', {id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Услуга удалена'
        }
    })
}

const submit = () => {
    form.post(route('admin.page.service.store'), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Услуга добавлена'
        }
    })
}
</script>
