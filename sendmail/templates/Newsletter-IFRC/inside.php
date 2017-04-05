<?php
    $email_articles = getArticleByCodeCategory('email_articles');
	//print_r($email_articles);
    foreach($email_articles as $key=>$value)
    {
?>
<head>
        <meta charset='UTF-8' />
    </head>
<table style="border-bottom:1px dashed #CCCCCC; display:block; padding-bottom:10px" width="100%">
	<tbody>
		<tr>
			<td colspan="2">
				<h2 style="color:#F69B27;font-size:16px;"><?php echo $value['title'] ?></h2>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<?php
					if($value['image'] != "assets/images/no-image.jpg"){
				?>
				<img height="" src="<?php echo PARENT_URL . $value['image'] ?>" width="160" /><!--height: 230-->
				<?php
					}
				?>
            </td>
			<td valign="top">
				<table style="padding-left:10px;" width="100%">
					<tbody>
						<tr>
							<td valign="top">
								<h3 style="color:#007DC9;font-size:14px;"><?php echo strip_tags($value['description']) ?></h3>
							</td>
						</tr>
						<tr>
							<td>
                                <?php echo html_entity_decode(htmlspecialchars($value['long_description'])); ?>
 
                            </td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<?php } ?>
