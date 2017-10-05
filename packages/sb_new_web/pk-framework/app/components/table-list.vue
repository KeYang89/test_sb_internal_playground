<template>

    <div>
        <div class="uk-form uk-form-icon">
            <i class="uk-icon-search"></i>
            <input type="search" v-model="config.filter.search" :placeholder="'Search' | trans" debounce="300">
        </div>

        <div class="uk-margin uk-overflow-container">
            <table class="uk-table uk-table-hover uk-table-middle uk-form">
                <thead>
                <tr>
                    <th class="pk-table-width-minimum"><input type="checkbox" v-check-all:selected.literal="input[name=id]"></th>
                    <th class="pk-table-min-width-100">{{ 'ID' | trans }}</th>
                    <th class="pk-table-min-width-200">{{ 'Name' | trans }}</th>
                    <th v-if="extra_key" class="pk-table-min-width-100">{{ 'Extra' | trans }}</th>
                </tr>
                </thead>
                <tbody>
                <tr class="check-item" v-for="item in items" :class="{'uk-active': active(item)}">
                    <td><input type="checkbox" name="id" :value="getIdentifier(item)" :disabled="disabled(item)"></td>
                    <td>{{ getIdentifier(item) }}</td>
                    <td>
                        <span v-if="disabled(item)" class="uk-text-muted">{{ getLabel(item) }}</span>
                        <a v-else @click="select(item)">{{ getLabel(item) }}</a>
                    </td>
                    <td v-if="extra_key">{{ getExtraKey(item) }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <h3  v-show="items && !items.length"class="uk-text-muted uk-text-center">{{ 'No items found.' | trans }}</h3>

        <v-pagination :page.sync="config.page" :pages="pages" v-show="pages > 1" :replace-history="false"></v-pagination>

    </div>

</template>

<script>

    module.exports = {

        name: 'table-list',

        props: {
            'config': {type: Object, default: function () {
                return {filter: {search: '', order: 'title asc'}};
            }},
            'resource': {type: String, default: ''},
            'excluded': {type: Array, default: function () {return [];}},
            'identifier': {type: String, default: 'id'},
            'name': {type: String, default: 'items'},
            'extra_key': {type: String, default: 'slug'},
            'limit': {type: Number, default: 10},
            'label': {type: String, default: 'title'}
        },

        data: function () {
            return {
                items: false,
                pages: 0,
                count: '',
                selected: []
            }
        },

        created: function () {
            this.Resource = this.$resource(this.resource);
            this.config.filter.limit = this.limit;
            this.$watch('config.page', this.load, {immediate: true});
        },

        watch: {

            'config.filter': {
                handler: function (filter) {
                    if (this.config.page) {
                        this.config.page = 0;
                    } else {
                        this.load();
                    }
                },
                deep: true
            }

        },

        methods: {
            active: function (item) {
                return this.selected.indexOf(String(item[this.identifier])) != -1;
            },

            disabled: function (item) {
                return this.excluded.indexOf(item[this.identifier]) != -1;
            },

            load: function () {
                this.Resource.query(this.config).then( function (res) {
                    var data = res.data;

                    this.$set('items', this.name ? data[this.name] : data);
                    this.$set('pages', data.pages);
                    this.$set('count', data.count);
                    this.$set('selected', []);
                }, function () {
                    this.$notify('Loading failed.', 'danger');
                });
            },

            select: function (item) {
                var identifier = String(item[this.identifier]);
                if (this.selected.indexOf(identifier) === -1) {
                    this.selected.push(identifier)
                }
            },

            getLabel: function (item) {
                return item[this.label] || '';
            },

            getIdentifier: function (item) {
                return String(item[this.identifier]) || '';
            },

            getExtraKey: function (item) {
                if (!this.extra_key) return '';
                return item[this.extra_key] || '';
            },

            nrSelected: function () {
                return this.selected.length;
            },

            getSelected: function () {
                return this.items.filter(function (item) {
                    return this.selected.indexOf(String(item[this.identifier])) !== -1;
                }, this);
            }

        }
    };

</script>
