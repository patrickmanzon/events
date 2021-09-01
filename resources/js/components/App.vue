<template>
    <div>
        <div class="flex bg-gray-300">
            <div id="menu" class="bg-gray-800 flex flex-col justify-between">
                <div>
                    <div class="h-16 bg-blue-500 text-white flex items-center justify-center">
                        <a class="block px-5 text-white text-lg h-8 flex items-center justify-center" href="javascript:;">
                            <span class="bg-blue-700 rounded-full h-8 w-8 flex items-center justify-center">
                            <i class="fas fa-spa fa-fw"></i>
                            </span>
                            <span class="hidden-item px-2">Events</span>
                        </a>
                    </div>
                    <ul class="text-white">
                        
                    </ul>
                </div>
                <a href="javascript:;" class="block p-4 text-center bg-gray-900">
                    <i class="fas fa-power-off text-red-500"></i>
                </a>
            </div>
            <div class="flex-1 h-full min-h-screen">
                <div class="bg-white p-3 py-5">&nbsp;</div>
                <div class="bg-white m-3 p-3 flex" style="min-height: calc(100vh - 75px);">

                    <EventForm @eventAdded="getDates"/>
 
                    
                    <Calendar :attributes="dates"/>
                    

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import EventForm from './EventFrom.vue'
    import Calendar from './Calendar.vue'
    export default {
        name: "App",
        components: {
            EventForm,
            Calendar
        },
        data() {
            return {
                dates: [],
                loaded: true
            }
        },
        methods: {
            async getDates() {
                let { data } = await axios.get('/api/events');
                this.dates = data.dates.map((date, i) => {
                    return {
                        key: 8,
                        customData: {
                            title: data.title,
                            class: data.class,
                        },
                        dates: new Date(date),
                    }
                });
            }
        },
        async created() {
            this.getDates();
        }
    }
</script>

