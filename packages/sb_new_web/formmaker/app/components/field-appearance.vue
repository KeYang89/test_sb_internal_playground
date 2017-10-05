<template>

    <div class="uk-form-horizontal">

        <partial name="fieldtype-appearance"></partial>

        <sb-fields v-if="hasAppearanceSettings" :config="appearanceSettings" :values.sync="field.data"></sb-fields>

    </div>

</template>

<script>

    module.exports = {

        props: ['field', 'form'],

        computed: {
            hasAppearanceSettings() {
                return _.size(this.appearanceSettings) > 0;
            },
            appearanceSettings() {
                return this.field.type ? SBFieldtypes.components[this.field.type].appearance || SBFieldtypes.components[this.field.type].options.appearance : {};
            }
        }

    };

</script>
