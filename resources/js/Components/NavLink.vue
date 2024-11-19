<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 shadow-inner shadow-black dark:text-cyan-300 dark:shadow-inner dark:shadow-black  text-sm rounded-md dark:shadow-sm font-medium  text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 focus:shadow-inner shadow-black text-sm rounded-md  font-medium  text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300   focus:text-gray-700 dark:focus:text-gray-300  transition duration-200 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
