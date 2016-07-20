

<template>

<div id="wrapper">
    <div class="container">
        <div class="row main-header">
            <div class="col-xs-12 col-sm-2">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/img/logo.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-sm-offset-1 col-md-7 col-md-offset-0 site-header">
                <span id="site-name-header">{{ siteName }}</span>
                <span id="help-header" class="little-help">{{ siteHelp }}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 search-block">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="sn" placeholder="Search for...">
                    <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
                </div>
            </div>
        </div>

        <div class="row news-body">
            <div class="col-xs-12 col-sm-2 block-tags">
                <div class="favorite-tags-title"><a v-link="{ path: '/tags' }">Tags</a></div>
                <div v-for="tag in favTags">
                    <a v-link="{ name: 'tag', params: { slug: tag.route }}" class="favorite-tags">{{ tag.keyword }}</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10">
                <router-view></router-view>
            </div>
        </div>

        <!-- <modal :show.sync="showModal">
            <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div slot="modal-body" class="modal-body">...</div>
        </modal> -->
        <!-- TODO add footer -->
        <div class="row footer">
            <div class="col-xs-12 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2">
                <p class="inf">NAirBL</p>
            </div>
        </div>
    </div>

</div>

</template>

<script>

import {
    modal
}
from 'vue-strap'

export default {
    data: function() {
        return {
            title: 'test modal',
            showModal: false,
            favTags: [],
            siteName: '',
            siteHelp: ''
        }
    },
    ready: function() {
        this.$http.get('/api/v1/about').then((response) => {

            // TODO add error handler
            // response.status;
            this.$set('siteName', response.json().siteName);
            this.$set('siteHelp', response.json().siteHelp);
            this.$set('favTags', response.json().tags);

        }, (response) => {
            // error callback
            // this.showModal = true;
        })
    },
    components: {
        modal
    }
}

</script>
