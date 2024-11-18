<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <form @submit.prevent="submit">
                <div class=" mx-auto max-w-7xl sm:px-6 lg:px-8 ">
                    <div class="grid grid-cols-2 gap-2 ">
                        <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800 ">
                            <span for="post.title" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                Название
                            </span>
                            <div class="p-6  dark:text-gray-100">
                                <input
                                    class="form-control w-1/2 rounded-md text-gray-900 bg-yellow-100  shadow-inner focus:shadow-black duration-200"
                                    type="text"
                                    name="title"
                                    id="title" v-model="form.title"/>
                            </div>
                            <div v-if="errors.title" class="text-danger">
                                {{ errors.title }}
                            </div>
                        </div>
                        <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                        <span class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            Описание
                        </span>
                            <div class="p-6 dark:text-gray-100">
                                <input
                                    class="rounded-md w-full text-gray-900 bg-yellow-100  shadow-inner focus:shadow-black duration-200"
                                    type="text"
                                    name="description"
                                    id="description" v-model="form.description"/>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-2 overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                            <div class="relative">
                                <label for="categories" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                    Категория
                                </label>
                                <select id="categories" v-model="form.category_id" class="mt-4 block ml-6 bg-yellow-100 w-1/2 pl-30 mb-4
                            border-gray-300 focus:outline-none focus:ring-indigo-500
                             focus:border-indigo-500 sm:text-sm rounded-md shadow-inner focus:shadow-black duration-200">
                                    <option :value="null" disabled>Выберите Категорию</option>
                                    <option class="bg-yellow-100 shadow-inner focus:shadow-black  duration-200"
                                            v-for="category in categories" :key="category.id"
                                            :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                            <div class="mb-4">
                                <label for="tags" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                    Теги
                                </label>
                                <div class="flex flex-wrap mt-4 p-8">
                                    <button
                                        v-for="tag in tags"
                                        :key="tag.id"
                                        :class="['mr-2 mb-2 px-4 py-2 rounded-md border focus:border-indigo-400 border-transparent hover:border-gray-200 duration-300', tag_ids.includes(tag.id)
                                        ? 'bg-yellow-100 text-gray-800 shadow-inner shadow-black'
                                        : 'bg-white  text-black dark:text-gray-200 dark:bg-gray-800' ]"
                                        @click.prevent="toggleTag(tag.id)"
                                    >
                                        {{ tag.name }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 w-full">
                        <div class="mt-2  overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                            <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                                Текст
                            </span>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <textarea
                                    class="w-full rounded-xl h-40 bg-yellow-100 text-black shadow-inner focus:shadow-black duration-200"
                                    type="text"
                                    name="content" id="content" v-model="form.content">
                            </textarea>
                            </div>
                        </div>
                        <div class="mt-2 overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                            <span class=" p-6 text-gray-900 font-bold dark:text-gray-100">
                                Изображение
                            </span>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <input type="file" class="form-control border-2 shadow-inner shadow-black border-gray-900
                                  dark:text-black text-sans bg-yellow-100 rounded-lg" id="image" name="image"
                                       @change="onFileChange"
                                       :v-model="form.image">
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                                <div v-if="previewUrl" class="mt-4 ">
                                    <img class="shadow shadow-black rounded-lg" :src="previewUrl"
                                         :alt="'Предпросмотр: ' + form.image.name">
                                    <p>Размер: {{ form.image.size | fileSize }}</p>
                                </div>
                                <div v-if="form.errors.image">
                                    <p style="color: red;">{{ form.errors.image }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 grid grid-cols-2 overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800">
                        <div class="p-4 mx-auto ml-auto">
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" :value="true" v-model="form.is_published"
                                       class="form-radio bg-gradient-to-tl from-green-500 to-cyan-300"/>
                                <span class="ml-2  text-gray-900 font-bold dark:text-gray-100">Опубликовать</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" :value="false" v-model="form.is_published"
                                       class="form-radio bg-gradient-to-tl from-gray-200 to-zinc-400"/>
                                <span class="ml-2 text-gray-900 font-bold dark:text-gray-100">Черновик</span>
                            </label>
                        </div>
                        <div class="relativemt-2 p-4 ml-auto overflow-x-auto shadow-md shadow-lime-400 sm:rounded-lg">
                            <button class="p-2 bg-gradient-to-br hover:shadow-lg hover:text-cyan-400 hover:shadow-cyan-400 from-gray-400 to-zinc-600 rounded-md text-gray-900
                                   font-bold dark:text-gray-100 duration-200" type="submit" :disabled="form.processing">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {provide, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    title: '',
    description: '',
    content: '',
    image: null,
    is_published: false,
    category_id: '',
    tag_ids: []
})
const previewUrl = ref(null);
const tag_ids = ref([]);

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

const toggleTag = (tagId) => {
    const index = tag_ids.value.indexOf(tagId);
    if (index === -1) {
        tag_ids.value.push(tagId);
    } else {
        tag_ids.value.splice(index, 1);
    }
    form.tag_ids = tag_ids.value
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
            form.errors.value = errors.errors;
            status.value = form.errors
        },
    })
    console.log(form.is_published)
    console.log(form.errors)
}

const status = ref('Создаем новый пост =)')
provide('status', {
    status,
    submit
})

const fileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
</script>
