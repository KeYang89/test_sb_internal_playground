<template>

    <div class="uk-form-row">
        <label class="uk-form-label">{{ 'Page with conditions' | trans }}</label>
        <div class="uk-form-controls">
            <input-related-item :model.sync="field.data.text_page_id"
                                :selected.sync="field.data.text_page"
                                resource="api/site/page"
                                name=""
                                extra_key=""
                                button-text="Select Page"></input-related-item>
        </div>
    </div>

    <div class="uk-margin">
        <sb-fields :config="$options.fields" :values.sync="field.data"></sb-fields>
    </div>

</template>

<script>

    module.exports = {

        fields: {
            'checkbox_label_pre': {
                type: 'text',
                label: 'Checkbox label before link',
                attrs: {'class': 'uk-form-width-medium'}
            },
            'checkbox_label_link': {
                type: 'text',
                label: 'Checkbox label link',
                attrs: {'class': 'uk-form-width-medium'}
            },
            'checkbox_label_post': {
                type: 'text',
                label: 'Checkbox label after link',
                attrs: {'class': 'uk-form-width-medium'}
            },
        },



    };

</script>
