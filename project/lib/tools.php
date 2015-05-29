<?php

	/*
	* Useful functions that we will use
	*/

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}
	
	//
	//Scans our directory and gets the number of the last blog entry
	//
	function getLastBlogNumber($path) {
		$lastBlogNumber = 0;
		
		if(file_exists($path)) {
			$allBlogs = scandir($path);
			
			foreach($allBlogs as $blog) {
				if(isset($blog[4])) {	//if the element $blog is a blog
					$lastBlogNumber++;	//we increment the count
				}
				
			}
			
			return $lastBlogNumber;
			
		} else {
			print "<p> FILE NOT FOUND </p>".PHP_EOL;
			return NULL;
		}
	}
	
	//
	//gets the complete path of an image file, including the extension
	//given its index number and the directory
	//
	function getImgPath($directory, $index) {
		
		$allData = scandir($directory);
		
		$imgName = "img".$index;
		foreach($allData as $file) {
			//we separate the file name from the extension
			$fileNameAndExtension = explode(".", $file);
			
			if($fileNameAndExtension[0] == $imgName) {
				$imgPath = $directory.$file;
				return $imgPath;
			}
		}
		return NULL;
	}

	//
	//Print the content of a file
	//
	function printFile($path) {
		if(file_exists($path)) {
			$completeText = file($path);
			foreach($completeText as $line) {
				print $line."<br>".PHP_EOL;
			}
		} else {
			print "<p> FILE NOT FOUND </p>".PHP_EOL;
		}
	}
	
	function printImage($path) {
		if(file_exists($path)) {
			print "<img src=\"$path\" >".PHP_EOL;
		} else {
			print "<p> ".$path." </p>".PHP_EOL;
			print "<p> FILE NOT FOUND </p>".PHP_EOL;
		}
	}
	
	//
	//Creates a new file and puts data inside
	//
	function newFile($path, $data = NULL) {
		if(file_exists($path)) {
			print "<p> FILE ALREADY EXISTS </p>".PHP_EOL;
		} else {
			touch($path);
			
			if(isset($data)) {
				file_put_contents($path, $data, FILE_APPEND | LOCK_EX);
			} else {
				print "<p> NO DATA </p>";
			}
			
		}
	}
	
	
	//
	//gets the extension of an image file in string format
	//
	function getImageType($extension = NULL) {
		if(isset($extension)) {
			$result = NULL;			
			$imageExtensions = array("image/jpeg", "image/jpg", "image/png", "image/pjpeg", "image/x-png", "image/gif");
			foreach($imageExtensions as $ext) {
				if($extension == $ext) {
					$result = substr($extension, 6);
					return ".".$result;
				}
			}
			return $result;
		} else {
			return NULL;
		}
	}
	
?>