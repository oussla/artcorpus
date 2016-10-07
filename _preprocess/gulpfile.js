/**
 * 
 */

var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	util = require('gulp-util'),
	ftp = require('vinyl-ftp'),
	concat = require('gulp-concat'),
	minimist = require('minimist'),
	gulpFilter = require('gulp-filter'),
	mainBowerFiles = require('main-bower-files');

// Get command arguments
var args = minimist(process.argv.slice(2));

/**
 * SASS task 
 */
gulp.task('sass', function() {
	return sass('../sass/style.scss', {
			sourcemap: true,
			style: args.env == 'production' ? 'compressed' : 'expanded' // nested / compact / expanded / compressed 
		})
		.on('error', sass.logError)
		.pipe(gulp.dest('../'));
});


/**
 * Get all Bower dependencies main CSS/SCSS files
 * Doesn't work if dependencies have assets references in CSS: images, fonts... 
 */
gulp.task('bowerCSS', function() {
	var cssFilter = gulpFilter(['**/*.css', '**/*.scss']);

	return gulp.src(mainBowerFiles(), { base: './bower_components' })
			   .pipe(cssFilter)
			   .pipe(concat('bower.all.scss'))
			   .pipe(gulp.dest('../vendors/'));
});


/**
 * Watcher
 */
gulp.task('watch', ['sass'], function() {
	gulp.watch('../sass/**/*.scss', ['sass']);
});


/**
 * Build for Production
 */
gulp.task('build', function() {
	// TODO:
	// - SASS in "production" mode 
	// - concat and minify JS 
	// - any other task...	 
});



/**
 * Parallel tasks test, woohoo
 */
gulp.task('simpleecho', function() {
	util.log('the simpleecho');
});

gulp.task('watchmore', function() {
	gulp.watch('../sass/**/*.scss', ['simpleecho', 'sass']);
});





/**
 * FTP deployment
 * ###TODO: define options according to target env. 
 */
gulp.task('deploy', function() {

	var remotePath = '/www/wip/artcrp/www/wp-content/themes/artcorpus/_preprocess/';
	var conn = ftp.create({
		host: 'ftp.nicolaslagarde.com',
		user: args.user,
		password: args.password,
		parallel: 10,
		log: util.log
	});

	var globs = [
        '../img/**',
        '../inc/**',
        '../js/**',
        '../languages/**',
        '../layouts/**',
        '../page-template/**',
        '../template-parts/**',
        '../*.@(php|txt|js|css|png)'
    ];

    return gulp.src(globs, {base: '.'})
        .pipe(conn.newer(remotePath)) // only upload newer files 
        .pipe(conn.dest(remotePath));

});
