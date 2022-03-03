<template>
    <div>
        <nav v-show="navBar" class="navbar fixed-top navbar-light bg-light shadow-sm">
            <div class="container">
                <button v-if="btnBackVisible" class="btn btn-secondary btn-lg me-2" type="button"
                        @click="back()">
                    &nbsp; &nbsp;Back
                </button>
                <span v-else></span>
                <div class="d-flex justify-content-between">
                    <div class="p-2 bd-highlight  ">
                        <button v-show="btnScanVisible" :disabled="btnScanDisable" class="btn btn-success btn-lg me-2" type="button"
                                @click="searchPostBySkills()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg> &nbsp; &nbsp;Scan jobs
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
    import VueRouter from 'vue-router';
    import store from '../store';
    import Welcome from "./WelcomeComponet";
    import SearchConfiguration from "./SearchConfiguration";
    import SearchResult from "./SearchResult";
    import {mapState} from "vuex";

    export default {
        store,
        created() {
            this.$store.dispatch('getSkills');
        },
        methods: {
            searchPostBySkills() {
                this.$store.dispatch('searchPostBySkills')
                 this.$router.push('/search-result');

            },back(){
                this.$router.back();
                this.$store.commit('SET_BACK_VISIBLE',false);
                this.$store.commit('SET_SCAN_VISIBLE',true);
            }

        },
        computed: mapState({
            navBar: 'navBar',
            btnScanDisable: 'btnScanDisable',
            btnScanVisible:'btnScanVisible',
            btnBackVisible:'btnBackVisible'
        }),
        router: new VueRouter({
            mode: 'history',
            base: '/',
            routes: [
                {
                    path: '/welcome',
                    name: 'welcome',
                    component: Welcome
                },
                {
                    path: '/',
                    redirect: {name: 'welcome'},
                },
                {
                    path: '/search-configuration',
                    name: 'search-configuration',
                    component: SearchConfiguration,
                },
                {
                    path: '/search-result',
                    name: 'search-result',
                    component: SearchResult
                },
                {
                    path: '*',
                    redirect: '/'
                }
            ]
        })
    }

</script>

<style scoped>

</style>
