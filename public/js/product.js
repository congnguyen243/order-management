(function ($, app) {

    var homeCls = function () {

        var el = {};

        this.run = function () {
            this.init();
            this.bindEvents();
        };

        this.init = function () {
            $('#btn-product-save').on('click',function(){
                alert('Saved Product')
            })
        };

        this.bindEvents = function () {
            initSubmit();
            ctrateProduct();
        };

        this.resize = function () {

        };

        var initSubmit = function () {

        }

        var ctrateProduct = function(){
            
        }

    };

    $(document).ready(function () {
        var homeObj = new homeCls();
        homeObj.run();
        $(window).resize(function () {
            homeObj.resize();
        });
    });

}(jQuery, $.app));
