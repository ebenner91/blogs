<?php
/*
 *
 * ebenner.greenrivertech.net/328/blogs
 * Elizabeth Benner
 * Blogs Assignment
 * 5/21/2017
 * Controller for blogs website
 */

/**
* This is the controller for the blogs website
*
* The controller directs the various routes of the website, directing users
* to various pages, as well as passing entered information between the pages.
* @author Elizabeth Benner
* @copyright 2017
*
*/


	//Require the autoload file
	require_once('vendor/autoload.php');
	
	//start a session to store information entered by users
	session_start();
	
	//Create an instance of the Base class
	$f3 = Base::instance();
	
	//Set debug level
	$f3->set('DEBUG', 3);
	
	//Instantiate the database class
	$blogsDB = new BlogsDB();

	
	/**
	 *Default route for the website
	 */
	$f3->route('GET /', function($f3) {
		$f3->set('bloggers', $GLOBALS['blogsDB']->allBloggers());
		
		echo Template::instance()->render('pages/home.html');
	});
    
    //Run fat free
	$f3->run();