var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('concat', function() {
    return gulp.src([ 'public/js/my-js/filtering.js', 'public/js/my-js/filtering-functions.js'])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js/my-js/'));
});