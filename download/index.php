<?php
include_once('config/db.php');
$dir = dirname(__FILE__);


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' />
        <title>Title Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="" rel="icon"/>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
        <script src="js/jquery-1.8.0.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            var BASE_URL = '<?php echo BASE_URL?>';
        </script>
    </head>
    <body>
    <div class="container">
        <h1 class='header'>DEMO</h1>
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<span>Câu truy vấn</span>
				<textarea onkeyup="updateQueryToResult(this.value)" class="form-control input_query" type='text' name='sql_query'></textarea>
			</div>
        </div>
        <div class="row mgt20">
            <div class="col-xs-12 col-md-8">
                <p class="result_query"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <input type='button' class="btn btn-primary" name='excute_query' value='Tính'/>
            </div>
        </div>
        <div class="row mgt20">
            <ul class="col-xs-12 col-md-8 view_file_download">
                <?php
                    foreach(glob('file/*.*') as $filename){
                        $link = BASE_URL . $filename;
                        $filename = str_replace('file/', '', $filename);
                        echo "<li><a href='$link'>$filename</a></li>";
                    }
                ?>
            </ul>
        </div>
    </div>
    
    </body>
</html>
        