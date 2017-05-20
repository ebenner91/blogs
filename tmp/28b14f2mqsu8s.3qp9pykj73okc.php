<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>
<div class="col-xs-10">
    <div class="row">
    <div class="col-sm-6"><h1 class="col-xs-12">Welcome Back!</h1>
    <span class="lead col-xs-12">Please login below</span>
    </div>
    <div class="col-sm-6"><img class="side-image col-xs-12" alt="Blog Logo" src="/328/blogs/images/lock.png"></div>
    </div>
</div>
<div class="center-block col-xs-10">
    <form class="col-xs-6" method="post" action="./">
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="text" name="username" id="username">
                <span class="input-group-addon">Username</span>
            </div>
            
            <div class="input-group">
                <input class="form-control" type="password" name="password" id="password">
                <span class="input-group-addon">Password</span>
            </div>
            
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>