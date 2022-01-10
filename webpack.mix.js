const mix = require("laravel-mix");

if (mix == 'undefined') {
    const { mix } = require("laravel-mix");
}

require("laravel-mix-merge-manifest");

if (mix.inProduction()) {
    var publicPath = 'publishable/assets';
} else {
    var publicPath = "../../../public/themes/default/assets";
}

mix.setPublicPath(publicPath).mergeManifest();
mix.disableNotifications();

mix.js([__dirname + "/src/Resources/assets/js/app.js"], "js/delivery-time-slot.js")
    .copyDirectory(__dirname + "/src/Resources/assets/images", publicPath + "/images")
    .sass(__dirname + "/src/Resources/assets/sass/app.scss", "css/delivery-time-slot.css")
    .sass(__dirname + "/src/Resources/assets/sass/admin.scss", "css/delivery-time-slot-admin.css")
    .options({
        processCssUrls: false
    });


if (! mix.inProduction()) {
    mix.sourceMaps();
}

if (mix.inProduction()) {
    mix.version();
}