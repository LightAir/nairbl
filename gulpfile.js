// Load plugins
var gulp, gutil, guglify, gsass, gconcat, gwatch, rm, gIf, browserify, vueify,
    livereload, notify, plumber, babelify, through2;

notify = require("gulp-notify");
plumber = require('gulp-plumber');
babelify = require('babelify');

gulp = require('gulp');
gutil = require('gulp-util');
guglify = require('gulp-uglify');
gsass = require('gulp-sass');
gconcat = require('gulp-concat-util');
// gconcat = require('gulp-concat');
gwatch = require('gulp-watch');
rm = require('gulp-rm');
gIf = require('gulp-if');
browserify = require('browserify');
vueify = require('gulp-vueify');
livereload = require('gulp-livereload');
through2 = require('through2');

var debug = true;

// src path
var srcPath = {
    js: './public/assets/js/'
};

// build css/scss
var cssWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
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
// var jsWorker = function(path, dest, destName) {
//     return gulp.src(path)
//         .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
//         .pipe(gconcat(destName))
//         // .pipe(browserify().transform("babelify", {presets: ["es2015"]}))
//         .pipe(gIf(!debug, guglify()))
//         .pipe(gulp.dest(dest))
//         .pipe(livereload()));
// }


var jsWorker = function(path, dest, destName) {

    return gulp.src(path)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(through2.obj(function (file, enc, next){
            browserify(file.path)
                .transform('vueify')
                .bundle(function(err, res){
                    // assumes file.contents is a Buffer
                    file.contents = res;
                    next(null, file);
                });
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
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
        .pipe(gulp.dest('./public/assets/img'))
        .pipe(livereload());
});

// Fonts
gulp.task('fonts', function() {
    return gulp.src('./assets_src/fonts/**/*.*')
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>")
        }))
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
    }).on('change', function() {
        notify("File: <%= file.relative %>");
    })

    // js
    gwatch('./assets_src/js/**/*.*', function(event, cb) {
        gulp.start('scripts');
    });
});
