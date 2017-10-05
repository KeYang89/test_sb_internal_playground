<template>

    <div class="uk-form uk-form-stacked">

        <ul class="uk-list uk-list-line">
            <li v-for="prop in props">

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3">
                        <div class="uk-form-row">
                            <label class="uk-form-label">{{ 'Name' | trans }}</label>
                            <div class="uk-form-conrols uk-flex uk-flex-middle">
                                <input type="text" v-model="prop.name" class="uk-flex-item-1"/>
                                <ul class="uk-subnav pk-subnav-icon uk-margin-small-left">
                                    <li><a class="pk-icon-delete pk-icon-hover"  @click="remove(prop)"
                                           :title="'Delete' | trans" data-uk-tooltip="{delay: 500}"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">{{ 'Label' | trans }}</label>
                            <div class="uk-form-conrols">
                                <input type="text" v-model="prop.label" class="uk-width-1-1"/>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label class="uk-form-label">{{ 'Ordering' | trans }}</label>
                            <div class="uk-form-conrols">
                                <input type="number" v-model="prop.ordering"
                                              class="uk-form-width-small uk-text-right" number/>
                            </div>
                        </div>
                        <sb-fields :config="$options.fields" :values.sync="prop.config"></sb-fields>
                    </div>
                    <div class="uk-width-medium-2-3">
                        <div class="uk-form-row">
                            <label class="uk-form-label">{{ 'Options' | trans }}</label>
                            <div class="uk-form-conrols">
                                <select-option v-for="option in prop.options" class="uk-margin"
                                               :selectoption.sync="option"
                                               :prop="prop"
                                               :read-only="readOnly"></select-option>
                                <a v-if="!readonly" @click="addOption(prop)">
                                    <i class="uk-icon-plus uk-margin-small-right"></i>{{ 'Add option' | trans }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
        </ul>

        <a v-if="!readonly" @click="add"><i class="uk-icon-plus uk-margin-small-right"></i>{{ 'Add property' | trans }}</a>

    </div>

</template>

<script>

    module.exports = {

        props: {
            props: [Array,Object],
            readonly: Boolean
        },

        created() {
            if (!_.isArray(this.props)) {
                this.props = [];
            }
        },

        methods: {

            add() {
                this.props.push({
                    name: '',
                    label: '',
                    options: [],
                    config: {
                        price_prop: true
                    },
                    ordering: (this.props.length + 1)
                });
            },
            remove(prop) {
                this.props.$remove(prop);
            },
            addOption(prop) {
                prop.options.push({
                    value: '',
                    text: '',
                    attachValue: true,
                    invalid: false
                });
                this.$nextTick(() => $(this.$el).find('input:last:visible').focus());
            },
            deleteOption(prop, option) {
                prop.options.$remove(option);
                this.checkDuplicates(prop);
            },
            checkDuplicates(prop) {
                var current, dups = [];
                _.sortBy(prop.options, 'value').forEach(option => {
                    if (current && current === option.value) {
                        dups.push(option.value);
                    }
                    current = option.value;
                });
                prop.options.forEach(option => option.invalid = dups.indexOf(option.value) > -1 ? 'Duplicate value' : false);
            }


        },

        fields: {
            'price_prop': {
                type: 'checkbox',
                label: 'Price property',
                optionlabel: 'This property changes the price',
            }
        },

        components: {

            'select-option': {

                template: '<div>\n    <div v-if="!readOnly" class="uk-visible-hover uk-form uk-flex uk-flex-middle">\n        <div class="uk-flex-item-1">\n            <div class="uk-grid uk-grid-small">\n                <div class="uk-width-2-6">\n                    <small class="uk-form-label uk-text-muted uk-text-truncate" style="text-transform: none"\n                           v-show="selectoption.attachValue"\n                           :class="{\'uk-text-danger\': selectoption.invalid}">{{ selectoption.value }}</small>\n                    <span class="uk-form-label" v-show="!selectoption.attachValue">\n                    <input type="text" class="uk-form-small"\n                           @keyup="safeValue(true)"\n                           :class="{\'uk-text-danger\': selectoption.invalid}"\n                           v-model="selectoption.value"/></span>\n                </div>\n                <div class="uk-width-3-6">\n                    <div class="uk-form-controls">\n                        <input type="text" class="uk-form-width-large" v-model="selectoption.text"/>\n                    </div>\n                    <p class="uk-form-help-block uk-text-danger" v-show="selectoption.invalid">{{ selectoption.invalid | trans }}</p>\n                </div>\n                <div class="uk-width-1-6 uk-flex-center">\n                    <ul class="uk-subnav pk-subnav-icon">\n                        <li><a class="uk-icon uk-margin-small-top pk-icon-hover uk-invisible"\n                               data-uk-tooltip="{delay: 500}" :title="\'Link/Unlink value from label\' | trans"\n                               :class="{\'uk-icon-link\': !selectoption.attachValue, \'uk-icon-chain-broken\': selectoption.attachValue}"\n                               @click.prevent="selectoption.attachValue = !selectoption.attachValue"></a></li>\n                        <li><a class="pk-icon-delete pk-icon-hover uk-invisible" @click="$parent.deleteOption(prop, selectoption)"></a></li>\n                    </ul>\n                </div>\n            </div>\n        </div>\n    </div>\n    <div v-else>\n        {{ selectoption.text }}\n    </div>\n</div>   \n',

                props: ['selectoption', 'prop', 'readOnly'],

                methods: {
                    safeValue(checkDups) {
                        this.selectoption.value = _.escape(_.snakeCase(this.selectoption.value));
                        if (checkDups) {
                            this.$parent.checkDuplicates();
                        }
                    }
                },

                watch: {
                    "selectoption.text": function (value) {
                        if (this.selectoption.attachValue) {
                            this.selectoption.value = _.escape(_.snakeCase(value));
                        }
                        this.$parent.checkDuplicates(this.prop);
                    }

                }
            }

        }


    };

</script>
