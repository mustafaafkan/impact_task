let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
       .sass('resources/sass/app.scss', 'public/css')
       .vue()
       .version();
mix.webpackConfig(webpack => {
       return {
              plugins: [
                     new webpack.DefinePlugin({
                     __VUE_PROD_HYDRATION_MISMATCH_DETAILS__ : 'false',
                     }),
              ],
       }
       });

