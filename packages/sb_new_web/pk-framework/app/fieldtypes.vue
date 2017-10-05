<template>

    <div>
        <component v-for="field in fields | orderBy 'priority'" track-by="id"
                   :is="field.type"
                   :field="field"
                   :model="model"
                   :is-admin="isAdmin"
                   :form="form"></component>
    </div>

</template>

<script>

    window.SBFieldtypeMixin = require('./mixins/fieldtype');
    window.SBFieldtypes = module.exports = {

        props: {
            'fields': {type: Array, default: function () { return [];}},
            'model': {type: Object, default: function () { return {};}},
            'editType': {type: String, default: ''},
            'form': {default: function () { return {};}}
        },

        computed: {
            isAdmin: function () {
                return !!this.editType
            }
        },

        components: {
            'agree': require(`../fieldtypes/agree/agree.vue`),
            'checkbox': require(`../fieldtypes/checkbox/checkbox.vue`),
            'dob': require(`../fieldtypes/dob/dob.vue`),
            'email': require(`../fieldtypes/email/email.vue`),
            'htmlcode': require(`../fieldtypes/htmlcode/htmlcode.vue`),
            'map': require(`../fieldtypes/map/map.vue`),
            'pulldown': require(`../fieldtypes/pulldown/pulldown.vue`),
            'radio': require(`../fieldtypes/radio/radio.vue`),
            'sitelink': require(`../fieldtypes/sitelink/sitelink.vue`),
            'text': require(`../fieldtypes/text/text.vue`),
            'textbox': require(`../fieldtypes/textbox/textbox.vue`),
            'upload': require(`../fieldtypes/upload/upload.vue`),
        }

    };

    Vue.component('fieldtypes', function (resolve) {
        resolve(module.exports);
    });

</script>

