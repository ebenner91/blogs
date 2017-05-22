<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>

          <?php foreach (($bloggers?:[]) as $blogger): ?>
            <div class="home-cards col-md-3 col-sm-5 col-xs-1 content">
                <img src="<?= $blogger['image_path'] ?>" alt="Profile Picture" class="col-xs-12 img-responsive center-block">
                <p class='text-center'><?= $blogger['username'] ?></p>
                <hr>
                <a href="/328/blogs/profile/<?= $blogger['id'] ?>">view blogs</a><span class='pull-right'>Total: <?= $blogger['blog_count' ] ?></span>
                <hr>
                <p class='text-center'>Something from my latest blog:<br><?= nl2br($blogger['last_post']) ?></p>
            </div>
          <?php endforeach; ?>
     
<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>