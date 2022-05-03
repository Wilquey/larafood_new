const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    // .sass('resources/sass/app.scss', 'public/css');
//     .postCss('resources/css/custom-dash.css', 'public/css', [
//         //
//     ])
//     .postCss('resources/css/site.css', 'public/css', [
//         //
//     ]);

mix.extend(
    "graphql",
    new (class {
        dependencies() {
            return ["graphql", "graphql-tag"];
        }

        webpackRules() {
            return {
                test: /\.(graphql|gql)$/,
                exclude: /node_modules/,
                loader: "graphql-tag/loader"
            };
        }
    })()
);


mix.js("resources/js/app.js", "public/js").vue();

mix.graphql();
