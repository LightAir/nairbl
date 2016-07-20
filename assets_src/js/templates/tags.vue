<style lang="css">



</style>

<template lang="html">

<span class="favorite-title">All tags</span>


<div class="favorite-tags">
    <span v-for="fav in favorite">
        <a v-link="{ name: 'tag', params: { slug: fav.route }}" class="fav">{{ fav.keyword }}</a>
    </span>
</div>
<div class="regular-tags">
    <span v-for="reg in regular">
        <a v-link="{ name: 'tag', params: { slug: reg.route }}" class="reg">{{ reg.keyword }}</a>
    </span>
</div>

</template>

<script>

export default {
    data: function() {
        return {
            favorite: [],
            regular: []
        }
    },
    computed: {},
    ready: function() {
        this.$http.get('/api/v1/tags').then((response) => {
            // TODO add error handler
            response.status;
            // set data on vm
            this.$set('favorite', response.json().favorite);
            this.$set('regular', response.json().regular);

        }, (response) => {
            // error callback
        });
    },
    attached: function() {},
    methods: {},
    components: {}
}

</script>
