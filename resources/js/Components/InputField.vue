<script setup>
const props = defineProps({
    name: {
        required: true,
        type: String
    },
    type: {
        required:true,
        type: String
    }
})

const model = defineModel({
    type: String,
    required: true
})
</script>

<template>
    <div class="p-6 dark:text-gray-100">
        <input
            class="rounded-md w-full text-gray-900 bg-yellow-100 dark:bg-yellow-200/90  shadow-inner focus:shadow-black duration-200"
            :type="type"
            v-model="model"
            :name="props.name" id="" />
    </div>
</template>
