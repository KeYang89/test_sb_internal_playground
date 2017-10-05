<template>

    <div class="uk-form-horizontal">

        <partial name="fieldtype-appearance"></partial>

        <sb-fields :config="appearanceSettings" :values.sync="field.data"></sb-fields>

    </div>

</template>

<script>

    module.exports = {

        props: ['field'],

        computed: {
            appearanceSettings: function () {
                return this.field.type ? SBFieldtypes.components[this.field.type].appearance || SBFieldtypes.components[this.field.type].options.appearance : {};
            }
        }

    };

</script>
