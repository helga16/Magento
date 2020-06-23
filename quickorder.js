define([
    'uiComponent',
    'jquery','ko',
    'mage/url',
    'mage/validation'

],function (uiComponent, $, ko, urlBuilder,validation) {
    'use strict';
    return uiComponent.extend({

         quickorder: function (event) {
            console.log('click');
             let self = this;
            var options = {
                type: 'popup',
                title: $.mage.__('Quick order'),
                modalClass: 'event-popup',
                responsive: true,
                buttons: [{
                    text: $.mage.__('Send'),
                    click: function () {

                        let dataForm = $('.dataForm');
                        let serviceUrl = urlBuilder.build(self.url);
                        let nameValue = $(self.nameValue).val();
                        let telValue = $(self.telValue).val();
                        let emailValue = $(self.emailValue).val();
                        let sku = self.sku;
                        $(self.skuValue).val(self.sku);
                        console.log(sku);
                        if (dataForm.validation() && dataForm.validation().validation('isValid')) {
                            $.ajax({
                                url: serviceUrl,
                                data: {customerName: nameValue, phone: telValue, email: emailValue, sku: sku},
                                type: "POST",
                                dataType: 'json'
                            }).done(function (response) {
                                console.log('success');
                                nameValue = '';
                                telValue = '';
                            }).fail(function (error) {
                                console.log(JSON.stringify(error));
                            });
                            this.closeModal();

                        }
                    }
                }]
            };
            $('#popupQuickOrder').modal(options).modal("openModal");
        },
    })
});
