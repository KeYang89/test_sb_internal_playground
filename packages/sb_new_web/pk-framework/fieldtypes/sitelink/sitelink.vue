<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <label :for="fieldid" class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </label>

        <div class="uk-form-controls">
            <ul class="uk-list uk-margin-remove uk-list-line">
                <li v-for="site in fieldValue.data">

                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <input type="text" class="uk-form-width-large"
                               placeholder="{{ field.data.placeholder || '' | trans }}"
                               :name="fieldid + $index" :id="fieldid" v-validate:url
                               v-validate:required="fieldRequired && $index == 0"
                               v-model="site.value" @change="fieldValue.value[$index] = site.value">

                        <a v-if="$index > 0"
                           class="uk-icon-hover uk-icon-trash-o uk-margin-left"
                           @click="removeValue(site.value)" :title="'Remove value' | trans"></a>

                    </div>


                    <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form, $index)">{{ field.data.requiredError ||
                        'Please enter a valid url' | trans }}</p>

                    <div v-if="field.data.controls" class="uk-margin-small-top uk-flex uk-flex-middle uk-flex-space-between">

                        <input type="text" class="uk-form-width-medium" :placeholder="'Link text' | trans"
                               v-model="site.link_text"/>
                        <label><input type="checkbox" :true-value="1" :false-value="0" class="uk-margin-small-right"
                                      v-model="site.blank" number/>{{ 'Open in new window' | trans }}</label>
                    </div>

                </li>
            </ul>

            <div v-if="allowNewValue" class="uk-margin-small-top">
                <a @click="addValue('', {value: '', link_text: field.data.link_text_default, blank: field.data.blank_default})">
                    <i class="uk-icon-hover uk-icon-plus uk-margin-small-right"></i>{{ 'Add value' | trans }}</a>
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
            'placeholder': {
                type: 'text',
                label: 'Placeholder',
                attrs: {'class': 'uk-form-width-large'}
            },
            'blank_default': {
                type: 'checkbox',
                label: 'Default new window',
                optionlabel: 'Open in new window',
                attrs: {}
            },
            'link_text_default': {
                type: 'text',
                label: 'Default link text',
                attrs: {'class': 'uk-form-width-large'}
            }
        },

        appearance: {
            'href_class': {
                type: 'text',
                label: 'Link class',
                attrs: {'class': 'uk-form-width-large'}
            }
        },

        data: function () {
            return {
                fieldid: _.uniqueId('formmakerfield_')
            };
        },

        created: function () {
            if (this.fieldValue.value.length == 0) {
                this.addValue('', {
                    value: '',
                    link_text: this.field.data.link_text_default,
                    blank:  this.field.data.blank_default
                });
            }
        }

    };

</script>
