define([
    'uiComponent',
    'jquery','ko',
    'mage/url',
],function (
    uiComponent,
    $,
    ko,
    urlBuilder
) {
        'use strict';

        return uiComponent.extend({
            defaults: {
                inputSelector: '#inpMy',
                outputSelector: '#divMy'
            },

            buttonClick: function () {
                let self = this;
                var serviceUrl = urlBuilder.build(this.url);
                console.log(this.textContainer);
                var inputValue = $(this.inputSelector).val();

                $.ajax({
                    url: serviceUrl,
                    data: {name:inputValue},
                    type: "POST",
                    dataType: 'json'
                }).done(function (response) {
                  $(self.outputSelector).html(JSON.stringify(response)).show();
                }).fail(function (error) {
                    console.log(JSON.stringify(error));
                });
            }
        });
});
