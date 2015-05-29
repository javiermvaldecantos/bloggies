<?php

	/*
	* Common layout elements that all our pages will have
	*/

	//
	//to avoid direct access
	//
	if(!defined('true-access')) {
		die('Direct access not permitted');
	}

	//
	//start of the page and title
	//
	function layoutTitleStart($title = NULL) {

		print "<!DOCTYPE html>         ".PHP_EOL;
		print "<html>                  ".PHP_EOL;
		print "<head>                  ".PHP_EOL;
		print "<meta charset=\"utf-8\">".PHP_EOL;
		
		if(isset($title)) {
			print "<title> ".$title." </title>".PHP_EOL;
		}
	}
	
	function layoutStyles($stylesPath = NULL){
		if(isset($stylesPath)){
			print '<link rel="stylesheet" href="'.$stylesPath.'layout.css" type="text/css">  '.PHP_EOL;
		}
	}
	
	function layoutTitleEnd(){	
		print "</head>                 ".PHP_EOL;
		print "<body>                  ".PHP_EOL;
	}


	//
	//main header shared by all the pages of our website
	//
	function layoutH1($header1 = NULL) {
		if(isset($header1)) {
			print "<h1> ".$header1." </h1>".PHP_EOL;
		}
	}


	//
	//second header that displays the name of the page
	//
	function layoutH2($header2 = NULL) {
		if(isset($header2)) {
			print "<h2> ".$header2." </h2>".PHP_EOL;
		}
	}


	//
	//Footer that displays the number of times users have visited our site
	//
	function layoutFooter() {
		//session_start();
		
		if(isset($_SESSION['userVisits'])) {
			$_SESSION['userVisits']++;
		} else {
			$_SESSION['userVisits'] = 1;
		}
		
		if(isset($_POST['resetButton'])) {
			$_SESSION['userVisits'] = 0;
			$_POST['resetButton'] = NULL;
			header("Location: ".$_SERVER['PHP_SELF']);	//to avoid form resubmission pop-up
		}												//we redirect the user to our page again
		
		$visits = $_SESSION['userVisits'];
		print "<a id=\"bottom\"></a>".PHP_EOL;
		print "<footer>                                                            ".PHP_EOL;
		if ($visits > 1) {
			print "<p> In this session, you've visited our site ".$visits." times. </p>".PHP_EOL;
		} else {
			print "<p> In this session, you've visited our site ".$visits." time. </p>".PHP_EOL;
		}
		//print "<p> We have ".$visits." visits so far! Thanks for your support! </p>".PHP_EOL;
		print "<form action=\"#bottom\" method=\"POST\">                                  ".PHP_EOL;
		print "<input name=\"resetButton\" type=\"submit\" value=\"RESET\"></input>".PHP_EOL;
		print "</form>                                                             ".PHP_EOL;	
		print "</footer>                                                           ".PHP_EOL;
	}


	//
	//End of the web page
	//
	function layoutEnd() {
		print "</body>                 ".PHP_EOL;
		print "</html>                 ".PHP_EOL;
	}
?>