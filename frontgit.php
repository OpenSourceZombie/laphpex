<?php
class laphpex{

###############
#Class Members#
###############
private $path;			//path to store output files tex,dvi,etc...
private $titleName;		//name of the title in the page
private $contentName;		//name of the content in the page
private $errorName;		//name of the error div WARNNING:use it only if the html and the php are in the same document
private $flag;			//check write permissions

#############
#Constructor#
#############
public function __construct($path,$title,$content,$error="")
{
	$this->path=$path;$this->titleName=$title;$this->contentName=$content;$this->errorName=$error;
}

##################
#Public functions#
##################
public function build()
{
$title=$_POST[$this->titleName];	//get title from the from
$content=$_POST[$this->contentName];	//get content
if(!file_exists($this->path."/$title.tex")){		//check if the file exists or not if not -> create new
	exec("touch $this->path/$title.tex");
	$this->writeToFile("$this->path/$title.tex",$content,'w'); //call the write $content to a .tex file
	exec ("cd $this->path; latex $title.tex");		//cd into $path and create dvi and log file

		if(file_exists("$this->path/$title".".dvi")){		//check if the .dvi exist ie no errors
			exec ("cd $this->path;dvipdfm  $title".".dvi");
			echo "<a href='$this->path/$title.pdf'> click here to download</a>";	//send the link to download
		}else
			echo "<p   onclick='showErrors($title)'> click here to view errors </p>";	/will only work if and only if the html and the php are in the same .php file
}else 
	echo "document already exists"; //if the file already exist
}

###################
#Private functions#
###################
private function writeToFile($path,$string,$options)
{
	$con=fopen($path,$options);
	fwrite($con,$string);
	fclose($con);
}
}
?>



