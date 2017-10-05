<template>

    <div>
        <div class="uk-flex uk-flex-middle uk-flex-wrap uk-flex-space-between" data-uk-margin>
            <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>
                <div class="uk-margin-right" v-show="selected.length">
                    <a class="uk-icon-trash-o uk-icon-hover" title="{{ 'Delete' | trans }}"
                       data-uk-tooltip="{delay: 500}" @click.prevent="remove"
                       v-confirm="'Delete logs?' | trans"></a>
                </div>
                <div class="uk-form uk-form-icon">
                    <i class="uk-icon-search"></i>
                    <input type="search" v-model="config.filter.search" :placeholder="'Search' | trans"
                           debounce="300">
                </div>
            </div>
        </div>

        <div class="uk-margin uk-overflow-container">
            <table class="uk-table uk-table-hover uk-table-middle uk-form">
                <thead>
                <tr>
                    <th v-if="!readonly" class="pk-table-width-minimum"><input type="checkbox" v-check-all:selected.literal="input[name=id]" number></th>
                    <th class="pk-table-max-width-100" v-order:sent="config.filter.order">{{ 'Sent' | trans }}</th>
                    <th class="pk-table-max-width-150">{{ 'Subject' | trans }}</th>
                    <th class="pk-table-max-width-150">{{ 'Content' | trans }}</th>
                </tr>
                </thead>
                <tbody>
                <tr class="check-item" v-for="log in logs" :class="{'uk-active': active(log)}">
                    <td v-if="!readonly"><input type="checkbox" name="id" value="{{ log.id }}" number></td>
                    <td>
                        <a @click="select(log)">{{ log.sent | date 'medium' }}</a>
                    </td>
                    <td class="pk-table-max-width-150">
                        <div class="uk-text-truncate">{{ log.subject  }}</div>
                    </td>
                    <td class="pk-table-max-width-150">
                        <div class="uk-text-truncate" :title="cleanHtml(log.content)">{{ cleanHtml(log.content, 100) }}</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <h3 class="uk-text-muted uk-text-center"
            v-show="!loading && !logs.length">{{ 'No logs found.' | trans }}</h3>

        <v-pagination :page.sync="config.page" :pages="pages" v-show="pages > 1"></v-pagination>

        <v-modal v-ref:editmodal large>
            <div class="uk-modal-header">
                <h3>{{ 'View log' | trans }}</h3>
            </div>
            <div class="uk-margin">
                <dl class="uk-description-list-horizontal">
                    <dt>{{ 'To' | trans }}</dt>
                    <dd>{{ edit_log.recipients }}</dd>
                    <dt>{{ 'CC' | trans }}</dt>
                    <dd>{{ edit_log.cc }}</dd>
                    <dt>{{ 'BCC' | trans }}</dt>
                    <dd>{{ edit_log.bcc }}</dd>
                    <dt>{{ 'Subject' | trans }}</dt>
                    <dd>{{ edit_log.subject }}</dd>
                    <dt>{{ 'Content' | trans }}</dt>
                    <dd>{{{ edit_log.content }}}</dd>
                    <template v-if="edit_log.data.attachments">
                        <dt>{{ 'Attachments' | trans }}</dt>
                        <dd v-for="attachment in edit_log.data.attachments">{{ attachment }}</dd>
                    </template>
                </dl>

            </div>
            <div class="uk-modal-footer uk-text-right">
                <button @click="cancel" class="uk-button uk-margin-small-right">{{ 'Close' | trans }}</button>
            </div>

        </v-modal>
    </div>

</template>

<script>

    module.exports = {

        name: 'mail-log',

        props: ['ext_key'],

        data() {
            return {
                edit_log: {},
                logs: [],
                pages: 0,
                count: '',
                selected: [],
                loading: false,
                saving: false,
                config: {filter: {search: '', ext_key: this.ext_key, order: 'sent desc'}},
                tfhConfig: _.merge({}, window.$data.tfhConfig),
                editlogform: {}
            }
        },

        created() {
            this.resource = this.$resource('api/emailsender/log{/id}');
            this.$watch('config.page', this.load, {immediate: true});
        },

        watch: {
            'config.filter': {
                handler: function (filter) {
                    if (this.config.page) {
                        this.config.page = 0;
                    } else {
                        this.load();
                    }
                },
                deep: true
            }
        },

        methods: {
            active(log) {
                return this.selected.indexOf(log.id) != -1;
            },
            select(log) {
                if (_.isFunction(this.selectlog)) {
                    this.selectlog(log);
                } else {
                    this.open(log);
                }
            },
            open(log) {
                this.edit_log = log;
                this.$refs.editmodal.open();
            },
            remove() {
                this.resource.delete({id: 'bulk'}, {ids: this.selected}).then(() => {
                    this.load();
                    this.$notify('Logs deleted.', 'success');
                }, res => {
                    this.load();
                    this.$notify(res.data, 'danger');
                });
            },
            load() {
                this.loading = true;
                this.resource.query({filter: this.config.filter, page: this.config.page}).then(res => {
                    var data = res.data;
                    this.$set('logs', data.logs);
                    this.$set('pages', data.pages);
                    this.$set('count', data.count);
                    this.$set('selected', []);
                    this.loading = false;
                }, () => {
                    this.$notify('Loading failed.', 'danger');
                    this.loading = false;
                });
            },
            cancel() {
                this.$refs.editmodal.close();
                this.edit_log = {};
            },
            getSelected() {
                return this.logs.filter(log => this.selected.indexOf(log.id) !== -1);
            },
            cleanHtml(string, length) {
                var div = document.createElement("div");
                div.innerHTML = string;
                var text = (div.textContent || div.innerText || "");
                return length ? text.substr(0, length) : text;
            },
        }
    };

</script>
