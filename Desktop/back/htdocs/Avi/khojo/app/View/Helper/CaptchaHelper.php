<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Captcha
 *
 * @author vijayj
 */
App::uses('AppHelper', 'View/Helper');

class CaptchaHelper extends AppHelper {

    var $components = array('Session');
    var $helpers = array('Html', 'Form', 'Session');

    public function captchaCode() {
        $code = $this->generateCode();
        //echo $code;die;
        //$this->Session->write('captchaCode', $code);
        $im = imagecreatetruecolor(50, 24);
        $bg = imagecolorallocate($im, 22, 86, 165); //background color blue
        $fg = imagecolorallocate($im, 255, 255, 255); //text color white
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 5, 5, $code, $fg);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);        die();
    }

    
    function generateCode($length=6) {
            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'),range('A', 'Z'));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }

            return $key;
        }
}
