<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        
        class="p-2 ml-6 mb-4 bg-gradient-to-br duration-200 hover:shadow-lg
                                           hover:text-cyan-400 hover:shadow-cyan-400
                                           from-gray-400 to-zinc-600 rounded-md text-gray-900
                                   font-bold dark:text-gray-100"
    >
        <slot />
    </button>
</template>
