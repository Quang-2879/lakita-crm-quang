<?php
header('Access-Control-Allow-Origin: *');
/**
 * CSRF Protection Class
 */
class CSRF_Protection {

    /**
     * Holds CI instance
     *
     * @var CI instance
     */
    private $CI;

    /**
     * Name used to store token on session
     *
     * @var string
     */
    private static $token_name = 'li_token1';

    /**
     * Stores the token
     *
     * @var string
     */
    private static $token;

    // -----------------------------------------------------------------------------------

    public function __construct() {
        $this->CI = & get_instance();
    }

    // -----------------------------------------------------------------------------------

    /**
     * Generates a CSRF token and stores it on session. Only one token per session is generated.
     * This must be tied to a post-controller hook, and before the hook
     * that calls the inject_tokens method().
     *
     * @return void
     * @author Ian Murray
     */
    public function generate_token() {
        // Load session library if not loaded
        $this->CI->load->library('session');
        $tk = $this->CI->session->userdata(self::$token_name);
        if ( !isset($tk)) {
            // Generate a token and store it on session, since old one appears to have expired.
            self::$token = md5(uniqid() . microtime() . rand());

            $this->CI->session->set_userdata(self::$token_name, self::$token);
        } else {
            // Set it to local variable for easy access
            self::$token = $this->CI->session->userdata(self::$token_name);
        }
    }

    // -----------------------------------------------------------------------------------

    /**
     * This injects hidden tags on all POST forms with the csrf token.
     * Also injects meta headers in <head> of output (if exists) for easy access
     * from JS frameworks.
     *
     * @return void
     * @author Ian Murray
     */
    public function inject_tokens() {
        $output = $this->CI->output->get_output();

        // Inject into form
        $output = preg_replace('/(<(form|FORM)[^>]*(method|METHOD)="(post|POST)"[^>]*>)/', '$0<input type="hidden" name="' . self::$token_name . '" value="' . self::$token . '">', $output);

         // Inject into form
        $output = preg_replace('/(<(form|FORM)[^>]*(method|METHOD)="(get|GET)"[^>]*>)/', '$0<input type="hidden" name="' . self::$token_name . '_get " value="' . self::$token . '_get ">', $output);

        
        // Inject into <head>
        $output = preg_replace('/(<\/head>)/', '<meta name="csrf-name" content="' . self::$token_name . '">' . "\n" . '<meta name="csrf-token" content="' . self::$token . '">' . "\n" . '$0', $output);

        $this->CI->output->_display($output);
    }

    // -----------------------------------------------------------------------------------

    /**
     * Validates a submitted token when POST request is made.
     *
     * @return void
     * @author Ian Murray
     */
    public function validate_tokens() {
        //print_r($this->CI->input->post());die;
       
        // Is this a post request?
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
           // echo self::$token ;die;
            // Is the token field set and valid?
            $posted_token = $this->CI->input->post(self::$token_name);
           // var_dump($posted_token);die;
            if ($posted_token === FALSE || $posted_token != $this->CI->session->userdata(self::$token_name)) {
                 
// Invalid request, send error 400.
                show_error('Request was invalid. Tokens did not match.', 400);
            }
        }
          if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           // echo self::$token ;die;
            // Is the token field set and valid?
            $posted_token = $this->CI->input->get(self::$token_name. '_get');
            if ($posted_token === FALSE || $posted_token != $this->CI->session->userdata(self::$token_name. '_get')) {
                // Invalid request, send error 400.
                show_error('Request was invalid. Tokens did not match.', 400);
            }
        }
    }

}
