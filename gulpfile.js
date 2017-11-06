/**
 * Created by Andrey on 12.09.2017.
 */
'use strict'

const gulp           = require('gulp');
const del            = require('del');


//-----WATCH-------
gulp.task('watch', ['del:assets'], function() {
  gulp.watch([
      './app/htdocs/**/*.css', './app/htdocs/**/*.js', '!./app/htdocs/frontend/web/assets/*', '!./app/htdocs/backend/web/assets/*', '!./app/htdocs/vendor/*'], ['del:assets']);
});

//dal:assets
gulp.task('del:assets', function () {
  return del.sync(['./app/htdocs/frontend/web/assets/*', './app/htdocs/backend/web/assets/*'], {force: true});
});