<div class='b-side-control'>
    <div class='d-flex flex-row-reverse mx-2'>
        <div>
            <?php
                
                if($this->session->has_userdata("user")){
                    $account = $this->session->userdata("user");
                    //echo "<button type='button' class='btn btn-primary' onclick='open_account()'>".ucfirst($account->username)."</button>";
                    echo '
                    <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      '.ucfirst($account->username).'
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="'.site_url("account/view").'">Users</a>
                      <a class="dropdown-item" href="'.site_url('main').'">Map</a>
                      <a class="dropdown-item" href="'.site_url('main/view').'">All</a>
                      <a class="dropdown-item" href="#">Settings</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="'.site_url('Account/logout').'">Log Out</a>
                    </div>
                  </div>   
                    ';
                }else{
                    echo "
                        <a type='button' href='".site_url("Account/login")."' class='btn btn-primary'>Log in</a>        
                    ";
                }
            ?>
        </div>
    </div>
</div>