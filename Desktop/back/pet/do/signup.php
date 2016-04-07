<?php

/**
 *  @commented yes
 *	@code signup backend page - invoked when user sign-ups
 */

    session_start();
    
    require_once('../fns/auth.php');
    
    # Checking for erros -- May declare different functions for different errors
    
    # Add csrf protection
    $helper = new AuthHelper;
    if(($helper->loggedIn()) || !isset($_POST))  # Check if user is already logged in or page is accessed without $_POST variable,
    {                                               # i.e., without submitting the form but directly by browser
    
        header('Location: ../index.php');
        exit;
    }
    
	extract($_POST);
	$eExists = 0;
	
    # prevent CSRF attacks - check if the token is set and correct
    
/*    if(!isset($_POST['token']) || $_POST['token'] != $_SESSION['token'])
    {
        $_SESSION[C_SIGNUP] = E_AUTH_FAILED;
        header('Location: ../index.php');
        exit;
    }
*/	
    # Check first name, last name and email are entered or not
    if( !isset($_POST['name']) || $_POST['name'] == "" || !isset($_POST['email']) || $_POST['email'] == "" )  # Check First name entered or not
    {    
        $_SESSION[C_SIGNUP] = E_NOT_FILLED;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
	
	// hasPasswd() is the hack to check when password is empty <=> signed in via social network
    else if($helper->eExists($_POST['email']))	# Check if email already exists in the database
    {
        $_SESSION[C_SIGNUP] = E_EMAIL_EXISTS;
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
    }
    
    #check passwords were entered or not
    if(!isset($_POST['passwd']) || $_POST['passwd'] == "" )
    {
        $_SESSION[C_SIGNUP] = E_NOT_FILLED;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
    
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) # Check if email is valid or not syntactically
    {
        $_SESSION[C_SIGNUP] = E_VALID_EMAIL;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
 
    $authobj = new Auth;
	
    # Calling the signup function to signup using entered data
    
	if(!$authobj->signup(array(
					'name'  => $_POST['name'],
					'email'  => $_POST['email'],
					'passwd' => $_POST['passwd'],
					'group'  => G_CUSTOMER
				)))												// if signup is unsuccessful
	{   
		$_SESSION[C_SIGNUP] = E_SORRY;							// error message
		header('Location: '.$_SERVER['HTTP_REFERER']);							// redirect back
		exit;
	}

?>