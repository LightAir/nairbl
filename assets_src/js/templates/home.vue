<style lang="scss">



</style>

<template>
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

          // get status
          response.status;
          // get status text
          response.statusText;
          // get all headers
          response.headers;
          // get 'Expires' header
          response.headers['Expires'];
          // set data on vm
          this.$set('lists', response.json())

      }, (response) => {

          // error callback

      });
    }
}
</script>
