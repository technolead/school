<?php
   $file=$_REQUEST['file'];
   $content=$_REQUEST['content'];
   if (get_magic_quotes_gpc()) {
	  $content = stripslashes($content);
   }
   
   if(!empty($file) && !empty($content))
    {
			 if (is_writable($file)) {
				$handle = fopen($file, 'w');
			    fwrite($handle, $content);
				fclose($handle);
				echo "2";
			
			} else {
				echo "1"; //file is not writeable
			}

	}
?>