<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </label>

        <div class="uk-form-controls">

            <select v-if="field.data.multiple" class="uk-form-width-large" multiple="multiple"
                    :name="fieldid"
                    v-bind="{id: fieldid, size:field.data.size > 1 ? field.data.size : false}"
                    v-model="inputValue"
                    v-validate:required="fieldRequired">
                <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
            </select>

            <select v-else class="uk-form-width-large"
                    :name="fieldid"
                    v-bind="{id: fieldid, size:field.data.size > 1 ? field.data.size : false}"
                    v-model="inputValue"
                    v-validate:required="fieldRequired">
                <option v-for="option in field.options" :value="option.value">{{ option.text }}</option>
            </select>

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

        appearance: {
            'size': {
                type: 'number',
                label: 'Size',
                attrs: {'class': 'uk-form-width-small uk-text-right', 'min': 1}
            }
        },

        data: function () {
            return {
                fieldid: _.uniqueId('formmakerfield_')
            };
        }

    };

</script>
