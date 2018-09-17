<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
/*
>>author: uzzal
>>email: uzzal.me@gamil.com
website: http://code-empire.blogspot.com
@File: zupload.php
@Description:  This is a utility class for file upload
**
=======================================doc============================================================
At first create an object of class uploader like this example, $uploader=new uploader("test/","doc,txt,jpg");
then set upload propery by calling several available methods like this example, $uploader->setMaxSize();
finall call the upload method like this, $this->zupload->upload();
----------------------------------
Available methods
----------------------------------
make sure the form is similar as line below
//<form enctype="multipart/form-data"  action='action.php' method="post">
getOutputFileName();	//this method must be call after upload() is called.
setRandom()	sets a random number before file name after upload. by default random name is generated.
setMaxSize($size)	define max upload size.
setUploadDir($dir)	defile target dir for upload.
upload($multiple);	upload the file. returns true if success false otherwise. $multiple=true while multiple upload. by default false.
getMsg(); 	return error messages.
setFileInputName($file) call this method before upload() method while uploading multiple file.
delFile($filename,$dir="")	//remove uploaded files
Clean()	//this method should be called after getOutputFileName(); to clean the previous file.
---------multiplefile upload example-----------------------------------
	foreach($_FILES as $file){
		$this->zupload->setFileInputName($file);
		$this->zupload->upload(true);
	}
---------single upload example---------------------------------------------------
	$param['dir']="../uploads/";
	$param['type']="jpg,png,gif";
	$this->load->library('zupload',$param);	
	$this->zupload->upload();
	$this->zupload->getOutputFileName();
======================================================================================================
*/
class Zupload{

var $_uploaddir;
var $_maxfilesize=1024000; //5 mb
var $_random=true;
var $_filetype;
var $_fileinputname;
var $_currentfilename;
var $_currentfiletype;
var $_currentfilesize;
var $_outputfilename;
var $_msg;
var $_ext;


function Zupload($param){	
	$this->_uploaddir=$param['dir'];
	$this->_filetype=$param['type'];	
}

//manage the directory to which file should uploaded.
function setUploadDir($uploaddir){
$this->_uploaddir=$uploaddir;
}

//manage the maximum upload file size.
function setMaxSize($maxfilesize){
$this->_maxfilesize=$maxfilesize;
}

//sets a random number before the file name after upload.
function setRandom($random=false){
$this->_random=$random;
}

//finds the form file input type's name
function getFileInputName(){
	foreach($_FILES as $file=>$info){
		$this->_fileinputname=$file;
		$this->getFileInfo();	
		break; //this break is important.
	}	
}

//sets the form file input type's name[for multiple file upload]
function setFileInputName($file){		
	$this->_fileinputname=$file;
	$this->getFileInfo();		
}

//retrives file info
function getFileInfo(){	
	$this->_currentfilename=$_FILES[$this->_fileinputname]['name'];
	$this->_currentfiletype=$_FILES[$this->_fileinputname]['type'];
	$this->_currentfilesize=$_FILES[$this->_fileinputname]['size'];	
}

//checks for extensions
function isSupportedFile(){
$ext=$this->_filetype;
$extarray=explode(",",$ext);
$currentext=$this->_currentfilename;
$curextarray=explode(".",$currentext);
$curext=strtolower(array_pop($curextarray));
$this->_ext=$curext;
if (in_array($curext,$extarray)) return true;
else return false;
}

function isSupportedSize(){
if($this->_maxfilesize<$this->_currentfilesize)return false;
else return true;
}

function isValidUploadDir(){
$len=strlen($this->_uploaddir);
$ch=substr($this->_uploaddir,$len-1);

if($ch=='/')return true;
else return false;
}

function upload($multiple=false){	//pass $multiple=true while uploading multiple file. see example at top.	
	
	if(!$multiple){	
	$this->getFileInputName();	//finds the form file input type's name
	}
	
	$fileinputname=$this->_fileinputname;
		
	if(!$this->isValidUploadDir()){$this->_uploaddir.="/";}	//correcting the upload path.	
	if(!file_exists($this->_uploaddir)){mkdir($this->_uploaddir,0777,true);} //creates dir if not exists
	if(!$this->isSupportedSize()){
		$this->_msg="File size is larger than <b>". $this->_maxfilesize ." byte</b>. Current file size <b>".$this->_currentfilesize." byte</b>";
		return false;
	}elseif(!$this->isSupportedFile()){
		$this->_msg="File extensions is not supported. Current file type is <b><em>".$this->_currentfiletype."</em></b>";
		return false;
	}else{		
		if($this->_random){
		$random=mt_rand().'_'.time();	//generates random number;
		$uploadfile = $this->_uploaddir .$random.".". $this->_ext;
		$this->_outputfilename=$random.".". $this->_ext;
		}else{
		$uploadfile = $this->_uploaddir . basename($_FILES[$fileinputname]['name']);
		$this->_outputfilename=basename($_FILES[$fileinputname]['name']);
		}

		if (move_uploaded_file($_FILES[$fileinputname]['tmp_name'], $uploadfile)) {
			$this->_msg="The upload completed successfully.";
			return true;
		} else {
			switch($_FILES[$fileinputname]['error']){
	           case 'UPLOAD_ERR_FORM_SIZE': $msg="The file exceeds MAX_FILE_SIZE"; break;
			   case 'UPLOAD_ERR_INI_SIZE': $msg="The file exceeds the upload_max_filesize directive"; break;
			   case 'UPLOAD_ERR_NO_FILE': $msg="The browser didn't send a file"; break;
			   case 'UPLOAD_ERR_PARTIAL': $msg="The browser did not complete the upload"; break;
			   default: $msg="Unknown error occured !!!";
	        }	
			$this->_msg=$msg;
			return false;
		}
	}
}


function getOutputFileName(){	
	return $this->_outputfilename;
}

function Clean(){
$this->_outputfilename="";
}

function getMsg(){
return $this->_msg;
}

//delete any file given in $filename in $dir if success return true and false otherwise
function delFile($filename,$dir=""){
	if($dir==""){
		$dir=$this->_uploaddir;
	}	
	
	$len=strlen($dir);
	$last_char=substr($dir,$len-1,$len);
	
	if($last_char=='/'){
		$dir=substr($dir,0,$len-1);
	}
	
	if($filename==""){
		$this->_msg="Error !!!: File name expected.";
		return false;
	}else{
		$filename=$dir."/".$filename;
		if (file_exists($filename)) {	    
			if(unlink($filename)){
				$this->_msg="The file $filename successfully removed!!!";
				return true;
			}else{
				$this->_msg="The file $filename can't removed.";
				return false;
			} 
		} else {
		    $this->_msg="The file $filename does not exist";
			return false; 
		}
	}
}



}//class
?>