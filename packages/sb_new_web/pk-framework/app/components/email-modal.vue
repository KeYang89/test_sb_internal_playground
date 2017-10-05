<template>

    <form class="uk-form">
        <div class="uk-form-horizontal">
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'To' | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" v-model="to" class="uk-form-width-large">
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'CC' | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" v-model="cc" class="uk-form-width-large">
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'BCC' | trans }}</label>
                <div class="uk-form-controls">
                    <input type="text" v-model="bcc" class="uk-form-width-large">
                </div>
            </div>
        </div>

        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <input type="text" v-model="subject" :placeholder="'Subject' | trans" class="uk-form-large uk-width-1-1">
            </div>
        </div>
        <div class="uk-form-row">
            <div class="uk-form-controls">
                <v-editor :value.sync="content" class="uk-width-1-1" :placeholder="'Email text' | trans"
                          :options="{markdown: true, height: 250}"></v-editor>
            </div>
        </div>
        <div v-if="attachments.length" class="uk-form-row">
            <label class="uk-form-label">{{ 'Attachments' | trans }}</label>
            <div class="uk-form-controls">
                <p v-for="attachment in attachments" class="uk-form-controls-condensed">
                    <label><input type="checkbox" v-model="files" class="uk-margin-small-right" :value="attachment.path"/>
                    {{ attachment.name }} <small>({{ attachment.type | trans }})</small></label>
                </p>
            </div>
        </div>

    </form>

    <div class="uk-modal-footer uk-text-right">
            <button @click="cancel" class="uk-button uk-margin-small-right">{{ 'Cancel' | trans }}</button>
            <button @click="send" class="uk-button uk-button-primary">
                <i v-spinner="emailing" icon="paper-plane-o"></i>{{ 'Send email' | trans }}</button>
    </div>


</template>

<script>

    module.exports = {

        props: ['type', 'ext_key', 'to', 'cc', 'bcc', 'subject', 'content', 'sendAction', 'attachments'],

        data() {
            return {
                emailing: false,
                files: []
            }
        },

        created() {
            this.Email = this.$resource('api/emailsender/email{/id}');
            ['to', 'cc', 'bcc'].forEach(key => {
                if (_.isArray(this[key])) {
                    this[key] = this[key].join(';');
                }
            });
            this.attachments = this.attachments || [];
        },

        methods: {
            send() {
                this.emailing = true;
                this.sendAction(this.type, this.email).then(() => {
                    this.emailing = false;
                    this.$dispatch('after.email.send', this.type, this.email);
                });
            },
            cancel() {
                this.$dispatch('email.cancel', this.type)
            }
        },

        computed: {
            email() {
                return {
                    ext_key: this.ext_key,
                    to: this.to,
                    cc: this.cc,
                    bcc: this.bcc,
                    subject: this.subject,
                    content: this.content,
                    files: this.files
                };
            }
        }
    };

</script>
