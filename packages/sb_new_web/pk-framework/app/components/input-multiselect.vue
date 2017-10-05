<template>

    <ul class="uk-nav uk-nav-side">
        <li v-for="value in selectOptions" @click.prevent="toggle(value)"
            :class="{'uk-active': isSelected(value)}">
            <a href="#" class="uk-flex uk-flex-middle uk-flex-space-between">
                 <span>{{ $key }}</span>
                 <i class="uk-float-right"
                   :class="{'uk-icon-check': isSelected(value), 'uk-icon-ban': !isSelected(value)}"></i>
           </a>
        </li>
    </ul>


</template>

<script>

    module.exports = {

        props: {
            'value': Array,
            'options': [Array, Object]
        },

        data() {
            return {
                selected: []
            }
        },

        created() {
            this.selected = this.value;
            this.$watch('selected', this.setValue);
        },

        computed: {
            selectOptions() {
                if (_.isArray(this.options)) {
                    var options = {};
                    this.options.forEach(option => {
                        options[option.text] = option.value
                    });
                    return options;
                }
                return this.options;
            }
        },

        methods: {

            toggle(value) {
                if (this.isSelected(value)) {
                    this.selected.$remove(value);
                } else {
                    this.selected.push(value);
                }
            },

            isSelected(value) {
                return this.selected.indexOf(value) > -1;
            },

            setValue() {
                this.value = [];
                //keep values in order
                _.forIn(this.selectOptions, (value) => {
                    if (this.isSelected(value)) {
                        this.value.push(value);
                    }
                });
            }

        }

    };

</script>
