<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>
<div class="blog-header col-xs-10 content">
    <div class="row">
    <div class="col-sm-6"><h1 class="col-xs-12">What's on your mind?</h1>
    </div>
    <div class="col-sm-6"><img class="pull-right side-image col-xs-12" alt="Notepad" src="/328/blogs/images/writing.png"></div>
    </div>
</div>
<div class="blog-box col-xs-10 content">
    <form method="post" action="./post-submit">
        <input type="hidden" name="bloggerId" id="bloggerId" value="<?= $blogger['id'] ?>">
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="text" name="title" id="title">
                <span class="input-group-addon">Title</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group-addon textarea-addon"> Blog Entry </div>
                  <textarea name="text" class="form-control" rows="10"></textarea>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12">
            <button type="submit" name="action" class="btn btn-default center-block btn-gray" value="create">Save</button>
        </div>
    </form>
</div>

<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>