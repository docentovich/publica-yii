'use strict'

const gulp           = require('gulp');
const browserSync    = require('browser-sync').create();
const sass           = require('gulp-sass');
const concat         = require('gulp-concat');
const sourcemaps     = require('gulp-sourcemaps');
const gulpif         = require('gulp-if');
const jade           = require('gulp-jade');
const uglify         = require('gulp-uglify'); // для js
const cleanCss       = require('gulp-clean-css');
const include        = require('gulp-include');
const del            = require('del');
const useref         = require('gulp-useref');
const gutil          = require('gulp-util');
const imagemin       = require('gulp-image');
const compass        = require('gulp-compass');
const autoprefixer   = require('gulp-autoprefixer');
const foreach        = require('gulp-foreach');
const rework         = require('gulp-rework');
const reworkUrl      = require('rework-plugin-url');
const filter         = require('gulp-filter');
const runSequence    = require('run-sequence');
const rename         = require("gulp-rename");
const insert         = require('gulp-insert');
const plumber        = require('gulp-plumber');
const minifyCss      = require('gulp-minify-css');
const jadeGlobbing   = require('gulp-jade-globbing');
const sassGlob       = require('gulp-sass-glob');
const changed        = require('gulp-changed');
const replace        = require('gulp-replace');
const print          = require('gulp-print');
const spritesmith    = require('gulp.spritesmith');
var sprites = ['sprite'];
/*
gulp.task('default', ['browser-sync', 'libs', 'watch'], function(){
  
});
*/

gulp.task('default', ['compile', 'watch', 'browser-sync'], function(){

});

gulp.task('compile', ['sprite', 'scss', 'js', 'jadeBlocks'], function(){

});


gulp.task('browser-sync', function() {
  browserSync.init({
    server: {
      baseDir: "./develop"
    },
    port: 8000
  });
});

gulp.task('scss', function() {
  return gulp.src("./develop/scss/main.scss")
  .pipe(plumber())
  .pipe(sourcemaps.init({loadMaps: true}))    
  .pipe(sassGlob())
  .pipe(print())
  .pipe(sass.sync({
    errLogToConsole: true,
    debugInfo   : true,
    lineNumbers : true,
  }))
     // .pipe(sourcemaps.init())
     .pipe(autoprefixer({
      browsers: ['last 2 version', '> 2%', 'firefox 15', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
    }))
     .pipe(sourcemaps.write("."))
     .pipe(gulp.dest('./develop/css'))
     .pipe(browserSync.stream());

   });

gulp.task('jade', function() {
  return gulp.src(["./develop/jade/**/*.jade", "!./develop/jade/template/**/*"])
  .pipe(changed('develop', {extension: '.html'}))
  .pipe(print())
  .pipe(plumber())
  .pipe(jadeGlobbing())
  .pipe(jade({
    pretty: '  ',
  }))

  .pipe(gulp.dest('./develop'))
});

gulp.task('jadeBlocks', function() {
  return gulp.src(["./develop/jade/**/*.jade", "!./develop/jade/template/**/*"])
  .pipe(plumber())
  .pipe(jadeGlobbing())
  .pipe(print())
  .pipe(jade({
    pretty: '  ',
  }))
  .pipe(gulp.dest('./develop'))
});

gulp.task('deljs', function(){
  return del.sync(['./develop/js/main.js']);
});

gulp.task('js', ['deljs'], function(){

  return gulp.src("./develop/js/template.js")
  .pipe(plumber())
  .pipe(include())
  .pipe(print())
  .on('error', console.log)
  .pipe(concat("main.js"))      
  .pipe(gulp.dest("./develop/js"));
});


gulp.task('sprite', function generateSpritesheets () {
  // for(var i in sprites){

    //png sptite
    // var sprite = sprites[i];
    var spriteData = gulp.src('./develop/images/sprite/*.png')
    .pipe(print())
    .pipe(spritesmith({
      imgName: 'sprite.png',
      cssName: 'sprite.scss',
      imgPath: '../images/sprite.png',
      padding: 1
    }));

    spriteData.img.pipe(gulp.dest('develop/images'));
    spriteData.css.pipe(gulp.dest('./develop/scss'));
    //-png sptite

  // }
});



gulp.task('watch', function() {
  gulp.watch('images/{' + sprites.join(',') + '}/*.{jpg,png,svg,gif}', {cwd: 'develop'}, ['sprite']);
  gulp.watch('**/*.scss', {cwd: 'develop'}, ['scss']);
  gulp.watch(['**/*.js', '!js/main.js'], {cwd: 'develop'}, ['js', browserSync.reload]);
  gulp.watch(['jade/blocks/**/*.jade', 'blocks/**/*.jade'], {cwd: 'develop'}, ['jadeBlocks', browserSync.reload]);
  gulp.watch(['jade/**/*.jade', '!jade/template/**/*.jade'], {cwd: 'develop'}, ['jade', browserSync.reload]);
});



//=================build==========================


// ====TO DIST====
//cleandist
gulp.task('build:clean', function () {
  return del.sync(['./dist']);
});

//copydist
gulp.task('build:copyDist', function () {  
  return gulp.src([
    'develop/sendform.php', 
    'develop/.htaccess', 
    'develop/favicon.png',
    // 'develop/*.html',
    ])
  .pipe(print())
  .pipe(gulp.dest('dist'));
});

//copylibs
gulp.task('build:copyLibs', function () {  
  return gulp.src([
    'develop/libs/**'])
  .pipe(print())
  .pipe(gulp.dest('dist/libs'));
});


//copy dist fonts
gulp.task('build:copyDistFonts',  function () {  
  return gulp.src(['develop/fonts/**/{*.eot,*.svg,*.ttf,*.eot,*.otf,*.woff2,*.woff}']
    )
  .pipe(print())
  .pipe(gulp.dest('dist/fonts'));
});

//minifi img
gulp.task('build:minifiImg',  function () { 
  return gulp.src(['develop/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}'])
  .pipe(print())
  // .pipe(imagemin())
  .on('error', console.log)
  .pipe(gulp.dest('dist/images'));
});

gulp.task('build:minifiJsCss',   function () { 
  return gulp.src('./develop/**/*.html')
  .pipe(useref())
  .pipe(print())
  .pipe(gulpif('*.js', uglify()
    .on('error', function(err) {
      gutil.log(gutil.colors.red('[Error]'), err.toString());
      this.emit('end');
    })
    ))
  .pipe(gulpif('*.css', minifyCss()))    
  .pipe(gulp.dest('dist'));
});

gulp.task('build:dist', ['build:clean'], function (callback) {
  return runSequence(['build:copyDist', 'build:copyLibs', 'build:copyDistFonts', 'build:minifiImg', 'build:minifiJsCss'], callback);
});
//===TO DIST====





//build
gulp.task('build', ['build:clean'], function (callback) {
  return runSequence(['build:dist'], callback);
});

//------------=====build======--------------------