
<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class=" mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span for="certificate.name" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                            Название
                        </span>
                        <div class="p-6  dark:text-gray-100">
                            <input class="form-control w-1/2 rounded-md text-gray-900 bg-yellow-100" type="text"
                                   name="name"
                                   id="name" v-model="form.name"/>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            Описание
                        </span>
                        <div class="p-6 dark:text-gray-100">
                            <input class="rounded-md w-full text-gray-900 bg-yellow-100" type="text"
                                   name="description"
                                   id="description" v-model="form.description"/>
                        </div>
                    </div>
                </div>
                <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                                Изображение
                            </span>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <input type="file" class="form-control" id="image" name="image" @change="onFileChange"
                               :v-model="form.image">
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <div v-if="previewUrl">
                            <img :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name">
                            <p>Размер: {{ form.image.size | fileSize }}</p>
                        </div>
                        <div v-if="form.errors.image">
                            <p style="color: red;">{{ form.errors.image }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-for="certificate in certificates" class="flex flex-col">
                    <div class="bg-gray-200 dark:bg-gray-700  rounded-lg py-8">
                        <div class="grid grid-cols-2 gap-6 rounded-lg bg-gray-200 dark:text-gray-200 dark:bg-gray-700">
                            <div class="container  mx-auto p-4">
                                <h1
                                    class="text-3xl font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg  rounded-[10px] p-2 mb-2">
                                    {{ certificate.name }}</h1>
                            </div>
                            <div class="container p-2 w-4/5 mx-auto md:items-center bg-gradient-to-br from-zinc-200 shadow-md to-gray-400 px-4
                                dark:bg-gradient-to-br dark:from-gray-600 dark:to-zinc-600 rounded-xl ">
                                <h4 class="font-semibold text-gray-800 text-right  dark:text-gray-300 mb-2">
                                    {{ certificate.description }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-200  flex flex-auto  dark:bg-gray-700  rounded-lg  mt-4 py-8">
                        <div class="p-4 w-full">
                            <img :src="imagePath" alt="certificate"
                                 class="mb-8 rounded-md shadow-md shadow-gray-600">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {defineProps, ref, provide} from 'vue';
import {useForm} from "@inertiajs/vue3";

const form = useForm ({
    name: '',
    description: '',
    image: null
})
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
const previewUrl = ref(null);
const status = ref('Хорошего дня!')
provide('status', {
    status
})
const props = defineProps({
    certificates: Object,
})
</script>
