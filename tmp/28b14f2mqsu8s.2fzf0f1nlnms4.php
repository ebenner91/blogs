<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Boostrap - Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- CSS for sidebar nav adapted from http://www.samrayner.com/bootstrap-side-navbar/ -->
<link type="text/css" href="/328/blogs/styles/navbar-fixed-side.css" rel="stylesheet" />


<link type="text/css" rel="stylesheet" href="/328/blogs/styles/styles.css">
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- sidebar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <nav class="navbar navbar-default navbar-fixed-side">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/328/blogs">WordSpace </a>
                        <img class="img-responsive center-block img-rounded" alt="logo" src="/328/blogs/images/blog-logo.jpg">
                    </div>
    
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="/328/blogs">Home ></a></li>
                            <?php if ($SESSION['loggedin']): ?>
                                
                                    <li><a href="/328/blogs">My Blogs ></a></li>
                                    <li><a href="/328/blogs">Create Blog ></a></li>
                                
                                <?php else: ?>
                                   <li><a href="#">Become a Blogger ></a></li> 
                                
                            <?php endif; ?>
                            <li><a href="/328/blogs/about">About Us ></a></li>

                            <?php if ($SESSION['loggedin']): ?>
                                
                                    <li><a href="/328/blogs/logout">Logout ></a></li> 
                                
                                <?php else: ?>
                                    <li><a href="/328/blogs/login">Login ></a></li> 
                                
                            <?php endif; ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="col-sm-9 col-lg-10">
            <div class="container content">
                <div class="row">