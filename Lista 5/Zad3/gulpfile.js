var gulp = require('gulp');
var php = require('gulp-connect-php');
var browserSync = require('browser-sync').create();

gulp.task('php', function(){
    php.server({port:8080, keepalive:true});
});

gulp.task('browserSync',['php'], function() {
    browserSync.init({
        proxy:"127.0.0.1:8080",
        open:true,
        notify:false,
        https: {
            key: 'keyA.pem',
            cert: 'certA.crt'
        }
    });
});

gulp.task('dev', [ 'browserSync'], function() {
       gulp.watch('*.php', browserSync.reload);
});