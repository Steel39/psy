<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Header from "@/Pages/User/Header.vue";
</script>

<template class="w-full ">
    <Header />
    <div class="flex  flex-wrap mx-auto  w-full bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div
            class="w-full template_hide template_visible bg-stone-100 px-6 py-4 shadow-md  sm:rounded-lg dark:bg-gray-800">
            <div class="py-4">
                <div class="mx-auto sm:px-6 lg:px-4">
                    <div class="flex flex-col">

                        <div class="bg-stone-600/20 dark:bg-gray-700 shadow-inner shadow-black rounded-lg py-4">
                            <component_hide>
                                <slot />
                            </component_hide>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
@keyframes ani {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

component_hide {
    opacity: 0;
    animation: ani 0.5s forwards ease-in-out;
}
</style>
