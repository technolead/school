<?php
  function getAbsContents($text)
	{
	    
		 $base="http://".$_SERVER['HTTP_HOST']."/";
		  //@link
		  $pattern = "/<a([^>]*) href=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<a\${1} href=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text);
		  
          //LINK
		  $pattern = "/<A([^>]*) HREF=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<A\${1} HREF=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text);
		
		  //image
		  $pattern = "/<img([^>]*) src=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<img\${1} src=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		  //IMAGE
		  $pattern = "/<IMG([^>]*) SRC=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<IMG\${1} SRC=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		
		  //js
		  $pattern = "/<script([^>]*) src=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<script\${1}    src=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		  //JS
		  $pattern = "/<SCRIPT([^>]*) SRC=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<SCRIPT\${1}    SRC=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		
		  //link css
		  $pattern = "/<link([^>]*) href=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<link\${1}    href=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		  //LINK CSS
		  $pattern = "/<LINK([^>]*) HREF=\"(?!http|ftp|https)([^\"]*)\"/";
		  $replace = "<LINK\${1}    HREF=\"" . $base . "\${2}\"";
		  $text = preg_replace($pattern, $replace, $text); 
		   
		
		  $text= str_replace(array($base.'../',$base.'../../',$base.'../../../',$base.'../../../../',$base.'../../../../../',$base.'../../../../../../',$base.'../../../../../../../',$base.'../../../../../../../../',$base.'../../../../../../../../../',$base.'../../../../../../../../../../',$base.'../../../../../../../../../../../',$base.'./',$base.'//'),array($base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'',$base.'/'),$text);				
			
		  return $text;

	}
	
	
	
   $file=$_REQUEST['file'];
   $content="";
   if(!empty($file) && file_exists($file))
   $content=file_get_contents($file);
   
   echo $content;
   //echo getAbsContents($content);
?>