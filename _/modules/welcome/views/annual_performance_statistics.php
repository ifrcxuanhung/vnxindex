<div id="content" role="main" class="observatory-content">
    <div class="intro_copn" style="width:97%">
        <div class="breadcrumb">
            <a href="<?= base_url(); ?>" class="lnk_home"><?= trans('Home'); ?></a>
            <span><?= trans('annual_performance_ranking'); ?></span>
        </div>

        <div style="float:left; margin-top: 20px; width: 60%;">
            <h2><?= trans('annual_performance_ranking'); ?></h2>
        </div>
        <div  style="float:left; width: 35%;padding-left: 5%; ">
            <label class="count_all_annual"><span><?php echo $count ?></span> <?php trans('count_annual_performance'); ?></label> 
        </div> 
        <div style="float:left;">
            <p style="text-align: justify;font-size: 11pt;"><?= trans('description_annual_performance_statistics'); ?></p> 
        </div>      
        <div class="clear"></div>
        <div class="detail-observatoire"></div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        ifrc.showDetailAnnualPerformanceStatistics();
    });
</script>