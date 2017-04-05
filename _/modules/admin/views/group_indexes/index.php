<?php
    foreach($info as $item){
        $data_type[] = $item['type'];
    }
    $data_type_uni = array_unique($data_type);
    foreach($data_type_uni as $type){
        foreach($info as $item){
            if($item['type'] == $type){
                $data_final[$type][] = $item;
            }
        }
    }
    foreach($data_final as $key => $value){
?>
        <section class="grid_2 <?= $value[0]['class'] ?>">
            <div class="block-border">
            <div class="block-content">
                <h1><?= $key ?></h1>
                    <?php
                        foreach($value as $row){
                    ?>
                            <ul class="no-margin">
                                <h4 class="hd_tl_gr_idx pd_fix">
                                    <?php
                                        if($row['link'] != ''){
                                            echo "<a href='".admin_url().$row['link']."'>".$row['name']."</a>";
                                        }else{
                                            echo $row['name'];
                                        }
                                    ?>
                                </h4>
                                <li class="pd_fix cl_li_nrml"><span class="cl_sp_fix">&bull;&nbsp;
                                    <?php
                                    if($key != "Equities" && $key != "Commodities" && $key != "Bond"){
                                        echo "Code:";
                                    }else{
                                        echo "Stock:";
                                    }
                                    ?> 
                                </span>
                                    <?php
                                        if($row['stocks'] != 0){
                                            echo number_format($row['stocks']);
                                        }else{
                                            echo 'No Data';
                                        }
                                    ?>
                                </li>
                                <li class="pd_fix cl_li_nrml"><span class="cl_sp_fix">&bull;&nbsp;&nbsp;Entries: </span>
                                    <?php
                                        if($row['entries'] != 0){
                                            echo number_format($row['entries']);
                                        }else{
                                            echo 'No Data';
                                        }
                                    ?>
                                </li>
                                <li class="pd_fix cl_li_nrml"><span class="cl_sp_fix">&bull;&nbsp;&nbsp;From: </span>
                                    <?php
                                        if($row['from'] != '0000-00-00' && $row['from'] != ''){
                                            echo $row['from'];
                                        }else{
                                            echo 'No Data';
                                        }
                                    ?>
                                </li>
                            </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </section>
<?php
    }
?>