<style lang="scss">



</style>

<template>

<div v-for="list in lists">
    <list :list="list"></list>
</div>

<template id="test-templ">
    <div class="news-block">
        <a href="/post/{{ list.slug }}" class="news-title">{{ list.title }}</a>

        <p class="news-text">
            {{ list.text }}
        </p>
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

    <pre>{{ list | json }}</pre>
</template>

</template>

<script>

export default {
    data: function() {
        return {
            lists: []
        }
    },
    ready: function() {
        this.$http.get('/api/v1/news/0').then((response) => {

            // TODO add error handler
            response.status;
            // set data on vm
            this.$set('lists', response.json())

        }, (response) => {
            // error callback
        });
    },
    components: {
        list: {
            template: '#test-templ',
            props: ['list']
        }
    }
}

</script>
