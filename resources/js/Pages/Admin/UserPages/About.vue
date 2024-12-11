<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages />
            <div class="grid md:grid-cols-2" >
                <div v-if="!isEdit">
                    <form @submit.prevent="submit">
                        <textarea
                                    class="w-3/4  mx-6 mt-4 rounded-xl h-40 bg-yellow-100 text-black shadow-inner focus:shadow-black duration-200"
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
                <div v-else class="p-10">
                    <EditAbout :about="aboutForEdit" @back="closeEdit"/>
                </div>
                <div >
                    <div v-for="about in abouts"class="flex  flex-col dark:text-white shadow-lg
                     shadow-gray-400/90 mt-2 text-left p-2 rounded-md">
                        <img class="w-72" :src="`/storage/${about.image}`">
                        <p class="font-semibold">{{ about.content }}</p>
                        <button class=" w-1/4 p-2 mt-2  hover:bg-gray-400 rounded " @click="getEdit(about)">
                            Редакт.
                        </button>
                        <button @click="deleteAbout(about.id)" :disabled="isEdit" class=" w-1/4 p-2 mt-2  hover:bg-gray-400 rounded">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import EditAbout from "@/Components/EditAbout.vue";
import HeaderForPages from "@/Components/HeaderForPages.vue";
import InputField from "@/Components/InputField.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { provide, ref } from "vue";

const status = ref('Хорошего дня!')
const previewUrl = ref(null);

const imageUrl = (path) => {
    return `/storage/${path}`
}

provide('status', {
    status
})
const isEdit = ref(false)
const aboutForEdit = ref(null)
const props = defineProps({
    abouts: Object
})

const form = useForm({
    content: '',
    image: File,
})

const getEdit = (about) => {
    isEdit.value = true
    aboutForEdit.value = about
    window.scrollTo(0, 0);
}

const deleteAbout = (id) => {
    form.delete(route('admin.page.about.delete', {id: id}),{
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Удалено...'
        }
    })
}

const closeEdit = () => {
    isEdit.value = false
}
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
