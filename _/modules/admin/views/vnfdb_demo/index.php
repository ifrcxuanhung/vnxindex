<style type="text/css">
.block-controls-2 {
    background: -moz-linear-gradient(center bottom , white, #E5E5E5 88%, #D8D8D8) repeat scroll 0 0 transparent;
    border-top: 1px solid #999999;
    margin: 10px -1.667em 0 -1.667em;
    padding: 1em;
    text-align: right;
}

.fx_bt_indi_2{
    float: left;
    margin-right: 20px;
    margin-top: -5px;
    position: relative;
    z-index: 200;
}

#submit{
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: -moz-linear-gradient(center top , white, #72C6E4 4%, #0C5FA5) repeat scroll 0 0 transparent;
    border-color: #50A3C8 #297CB4 #083F6F;
    border-image: none;
    border-radius: 0.333em 0.333em 0.333em 0.333em;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 1.167em;
    font-weight: bold;
    line-height: 1.429em;
    padding: 0.286em 1em 0.357em;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
}
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" action="" method="post">
            <h1><?php trans('mn_vnfdb_demo'); ?></h1>
            <div class="block-content fx_pdd">
                <!--h1>Database</h1-->
                <div class="infos fx_pd_bot">
                    <h2 class="fx_pd_tle "><?php trans('title_vnfdb_demo') ?></h2>
                </div>
                <div class="block-controls">

                </div>
                <p class="grey"> </p>
                <dl class="accordion">
                    <dt><span class="number">1</span>Documentation</span></dt>
                    <dd>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua    
                    </dd>
                    <dt><span class="number">2</span>Data</span></dt>
                    <dd>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua    
                    </dd>
                    <dt><span class="number">3</span>Methodology & Test</span></dt>
                    <dd>
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua   
                    </dd>
                    <dt><span class="number">4</span>Calculation</span></dt>
                    <dd>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua    
                    </dd>
                    <dt><span class="number">5</span>Results</span></dt>
                    <dd>
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua   
                    </dd>
                </dl>
                <div class="block-controls-2">
                    <div class="fx_bt_indi">
                        <a href="<?= admin_url() ?>vnfdb_demo/step_by_step" id="submit">Next</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>