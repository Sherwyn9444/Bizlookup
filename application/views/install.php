<?php
    $this->load->view('others/header');
?>

<div class='d-flex justify-content-center mt-3'>
    <div class='w-50'>
        <h1 class='d-flex justify-content-center'>INSTALLATION</h1>
        <div class='my-5'>
            <p>Note: This installation will create database on your server. Please ensure that creating database on your server is allowed.</p>
        </div>
        <form action="<?php echo site_url("install/set")?>" method="POST">
            <div>Hostname </div><input class='form-control mb-2' type='text' name="hostname" value = 'localhost'>
            <div>Username </div><input class='form-control mb-2' type='text' name="username" value = 'root'>
            <div>Password </div><input class='form-control mb-2' type='password' name="password" value = ''>
            <div>Database </div><input class='form-control mb-2' type='text' name="database" value = 'bizlookup'>
            <div>DBDriver </div><input class='form-control mb-2' type='text' name="dbdriver" value = 'mysqli'>
            <div class='d-flex justify-content-center mt-5'>
                <input type='submit' class='btn btn-primary w-50' value="Proceed">
            </div>
        </form>
    </div>
</div>

<?php

/*
$config['hostname'] = 'localhost';
$config['username'] = 'myusername';
$config['password'] = 'mypassword';
$config['database'] = 'mydatabase';
$config['dbdriver'] = 'mysqli';
$config['dbprefix'] = '';
$config['pconnect'] = FALSE;
$config['db_debug'] = TRUE;
$config['cache_on'] = FALSE;
$config['cachedir'] = '';
$config['char_set'] = 'utf8';
$config['dbcollat'] = 'utf8_general_ci';
$this->load->database($config);
*/
    $this->load->view('others/footer2');
?>