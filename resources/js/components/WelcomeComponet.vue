<template>
    <div class="row margin-container">
        <div class="col-md-12">
            <div class="px-4 py-5 my-5 text-center pt-5">
                <h1 class="display-5 fw-bold">Welcome to JobScan</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">Find the right job for your skills!!</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <router-link :to="{name:'search-configuration'}"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">Find Job</button></router-link>
                    </div>
                </div>
            </div>
    </div>
    </div>
</template>

<script>
    export default {
        created() {
            this.$store.commit('SET_NAVBAR',false);
        }
    }
</script>

<style scoped>

</style>
