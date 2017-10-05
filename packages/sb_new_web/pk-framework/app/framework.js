
if (window.Vue) {
    //components
    Vue.component('input-category', require('./components/input-category.vue'));
    Vue.component('input-tags', require('./components/input-tags.vue'));
    Vue.component('input-folder', require('./components/input-folder.vue'));
    Vue.component('input-multiselect', require('./components/input-multiselect.vue'));
    Vue.component('input-props', require('./components/input-props.vue'));
    Vue.component('selects-props', require('./components/selects-props.vue'));
    Vue.component('input-prices', require('./components/input-prices.vue'));
    Vue.component('input-related-item', require('./components/input-related-item.vue'));
    Vue.component('input-related-items', require('./components/input-related-items.vue'));
    Vue.component('table-list', require('./components/table-list.vue'));
    Vue.component('email-communication', require('./components/email-communication.vue'));
    require('./components/input-file.vue');
    //directives
    Vue.directive('spinner', require('./directives/spinner'));
    //partials
    Vue.partial('fieldtype-basic', require('./templates/fieldtype-basic.html'));
    Vue.partial('fieldtype-settings', require('./templates/fieldtype-settings.html'));
    Vue.partial('fieldtype-appearance', require('./templates/fieldtype-appearance.html'));
    //libs
    require('./lib/props')(Vue);
    //fields
    require('./form-fields/fields');

}
