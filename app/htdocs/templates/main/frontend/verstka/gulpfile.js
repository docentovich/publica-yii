'use strict'

const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const gulpif = require('gulp-if');
const jade = require('gulp-jade');
const uglify = require('gulp-uglify'); // для js
const cleanCss = require('gulp-clean-css');
const include = require('gulp-include');
const del = require('del');
const useref = require('gulp-useref');
const gutil = require('gulp-util');
const imagemin = require('gulp-image');
const autoprefixer = require('gulp-autoprefixer');
const foreach = require('gulp-foreach');
const rework = require('gulp-rework');
const reworkUrl = require('rework-plugin-url');
const filter = require('gulp-filter');
const runSequence = require('run-sequence');
const rename = require("gulp-rename");
const insert = require('gulp-insert');
const plumber = require('gulp-plumber');
const minifyCss = require('gulp-minify-css');
const jadeGlobbing = require('gulp-jade-globbing');
const sassGlob = require('gulp-sass-glob');
const changed = require('gulp-changed');
const replace = require('gulp-replace');
const print = require('gulp-print');
const spritesmith = require('gulp.spritesmith-multi');
const debug = require('gulp-debug');
var postcss = require('gulp-postcss');
// var phantomjssmith = require('phantomjssmith');
var sprites = ['sprite', 'logos', 'tosee'];
/*
 gulp.task('default', ['browser-sync', 'libs', 'watch'], function(){

 });
 */

gulp.task('default', ['compile', 'watch', 'browser-sync'], function () {

});

gulp.task('compile', ['sprite', 'scss', 'js', 'jadeBlocks'], function () {

});


gulp.task('browser-sync', function () {
  browserSync.init({
    server: {
      baseDir: "./develop"
    },
    port: 8000
  });
});


gulp.task('browser-sync-dist', function () {
  browserSync.init({
    server: {
      baseDir: "./dist"
    },
    port: 8000
  });
});




//-----JADE-------
gulp.task('jade', function () {
  return gulp.src(["./develop/jade/**/*.jade", "!./develop/jade/template/**/*", "!./develop/jade/includes/**/*", "!./develop/jade/includes.jade"])
  // .pipe(changed('develop', {extension: '.html'}))
      .pipe(print())
      .pipe(plumber())
      .pipe(jadeGlobbing({
        'modules': 'src/jade/modules/**/*.jade'
      }))
      .pipe(jade({
        pretty: '  ',
      }))

      .pipe(gulp.dest('./develop'))
});

gulp.task('jadeBlocks', function () {
  return gulp.src(["./develop/jade/**/*.jade", "!./develop/jade/template/**/*", "!./develop/jade/includes/**/*", "!./develop/jade/includes.jade"])
      .pipe(plumber())
      .pipe(jadeGlobbing({
        'modules': './develop/widgets/**/*.jade'
      }))
      .pipe(print())
      .pipe(jade({
        pretty: '  ',
      }))
      .pipe(gulp.dest('./develop'))
});


