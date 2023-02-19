define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'SimpleMage_SimpleFavorites/js/model/favorite'
], function(Component, customerData, favorite) {
    const customer = customerData.get('customer');

    return Component.extend({
        initialize: function() {
            this._super();
            if (this.isLoggedIn()) {
                this.favorite = new favorite(this.productId);
            }
            customer.subscribe(function() {
                this.favorite = new favorite(this.productId);
            });
            return this;
        },
        isLoggedIn: function() {
            return customer() && customer().firstname;
        },
        isFavorite: function() {
            return this.favorite.isFavorite();
        },
        getLabel: function() {
            if (this.isFavorite()) {
                return 'Remove from favorites';
            }
            return 'Add to favorites';
        },
        toggleFavorite: function() {
            if (this.isFavorite()) {
                this.favorite.delete();
            } else {
                this.favorite.save();
            }
        },
    });
});
