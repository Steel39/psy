<template>
    <GuestLayout>
        <div class="py-12">
            <div v-for="data in answers" class="flex flex-col text-center gap-4 p-4">
                <div>
                    <h1
                        class="text-4xl font-bold text-gray-800 dark:text-gray-300 drop-shadow-xl rounded-[10px] p-2 mb-4">
                        {{ data.question }}
                    </h1>
                    <p class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">
                        {{ data.answer }}
                    </p>
                    <div class="border border-gray-500">

                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps({
    answers: Object
})
</script>
