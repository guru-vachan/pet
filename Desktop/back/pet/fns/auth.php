<?php

require_once('constants.php');
    
class Auth
{
    private $dbh;
    private $helper;

    public function __construct()
    {
       require_once('db_fns.php');
        $this->dbh = new PDOConfig;
        $this->helper = new AuthHelper;
    }
    
    # @function loginUser logs in the user
    # @param $user is the username provided by the user
    # @param $pwd is the password provided by the user
    # @param $remember is the boolean value to keep the user logged in or not
    # @param $fwdurl is the URL where the user is to forwarded after logging in. Keep blank for default
    
    function login($user, $pwd, $remember, $fwdurl)
    {
        # fetching uid and passhash for given email
        $stmt = $this->dbh->prepare("select uid, passhash, salt from ".T_USER." where email like ?");
        
        if($stmt->execute(array($user)))
        {
            if($stmt->rowCount()==1)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $uid = $result['uid'];                              # get uid
                $passhash = $result['passhash'];                    # get hashed salted password
                $salt = $result['salt'];                            # get salt
            } else {                                                  # Wrong email
			    return false;
			}
        } else {
            return false;
		}
        
        if($this->helper->coded($pwd,$salt) == $passhash)           # if hashed passwords match
        {
                $this->loginDo($uid,$remember);                     # Log in the user finally
                
                if(isset($_SESSION['econfirmed']))
                {
                    $this->helper->confirmEmail();
                }
        }
        else
        {
            return false;
        }
        unset($_SESSION['loginattempts']);
        if($fwdurl==''){
            header('Location: index.php');                                  # forwarding to home page for default login
			exit;
        }else{
            header('Location: '.$fwdurl);                           # forwarding to particular page
			exit;
		}
    }
    
    # @function signup is to signup the user with the provided data
    # @param $data is the array of the data provided by the user
    
    function signup($data)
    {
        $id = '';
		$stmt = $this->dbh->prepare("INSERT INTO ".T_CUSTOMER." (cuid, fname, lname, mob, dob) VALUES(NULL, ?, ?, ?, ?)");
		if($stmt->execute(array($data['name'], "", "", "")))
		{
			$id = $this->dbh->lastInsertId();
		} else {	
			return false;
		}
       
        # generate and get a new salt for the user
        $saltObj = new SaltHelper;
        $salt = $saltObj->generateNewSalt();
        
        # get the salted and hashed password
        $passhash = $this->helper->coded($data['passwd'], $salt);
        
        # get the user IP
        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        
		# insert the data in the database table so as to register the user
        $stmt = $this->dbh->prepare("INSERT INTO ".T_USER." (uid, id, `group`, email, passhash, salt, reg_date, last_login, reg_ip, last_ip, valid, first_login) VALUES(NULL, ?, ?, ?, ?, ?, now(), now(), ?, ?, 0, 0)");
        if($stmt->execute(array(
                            $id,
                            $data['group'],
                            $data['email'],
                            $passhash,
                            $salt,
                            $ip,
                            $ip
                        ))) 						// if successful insertion in database
        {
            $this->helper->addUserCookies($this->dbh->lastInsertId());		// login the user
        //    $this->helper->sendConfirmation($email);						// send confirmation mail to the user
            
            header('Location: ../index.php');						// redirect to user success signup page
            exit;
        }
        else 																// if failed to register in databse
        { 
            //print_r($stmt->errorInfo());									// uncomment this to know the error
			return false;
        }
    }
    
    # @function loginDo logs in the user finally by setting up cookie and session variable
	# @param $uid is the uid which has to be logged in
	# @param $remember tells whether the logged in user has to be remembered by his browser or not
    
    function loginDo($uid, $remember)
    {
        if($this->helper->updateLoginRow($uid) && $this->helper->addUserCookies($uid) && $this->helper->rememberMe($uid, $remember)) 
             return true;
        return false;
    }
    
	# @function logout logs out the already logged in user
	
    function logout()
    {
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        foreach($_COOKIE as $key => $c_value)
            setcookie($key,NULL,1,"/");
        
        session_destroy();
        
        # Redirecting to previous page or to landing page
        
        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else {
            header('Location: ../index.php');
        }
    }
}    
    
