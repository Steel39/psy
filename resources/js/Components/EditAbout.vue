<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps, ref, provide } from 'vue';

const props = defineProps({
    about: Object
})
const previewUrl = ref(null);
const emit = defineEmits (['back'])
console.log(props.about)
const imagePath = ref(`/storage/${props.about.image}`)

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        previewUrl.value = URL.createObjectURL(file);
    } else {
        form.image = null;
        previewUrl.value = imagePath;
    }
};

function close() {
   emit('back');
}


const form = useForm({
    content: props.about.content,
    image: null,
    _method: 'put',
})
const updateAbout = (id) => {
    if(!form.image instanceof File) {
        form.image = null
    }
    console.log(form.image)
    form.post(route('admin.page.about.update', {id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            previewUrl.value = null
            close();
        },
        onError: (errors) => {
            form.errors.value = errors.errors;
            status.value = form.errors
        },
    })
}

const fileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

const status = ref('Редактируем информацию о Вас...')
provide('status', {
    status
})
</script>
<template>
    <form @submit.prevent="updateAbout"></form>
    <div class="mt-2  overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
        <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
            Текст
        </span>
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <textarea class="w-full rounded-xl h-40 bg-yellow-100 text-black" type="text" name="content" id="content"
                v-model="form.content">
                            </textarea>
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
                <p class="mt-4">Новое изображение</p>
                <img :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name">
                <p>Размер: {{ form.image.size | fileSize }}</p>
            </div>
            <div>
                <p class="mt-4"> Текущее изображение</p>
                <img :src="imagePath" alt="Изображение отсутствует">

            </div>
            <div v-if="form.errors.image">
                <p style="color: red;">{{ form.errors.image }}</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 justify-beetswen">
        <button @click="close">
            Закрыть
        </button>
        <button @click="updateAbout(props.about.id)">
            Сохранить
        </button>
    </div>
</template>
