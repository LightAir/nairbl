<style lang="css">



</style>

<template>

<div class="row animated fadeIn">
    <div class="col-xs-12">
        <h1><span class="n-title">{{ news.title }}</span></h1>
    </div>
    <div class="col-xs-12 post-date">
        <span>{{ news.created_at }}</span>
    </div>
    <div class="col-xs-12">
        <vue-markdown :id="id" :source="model"></vue-markdown>
        <!-- <span class="n-text">{{ news.text }}</span> -->
    </div>
</div>

</template>

<script>

import VueMarkdown from 'vue-markdown'
import Prism from 'prismjs'
import Uuid from 'node-uuid'

export default {
    props: {
        model: {
            type: String
        }
    },
    data: function() {
        return {
            news: [],
            id: 'markdown-' + Uuid.v4()
        }
    },
    events: {
        rendered() {
            for (const code of document.querySelectorAll(`#${this.id} code`)) {
                Prism.highlightElement(code)
            }
        }
    },
    ready: function() {
        this.$http.get('/api/v1/item/' + this.$route.params.slug).then((response) => {

            // TODO add error handler
            response.status;
            // set data on vm
            this.$set('news', response.json());
            this.model = response.json().text;
            //console.log(this.model);

        }, (response) => {
            // error callback
        });

    },
    components: {
        VueMarkdown
    }
}

</script>
