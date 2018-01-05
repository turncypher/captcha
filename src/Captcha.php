<?php
/**
 * Created by PhpStorm.
 * User: emmanuel
 * Date: 18-1-5
 * Time: 上午11:30
 */

namespace NovaStar\Captcha;

class Captcha
{

    public function getCaptcha()
    {
        $types = [SecureImage::SI_CAPTCHA_WORDS, SecureImage::SI_CAPTCHA_MATHEMATIC];

        $img = new SecureImage();
        $img->ttf_file = __DIR__ . '/../assets/AHGBold.ttf';
        $img->wordlist_file = __DIR__ . '/../assets/words/words.txt';
        $img->captcha_type = mt_rand(1, 2);
        $img->captcha_type = SecureImage::SI_CAPTCHA_WORDS;
        $img->perturbation = 0.5;
        $img->image_width = 230;
        $img->image_height = 60;
        $img->num_lines = mt_rand(3, 4);
        return $img->show( 'backgrounds/bg4.jpg');
    }
}