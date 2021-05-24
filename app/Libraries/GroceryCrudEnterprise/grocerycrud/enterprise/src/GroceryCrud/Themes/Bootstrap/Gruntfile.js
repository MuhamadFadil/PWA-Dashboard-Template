/*jslint node: true, sloppy: true, es5: true */
module.exports = function (grunt) {

    var build_folder = '../Build/assets/grocery_crud/themes/bootstrap',
        my_package = grunt.file.readJSON("package.json"),
        release_version = my_package.version;

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            options: {
                force: true
            },
            build: ["../Build"]
        },
        uglify: {
            my_target: {
                files: {
                    'js/common/common.min.js': 'js/common/common.js',
                    'js/datagrid/gcrud.datagrid.min.js': 'js/datagrid/gcrud.datagrid.js',
                    'js/datagrid/list.min.js': 'js/datagrid/list.js',
                    'js/form/add.min.js': 'js/form/add.js',
                    'js/form/edit.min.js': 'js/form/edit.js',
                    'js/form/view.min.js': 'js/form/view.js',
                    'js/jquery-plugins/jquery.print-this.min.js': 'js/jquery-plugins/jquery.print-this.js'
                }
            }
        },
        concat: {
            options: {
                separator: '\n'
            },
            dist: {
                src: [
                    'js/jquery-plugins/jquery.form.min.js',
                    'js/common/common.min.js'
                ],
                dest: 'build/js/global-libs.min.js'
            }
        },
        release: {
            options: {
                npm: false,
                tagName: 'v<%= version %>',
                commitMessage: 'version <%= version %>'
            }
        },
        mkdir: {
            all: {
                options: {
                    create: [build_folder]
                }
            }
        },
        copy: {
          main: {
            files: [
          
              {src: ['index.html'], dest: build_folder + '/'},
              {src: ['config.php'], dest: build_folder + '/'},

              {expand: true, src: ['css/**'], dest: build_folder + '/'},
              {expand: true, src: ['fonts/**'], dest: build_folder + '/'},
              {expand: true, src: ['images/**'], dest: build_folder + '/'},
              {expand: true, src: ['js/**'], dest: build_folder + '/'},
              {expand: true, src: ['views/**'], dest: build_folder + '/'},
              {expand: true, src: ['build/**'], dest: build_folder + '/'},
            ],
          },
        },
        compress: {
            main: {
                options: {
                    archive: '../Build/bootstrap-theme-v' + release_version + '.zip'
                },
                files: [
                    {
                      expand: true, 
                      src : "**/*", 
                      cwd: '../Build/'}
                ]
            }
        }      
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-release');
    grunt.loadNpmTasks('grunt-mkdir');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // Default task(s).
    grunt.registerTask('default', [
        'clean',
        'uglify',
        'concat',
        'mkdir' ,
        'copy',
        'compress',
        //'release',
    ]);

};
