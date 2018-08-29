'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
    return gulp.src('assets/sass/main.scss')
    	.pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sass({
			outputStyle: 'expanded'
		}))
        //.pipe(gulp.dest('./build/templates'))
        .pipe(concat('main.css'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./assets/css'));
});



gulp.task('watch', function () {
    gulp.watch('assets/sass/**/*.scss', ['sass']);
});