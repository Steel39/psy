<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <form @submit.prevent="submit">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <span for="certificate.name" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                Название
                            </span>
                            <div class="p-6  dark:text-gray-100">
                                <input class="form-control w-1/2 rounded-md text-gray-900 bg-yellow-100 duration-300 shadow-inner focus:shadow-black" type="text"
                                       name="name" id="name" v-model="form.name"/>
                            </div>
                        </div>
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 ">
                            <span class="p-6 font-bold text-gray-900 dark:text-gray-100">
                                Описание
                            </span>
                            <div class="p-6 dark:text-gray-100">
                                <input class="rounded-md w-full text-gray-900 bg-yellow-100 shadow-inner focus:shadow-black duration-200" type="text"
                                       name="description" id="description" v-model="form.description"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                            Изображение
                        </span>
                        <div class="p-6 text-gray-900 dark:text-gray-100 ">
                            <input type="file" class="form-control border-2 shadow-inner shadow-black border-gray-900
                                  dark:text-black text-sans bg-yellow-100 rounded-lg" id="image" name="image" @change="onFileChange"
                                   :v-model="form.image">
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
                        <button @click="submit" class="p-2 ml-6 mb-4 bg-gradient-to-br duration-200 hover:shadow-lg
                                           hover:text-cyan-400 hover:shadow-cyan-400
                                           from-gray-400 to-zinc-600 rounded-md text-gray-900
                                   font-bold dark:text-gray-100" type="submit" :disabled="form.processing">
                            Сохранить
                        </button>
                    </div>

                </div>
            </form>

            <div class="mx-auto max-w-7xl mt-10 sm:px-6 lg:px-8 ">
                <div v-for="certificate in certificates" class=" bg-gray-200 dark:bg-gray-700 mt-5  rounded-lg py-6">
                    <div class="flex flex-wrap ">
                        <div class=" mx-auto ml-6">
                            <h1
                                class="text-3xl basis-1/4 font-bold text-gray-800 dark:text-gray-400 bg-gray-300 dark:bg-gray-800/40 shadow-lg  rounded-[10px] p-2 mb-2">
                                {{ certificate.name }}</h1>
                        </div>
                        <div class="container p-2 w-4/5 mx-auto md:items-center bg-gradient-to-br from-zinc-200 shadow-md to-gray-400 px-4
                                dark:bg-gradient-to-br dark:from-gray-600 dark:to-zinc-600 rounded-xl ">
                            <h4 class="font-semibold text-gray-800 text-right  dark:text-gray-300 mb-2">
                                {{ certificate.description }}</h4>
                        </div>
                        <div class="bg-gray-200 basis-3/4 justify-center  dark:bg-gray-700  rounded-lg  mt-4 py-8">
                            <div class="ml-6">
                                <img :src="`/storage/${certificate.image}`" alt="certificate"
                                     class="mb-8 rounded-md shadow-md shadow-gray-600">
                            </div>
                        </div>
                    </div>
                    <div class="h-10 p-6 order-last justify-end text-right flex-grow">
                        <button class="text-gray-700 bg-gradient-to-br from-gray-400 to-gray-200 shadow-lg
                                        hover:shadow-red-500
                                       p-2 font-medium rounded-md border-gray-400 hover:text-red-700 duration-200"
                                @click="deleteCertificate(certificate.id)"
                                :disabled="form.processing">
                            Удалить сертификат
                        </button>
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


const props = defineProps({
    certificates: Object,
})

const form = useForm({
    name: '',
    description: null,
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
const status = ref('Сертификаты')

provide('status', {
    status
})
const submit = () => {
    form.post(route('certificate.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            previewUrl.value = null
            status.value = 'Сертификат добавлен =)'
            console.log(form)
        },
        onError: (errors) => {
            form.errors.value = errors.errors;
            if ( form.errors.name) {
                status.value = form.errors.name
            }
            if (form.errors.image) {
                status.value = form.errors.image
            }
        },
    })
}

const deleteCertificate = (id) => {
    form.delete(route('certificate.delete', {id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Сертификат удален...'
        }
    })
}
const fileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

</script>
