<template>
    <GuestLayout>
        <div class="py-12">
            <div v-for="data in services" class="flex flex-col text-center gap-4 p-4">
                <div>
                    <h1
                        class="text-4xl font-bold text-gray-800 dark:text-gray-300 drop-shadow-xl rounded-[10px] p-2 mb-4">
                        {{ data.name }}
                    </h1>
                    <p class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">
                        {{ data.description }}
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
    services: Object
})
console.log(props.services)
</script>
