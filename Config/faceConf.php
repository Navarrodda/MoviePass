<?php
    $fb = new Facebook\Facebook([
        'app_id' => '590926088121967', 
        'app_secret' => 'c6069dc72031f02e3f442a0cfca4ecec',
        'default_graph_version' => 'v4.0',
        ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl(URL.'/user/facebookLogin/', $permissions);
?>