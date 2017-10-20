module.exports = {

    data: function () {
        return {
            plugins: []
        };
    },

    created: function () {
        var baseURL = $tinymce.root_url + '/app/assets/tinymce',
            vm = this;

        this.$parent.editor = this;

        this.$asset({
            js: [baseURL + '/tinymce.jquery.min.js']
        }).then(function () {

            this.$emit('ready');

            tinyMCE.baseURL = baseURL;
            tinyMCE.suffix = '.min';

            this.$parent.editor = tinyMCE.init(_.merge({

                height: this.$parent.height - 108,

                mode: "exact",

                plugins: [
                    vm.plugins,
                    'advlist autolink lists charmap print preview hr anchor media',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime nonbreaking save table contextmenu directionality',
                    'paste textcolor colorpicker textpattern imagetools'
                ],

                toolbar: 'undo redo | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code | fullscreen',

                document_base_url: Vue.url.options.root + '/',

                elements: [this.$parent.$els.editor],

                element_format: 'html',

                entity_encoding: "raw",

                init_instance_callback: function (editor) {
                    vm.tiny = editor;

                    var update = function (value) {
                        this.tiny.setContent(value || '', {format: 'text'});
                    };

                    var unbind = vm.$watch('$parent.value', update, {immediate: true});

                    editor.on('change', function () {

                        unbind();

                        vm.$parent.value = editor.getContent();

                        unbind = vm.$watch('$parent.value', update);

                    });

                    editor.on('undo', function () {
                        editor.fire('change');
                    });

                    editor.on('redo', function () {
                        editor.fire('change');
                    });

                },

                save_onsavecallback: function () {

                    if (vm.$parent.$els.editor.form) {
                        var event = document.createEvent('HTMLEvents');
                        event.initEvent('submit', true, false);
                        vm.$parent.$els.editor.form.dispatchEvent(event);
                    }

                }

            }, $tinymce));

        });

    }

};
