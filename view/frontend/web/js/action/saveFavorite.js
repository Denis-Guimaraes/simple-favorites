define([
    'jquery',
    'mage/url',
], function($, urlBuilder) {

    return function(productId) {
        return $.ajax({
            type: 'POST',
            url: urlBuilder.build('/rest/default/V1/customers/favorites/mine'),
            data: JSON.stringify({ productId: productId }),
            contentType: 'application/json',
            dataType: 'json',
        });
    };
});
