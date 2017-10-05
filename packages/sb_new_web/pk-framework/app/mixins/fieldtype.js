module.exports = {

    props: ['isAdmin', 'field', 'model', 'form'],

    data: function () {
        return {
            inputValue: ''
        };
    },

    created: function () {
        this.inputValue = this.fieldMultiple ? this.fieldValue.value : String(this.fieldValue.value);
        if (!this.fieldValue.data || this.fieldValue.data.length === 0) {
            this.fieldValue.data = {}; //fix datatype
        }
    },

    methods: {
        fieldInvalid: function (form, idx) {
            idx = idx !== undefined ? idx : '';
            return form && form[this.fieldid + idx] ? form[this.fieldid + idx].invalid : false;
        },
        classes: function (classes_array, classes_string) {
            return (classes_array || []).concat(String(classes_string || '').split(' '));
        },
        addValue: function (value, valuedata) {
            this.fieldValue.value.push(value);
            this.$set('fieldValue.data.data' + (this.fieldValue.value.length - 1), valuedata || {'value': value});
        },
        removeValue: function (value) {
            var data = {};
            if (value) {
                this.fieldValue.value.$remove(value);
                this.fieldValue.value.forEach(function (value, idx) {
                    data['data' + idx] = this.getValuedata(value);
                }.bind(this));
            } else {
                this.fieldValue.value = [];
            }
            this.fieldValue.data = data;
        },
        valuedataModel: function (idx) {
            return this.fieldValue.data['data' + idx] || {'value': this.fieldValue.value[idx] || ''};
        },
        getValuedata: function (value) {
            return _.find(this.fieldValue.data, 'value', value) || {'value': value};
        }

    },

    computed: {
        fieldValue: function () {
            if (this.isAdmin) {
                return this.field.data;
            }
            return this.model[this.field.slug];
        },
        valuedata: function () {
            if (this.fieldValue.value.length) {
                return this.fieldValue.value.map(function (value, idx) {
                    return _.assign({'value': value}, this.fieldValue.data['data' + idx]);
                }.bind(this));
            }
            return [];
        },
        allowNewValue: function () {
            return this.field.data.repeatable && this.fieldValue.value.length < (this.field.data.max_repeat || 10);
        },
        fieldMultiple: function () {
            return !!this.field.data.multiple;
        },
        fieldRequired: function () {
            return !!(this.field.data.required && !this.isAdmin);
        },
        fieldRequiredMessage: function () {
            return this.field.data.requiredError || this.$trans('Please enter a value');
        },
        fieldLabel: function () {
            return this.isAdmin ? this.$trans('Default value') : this.field.label;
        }
    },

    watch: {
        'inputValue': function (value) {
            this.fieldValue.value = this.fieldMultiple ? value : [value];
        }
    }

};