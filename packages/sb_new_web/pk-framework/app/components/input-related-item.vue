<template>

    <div>
        <div v-show="selected_identifier" class="uk-badge uk-flex uk-flex-middle">
            <em class="uk-text-small uk-margin-small-right">{{ selected_identifier }}</em>
            <span class="uk-flex-item-1 uk-text-left">{{ selected_name }} </span>
            <small v-if="extra_key" class="uk-margin-small-left">({{ selected_extra_key }})</small>
            <a @click="remove" class="uk-close uk-margin-small-left"></a>
        </div>

        <p>
            <button type="button" class="uk-button" :class="buttonClass" @click="pick">{{ buttonText | trans }}</button>
        </p>

        <v-modal v-ref:modal large>

            <table-list v-ref:table-list
                        :resource="resource"
                        :config="config"
                        :name="name"
                        :excluded="excluded"
                        :label="label"
                        :extra_key="extra_key"
                        :identifier="identifier"></table-list>

            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-link uk-modal-close" type="button">{{ 'Cancel' | trans }}</button>
                <button class="uk-button uk-button-primary" type="button" :disabled="!hasSelection()" @click="select()">
                    {{ 'Select' | trans }}
                </button>
            </div>

        </v-modal>
    </div>


</template>

<script>

    module.exports = {

        name: 'input-related-item',

        props: {
            'model': {default: ''},
            'selected': {type: Object, default: function () {return {}}},
            'resource': {type: String, default: ''},
            'config': {type: Object, default: function () {return {filter: {search: '', order: 'title asc'}}}},
            'name': {type: String, default: 'items'},
            'identifier': {type: String, default: 'id'},
            'label': {type: String, default: 'title'},
            'buttonClass': {type: String, default: 'uk-button-small'},
            'buttonText': {type: String, default: 'Please select'},
            'extra_key': {type: String, default: 'slug'},
            'onSelect': {type: Function, default: function () {_.noop()}},
            'onRemove': {type: Function, default: function () {_.noop()}}
        },

        computed: {
            selected_identifier: function () {
                return this.selected ? this.selected[this.identifier] : '';
            },
            selected_name: function () {
                return this.selected ? this.selected[this.label] : '';
            },
            selected_extra_key: function () {
                return this.selected ? this.selected[this.extra_key] : '';
            },
            excluded: function () {
                return [this.selected_identifier];
            }
        },

        methods: {

            pick: function () {
                this.$refs.modal.open();
            },

            select: function() {
                this.selected = _.first(this.$refs.tableList.getSelected());
                this.model = this.selected[this.identifier];
                this.onSelect(this.selected);
                this.$refs.modal.close();
            },

            remove: function() {
                this.selected = {};
                this.model = '';
                this.onRemove();
            },

            hasSelection: function () {
                return this.$refs.tableList.nrSelected() == 1;
            },

            isSelected: function (item) {
                return this.selected === item;
            }

        }

    };

</script>
