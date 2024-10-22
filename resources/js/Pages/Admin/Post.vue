<template>
    <AuthenticatedLayout>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Post
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
<script >
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {provide, ref} from "vue";

export default {
    components: {AuthenticatedLayout},
    setup() {
        const status = ref('Хорошего дня!')
        provide('status', {
            status
        })
    }
}

</script>
