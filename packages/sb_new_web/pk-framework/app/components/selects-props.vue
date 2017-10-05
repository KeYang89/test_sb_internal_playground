<template>

    <div class="uk-form">

        <div v-for="prop in props" v-bind="attrs">

            <label class="uk-form-label">{{ prop.label }}</label>

            <div class="uk-form-controls">
                <select v-model="selected[prop.name]" v-bind="inputAttrs" @change="setValue(prop)">
                    <option v-for="option in prop.options" :value="option.value">{{ option.text }}</option>
                </select>
            </div>

        </div>

    </div>

</template>

<script>
    var md5 = require('md5');

    module.exports = {

        props: {
            props: [Array,Object],
            values: [Array,Object],
            hash: {type: String, default: ''},
            attrs: {type: Object, default: () => {return{};}},
            inputAttrs: {type: Object, default: () => {return{class: 'uk-form-width-medium'};}}
        },

        data() {
            return {
                selected: {}
            };
        },

        created() {
            if (!_.isArray(this.props)) {
                this.props = [];
            }
            if (!_.isObject(this.values)) {
                this.values = {};
            }
            this.props.forEach(prop => {
                this.values[prop.name] = _.defaults((this.values[prop.name] || {}), {
                    option: (_.first(prop.options) || {value: ''}),
                    prop
                });
                this.selected[prop.name] = this.values[prop.name].option.value;
            });
            this.setHash();
        },

        methods: {
            setValue(prop) {
                var value = this.selected[prop.name];
                this.values[prop.name].option = _.find(prop.options, {value});
                this.setHash();
            },
            setHash() {
                this.hash = md5(JSON.stringify(this.selected));
            }
        }


    };

</script>
