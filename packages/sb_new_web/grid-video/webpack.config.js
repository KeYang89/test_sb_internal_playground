module.exports = [

    {
        entry: {
            "widget-video-projects": "./app/components/widget-video-projects.vue",
            /*frontpage views*/
            "video": "./app/views/video.js",
            /*admin views*/
            "video-settings": "./app/views/admin/settings.js",
            "admin-video": "./app/views/admin/video.js",
            "admin-project": "./app/views/admin/project.js"
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        externals: {
            "lodash": "_",
            "jquery": "jQuery",
            "uikit": "UIkit",
            "vue": "Vue"
        },
        module: {
            loaders: [
                {test: /\.vue$/, loader: "vue"},
                {test: /\.html/, loader: "vue-html"}
            ]
        }
    }

];
