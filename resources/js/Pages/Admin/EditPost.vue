<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <form @submit.prevent="submit(post.id)">
                <div class=" mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <span for="post.title" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                            Название
                        </span>
                            <div class="p-6  dark:text-gray-100">
                                <input class="form-control w-1/2 rounded-md text-gray-900 bg-yellow-100" type="text"
                                       name="title"
                                       id="title"
                                       v-model="form.title"/>
                            </div>
                            <div v-if="errors.title" class="text-danger">
                                {{ errors.title }}
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
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <div class="relative">
                                <label for="categories" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                    Категория
                                </label>
                                <select id="categories" v-model="form.category_id" class="mt-4 block ml-6 bg-yellow-100 w-1/2 pl-30 mb-4
                            border-gray-300 focus:outline-none focus:ring-indigo-500
                             focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option :value="null" disabled>Выберите Категорию</option>
                                    <option class="bg-yellow-100  duration-200" v-for="category in categories" :key="category.id"
                                            :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <div class="mb-4">
                                <label for="tags" class="p-6 text-gray-900 font-bold dark:text-gray-100">
                                    Теги
                                </label>
                                <div class="flex flex-wrap mt-4 p-6">
                                    <button
                                        v-for="tag in tags"
                                        :key="tag.id"
                                        :class="['mr-2 mb-2 px-4 py-2 rounded-md  hover:shadow-sm hover:shadow-gray-300 duration-200 hover:duration-200', tag_ids.includes(tag.id)
                                        ? 'bg-yellow-100 text-gray-800 shadow-sm shadow-blue-200'
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
                    </div>
                    <div class="mt-2 grid grid-cols-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div class="p-4 mx-auto ml-auto">
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" :value="true" v-model="form.is_published" class="form-radio bg-gradient-to-tl from-green-500 to-cyan-300" />
                                <span class="ml-2  text-gray-900 font-bold dark:text-gray-100">Опубликовать</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" :value="false" v-model="form.is_published" class="form-radio bg-gradient-to-tl from-gray-200 to-zinc-400" />
                                <span class="ml-2 text-gray-900 font-bold dark:text-gray-100">Черновик</span>
                            </label>
                        </div>
                        <div class="relativemt-2 p-4 ml-auto overflow-x-auto shadow-md shadow-lime-400 sm:rounded-lg">
                            <button class="p-2 bg-gradient-to-br hover:shadow-lg hover:text-cyan-400 hover:shadow-cyan-400 duration-200 from-gray-400 to-zinc-600 rounded-md text-gray-900
                                   font-bold dark:text-gray-100" type="submit" :disabled="form.processing">
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

const props = defineProps({
    post: Object,
    errors: Object,
    categories: Object,
    tags: Object,
})

const form = useForm({
    title: props.post.title,
    description: props.post.description,
    content: props.post.content,
    image: null,
    is_published: props.post.is_published,
    category_id: props.post.category_id,
    tag_ids: props.post.tags.map(tag => tag.id),
    _method: 'put'
})

const previewUrl = ref(null);

const imagePath = ref(`/storage/${props.post.image}`)

const tag_ids = ref(props.post.tags.map(tag => tag.id));

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

const toggleTag = (tagId) => {
    const index = tag_ids.value.indexOf(tagId);
    if (index === -1) {
        tag_ids.value.push(tagId);
    } else {
        tag_ids.value.splice(index, 1);
    }
    form.tag_ids = tag_ids.value
};


console.log(props.post.tags, props.categories)

const deletePostImage = (id) => {
    form.update(route('post.image.delete', { id: id}), {
        preserveScroll: true,
        onSuccess: () => {
            previewUrl.value = null
            status.value = "Изорбражение удалено"
        },
    })
}

const submit = (id) => {
    if(!form.image instanceof File) {
        form.image = null
    }
    form.post(route('post.update', {id: id}), {
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
    console.log(form.image)
}

const status = ref('Редактируем пост...')
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
