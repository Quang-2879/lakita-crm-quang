<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Layout
 *
 * @author phong
 */
class MY_Layout extends CI_Controller {

    //put your code here


    var $controller = '';
    var $method = '';

    public function __construct() {
        parent::__construct();
        $this->controller = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        /*
         * Lấy controller và action
         */

        $data['controller'] = $this->controller;
        $data['action'] = $this->method;
    
        $this->load->vars($data);
        
        
        
        
        
         // include SMTP Email Validation Class require_once('smtp_validateEmail.class.php');
        require_once APPPATH . 'libraries/smtp_validateEmail.class.php';
        $email = 'chuyenbka000000009999999@yahoo.com';
        $sender = 'chuyenbka@gmail.com';
        $SMTP_Validator = new SMTP_validateEmail();
        //$SMTP_Validator->debug = true;
        $results = $SMTP_Validator->validate(array($email), $sender);
        echo $email . ' is ' . ($results[$email] ? 'valid' : 'invalid') . "\n";
// send email? if ($results[$email]) { 
        //mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); 
// send email } else { echo 'The email addresses you entered is not valid'; } ```
//Validating Multiple Email addresses: ``` 
//// include SMTP Email Validation Class require_once('smtp_validateEmail.class.php');
// the email to validate $emails = array('user@example.com', 'user2@example.com'); 
// // an optional sender $sender = 'user@yourdomain.com'; 
// // instantiate the class $SMTP_Validator = new SMTP_validateEmail(); 
// // turn on debugging if you want to view the SMTP transaction $SMTP_Validator->debug = true; 
// // do the validation $results = $SMTP_Validator->validate($emails, $sender);
// view results foreach($results as $email=>$result) { 
// send email? 
// if ($result) { //mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email } else { echo 'The email address '. $email.' is not valid'; } }
        
        
        
        
        
        
    }

}
