<template>

    <div :class="classes(['uk-form-row'], field.data.classSfx)">
        <style>.pac-container{z-index: 99999;}</style>
        <span class="uk-form-label" v-show="!field.data.hide_label">{{ fieldLabel | trans }}
            <a v-if="field.data.help_text && field.data.help_show == 'tooltip_icon'"
               class="uk-icon-info uk-icon-hover uk-margin-small-top uk-float-right"
               :title="field.data.help_text" data-uk-tooltip="{delay: 100}"></a>
        </span>

        <div class="uk-form-controls uk-form-controls-text">

            <p class="uk-form-help-block uk-text-danger" v-show="fieldInvalid(form)">{{ fieldRequiredMessage }}</p>

            <div v-el:control class="uk-width-2-3 uk-margin-small-top uk-position-relative">
                <input type="text" v-el:search
                       v-model="inputValue"
                       :id="fieldid" :name="fieldid"
                       class="uk-form-large uk-width-1-1"
                       v-validate:required="fieldRequired">
                <a class="uk-close uk-close-alt uk-position-top-right" style="top:13px;right:13px"
                   @click="clearLocation" :title="$trans('Clear')"></a>
            </div>
            <div v-el:map :style="minHeight" class="uk-cover uk-position-relative"></div>
        </div>

    </div>

</template>

<script>

    var GmapsMixin = require('../../app/mixins/gmaps');

    module.exports = {

        mixins: [SBFieldtypeMixin, GmapsMixin],

        settings: {
        },

        appearance: {
            'minHeight': {
                type: 'number',
                label: 'Minimum height map',
                attrs: {'class': 'uk-form-width-small uk-text-right', 'min': 0}
            },
            'default_lat': {
                type: 'number',
                label: 'Default latitude for map',
                attrs: {'class': 'uk-form-width-small uk-text-right', 'min': 0, 'step': 0.0001}
            },
            'default_lng': {
                type: 'number',
                label: 'Default longitude for map',
                attrs: {'class': 'uk-form-width-small uk-text-right', 'min': 0, 'step': 0.0001}
            },
            'default_zoom': {
                type: 'number',
                label: 'Default zoom for map',
                attrs: {'class': 'uk-form-width-small uk-text-right', 'min': 0, 'max': 18}
            },
        },

        data() {
            return {
                fieldid: _.uniqueId('sbfieldtype_'),
                inited: false,
            };
        },

        events: {
            'google.map.ready': 'initMap',
        },

        computed: {
            minHeight() {
                return `min-height: ${this.field.data.minHeight || 500}px`;
            },
        },

        methods: {
            initMap() {
                var map = new google.maps.Map(this.$els.map, {
                    center: {
                        lat: this.field.data.default_lat || 20,
                        lng: this.field.data.default_lng || 0
                    },
                    zoom: this.field.data.default_zoom || 2
                });

                map.controls[google.maps.ControlPosition.TOP_LEFT].push(this.$els.control);

                var autocomplete = new google.maps.places.Autocomplete(this.$els.search);
                autocomplete.bindTo('bounds', map);

                var infowindow = new google.maps.InfoWindow();
                var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, 0)
                });

                if (this.valuedata.length && this.valuedata[0].lat && this.valuedata[0].lng) {
                    map.setCenter({
                        lat: this.valuedata[0].lat,
                        lng: this.valuedata[0].lng
                    });
                    map.setZoom(15);
                }

                autocomplete.addListener('place_changed',() => {
                    infowindow.close();
                    marker.setVisible(false);
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        this.$notify(`No details available for input: '${place.name}'`);
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);
                    }
                    marker.setIcon(/** @type {google.maps.Icon} */({
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(35, 35)
                    }));
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                    var address = '';
                    if (place.address_components) {
                        address = [
                            (place.address_components[0] && place.address_components[0].short_name || ''),
                            (place.address_components[1] && place.address_components[1].short_name || ''),
                            (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                    }

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                    infowindow.open(map, marker);
                    this.setLocation(place);
                });
                this.inited = true;
            },

            clearLocation() {
                this.removeValue();
                this.inputValue = '';
                this.$dispatch('gmaps.location.picked', '');
            },

            setLocation(place) {
                this.removeValue();
                this.inputValue = place.formatted_address;
                this.addValue(place.formatted_address, {
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng()
                });
                this.$dispatch('gmaps.location.picked', place.formatted_address);
            },
        },

    };

</script>
