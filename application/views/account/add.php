<div class="d-flex justify-content-center mt-4">
    <h1 class='h1'>Add Account<h1>
</div>
<div class="d-flex justify-content-center">
<form method='post' action='<?php echo site_url('account/insert');?>'>
    <div id='add-form'>
        <div class='p-5'>
            <label for="username">Username</label>
            <input required type="text" class="form-control" id="username" name='username' aria-describedby="nameHelp" placeholder="Enter Username">
            
            <label for="password">Password</label>
            <input required type="password" class="form-control" id="password" name='password' placeholder="Enter Password">

            <div class='r-side-control'>
                <button type="submit" id='add-form-submit' class="btn btn-primary">Add</button>
            </div>
        </div>
    </div> 
</form>
</div>
<div class='l-side-control'>
    <a href='<?php echo base_url()?>' type="button" class="btn btn-primary">Back</a>
</div>
