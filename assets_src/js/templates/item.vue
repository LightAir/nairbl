<style lang="css">



</style>

<template>

<div class="col-xs-10">
    <div class="row">
        <div class="col-xs-12">
            <h2><span class="n-title">{{ news.title }}</span></h2>
        </div>

        <div class="col-xs-12">
            <span class="n-text">{{ news.text }}</span>
        </div>
    </div>
</div>

</template>

<script>

export default {
    data: function() {
        return {
            news: []
        }
    },
    ready: function() {
        this.$http.get('/api/v1/item/' + this.$route.params.slug).then((response) => {

            // TODO add error handler
            response.status;
            // set data on vm
            this.$set('news', response.json())
            console.log(this.news);

        }, (response) => {
            // error callback
        });
    }
}

</script>
