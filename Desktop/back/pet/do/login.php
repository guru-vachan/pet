<?php
    session_start();
    
    require_once('../fns/auth.php');
    
    # check if user is already logged in or this page is accessed directly without submitting a post form
    $helper = new AuthHelper;
	if(!isset($_SERVER['HTTP_REFERER'])){
		$_SERVER['HTTP_REFERER'] = "../index.php";
	}
    if(($helper->loggedIn()) || !isset($_POST) )
    {
        header('Location: ../index.php');
        exit;
    }
    
    # prevent CSRF attacks - check if the token is set and correct
    
/*    else if(!isset($_POST['token']) || $_POST['token'] != $_SESSION['token'])
    {
        $_SESSION['loginerror'] = E_AUTH_FAILED;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
*/    
    # check if email and password are filled up
    
    else if(!isset($_POST['email']) || !isset($_POST['passwd']) || $_POST['email'] == "" || $_POST['passwd'] == "")
    {
        $_SESSION['loginerror'] = E_NOT_FILLED;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) # Check if email is valid or not syntactically
    {
        $_SESSION['loginerror'] = E_VALID_EMAIL;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    # check whether remember me is selected or not
    $remember = false;
    if(isset($_POST['remember']) && $_POST['remember']=="on")
    {
        $remember = true;
    }
    $redirect = isset($_POST['redirect'])?$_POST['redirect']:"../index.php";
	
    $authobj = new Auth;
    if($authobj->login($_POST['email'], $_POST['passwd'], $remember, urldecode($redirect)) == false)
    {
        $_SESSION['loginerror'] = E_AUTH_FAILED;
        
#++++++++++++++++++++++++++++++++++++++IMPORTANT++++++++++++++++++++++++++++++#
#++++++++++Prevent an attacker from trying passwords one after another++++++++#
#++++++++++as he'll need new token everytime, hence he's gone+++++++++++++++++#        
        
        $helper = new AuthHelper;
        $helper->generateNewCsrfToken();
        if(!isset($_SESSION['loginattempts']))
        {
            $_SESSION['loginattempts'] = 1;
        }
        else
        {
            $_SESSION['loginattempts']++;
            if($_SESSION['loginattempts'] == MAX_LOGIN_ATTEMPTS)
            {
                $helper->blockHacker();
            }
        }
#+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++#        
        
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
?>