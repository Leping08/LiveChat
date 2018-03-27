<template>
    <vue-event-calendar :events="events"></vue-event-calendar>
</template>

<script>
    export default {
        data () {
            return {
                demoEvents: [{
                    date: '2018/04/08',
                    title: 'Derk Bday'
                }, {
                    date: '2018/03/09',
                    title: 'Bar',
                    desc: 'Some text here',
                    customClass: 'disabled highlight' // Custom classes to an calendar cell
                }],
                loadingEvents: false,
                events: []
            }
        },
        created() {
            this.getEvents();
        },
        methods: {
            getEvents: function () {
                axios.get('/api/events')
                    .then((response) => {
                        this.events = response.data;
                        this.loadingEvents = false;
                    })
                    .catch((e) => {
                        this.loadingEvents = false;
                        console.log(e);
                    });
            }
        }
    }
</script>