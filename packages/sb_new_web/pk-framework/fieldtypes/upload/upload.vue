<template>

    <div :class="classes(['uk-form-row', (isAdmin ? 'uk-hidden' : '')], field.data.classSfx)">
        <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </label>

        <div class="uk-form-controls">

            <div v-if="message.message" class="uk-alert" :class="message.msg_class">{{ message.message }}</div>

            <ul class="uk-list uk-list-striped" v-if="fieldValue.value.length">
                <li v-for="file in valuedata" class="uk-flex uk-flex-middle">
                    <div class="uk-flex-item-1 uk-margin-left">

                        <a class="uk-icon-hover uk-icon-trash-o uk-float-right uk-margin-small-top uk-margin-small-right"
                           @click="removeValue(file.value)" :title="'Remove file' | trans"></a>

                        <h4 class="uk-margin-remove">
                            <a :href="$url(file.url)" download><i class="uk-icon-file-o uk-margin-small-right"></i>{{ file.name }}</a>
                        </h4>
                        <small>{{ file.size | fileSize }}</small>
                    </div>
                    <div v-if="isImage(file.url)" class="uk-margin-left">
                        <img :src="$url(file.url)" :alt="file.name" style="max-height: 100px"/>
                    </div>
                </li>
            </ul>

            <div v-show="allowedUploads" class="uk-placeholder">
                <i class="uk-icon-cloud-upload uk-margin-small-right"></i>
                {{ 'Please drop a file here or ' | trans }}<a class="uk-form-file">{{ 'select a file' | trans }}<input
                    type="file" name="files[]" multiple="multiple"></a>.
            </div>

            <div class="uk-progress uk-progress-mini uk-margin-remove" v-show="upload.running">
                <div class="uk-progress-bar" :style="{width: upload.progress + '%'}"></div>
            </div>

            <p v-if="field.data.help_text && field.data.help_show == 'block'"
               class="uk-form-help-block">{{{field.data.help_text}}}</p>

        </div>

    </div>

</template>

<script>

    module.exports = {

        mixins: [SBFieldtypeMixin],

        settings: {
            'path': {
                type: 'text',
                label: 'Upload folder',
                tip: 'Folder will be a subfolder of SBWebApplication storage',
                attrs: {'class': 'uk-form-width-large'}
            },
            'text1': {
                type: 'paragraph',
                text: 'To enable uploads, make sure to allow uploading in the usergroups permissions (section sb/pk-framework)',
                attrs: {'class': 'uk-text-small'}
            },
            'allowed': {
                type: 'tags',
                label: 'Allowed extensions',
                options: ['png', 'jpg', 'jpeg', 'gif', 'svg', 'csv', 'xlsx', 'pdf', 'zip', 'gz'],
                attrs: {'class': 'uk-form-width-large'}
            },
            'max_size': {
                type: 'number',
                label: 'Max file size (Mb)',
                attrs: {'class': 'uk-form-width-medium uk-text-right', 'min': 0}
            },
            'max_files': {
                type: 'number',
                label: 'Max files (0 is unlimited)',
                attrs: {'class': 'uk-form-width-medium uk-text-right', 'min': 0}
            }
        },

        appearance: {},

        data: function () {
            return {
                action: window.$fieldtypes.ajax_url,
                path: 'uploads',
                upload: {},
                selected: [],
                message: {
                    message: '',
                    msg_class: ''
                },
                fieldid: _.uniqueId('formmakerfield_')
            };
        },

        created: function () {
            if (this.field.data.path) this.$set('path', this.field.data.path);
        },

        computed: {
            allowedUploads: function () {
                if (this.field.data.max_files >= 1) {
                    return this.field.data.max_files - this.fieldValue.value.length;
                }
                return true;
            }
        },

        methods: {
            isImage: function (url) {
                return url.match(/\.(?:gif|jpe?g|png|svg|ico)$/i);
            },
            clearMessage: function () {
                this.$set('message.message', '');
            },
            setMessage: function (message, msg_class) {
                this.$set('message.message', message);
                this.$set('message.msg_class', 'uk-alert-' + (msg_class || 'danger'));
            }
        },

        filters: {
            fileSize: function (size) {
                var i = Math.floor( Math.log(size) / Math.log(1024) );
                return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
            }
        },

        events: {

            'hook:ready': function () {

                var uploader = this,
                        settings = {

                            action: this.$url.route(uploader.action),

                            single: false,

                            allow: '*.(' + uploader.field.data.allowed.join('|') + ')',

                            notallowed: function (file, settings) {
                                uploader.setMessage(uploader.$trans('File extension not allowed.'));
                            },

                            before: function (options, files) {

                                if (uploader.allowedUploads !== true && uploader.allowedUploads < files.length) {
                                    uploader.setMessage(uploader.$trans('Maximum number of files reached.'));
                                    return false;
                                }

                                if (uploader.field.data.max_size > 0) {
                                    if (_.filter(files, function (file) {
                                                return file.size > (uploader.field.data.max_size * 1024 * 1024);
                                            }).length) {
                                        uploader.setMessage(uploader.$trans('File is too large.'));
                                        return false;
                                    }
                                }

                                _.assign(options.params, {
                                    field_id: uploader.field.id,
                                    action: 'uploadAction',
                                    path: uploader.path,
                                    _csrf: $sb_new_web.csrf
                                });
                            },

                            loadstart: function () {
                                uploader.clearMessage();
                                uploader.$set('upload.running', true);
                                uploader.$set('upload.progress', 0);
                            },

                            progress: function (percent) {
                                uploader.$set('upload.progress', Math.ceil(percent));
                            },

                            allcomplete: function (response) {

                                var data = $.parseJSON(response);

                                uploader.setMessage(data.message, data.error ? 'danger' : 'success');

                                if (data.files) {
                                    data.files.forEach(function (file) {
                                        uploader.addValue(file.name, file);
                                    });
                                    uploader.$dispatch('upload.success');
                                }

                                uploader.$set('upload.progress', 100);

                                setTimeout(function () {
                                    uploader.$set('upload.running', false);
                                }, 1500);
                            }

                        };

                UIkit.uploadSelect(this.$el.querySelector('.uk-form-file > input'), settings);
                UIkit.uploadDrop(this.$el.querySelector('.uk-placeholder'), settings);
            }

        }

    };

</script>
