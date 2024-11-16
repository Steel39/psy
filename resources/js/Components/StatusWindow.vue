<template>
    <div class="bg-gray-950 rounded-md p-2 text-center shadow shadow-gray-900">
                           <span class=" font-sans  shadow-cyan-400 font-semibold items-center text-center text-cyan-200">
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
