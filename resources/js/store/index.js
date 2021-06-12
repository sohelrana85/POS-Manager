import Vue from 'vue';
import Vuex from "vuex";

import customerModules from "./customer/customer"

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        customer: customerModules,
    }

});

export default store;
