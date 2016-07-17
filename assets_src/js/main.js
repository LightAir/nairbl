var Vue = require('vue');
var VueRes = require('vue-resource');
var VueRouter = require('vue-router')

Vue.config.debug = true;
Vue.config.devtools = true;

Vue.use(VueRouter)
Vue.use(VueRes);

var App = require('./templates/app.vue');

// 
// var  Post = require('./templates/post.vue');
// var router = new VueRouter()

// router.map({
//     '/foo': {
//         component: Foo
//     }
// })
//
// router.start(App, '#app')

new Vue({
    el: "#vueapp",
    components: {
        app: App
    }
})
