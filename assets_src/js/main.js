var Vue = require('vue');
var VueRes = require('vue-resource');

Vue.use(VueRes);

var App = require('./templates/app.vue');

new Vue({
    el: "#vueapp",
    components: {
        app: App
    }
})
