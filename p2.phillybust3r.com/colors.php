<?
/*-------------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------------*/
function print_colors($filename) {
	
		$file   = $_SERVER['DOCUMENT_ROOT'].$filename;
		$handle = fopen($file, "rb");
		$colors = fread($handle, filesize($file));	
		$colors = explode(";", $colors);
				
		foreach($colors as $color_info) {
			
			if($color_info) {
			$color = explode("#", $color_info);
			$color = $color[1];
			echo "<div style='font-size:12px; width:200px; font-family:arial; padding:5px; margin:6px; background-color:".$color."'>".$color_info."</div>";
			}
		}
		
		fclose($handle);
		
}

# Use
print_colors("/in-class/html-crash-course/css/colors.less");

?>
