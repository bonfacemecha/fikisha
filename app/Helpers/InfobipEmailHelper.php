<?php

namespace App\Helpers;


define("MULTIPART_BOUNDARY", "----" . md5(time()));
define("EOL", "\r\n"); // PHP_EOL cannot be used for emails we need the CRFL '\r\n'

class InfobipEmailHelper
{

    public static function getBodyPart($FORM_FIELD, $value)
    {
        if ($FORM_FIELD === 'attachment') {
            $content = 'Content-Disposition: form-data; name="' . $FORM_FIELD . '"; filename="' . basename($value) . '"' . EOL;
            $content .= 'Content-Type: ' . mime_content_type($value) . EOL;
            $content .= 'Content-Transfer-Encoding: binary' . EOL;
            $content .= EOL . file_get_contents($value) . EOL;
        } else {
            $content = 'Content-Disposition: form-data; name="' . $FORM_FIELD . '"' . EOL;
            $content .= EOL . $value . EOL;
        }

        return $content;
    }

    /*
     * Method to convert an associative array of parameters into the HTML body string
    */
    public static function getBody($fields)
    {
        $content = '';
        foreach ($fields as $FORM_FIELD => $value) {
            $values = is_array($value) ? $value : array($value);
            foreach ($values as $v) {
                $content .= '--' . MULTIPART_BOUNDARY . EOL . self::getBodyPart($FORM_FIELD, $v);
            }
        }
        return $content . '--' . MULTIPART_BOUNDARY . '--'; // Email body should end with "--"
    }

    /*
     * Method to get the headers for a basic authentication with username and passowrd
    */
    public static function getHeader($username, $password)
    {
        // basic Authentication
        $auth = base64_encode("$username:$password");

        // Define the header
        return array('Authorization:Basic ' . $auth, 'Content-Type: multipart/form-data ; boundary=' . MULTIPART_BOUNDARY);
    }
  
    public static function NotifyEvent($subject, $view_path, $email, $data)
    {

        $url = env('INFOBIP_EMAIL_URL');
        $username = env('INFOBIP_USERNAME');
        $password = env('INFOBIP_PASSWORD');

        $postData = [
            'from' => 'Fikisha Ltd <no-reply@sasamonitor.com>',
            'to' => $email,
            'bcc' => [
                'support@sasamonitor.com',
                'ambonface@gmail.com',
            ],
            'replyTo' => 'support@sasamonitor.com',
            'subject' => $subject,
            'text' => '',
             'html' => view($view_path, ['data' => $data]),
            // 'html' => view($view_path),
            'intermediateReport' => 'true',
            'notifyUrl' => env('NOTIFY_URL'),
            'notifyContentType' => 'application/json',
            'callbackData' => 'DLR callback data'
        ];

      
        // Create the stream context.
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => self::getHeader($username, $password),
                'content' => self::getBody($postData),
            )
        ));

        // Read the response using the Stream Context.
        $response = file_get_contents($url, false, $context);

        return json_decode($response);
    }

   
}
