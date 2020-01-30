(function (e, ep, $) {

    var MailoptinIntegration = {
        fields: moElementor.fields,
        cache: {},

        getName: function getName() {
            return 'mailoptin';
        },

        onElementChange: function onElementChange(setting) {
            var self = this;
            switch (setting) {
                case 'mailoptin_connection':
                case 'mailoptin_connection_list':
                    // self.updateTags();
                    self.updateFieldsMap();
                    break;
            }
        },

        onSectionActive: function onSectionActive() {
            // this.updateTags();
            this.updateFieldsMap();
        },

        updateTags: function updateTags() {
            this.updateOptions('mailoptin_tags', []);
            // this.getEditorControlView('mailoptin_tags').setValue('');
            this.addControlSpinner('mailoptin_tags');
            this.updateOptions('mailoptin_tags', {hello: 'Hello', hi: 'Hi'});
        },

        removeControlSpinner: function removeControlSpinner(name) {
            var $controlEl = this.getEditorControlView(name).$el;

            $controlEl.find(':input').attr('disabled', false);
            $controlEl.find('.elementor-control-spinner').remove();
        },

        updateFieldsMap: function updateFieldsMap() {
            var self = this, data, key, controlView = self.getEditorControlView('mailoptin_connection_list');

            if (!controlView.getControlValue()) return;

            data = {
                'action': 'mo_elementor_fetch_custom_fields',
                'nonce': moElementor.nonce,
                'connection': self.getEditorControlView('mailoptin_connection').getControlValue(),
                'connection_email_list': controlView.getControlValue()
            };

            key = data.connection + '_' + data.connection_email_list;

            if (typeof self.cache[key] != 'undefined' && !_.isEmpty(self.cache[key])) {
                return self.getEditorControlView('mailoptin_fields_map').updateMap(self.cache[key]);
            }

            self.addControlSpinner('mailoptin_connection');
            self.addControlSpinner('mailoptin_connection_list');

            // hide the mapping view
            self.getEditorControlView('mailoptin_fields_map').$el.hide();

            $.post(moElementor.ajax_url, data, function (response) {
                if ('success' in response && response.success === true) {
                    result = self.cache[key] = response.data.fields;
                    self.getEditorControlView('mailoptin_fields_map').updateMap(result);
                    self.getEditorControlView('mailoptin_fields_map').$el.show();
                }

                self.removeControlSpinner('mailoptin_connection');
                self.removeControlSpinner('mailoptin_connection_list');
            });
        },
    };

    ep.modules.forms.mailoptin = Object.assign(ep.modules.forms.mailchimp, MailoptinIntegration);

    ep.modules.forms.mailoptin.addSectionListener('section_mailoptin', MailoptinIntegration.onSectionActive);

})(elementor, elementorPro, jQuery);