'use strict'

const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const browserSyncCore = require('browser-sync');
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
const data = require('gulp-data');
const batch = require('gulp-batch');
const functions = require('./functions');
var postcss = require('gulp-postcss');

var projects = [
  /*{
    name: 'publica',
    scss: "main-publica",
    js  : "publica_template",
    images : "publica",
    sprites: ['sprite', 'logos', 'tosee'],
    datas: {"logo": "tosee.png"}
  },*/{
    name: 'tosee_probank',
    scss: "main-tosee",
    js  : "tosee_template",
    images : "tosee_probank",
    sprites: ['sprite', 'logos', 'tosee'],
    datas: {"logo": "tosee.png"}
  }/*,
  {
    name: 'probank',
    scss: "main-probank",
    js  : "probank_template",
    images : "tosee_probank",
    sprites: [],
    datas: {"logo": "probank.png"}
  },
  {
    name: 'shotme',
    scss: "main-shotme",
    js  : "probank_template",
    images : "shotme",
    sprites: [],
    datas: {"logo": "probank.png"}
  }*/
];

const runMultiTask = functions.runMultiTask({projects: projects});


gulp.task('default', ['browser-sync', 'compile', 'watch'], function () {
});
gulp.task('compile', ['sprite', 'scss', 'js', 'jadeBlocks', 'copyLibs', 'copyImages'], function () {
});

//-----WATCH-------
gulp.task('watch', function () {
  // gulp.watch('images/{' + sprites.join(',') + '}/*.{jpg,png,svg,gif}', {cwd: 'develop'}, ['sprite']);
  gulp.watch('/develop/images/*.*', {cwd: 'develop'}, ['copyImages']);
  gulp.watch('**/*.scss', {cwd: 'develop'}, ['scss']);
  gulp.watch(
      ['**/*.js', '!js/main.js'],
      {cwd: 'develop'},
      ['js', batch(
          function () {
            runMultiTask({
              fn: function (row, i, reestr) {
                reestr["bs_" + row.name].reload;
              }
            })
          })
      ]);

  gulp.watch(
      ['jade/template/**/*.jade', 'blocks/**/*.jade'],
      {cwd: 'develop'},
      ['jadeBlocks', batch(
          function () {
            runMultiTask({
              fn: function (row, i, reestr) {
                reestr["bs_" + row.name].reload;
              }
            })
          })
      ]);
  gulp.watch(
      ['jade/**/*.jade', '!jade/template/**/*.jade'],
      {cwd: 'develop'},
      ['jade', batch(
          function () {
            runMultiTask({
              fn: function (row, i, reestr) {
                reestr["bs_" + row.name].reload;
              }
            })
          })
      ]);

});


gulp.task('browser-sync', function () {

  return runMultiTask({

    fn: function (row, i, reestr) {

      reestr["bs_" + row.name] = browserSyncCore.create();

      reestr["bs_" + row.name].init({
        server: {
          baseDir: "./app/" + row.name
        },
        port: 8000 + i,
        ui: {
          port: 3001 + i
        }
      });

    }
  });

});


//-----copyLibs-------
gulp.task('copyLibs', function (callback) {

  return runMultiTask({
        cb: callback,
        fn: function (row) {

          return gulp.src("./develop/libs/**/*", {base: "develop"})
              .pipe(gulp.dest('./app/' + row.name))

        }
      }
  );
});

//-----copyImages-------
gulp.task('copyImages:common',  function (callback) {
  return runMultiTask({
        cb: callback,
        fn: function (row) {
          return gulp.src([
            "./develop/images/common/**/*"], {base: "develop/images/common"})
              .pipe(gulp.dest('./app/' + row.name + "/images"))
        }
      }
  );
});

gulp.task('copyImages:project',  function (callback) {
  return runMultiTask({
        cb: callback,
        fn: function (row) {
          return gulp.src([
            "./develop/images/" + row.images + "/**/*"], {base: "develop/images/" + row.images})
              .pipe(gulp.dest('./app/' + row.name + "/images"))
        }
      }
  );
});


gulp.task('copyImages',  function (callback) {
  return runSequence(['copyImages:common', 'copyImages:project'], callback);
});



