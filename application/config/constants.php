<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* Custom Constants */

define("BASE_URL", "/");
defined("ASSETS") OR define("ASSETS", "/public_html/assets/");
defined("JS") OR define("JS", ASSETS . "js");
defined("IMG") OR define("IMG", ASSETS . "img");
defined("CSS") OR define("CSS", ASSETS . "css");
defined("FONTS") OR define("FONTS", ASSETS . "fonts");
defined("ADMIN") OR define("ADMIN", ASSETS . "admin");

/*
	Custom Constants for all string used in website.
	Guide:
		Prefix: M_ for main or global string.
				CD_ for strings in Casting Director's pages.
				A_ for strings in Actor's pages.
				E_ for EMails
				Er_ for Errors
				Su_ for Success
				U_ for Urls
*/
// Main / Global
define("M_Title", "C A S T I K O");
define("M_TagLine", "Making casting easier!");
define("M_Copyright", "&copy; ".date('Y')." Castiko | connect@castiko.com");
define("M_Register1", "Please fill out the form.");
define("M_Register2", "You will hear from us within 24 hours.");
define('M_AlreadyRegistered', 'Already registered? Sign in here.');


// Director Pages: home.php
define("CD_AdvSearch", "Advanced Search");
define("CD_AdvSearchSmall", "Search actors based on specific criteria.");
define("CD_ModWaitingAct", "Awaiting Activation");
define("CD_ModWaitingActMsg", "To use this feature, your account needs to be activated.</br> Please contact us at: <a href='mailto:connect@castiko.com'>connect@castiko.com</a> if this is wrong.");
define("CD_InviteSuc", "Email / SMS sent successfully!");
define("CD_InviteSucMsg", "Invitation has been sent to all the selected actors.");
define("CD_InviteActMsg", "Invite actors to share their information with you. Just enter their emails or mobile numbers.");
define('CD_SuggTxt', 'Please click the button below and follow the steps to share your details with us.');
define('CD_ProjTitle', 'All actors who will receive this message will automatically be tagged with this Project Name, so you can find them easily.');
define("CD_TitleTxt", "Write your message in this box. The actors will also see a button (or a link in SMS), asking them to create their profiles. This helps us keep track of whether they have seen your message or not.");
define('CD_TitleDate', 'If you choose an already existing Project Name, this date will update automatically. You may still change it, but that will create a new project with the same name and a different date.');

// Actor Pages: home.php and actor_profile.php
define('AC_ActivationWarning', "Please verify your email address so that casting directors can contact you easily. We've sent you a link to your email.<br> If you have not received it, click <a href='#' class='text-info' id='resendConfirmationLink'>here</a> to resend the verification email.");
define('AC_MobileVerifyTxt', 'Your mobile number is not verified. Please verify your mobile number to receive messages on your phone.');
define('AC_CDHelpTxt', "When you accept a casting director's invitation to join their database, their name will show up here. This means that they will see all the changes you make to your profile instantly.");
define('AC_ExpHelpTxt', "Showing your video work is the best way to showcase your talent. If you don't have any video work to show yet, just record yourself acting out a favorite scene and put that here.");
define('AC_UploadHelpTxt', 'You can upload multiple pictures at a time.');
define("AC_MaxLimitWarn", "You have already reached the maximum limit of uploads. Please delete some photos to upload new.");
define('AC_NoImage', 'Hola! It looks like you have not uploaded any photos yet. <br>Why don\'t you start with uploading some photos?');
define('AC_ConfLinkSent', 'A confirmation link has been send to you email. Check it and confirm your email address.');

/*
	Controllers File;
		File Name: Home.php
		Suffix: Ho
		Naming Format: Suffix_Func_name 
*/
define('Ho_Reg_SuccMsg', "You have successfully registered. You will get a confirmation link in your email. </br>This can take a few minutes.</br> Meanwhile, <a href='/'>click here</a> to sign in and get started.");
define("Ho_Reg_ErrMsg", "Something went wrong! We are trying to fix it.");

