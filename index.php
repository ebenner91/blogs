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
	$f3->route('GET|POST /', function($f3) {
		if(isset($_POST['submit']))
		{
			
			$f3->set("SESSION.loggedin", isset($_POST['username']));
			
		}
		$f3->set('bloggers', $GLOBALS['blogsDB']->allBloggers());

		
		echo Template::instance()->render('pages/home.html');
	});
	
	/**
	 *Route to a user's blog profile
	 */
	$f3->route('GET /profile/@id', function($f3, $params) {
		$f3->set('blogger', $GLOBALS['blogsDB']->getBloggerById($params['id']));
		
		$f3->set('blogs', $GLOBALS['blogsDB']->getAllPostsByBlogger($params['id']));
		
		echo Template::instance()->render('pages/profile.html');
	});
	
	/**
	 *Route to a specific blog post
	 */
	$f3->route('GET /blog/@id', function($f3, $params) {
		
		$f3->set('blog', $GLOBALS['blogsDB']->getPostById($params['id']));
		$f3->set('blogger', $GLOBALS['blogsDB']->getBloggerByPost($params['id']));
		
		echo Template::instance()->render('pages/blog.html');
	});
	
	/**
	 *Route to the about us page
	 */
	$f3->route('GET /about', function($f3) {
		
		echo Template::instance()->render('pages/about-us.html');
	});
	
	/**
	 *Route to the login us page
	 */
	$f3->route('GET /login', function($f3) {
		
		echo Template::instance()->render('pages/login-page.html');
	});
	/**
	 *Logs out user and redirects to home page
	 */
	$f3->route('GET /logout', function($f3) {
		
		$f3->clear('SESSION');
		
		$f3->reroute('/');
	});
	
	/**
	 *Logs out user and redirects to home page
	 */
	$f3->route('GET /new-user', function($f3) {
		
		echo Template::instance()->render('pages/new-user.html');
	});
	
	/**
	 *Creates a user, logs them in, and redirects to home page
	 */
	$f3->route('POST /user-submit', function($f3) {
		move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . basename($_FILES["image"]["name"]));
		$filename = basename($_FILES["image"]["name"]);
		$url = "/328/blogs/images/$filename";
		
		$newBlogger = new Blogger($url, $_POST['bio'], $_POST['username'], $_POST['password'], $_POST['email']);
		
		$GLOBALS['blogsDB']->addBlogger($newBlogger);
		
		$f3->set("SESSION.loggedin", true);
		
		$f3->reroute('/');
	});
	
    
    //Run fat free
	$f3->run();