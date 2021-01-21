<?php
namespace Helper\Connection;

class Email
{
    private static $from = null;
    private static $to = null;
    private static $subj = null;
    private static $message = null;
    private static $files = null;

    function from($from){
        self::$from = $from;
        return new self;
    }
    function to($to){
        self::$to = $to;
        return new self;
    }
    function subject($subj){
        self::$subj = $subj;
        return new self;
    }
    function body($message){
        self::$message = $message;
        return new self;
    }
    function files($files = null){
        self::$files = $files;
        return new self;
    }
    function send(){
        ini_set('sendmail_from', self::$from);
        $headers =      "From: ".self::$from."\n" .
            "Return-Path: <".self::$from.">\r\n" .
            "MIME-Version: 1.0\n";
        if(!(is_array(self::$files) || count(self::$files))) {
            $headers .=     "Content-Type: text/html; charset=\"UTF-8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n";
        }
        else {
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            $headers .=     "Content-Type: multipart/mixed; boundary=\"{$mime_boundary}\"\n";
            self:: $message =      "--{$mime_boundary}\n" .
                "Content-Type: text/plain; charset=\"UTF-8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" .
                self::$message . "\n\n";
            foreach(self::$files as $fn) {
                $f = basename($fn);
                if(!is_file($fn))
                    continue;
                $data = chunk_split(base64_encode(file_get_contents($fn)));
                self::$message .=     "--{$mime_boundary}\n" .
                    "Content-Type: application/octet-stream; name=\"$f\"\n" .
                    "Content-Description: $f\n" .
                    "Content-Disposition: attachment; filename=\"$f\"; size=".filesize($fn).";\n" .
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
            self::$message .= "--{$mime_boundary}--";
        }
        return @mail(self::$to, self::$subj, self::$message, $headers);
    }
}