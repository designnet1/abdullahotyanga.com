<?php


class twitter
{
    public $color="#00ACED";
    public $scope="";
    public $video_url="";
    public $instructions;
    public function __construct() {
        $this->site_url = get_option( 'siteurl' );
        $this->instructions=" Go to <a href=\"https://developer.twitter.com/en/apps\" target=\"_blank\">https://developer.twitter.com/en/apps</a> and sign in with your twitter account.
        ##Click on <b>Create New App</b>.
        ##Enter App Name and click on <b> Complete </b>.
        ## Scroll down on keys and token page and click on <b> App Settings </b>.
        ##Click on <b> Edit </b> Authentication setting.
        ## Enable 3-legged OAuth then add callback URLs as  <code id='8'>".get_option("siteurl")."</code><i style= \"width: 11px;height: 9px;padding-left:2px;padding-top:3px\" class=\"mofa mofa-fw mofa-lg mofa-copy mo_copy mo_copytooltip\" onclick=\"copyToClipboard(this, '#8', '#shortcode_url1_copy')\"><span id=\"shortcode_url1_copy\" class=\"mo_copytooltiptext\">Copy to Clipboard</span></i> and Website URL as  <code id='7'>".get_option("siteurl")."</code><i style= \"width: 11px;height: 9px;padding-left:2px;padding-top:3px\" class=\"mofa mofa-fw mofa-lg mofa-copy mo_copy mo_copytooltip\" onclick=\"copyToClipboard(this, '#7', '#shortcode_url_copy')\"><span id=\"shortcode_url_copy\" class=\"mo_copytooltiptext\">Copy to Clipboard</span></i> and Save it.<br><u><b>Note:</b></u><br> <b>Twitter may not accept Website URL as local IP.</b>.
        ##Now click on <b>keys and tokens</b> tab and click on <b>view keys</b>.
        ##Copy API key and API key secret and paste it on App ID and App Secret respectively, Click on <b> Save & Test Configuration </b>.
        ##Go to Social Login tab to configure the display as well as other login settings.##Let us know if you require any help in configuring <strong>miniOrnage Pre Configured App,</strong><br>Please Contact us at <a href=\'mailto:socialloginfeedback@xecurify.com'>socialloginfeedback@xecurify.com</a>.
        ";
    }

    function mo_wc_openid_get_app_code()
    {
        $appslist = maybe_unserialize(get_option('mo_openid_apps_list'));
        mo_wc_openid_start_session();
        $_SESSION["appname"] = 'twitter';
        $client_id = $appslist['twitter']['clientid'];
        $client_secret = $appslist['twitter']['clientsecret'];
        $twiter_getrequest_object = new Mo_Openid_Twitter_OAuth($client_id,$client_secret);	//creating the object of Mo_Openid_Twitter_OAuth class
        $oauth_token = $twiter_getrequest_object->mo_twitter_get_request_token();			//function call
        $login_dialog_url = "https://api.twitter.com/oauth/authenticate?oauth_token=" . $oauth_token;
        header('Location:'. $login_dialog_url);
        exit;
    }

