<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>

<div class="blog-header col-xs-10 content">
    <div class="row">
    <div class="col-sm-6"><h1 class="col-xs-12">Your Blogs</h1>
    </div>
    <div class="col-sm-6"><img class="pull-right side-image col-xs-12" alt="Blog Logo" src="<?= $blogger['image_path'] ?>"></div>
    </div>
</div>

<div class="blog-box col-xs-10 content">
    <div class="col-xs-8">
    <table class="table table-striped">
        <thead>
            <th>Blog</th>
            <th>Update</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php foreach (($blogs?:[]) as $blog): ?>
                <tr>
                <td><a href="/328/blogs/blog/<?= $blog['id'] ?>"><?= $blog['title'] ?></a></td>
                <td><a href="/328/blogs/update-post/<?= $blog['id'] ?>"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
                <td><a href="/328/blogs/delete-post/<?= $blog['id'] ?>"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="col-xs-4">
        <p class="lead text-center"><?= $blogger['username'] ?></p>
        <hr>
        <p>Bio: <?= nl2br($blogger['bio']) ?></p>
    </div>
    
</div>

<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>