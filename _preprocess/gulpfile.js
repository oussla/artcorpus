/**
 * Basic Gulp tests. 
 */

var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	util = require('gulp-util'),
	ftp = require('vinyl-ftp'),
	minimist = require('minimist');

// Get command arguments
var args = minimist(process.argv.slice(2));

/**
 * SASS task 
 */
gulp.task('sass', function() {
	return sass('../sass/style.scss', {
			style: 'expanded' // nested / compact / expanded / compressed 
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
