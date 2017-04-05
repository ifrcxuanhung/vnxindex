<!-- Always visible control bar -->
<div id="control-bar" class="blue-bg clearfix">
    <div class="container_12">
        <div class="mr_top_title_left float-left">
            <!--button type="button"><img src="images/icons/fugue/navigation-180.png" width="16" height="16"> Back to list</button-->
            <font><?php echo (is_array($ref)) ? $ref[0]['stk_name'] : NULL; ?></font>
        </div>

        <!--div class="float-right">
            <button type="button" disabled="disabled">Disabled</button>
            <button type="button" class="red">Cancel</button>
            <button type="button" class="grey">Reset</button>
            <button type="button"><img src="images/icons/fugue/tick-circle.png" width="16" height="16"> Save</button>
        </div-->



    </div>
</div>
<!-- End control bar -->