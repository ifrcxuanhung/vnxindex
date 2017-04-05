var CoomingSoon = function () {

    return {
        //main function to initiate the module
        init: function (template_url) {

            $.backstretch([
    		        template_url + "assets/img/bg/bg_slide_01.jpg",
    		        template_url + "assets/img/bg/bg_slide_02.jpg",
    		        template_url + "assets/img/bg/bg_slide_03.jpg",
    		        template_url + "assets/img/bg/bg_slide_04.jpg"
    		        ], {
    		          fade: 1000,
    		          duration: 10000
    		    });

            var austDay = new Date();
            austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 12);
            $('#defaultCountdown').countdown({until: austDay});
            $('#year').text(austDay.getFullYear());
        }

    };

}();