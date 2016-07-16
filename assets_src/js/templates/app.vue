<style lang="scss">



</style>

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
        <span id=help-header class="little-help">{{ siteHelp }}</span>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button>
        </span>
        </div>
    </div>
</div>

<div class="row">
    <div v-for="bn in bodynews">
        <bodynews :bodynews="bn"></bodynews>
    </div>
</div>

</template>

<script>

import bodynews from './bodynews.vue';

export default {
    data() {
            return {
                siteName: '',
                siteHelp: ''
            }
        },
        ready() {

            this.$http.get('/api/v1/about').then((response) => {

                // get status
                response.status;
                // get status text
                response.statusText;
                // get all headers
                response.headers;
                // get 'Expires' header
                response.headers['Expires'];
                // set data on vm
                console.log(response.json())
                    //this.$set('someData', response.json())
                this.$set('siteName', response.json().siteName)
                this.$set('siteHelp', response.json().siteHelp)

            }, (response) => {
                // error callback
            });

        },
        components: {
            bodynews
        }

}

</script>
