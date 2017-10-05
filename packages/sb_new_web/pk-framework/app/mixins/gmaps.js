module.exports = {

    created: function () {
        var apikey, loaders = window.googleMapsLoaders || [];
        if (!loaders.length) {
            window.googleMapsLoaders = loaders;
            apikey = window.$pkframework.google_maps_key;
            loaders.push(this);
            this.$asset({
                js: ['https://www.google.com/jsapi']
            }).then(() => {
                window.google.load("maps", "3", {other_params: 'libraries=places&key=' + apikey, callback: () => {
                    if (window.google && window.google.maps) {
                        loaders.forEach(vm =>vm.$root.$broadcast('google.map.ready', window.google));
                    }
                }});

            });
        } else {
            loaders.push(this);
        }

    }

};