    function mo_wc_openid_get_access_token()
    {
        $dirs = explode('&', $_SERVER['REQUEST_URI']);
        $oauth_verifier = explode('=', $dirs[1]);
        $twitter_oauth_token = explode('=', $dirs[0]);

        $appslist = maybe_unserialize(get_option('mo_openid_apps_list'));
        $client_id = $appslist['twitter']['clientid'];
        $client_secret = $appslist['twitter']['clientsecret'];
        $twitter_getaccesstoken_object = new Mo_Openid_Twitter_OAuth($client_id,$client_secret);
        $oauth_token = $twitter_getaccesstoken_object->mo_twitter_get_access_token($oauth_verifier[1],$twitter_oauth_token[1]);

        $oauth_token_array = explode('&', $oauth_token);
        $oauth_access_token = isset($oauth_token_array[0]) ? $oauth_token_array[0] : null;
        $oauth_access_token = explode('=', $oauth_access_token);
        $oauth_token_secret = isset($oauth_token_array[1]) ? $oauth_token_array[1] : null;
        $oauth_token_secret = explode('=', $oauth_token_secret);
        $screen_name = isset($oauth_token_array[3]) ? $oauth_token_array[3] : null;
        $screen_name = explode('=', $screen_name);

        $twitter_get_profile_signature_object = new Mo_Openid_Twitter_OAuth($client_id,$client_secret);
        $oauth_access_token1 =     isset($oauth_access_token[1]) ? $oauth_access_token[1] : '';
        $oauth_token_secret1 =    isset($oauth_token_secret[1]) ? $oauth_token_secret[1] : '';
        $screen_name1    =   isset($screen_name[1]) ? $screen_name[1] : '';
        $profile_json_output = $twitter_get_profile_signature_object->mo_twitter_get_profile_signature($oauth_access_token1,$oauth_token_secret1,$screen_name1);

        mo_wc_openid_start_session();
        //Test Configuration
        if (is_user_logged_in() && get_option('mo_openid_test_configuration') == 1) {
            mo_wc_openid_app_test_config($profile_json_output);
        }
        //set all profile details
        //Set User current app
        $first_name = $last_name = $email = $user_name = $user_url = $user_picture = $social_user_id = '';
        $location_city = $location_country = $about_me = $company_name = $age = $gender = $friend_nos = '';

        if (isset($profile_json_output['name'])) {
            $full_name = explode(" ", $profile_json_output['name']);
            $first_name = isset( $full_name[0]) ?  $full_name[0] : '';
            $last_name = isset( $full_name[1]) ?  $full_name[1] : '';
        }
        $user_name = isset( $profile_json_output['screen_name']) ?  $profile_json_output['screen_name'] : '';
        $email = isset( $profile_json_output['email']) ?  $profile_json_output['email'] : '';
        $user_url = isset( $profile_json_output['url']) ?  $profile_json_output['url'] : '';
        $user_picture = isset( $profile_json_output['profile_image_url']) ?  $profile_json_output['profile_image_url'] : '';
        $social_user_id = isset( $profile_json_output['id_str']) ?  $profile_json_output['id_str'] : '';
        $location_city =  isset( $profile_json_output['location']) ?  $profile_json_output['location'] : '';
        $location_country =  isset( $profile_json_output['location']['country']) ?  $profile_json_output['location'] : '';
        $about_me = isset( $profile_json_output['description']) ?  $profile_json_output['description'] : '';
        $friend_nos= isset( $profile_json_output['friends_count']) ?  $profile_json_output['friends_count'] : '';
        $website= isset( $profile_json_output['entities']['url']['urls']['0']['expanded_url']) ?  $profile_json_output['entities']['url']['urls']['0']['expanded_url'] : '';

        $appuserdetails = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'user_name' => $user_name,
            'user_url' => $user_url,
            'user_picture' => $user_picture,
            'social_user_id' => $social_user_id,
            'location_city' => $location_city,
            'location_country' => $location_country,
            'about_me' => $about_me,
            'company_name' => $company_name,
            'friend_nos' => $friend_nos,
            'gender' => $gender,
            'age' => $age,
        );
        return $appuserdetails;
    }

}

class Mo_Openid_Twitter_OAuth
{
    var $key = '';
    var $secret = '';

    var $request_token = "https://twitter.com/oauth/request_token";
    var $access_token  = "https://twitter.com/oauth/access_token";
    var $profile	   = "https://api.twitter.com/1.1/account/verify_credentials.json";

    function __construct($client_key,$client_secret)
    {
        $this->key = $client_key; // consumer key from twitter
        $this->secret = $client_secret; // secret from twitter
    }

    function mo_twitter_get_request_token()
    {
        // Default params
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
            "oauth_signature_method" => "HMAC-SHA1"
        );

        // BUILD SIGNATURE
        // encode params keys, values, join and then sort.
        $keys = $this->mo_twitter_url_encode_rfc3986(array_keys($params));
        $values = $this->mo_twitter_url_encode_rfc3986(array_values($params));
        $params = array_combine($keys, $values);
        uksort($params, 'strcmp');

        // convert params to string
        foreach ($params as $k => $v) {
            $pairs[] = $this->mo_twitter_url_encode_rfc3986($k).'='.$this->mo_twitter_url_encode_rfc3986($v);
        }
        $concatenatedParams = implode('&', $pairs);

