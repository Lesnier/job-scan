<template>
    <div class="row margin-container">
        <div class="col-sm-3">

                <div class="card-body">
                    <h4 class="card-title">Explore these jobs</h4>
                    <h6 class="card-subtitle mb-2 text-muted">We have found the jobs that best fit your skills</h6>

                </div>

        </div>
        <div class="col-sm-9">
            <div v-for="item in posts" class="card my-1" >
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="bd-highlight ">
                            <p class="mb-0 "><strong class="fs-3">{{item.title}}</strong> </p>
                            <small>{{item.company.name}}</small>
                            <h6>
                                <span v-for="skill in item.skill_list" :key="item.id" class="badge rounded-pill bg-secondary mx-1">{{skill}}</span>
                            </h6>
                        </div>
                        <div class=" bd-highlight">&nbsp; <strong class="fs-1">{{ item.score }}</strong></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        computed:mapState({
            posts: 'posts',
        }),
        created() {
            this.$store.commit('SET_BACK_VISIBLE', true);
            this.$store.commit('SET_SCAN_VISIBLE', false);
            this.$store.commit('SET_BACK_VISIBLE', true)
        }
    }
</script>

<style scoped>

</style>
