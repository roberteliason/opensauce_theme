module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'css/styles.css' : 'scss/styles.scss'
        }
      }
    },
    uglify: {
      my_target: {
        files: {
          'js/main.min.js': ['js/_swipers.js', 'js/_navigation.js', 'js/_recipe.js', 'js/_popups.js']
        }
      }
    },
    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['sass']
      },
      js: {
        files: '**/_*.js',
        tasks: ['uglify']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default',['watch']);
}