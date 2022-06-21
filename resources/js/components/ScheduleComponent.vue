<template>
    <div>
        <div class="form-group form-row" v-for="(schedule, index) in schedules">
            <div class="col-11">
                <input type="text" class="form-control" name="schedule[][]" placeholder="Hour (ex: 23:50)">
            </div>
            <div class="col-1">
              <button class="btn btn-outline-danger" @click="removeSchedule(index)" type="button">x</button>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-outline-secondary" @click="addSchedule" type="button">Add Schedule</button> 
        </div>
    </div>
</template>

<script>
    export default {
        data: ()  => ({
            schedules : []
        }),
        methods: {
            addSchedule() {
                this.schedules.push({
                    hour:''
                })
            },
            removeSchedule(index){
                this.schedules.splice(index, 1)
            }
        }
    }
</script>
