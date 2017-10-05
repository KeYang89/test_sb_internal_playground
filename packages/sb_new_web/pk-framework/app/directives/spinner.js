module.exports = {

    params: ['icon', 'spinner'],

    bind: function () {
        var base = this.el.className || 'uk-margin-small-right';
        this.iconClass = base + ' uk-icon-justify uk-icon-' + this.params.icon;
        this.spinningClass = base + ' uk-icon-spin uk-icon-justify uk-icon-' + (this.params.spinner || 'circle-o-notch');

    },

    update: function (value) {
        this.el.className = value ? this.spinningClass : this.iconClass;
    }

};
