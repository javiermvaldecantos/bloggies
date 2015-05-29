<?php

	define('true-access',true);
	include("../lib/layout.php");
	include("../lib/tools.php");

	ob_start();
	session_start();

	layoutTitleStart("Submit Bloggie");
	layoutStyles("../content/css/");
	layoutTitleEnd();
	layoutH1("BLOGGIES");
	layoutH2("Write your own Bloggie!");
	print "<h4><a href=\"../index.php\"> Home </a></h4>".PHP_EOL;
	
	/*
	* Store the blog and its title in our directory
	*/
	$pathBlogs = "../content/blogs/";
	$lastBlogNumber = getLastBlogNumber($pathBlogs);
	
	if(isset($_POST["submitBlog"])) {
		
		//we don't want to increment the number of visits after a redirection!
		$_SESSION['userVisits']--;
		
		if (empty($_POST["title"]) && empty($_POST["blog"])) {
		
			print "<p> UPLOAD FAILED! BLOG TITLE AND ENTRY ARE MISSING</p>";
			
		} else if (empty($_POST["title"])) {
		
			print "<p> UPLOAD FAILED! BLOG TITLE IS MISSING</p>";
			
		} else if (empty($_POST["blog"])) {
		
			print "<p> UPLOAD FAILED! BLOG ENTRY IS MISSING</p>";
			
		} else {
			//first of all we create a new directory
			mkdir("../content/blogs/blog".($lastBlogNumber + 1)."/");
		
			$pathNewTitle = "../content/blogs/blog".($lastBlogNumber + 1)."/title".($lastBlogNumber + 1).".txt";
			newFile($pathNewTitle, $_POST["title"]);
			
			$pathNewBlog = "../content/blogs/blog".($lastBlogNumber + 1)."/blog".($lastBlogNumber + 1).".txt";
			newFile($pathNewBlog, $_POST["blog"]);
			
			
			//if the user entered an image with the blog, we'll store it
			if(getImageType($_FILES["image"]["type"]) != NULL) {
			
				$imageExtension = getImageType($_FILES["image"]["type"]);
				$pathNewImage = "../content/blogs/blog".($lastBlogNumber + 1)."/img".($lastBlogNumber + 1).$imageExtension;
				
				if(!file_exists($pathNewImage)) {
					touch($pathNewImage);
				}
					
				move_uploaded_file($_FILES["image"]["tmp_name"], $pathNewImage);
				$_SESSION["imageFailure"] = true;
					
			} else if ($_FILES["image"]["error"] == 4) {
				//no image was submitted ==> do nothing
			} else {
				//file submitted was not an image ==> modify variable used in blog.php
				$_SESSION["imageFailure"] = false;
			}
			
			$_SESSION["blogIndex"] = $lastBlogNumber + 1;
			header("Location: ../blog.php");
		}
		
	}
	
	/*
	* Form to submit blog entries
	*/
	print "<form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">                                  ".PHP_EOL;
	print "Title: <input name=\"title\" type=\"text\" placeholder=\"enter your title\"></input><br>            ".PHP_EOL;
	print "<br>Upload an image for your entry if you wish: <input name=\"image\" type=\"file\"></input><br>    ".PHP_EOL;
	print "<br><label>Blog entry:</label><br>                                                                  ".PHP_EOL;
	print "<textarea name=\"blog\" rows=\"10\" cols=\"100\" placeholder=\"type your blog here\"></textarea><br>".PHP_EOL;
	print "<input name=\"submitBlog\" type=\"submit\" value=\"Upload Bloggie\"></input>                        ".PHP_EOL;
	print "</form>                                                                                             ".PHP_EOL;
	print "<br>".PHP_EOL;
	print "<br>".PHP_EOL;
	print "<br>".PHP_EOL;
	print "<br>".PHP_EOL;
	
	layoutFooter();
	layoutEnd();

	ob_end_flush();

?>