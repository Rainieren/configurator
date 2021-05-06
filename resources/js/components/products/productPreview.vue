<template>
    <div class="w-100 w-full flex items-center flex-column">
        <card-preview v-if="data.interactionType !== 'radio' || data.interactionType !== 'input'" :data="data"></card-preview>
        <radio-preview v-if="data.interactionType === 'radio'" :data="data"></radio-preview>
    </div>

</template>

<script>
    import radioPreview from "./radioPreview.vue";

    export default {
        data() {
            return {

            }
        },
        components: {
            radioPreview
        },
        props: ['data']
    }
</script>
