

module.exports = function (Vue) {

    Vue.filter('propsToString', props => {
        var values = [];
        _.forIn(props, propValue => {
            values.push(`${propValue.prop.label}: ${propValue.option.text}`);
        });
        return values.join(', ');
    });

};