# @class AuthHelper provides the helper functions in the authoriazation and control of profiles	
	
class AuthHelper
{
    private $dbh;
    
    # @function __construct() to initiate database  handller
    
    public function __construct()
    {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }

    # @function rememberMe remembers the user of that particular useragent
	# @param $uid is the uid of the user to be remembered
	# @param $remember if true then user has to remembered, else not
    
    function rememberMe($uid, $remember)
    {
        if($remember)                                   # if $remember is set to true
        {
            $auto = new autoLoginHelper;
            $publickey = $auto->generatePublicKey();    # Generate a new public key
            $auto->setClientPublicKey($publickey);      # set the public key in user's system
            
            $auto->addAutoLoginRow($uid, $publickey);
        }
        return true;
    }
    
    # @function updateLoginRow updates the login information of the logging in user
	# @param $uid is the uid of the user corresponding to whom the database has to be updated that he logged in
    
    function updateLoginRow($uid)
    {
        $ip = ip2long($_SERVER['REMOTE_ADDR']);                 # converting IP address to long datatype variable
        
        $stmt = $this->dbh->prepare("update ".T_USER." set last_login = now(), last_ip = ? where uid = ?");
        if($stmt->execute(array($ip, $uid)))
        {
            return true;
        }
        return false;
    }
    
    # @function isCurrentPasswd checks if the password is the current password or not
    # @param $pwd is the password to be checked
    # @return true if $pwd is the current password, else false
    
