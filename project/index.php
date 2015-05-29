<?php
	define('true-access',true);
	include("lib/layout.php");
	include("lib/tools.php");

	ob_start();
	session_start();

	layoutTitleStart("Bloggies");
	layoutStyles("./content/css/");
	layoutTitleEnd();
	layoutH1("BLOGGIES");
	layoutH2("Read bloggies here!");
	print "<h4><a href=\"./admin/admin.php\"> Click here for submitting a new entry </a></h4>".PHP_EOL;

	/*
	* We print the last 5 blog entries
	*/
	$pathBlogs = "./content/blogs/";
	$lastBlogNumber = getLastBlogNumber($pathBlogs);
	if(isset($lastBlogNumber)) {
	
		for($i = $lastBlogNumber; $i > ($lastBlogNumber - 5); $i--) {
			
			$linkTag = "bloglink".$i;
			
			//check if the user clicked on any link
			if(isset($_GET[$linkTag])) {
				$_GET[$linkTag] = NULL;
				
				//redirect to one-blog webpage				
				$_SESSION["blogIndex"] = $i;
				
				//we don't want to increment the number of visits after a redirection!
				$_SESSION['userVisits']--;
				
				header("location: blog.php");
			}
			
			$pathCurrentBlog = "./content/blogs/blog".$i."/blog".$i.".txt";
			$pathTitle = "./content/blogs/blog".$i."/title".$i.".txt";
			$title = file_get_contents($pathTitle);
			if(getImgPath("./content/blogs/blog".$i."/", $i) != NULL) {
				$pathImage = getImgPath("./content/blogs/blog".$i."/", $i);
			} else {
				$pathImage = NULL;
			}
			
			//print the name of the blog with a link
			//each link has an unique $_GET tag
			print "<h3><a href=\"index.php?".$linkTag."\"> ".$title." </a></h3>".PHP_EOL;
			print "<div>".PHP_EOL;
			if(isset($pathImage)) {
				print "<br>".PHP_EOL;
				printImage($pathImage);
				print "<br>".PHP_EOL;
			}
			printFile($pathCurrentBlog);
			print "</div>".PHP_EOL;
			print "<br>".PHP_EOL;
			print "<br>".PHP_EOL;
			print "<br>".PHP_EOL;
			
		}
		
	}


	layoutFooter();
	layoutEnd();

	ob_end_flush();

?>