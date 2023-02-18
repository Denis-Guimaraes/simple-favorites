define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data',
    'jquery',
    'mage/url',
], function(Component, ko, customerData, $, urlBuilder) {
    const customer = customerData.get('customer');

    return Component.extend({
        initialize: function() {
            this._super();
            urlBuilder.setBaseUrl(this.baseUrl);
            return this;
        },
        initObservable: function() {
            this._super();
            this.favorites = ko.observableArray([]);
            this.getFavorites();
            customer.subscribe(this.getFavorites.bind(this));
            return this;
        },
        isLoggedIn: function() {
            return customer() && customer().firstname;
        },
        isFavorite: function() {
            return this.favorites().includes(this.productId);
        },
        getLabel: function() {
            if (this.isFavorite()) {
                return 'Remove from favorites';
            }
            return 'Add to favorites';
        },
        toggleFavorite: function() {
            if (this.isFavorite()) {
                this.removeFavorite();
            } else {
                this.addFavorite();
            }
        },
        getFavorites: function() {
            if (!this.isLoggedIn()) {
                return;
            }
            const self = this;
            $.ajax({
                type: 'GET',
                url: urlBuilder.build(
                    'rest/default/V1/customers/favorites/mine/desc'
                ),
            }).done(function(response) {
                self.favorites(response.product_ids || []);
                console.log(self.favorites());
            }).fail(function(error) {
                console.log(error);
            });
        },
        addFavorite: function() {
            const self = this;
            $.ajax({
                type: 'POST',
                url: urlBuilder.build(
                    'rest/default/V1/customers/favorites/mine'
                ),
                data: JSON.stringify({ productId: this.productId }),
                contentType: 'application/json',
                dataType: 'json',
            }).done(function() {
                self.favorites.push(self.productId);
            }).fail(function(error) {
                console.log(error);
            });
        },
        removeFavorite: function() {
            const self = this;
            $.ajax({
                type: 'DELETE',
                url: urlBuilder.build(
                    `rest/default/V1/customers/favorites/mine/${self.productId}`
                ),
            }).done(function() {
                const favorites = self
                    .favorites()
                    .filter((productId) => productId !== self.productId);
                self.favorites(favorites || []);
            }).fail(function(error) {
                console.log(error);
            });
        },
    });
});
