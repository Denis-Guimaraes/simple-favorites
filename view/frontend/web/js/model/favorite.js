define([
    'ko',
    'SimpleMage_SimpleFavorites/js/action/getFavorite',
    'SimpleMage_SimpleFavorites/js/action/saveFavorite',
    'SimpleMage_SimpleFavorites/js/action/deleteFavorite',
], function(ko, getFavorite, saveFavorite, deleteFavorite) {

    return function(productId) {
        const self = this;
        this.productId = productId;
        this.isFavorite = ko.observable(false);
        getFavorite(this.productId).done(function(response) {
            self.isFavorite(response ? true : false);
        });

        this.save = function() {
            const self = this;
            saveFavorite(this.productId).done(function() {
                self.isFavorite(true);
            });
        };

        this.delete = function() {
            const self = this;
            deleteFavorite(this.productId).done(function() {
                self.isFavorite(false);
            });
        };
    };

});
