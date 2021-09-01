<template>
    <form name="event_form" id="event_form" class="w-1/4" @submit.prevent="formSubmit">
        <div class="py-4 px-8">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert" v-if="error">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">Please fill up the required fields.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="error = false">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>

            <div class="mb-4">
                <label class="block text-grey-500 text-sm font-bold mb-2">Event: <span class="text-red-500">*</span></label>
                <input class=" border rounded w-full py-2 px-3 text-grey-500" type="text"
                    name="name" id="name" value="" placeholder="Enter Event Name" v-model="form.name">
            
            </div>

            <div class="mb-4 flex">
                <div class="mr-1">
                    <label class="block text-grey-500 text-sm font-bold mb-2">From : <span class="text-red-500">*</span></label>
                    <input class=" border rounded w-full py-2 px-1 text-grey-500" type="date"
                        name="from_date" id="from_date" value="" v-model="form.from">
                
                </div>
                <div class="">
                    <label class="block text-grey-500 text-sm font-bold mb-2">To : <span class="text-red-500">*</span></label>
                    <input class=" border rounded w-full py-2 px-1 text-grey-500" type="date"
                        name="to_date" id="to_date" value="" v-model="form.to">
                
                </div>
            </div>
            <div class="mb-4 flex flex-wrap"> 
                <label v-for="(date, i) in dates" :for="date" class="mr-1" :key="i">
                    <input type="checkbox" name="date_selected" :id="date" v-model="form.days" :true-value="[]" :value="date">
                    {{ trimDate(date) }}
                </label>
                <span class="text-red-500">*</span>

            </div>
            <div class="mb-4">
                <button
                    class="mb-2 mx-16 rounded-full py-1 px-24 bg-gradient-to-r from-green-400 to-blue-500 ">
                    Save
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: 'EventForm',
        data() {
            return {
                dates: [
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday'
                ],
                error: false,
                form: {
                    days: [],
                    name: '',
                    from: '',
                    to: ''
                }
            }
        },
        methods: {
            trimDate(date) {
                return date.substring(0, 3);
            },
            async formSubmit() {
                try{
                    let { data } = await axios.post('/api/events', this.form)

                    this.error = false

                    this.$emit('eventAdded');
                }catch(err) {
                    this.error = true
                }
            }
        }
    }
</script>
