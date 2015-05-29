<?php

	define('true-access',true);
	include("lib/layout.php");
	include("lib/tools.php");

	ob_start();
	session_start();
	
	//
	//Prints a blog depending on the index "blogIndex"
	//this index is changed in other webpages
	//
	if(isset($_SESSION["blogIndex"])) {
		
		$index = $_SESSION["blogIndex"];
		$pathBlog = "./content/blogs/blog".$index."/blog".$index.".txt";
		$pathTitle = "./content/blogs/blog".$index."/title".$index.".txt";
		
		if(isset($_SESSION["imageFailure"]) && $_SESSION["imageFailure"] == false) {
			print "<p> IMAGE UPLOAD FAILED! SUBMITTED FILE WAS NOT AN IMAGE </p>";
			$_SESSION["imageFailure"] = true;
		}
		
		if(getImgPath("./content/blogs/blog".$index."/", $index) != NULL) {
			$pathImage = getImgPath("./content/blogs/blog".$index."/", $index);
		} 
		
		$title = file_get_contents($pathTitle);
		layoutTitleStart("Blog: ".$title);
		layoutStyles("./content/css/");
		layoutTitleEnd();
		layoutH1("BLOGGIES");
		layoutH2($title);
		print "<h4><a href=\"index.php\"> Home </a></h4>".PHP_EOL;
		
		print "<div>".PHP_EOL;
		printFile($pathBlog);
		if(isset($pathImage)) {
			printImage($pathImage);
		}
		print "</div>".PHP_EOL;
	} else {
		layoutStart("No blog was found");
		layoutHeader("BLOGGIES");
		layoutPageName("NO BLOG WAS FOUND");
	}

	layoutFooter();
	layoutEnd();

	ob_end_flush();
?>