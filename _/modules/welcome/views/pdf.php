<div class="popup">
    <div class="popup-header ui-dialog-titlebar ui-widget-header">
        <p><?php trans('message') ?></p>
        <span class="ui-icon ui-icon-closethick popup-close">close</span>
    </div>
    <div class="popup-content">
        <?php 
            if($download_documents == 1)
            {
                trans('you_need_login_to_download');
            }
            if($download_documents == 2)
            {
                trans('only_group_vip_and_admin_download');
            } 
        ?>
    </div>
</div>
<div class="popup-background"></div>
<script>
    $(document).ready(function(){
        $('.popup').show();
        $('.popup-background').show();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            //$('.popup').hide();
            //$('.popup-background').hide();
            //history.back(1);
            close();
        }
    });
    $('.popup-close').click(function() {
        //$('.popup').hide();
        //$('.popup-background').hide();
        //history.back(1);
        close();
    });
    $(function() {
        test()
        $(window).resize(function() {
            test()
        })//g?i hàm khi resize
        function test() {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var widthPopup = $('.popup').width();
            var heightPopup = $('.popup').height();
            var leftPopup = (windowWidth - widthPopup) / 2;
            var topPopup = (windowHeight - heightPopup) / 3;
            $('.popup').css({"left": leftPopup});
            $('.popup').css({"top": topPopup});
        }
    });
</script>
