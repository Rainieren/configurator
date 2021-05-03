<template>
    <div class="w-100 w-full flex items-center flex-column">
<!--        TODO:: Only show card if interaction type is NOT radio and NOT input-->
<!--        TODO:: Price must nullable -->
<!--        TODO:: New From cannot be lower than New To -->
<!--        TODO:: Limit stock field to 10 integers -->
<!--        TODO:: Limit weight, length, height inputs to ONLY numbers -->
<!--        TODO:: Only show limitPreview if interaction type is input (Remove all others) -->
<!--        TODO:: Add validation if the step chosen has products inside of other interaction types -->
<!--        TODO:: Selection of input types -->
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
