import { createStore } from 'vuex'
import Vue from 'vue';
import Articles from './modules/Articles';

// Create Store
const store = createStore({
    modules: {
        Articles
    }
});


export default store;