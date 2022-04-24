/**
 * Grunt tasks configuration
 *
 * @param Grunt Grunt node module
 */
module.exports = function (Grunt) {

    Grunt.loadNpmTasks("grunt-contrib-cssmin");
    Grunt.loadNpmTasks("grunt-contrib-concat");
    Grunt.loadNpmTasks("grunt-contrib-uglify");
    Grunt.loadNpmTasks("grunt-contrib-clean");
    Grunt.loadNpmTasks("grunt-contrib-sass");

    let build = Grunt.option("build") || "-development";

    Grunt.initConfig(build);
    Grunt.registerTask();

}