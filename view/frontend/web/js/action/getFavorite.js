define([
    'jquery',
    'mage/url',
], function($, urlBuilder) {

    return function(productId) {
        return $.ajax({
            type: 'GET',
            url: urlBuilder.build(`rest/default/V1/customers/favorites/mine/${productId}`),
        });
    };
});
