/**
 * Editor Image plugin.
 */

module.exports = {

    plugin: true,

    created: function () {

        if (typeof tinyMCE === 'undefined') {
            return;
        }

        var vm = this;

        this.$parent.editor.plugins.push('-sb_new_webImage');
        tinyMCE.PluginManager.add('sb_new_webImage', function (editor) {

            var showDialog = function () {

                var element = editor.selection.getNode();

                if (element.nodeName === 'IMG') {
                    editor.selection.select(element);
                    var image = {src: element.attributes.src.nodeValue, alt: element.attributes.alt.nodeValue};
                } else {
                    image = {}
                }

                new vm.$parent.$options.utils['image-picker']({
                    parent: vm,
                    data: {
                        image: {data: image}
                    }
                }).$mount()
                    .$appendTo('body')
                    .$on('select', function (image) {

                        element.setAttribute('src', '');
                        element.setAttribute('alt', '');

                        var attributes = Object.keys(element.attributes).reduce(function (previous, key) {
                            var name = element.attributes[key].name;

                            if (name === 'data-mce-src') {
                                return previous;
                            }

                            return previous + ' ' + name + '="' + (image.data[name] || element.attributes[key].nodeValue) + '"';
                        }, '');

                        editor.selection.setContent(
                            '<img' + attributes + '>'
                        );

                        editor.fire('change');

                    });
            };

            editor.addButton('image', {
                tooltip: 'Insert/edit image',
                onclick: showDialog,
                stateSelector: 'img:not([data-mce-object],[data-mce-placeholder]),figure.image'
            });

            editor.addMenuItem('image', {
                text: 'Insert/edit image',
                icon: 'image',
                context: 'insert',
                onclick: showDialog
            });

        });
    }

};