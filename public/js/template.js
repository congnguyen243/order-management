(function ($, app) {

    var homeCls = function () {

        var el = {};

        this.run = function () {
            this.init();
            this.bindEvents();
        };

        this.init = function () {
            
        };

        this.bindEvents = function () {
            initSubmit();
            
        };

        this.resize = function () {

        };

        var initSubmit = function () {

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
