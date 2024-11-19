<template>
    <GuestLayout>

    </GuestLayout>
</template>
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    post: Object,
})
console.log(props.post)


</script>
