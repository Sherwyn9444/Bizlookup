<div class='d-flex justify-content-center w-100 h-100 p-5' >
    <div class='d-flex justify-content-center w-50'>
        <img class='login-img w-100 h-100'>
    </div>
    <div class="d-flex justify-content-start w-100">
    <form id='login-form' class='w-100 h-100' method='POST' action='<?php echo site_url("Account/confirm")?>'>
        <div class="form-group p-4 w-50">
            <h1 class='h1 d-flex justify-content-start my-5'>Login into Bizlookup</h1>
            <div class='my-2'>
                <label for="username">Usename</label>
                <input required type="text" class="form-control" id="username" name='username' aria-describedby="nameHelp" placeholder="Enter Username">
            </div>
            <div class='my-2'>
                <label for="password">Password</label>
                <input required type="password" class="form-control" id="password" name='password' placeholder="Enter Password">
            </div>
            <div class='d-flex justify-content-start my-4'>
                <input type="checkbox">Remember Me
            </div>

            <div class='d-flex justify-content-start my-4'>
                <button type="submit" class="btn btn-primary me-2">Login</button>
                
            </div>
        </div>
        
    </form> 
    </div>
</div>

