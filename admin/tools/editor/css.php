<?php ob_start();
$absolute="http://".$_SERVER['HTTP_HOST']."/";
function relative2absolute($relative) {
     global $absolute;
        
        $p = @parse_url($relative);
        if(!$p) {
	        //$relative is a seriously malformed URL
	        return false;
        }
		
		
        if(isset($p["scheme"])) return $relative;
 
        $parts=(parse_url($absolute));
 
      
        if(substr($relative,0,1)=='/') 
		{
           
			$cparts = (explode("/", $relative));
            array_shift($cparts);
			
        } 
	   else 
	   {
            if(isset($parts['path']))
			{
                 $aparts=explode('/',$parts['path']);
                 $item=array_pop($aparts);
				 if(!empty($item))       //if not empty, need to recheck so a directory  not remove
				 {
				   $ext= substr(strrchr($item, "."), 1);
				   if(empty($ext))array_push($aparts,$item);
				 }
                 $aparts=array_filter($aparts);
            } 
		  else
		   {
                 $aparts=array();
           }
		   
           $rparts = (explode("/", $relative));
		  
		   
          // $cparts = array_merge($aparts, $rparts);

		   $needs=array();
		   
           foreach($rparts as $i => $part)
		    {
					if($part == '.') 
					{
						continue;
					}
				   elseif($part == '..') 
					{
						@array_pop($aparts);;
					}	 
				   else
				   {
					   $needs[]=$part;
					   
					}
             }
		  $cparts=array_merge($aparts, $needs);	 
        }
	
		
		
		$path = (implode("/", $cparts));
		
 
        $url = '';
        if($parts['scheme']) {
            $url = "$parts[scheme]://";
        }
        if(isset($parts['user'])) {
            $url .= $parts['user'];
            if(isset($parts['pass'])) {
                $url .= ":".$parts['pass'];
            }
            $url .= "@";
        }
        if(isset($parts['host'])) {
            $url .= $parts['host']."/";
        }
        $url .= $path;
 
        return $url;
}
   
   function extract_css_urls( $text )
	{
		$urls = array( );
		$url_pattern     = '(([^\\\\\'", \(\)]*(\\\\.)?)+)';
		$urlfunc_pattern = 'url\(\s*[\'"]?' . $url_pattern . '[\'"]?\s*\)';
		$pattern         = '/(' .
			 '(@import\s*[\'"]' . $url_pattern     . '[\'"])' .
			'|(@import\s*'      . $urlfunc_pattern . ')'      .
			'|('                . $urlfunc_pattern . ')'      .  ')/iu';
		if ( !preg_match_all( $pattern, $text, $matches ) )
			return $urls;
	 
		// @import '...'
		// @import "..."
		foreach ( $matches[3] as $match )
			if ( !empty($match) )
				$urls['import'][] = 
					preg_replace( '/\\\\(.)/u', '\\1', $match );
	 
		// @import url(...)
		// @import url('...')
		// @import url("...")
		foreach ( $matches[7] as $match )
			if ( !empty($match) )
				$urls['import'][] = 
					preg_replace( '/\\\\(.)/u', '\\1', $match );
	 
		// url(...)
		// url('...')
		// url("...")
		foreach ( $matches[11] as $match )
			if ( !empty($match) )
				$urls['property'][] = 
					preg_replace( '/\\\\(.)/u', '\\1', $match );
	 
		return $urls;
	}		


     
		 $file=$_REQUEST['file'];
		 
		 
         if(!empty($file) && file_exists($file))
		 {
				 $page_content=file_get_contents($file);
				 
				 
				 preg_match_all('|<style[^>]*?>(.*?)</style>|si',$page_content,$matches);
				 $css_url			=extract_css_urls($page_content);
				
				 if(is_array($matches[1]))
				 {
					 foreach($matches[1] as $css)
					 {
					   if(!strpos($css,"@import") && !strpos($css,"@ import"))
					   echo $css;
					 }
				 }
				
				
				
				
				
				preg_match_all('~<link[^>]+(?:\s*(?:href="([^"]+)"|type="text/css"|rel="stylesheet")\s*){3}[^>]*>~',$page_content,$matches_css);
				
				 if(is_array($matches_css[1]))
				 {
				   foreach($matches_css[1] as $css_file)
					 {
					   $url=relative2absolute($css_file);
					   echo @file_get_contents($url);
					 }
				 }  
		
			   
		
				if(is_array($css_url['import']))
				{ 
					 foreach($css_url['import'] as $rel)
					 {
					   //rel_to_abs($rel,$baseurl)
					   
					   $url=relative2absolute($rel);
					   echo @file_get_contents($url);
					 }
				} 
				
			}
			
	   $out = ob_get_contents();
	   ob_end_clean();
	   $out=str_replace('url(','url('.$absolute,$out);
	   
	   $out= str_replace(array($absolute.'../',$absolute.'../../',$absolute.'../../../',$absolute.'../../../../',$absolute.'../../../../../',$absolute.'../../../../../../',$absolute.'../../../../../../../',$absolute.'../../../../../../../../',$absolute.'../../../../../../../../../',$absolute.'../../../../../../../../../../',$absolute.'../../../../../../../../../../../',$absolute.'./',$absolute.'//'),array($absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'',$absolute.'/'),$out);
	   
	   $out=str_replace(array('@charset "utf-8";','<!--','-->'),array('','',''),$out);
	   echo $out;	

?>