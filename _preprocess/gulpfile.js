/**
 * Basic Gulp tests. 
 */

var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	util = require('gulp-util');

/**
 * SASS task 
 */
gulp.task('sass', function() {
	return sass('../sass/style.scss', {
			style: 'compressed'
		})
		.on('error', sass.logError)
		.pipe(gulp.dest('../'));
});

/**
 * Watcher
 */
gulp.task('watch', function() {
	gulp.watch('../sass/**/*.scss', ['sass']);
});