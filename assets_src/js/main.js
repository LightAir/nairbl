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
import Tags from './templates/tags.vue';
import Tag from './templates/tag.vue';


Vue.config.debug = true;
Vue.config.devtools = true;

Vue.use(VueRouter);
Vue.use(VueRes);

var router = new VueRouter({
    hashbang: false,
    history: true,
    linkActiveClass: "active",
    mode: 'html5'
});

router.map({
    '/': {
        component: News
    },
    '/news/:slug': {
        name: 'news',
        component: Item
    },
    '/tags': {
        name: 'tags',
        component: Tags
    },
    '/tag/:slug': {
        name: 'tag',
        component: Tag
    },
})


router.redirect({
    '*': '/'
})

router.start(App, '#vueapp');
