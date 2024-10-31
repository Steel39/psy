<template>
    <div class="bg-gray-950  items-center rounded-md py-1 basis-1/2 text-center mt-4 mb-3">
                           <span class=" font-sans items-center text-center text-cyan-300">
                             {{ status }}
                           </span>
    </div>
</template>
<script setup>
import {inject} from "vue";

const {
    status,
    submit} = inject('status')
</script>
