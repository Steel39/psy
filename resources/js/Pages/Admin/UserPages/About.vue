<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages />
            <div class="grid grid-cols-2">
                <div>
                    <form @submit.prevent="submit">
                        <textarea
                                    class="w-full mx-6 mt-4 rounded-xl h-40 bg-yellow-100 text-black shadow-inner focus:shadow-black duration-200"
                                    type="text"
                                    name="content" id="content" v-model="form.content">
                            </textarea>

                        <div class="mx-6 mt-4">
                            <input class="" @change="onFileChange" name="image" type="file" :v-model="form.image" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="previewUrl" class="mt-4">
                                <img class="rounded-md" :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name">
                                <p class="font-medium text-gray-400">Размер: {{ form.image.size | fileSize }}</p>
                            </div>
                            <div v-if="form.errors.image">
                                <p style="color: red;">{{ form.errors.image }}</p>
                            </div>
                        </div>

                        <SecondaryButton class="mt-4" :disabled="form.processing" @click="submit">
                            Добавить контент
                        </SecondaryButton>
                    </form>
                </div>
                <div>
                    <div class="flex w-1/2 flex-col dark:text-white border mt-2 text-left p-2 rounded-md">
                        <label class="font-bold">{{ props.content }}</label>
                        <label>{{ props.image }}</label>
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
const previewUrl = ref(null);

provide('status', {
    status
})

const props = defineProps({
    about: Object
})
console.log(props.about)
const form = useForm({
    content: '',
    image: File,
})

const submit = () => {
    form.post(route('admin.page.about.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            previewUrl.value = null
            status.value = 'Контент добавлен =)'
        },
        onError: (errors) => {
            form.errors.value = errors.errors;
            if (form.errors.name) {
                status.value = form.errors.name
            }
            if (form.errors.image) {
                status.value = form.errors.image
            }
        },
    })
}

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        previewUrl.value = URL.createObjectURL(file);
    } else {
        form.image = null;
        previewUrl.value = null;
    }
};
</script>
