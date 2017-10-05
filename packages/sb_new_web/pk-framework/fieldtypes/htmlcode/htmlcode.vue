<template>

    <div :class="classes(['uk-form-row', (isAdmin ? 'uk-hidden' : '')], field.data.classSfx)">

        {{{ html }}}

    </div>

</template>

<script>

    module.exports = {

        mixins: [SBFieldtypeMixin],

        settings: require('./components/settings.vue'),

        appearance: {},

        data: function () {
            return {
                fieldid: _.uniqueId('formmakerfield_')
            };
        },

        computed: {
            html() {
                return this.fieldValue.formatted ? this.fieldValue.formatted[0] : '';
            }
        }

    };

</script>
