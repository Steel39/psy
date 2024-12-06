<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Header from "@/Pages/User/Header.vue";
</script>

<template class="w-full ">
    <Header class="shadow-lg" />
    <div class="flex  flex-wrap mx-auto  w-full pt-6 sm:justify-center sm:pt-0 ">
        <div
            class="w-full template_hide template_visible  px-6 py-4 sm:rounded-lg">
            <div class="py-4">
                <div class="mx-auto sm:px-6 lg:px-4">
                    <div class="flex flex-col">

                        <div class=" rounded-lg py-4">
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
