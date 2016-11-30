const execSync = require('child_process').execSync;

module.exports = function (grunt) {

    grunt.initConfig({

        concat: {
            options: {
                stripBanners: true,
                separator: ';\n'
            },
            libraries: {
                src: [
                    'node_modules/babel-polyfill/dist/polyfill.js',
                    'node_modules/jquery/dist/jquery.js',
                    'node_modules/angular/angular.js',
                    'node_modules/angular-i18n/angular-locale_de-ch.js',
                    'node_modules/angular-route/angular-route.js',
                    'node_modules/angular-sanitize/angular-sanitize.js',
                    'node_modules/angular-animate/angular-animate.js',
                    'node_modules/angular-ui-mask/dist/mask.js',
                    'node_modules/ui-select/dist/select.js',
                    'node_modules/moment/moment.js',
                    'node_modules/moment/locale/de.js',
                    'node_modules/pikaday/pikaday.js',
                    'node_modules/ngclipboard/dist/ngclipboard.js',
                    'node_modules/ng-file-upload/dist/ng-file-upload.js',
                    'node_modules/bootstrap.min.js'
                ],
                dest: 'web/js/libraries.js'
            },

            app: {
                src: [
                    'src/JavaScript/dependencies.js'
                ],
                dest: 'web/js/app.js'
            }
        },

        sass: {
            dist : {
                options: {
                    style: 'expanded'
                },
                files: {
                    'web/themes/default/theme.css': 'src/Themes/default/scss/theme.scss'
                }
            }
        },

        uglify: {
            options: {
                mangle: false,
                preserveComments: false,
                screwIE8: true
            },
            dist: {
                files: {
                    'web/js/libraries.js': ['<%= concat.libraries.dest %>'],
                }
            }
        },

        cssmin: {
            target: {
                files: {
                    'web/themes/default/theme.css': 'web/themes/default/theme.css'
                }
            }
        },

    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-babel');

    grunt.registerTask('default', ['concat', 'sass']);
    grunt.registerTask('publish', ['concat', 'uglify', 'cssmin']);

}