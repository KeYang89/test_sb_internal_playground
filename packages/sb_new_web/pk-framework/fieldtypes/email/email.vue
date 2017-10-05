<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </label>

        <div class="uk-form-controls">
            <input type="email" class="uk-form-width-large" placeholder="{{ field.data.placeholder || '' | trans }}"
                   :name="fieldid" :id="fieldid"
                   v-model="inputValue"
                   v-validate:required="fieldRequired" v-validate:email/>

            <p v-if="field.data.help_text && field.data.help_show == 'block'"
               class="uk-form-help-block">{{{field.data.help_text}}}</p>

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ fieldRequiredMessage }}</p>
        </div>
    </div>

</template>

<script>

    module.exports = {

        mixins: [SBFieldtypeMixin],

        settings: {
            'placeholder': {
                type: 'text',
                label: 'Placeholder',
                attrs: {'class': 'uk-form-width-large'}
            }
        },

        appearance: {},

        data: function () {
            return {
                fieldid: _.uniqueId('formmakerfield_')
            };
        },

        watch: {
            'field.data.user_email': function (value) {
                this.formitem.data.user_email_field = value ? this.field.slug: false;
            }
        }

    };

</script>
