'use strict';

var gulp    = require('gulp'),
    install = require("gulp-install");
 
gulp.src('./package.json')
  .pipe(install());

var rename      = require('gulp-rename'),
    uglify      = require('gulp-uglify'),
    minifyCSS   = require('gulp-minify-css'),
    sass        = require('gulp-sass'),
    browserSync = require('browser-sync'),
    reload      = browserSync.reload;
 
// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function() {

    browserSync({
        proxy: "vimeography.dev"
    });

    gulp.watch("./assets/scss/**/*.scss", ['sass']);
    gulp.watch(["./assets/css/*.css", "!./assets/css/**/*.min.css"], ['minify-css']);
    gulp.watch(["./assets/js/**/*.js", "!./assets/js/**/*.min.js"], ['minify-js']);
    gulp.watch(["./**/*.mustache", "./assets/js/**/*.js", "!./assets/js/**/*.min.js"]).on('change', reload);
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
  return gulp.src("./assets/scss/*.scss")
      .pipe(sass())
      .pipe(gulp.dest("./assets/css"))
      .pipe(reload({stream: true}));
});

gulp.task('minify-css', function() {
  return gulp.src(["./assets/css/*.css", "!./assets/css/*.min.css"])
    .pipe(minifyCSS({keepBreaks:true}))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(gulp.dest('./assets/css/'))
});

gulp.task('minify-js', function() {
  return gulp.src('./assets/js/vimeography-playlister.js')
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(gulp.dest('./assets/js/'));
});

gulp.task('default', ['serve']);