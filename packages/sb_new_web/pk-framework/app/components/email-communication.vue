<template>

    <div class="uk-form">

        <div class="uk-panel uk-panel-box uk-panel-box-primary">

            <h3>{{ 'Create email' | trans }}</h3>

            <div class="uk-form-row">
                <label for="form-template" class="uk-form-label">{{ 'Template' | trans }}</label>
                <div class="uk-form-controls uk-flex">
                    <select id="form-template" class="uk-flex-item-1" v-model="template">
                        <option value="">{{ 'Select template' | trans }}</option>
                        <option v-for="template in templates" :value="template.type">{{
                            template.emailtype.label }}
                        </option>
                    </select>
                    <button @click="mailTemplate(template)" type="button"
                            class="uk-button uk-margin-small-left" :disabled="!template">
                        <i v-spinner="searching" icon="magic"></i>
                        {{ 'Create mail' | trans }}
                    </button>
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <h3>{{ 'Communication log' | trans }}</h3>

            <email-logs v-ref:maillog :ext_key="ext_key"></email-logs>
        </div>

        <v-modal v-ref:mailmodal>
            <div class="uk-modal-header">
                <h3>{{ 'Send email' | trans }}</h3>
            </div>
            <email-modal :type="template"
                        :ext_key="ext_key"
                        :to="mail_data.to"
                        :cc="mail_data.cc"
                        :bcc="mail_data.bcc"
                        :subject="mail_data.subject"
                        :content="mail_data.content"
                        :attachments="attachments"
                        :send-action="sendMail"></email-modal>
        </v-modal>

    </div>


</template>

<script>

    module.exports = {

        props: {
            'templates': Array,
            'ext_key': String,
            'resource': {type: String, default: 'api/emailsender'},
            'attachments': {type: Array, default: () => {return [];}},
            'emailData': {type: Object, default: () => {return {};}},
            'user_id': {type:  Number, default: null},
            'id': {type: [String, Number], default: null},
        },

        data() {
            return {
                template: '',
                searching: false,
                mail_data: {}
            }
        },

        created() {
            this.Mail = this.$resource(this.resource, {}, {
                'template': {method: 'post', url: `${this.resource}/template{/id}`},
                'sendmail': {method: 'post', url: `${this.resource}/sendmail{/id}`}
            });
        },

        events: {
            'after.email.send': function (type, mail) {
                this.$refs.mailmodal.close();
                this.$refs.maillog.load();
            },
            'email.cancel': function (type) {
                this.$refs.mailmodal.close();
            }
        },

        methods: {
            mailTemplate(type) {
                this.searching = true;
                this.Mail.template({id: this.id}, {
                    type: type,
                    data: this.emailData,
                    user_id: this.user_id,
                }).then(res => {
                    this.mail_data = _.merge({
                        to: '',
                        cc: '',
                        bcc: '',
                        subject: '',
                        content: ''
                    }, res.data.mail);
                    this.searching = false;
                    this.$refs.mailmodal.open();
                }, res => {
                    this.$notify(res.data, 'danger');
                    this.searching = false;
                });

            },

            sendMail: function (type, mail) {
                return this.Mail.sendmail({id: this.id}, {type, mail, data: this.emailData, user_id: this.user_id})
                        .then(res => this.$notify(res.data.message, 'success'), res => this.$notify(res.data, 'danger'));
            }
        },

        components: {
            'email-modal': require('./email-modal.vue'),
            'email-logs': require('./email-logs.vue'),

        }
    };

</script>
