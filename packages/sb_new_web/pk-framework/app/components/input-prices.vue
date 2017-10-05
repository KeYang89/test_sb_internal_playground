<template>

    <div class="uk-form uk-form-stacked">

        <ul class="uk-list uk-list-line">
            <li v-for="price in price_collection.prices">
                <div class="uk-flex uk-flex-middle">
                    <div class="uk-width-1-5">
                        <label class="uk-form-label">{{ 'Minimum quantity' | trans }}</label>
                        <div class="uk-form-controls">
                            <input v-model="price.min_quantity" type="number" class="uk-width-8-10 uk-text-right"
                                   step="1" min="0" number/>
                        </div>
                    </div>
                    <div class="uk-width-1-5">
                        <label class="uk-form-label">{{ 'Maximum quantity' | trans }}</label>
                        <div class="uk-form-controls">
                            <input v-model="price.max_quantity" type="number" class="uk-width-8-10 uk-text-right"
                                   step="1" min="0" number/>
                        </div>
                    </div>
                    <div class="uk-width-1-5">
                        <label class="uk-form-label">{{ 'Currency' | trans }}</label>
                        <div class="uk-form-controls">
                            <select v-model="price.currency">
                                <option value="EUR">{{ 'Euro' | trans }}</option>
                                <option value="USD">{{ 'US Dollar' | trans }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-flex-item-1">
                        <label class="uk-form-label">{{ 'Price' | trans }}</label>
                        <div class="uk-form-controls">
                            <i class="uk-icon-euro uk-margin-small-right"></i>
                            <input v-model="price.price" type="number" class="uk-width-8-10 uk-text-right"
                                   step="0.001" min="0" number/>
                        </div>
                    </div>
                    <ul class="uk-subnav pk-subnav-icon uk-margin-small-left">
                        <li><a class="pk-icon-delete pk-icon-hover"  @click="remove(price)"
                               :title="'Delete' | trans" data-uk-tooltip="{delay: 500}"></a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <a v-if="!readonly" @click="add"><i class="uk-icon-plus uk-margin-small-right"></i>{{ 'Add price' | trans }}</a>

    </div>

</template>

<script>

    module.exports = {

        props: {
            price_collection: [Object],
            readonly: Boolean
        },

        created() {
            console.log(this.price_collection.prices);
        },

        methods: {

            add() {
                this.price_collection.prices.push({
                    min_quantity: 1,
                    max_quantity: 1,
                    price: 0,
                    currency: 'EUR'
                });
            },
            remove(price) {
                this.price_collection.prices.$remove(price);
            }

        }

    };

</script>
