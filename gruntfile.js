module.exports = function(grunt) {

  //configure tasks
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          style: 'expanded',
          noCache: true
        },
        files: {
          'assets/css/style.css': 'src/scss/app.scss'
        }
      }
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('pixrem')(),
          require('autoprefixer')({broswers: 'last 2 versions'}),
          require('cssnano'),
          require('postcss-size')({}),
          require('postcss-alias')({}),
          require('postcss-center')({}),
          require('postcss-vmin')({}),
          require('css-byebye')({ rulesToRemove: [''], map: false })
        ]
      },
      files: {
        expand: true,
        cwd: 'assets/css/',
        src: ['*.css'],
        dest: 'C:/MAMP/htdocs/concrete/themes/fgn/assets/css',
      },
    },
    uglify: {
      build: {
        src: 'src/js/app.js',
        dest: 'src/js/script.min.js'
      },
      options: {
        mangle: {
          except: ['jQuery', 'Backbone']
        }
      }
    },
    watch: {
      scripts: {
       files: ['src/js/*.js'],
       tasks: ['uglify', 'copy:theme'],
       options: {
         spawn: false,
       },
     },
     css: {
       files: 'src/scss/**/*.scss',
       tasks: ['sass', 'postcss'],
       options: {
         spawn: false,
       }
     },
     php: {
       files: 'src/**/*.php',
       tasks: ['copy:theme'],
       options: {
         spawn: false,
       }
     },
   },
   browserSync: {
     dev: {
       options: {
         files: [
           'C:/MAMP/htdocs/concrete/themes/fgn/**/*/*',
         ],
          port: '3000',
          open: 'local',
          watchTask: true,
          proxy: "localhost/concrete",
       }
     }
   },
   clean: {
     folder: ['C:/MAMP/htdocs/concrete/themes'],
     options: {
       force: true
     }
   },
   copy: {
     images: {
       files: [{
         expand: true,
         cwd: 'assets/img/',
         src: [
           '**.jpg',
           '**.jpeg',
           '**.png',
           '**.gif',
           '**.svg',
           '**.ico'
         ],
         dest: 'C:/MAMP/htdocs/concrete/themes/fgn/assets/img'
       }]
     },
    //  css: {
    //    files: [{
    //      expand: true,
    //      cwd: 'css/',
    //      src: [
    //        '**/*.css',
    //      ],
    //      dest: 'C:/wamp64/www/wordpress/wp-content/themes/Dennis/css'
    //    }]
    //  },
     fonts: {
       files: [{
         expand: true,
         src: [
           'fonts/**.eot',
           'fonts/**.ttf',
           'fonts/**.otf',
           'fonts/**.svg',
           'fonts/**.woff'
         ],
         dest: 'C:/MAMP/htdocs/concrete/themes/fgn/assets/fonts'
       }]
     },
     theme: {
       files: [{
         expand: true,
         spawn: false,
         cwd: 'src/',
         src: [
           '**/*',
           '!scss/**',
           '!fonts/**',
           '!img/**'
         ],
         dest: 'C:/MAMP/htdocs/concrete/themes/fgn'
       }]
     },
   },
 });
  //load the plugins
  grunt.loadNpmTasks ('grunt-sass'); //Convert to css
  grunt.loadNpmTasks ('grunt-contrib-uglify'); //Js uglify
  grunt.loadNpmTasks('grunt-contrib-watch'); //Watch when items change
  grunt.loadNpmTasks('grunt-browser-sync'); //Sync browser
  grunt.loadNpmTasks('grunt-contrib-copy'); //copy to wordpress
  grunt.loadNpmTasks('grunt-postcss'); //post css
  grunt.loadNpmTasks('grunt-contrib-clean'); //clean files

  //Register tasks
  grunt.registerTask('default', ['clean', 'sass', 'postcss', 'uglify', 'copy', 'browserSync' , 'watch']);

};
