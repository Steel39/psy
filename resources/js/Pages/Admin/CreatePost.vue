<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <form @submit.prevent="submit">


                <div class=" mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span for="post.title" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                            Название
                        </span>
                        <div class="p-6  dark:text-gray-100">
                            <input class="form-control rounded-md text-gray-900 bg-yellow-100" type="text" name="title"
                                id="title" v-model="form.title" />
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
                            <input class="rounded-md text-gray-900 bg-yellow-100" type="text" name="description"
                                id="description" v-model="form.description" />
                        </div>
                    </div>
                    <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div class="relative">
                            <label for="categories" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                Категории
                            </label>
                            <select id="categories" v-model="form.category" class="mt-1 block ml-6 bg-yellow-100 w-1/4 pl-30 mb-4
                            border-gray-300 focus:outline-none focus:ring-indigo-500
                             focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="" disabled>Выберите Категорию</option>
                                <option class="bg-yellow-100" v-for="category in categories" :key="category.id"
                                    :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div>
                        
                    </div>
                    <div class="grid grid-cols-2 gap-2 w-full">
                        <div class="mt-2  overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                                Текст
                            </span>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <textarea class="w-full rounded-xl h-40 bg-yellow-100 text-black" type="text"
                                    name="content" id="content" v-model="form.content">
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
                                    <img :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name">
                                    <p>Размер: {{ form.image.size | fileSize }}</p>
                                </div>
                                <div v-if="form.errors.image">
                                    <p style="color: red;">{{ form.errors.image }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    </div>
                    <div class="relativemt-2 overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="relative inline-block w-12 h-6 bg-gray-200 rounded-full">
                            <input type="checkbox" class="sr-only peer" v-model="isChecked">
                            <div
                                class="absolute inset-0 rounded-full transition-transform bg-white shadow-inner peer-checked:translate-x-6 peer-checked:bg-blue-600 peer-checked:shadow-none">
                            </div>
                        </div>
                        <button class="p-2 bg-gradient-to-br from-cyan-400 rounded-md text-gray-900
                                   font-bold dark:text-gray-100" type="submit" :disabled="form.processing">
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
import Dropdown from "@/Components/Dropdown.vue";

const form = useForm({
    title: '',
    description: '',
    content: '',
    image: null,
    isPublished: false,
    category: '',
    selectedTags: []
})
const previewUrl = ref(null);
const selectedTags = ref([]);

const props = defineProps({
    Post: Object,
    errors: Object,
    categories: Object,
    tags: Object,

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

console.log(props.tags, props.categories)
const submit = () => {
    form.post(route('storePost'), {
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