// File Name: Secure.php, Suffix: Se
// Some string are still in the file that cannot be put here.
define('Se_Cnf_RedirectLink', "<p style='color:#666;'> <i> If you are not redirected automatically,  <a href='".BASE_URL."'>click here</a>. </i> </p>");
define('Se_Cnf_AlreadyConfirmed', 'Your email is already confirmed. Login to access your account.');

// File Name: Actor.php, Suffix: Ac
define('Ac_Ajx_GenFailed', 'Update Failed.');
define('Ac_Ajx_GenSucc', 'Update Success.');

define('Ac_MobVer_AlreadyVerified', 'You mobile number is already verified.');
define("Ac_MobVer_EnterCode", "Enter the Code you got on you mobile");
define("Ac_MobVer_SendFailed", "Sending sms failed. Please try after sometime.");
define("Ac_Ajx_AuthFail", "Authentication Failed.");
define("Ac_VerOTP_Success", "Your mobile is successfully verified.");
define("Ac_VerOTP_OldOTP", "You are using an old otp.");
define('Ac_VerOTP_Invalid', 'Invalid OTP.');
define('Ac_eUsrName_Invalid', 'Invalid Characters. Username only can have A-Z, a-z, 0-9 and ( .-_ ). No white space allowed.');
define('Ac_eUsrName_Nochange', "Nothing Changed");
define('Ac_eUsrName_Taken', "Already Taken!");
define("Ac_ReConf_Sent", AC_ConfLinkSent);
define("Ac_ReConf_Fail", "Sending email failed. Try again later.");
define("Ac_Ajx_ActFailed", "Action Failed");
define("Ac_eContDet_Mobchanged", "You changed your mobile number. You need to verify it.");

// File Name: Ajax.php, Suffix: Aj
define('Aj_Req_NoData', 'Sorry! No form data received.');
define("Aj_Gen_Failed", "sending failed");
define('Aj_FetAct_NoActor', "You don't have any actor added in you List. Please Add actors.");
define("Aj_ChangePass_Succ", "Password Changed Successfully");
define("Aj_ChangePass_Fail", "Failed to change password.");
define("Aj_ChangePass_CodeExp", "Pass Code Expired. Try to get new one.");
define("Aj_ChangePass_Used", "This Pass Code is already used.");
define('Aj_ChangePass_Invalid', 'Invalid/Old Pass Code...');

define('Aj_FrgtPass_Sent', 'We have emailed you a reset code.');
define("Aj_FrgtPass_Failed", "Failed to send Passcode. Try Again...");
define('Aj_FrgtPass_Invalid', "This Email/Username doesn't Exist. Please Register first.");

define("Aj_Login_Succ", "Login Success. Welcome ");
define("Aj_Login_Failed", "Email and Password don't match.");
define("Aj_Login_Invalid", "This Email/Username doesn't Exist. Please Register first.");


// Page Modeal: Email.php suffix: Em
define('Em_ActMail_subject', 'Thank You for Signing Up | Confirmation Link | Castiko');
define('Em_ActMail_msg', 'Dear user, <br>Welcome to Castiko! Click the button below to confirm your account.');

define('Em_PassCode_subject', 'Password Reset Code | Castiko');


define('Em_ResetSucc_subject', 'Password Reset Success | Castiko');
define('Em_ResetSucc_msg', 'Dear User, <br>Your password has been reset. If you did not reset this password then file a complain at <a href=\'mailto:connect@castiko.com\'>connect@castiko.com</a> and reset you account password.');

define('Em_Welcome_subject', "Welcome to Castiko | Castiko");
define('Em_Welcome_msg_director', 'Welcome to Castiko. We have lots of exciting feature for Casting Directors.');
define('Em_Welcome_msg_actor', 'Welcome to Castiko. We have lots of exciting feature for Actor.');

define('Em_Reminder_subject', 'Reminder | Castiko');
define('Em_Reminder_msg', "Dear User <br> You account seems inactive from a long time. You might be missing lot of audition invitation and excited feature of Castiko. <a href='http://castiko.com/'>Login</a> to your account and checkout what's new.");

//for new Audition Mail

define('Em_AudiMail_subject', 'Audition Mail');
define('Em_AudiMail_message', 'You got a Message from __PUT_DIRECTOR_NAME_HERE__. Open this link to see message.');
define('Em_AudiMail_ifQues', '');





































