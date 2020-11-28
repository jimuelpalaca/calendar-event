<template>
    <div class="card">
        <div class="card-header">
            <strong>
                {{ `${new Date().toLocaleDateString(undefined, { month: 'short'})} ${year}` }}
            </strong>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li v-for="monthDay in monthDays" class="list-group-item" :class="{'list-group-item-success': hasEvent(monthDay)}">
                    <div class="row">
                        <div class="col-md-2">
                            {{ monthDay }} {{ getWeekdayName(monthDay)}}
                        </div>
                        <div class="col-md-10">
                            <div v-if="hasEvent(monthDay)">
                                {{ event.name }}
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Calendar",
        props: {
            event: Object
        },
        data() {
            return {
                weekdays: [
                    "Sun",
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat"
                ],
                month: new Date().getMonth(),
                year: new Date().getFullYear(),
            }
        },
        methods: {
            getWeekdayName: function (day) {
                return this.weekdays[new Date(this.year, this.month, day).getDay()]
            },
            hasEvent: function (day) {
                const date = new Date(this.year, this.month, day);
                const dateDay = date.getDay();
                let hasEvent = false;

                if (!this.event) {
                    return false;
                }

                const eventStartDate = new Date(this.event.starts_at).setHours(0, 0,0);
                const eventEndDate = new Date(this.event.ends_at).setHours(23, 59, 59);

                if (date.getTime() >= eventStartDate && date.getTime() <= eventEndDate) {
                    hasEvent = true;
                }

                if (!this.event.days.includes(dateDay)) {
                    hasEvent = false;
                }

                return hasEvent;
            }
        },
        computed: {
            monthDays: function () {
                return new Date(this.year, this.month + 1, 0).getDate()
            }
        }
    }
</script>

<style scoped>

</style>
