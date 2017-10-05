<template>

    <div class="uk-form uk-form-horizontal">

        <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
            <div data-uk-margin>

                <h2 class="uk-margin-remove">{{ 'SB Framework Settings' | trans }}</h2>

            </div>
            <div data-uk-margin>

                <button class="uk-button uk-button-primary" @click="save(package.config)">{{ 'Save' | trans }}</button>

            </div>
        </div>

        <div class="uk-form uk-form-stacked">
            <div class="uk-form-row">
                <label for="form-pkframework-settings-google_maps_key"
                       class="uk-form-label">{{ 'Google maps API key' | trans }}</label>

                <div class="uk-form-controls">
                    <input id="form-pkframework-settings-google_maps_key" class="uk-width-1-1" type="text"
                           name="google_maps_key"
                           v-model="package.config.google_maps_key">

                    <p class="uk-form-help-block">{{{ googleHelp }}}</p>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-pkframework-settings-image_cache_path"
                       class="uk-form-label">{{ 'Image caching folder' | trans }}</label>

                <div class="uk-form-controls">
                    <input id="form-pkframework-settings-image_cache_path" class="uk-width-1-1" type="text"
                           name="image_cache_path"
                           v-model="package.config.image_cache_path">
                </div>
            </div>


        </div>

    </div>

</template>

<script>

    module.exports = {

        props: ['package'],

        settings: true,

        computed: {
            googleHelp() {
                return this.$trans('Get your Google Maps Javascript API key at %link%.', {
                    'link': '<a href="https://developers.google.com/maps/web/" target="_blank">Google Developers</a>'
                });
            }
        },

        methods: {

            save(config) {
                this.$http.post('admin/system/settings/config', {name: 'sb/pk-framework', config})
                    .then(() => this.$notify('Settings saved.', ''), res => this.$notify(res.data, 'danger'))
                    .finally(() => this.$parent.close());
            }

        },

    };

    window.Extensions.components['settings-SB'] = module.exports;

</script>