//-----SCSS-------
gulp.task('scss:main', function () {
  return gulp.src("./develop/scss/main.scss")
      .pipe(plumber())
      .pipe(sourcemaps.init({loadMaps: true}))
      .pipe(sassGlob())
      .pipe(print())
      .pipe(sass.sync({
        errLogToConsole: true
      }))
      .pipe(autoprefixer({
        browsers: ['last 2 version', '> 2%', 'firefox 15', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
      }))
      .pipe(sourcemaps.write("."))
      .pipe(gulp.dest('./develop/css'))
      .pipe(browserSync.stream());

});

gulp.task('scss:widgets', function () {

  return gulp.src("./develop/widgets/**/*.scss")
      .pipe(plumber())
      .pipe(sourcemaps.init({loadMaps: true}))
      .pipe(sassGlob())
      .pipe(print())
      .pipe(sass.sync({
        errLogToConsole: true
      }))
      .pipe(autoprefixer({
        browsers: ['last 2 version', '> 2%', 'firefox 15', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
      }))
      .pipe(sourcemaps.write("."))
      .pipe(rename({dirname:''}))
      .pipe(  minifyCss() )
      .pipe(gulp.dest("./develop/css"))

});


gulp.task('scss', function (callback) {
  return runSequence( [ 'scss:main','scss:widgets' ], callback);
});



//-----JS-------
gulp.task('del:js', function () {
  return del.sync(['./develop/js/*.js']);
});


gulp.task('js:main', ['del:js'], function () {

  return gulp.src("./develop/templates/template.js")
      .pipe(plumber())
      .pipe(include())
      .pipe(print())
      .on('error', console.log)
      .pipe(concat("main.js"))
      .pipe(gulp.dest("./develop/js"));

});

gulp.task('js:widgets', function () {

  return gulp.src("./develop/widgets/**/*.js")
      .pipe(plumber())
      .pipe(print())
      .pipe(rename({dirname:''}))
      // .pipe( uglify() )
      .pipe(gulp.dest("./develop/js"))

});

gulp.task('js', ['del:js'], function (callback) {
  return runSequence( [ 'js:main','js:widgets' ], callback);
});


//-----SPRITE-------
gulp.task('sprite', function generateSpritesheets() {
  // for(var i in sprites){

  //png sptite
  // var sprite = sprites[i];
  var spriteData = gulp.src('./develop/images/{' + sprites.join(',') + '}/*.png')
      .pipe(print())
      .pipe(spritesmith({
            spritesmith: function (options) {
              options.imgPath = '../images/' + options.imgName;
              options.padding = 1;
              // options.algorithm  = 'top-down';
              // options.engine = "phantomjssmith";
            }
          }
          // {
          //   imgName: '.png',
          //   cssName: '.scss'
          // }
      ));

  spriteData.img.pipe(gulp.dest('./develop/images'));
  spriteData.css.pipe(gulp.dest('./develop/css'));
  //-png sptite

  // }
});


//-----WATCH-------
gulp.task('watch', function () {
  gulp.watch('images/{' + sprites.join(',') + '}/*.{jpg,png,svg,gif}', {cwd: 'develop'}, ['sprite']);
  gulp.watch('**/*.scss', {cwd: 'develop'}, ['scss']);
  gulp.watch(['**/*.js', '!js/main.js'], {cwd: 'develop'}, ['js', browserSync.reload]);
  gulp.watch(['jade/template/**/*.jade', 'blocks/**/*.jade'], {cwd: 'develop'}, ['jadeBlocks', browserSync.reload]);
  gulp.watch(['jade/**/*.jade', '!jade/template/**/*.jade'], {cwd: 'develop'}, ['jade', browserSync.reload]);
});


//=================build==========================


// ====TO YII====

gulp.task('build:yii:clean', function () {
  // return del.sync(['../../../../../frontend/web/assets/*'], {force: true});
});

//copy dist fonts
// gulp.task('build:copyDistFonts',  function () {  
//   return gulp.src(['develop/fonts/**/{*.eot,*.svg,*.ttf,*.eot,*.otf,*.woff2,*.woff}']
//     )
//   .pipe(print())
//   .pipe(gulp.dest('dist/fonts'));
// });


//minifi img
gulp.task('build:yii:minifiImg', function () {
  return;
  return gulp.src(['develop/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}'])
      .pipe(imagemin({zopflipng: false}))
      .on('error', console.log)
      .pipe(gulp.dest('../assets/images'));
});

gulp.task('build:yii:minifiJsCss', function () {

  return gulp.src('./develop/index.html')
      .pipe(print())
      .pipe(useref({searchPath: 'develop', base: 'develop'}))
      .pipe(debug())
      .pipe(gulpif('*.js', uglify()
          .on('error', function (err) {
            gutil.log(gutil.colors.red('[Error]'), err.toString());
            this.emit('end');
          })
      ))
      .pipe(gulpif('*.css', minifyCss()))
      .pipe(gulp.dest('../assets'));
});

gulp.task('build:yii:_dist', ['build:yii:clean'], function (callback) {
  return runSequence(['build:yii:minifiJsCss'], callback);
});

gulp.task('build:yii', ['build:yii:_dist'], function (callback) {
  return runSequence(['build:yii:minifiImg'], callback);
});

//===TO YII====

// ====TO YII==== 

// gulp.task('build:clean', function () {
//   // return gulp.src(['../../../../../frontend/web/assets/*'])
//   // .pipe( debug() );
//   del.sync(['../../../../../frontend/web/assets/*'], {force: true});
// });

// //minifi img
// gulp.task('build:yii:minifiImg',  function () { 
//   return gulp.src(['develop/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}'])
//   .pipe(imagemin({zopflipng: false}))
//   .on('error', console.log)
//   .pipe(gulp.dest('../images'));
// });

// //copy js
// gulp.task('build:yii:copy:js',   function () { 

//   return gulp.src('./dist/js/**/*')
//   return gulp.src([
//     'develop/libs/**'])
//   .pipe(print())
//   .pipe(gulp.dest('../assets/js'));
// });

// //copy css
// gulp.task('build:yii:copy:css',   function () { 

//   return gulp.src('./dist/css/**/*')
//   return gulp.src([
//     'develop/libs/**'])
//   .pipe(print())
//   .pipe(gulp.dest('../assets/css'));
// });

// //copy
// gulp.task('build:yii:copy', function (callback) {
//   return runSequence(['build:yii:copy:js', 'build:yii:copy:css'], callback);
// });

//all
// gulp.task('build:yii:dist', ['build:dist'], function (callback) {
//   return runSequence([/*'build:yii:minifiImg',*/ 'build:yii:copy'], callback);
// });

//===TO DIST====


//build
// gulp.task('build', ['build:clean'], function (callback) {
//   return runSequence(['build:yii:dist'], callback);
// });

//------------=====build======--------------------
//------------=====build======--------------------
//------------=====build======--------------------

var app = "develop";

// ====TO DIST====

//cleandist
gulp.task("build:clean", ["jadeBlocks"], function () {
  return del.sync(["./dist"]);
});


//copydist
gulp.task("build:copyDist", function () {

  return gulp.src([
    app + "/*.php",
    app + "/.htaccess",
    app + "/favicon.png",
  ])
      .pipe(print())
      .pipe(gulp.dest("dist"));

});


//copylibs
gulp.task("build:copyLibs", function () {

  return gulp.src([
    app + "/libs/**"])
      .pipe(print())
      .pipe(gulp.dest("dist/libs"));

});


//copy dist fonts
gulp.task("build:copyDistFonts", function () {

  return gulp.src([app + "/fonts/**/{*.eot,*.svg,*.ttf,*.eot,*.otf,*.woff2,*.woff}"])
      .pipe(print())
      .pipe(gulp.dest("dist/fonts"));

});


//minifi img
gulp.task("build:minifiImg", function () {

  return gulp.src([app + "/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}"])
      .pipe(print())
      .pipe(imagemin({zopflipng: false}))
      .on("error", console.log)
      .pipe(gulp.dest("dist/images"));

});


gulp.task("build:minifiJsCss", function () {

  return gulp.src(app + "/**/*.html")
      .pipe(useref({searchPath: app, base: app}))
      .pipe(print())
      .pipe(gulpif("*.js", uglify().on("error", function (err) {
        gutil.log(gutil.colors.red("[Error]"), err.toString());
        this.emit("end");
      })))
      .pipe(gulpif("*.css", minifyCss()))
      .pipe(gulp.dest("dist"));

});


gulp.task("build:dist", ["build:clean"], function (callback) {

  return runSequence([/*"build:copyDist",*/ "build:copyLibs", "build:copyDistFonts", "build:minifiImg", "build:minifiJsCss"], callback);

});
//===TO DIST====