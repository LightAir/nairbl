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


var cssWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(gconcat(destName))
        .pipe(gIf(debug, gsass()
            .on('error', gsass.logError)))
        .pipe(gIf(!debug, gsass({
                outputStyle: 'compressed'
            })
            .on('error', gsass.logError)))
        .pipe(gulp.dest(dest));
}

// Styles
gulp.task('styles', function() {
    cssWorker([
      './bower_components/bootstrap/dist/css/bootstrap.css',
      './assets_src/sass/**/*.scss'
    ]
    , './public/assets/css/', 'main.css');
});

var jsWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(gconcat(destName))
        .pipe(gIf(!debug, guglify()))
        .pipe(gulp.dest(dest));
}

// Scripts
gulp.task('scripts', function() {
    jsWorker('./assets_src/js/**/*.js', srcPath.js, 'all.js');
    jsWorker('./bower_components/jquery/dist/jquery.js', srcPath.js, 'jquery.js');
    jsWorker('./bower_components/vue/dist/vue.js', srcPath.js, 'vue.js');
    jsWorker('./bower_components/bootstrap/dist/js/bootstrap.js', srcPath.js, 'bootstrap.js');
});

// Images
gulp.task('images', function() {
    return gulp.src('./assets_src/images/**/*.*')
        .pipe(gulp.dest('./public/assets/img'))
});

// Fonts
gulp.task('fonts', function() {
    return gulp.src('./assets_src/fonts/**/*.*')
        .pipe(gulp.dest('./public/assets/fonts'))
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
    gulp.run('styles', 'scripts', 'images', 'fonts');
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
    // return gwatch('./assets_src/images/**/*.*', function(event, cb) {
    //     gulp.start('images');
    // });
});
