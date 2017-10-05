<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </span>

        <div class="uk-form-controls uk-form-controls-text">
            <p class="uk-form-controls-condensed">
                <label><input type="checkbox" class="uk-margin-small-right"
                              :name="fieldid" :id="fieldid"
                              v-bind:true-value="$trans('Agreed')"
                              v-bind:false-value="''"
                              :value="inputValue"
                              v-model="inputValue" v-validate:required="fieldRequired">
                    {{ field.data.checkbox_label_pre }}<a v-if="field.data.checkbox_label_link"
                            @click.prevent="openConditions">{{ field.data.checkbox_label_link }}</a>{{ field.data.checkbox_label_post }}
                </label>
            </p>

            <p v-if="field.data.help_text && field.data.help_show == 'block'"
               class="uk-form-help-block">{{{field.data.help_text}}}</p>

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ fieldRequiredMessage }}</p>
        </div>
        <div v-el:termsmodal class="uk-modal">
            <div class="uk-modal-dialog">
                <a class="uk-close uk-modal-close"></a>

                <div v-if="content" class="uk-overflow-container">
                    {{{ content }}}
                </div>
                <div v-else class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i></div>

                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">{{ 'Close' | trans }}</button>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        mixins: [SBFieldtypeMixin],

        settings: require('./components/settings.vue'),

        appearance: {},

        data() {
            return {
                fieldid: _.uniqueId('sbfieldtype_'),
                content: ''
            };
        },

        methods: {
            openConditions() {
                var data = {id: this.field.data.text_page_id};
                if (!this.content) {
                    this.$http.post(`/api/SB/agree/page`, {data})
                        .then(res => this.content = res.data.content, res => this.$notify(res.data));
                }
                var modal = UIkit.modal(this.$els.termsmodal, {
                    modal: false,
                });
                modal.on('show.uk.modal', () => UIkit.$(this.$els.termsmodal).appendTo(UIkit.$body));
                modal.on('hide.uk.modal', e => e.stopPropagation()); //prevent closing main modal
                modal.show();
            },
        },

    };

</script>
