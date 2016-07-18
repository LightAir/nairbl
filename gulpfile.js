var gulp = require('gulp');
var webpack = require('webpack-stream');

var livereload = require('gulp-livereload');
var notify = require("gulp-notify");
var plumber = require('gulp-plumber');
var watch = require('gulp-watch');

// proc...
var sass = require('gulp-sass');

// helpers
var gulpif = require('gulp-if');
var concat = require('gulp-concat-util');
var rm = require('gulp-rm');

// env
var debug = true;


gulp.task('scripts', function() {
    return gulp.src('./assets_src/js/main.js')
        .pipe(webpack(require('./webpack.config.js')))
        .pipe(gulp.dest('./public/assets/js/'))
        .pipe(livereload())
        .pipe(notify({
            message: 'Compiled Scripts'
        }));
});


var cssWorker = function(path, dest, destName) {
    return gulp.src(path)
        .pipe(concat(destName))
        .pipe(gulpif(debug, sass()
            .on('error', sass.logError)))
        .pipe(gulpif(!debug, sass({
                outputStyle: 'compressed'
            })
            .on('error', sass.logError)))
        .pipe(gulp.dest(dest))
        .pipe(livereload())
        .pipe(notify({
            message: 'Compiled sass'
        }));
}

// Styles
gulp.task('styles', function() {
    cssWorker([
        './bower_components/bootstrap/dist/css/bootstrap.css',
        './assets_src/sass/**/*.scss'
    ], './public/assets/css/', 'main.css');
});


// Scripts
// gulp.task('scripts', function() {
//     jsWorker('./assets_src/js/**/*.js', srcPath.js, 'all.js');
// });

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

// Build task
gulp.task('default', ['clean'], function() {
    debug = false;
    gulp.run('styles', 'scripts', 'images', 'fonts');
});

// Watch
gulp.task('watch', ['default'], function() {
    livereload.listen();

    // scss
    watch('./assets_src/sass/**/*.scss', function(event, cb) {
        gulp.start('styles');
    });
    // js
    watch('./assets_src/js/**/*.*', function(event, cb) {
        gulp.start('scripts');
    });
    //notify("Add file: <%= file.relative %>");
});
