<template>
    <div class="space-y-5">
        <form action="" method="POST">
            <input type="hidden" name="_token" :value="csrf">
        </form>
        <transition enter-active-class="animate__animated animate__bounceIn" leave-active-class="animate__animated animate__bounceOut" mode="out-in">
            <div class="flex text-green-600 font-medium space-x-3 items-center" v-if="messageShow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>Saved succesfully!</p>
            </div>
        </transition>
        <div class="" v-if="steps.length != 0">
            <table  class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-x-scroll">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Draggable
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Interaction type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Optional
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created at
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Updated at
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <draggable :list="stepsNew" :options="{animation:200, handle: '.handle'}" :element="'tbody'" class="bg-white divide-y divide-gray-200" @change="onChange()">
                    <tr v-for="(step, index) in stepsNew">
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="handle mr-3 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ step.order }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ step.name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap" v-if="step.interaction_type === 1">Card</td>
                        <td class="px-6 py-3 whitespace-nowrap" v-if="step.interaction_type === 2">Input</td>
                        <td class="px-6 py-3 whitespace-nowrap" v-if="step.interaction_type === 3">Radio</td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div v-if="step.is_optional" class="">Yes</div>
                            <div v-else class="">No</div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ getTimeForHumans(step.created_at) }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ getTimeForHumans(step.updated_at) }}</td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                            <div class="flex space-x-4">
                                <a :href="'/dashboard/step/' + step.id + '/edit'" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <a :href="'/dashboard/step/' + step.id">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <form :action="'/dashboard/step/' + step.id + '/delete'" method="POST" class="text-red-500">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </draggable>
            </table>
        </div>
        <div v-else class="text-center">
            <div class="w-100 text-center flex items-center justify-center flex-column">
                <p class="font-medium text-lg">You dont have any steps yet. Create a step using the button in the top right corner.</p>
                <img :src="'/images/empty_1.svg'" class="w-25 my-24" alt="">
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import moment from 'moment'

export default {
    props: ['steps'],

    data () {
        return {
            stepsNew: this.steps,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            messageShow: false,
            images: ['empty_1.svg', 'empty_2.svg', 'empty_3.svg']
        };
    },
    components: {
        draggable,
        moment
    },
    methods: {
        onChange() {
            this.stepsNew.map((step, index) => {
                step.order = index
            });

            axios.put('/api/change/steps/order', {steps: this.stepsNew})
                .then(response => {
                    this.messageShow = true;
                    setTimeout(() => {
                        this.messageShow = false;
                    }, 3000);
                }).catch(err => {
                console.log("There has been an error getting all manufacturers")
            });
        },
        getTimeForHumans(time) {
            return moment(time).format('LL');
        }
    }
}
</script>
