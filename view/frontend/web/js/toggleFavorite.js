define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'SimpleMage_SimpleFavorites/js/model/favorite'
], function(Component, customerData, favorite) {
    const customer = customerData.get('customer');
    customerData.reload(['customer']);

    return Component.extend({
        initialize: function() {
            this._super();
            const self = this;

            if (this.isLoggedIn()) {
                this.favorite = new favorite(this.productId);
            }
            customer.subscribe(function() {
                self.favorite = new favorite(self.productId);
            });
            return this;
        },
        isLoggedIn: function() {
            return customer() && customer().firstname;
        },
        isFavorite: function() {
            return this.favorite.isFavorite();
        },
        getClass: function() {
            return this.favorite.isFavorite() ? 'delete-favorite' : 'save-favorite';
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
