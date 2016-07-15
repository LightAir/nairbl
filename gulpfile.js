// Load plugins
var gulp, gutil, guglify, gsass, gconcat, gwatch, rm, gIf;

gulp = require('gulp');
gutil = require('gulp-util');
guglify = require('gulp-uglify');
gsass = require('gulp-sass');
gconcat = require('gulp-concat');
gwatch = require('gulp-watch');
rm = require('gulp-rm');
gIf = require('gulp-if');

var debug = true;

// src path
var srcPath = {
  js: './public/assets/js/'
};


// Styles
gulp.task('styles', function() {
    return gulp.src('./assets_src/sass/**/*.scss')
        .pipe(gIf(debug, gsass()))
        .pipe(gIf(!debug, gsass({
                outputStyle: 'compressed'
            })
            .on('error', gsass.logError)))
        .pipe(gulp.dest('./public/assets/css/'));
});

var jsWorker = function (path, dest, destName) {
  return gulp.src(path)
      .pipe(gconcat(destName))
      .pipe(gIf(!debug, guglify()))
      .pipe(gulp.dest(dest));
}

// Scripts
gulp.task('scripts', function() {
  jsWorker('./assets_src/js/**/*.js', srcPath.js, 'all.js');
  jsWorker('./bower_components/jquery/dist/jquery.js', srcPath.js , 'jquery.js');
  jsWorker('./bower_components/vue/dist/vue.js', srcPath.js, 'vue.js');
});

// Images
gulp.task('images', function() {
    return gulp.src('./assets_src/images/**/*.*')
        .pipe(gulp.dest('./public/assets/img'))
});

// clean
gulp.task('clean', function() {
    return gulp.src('./public/assets/**/*', {
            read: false
        })
        .pipe(rm())
});

// Default task
gulp.task('default', ['clean'], function() {
    gulp.run('styles', 'scripts', 'images');
});

// Watch
gulp.task('watch', function() {
    // scss
    return gwatch('./assets_src/sass/**/*.scss', function(event, cb) {
        gulp.start('styles');
    });
    // js
    return gwatch('./assets_src/js/**/*.js', function(event, cb) {
        gulp.start('scripts');
    });
    // img
    return gwatch('./assets_src/images/**/*.*', function(event, cb) {
        gulp.start('images');
    });
});
