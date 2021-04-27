<template>
    <configurator></configurator>

<!--    <flash v-bind:message="valueEmit"></flash>-->
</template>

<script>
    import Flash from '../components/FlashComponent.vue';
    import VueSession from 'vue-session'

    export default {
        components: { Flash },
        data() {
            return {
                valueEmit: this.$session.get('flash')
            };
        }
    }
</script>
