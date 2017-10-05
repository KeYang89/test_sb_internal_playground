<template>

    <div>
        <div class="uk-grid">
            <div v-for="item in selected" class="uk-width-1-1">
                <div class="uk-badge uk-flex uk-flex-middle uk-margin-small-bottom"
                     track-by="$index">
                    <em class="uk-text-small uk-margin-small-right">{{ getIdentifier(item) }}</em>
                    <span class="uk-flex-item-1 uk-text-left">{{ getLabel(item) }} </span>
                    <small v-if="extra_key" class="uk-margin-small-left">({{ getExtraKey(item) }})</small>
                    <a @click="remove(item)" class="uk-close uk-margin-small-left"></a>
                </div>
            </div>
        </div>

        <p>
            <button type="button" class="uk-button uk-button-small" @click="pick">{{ 'Please select' | trans }}</button>
        </p>

        <v-modal v-ref:modal large>

            <table-list v-ref:table-list
                        :resource="resource"
                        :config="config"
                        :excluded="model"
                        :name="name"
                        :extra_key="extra_key"
                        :label="label"
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

        name: 'input-related-items',

        props: {
            'model': {type: Array, default: function () {return []}},
            'selected': {type: Array, default: function () {return {}}},
            'resource': {type: String, default: ''},
            'config': {type: Object, default: function () {return {filter: {search: '', order: 'title asc'}}}},
            'name': {type: String, default: 'items'},
            'identifier': {type: String, default: 'id'},
            'label': {type: String, default: 'title'},
            'extra_key': {type: String, default: 'slug'},
            'onSelect': {type: Function, default: function () {_.noop()}},
            'onRemove': {type: Function, default: function () {_.noop()}}
        },

        watch: {
            selected: function (items) {
                this.model = _.map(items, function (item) {
                    return this.getIdentifier(item);
                }, this);
            }
        },

        methods: {

            pick: function () {
                this.$refs.modal.open();
            },

            select: function() {
                var selected = _.filter(this.$refs.tableList.getSelected(), function (item) {
                    return _.find(this.selected, this.identifier, this.getIdentifier(item)) === undefined;
                }, this);
                this.selected = this.selected.concat(selected);
                this.onSelect(selected);
                this.$refs.modal.close();
            },

            remove: function(item) {
                this.selected.$remove(item);
                this.onRemove(item);
            },

            getIdentifier: function (item) {
                return item[this.identifier] || ''; //todo Vue warn?
            },

            getLabel: function (item) {
                return item[this.label] || '';
            },

            getExtraKey: function (item) {
                if (!this.extra_key) return '';
                return item[this.extra_key] || '';
            },

            hasSelection: function () {
                return this.$refs.tableList.nrSelected() > 0;
            },

            isSelected: function (item) {
                return this.selected === item;
            }

        }
    };

</script>