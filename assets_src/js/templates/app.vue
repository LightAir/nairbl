

<template>

<div class="row main-header">
    <div class="col-xs-12 col-sm-2">
        <div class="logo">
            <a href="/">
                <img src="/assets/img/logo.png" alt="logo" />
            </a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-sm-offset-1 col-md-7 col-md-offset-0">
        <h1>
        <span id="site-name-header">{{ siteName }}</span>
      </h1>
        <span id="help-header" class="little-help">{{ siteHelp }}</span>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="input-group">
            <input type="text" class="form-control" v-model="sn" placeholder="Search for...">
            <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
        </div>
    </div>
</div>

<div class="row news-body">
    <div class="col-xs-12 col-sm-2">
        <div style="padding: 10px">this is tags panel</div>
    </div>
    <div class="col-xs-12 col-sm-10">
        <div v-for="list in lists">
            <list :list="list"></list>
        </div>
    </div>
</div>

<template id="test-templ">
    <div class="news-block">
        <a href="/post/{{ list.slug }}" class="news-title">{{ list.title }}</a>

        <p class="news-text">
            {{ list.text }}
            <p>
                <div class="row news-footer">
                    <div class="col-xs-6 news-tags">
                        <!-- TODO add tags to news -->
                        <!-- {{ list.tags }} -->
                        test, one
                    </div>
                    <div class="col-xs-6">
                        <span class="news-date">{{ list.date }}</span>
                    </div>
                </div>
    </div>

    <!-- <pre>{{ list | json }}</pre> -->
</template>

</template>

<script>

import Home from './home.vue';

export default {
    data: function() {
        return {
            siteName: '',
            siteHelp: '',
            lists: []
        }
    },
    ready: function() {
        this.$http.get('/api/v1/about').then((response) => {

                // TODO add error handler
                // response.status;
                this.$set('siteName', response.json().siteName)
                this.$set('siteHelp', response.json().siteHelp)

            }, (response) => {
                // error callback
            })
    },
    components: {
        // list: {
        //     // template: Home,
        //     template: '#test-templ',
        //     props: ['list']
        // }
        list: Home
    }

}

</script>
