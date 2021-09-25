import Vue from 'vue';
const state = {
    fields:[]
};
const getters = {
    GetFields(state){
        return state.fields;
    }
};
const mutations = {
    SetFields(state,fields){
        state.fields = fields;
    }
};
const actions = {

    GetFieldsFromServer(context){
        //console.log(window.location.protocol + "//" + window.location.host);
        Vue.http.get( "api/admin/field/all")
            .then(response => {
                return response.json();
            }).then(data =>{
                context.commit("SetFields",data);
        });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

