import Vue from 'vue';
import Notify from '../../../notification/Notification';
const state = {};
const getters = {};
const mutations = {};
const actions = {
    FieldStore(context,FieldData){
        Vue.http.post( "api/admin/field/store",FieldData)
            .then(response => {
                console.log(FieldData);
                this.field_name_latin = "";
                this.field_name = "";
                Notify.success('اطلاعات فیلد سفارشی با موفقیت ثبت گردید!');
            }).then(data => {

        });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

