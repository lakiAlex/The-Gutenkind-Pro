"use strict";

// Theme name
var domain = "gutenkind";

// Load Dependencies
const {src, dest, series, parallel, watch} = require("gulp");
const browsersync = require("browser-sync").create();
const sass = require("gulp-sass");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const sourcemaps = require("gulp-sourcemaps");

const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");
const rename = require("gulp-rename");
const clean = require("gulp-clean");

const wpPot = require("gulp-wp-pot");
const gulpZip = require("gulp-zip");

// Synchronizing file changes
function browserSync(done) {
	browsersync.init({
		proxy: "127.0.0.1:8080/wordpress/",
		port: 4000
	});
	done();
}

// Compile sass
function css() {
	return src("./src/sass/**/*.scss")
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: "expanded"}).on("error", sass.logError))
		.pipe(
			postcss([
				autoprefixer({
					//browsers: ["last 99 versions"],
					cascade: false
				})
			])
		)
		.pipe(sourcemaps.write("./"))
		.pipe(dest("./"))
		.pipe(browsersync.stream());
}

// Compile, minify and rename admin script
function jsAdmin() {
	return src("./src/js/admin.js")
		.pipe(babel({
            presets: ['@babel/env']
        }))
		//.pipe(uglify())
		.pipe(rename('admin.min.js'))
		.pipe(dest("./dist/js/"))
		.pipe(browsersync.stream());
}

// Concatenate and minify vendor scripts
function jsVendor() {
	return src("./src/js/vendor/*.js")
		.pipe(concat("vendor.min.js"))
		.pipe(uglify())
		.pipe(dest("./src/js/temp/"))
		.pipe(browsersync.stream());
}

// Compile, minify and rename main script
function jsMain() {
	return src("./src/js/main.js")
		// .pipe(babel({
        //     presets: ['@babel/env']
        // }))
		//.pipe(uglify())
		.pipe(rename('main.min.js'))
		.pipe(dest("./src/js/temp/"))
		.pipe(browsersync.stream());
}

// Concate all scripts
function js() {
	return src(["./src/js/temp/vendor.min.js", "./src/js/temp/main.min.js"])
		.pipe(concat("main.min.js"))
		.pipe(dest("./dist/js/"))
		.pipe(browsersync.stream());
}

// Copy fonts folder
function fonts() {
	return src(["./src/fonts/**/*"])
		.pipe(dest("./dist/fonts/"));
}

// Copy img folder
function img() {
	return src(["./src/img/**/*"])
		.pipe(dest("./dist/img/"));
}

// Copy svg folder
function svg() {
	return src(["./src/svg/**"])
		.pipe(dest("./dist/svg/"));
}

// Generate theme pot file
function lang() {
	return src("./**/*.php")
		.pipe(
			wpPot({
				domain: domain,
				package: domain
			})
		)
		.pipe(dest("lang/" + domain + ".pot"));
}

// Build theme zip file
function zip() {
	return src([
		"./**/*",
		"!./{node_modules,node_modules/**/*}",
		"!./{_build,_build/**/*}",
		"!./{src,src/**/*}",
		"!./gulpfile.js",
		"!./package.json",
		"!./package-lock.json",
		"!./*.map",
		"!./{.git,.git/**/*}",
		"!./desc.txt",
		"!.DS_Store"
	])
		.pipe(gulpZip(domain + ".zip"))
		.pipe(dest("./_build/"));
}

// Watch files
function watchFiles() {
	watch("./src/sass/**/*.scss", series(css));
	watch("./src/js/admin.js", series(jsAdmin));
	watch("./src/js/vendor/*", series(jsVendor));
	watch("./src/js/main.js", series(jsMain));
	watch("./src/js/temp/*", series(js));
}

// Export tasks
exports.zip = zip;
exports.lang = lang;
exports.jsAdmin = jsAdmin;
exports.jsVendor = jsVendor;
exports.jsMain = jsMain;
exports.js = js;
exports.css = css;

exports.build = parallel(css, series(jsAdmin, jsVendor, jsMain, js), fonts, img, svg, lang, zip);
exports.default = parallel(watchFiles, browserSync);
