const mix = require('laravel-mix');

// pages
mix.sass('resources/sass/pages/about.scss', 'public/css/pages')
.sass('resources/sass/pages/contact.scss', 'public/css/pages')
.sass('resources/sass/pages/error.scss', 'public/css/components')
.sass('resources/sass/pages/home.scss', 'public/css/pages')
.sass('resources/sass/pages/schedule.scss', 'public/css/pages')
.sass('resources/sass/pages/login.scss', 'public/css/pages')

//manages
.sass('resources/sass/pages/admin.scss', 'public/css/pages')

// components
.sass('resources/sass/components/element.scss', 'public/css/components')
.sass('resources/sass/components/layout.scss', 'public/css/components')
.sass('resources/sass/components/component.scss', 'public/css/components')
.sass('resources/sass/components/scroll-history.scss', 'public/css/components')
.sass('resources/sass/components/form.scss', 'public/css/pages')

.copy('resources/images/', 'public/images')

.options({
    processCssUrls: false
})
.sourceMaps()
.version();