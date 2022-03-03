<template>
    <div class="row margin-container">
        <div class="col-sm-3 p-2">
            <div class="card  my-2">
                <div class="card-body">
                    <h5 class="card-title">Skills</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Select your best skills</h6>
                    <hr>
                    <div v-for="(skill,index) in skills" class="form-check form-switch">
                        <input v-model="skill.check" class="form-check-input" type="checkbox" role="switch"
                               @change="changeCheck($event, index)" :id="skill.name">
                        <label class="form-check-label" :for="skill.name">{{ skill.name }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 p-2">
            <div v-for="(item , index) in rates" :key="item.name" class="card my-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="bd-highlight ">
                            <p class="mb-0 "><strong class="fs-3">{{ item.name }}</strong>&nbsp; &nbsp; Rate this skill.
                                (5 being best) </p>
                        </div>
                        <div class=" bd-highlight">&nbsp; <strong class="fs-1">{{ item.rate }}</strong></div>
                    </div>
                    <input type="range" v-model="item.rate" class="form-range" min="0" max="5" id="customRange2">
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        computed: mapState({
            skills: 'skills',
            rates: 'rates',
            navBar:'navBar',
            btnScanDisable:'btnScanDisable',

        }),
        data() {
            return {}
        },
        created() {
            this.$store.commit('SET_NAVBAR', true);
        },
        methods: {
            changeCheck($event, index) {
                if ($event.target.checked) {
                    this.$store.commit('UPDATE_CHECK_SKILL', {index, value: $event.target.checked});
                    this.$store.commit('ADD_RATE', {skill: this.$store.state.skills[index].name, rate: 0})
                } else {
                    this.$store.commit('UPDATE_CHECK_SKILL', {index, value: $event.target.checked});
                    this.$store.commit('REMOVE_RATE', {name: this.$store.state.skills[index].name})
                }
                if (this.rates.length === 0) {
                    this.$store.commit('SET_SCAN_DISABLE', true);
                }else{
                    this.$store.commit('SET_SCAN_DISABLE', false);
                }
            }
        }
    }
</script>

<style scoped>

</style>
