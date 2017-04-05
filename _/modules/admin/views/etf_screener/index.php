<style type="text/css">
.chb_stf{
    max-height:300px;
    overflow: auto;
}

.chb_stf ul li {
    padding:1%;
    list-style: none;
    float:left;
    width:23%;
}  
dl.accordion dt {
    margin-bottom:5px;
}
dl.accordion dd {
    padding: 0;
}
</style>
<div id="content" class="observatory-content" role="main">
  <div class="intro_copn" style="width:100%; float:left">
        <div style="width: 100%; float: left; clear: both" class="container">
      <section class="grid_8" style="width:100%;margin:auto!important;float:none;display: block;">
          <div class="block-border">
              <div class="block-content">
                  <h1>ETF Screener</h1>
                  <div class="block-controls">
                      <ul class="controls-buttons">
                          <li><button class="blue" id="reset">Reset</button></li>
                      </ul>
                  </div>
                  <div class="tabs-content" style="background:none;border:none;box-shadow: none;padding: 0em;">
                  <div id="step1">
                      <dl class="accordion">
                          <dt>
                              <span class="number">1</span> 
                              <span>Country</span>
                              <span style="float:right; color:red" id="buoc1"><?= $info['count'] ?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                                    <ul>
                                        <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                        <?php
                                            foreach($info['country'] as $c_k => $c_v){
                                                echo "<li><input type=\"checkbox\" name=\"stats-display[]\" id=\"stats-display-".$c_k."\" value=\"".$c_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$c_k."\">".$c_v."</label></li>";
                                            }
                                        ?>
                                    </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">2</span> 
                              <span>Exp Ratio</span>
                              <span style="float:right; color:red" id="buoc2"><?= $info['count'] ?></span>
                          </dt>
                          <dd>
                            <ul class="fix_boxtxt">
                                <li>
                                    <label for="simple-required">Min = (<?= number_format($info['min_ratio']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['min_ratio'] ?>" onblur="if(this.value == '') this.value = '<?= $info['min_ratio'] ?>';" class="fix_wid min_ratio sliderValue_1" data-index="0">
                                </li>
                                <li>
                                    <label for="simple-required">Max = (<?= number_format($info['max_ratio']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['max_ratio'] ?>" onblur="if(this.value == '') this.value = '<?= $info['max_ratio'] ?>';" class="fix_wid max_ratio sliderValue_1" data-index="1">
                                </li>
                                <li style="float:none"><button type="button" class="fix_tp">Validate</button></li>
                                <div id="slider-range_1" style="margin-top:10px"></div>

                            </ul>

                            <div style="clear:both; height:1px;">&nbsp;</div>

                          </dd>
                          <dt>
                              <span class="number">3</span> 
                              <span>Issuer</span>
                              <span style="float:right; color:red" id="buoc3"><?= $info['count'] ?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['issuer'] as $i_k => $i_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-1[]\" id=\"stats-display-".$i_k."\" value=\"".$i_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$i_k."\">".$i_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">4</span> 
                              <span>Structure</span>
                              <span style="float:right; color:red" id="buoc4"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['structure'] as $st_k => $st_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-2[]\" id=\"stats-display-".$st_k."\" value=\"".$st_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$st_k."\">".$st_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">5</span> 
                              <span>Size</span>
                              <span style="float:right; color:red" id="buoc5"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['size'] as $s_k => $s_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-3[]\" id=\"stats-display-".$s_k."\" value=\"".$s_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$s_k."\">".$s_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">6</span> 
                              <span>Style</span>
                              <span style="float:right; color:red" id="buoc6"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                                  <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['style'] as $st_k => $st_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-4[]\" id=\"stats-display-".$st_k."\" value=\"".$st_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$st_k."\">".$st_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">7</span> 
                              <span>General</span>
                              <span style="float:right; color:red" id="buoc7"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['region_gen'] as $g_k => $g_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-5[]\" id=\"stats-display-".$g_k."\" value=\"".$g_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$g_k."\">".$g_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">8</span> 
                              <span>Specific</span>
                              <span style="float:right; color:red" id="buoc8"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['region_spe'] as $sp_k => $sp_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-6[]\" id=\"stats-display-".$sp_k."\" value=\"".$sp_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$sp_k."\">".$sp_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">9</span> 
                              <span>Currency</span>
                              <span style="float:right; color:red" id="buoc9"><?= $info['count']?></span>
                          </dt>
                          <dd>
                              <div class="chb_stf">
                              <ul>
                                  <li><input type="checkbox" class="selAllChksInGroup">&nbsp;All</li>
                                  <?php
                                      foreach($info['currency'] as $cu_k => $cu_v){
                                          echo "<li><input type=\"checkbox\" name=\"stats-display-7[]\" id=\"stats-display-".$cu_k."\" value=\"".$cu_v."\" class=\"fix_line\">&nbsp;<label for=\"stats-display-".$cu_k."\">".$cu_v."</label></li>";
                                      }
                                 ?>
                              </ul>
                              </div>
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </dd>
                          <dt>
                              <span class="number">10</span> 
                              <span>Price</span>
                              <span style="float:right; color:red" id="buoc10"><?= $info['count']?></span>
                          </dt>
                          <dd>
                            <ul class="fix_boxtxt">
                                <li>
                                    <label for="simple-required">Min = (<?= number_format($info['min_price']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['min_price'] ?>" onblur="if(this.value == '') this.value = '<?= $info['min_price'] ?>';" class="fix_wid min_price sliderValue_2" data-index="0">
                                </li>
                                <li>
                                    <label for="simple-required">Max = (<?= number_format($info['max_price']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['max_price'] ?>" onblur="if(this.value == '') this.value = '<?= $info['max_price'] ?>';" class="fix_wid max_price sliderValue_2" data-index="1">
                                </li>
                                <li style="float:none"><button type="button" class="fix_tp_1">Validate</button></li>
                                <div id="slider-range_2" style="margin-top:10px"></div>

                            </ul>

                            <div style="clear:both; height:1px;">&nbsp;</div>

                          </dd>
                          <dt>
                              <span class="number">11</span> 
                              <span>AUM</span>
                              <span style="float:right; color:red" id="buoc11"><?= $info['count']?></span>
                          </dt>
                          <dd>
                            <ul class="fix_boxtxt">
                                <li>
                                    <label for="simple-required">Min = (<?= number_format($info['min_aum']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['min_aum'] ?>" onblur="if(this.value == '') this.value = '<?= $info['min_aum'] ?>';" class="fix_wid min_aum sliderValue_3" data-index="0">
                                </li>
                                <li>
                                    <label for="simple-required">Max = (<?= number_format($info['max_aum']) ?>)</label>
                                <input type="text" name="simple-required" id="simple-required" value="<?= $info['max_aum'] ?>" onblur="if(this.value == '') this.value = '<?= $info['max_aum'] ?>';" class="fix_wid max_aum sliderValue_3" data-index="1">
                                </li>
                                <li style="float:none"><button type="button" class="fix_tp_2">Validate</button></li>
                                <div id="slider-range_3" style="margin-top:10px"></div>

                            </ul>

                            <div style="clear:both; height:1px;">&nbsp;</div>

                          </dd>
                          <button type="button" style="float:right" class="nextButton">Execute</button>
                          <div style="clear:both; height:1px;">&nbsp;</div>
                  </div>
                  <div id="step2">
                      <div class="block-content form inline-medium-label" style="margin-top:40px;margin-bottom: 20px;overflow:auto">
                          <ul class="controls-buttons" style="position: absolute; top:5px; right:5px">
                            <li><a href="#" class="blue" id="export" style="color:#333; font-weight: bold; text-transform: none;">Export</a></li>
                          </ul>
                      <div id="viewData">
                          <ul class="viewData tabs">
                              <li class="big-button active"><a href="#calendar">Result</a></li>
                          </ul>
                          <div id="calendar">
                              <div class="fix_mar">
                                  <div class="">
                                      <table class="table summary-table" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                              <th scope="col" style='width:30%'>
                                                <span class="column-sort">
                                                    <a href="#" title="sort_up" class="sort-up">&blacktriangle;</a>
                                                    <a href="#" title="sort_down" class="sort-down">&blacktriangledown;</a>
                                                </span>
                                                <span>Name</span>
                                              </th>
                                              <th scope="col" style='width:10%'>
                                                <span class="column-sort">
                                                    <a href="#" title="sort_up" class="sort-up">&blacktriangle;</a>
                                                    <a href="#" title="sort_down" class="sort-down">&blacktriangledown;</a>
                                                </span>
                                                <span>Month</span>
                                              </th>
                                              <th scope="col" style='width:10%'>
                                                <span class="column-sort">
                                                    <a href="#" title="sort_up" class="sort-up">&blacktriangle;</a>
                                                    <a href="#" title="sort_down" class="sort-down">&blacktriangledown;</a>
                                                </span>
                                                <span>YTD</span>
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                      </table>
                                  </div>
                              </div>	
                              <div style="clear:both; height:1px;">&nbsp;</div>
                          </div>
                          <div id="marketData"></div>
                          <div style="clear:both; height:1px;">&nbsp;</div>
                      </div>
                      </div>
                  </div>				
                  </div>
              </div>
          </div>
          <div id="LoadingImage" style="display: none; position: absolute; top: 45%; left: 45%; z-index: 999999">
              <img src="<?= base_url() ?>assets/templates/backend/images/loading.gif" />
          </div>
      </section>
    </div>
  </div>
</div>
<script>
		  $(function() {
			$("#slider-range_1").slider({
			  range: true,
			  min: <?= $info['min_ratio'] ?>,
			  max: <?= $info['max_ratio'] ?>,
			  values: [<?= $info['min_ratio'] ?>,<?= $info['max_ratio'] ?>],
			  slide: function( event, ui ) {
				 for (var i = 0; i < ui.values.length; ++i) {
					$("input.sliderValue_1[data-index=" + i + "]").val(ui.values[i]);
				}
			  }
			});
			$("input.sliderValue_1").change(function() {
				var $this = $(this);
				$("#slider-range_1").slider("values", $this.data("index"), $this.val());
			});
			$("#slider-range_2").slider({
			  range: true,
			  min: <?= $info['min_price'] ?>,
			  max: <?= $info['max_price'] ?>,
			  values: [<?= $info['min_price'] ?>,<?= $info['max_price'] ?>],
			  slide: function( event, ui ) {
				 for (var i = 0; i < ui.values.length; ++i) {
					$("input.sliderValue_2[data-index=" + i + "]").val(ui.values[i]);
				}
			  }
			});
			$("input.sliderValue_2").change(function() {
				var $this = $(this);
				$("#slider-range_2").slider("values", $this.data("index"), $this.val());
			});
			$("#slider-range_3").slider({
			  range: true,
			  min: <?= $info['min_aum'] ?>,
			  max: <?= $info['max_aum'] ?>,
			  values: [<?= $info['min_aum'] ?>,<?= $info['max_aum'] ?>],
			  slide: function( event, ui ) {
				 for (var i = 0; i < ui.values.length; ++i) {
					$("input.sliderValue_3[data-index=" + i + "]").val(ui.values[i]);
				}
			  }
			});
			$("input.sliderValue_3").change(function() {
				var $this = $(this);
				$("#slider-range_3").slider("values", $this.data("index"), $this.val());
			});
		  });
		  </script>
<script type="text/javascript">
// show DOCUMENT effect
    $('div#step1,div#step2').css({
        'opacity':0,
        'visibility':'visible'
    });
    $('div#step1,div#step2,div#step3,div#step4').animate({
        'opacity':1
    },700);
				
// change steps
    $('#fourStep > li:first').nextAll().addClass('disabled');
    $('#fourStep > li > a,#fourStep > li > a > span').click(function(){
        $(this).parents('li').prevAll().andSelf().removeClass('disabled');
        $(this).parents('li').nextAll().addClass('disabled');
    });
                
    var $url = document.location.href;
    var $array = $url.split('#&');
    var $currentTab = '#'+$array[1];
    $('#fourStep li a').each(function(){
        var $href = $(this).attr('href');
        if($href == $currentTab){
            $(this).parent('li').prevAll().andSelf().removeClass('disabled');
            $(this).parent('li').nextAll().addClass('disabled');
        }
    });
    // hide select tabs
    $('span.hidden').each(function(){
        var $h = $(this).parent('li').height() + 18;
        var $w = $(this).parent('li').outerWidth();
        $(this).css({
            'height':$h+'px',
            'width':$w+'px'
        });
    });      
    // add active tab - step 2
    $('ul.viewData li').click(function(){
        $('ul.viewData li').removeClass('active');
        $(this).addClass('active');
    });
    // switch tabs - step 2
    $('.viewData li a').click(function(e){
        e.preventDefault();
        var $href = $(this).attr('href');
        var $isActive = ($(this).parent().attr('class').indexOf('active'));
        $('#viewData > div').hide(0,function(){return false});
        if($isActive){
            $($href).show(0,function(){return false});
        }
    });
    $('.viewData li').each(function(){
        var $active = $(this).attr('class').indexOf('active');
        if($active != -1){
            var $href = $(this).find('a').attr('href');
            $($href).show(0,function(){return false});
        }
    });
    //next - back buttons
    $('button.nextButton').click(function(){
        var $url = document.location.href;
        var $array = $url.split('#&');
        var $currentTab = '#'+$array[1];
        if($currentTab == '#undefined'){
            $('#fourStep li:first a').parent('li').next().find('a').trigger('click');
        }
        $('#fourStep li a[href="'+$currentTab+'"]').parent('li').next().find('a').trigger('click');
    });     
    $('button.backButton').click(function(){
        var $url = document.location.href;
        var $array = $url.split('#&');
        var $currentTab = '#'+$array[1];
        $('#fourStep li a[href="'+$currentTab+'"]').parent('li').prev().find('a').trigger('click');
    });
</script>
<script type="text/javascript">
    $("input").attr("checked", true);
    function get_value(){			
        var value_country = new Array();
        $.each($("input[name='stats-display[]']:checked"), function() {
                value_country.push($(this).val());
        });	
        var value_issuer = new Array();
        $.each($("input[name='stats-display-1[]']:checked"), function() {
                value_issuer.push($(this).val());
        });
        var value_structure = new Array();
        $.each($("input[name='stats-display-2[]']:checked"), function() {
                value_structure.push($(this).val());
        });
        var value_size = new Array();
        $.each($("input[name='stats-display-3[]']:checked"), function() {
                value_size.push($(this).val());
        });
        var value_style = new Array();
        $.each($("input[name='stats-display-4[]']:checked"), function() {
                value_style.push($(this).val());
        });
        var value_general = new Array();
        $.each($("input[name='stats-display-5[]']:checked"), function() {
                value_general.push($(this).val());
        });
        var value_specific = new Array();
        $.each($("input[name='stats-display-6[]']:checked"), function() {
                value_specific.push($(this).val());
        });
        var value_currency = new Array();
        $.each($("input[name='stats-display-7[]']:checked"), function() {
                value_currency.push($(this).val());
        });
        var min_ratio = $(".min_ratio").val();
        var max_ratio = $(".max_ratio").val();

        var min_price = $(".min_price").val();
        var max_price = $(".max_price").val();

        var min_aum = $(".min_aum").val();
        var max_aum = $(".max_aum").val();
        call_ajax(value_country,min_ratio,max_ratio,value_issuer,value_structure,value_size,value_style,value_general,value_specific,value_currency,min_price,max_price,min_aum,max_aum);
    };
    $("input[type=checkbox].selAllChksInGroup").live("click", ".chkAll", function( event ){
        $(this).parents('.chb_stf:eq(0)').find(':checkbox').prop('checked', this.checked);
        get_value();
    });

    $("input[name='stats-display[]']").click(function() {
        get_value();
    });

    $("input[name='stats-display-1[]']").click(function() {
        get_value();
    });

    $("input[name='stats-display-2[]']").click(function() {
        get_value();
    });
    
    $("input[name='stats-display-3[]']").click(function() {
        get_value();
    });
    
    $("input[name='stats-display-4[]']").click(function() {
        get_value();
    });
    
    $("input[name='stats-display-5[]']").click(function() {
        get_value();
    });
    
    $("input[name='stats-display-6[]']").click(function() {
        get_value();
    });
    
    $("input[name='stats-display-7[]']").click(function() {
        get_value();
    });
    
    $(".fix_tp").click(function(){
        get_value();
    });

    $(".fix_tp_1").click(function(){
        get_value();
    });

    $(".fix_tp_2").click(function(){
        get_value();
    });
//    $("#month']").change(function() {
//        get_value();
//    });
    $("#export").click(function(){
        var check =  $(".summary-table tr").length;
        if(check > 1){
            $("body").css({'bacground':'#ccc','opacity':'0.8'});
            $("#LoadingImage").show();
            $.ajax({
                url: '<?= admin_url().'ajax' ?>',
                type: 'post',
                data: 'act=process_export',
                success: function(rs){
                    $("body").css({'bacground':'','opacity':'1'});
                    $("#LoadingImage").hide();
                    rs = JSON.parse(rs);
                    window.location.href = '<?= admin_url() ?>screener/download_file?file=' + rs.file;
                }
            });
        }
        return false;
    });
    $("#reset").click(function(){
        $("INPUT[type='checkbox']").attr('checked', true);
        $("#slider-range_1").slider({
            range: true,
            min: <?= $info['min_ratio'] ?>,
            max: <?= $info['max_ratio'] ?>,
            values: [<?= $info['min_ratio'] ?>,<?= $info['max_ratio'] ?>],
            slide: function( event, ui ) {
               for (var i = 0; i < ui.values.length; ++i) {
                  $("input.sliderValue_1[data-index=" + i + "]").val(ui.values[i]);
              }
            }
          });
        $("#slider-range_2").slider({
          range: true,
          min: <?= $info['min_price'] ?>,
          max: <?= $info['max_price'] ?>,
          values: [<?= $info['min_price'] ?>,<?= $info['max_price'] ?>],
          slide: function( event, ui ) {
             for (var i = 0; i < ui.values.length; ++i) {
                $("input.sliderValue_2[data-index=" + i + "]").val(ui.values[i]);
            }
          }
        });
        $("#slider-range_3").slider({
          range: true,
          min: <?= $info['min_aum'] ?>,
          max: <?= $info['max_aum'] ?>,
          values: [<?= $info['min_aum'] ?>,<?= $info['max_aum'] ?>],
          slide: function( event, ui ) {
             for (var i = 0; i < ui.values.length; ++i) {
                $("input.sliderValue_3[data-index=" + i + "]").val(ui.values[i]);
            }
          }
        });
        $(".min_ratio").val(<?= $info['min_ratio'] ?>);
        $(".max_ratio").val(<?= $info['max_ratio'] ?>);

        $(".min_price").val(<?= $info['min_price'] ?>);
        $(".max_price").val(<?= $info['max_price'] ?>);

        $(".min_aum").val(<?= $info['min_aum'] ?>);
        $(".max_aum").val(<?= $info['max_aum'] ?>);
        get_value();
    });
    $(".column-sort a").click(function(){
        var sort = $(this).attr('title');
        if(sort == 'sort_up'){
            sort = 'ASC';
        }else{
            sort = 'DESC';
        }
        var title = $(this).closest(".column-sort").parent("th").children("span:last").html();
        var check =  $(".summary-table tr").length;
        if(check > 1){
            $("body").css({'bacground':'#ccc','opacity':'0.8'});
            $("#LoadingImage").show();
            $.ajax({
                url: '<?= admin_url().'ajax' ?>',
                type: 'post',
                data: 'act=process_sort'+'&title='+title+'&sort='+sort,
                async: false,
                success: function(rs){
                    $("body").css({'bacground':'','opacity':'1'});
                    $(".summary-table tbody").find("tr").remove();
                    $("#LoadingImage").hide();
                    rs = JSON.parse(rs);
                    var name = rs.data_name;
                    var code = rs.data_code;
                    var month = rs.data_month;
                    var ytd = rs.data_ytd;
                    var count = name.length-1;
                    for(i=0;i<=count;i++){
                        if(month[i] < 0){
                            month[i] = "<font color='red'>"+month[i]+"</font>";
                        }else{
                             month[i] = "<font color='green'>"+month[i]+"</font>";
                        }
                        if(ytd[i] < 0){
                            ytd[i] = "<font color='red'>"+ytd[i]+"</font>";
                        }else{
                             ytd[i] = "<font color='green'>"+ytd[i]+"</font>";
                        }
                        var html = '';
                        html += "<tr>"
                            +"<td style='width:30%; font-weight:bold'><a href='<?= admin_url() ?>observatory#" + code[i] + "' style='color:#3399CC'>" + name[i] + "</a></td>"
                            +"<td style='text-align:right; width:10%'>" + month[i] + "</td>"
                            +"<td style='text-align:right; width:10%'>" + ytd[i] + "</td>";
                        for(var j in years){
                            if(rs.data[years[j]][i] < 0){
                                rs.data[years[j]][i] = "<font color='red'>"+rs.data[years[j]][i]+"</font>";
                            }else{
                                 rs.data[years[j]][i] = "<font color='green'>"+rs.data[years[j]][i]+"</font>";
                            }
                            html += "<td style='text-align:right; width:10%'>" + rs.data[years[j]][i] + "</td>";
                        }
                        html += "</tr>";
                        $(".summary-table").find("tbody").append(html);
                    }
                }
            });
        }
        return false;
    });
    $(".nextButton").click(function(){
        var value_type = new Array();
        $.each($("input[name='stats-display[]']:checked"), function() {
                value_type.push($(this).val());
        });	
        var value_category = new Array();
        $.each($("input[name='stats-display-1[]']:checked"), function() {
                value_category.push($(this).val());
        });
        var value_provider = new Array();
        $.each($("input[name='stats-display-2[]']:checked"), function() {
                value_provider.push($(this).val());
        });
        var value_place = new Array();
        $.each($("input[name='stats-display-3[]']:checked"), function() {
                value_place.push($(this).val());
        });
        var value_price = new Array();
        $.each($("input[name='stats-display-4[]']:checked"), function() {
                value_price.push($(this).val());
        });
        var value_curr = new Array();
        $.each($("input[name='stats-display-5[]']:checked"), function() {
                value_curr.push($(this).val());
        });
        var value_month = $('#value_month').val();
        if(value_month == 0){
            $("<div id='dialog' title='Warning'><p>Choose Month Please!</p></div>").dialog();
        }else{
            var total = $("#buoc1").html();
            var limit_screener = '';
            
            if(limit_screener == 0){
                call_ajax_final(value_type,value_category,value_provider,value_place,value_price,value_curr,value_month,limit_screener);
            }else{
                if(total < limit_screener){
                    call_ajax_final(value_type,value_category,value_provider,value_place,value_price,value_curr,value_month,limit_screener);
                }else{
                    $("<div id='dialog'><p>Limit " + limit_screener + "</p></div>").dialog({
                        modal: true, 
                        title: 'Confirm', 
                        zIndex: 10000, 
                        minWidth: 100,
                        maxWidth: 300,
                        autoOpen: true,
                        width: 'auto', resizable: false,
                        buttons: {
                            Yes: function () {
                                $(this).dialog("close");
                                call_ajax_final(value_type,value_category,value_provider,value_place,value_price,value_curr,value_month,limit_screener);
                            },
                            No: function () {
                                $(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            $(this).remove();
                        }
                    });
                }
            }
        }
    })
	function call_ajax_final(value_country,value_ratio,value_issuer,value_structure,value_size,value_style,value_general,value_specific,value_currency,value_price,value_aum){
        $(".summary-table tbody").find("tr").remove();
        $("body").css({'bacground':'#ccc','opacity':'0.8'});
        $("#LoadingImage").show();
        $.ajax({
            url: '<?= admin_url().'ajax' ?>',
            type: 'post',
            data: 'sum_country='+escape(value_country)+'&sum_ratio='+escape(value_ratio)+'&sum_issuer='+escape(value_issuer)+'&sum_structure='+escape(value_structure)+'&sum_size='+escape(value_size)+'&sum_style='+escape(value_style)+'&sum_general='+escape(value_general)+'&sum_specific='+escape(value_specific)+'&sum_currency='+escape(value_currency)+'&sum_price='+escape(value_price)+'&sum_aum='+escape(value_aum),
            async: false,
            success: function(rs){
                    $("body").css({'bacground':'','opacity':'1'});
                    $("#LoadingImage").hide();
                    rs = JSON.parse(rs);
                    var count_column = years.length+3;
                    if(rs.data_error == true){
                        var name = rs.data_name;
                        var code = rs.data_code;
                        var month = rs.data_month;
                        var ytd = rs.data_ytd;
                        var count = name.length-1;
                        for(i=0;i<=count;i++){
                            if(month[i] < 0){
                                month[i] = "<font color='red'>"+month[i]+"</font>";
                            }else{
                                 month[i] = "<font color='green'>"+month[i]+"</font>";
                            }
                            if(ytd[i] < 0){
                                ytd[i] = "<font color='red'>"+ytd[i]+"</font>";
                            }else{
                                 ytd[i] = "<font color='green'>"+ytd[i]+"</font>";
                            }
                            var html = '';
                            html += "<tr>"
                                +"<td style='width:30%; font-weight:bold'><a href='<?= admin_url() ?>observatory#" + code[i] + "' style='color:#3399CC'>" + name[i] + "</a></td>"
                                +"<td style='text-align:right; width:10%'>" + month[i] + "</td>"
                                +"<td style='text-align:right; width:10%'>" + ytd[i] + "</td>";
                            for(var j in years){
                                if(rs.data[years[j]][i] < 0){
                                    rs.data[years[j]][i] = "<font color='red'>"+rs.data[years[j]][i]+"</font>";
                                }else{
                                     rs.data[years[j]][i] = "<font color='green'>"+rs.data[years[j]][i]+"</font>";
                                }
                                html += "<td style='text-align:right; width:10%'>" + rs.data[years[j]][i] + "</td>";
                            }
                            html += "</tr>";
                            $(".summary-table").find("tbody").append(html);
                        }
                    }else{
                        var html = '';
                        html += "<tr>"
                                +"<td colspan='"+count_column+"' style='text-align:center'>No data</td>"
                        html += "</tr>";
                        $(".summary-table").find("tbody").append(html);
                    }
            }
        });
    }	
    function call_ajax(value_country,min_ratio,max_ratio,value_issuer,value_structure,value_size,value_style,value_general,value_specific,value_currency,min_price,max_price,min_aum,max_aum){
        $("body").css({'bacground':'#ccc','opacity':'0.8'});
        $("#LoadingImage").show();
        $.ajax({
            url: '<?= admin_url().'etf_screener/process_step' ?>',
            type: 'post',
            data: 'sum_country='+escape(value_country)+'&min_ratio='+min_ratio+'&max_ratio='+max_ratio+'&sum_issuer='+escape(value_issuer)+'&sum_structure='+escape(value_structure)+'&sum_size='+escape(value_size)+'&sum_style='+escape(value_style)+'&sum_general='+escape(value_general)+'&sum_specific='+escape(value_specific)+'&sum_currency='+escape(value_currency)+'&min_price='+min_price+'&max_price='+max_price+'&min_aum='+min_aum+'&max_aum='+max_aum,
            async: false,
            success: function(rs){
            $("body").css({'bacground':'','opacity':'1'});
            $("#LoadingImage").hide();
                rs = JSON.parse(rs);
                $("#buoc1").html(rs.country);
                $("#buoc2").html(rs.ratio);
                $("#buoc3").html(rs.issuer);
                $("#buoc4").html(rs.structure);
                $("#buoc5").html(rs.size);
                $("#buoc6").html(rs.style);
                $("#buoc7").html(rs.general);
                $("#buoc8").html(rs.specific);
                $("#buoc9").html(rs.currency);
                $("#buoc10").html(rs.price);
                $("#buoc11").html(rs.aum);
            }
        });
    }
    $("div.chb_stf").hide();
    $("ul.fix_boxtxt").hide();
    $("dt").click(function(){
        $(this).next("dd").children("div.chb_stf").toggle();	
        $(this).next("dd").children("ul.fix_boxtxt").toggle();
        return false;
    })
</script>
    </body>
</html>
