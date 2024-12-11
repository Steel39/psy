<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <HeaderForPages />
            <div class="flex flex-col justify-items-center">
                <div v-if="isEdit">
                    <EditMainPage :pageData="pageData" @back="closeEdit" />
                </div>
                <div v-else>
                    <div v-if="showFieldBlock" class="flex flex-col p-4">
                        <form @submit.prevent="submit">
                            <InputField class="w-1/2 text-center" name="header" v-model="form.header" type="text" />
                            <textarea
                                class="w-3/4  mx-6 mt-4 rounded-xl h-40 bg-yellow-100 text-black shadow-inner focus:shadow-black duration-200"
                                type="text" name="content" id="content" v-model="form.content">
                            </textarea>
                            <div class="grid  mx-6 mt-4 justify-items-center">
                                <input class="" @change="onFileChange" name="image" type="file" :v-model="form.image" />
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                                <div v-if="previewUrl" class="mt-4">
                                    <img class="rounded-md" :src="previewUrl" :alt="'Предпросмотр: ' + form.image.name">
                                    <p class="font-medium text-gray-400">Размер: {{ form.image.size | fileSize
                                        }}</p>
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
                    <div v-for="data in mainData" class="flex flex-col mx-10 dark:text-white shadow-lg
                    shadow-gray-400/90 mt-2 text-left p-2 rounded-md">
                        <img class="w-1/2" :src="`/storage/${data.image}`">
                        <p class="font-semibold p-4">{{ data.content }}</p>
                        <div class="grid grid-cols-2 justify-items-center decoration-pink-800">
                            <button @click="deleteMainData(data.id)" class=" w-1/4 p-2 mt-2  hover:bg-red-400 rounded">
                                Удалить
                            </button>
                            <button class=" w-1/4 p-2 mt-2  hover:bg-lime-400 rounded " @click="getEdit(data)">
                                Редакт.
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, provide, ref } from "vue";
import HeaderForPages from "@/Components/HeaderForPages.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputField from "@/Components/InputField.vue";
import EditMainPage from "@/Components/EditMainPage.vue";

const status = ref('Редактор главной страницы')
const previewUrl = ref(null);
const isEdit = ref(false)


const emit = defineEmits({})

provide('status', {
    status
})

const closeEdit = () => {
    isEdit.value = false
}
const props = defineProps({
    mainData: {
        type: Object,
        default: null
    }
})
console.log(props.mainData)

const pageData = ref(null)

const form = useForm({
    header: '',
    content: '',
    image: File,
})
const submit = () => {
    form.post(route('admin.page.main.store'), {
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

const showFieldBlock = computed(() => {
    props.mainData.forEach(items => {
        console.log(items)
    });
    return props.mainData !== Object
})

const getEdit = (data) => {
    isEdit.value = true,
    pageData.value = data,
    window.scrollTo(0, top)
}

const deleteMainData = (id) => {
    form.delete(route('admin.page.main.delete', { id: id }), {
        preserveScroll: true,
        onSuccess: () => {
            status.value = 'Удалено...'
        }
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