    function isCurrentPasswd($pwd)
    {
        $saltObj = new saltHelper;
        $salt = $saltObj->getSalt();
        
        if($this->coded($pwd, $salt) == $this->getPasshash())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
	# @function recoverPasswd sets the new password on password recovery
	# @param $param is the array of all the required parameters
	
	function recoverPasswd($param){
		extract($param);
		
        $saltObj = new saltHelper;
        $salt = $saltObj->generateNewSalt();                    # get the current salt
        $passhash = $this->coded($passwd, $salt);          		# create new passhash (hashed and salted password)
		
		$sql = "UPDATE ".T_USER." u JOIN ".T_FORGOT_PASSWD." f SET passhash = ?, salt = ? WHERE f.uid = u.uid AND u.email = ? AND f.hash = ?";
		$stmt = $this->dbh->prepare($sql);
		if($stmt->execute(array( $passhash, $salt, $email, $hash ))){
			if($stmt->rowCount() == 1){
				return true;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}
    # @function updatePasswd updates the current password of the user_error
    # @param $pwd is the new password to be set
    # @param $uid is the uid of the user whose password has to be changed. If null, then of logged user.
    # NOTE: If salt also needs to be changed, then change it before updating the password using the setSalt() function of saltHelper class
    
    function updatePasswd($pwd, $uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
        
        $saltObj = new saltHelper;
        $salt = $saltObj->getSalt();                    # get the current salt
        $passhash = $this->coded($pwd, $salt);          # create new passhash (hashed and salted password)
        
        $stmt = $this->dbh->prepare("UPDATE ".T_USER." SET passhash = ? WHERE uid = ?");
        if($stmt->execute(array($passhash, $uid)))
        {
            if($stmt->rowCount() == 1)
            {
                return true;
            }
        }
        
        return false;
    }
	
	/**
	 *	@function updateUserData updates user data
	 *
	 */
	 
	function updateUserData($data, $id = null){
		if($id == null){
			$id = $helper->getId();
		}
		$sql = "UPDATE ".T_CUSER." SET ";
		$keys = array();
		$vals = array();
		foreach($data as $key=>$val){
			$keys[] = $key." = ?";
			$vals[] = $val;
		}
		$sql.=implode(", ", $keys);
		$sql.=" WHERE ".T_CUSER.".cuid = $id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute($vals);
		var_dump($stmt->errorInfo());
		return true;
	}
    
	# @function coded returns the salted and hashed password of the user
    # The way of hashing/salting/storing password in database
	# @param $pwd is the password to be salted and hashed
	# @param $salt is the salt to be salted with the psasword
    
    function coded($pwd,$salt)
    {
        return md5(md5($salt).md5($pwd));
    }
    
    # @function addUserCookies to set the cookies in the browser
    # @param $user is the email id/username
    # NOTE: Changing the function requires to change the function loggedIn() also
    
    function addUserCookies($user)
    {
        $_SESSION['user'] = $user;                              # sets the user session variable :: Logs the user In
        if(isset($_SESSION['user']) && $_SESSION['user'] == $user)
            return true;
        return false;
    }

    # @function validEmail to check if the email is valid or not
    # @param $email is the email which needs to be verified
    
    function validEmail($email)
    {
		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		else {
			return true;
		}
    }
    
    # @function loggedInAdmin to check whether admin is logged in or not
    # NOTE: Change in this function should be based only on the changes in the function addCookies()
    
    function loggedInAdmin()
    {
        if($this->loggedIn() && $this->getGroupId($_SESSION['user']) != G_ADMIN)
            return false;
        return true;
    }
    
    # @function loggedIn to check whether user is logged in or not
    # NOTE: Change in this function should be based only on the changes in the function addCookies()
    # @param $confirm is true by default assuming that the user email is confirmed. If unconfirmed email is required, override the parameter by false. If irrespective of confirmation is required, one may use both true and false in OR ||
    
    function loggedInUser($confirm = true)
    {
        if($this->loggedIn() && $this->getGroupId() == G_CUSTOMER)
        {
            if( $confirm == true && $this->isConfirm() == false )
            {
                header('Location: /signup/user/confirmemail/');
                exit;
                return false;
            }
            else if( $confirm == false && $this->isConfirm() == true )
            {
                return false;
            }
            return true;
        }
        return false;
    }

    # @function getGroupId returns the group id of the passed uid
    
    function getGroupId($uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
            
        $stmt = $this->dbh->prepare("select `group` from ".T_USER." where uid = ?");    # NOTE: `group` as group is a keyword too
        if($stmt->execute(array($uid)))
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['group'];
        }
        else
        {
            return false;
        }
    }
    
    # @function loggedIn to check whether someone is logged in or not. May be user, org, man, vendor etc. anyone.
    # NOTE: Change in this function should be based only on the changes in the function addCookies()
    
    function loggedIn()
    {
        $obj = new AuthHelper;
        if(isset($_SESSION['user']))
        {
            return true;
        }
        else if(isset($_COOKIE['publickey']))
        {
            $autoObj = new AutoLoginHelper;
            if($autoObj->verifyAutoLogin())
                return true;
        }
        return false; 
    }
    
    # @function isConfirm() checks whether the email id of the user is confirmed or not
	# @param $uid is the uid of the user email id hsa to be checked. Default is the logged in user.
    
    function isConfirm($uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
        
        $stmt = $this->dbh->prepare("SELECT valid FROM ".T_USER." where uid = ?");
        if($stmt->execute(array($uid)))
        {
            $result = $stmt->fetch();
            if($result['valid'] == 0)		// 0 denotes that the email is not confirmed
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
    
    # @function confirmEmail() confirms the email id of the users
	# @param $uid is the uid whose email id has to be confirmed. Default is the logged in user.
    
    function confirmEmail($uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
        
        $stmt = $this->dbh->prepare("UPDATE ".T_USER." set valid = ? where uid = ?");
        if($stmt->execute(array(1, $uid)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    # @function sendConfirmation is to send the confirmation email/text to user to confirm signup of the account
    # @param $email is the email to send the confirmation
    
    function sendConfirmation($email = null)
    {
        if($email == null)
        {
            $email = $this->getEmail();
        }
        
        # get the confirmation token to send in the mail
        $link = $this->getConfirmationToken();
        
        $msg = "Recently you created an account at <a href='http://fasket.com'>Fasket</a>. Please click the following link to confirm your email address. <br><br>";
        $msg .= 'http://'.$_SERVER['HTTP_HOST']."/confirm/?token=".$link;
        $msg .= "<br><br>Please report here if it was not you.<br><br>".
                "With warm wishes, <br> Fasket.";
        
        $headers = "From: Fasket <hello@fasket.com> \r\n";    //Replace the email id by which you wish to send the mail
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $subject = 'Confirm email-id | Fasket';
        
        #send the mail finally
        mail($email, $subject, $msg, $headers);
    }
    
	
	function sendFinalCofirmation($email = null) {
		
        if($email == null)
        {
            $email = $this->getEmail();
        }
		$name = $this->getName();
		$msg = "";
	}
	
	
    # @function getRecoverPasswdToken() inserts a row in the forgotpassword database table, and returns the key to be sent to the user
	# @param $uid is the uid of the user whoser token has to be returned
    
    function getRecoverPasswdToken($uid, $email) 
    {
        $stmt = $this->dbh->prepare("delete from ".T_FORGOT_PASSWD." where uid = ?");
        $stmt->execute(array($uid));
        $hash = sha1(md5($email)).$uid;
        $stmt = $this->dbh->prepare("INSERT INTO ".T_FORGOT_PASSWD." (id, uid, validity,hash) VALUES (NULL, ?, now(), ?)");
		$stmt->execute(array($uid,$hash));
		return $hash;
    }
    
    # @function sendConfirmation is to send the confirmation email/text to user to confirm signup of the account
    # @param $email is the email to send the confirmation
    
    function sendRecoverPasswdMail($email)
    {
		/* the logged in user shall never reset the password !
        if($email == null)
        {
            $email = $this->getEmail();
        }
        */
        # get the confirmation token to send in the mail
        $link = $this->getRecoverPasswdToken($this->getUid($email), $email);
        
        $msg = "Recently you requested to recover your account password at <a href='http://fasket.com'>Fasket</a>. Please click the following link for the same. <br><br>";
        $msg .= 'http://'.$_SERVER['HTTP_HOST']."/forgotpassword/recover/?token=".$link."&email=".$email."&id=".sha1(time());
        $msg .= "<br><br>Please report here if it was not you.<br><br>".
                "With warm wishes, <br> Support team, <br> Fasket.";
        
        $headers = "From: hello@fasket.com\r\n";    //Replace the email id by which you wish to send the mail
        $headers.= "MIME-Version: 1.0\r\n";
                $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        $subject = 'Recover Password | Fasket';
        
        #send the mail finally
        mail($email, $subject, $msg, $headers);
    }
    
    # @function eExists checks whether the email already exists in the database or not, as a singed up user
    # @param $email is the email to be checked
    
    function eExists($email)
    {
        $stmt = $this->dbh->prepare("select uid from ".T_USER." where email like ?");
        if($stmt->execute(array($email)))
        {
            if($stmt->rowCount()>0){ // there is some such row
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['uid'];
			}else{
                return false;
			}
        }
        else 
        {
            return false;
        }
    }
	
	function emailExists($email){
		return $this->eExists($email);
	}
    
	function hasPasswd($id = null){
		$pass = $this->getPasshash($id);
		return $pass?true:false;
	}
	
	
    # @function generateNewCsrfToken() generates a new CSRF token for the whole session.
    
    function generateNewCsrfToken()
    {
        $token = md5(uniqid(rand(), TRUE));
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = time();
    }
    
    # @fucntion getCsrfToken returns the current csrf token
    
    function getCsrfToken()
    {
        # if token is not set, generate new token
        if(!isset($_SESSION['token']))
        {
            $this->generateNewCsrfToken();
        }
        return $_SESSION['token'];
    }
   
    # @function getConfirmationToken() returns the mail confirmation token
	# @param $uid is the uid whose confimation token has to be returned. Default is the logged in user
   
    function getConfirmationToken($uid = null)
    {
        if($uid==null)
        {
            $uid = $_SESSION['user'];
        }
        $email = $this->getEmail($uid);
        $pass = $this->getPasshash($uid);
        return md5(md5($email).$pass);
    }
    
    # @function getUid returns the uid of the logged in user or the email specified as parameter
    
    function getUid($email = null)
    {
        if($email == null)
        {
            return $_SESSION['user'];
        }
        $stmt = $this->dbh->prepare("select uid from ".T_USER." where email = ?");
        $stmt->execute(array($email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['uid'];
    }
    
    # @function getMob returns the mobile number of the logged in user or the uid specified as parameter
    
    function getAddress($uid = null, $sid)
    {
        if($uid == null) {
            $uid = $_SESSION['user'];
        }
		$sql = "select ".T_ADD.".name, room, ".T_HOSTEL.".name as hostel, mob from ".T_ADD." join ".T_HOSTEL." where ".T_HOSTEL.".hid = hostel AND sid = $sid ";
        $stmt = $this->dbh->prepare($sql);
        if(!$stmt->execute(array())) { 
		//	var_dump($stmt->errorInfo()); echo $sql; exit; 
		}
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return array($result['name'], $result['room'], $result['hostel'], $result['mob']);
    }
    # @function getMob returns the mobile number of the logged in user or the uid specified as parameter
    
    function getMob($uid = null)
    {
        if($uid == null) {
            $uid = $_SESSION['user'];
        }
		
        $stmt = $this->dbh->prepare("select mob from ".T_CUSTOMER." where cuid = ?");
        $stmt->execute(array($this->getId()));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['mob'];
    }
    
    # @function getName returns the email of the logged in user or the uid specified as parameter
    
    function getFullName($uid = null)
    {
        if($uid == null) {
            $uid = $_SESSION['user'];
        }
		
        $stmt = $this->dbh->prepare("select fname, lname from ".T_CUSTOMER." where cuid = ?");
        $stmt->execute(array($this->getId()));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['fname']." ".$result['lname'];
    }
    
    # @function getName returns the email of the logged in user or the uid specified as parameter
    
    function getName($uid = null)
    {
        if($uid == null) {
            $uid = $_SESSION['user'];
        }
		
        $stmt = $this->dbh->prepare("select fname from ".T_CUSTOMER." where cuid = ?");
        $stmt->execute(array($this->getId()));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['fname'];
    }
    
    # @function getEmail returns the email of the logged in user or the uid specified as parameter
    
    function getEmail($uid = null)
    {
        if($uid == null) {
            $uid = $_SESSION['user'];
        }
		
        $stmt = $this->dbh->prepare("select email from ".T_USER." where uid = ?");
        $stmt->execute(array($uid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['email'];
    }
    
	# @function getPasshash returns the hashed password of the user
	# @param $uid is the uid of the user whose data has to be returned. Default is the logged in user.
	
    function getPasshash($uid = null)
    {
        if($uid == null)
            $uid = $_SESSION['user'];
            
        $stmt = $this->dbh->prepare("select passhash from ".T_USER." where uid = ?");
        $stmt->execute(array($uid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['passhash'];
    }
    
	# @function getPasshash returns the corresponding id of the user in its group
	# @param $uid is the uid of the user whose data has to be returned. Default is the logged in user.
	
    function getId($uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
        
        $stmt = $this->dbh->prepare("SELECT id from ".T_USER." where uid = ?");
        $stmt->execute(array($uid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    
    # @function getError returns the error contained in the given session variable index $var
    # @param $var is the session variable index
    # @return $err - the error to be displayed
    
    function getError($var)
    {
        if(isset( $_SESSION[$var] ))
        {
            switch($_SESSION[$var])
            {
                case E_AUTH_FAILED: 
                                    $err = "Authentication Failed! Please try again."; 
                                    break; 
                case E_NOT_FILLED: 
                                    $err = "Please fill all the fields and try again."; 
                                    break; 
                case E_VALID_EMAIL: 
                                    $err = "Please enter a valid enter email id."; 
                                    break; 
                case E_EMAIL_EXISTS: 
                                    $err = "Email already registered. <a href='/login/'>Login here</a>."; 
                                    break; 
                case E_NO_TERMS: 
                                    $err = "Please accept the terms and conditions to register."; 
                                    break; 
                case E_PASSWD_MATCH: 
                                    $err = "Passwords do not match, please try again."; 
                                    break; 
                case E_USER_TYPE: 
                                    $err = "Please select valid user type."; 
                                    break; 
                case E_SORRY: 
                                    $err = "Sorry, something went wrong. Please try again."; 
                                    break; 
                case E_PASSWD_CURRENT: 
                                    $err = "You entered wrong current password. Please try again."; 
                                    break; 
                case E_EMAIL_NO_EXISTS: 
                                    $err = "You've entered an email that's not registered with us. Please verify the email again, or <a href='/signup'> Sign up here</a>."; 
                                    break; 
				case E_SUCCESS_UPDATE:
									$err = "Kudos! Successfully updated.";
									break;
				case E_NOT_IMAGE:
									$err = "Please select an image. No other files.";
									break;
				case E_EXCEED_SIZE:
									$err = "File size exceeded. Please upload files below 50 MB.";
									break;
				case E_NO_IMAGE:
									$err = "Please select an image.";
									break;
				case E_REMOVE_CONNECTION:
									$err = "Connnection has been removed successfully.";
									break;
				case E_ADD_CONNECTION:
									$err = "Connection has been confirmed successfully.";
									break;
				case E_SUBMIT_FEEDBACK:
									$err = "Feedback has been submitted successfully. Thanks!";
									break;
				case E_SUBMIT_COMPLAINT:
									$err = "Complaint has been submitted successfully. You'll soon be replied. Thanks.";
									break;
				case E_NO_DISH:
									$err = "This dish is not available in our database right now. Sorry for the inconvinience";
									break;
				case E_NO_VENDOR:
									$err = "No such vendor exists in our database. Sorry for the inconvinience";
									break;
				case E_VALID_MOB:
									$err = "Mobile number in some wrong format. Please retry.";
									break;
				case E_SAME_ALT_MOB:
									$err = "Alternate number same as primary number. Please retry.";
									break;
				case E_THANKS:
									$err = "Thanks!";
									break;
				case E_COUPON_EXPIRE: $err = "Coupon expired.";
									break;
                default:       
                                    $err = $_SESSION[$var];
                                    break;
            }
            unset($_SESSION[$var]);
            return $err;
        }
        else
        {
            return '';
        }
    }
    
    # @function blockHacker blocks the hacker
    
    function blockHacker()
    {
		// not defined yet
    }
}

#-------------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------------------------------------------------------------------------#

# @class autoLoginHelper defines functions related to autologin

class autoLoginHelper
{
    private $dbh;

    public function __construct()
    {
        require_once('fns/db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    # @function addAutoLoginRow adds a new row in the auto-login table if less than 10 exist, else replaces the last
	# @param $uid is the uid of the user who has to be added in the database for auto login
	# @param $publickey is the the public key as added in user's browser
    
    function addAutoLoginRow($uid, $publickey)
    {
        $stmt =  $this->dbh->prepare("select id from ".T_AUTO_LOGIN." where uid = ?");
        if($stmt->execute(array($uid)))
        {
            if($stmt->rowCount()>10)
            {
                $stdelete = $this->dbh->prepare("delete from ".T_AUTO_LOGIN." where uid = ? order by last_used limit 1");
                $stdelete->execute(array($uid));
            }
        }
        $stInsert = $this->dbh->prepare("insert into ".T_AUTO_LOGIN." (id, uid, public_key, private_key, created_on, last_used, last_ip ) values(NULL, ?, ?, ?, now(), now(), ?) ");
        
        $stInsert->execute(array($uid, substr($publickey,-32), $this->generatePrivateKey(), $_SERVER['REMOTE_ADDR']));
        return true;
    }
    
    # @function generatePublicKey generates the public key for the logged in user
    
    function generatePublicKey()
    {
        $helper = new AuthHelper;
        return $_SESSION['user'].md5($helper->getEmail() .  mktime());     # Randomly generated anything will work concanated with the uid.
    }
    
    # @function setClientPublicKey sets the publickey cookie on client end, as a part of autologin
    # @param $key is the public key to be set
    
    function setClientPublicKey($key)
    {   
        setcookie("publickey",$key,time() + 365*24*60*60*10,"/");    # Set the publickey cookie for 10 years
    }
    
    # @function getPublicKey gets the public key of the current user from the client's system
    # @return the public key and the uid of user as array if exists else empty string
    
    function getClientPublicKey()
    {
        if(isset($_COOKIE['publickey']) && strlen($_COOKIE['publickey']) > 32)
        {
            $publickey = $_COOKIE['publickey'];
            return array(substr($publickey,-32), substr($publickey,0,strlen($publickey)-32));   // Returns publickey and uid separated
        }
        else 
            return false;
    }
    
    # @function generatePrivateKey generates the private key for the current user
    
    function generatePrivateKey($uid = null)
    {
        if($uid == null)
        {
            $uid = $_SESSION['user'];
        }
        $saltObj = new saltHelper;
        $salt = $saltObj->getSalt($uid);
        return md5(md5($salt).md5($_SERVER['HTTP_USER_AGENT']));    // md5 concanated md5's of salt and user agent
    }
    
    # @function setPrivateKey sets the private key in the database
    
    function setPrivateKey($key)
    {
        $stmt = $this->dbh->prepare("update ".T_AUTO_LOGIN." set privatekey = $key where uid = ");
    }
    
    # @function getPrivateKey returns the private key of the current user at matched autologin id
    
    function getPrivateKey($id)
    {
        $stmt = $this->dbh->prepare("select privatekey from ".T_AUTO_LOGIN." where id = ?");
        if($stmt->execute(array($id))) 
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result)
                return $result['privatekey'];
            else
                return false;
        }
        return false; 
    }
    
    # @function getPublicKeyId returns the ID corresponding to the current user and passed $publickey
    
    function getPublicKeyId($publickey, $uid)
    {
        $stmt = $this->dbh->prepare("select id from ".T_AUTO_LOGIN." where uid = ? and public_key = ?");
        if($stmt->execute(array($uid, $publickey))) {}
            
    }
    
    # @function updateAutoLoginRow updates the auto login information at the logged system
    
    function updateAutoLoginRow($id)
    {
        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        $stmt = $this->dbh->prepare("update ".T_AUTO_LOGIN." set last_used = now(), last_ip = ? where id = ?");
        $stmt->execute(array($ip, $id));
    }
    
	# @function verifyAutoLogin 
	
    function verifyAutoLogin()
    {
        # Get public key and uid. Return false if they doesn't exist
        
        if(list($publickey, $uid) = $this->getClientPublicKey())
        {
            # If not null, then prepare check the ID at which that public key exists
            # select id from table where public_key = $publickey and $privatekey = generatePrivateKey()
            
            $privatekey = $this->generatePrivateKey($uid);
            $stmt = $this->dbh->prepare("select id from ".T_AUTO_LOGIN." where public_key = ? and uid = ? and private_key = ?");    
            
            # when public key exists then the private key should match the now generated private key also
            
            $stmt->execute(array($publickey, $uid, $privatekey));
            
            if($stmt->rowCount()>0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $result['id'];
                
                $aobj = new Auth;
                $helper = new AuthHelper;
                $this->updateAutoLoginRow($id);
                $helper->generateNewCsrfToken();
                if($aobj->loginDo($uid, false))    # false coz the user is already remembered
                    return true;
            }
            else
            {
                setcookie('publickey',$publickey,time()-24*60*60*365);
                return false;
            }
        }
        else
            return false;
    }
}

#-------------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------------------------------------------------------------------------#

# @class saltHelper defines functions related to salt

class saltHelper
{
    private $dbh;

    public function __construct()
    {
        require_once('../fns/db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    # @function generateNewSalt generates a random 5-letter string as salt
    # @return the generated salt
    
    function generateNewSalt()
    {
        $salt = '';
        for($i=0; $i<5; $i++) {
            $salt.= chr(rand(97,122));
        }
        return $salt;
    }
    
    # @function setSalt sets the salt in user database corresponding to the logged in user
    
    function setSalt($salt, $uid = null)
    {
		if($uid==null){
			$uid = $_SESSION['user'];
		}
        $stmt = $this->dbh->prepare("update ".T_USER." set salt = ? where uid = ?");
        if($stmt->execute(array($salt, $uid)))
            if($stmt->rowCount() == 1)
                return true;
        return false;
    }
    
    # @function getSalt gets the salt from the user database, corresponding to the logged in user
    
    function getSalt($uid = null)
    {
        if($uid == null)
            $uid = $_SESSION['user'];
            
        $stmt = $this->dbh->prepare("select salt from ".T_USER." where uid = ?");
        if($stmt->execute(array($uid)))
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['salt'];
        }
        else
            return false;
    }
}

?>
