<template>
    <transition enter-active-class="animate__animated animate__zoomIn" leave-active-class="animate__animated animate__zoomOut" mode="out-in">
        <div class="border border-gray-200 rounded-md px-4 py-2 flex justify-between text-gray-500 space-x-4 shadow-sm w-full items-center">
            <div class="flex space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <p v-if="file instanceof Object">{{ file.name }}</p>
                <p v-else>{{ file }}</p>
            </div>
            <div class="">
                <a @click="$emit('update-images', file, preview), file = '', preview = null" class="hover:text-gray-900 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['file', 'preview'],

    data() {
        return {

        }
    },
    methods: {

    }
}
</script>
