<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>
    <div class="col-xs-8 text-center"><h1><?= $blog['title'] ?></h1></div>
    <div class="col-xs-4 pull-right"><img src="<?= $blogger['image_path'] ?>" alt="Profile Picture" class="img-responsive center-block"></div>
    <div class="col-xs-8 pull-left"><p><?= nl2br($blog['blog_post']) ?></p></div>
                    
<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>