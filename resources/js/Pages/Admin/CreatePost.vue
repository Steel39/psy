<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <form @submit.prevent="submit">


                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span for="post.title" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                            Название
                        </span>
                        <div class="p-6  dark:text-gray-100">
                            <input 
                                class="form-control rounded-md text-gray-900 bg-yellow-100" 
                                type="text"
                                name="title"
                                id="title" 
                                v-model="form.title" />
                        </div>
                        <div v-if="errors.title" class="text-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="overflow-hidden mt-2 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            Описание
                        </span>
                        <div class="p-6 dark:text-gray-100">
                            <input 
                                class="rounded-md text-gray-900 bg-yellow-100" 
                                type="text" 
                                name="description"
                                id="description" 
                                v-model="form.description" />
                        </div>
                    </div>
                    <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                            Текст
                        </span>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <textarea class="w-1/2 rounded-xl h-40 bg-yellow-100 text-black"
                                type="text"
                                name="content"
                                id="content"
                                v-model="form.content">
                            </textarea>
                        </div>
                    </div>
                    <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                            Изображение
                        </span>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <input 
                                type="file" 
                                class="form-control"
                                id="image"
                                name="image"
                                @change="onFileChange"
                                :v-model="form.image">
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="previewUrl">
                                <img :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name" >
                                <p>Размер: {{ form.image.size | fileSize }}</p> 
                            </div>
                            <div v-if="form.errors.image">
                                <p style="color: red;">{{ form.errors.image }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative mt-2 overflow-x-auto shadow-md sm:rounded-lg">
                        <button class="p-2 bg-gradient-to-br from-cyan-400 rounded-md text-gray-900
                                   font-bold dark:text-gray-100" type="submit"
                                   :disabled="form.processing">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { provide, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: '',
    description: '',
    content: '',
    image: null
})
const previewUrl = ref(null);

const props = defineProps({
    Post: Object,
    errors: Object
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

const submit = () => {
    form.post(route('storePost'),{
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            previewUrl.value = null
        }, 
        onError: (errors) => {
            form.errors.value = Object.values(errors.errors).flat();
        },
    })
    console.log(form)
}

const status = ref('Создаем новый пост =)')
provide('status', {
    status
})

const fileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
</script>
