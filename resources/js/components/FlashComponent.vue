<template>
    <transition name="slide-fade">
        <div class="bg-white shadow-md rounded-xl border border-gray-300 p-3 text-black z-50 absolute top-10 right-20" role="alert" v-show="show">
            <div class="inline-flex">
                <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="ml-4">
                    <p class="font-bold">{{ message_body }}</p>
                    <p class="text-gray-600">Het is succesvol opgeslagen</p>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['message'],

    data() {
        return {
            message_body: '',
            show: false
        }
    },
    created() {
        if (this.message) {
            this.flash(this.message);
        }
        window.events.$on('flash', message => this.flash(message));
    },
    methods: {
        flash(message) {
            this.message_body = message;
            this.show = true;
            this.hide();
        },
        hide() {
            setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    }
}
</script>


<style>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.4s;
}
.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(400px);
    opacity: 0;
}
</style>
