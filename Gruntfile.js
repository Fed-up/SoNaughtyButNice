module.exports = function(grunt) {

	grunt.initConfig({

		// Load project information for package.json
		pkg: '<json:package.json>',

		watch:{
			options:{
				livereload: true
			},
			css:{
				files: ["public/sass/**/*.scss"],
				tasks: ["css"]
			},
			// js:{
			// 	files: ["js/**/*.js"],
			// 	tasks: ["js"]
			// },
			php:{
				options:{
					livereload: true
				},
				files: [
							"app/views/**/*.php"
						]
			},
			grunt: {
				files: ['gruntfile.js']
			}
			
		},


		sass: {
			options: {
				includePaths: [
					'public/bower_components/foundation/scss',
					require('node-bourbon').includePaths
				]
			},
			dev: {
				options: {
					imagesPath: "public/uploads",
					outputStyle: "nested",
					sourceComments: "normal"
				},
		        files: {
		          'public/sass/compiled_css/dev_snbn.css': 'public/sass/snbn.scss'
		        }     
			},
			// dist: {
			// 	options: {
			// 		imagesPath: "images",
			// 		outputStyle: "compressed",
			// 		sourceComments: "none"
			// 	},
		 //        files: {
		 //          'sass/compiled_css/deploy_fooddaily.css': 'sass/fooddaily.scss',
		 //          'sass/compiled_css/deploy_ie9.css': 'sass/ie9.scss',
		 //          'sass/compiled_css/deploy_print.css': 'sass/print.scss'
		 //        }     
			// }
		},

		copy:{	//Copies the sass files to into the deploy folder ready for the llive site		
			css:{
					files : {
						'public/deploy_css/snbn.min.css' : 'public/sass/compiled_css/dev_snbn.css'
					}
			},
			// js:{
			// 		src: 'deploy_js/fooddaily_concat.js',
			// 		dest: 'deploy_js/fooddaily.min.js'
			// }
		},
		cssmin:{
			dist:{
				files: {
					'public/deploy_css/snbn.min.css' : 'public/sass/compiled_css/dev_snbn.css'
				}
			}
		},
		

		// jshint: {
		//   all: [
		// 	'js/fooddaily.js',
		// 	'js/angular/*.js'
		//   ]
		// },

		// concat: {
		// 	options: {
		//   			separator: ';',
		// 		},
		// 	js: {
		//   		src: [
		// 	  			'bower_components/jquery/jquery.js',
		// 	  			'bower_components/jquery-cookie/jquery.cookie.js',
		// 	  			'bower_components/sticky/jquery.sticky.js',
		// 	  			'bower_components/picturefill/picturefill.js',
		// 	  			'bower_components/jquery.cycle2/index.js',
		// 	  			'js/libs/jquery.cycle2/jquery.cycle2.swipe.js',
		// 	  			'js/libs/jquery.cycle2/jquery.cycle2.swipe.ios6fix.js',

		// 				'bower_components/angular/angular.js',
		// 				'bower_components/angular-route/angular-route.js',
		// 				'bower_components/angular-animate/angular-animate.js',
		// 				'bower_components/angular-resource/angular-resource.js',
		// 				'bower_components/angular-sanitize/angular-sanitize.js',

		// 				'bower_components/foundation/js/foundation/foundation.js',

		// 				'js/app/fooddaily__services.js',
		// 				'js/app/fooddaily__controllers.js',
		// 				'js/app/fooddaily__directives.js',
		// 				'js/app/fooddaily__app.js'
		//   			],
		//   		dest: 'deploy_js/fooddaily_concat.js',
		// 	},
		// 	libs:{
		// 		src: [
		// 		 		"js/libs/jquery.cycle2/jquery.cycle2.min.js",
		// 		 		"js/libs/jquery.cycle2/jquery.cycle2.swipe.min.js",
		// 		 		"deploy_js/jquery.cycle2.swipe.ios6fix.min.js"
		// 		],
		// 		dest: 'deploy_js/jquery.cycle2.concat.min.js'
		// 	}			
		// },

		// closurecompiler: {
		// 	main: {
		// 		files: {
		// 			"deploy_js/fooddaily.min.js": ["deploy_js/fooddaily_concat.js"]
		// 		},
		// 		options: {
		// 			"compilation_level": "SIMPLE_OPTIMIZATIONS",
		// 			"max_processes": 5,
		// 			"language_in": "ECMASCRIPT5_STRICT"
		// 		}
				
		// 	},

		// 	libs: {
		// 		files:{
		// 			"deploy_js/jquery.cycle2.swipe.ios6fix.min.js": ["js/libs/jquery.cycle2/jquery.cycle2.swipe.ios6fix.js"]
		// 		},
		// 		options: {					
		// 			"compilation_level": "SIMPLE_OPTIMIZATIONS",
		// 			"max_processes": 5,
		// 			"language_in": "ECMASCRIPT5_STRICT"
		// 		}

		// 	}
		// }
	});


	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('css', ['sass:dev', 'copy:css']);



	grunt.registerTask('js', ['copy:js']);
	grunt.registerTask('deploy', ['cssmin']); //'concat:js', 'closurecompiler:main', 'sass:dist', 'sass:dist',  
	grunt.registerTask('deploy-css', ['cssmin']);
};