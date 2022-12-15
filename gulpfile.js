const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel')
const uglify = require('gulp-uglify');

const { src, dest, parallel, watch } = gulp

const jsSrcGlobs = 'admin/assets/src/js/*.js'
const sassSrcGlobs = 'admin/assets/src/sass/**/*.scss'

function buildSass() {
    const options = {}

    if ('dev' !== process.env.NODE_ENV) {
        options.outputStyle = 'compressed'
    }

    return src(sassSrcGlobs)
        .pipe(sass(options).on('error', sass.logError))
        .pipe(dest('admin/assets/build'))
}

function buildBabel() {
    if ('dev' === process.env.NODE_ENV) {
        return src(jsSrcGlobs)
            .pipe(babel({
                presets: ['@babel/env']
            }))
            .pipe(dest('admin/assets/build'))
    }

    return src(jsSrcGlobs)
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(uglify())
        .pipe(dest('admin/assets/build'))
}

exports.default = parallel(buildSass, buildBabel)
exports.watch = function() {
    buildSass()
    buildBabel()

    watch(sassSrcGlobs, buildSass)
    watch(jsSrcGlobs, buildBabel)
}