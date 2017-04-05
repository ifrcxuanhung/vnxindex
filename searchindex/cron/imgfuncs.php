<?php
                    include_once('simple_html_dom.php');
                    $target_url = "$thislink";
                    $html = new simple_html_dom();
                    $html->load_file($target_url);
					$imgnum = 0;
                    foreach($html->find('img') as $img)
                    {
                    $src = $img->src;
                    $width = $img->width;
                    $height = $img->height;
                    $alt = $img->alt;
					$imgnum = $imgnum;
				
					$imgnum++;
					
					//gather if img is full url
					
					$str = substr($src, 0, 5);
					
					if (($str =='http:') && ($width !='') && ($height!='') && ($alt!=''))  {
					//img is full url so continue
                 
                         
					//check img is big enough
					if ($width >30) {
						
						//check if img is currently indexed
						$qry = "SELECT * FROM imgs WHERE imgUrl='$src' AND alt='$alt'";
                        $qryres = mysql_query($qry);
					    $imgrows = mysql_num_rows($qryres);
					    if ($imgrows < 1) {
							//we have less than one of this image so index
							
							
					
					
					?>
					<table width="100%" cellpadding="5" cellspacing="5" border="1">
<tr>
<td width="60%">
<?php 
echo "$img";
?>
</td>
<td valign="top">
<?php echo "<br />$src<br />Width-$width<br />H-$height<br />Alt=$alt<br />$Img Number $imgnum<br />Indexed $indexedimg<br /><br />"; ?>
<table width="200" border="1">
                    <tr>
                    <td width="100"></td>
                    <td>
                    <div id='<?php echo "$num$imgnum"; ?>'>
                    <?php
					$blockedqry = "SELECT url FROM ".$mysql_table_prefix."removedimgs WHERE url='$src'";
                    $blockedres = mysql_query($blockedqry);
					$rows = mysql_num_rows($blockedres);
					if ($rows == 1) {
					echo "<b>Banned</b>";	
					}
					?>
  
                    </div>
 <?php
 if ($rows !=1) {
	 //we need to add img
	 $sql = "INSERT INTO imgs (imgUrl,width,height,alt) VALUES ('$src', '$width', '$height','$alt')";
	 $result = mysql_query($sql);
	 
 }
 
 ?>                   
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php 
						}}}//close if url is not http:

}//close for each img

?>