var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('concat', function() {
    return gulp.src([ 'public/js/my-js/filtering_mainCat.js', 'public/js/my-js/filtering-functions.js'])
        .pipe(concat('all_mainCat.js'))
        .pipe(gulp.dest('public/js/my-js/'));
});

gulp.task('concat2', function() {
    return gulp.src([ 'public/js/my-js/filtering_subCat.js', 'public/js/my-js/filtering-functions.js'])
        .pipe(concat('all_subCat.js'))
        .pipe(gulp.dest('public/js/my-js/'));
});

gulp.task('concat3', function() {
    return gulp.src([ 'public/js/my-js/filtering_Cat.js', 'public/js/my-js/filtering-functions.js'])
        .pipe(concat('all_Cat.js'))
        .pipe(gulp.dest('public/js/my-js/'));
});

gulp.task('default', gulp.series('concat', 'concat2', 'concat3'));