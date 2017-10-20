module.exports = [
    {
        entry: {
            "app/bundle/tinymce": "./app/tinymce"
        },
        output: {
            filename: "./[name].js"
        },
        externals: {
            "lodash": "_",
            "jquery": "jQuery",
            "vue": "Vue",
            "uikit": "UIkit"
        },
        module: {
            loaders: [
                {test: /\.vue$/, loader: "vue"}
            ]
        }
    }
];