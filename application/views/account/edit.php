<div class="d-flex justify-content-center mt-4">
    <h1 class='h1'>Edit Account<h1>
</div>
<div class="d-flex justify-content-center">
<form method='post' action='<?php echo site_url('account/change');?>/<?php echo $account_id?>'>
    <div id='add-form'>
        <div class='p-5'>
            <label for="username">Username</label>
            <input required type="text" class="form-control" id="username" name='username' aria-describedby="nameHelp" value='<?php echo $account->username?>'">
            
            <label for="password">Password</label>
            <input required type="password" class="form-control" id="password" name='password' value='<?php echo $account->password?>'">

            <div class='r-side-control'>
                <button type="submit" id='add-form-submit' class="btn btn-primary">Save</button>
            </div>
        </div>
    </div> 
</form>
</div>
<div class='l-side-control'>
    <a href='<?php echo site_url("account/view")?>' type="button" class="btn btn-primary">Back</a>
</div>
