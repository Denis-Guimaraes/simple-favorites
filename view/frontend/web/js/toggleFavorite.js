define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data',
    'jquery',
    'SimpleMage_SimpleFavorites/js/action/getFavorite',
    'SimpleMage_SimpleFavorites/js/action/saveFavorite',
    'SimpleMage_SimpleFavorites/js/action/deleteFavorite',
], function(Component, ko, customerData, $, getFavorite, saveFavorite, deleteFavorite) {
    const customer = customerData.get('customer');

    return Component.extend({
        initObservable: function() {
            this._super();
            this.favorites = ko.observable(0);
            this.getFavorite();
            customer.subscribe(this.getFavorite.bind(this));
            return this;
        },
        isLoggedIn: function() {
            return customer() && customer().firstname;
        },
        isFavorite: function() {
            return this.favorites();
        },
        getLabel: function() {
            if (this.isFavorite()) {
                return 'Remove from favorites';
            }
            return 'Add to favorites';
        },
        toggleFavorite: function() {
            if (this.isFavorite()) {
                this.deleteFavorite();
            } else {
                this.saveFavorite();
            }
        },
        getFavorite: function() {
            const self = this;
            if (!this.isLoggedIn()) {
                return;
            }

            getFavorite(this.productId).done(function(response) {
                self.favorites(response);
            });
        },
        saveFavorite: function() {
            const self = this;
            saveFavorite(this.productId).done(function() {
                self.favorites(self.productId);
            });
        },
        deleteFavorite: function() {
            const self = this;
            deleteFavorite(this.productId).done(function() {
                self.favorites(0);
            });
        },
    });
});
