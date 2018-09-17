<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit HTML file online</title>
<script type="text/javascript" src="jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.js"></script>
<script type="text/javascript" src="filetree/jqueryFileTree.js"></script>
<link rel="stylesheet" href="filetree/jqueryFileTree.css" type="text/css" media="screen"> 
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen"> 

<script type="text/javascript">
$(document).ready(function() { 
						   
       $("#open_file").fancybox({ 'zoomSpeedIn': 300, 'zoomSpeedOut': 300, 'overlayShow': true,'centerOnScroll':true,'enableEscapeButton':true,
		  'callbackOnShow':openFilesList,'hideOnContentClick':false,'hideOnOverlayClick':false});
  
      
   });

	function openFilesList()
	{
		
		$('#fileTree').fileTree({
        root: '../',
        script: 'jqueryFileTree.php',
        expandSpeed: 1000,
        collapseSpeed: 1000,
        multiFolder: false
          }, function(file) {
             ajaxLoad(file);
         });
	}

	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "content",
		theme : "advanced",
		width : "950",
		height: "400",
		plugins : "fullpage,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,codeprotect",
        //content_css : "css.php",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,fullscreen",
	theme_advanced_buttons2 : "undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",
	theme_advanced_buttons3 : "moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,fullpage,|,print,|,ltr,rtl",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		file_browser_callback : "ajaxfilemanager",
		theme_advanced_resizing : true,
		 forced_root_block : false,
        force_br_newlines : true,
        force_p_newlines : false,
		relative_urls : false,
        remove_script_host : false,
        document_base_url : "<?php echo "http://".$_SERVER['HTTP_HOST']."/";?>",
		valid_elements : "*[*]",
        extended_valid_elements : "*[*]",
     	// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	
	function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
		}
		
		function ajaxLoad(file) {
			var ed = tinyMCE.get('content');
		    $('#fileTree').fancybox.close();
			// Do you ajax call here, window.setTimeout fakes ajax call
			ed.setProgressState(1); // Show progress
			window.setTimeout(function() {
				
				
			}, 3000);
			
			$.ajax({
			   type: "POST",
			   url: "getFile.php",
			   cache: false,
			   data: "file="+file,
			   success: function(file_content){
				 ed.setProgressState(0); // Hide progress
				 ed.setContent(file_content);
				 tinyMCE.get('content').dom.loadCSS('<?php echo "http://".$_SERVER['HTTP_HOST']."/SmartEdit/";?>css.php?file='+file+'&discriminator='+Math.random());
				 document.getElementById('file_name_id').value=file;
			   }
			 });
			
			
      }

function ajaxSave() {

   if(document.getElementById('file_name_id').value=="")
   {
     alert("There is no file to save");
   }
  else
  {
	    var ed = tinyMCE.get('content');
		var file = document.getElementById('file_name_id').value;
        var content=ed.getContent();
		//alert(file);
	//	alert(content);
		// Do you ajax call here, window.setTimeout fakes ajax call
		ed.setProgressState(1); // Show progress
		$.ajax({
			   type: "POST",
			   url: "putFile.php",
			   cache: false,
			   data:({'file':file,'content':content}),
			   success: function(result){
				 ed.setProgressState(0); // Hide progress
				 if(result=='1')
				 alert('Error:: File is not writelable');
				 if(result=='2')
				 alert('File has been saved!');
				 
				 ed.setProgressState(0); // Hide progress
			   }
			 });
	
	}
}

</script>
</head>
<body>

<table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="130" align="left" valign="top" style="padding-left:25px"><a id="open_file" href="jqueryFileTree.php" style="color:#990000;font-size:12px;text-decoration:none"><img border="0" src="editor-images/folder_open.png" align="absmiddle" />&nbsp;<strong>Open a file</strong></a></td>
	 <td width="820" align="left" valign="top"><a href="javascript:ajaxSave()" style="color:#990000;font-size:12px;text-decoration:none"><img border="0" src="editor-images/directory.png" align="absmiddle" />&nbsp;<strong>Save</strong></a></td>
  </tr>
</table><br />
<div id="file_tree"></div>
<table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" align="center"><textarea name="content" id="content"><?php echo $content?></textarea></td>
  </tr>
</table>
<input id="file_name_id" type="hidden" name="file_name" value="" />
</body>
</html>
