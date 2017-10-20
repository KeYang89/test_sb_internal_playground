/**
 * Editor Video plugin.
 */


module.exports = {

    plugin: true,

    created: function () {

        if (typeof tinyMCE === 'undefined') {
            return;
        }

        var vm = this;

        this.$parent.editor.plugins.push('media');
        this.$parent.editor.plugins.push('-sb_new_webVideo');
        tinyMCE.PluginManager.add('sb_new_webVideo', function (editor) {

            var showDialog = function () {

                var query, src, attributes = {}, element = editor.selection.getNode(), video = {};

                if (element.nodeName === 'IMG' && element.hasAttribute('data-mce-object')) {
                    editor.selection.select(element);

                    Object.keys(element.attributes).forEach(function (key) {
                        var name = element.attributes[key].name;

                        if (name === 'width' || name === 'height' || ((name = name.match(/data-mce-p-(.*)/)) && (name = name[1]))) {
                            video[name] = element.attributes[key].nodeValue === '' || element.attributes[key].nodeValue;
                        }

                    });

                } else if (element.nodeName === 'SPAN' && element.hasAttribute('data-mce-object') && (element = element.firstChild)) {

                    src = element.getAttribute('src');
                    src = src.split('?');
                    query = src[1];
                    src = src[0];
                    String(query).split('&').forEach(function (param) {
                        param = param.split('=');
                        video[param[0]] = param[1];
                    });

                    video.src = src;
                    video.width = element.getAttribute('width');
                    video.height = element.getAttribute('height');

                    Object.keys(element.attributes).forEach(function (key) {
                        var name = element.attributes[key].name;

                        if (name !== 'src' && name !== 'width' && name !== 'height') {
                            attributes[name] = element.attributes[key].nodeValue;
                        }

                    });
                }

                var picker = new vm.$parent.$options.utils['video-picker']({
                    parent: vm,
                    data: function () {
                        return {video: {data: video}}
                    }
                }).$mount()
                    .$appendTo('body')
                    .$on('select', function (video) {

                        var content, src, match;

                        delete video.data.playlist;

                        if (match = picker.isYoutube) {
                            src = 'https://www.youtube.com/embed/' + match[1] + '?';

                            if (video.data.loop) {
                                video.data.playlist = match[1];
                            }
                        } else if (match = picker.isVimeo) {
                            src = 'https://player.vimeo.com/video/' + match[3] + '?';
                        }

                        if (src) {

                            Object.keys(video.data).forEach(function (attr) {
                                if (attr === 'src' || attr === 'width' || attr === 'height') {
                                    return;
                                }

                                src += attr + '=' + (_.isBoolean(video.data[attr]) ? Number(video.data[attr]) : video.data[attr]) + '&';
                            });

                            attributes.src = src.slice(0, -1);
                            attributes.width = video.data.width || 690;
                            attributes.height = video.data.height || 390;
                            attributes.allowfullscreen = true;

                            content = '<iframe';
                            Object.keys(attributes).forEach(function (attr) {
                                content += ' ' + attr + ( _.isBoolean(attributes[attr]) ? '' : '="' + attributes[attr] + '"');
                            });

                            content += '></iframe>';

                        } else {

                            content = '<video';

                            Object.keys(video.data).forEach(function (attr) {
                                var value = video.data[attr];
                                if (value) {
                                    content += ' ' + attr + (_.isBoolean(value) ? '' : '="' + value + '"');
                                }
                            });

                            content += '></video>';
                        }

                        editor.selection.setContent('');
                        editor.insertContent(content);

                        editor.fire('change');

                    });
            };

            editor.addButton('media', {
                tooltip: 'Insert/edit video',
                onclick: showDialog,
                stateSelector: ['img[data-mce-object]', 'span[data-mce-object]']
            });

            editor.addMenuItem('media', {
                text: 'Insert/edit video',
                icon: 'media',
                context: 'insert',
                onclick: showDialog
            });
        });

    }

};