<?php echo $this->render('includes/page-top.html',NULL,get_defined_vars(),0); ?>

<div class="blog-header col-xs-10 content">
    <div class="row">
    <div class="col-sm-6"><h1 class="col-xs-12">Become a blogger!</h1>
    <span class="lead col-xs-12">Create a new account below</span>
    </div>
    <div class="col-sm-6"><img class="pull-right side-image col-xs-12" alt="Blog Logo" src="/328/blogs/images/writing.png"></div>
    </div>
</div>
<div class="blog-box col-xs-10 content">
    <form method="post" action="./user-submit" enctype="multipart/form-data" name="info">
        <div class="col-xs-6">
            <div class="form-group">
                <div class="input-group">
                <input class="form-control" type="text" name="username" id="username" required>
                <span class="input-group-addon">Username</span>
                </div>
            
            <div class="input-group">
                <input class="form-control" type="email" name="email" id="email" required>
                <span class="input-group-addon">Email</span>
            </div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                   <input class="form-control" type="password" name="password" id="password" required>
                    <span class="input-group-addon">Password</span> 
                </div>
                <div class="input-group">
                   <input class="form-control" type="password" name="password-verify" id="password-verify" required>
                    <span class="input-group-addon">Verify Password</span> 
                </div>
                <span id="verify-status"></span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" readonly>
                    <label class="input-group-btn">
                    <span class="btn btn-default btn-gray">
                        Upload a portrait <input type="file" name="image" accept="image/*" style="display: none;" required>
                    </span>
                </label>
                
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group-addon textarea-addon"> Quick Biography </div>
                          <textarea name="bio" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" name="action" class="btn btn-default center-block btn-gray" value="create">Start Blogging!</button>
        </div>
    </form>
</div>


<?php echo $this->render('includes/page-bottom.html',NULL,get_defined_vars(),0); ?>