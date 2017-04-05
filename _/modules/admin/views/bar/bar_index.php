<style>
.bar{
    color: white;
    font-size: 30px;
    font-weight: bold;
    text-transform: uppercase;
}
</style>
<!-- Always visible control bar -->
<div id="control-bar" class="blue-bg clearfix">
    <div class="container_12">

        <div class="mr_top_title_left float-left">
            <!--button type="button"><img src="images/icons/fugue/navigation-180.png" width="16" height="16"> Back to list</button-->
            <font class="bar"><?php echo ($info['en_name'] != false) ? $info['en_name'] : NULL; ?></font>
        </div>

    </div>
</div>
<!-- End control bar -->