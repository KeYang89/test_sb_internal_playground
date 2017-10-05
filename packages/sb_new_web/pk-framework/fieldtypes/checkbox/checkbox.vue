<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </span>

        <div class="uk-form-controls uk-form-controls-text">
            <p v-for="option in field.options" class="uk-form-controls-condensed">
                <label><input type="checkbox" value="{{ option.value }}"
                              v-model="inputValue"> {{ option.text }}</label>
            </p>

            <p v-if="field.data.help_text && field.data.help_show == 'block'"
               class="uk-form-help-block">{{{field.data.help_text}}}</p>

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ fieldRequiredMessage }}</p>
        </div>
    </div>

</template>

<script>

    module.exports = {

        mixins: [SBFieldtypeMixin],

        settings: {},

        appearance: {},

        data: function () {
            return {
                fieldid: _.uniqueId('sbfieldtype_')
            };
        }

    };

</script>