//-----JADE-------
gulp.task('jade', function (callback) {

  return runMultiTask({
        cb: callback,
        fn: function (row) {

          return gulp.src([
            "./develop/jade/pages/**/*.jade",
            "!./develop/jade/pages/**/_*.jade"
          ])
              .pipe(print())
              .pipe(plumber())
              .pipe(jadeGlobbing({
                'modules': 'src/jade/modules/**/*.jade'
              }))
              .pipe(jade({
                pretty: '  ',
              }))
              .pipe(print())
              .pipe(rename(function (path) {
                console.log(path.basename);


                if (path.basename.substring(0, 1) === "-") {
                  path.basename = path.basename.replace("-" + row.name + "_", "");
                }

                if (path.basename.substring(0, 1) === "-") {
                  path.basename = path.basename = "~~" + path.basename;
                }
                console.log(path.basename);


              }))

              .pipe(gulp.dest('./app/' + row.name))

        }
      }
  );


});

gulp.task('jadeBlocks', function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row) {

      return gulp.src([
        "./develop/jade/pages/**/*.jade",
        "!./develop/jade/pages/**/_*.jade",
      ])
          .pipe(plumber())
          .pipe(jadeGlobbing({
            'modules': './develop/widgets/**/*.jade'
          }))
          .pipe(data(function (file) {
            return row.datas;
          }))
          .pipe(print())
          .pipe(rename(function (path) {
            console.log(path.basename);


            if (path.basename.substring(0, 1) === "-") {
              path.basename = path.basename.replace("-" + row.name + "_", "");
            }

            if (path.basename.substring(0, 1) === "-") {
              path.basename = path.basename = "~~" + path.basename;
            }
            console.log(path.basename);


          }))
          .pipe(jade({
            pretty: '  ',
          }))
          .pipe(gulp.dest('./app/' + row.name))

    }
  });

});


//-----SCSS-------
gulp.task('scss:main', function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row, i, reestr) {

      return gulp.src("./develop/scss/" + row.scss + ".scss")
          .pipe(plumber())

          .pipe(sourcemaps.init({loadMaps: true}))
          .pipe(sassGlob())

          .pipe(print())
          .pipe(sass.sync({
            errLogToConsole: true
          }))
          .pipe(autoprefixer({
            browsers: ['last 2 version', '> 2%', 'firefox 15', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
          }))
          .pipe(sourcemaps.write("."))
          .pipe(rename({
            basename: "main"
          }))

          .pipe(gulp.dest('./app/' + row.name + '/css'))
          // .pipe(reestr["bs_" + row.name] ? reestr["bs_" + row.name].stream() : {});

    }
  });

});

gulp.task('scss:widgets', function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row) {

      return gulp.src("./develop/widgets/**/*.scss")
          .pipe(plumber())
          .pipe(sourcemaps.init({loadMaps: true}))
          .pipe(sassGlob())
          .pipe(print())
          .pipe(sass.sync({
            errLogToConsole: true
          }))
          .pipe(autoprefixer({
            browsers: ['last 2 version', '> 2%', 'firefox 15', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
          }))
          .pipe(sourcemaps.write("."))
          .pipe(rename({dirname: ''}))
          .pipe(minifyCss())
          .pipe(gulp.dest("./app/" + row.name + "/css"))
    }

  });

});


gulp.task('scss', function (callback) {
  return runSequence(['scss:main', 'scss:widgets'], callback);
});


//-----JS-------
gulp.task('del:js', function () {
  return del.sync(['./develop/js/*.js']);
});


gulp.task('js:main', ['del:js'], function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row) {
      return gulp.src("./develop/templates/" + row.js + ".js")
          .pipe(plumber())
          .pipe(include())
          .pipe(print())
          .on('error', console.log)
          .pipe(concat("main.js"))
          .pipe(gulp.dest("./app/" + row.name + "/js"));
    }

  });

});

gulp.task('js:widgets', function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row) {
      return gulp.src("./develop/widgets/**/*.js")
          .pipe(plumber())
          .pipe(print())
          .pipe(rename({dirname: ''}))
          // .pipe( uglify() )
          .pipe(gulp.dest("./app/" + row.name + "/js"))
    }

  });

});

