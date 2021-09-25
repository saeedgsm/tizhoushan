import Vue from 'vue';
import Vuex from 'vuex';

import field from './modules/customizeField/Field';
import fieldCreate from "./modules/customizeField/FieldCreate";

Vue.use(Vuex);

export const store = new Vuex.Store({
        state: {},
        modules: {
            field,
            fieldCreate
        }
    }
);