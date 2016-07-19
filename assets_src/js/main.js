/**
 * App
 */
import Vue from 'vue';
import VueRes from 'vue-resource';
import VueRouter from 'vue-router';


// templates
import App from './templates/app.vue';
import News from './templates/news.vue';
import Item from './templates/item.vue';


Vue.config.debug = true;
Vue.config.devtools = true;

Vue.use(VueRouter);
Vue.use(VueRes);

var router = new VueRouter();

router.map({
    '/home': {
        component: News
    },
    '/news/:slug': {
        name: 'news',
        component: Item
    },
    '/tags/:slug': {
        name: 'tags',
        component: Item
    },
})

router.redirect({
    '*': '/home'
})

router.start(App, '#vueapp');
