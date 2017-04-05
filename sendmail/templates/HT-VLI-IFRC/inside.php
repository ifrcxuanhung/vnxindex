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
