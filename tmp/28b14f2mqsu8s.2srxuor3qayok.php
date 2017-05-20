<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>
            <div class="col-xs-12 text-center"><h1><?= $blogger['fname'] ?> <?= $blogger['lname'] ?>'s Blogs</h1></div> 
            <div class="col-xs-8">
                <p class="lead">My most recent blog:</p>
                <p>Excerpt: <?= $blogger['last_post'] ?></p>
            </div>
            <div class='col-xs-4'><img src="<?= $blogger['image_path'] ?>" alt="Profile Picture" class="img-responsive center-block"></div>
            <div class='col-xs-8'>
                <p class='lead'>My Blogs:</p>
                <hr>
                <?php foreach (($blogs?:[]) as $blog): ?>
                    <p><a href="/328/blogs/blog/<?= $blog['id'] ?>"><?= $blog['title'] ?></a> -
                    Word Count: <?= $blog['word_count'] ?> -
                    <?= $blog['post_date'] ?></p>
                    <p><?= substr($blog['blog_post'], 0, 400) ?>...</p>
                    <hr>
                <?php endforeach; ?>
            </div>
            <div class="col-xs-4">
                <p class="lead text-center"><?= $blogger['fname'] ?> <?= $blogger['lname'] ?></p>
                <p>Bio: <?= $blogger['bio'] ?></p>
            </div>

<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>