module.exports = function (grunt) {
// Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        dirs: {
            src: 'src/files',
            dest: 'style/js',
        },
        sass: {// Task 
            dist: {// Target 
                options: {// Target options 
                    style: 'compressed',
                    sourcemap: 'auto'
                },
                files: {// Dictionary of files 
                    'css/style.css': 'css/style.scss'
                }
            }
        },
        // Project configuration. 

        concat: {
            options: {
                separator: '',
                sourceMap: true
            },
            dist: {
                src: ['js2/*/*.js', 'js2/*/*/*.js'],
                dest: 'js3/built.js'
//                 src: ['js2/ts/*/*.ts'],
//                 dest: 'js3/built.ts'
            }
        },

//        uglify: {
//             options: {
//                compress: {
//                    drop_console: true // <-
//                },
//                sourceMap: true
//            },
//            my_target: {
//               files: [{
//                        expand: true,
//                        cwd: 'js2',
//                        src: ['*/*.js', '!*/*.min.js'],
//                        dest: 'js2',
//                        ext: '.min.js'
//                    }]
//            }
//        },

        uglify: {
            options: {
                compress: {
                    drop_console: true // <-
                },
                sourceMap: true
            },
            my_target: {
                files: {
                    'js3/built.min.js': ['js3/built.js'],
                    'js/sale/noti_contact_recall.min.js': ['js/sale/noti_contact_recall.js']
                }
            }
        },
        obfuscator: {
            options: {
                // global options for the obfuscator 
            },
            task1: {
                options: {
                    // options for each sub task 
                },
                files: {
                    'js3/built_obfuscated.min.js': [
                        'js3/built.min.js'
                    ]
                }
            }
        },
        watch: {
            css: {
                files: ['css/style.scss', 'css/*/*.scss'],
                tasks: ['sass']
            },
            scripts: {
                files: ['js2/*/*.js', 'js2/*/*/*.js'],
                tasks: ['concat']
            }
        },
        typescript: {
            base: {
                src: ['js2/ts/*/*.ts'],
                dest: 'js2/ts/*/',
                ext: '.js',
                options: {
                    module: 'amd' //or commonjs 
                }
            }
        }

    });
    // Load the plugin that provides the "uglify" task.
    // grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-obfuscator');
    grunt.loadNpmTasks('grunt-typescript');
    // Default task(s).
    grunt.registerTask('default', ['sass', 'concat', 'watch']);
    grunt.registerTask('nowatch', ['sass', 'concat', 'uglify', 'obfuscator']);
    grunt.registerTask('ob', ['obfuscator']);
    grunt.registerTask('ts', ['typescript']);
};