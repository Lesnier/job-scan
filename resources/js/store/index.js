import Vue from "vue";
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        skills: [],
        rates: [],
        posts: [],
        navBar : false,
        btnScanDisable: true,
        btnScanVisible: true,
        btnBackVisible: false
    },
    mutations: {
        SET_SKILLS(state, skills) {
            state.skills = skills;
        },
        ADD_RATE(state, {skill, rate}) {
            state.rates.push({name: skill, rate: rate});
        },
        REMOVE_RATE(state, skill) {
            let keys = Object.keys(state.rates);
            for (let item of keys)  {
                let i = parseInt(item);
                if (state.rates[i].name === skill.name) {
                    state.rates.splice(i, 1);
                    break;
                }
            }
        },
        UPDATE_RATE(state, {skill, rate}) {
            state.rates[skill] = rate;
        },
        UPDATE_CHECK_SKILL(state, {index, value}) {
            state.skills[index]['check'] = value;
        },
        SET_POSTS(state, posts) {
            state.posts = posts;
        },
        SET_NAVBAR(state,navBar){
            state.navBar = navBar;
        },
        SET_SCAN_DISABLE(state,btnScanDisable){
            state.btnScanDisable = btnScanDisable;
        },
        SET_SCAN_VISIBLE(state,btnScanVisible){
            state.btnScanVisible = btnScanVisible;
        },
        SET_BACK_VISIBLE(state,btnBackVisible){
            state.btnBackVisible = btnBackVisible;
        }

    },
    actions: {
        getSkills({commit, state}) {
            axios.get('/api/skills').then((res) => {
                res.data.forEach((item) => {
                    item.check = false;
                });
                commit('SET_SKILLS', res.data);
            }).catch((err) => {
                console.log(err);
            });
        },
        searchPostBySkills({commit, state}) {
            let skillsUser = {
                skill:{
                }
            };
            for(let item in state.rates )
            {
                skillsUser.skill[state.rates[item].name.toLowerCase()] = state.rates[item].rate
            }
            if ( Object.keys(skillsUser).length > 0) {
                axios.post(`/api/postings/search/skills/`, skillsUser).then((res) => {
                    commit('SET_POSTS', res.data.results);

                }).catch((err) => {
                    console.log(err)
                });
            }
        }
    }
})