gulp.task('js', ['del:js'], function (callback) {
  return runSequence(['js:main', 'js:widgets'], callback);
});


//-----SPRITE-------
gulp.task('sprite', function (callback) {
  return runMultiTask({

    cb: callback,
    fn: function (row) {

      var spriteData = gulp.src('./develop/images/' + row.images + '/{' + row.sprites.join(',') + '}/*.png')
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

      spriteData.img.pipe(gulp.dest('./app/' + row.name + '/images'));
      spriteData.css.pipe(gulp.dest('./app/' + row.name + '/css'));
    }

  });
});


//=================build==========================


// ====TO YII====

gulp.task('build:yii:clean', function () {
});


//minifi img
gulp.task('build:yii:minifiImg', function (callback) {
  return;
  return gulp.src(['develop/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}'])
      .pipe(imagemin({zopflipng: false}))
      .on('error', console.log)
      .pipe(gulp.dest('../assets/images'));
});

gulp.task('build:yii:minifiJsCss', function (callback) {

  return runMultiTask({

    cb: callback,
    fn: function (row,i,reestr,resolve, reject) {

      return gulp.src('./app/' + row.name + '/index.html')

          .pipe(plumber())
          .pipe(print())
          .pipe(useref({searchPath: './app/' + row.name, base: './app/' + row.name}))
          .pipe(debug())
          .pipe(gulpif('*.js', uglify()
              .on('error', function (err) {
                gutil.log(gutil.colors.red('[Error]'), err.toString());
                this.emit('end');
              })
          ))
          .pipe(gulpif('*.css', minifyCss()))
          .pipe(rename(function (path) {
            console.log(path.dirname);
            if(path.basename === "main")
              path.basename = row.name;
          }))
          .on('error', reject)
          .pipe(gulp.dest('../assets'))
          .on('end', resolve)

    }

  });

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

// var app = "develop";
//
// // ====TO DIST====
//
// //cleandist
// gulp.task("build:clean", ["jadeBlocks"], function () {
//   return del.sync(["./dist"]);
// });
//
//
// //copydist
// gulp.task("build:copyDist", function () {
//
//   return gulp.src([
//     app + "/*.php",
//     app + "/.htaccess",
//     app + "/favicon.png",
//   ])
//       .pipe(print())
//       .pipe(gulp.dest("dist"));
//
// });
//
//
// //copylibs
// gulp.task("build:copyLibs", function () {
//
//   return gulp.src([
//     app + "/libs/**"])
//       .pipe(print())
//       .pipe(gulp.dest("dist/libs"));
//
// });
//
//
// //copy dist fonts
// gulp.task("build:copyDistFonts", function () {
//
//   return gulp.src([app + "/fonts/**/{*.eot,*.svg,*.ttf,*.eot,*.otf,*.woff2,*.woff}"])
//       .pipe(print())
//       .pipe(gulp.dest("dist/fonts"));
//
// });
//
//
// //minifi img
// gulp.task("build:minifiImg", function () {
//
//   return gulp.src([app + "/images/**/{*.jpg,*.png,*.jpeg,*.gif,*.svg}"])
//       .pipe(print())
//       .pipe(imagemin({zopflipng: false}))
//       .on("error", console.log)
//       .pipe(gulp.dest("dist/images"));
//
// });
//
//
// gulp.task("build:minifiJsCss", function () {
//
//   return gulp.src(app + "/**/*.html")
//       .pipe(useref({searchPath: app, base: app}))
//       .pipe(print())
//       .pipe(gulpif("*.js", uglify().on("error", function (err) {
//         gutil.log(gutil.colors.red("[Error]"), err.toString());
//         this.emit("end");
//       })))
//       .pipe(gulpif("*.css", minifyCss()))
//       .pipe(gulp.dest("dist"));
//
// });
//
//
// gulp.task("build:dist", ["build:clean"], function (callback) {
//
//   return runSequence([/*"build:copyDist",*/ "build:copyLibs", "build:copyDistFonts", "build:minifiImg", "build:minifiJsCss"], callback);
//
// });
//===TO DIST====