<article class="container_12">
    <section class="grid_4">
        <div class="block-border">
            <div class="block-content">

                <h1>Services</h1>
                <div class="block-controls">
                    <ul class="controls-buttons">
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div id="loading"><img src="<?php echo base_url() . 'assets/images/loading.gif'; ?>" /></div>
                <ul class="collapsible-list with-bg with-icon">
                        <?php
                        if(isset($list_service) && is_array($list_service) && count($list_service)>0){
                            foreach ($list_service as $key => $value) {
                                ?>
                                <li class="article-detail" >
                                    <a href="JavaScript: void(0)"><?php echo $key ?></a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                </ul>
            </div>
        </div>
    </section>
    <div id="reponse-detail">
        <section class="grid_8">
            <div class="block-border" id="content">
                <div class="block-content upper-index no-padding">
                    <div class="h1"><h1>User Guider</h1></div>
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li><br></li>
                        </ul>
                    </div>
                </div>
                <div class="block-content no-title fix_help">
                    <h2 class="bigger">Presentation</h2>
                    <p>
 
                    </p>
                </div>
            </div>
        </section>
    </div>
</article>