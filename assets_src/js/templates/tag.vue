<style lang="css">



</style>

<template lang="html">

<div class="animated fadeIn">
    <div class="about-tag">
        News by tag <span>{{ tagName }}</span>
    </div>
    <div class="posts-not-found" v-show="!status">
        News not found
    </div>
    <div v-for="list in lists" v-show="status">
        <div class="news-block animated fadeIn">
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
</div>

</template>

<script>

import VueMarkdown from 'vue-markdown'

export default {
    data: function() {
        return {
            lists: [],
            tagName: this.$route.params.slug,
            status: true
        }
    },
    computed: {},
    ready: function() {
        this.$http.get('/api/v1/tag/' + this.$route.params.slug).then((response) => {
            // TODO add error handler
            response.status;
            // set data on vm

            this.$set('lists', response.json());

            if (!response.json().length) {
                this.status = false
            }
        }, (response) => {
            // error callback
        });
    },
    route: {
        canReuse: function functionName() {
            return false;
        }
    },
    attached: function() {},
    methods: {

    },
    components: {
        VueMarkdown
    }
}

</script>
