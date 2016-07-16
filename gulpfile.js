// Load plugins
var gulp, gutil, guglify, gsass, gconcat, gwatch, rm, gIf, browserify, vueify,
livereload;

gulp = require('gulp');
gutil = require('gulp-util');
guglify = require('gulp-uglify');
gsass = require('gulp-sass');
gconcat = require('gulp-concat');
gwatch = require('gulp-watch');
rm = require('gulp-rm');
gIf = require('gulp-if');
browserify = require('gulp-browserify');
vueify = require('gulp-vueify');
livereload = require('gulp-livereload');

var debug = true;

// src path
var srcPath = {
    js: './public/assets/js/'
};

// build css/scss
var cssWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(gconcat(destName))
        .pipe(gIf(debug, gsass()
            .on('error', gsass.logError)))
        .pipe(gIf(!debug, gsass({
                outputStyle: 'compressed'
            })
            .on('error', gsass.logError)))
        .pipe(gulp.dest(dest))
        .pipe(livereload());
}

// Styles
gulp.task('styles', function() {
    cssWorker([
        './bower_components/bootstrap/dist/css/bootstrap.css',
        './assets_src/sass/**/*.scss'
    ], './public/assets/css/', 'main.css');
});

// build js
var jsWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(gconcat(destName))
        .pipe(browserify({
            transform: 'vueify',
            insertGlobals: true,
            debug: debug
        }))
        .pipe(gIf(!debug, guglify()))
        .pipe(gulp.dest(dest))
        .pipe(livereload());
}

// Scripts
gulp.task('scripts', function() {
    jsWorker('./assets_src/js/**/*.js', srcPath.js, 'all.js');
});

// Images
gulp.task('images', function() {
    return gulp.src('./assets_src/images/**/*.*')
        .pipe(gulp.dest('./public/assets/img'))
        .pipe(livereload());
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
gulp.task('watch', ['default'], function() {
    livereload.listen();

    // scss
    gwatch('./assets_src/sass/**/*.scss', function(event, cb) {
        gulp.start('styles');
    });

    // js
    gwatch('./assets_src/js/**/*.*', function(event, cb) {
        gulp.start('scripts');
    });
});