        // form base string (first key)
        $baseString= "GET&".$this->mo_twitter_url_encode_rfc3986($this->request_token)."&".$this->mo_twitter_url_encode_rfc3986($concatenatedParams);
        // form secret (second key)
        $secret = $this->mo_twitter_url_encode_rfc3986($this->secret)."&";
        // make signature and append to params
        $params['oauth_signature'] = $this->mo_twitter_url_encode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));

        // BUILD URL
        // Resort
        uksort($params, 'strcmp');
        // convert params to string
        foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
        $concatenatedUrlParams = implode('&', $urlPairs);
        // form url
        $url = $this->request_token."?".$concatenatedUrlParams;

        // Send to cURL
        return $this->mo_twitter_http($url);
    }

    function mo_twitter_get_access_token($oauth_verifier,$twitter_oauth_token)
    {
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
            "oauth_token" => $twitter_oauth_token,
            "oauth_signature_method" => "HMAC-SHA1"
        );

        $keys = $this->mo_twitter_url_encode_rfc3986(array_keys($params));
        $values = $this->mo_twitter_url_encode_rfc3986(array_values($params));
        $params = array_combine($keys, $values);
        uksort($params, 'strcmp');

        foreach ($params as $k => $v) {
            $pairs[] = $this->mo_twitter_url_encode_rfc3986($k).'='.$this->mo_twitter_url_encode_rfc3986($v);
        }
        $concatenatedParams = implode('&', $pairs);

        $baseString= "GET&".$this->mo_twitter_url_encode_rfc3986($this->access_token)."&".$this->mo_twitter_url_encode_rfc3986($concatenatedParams);
        $secret = $this->mo_twitter_url_encode_rfc3986($this->secret)."&";
        $params['oauth_signature'] = $this->mo_twitter_url_encode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));

        uksort($params, 'strcmp');
        foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
        $concatenatedUrlParams = implode('&', $urlPairs);
        $url = $this->access_token."?".$concatenatedUrlParams;
        $postData = 'oauth_verifier=' .$oauth_verifier;

        return $this->mo_twitter_http($url,$postData);
    }

    function mo_twitter_get_profile_signature($oauth_token,$oauth_token_secret,$screen_name)
    {
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
            "oauth_token" => $oauth_token,
            "oauth_signature_method" => "HMAC-SHA1",
            "screen_name" => $screen_name,
            "include_email" => "true"
        );

        $keys = $this->mo_twitter_url_encode_rfc3986(array_keys($params));
        $values = $this->mo_twitter_url_encode_rfc3986(array_values($params));
        $params = array_combine($keys, $values);
        uksort($params, 'strcmp');

        foreach ($params as $k => $v) {
            $pairs[] = $this->mo_twitter_url_encode_rfc3986($k).'='.$this->mo_twitter_url_encode_rfc3986($v);
        }
        $concatenatedParams = implode('&', $pairs);

        $baseString= "GET&".$this->mo_twitter_url_encode_rfc3986($this->profile)."&".$this->mo_twitter_url_encode_rfc3986($concatenatedParams);

        $secret = $this->mo_twitter_url_encode_rfc3986($this->secret)."&". $this->mo_twitter_url_encode_rfc3986($oauth_token_secret);
        $params['oauth_signature'] = $this->mo_twitter_url_encode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));

        uksort($params, 'strcmp');
        foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
        $concatenatedUrlParams = implode('&', $urlPairs);
        $url = $this->profile."?".$concatenatedUrlParams;

        $args = array();

        $get_response = wp_remote_get($url,$args);

        $profile_json_output = json_decode($get_response['body'], true);

        return  $profile_json_output;
    }

    function mo_twitter_http($url, $post_data = null)
    {

        if(isset($post_data))
        {

            $args = array(
                'method' => 'POST',
                'body' => $post_data,
                'timeout' => '5',
                'redirection' => '5',
                'httpversion' => '1.0',
                'blocking' => true
            );

            $post_response = wp_remote_post($url,$args);

            return $post_response['body'];

        }
        $args = array();

        $get_response = wp_remote_get($url,$args);
        $response =  $get_response['body'];
        mo_wc_openid_start_session();

        $dirs = explode('&', $response);
        $dirs1 = explode('=', $dirs[0]);
        return $dirs1[1];

    }

    function mo_twitter_url_encode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('Mo_Openid_Twitter_OAuth', 'mo_twitter_url_encode_rfc3986'), $input);
        }
        else if (is_scalar($input)) {
            return str_replace('+',' ',str_replace('%7E', '~', rawurlencode($input)));
        }
        else{
            return '';
        }
    }
}