<style lang="css">



</style>

<template>

<div v-for="list in lists">
    <div class="news-block">
        <a v-link="{ name: 'news', params: { slug: list.slug }}" class="news-title">{{ list.title }}</a>
        <div class="row">
            <div class="col-xs-12">
                <span class="news-date">{{ list.date }}</span>
            </div>
        </div>
        <p class="news-text">
          <vue-markdown :source="list.text"></vue-markdown>

        </p>
        <div class="row news-footer">
            <div class="col-xs-12 news-tags">
                <!-- TODO add tags to news -->
                <!-- {{ list.tags }} -->
                test, one
            </div>
        </div>
        <div class="row news-comments-counter">
            <div class="col-xs-12">
                no comments
            </div>
        </div>
    </div>
</div>

</template>

<script>
import VueMarkdown from 'vue-markdown'

export default {
    data: function() {
        return {
            lists: []
        }
    },
    ready: function() {
            this.$http.get('/api/v1/news/0').then((response) => {
                // this.$http.get('/api/v1/news/0', param, {
                //     headers: {
                //         'Cache-Control': 'no-cache'
                //     }
                // }).then((response) => {
                // TODO add error handler
                response.status;
                // set data on vm
                this.$set('lists', response.json())

            }, (response) => {
                // error callback
            });
        },
        components: {
            VueMarkdown
        }
        // ,
        // components: {
        //     list: {
        //         template: '#test-templ',
        //         props: ['list']
        //     }
        // }
}

</script>
