<?php
    $this->load->view('others/header');
?>

<div>
    <h1>INSTALLATION</h1>
    <div>Hostname : <input type='text' value = 'localhost'></div>
    <div>Username : <input type='text' value = 'root'></div>
    <div>Password : <input type='password' value = ''></div>
    <div>Database : <input type='text' value = 'bizlookup'></div>
    <div>DBDriver : <input type='text' value = 'mysqli'></div>
    
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
    $this->load->view('others/footer');
?>