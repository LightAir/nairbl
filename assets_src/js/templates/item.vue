<style lang="css">



</style>

<template>

<div class="row">
    <div class="col-xs-12">
        <h2><span class="n-title">{{ news.title }}</span></h2>
    </div>

    <div class="col-xs-12">

        <vue-markdown></vue-markdown>
        <span class="n-text">{{ news.text }}</span>
    </div>
</div>

</template>

<script>

import VueMarkdown from 'vue-markdown'

export default {
    methods: {
        allRight: function(htmlStr) {
            console.log("markdown is parsed !");
        },
        tocAllRight: function(tocHtmlStr) {
            console.log("toc is parsed :", tocHtmlStr);
        }
    },
    data: function() {
        return {
            news: [],
            source: "sdfsdf",
            show: true,
            html: false,
            breaks: true,
            linkify: false,
            emoji: true,
            typographer: true,
            toc: false
        }
    },
    ready: function() {
        this.$http.get('/api/v1/item/' + this.$route.params.slug).then((response) => {

            // TODO add error handler
            response.status;
            // set data on vm
            this.$set('news', response.json());
            this.source = response.json().text;
            console.log(this.news);

        }, (response) => {
            // error callback
        });
    },
    components: {
        VueMarkdown
    }
}

</script>
