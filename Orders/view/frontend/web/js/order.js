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

            buttonClick: function () {
                let self = this;
                var serviceUrl = urlBuilder.build(this.url);
                var inputValue = $(this.inputValue).val();

                $.ajax({
                    url: serviceUrl,
                    data: {name:inputValue},
                    type: "POST",
                    dataType: 'json'
                }).done(function (response) {
                  $(self.textContainer).html(JSON.stringify(response)).show();
                }).fail(function (error) {
                    console.log(JSON.stringify(error));
                });
            }
        });
});
