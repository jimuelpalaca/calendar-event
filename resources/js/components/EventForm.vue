<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">Calendar</div>

                    <div class="row card-body">
                        <div class="col-md-5">

                            <div class="form-group">
                                <label for="event">Event</label><br>
                                <input id="event" v-model="name" placeholder="Event Name" class="w-100"> <br>
                            </div>
                            <div class="form-group">
                                <label for="date-from">From</label>
                                <datepicker id="date-from" v-model="dateFrom" input-class="w-100"
                                            :disabled-dates="disabledDates"/>
                                <label for="date-to">To</label>
                                <datepicker id="date-to" v-model="dateTo" input-class="w-100"
                                            :disabled-dates="disabledDates"/>
                            </div>
                            <div class="form-group">
                                <ul class="list-inline">
                                    <li class="list-inline-item" v-for="weekday in weekdays" :key="weekday.value">
                                        <input type="checkbox" :id="weekday.day" :value="weekday.value"
                                               v-model="checkedDays">
                                        <label :for="weekday.day">{{ weekday.day }}</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" v-on:click="saveEvent">Save</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';

    export default {
        name: 'EventForm',
        props: {
            api: String
        },
        mounted() {
            const firstDayOfMonth = new Date(this.year, this.month, 1);
            const lastDayOfMonth = new Date(this.year, this.month + 1, 0);

            console.log(new Date().getDay());
            console.log(firstDayOfMonth.getDay());
            console.log(lastDayOfMonth.getDay());
        },
        data() {
            return {
                name: "",
                event: null,
                checkedDays: [],
                dateFrom: new Date(),
                dateTo: new Date(),
                month: new Date().getMonth(),
                year: new Date().getFullYear(),
                weekdays: [
                    {
                        day: 'Sun',
                        value: 0
                    },
                    {
                        day: 'Mon',
                        value: 1
                    },
                    {
                        day: 'Tue',
                        value: 2
                    },
                    {
                        day: 'Wed',
                        value: 3
                    },
                    {
                        day: 'Thu',
                        value: 4
                    },
                    {
                        day: 'Fri',
                        value: 5
                    },
                    {
                        day: 'Sat',
                        value: 6
                    }
                ],
                disabledDates: {
                    customPredictor: (date) => {
                        date.setHours(0, 0, 0, 0);
                        const firstDayOfMonth = new Date(this.year, this.month, 1);
                        const lastDayOfMonth = new Date(this.year, this.month + 1, 0);

                        return (date < firstDayOfMonth) || (date > lastDayOfMonth);
                    }
                }
            }
        },
        methods: {
            saveEvent: function () {
                axios.post(this.api, {
                    name: this.name,
                    days: this.checkedDays,
                    starts_at: moment(this.dateFrom).format('YYYY-MM-DD'),
                    ends_at: moment(this.dateTo).format('YYYY-MM-DD')
                }).then(({data: apiResponse}) => (this.event = apiResponse.data))
            },
        },
        components: {
            Datepicker
        }
    }
</script>

<style scoped>

</style>
