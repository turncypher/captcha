<?php
/**
 * Created by PhpStorm.
 * User: emmanuel
 * Date: 18-1-5
 * Time: 上午11:30
 */

namespace NovaStar\Captcha;

use Intervention\Image\ImageManager;

class Captcha
{
    private $config;

    /**
     * Captcha constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $config = [
            'ttf_file' => __DIR__ . '/../assets/AHGBold.ttf',
            'wordlist_file' => __DIR__ . '/../assets/words/words.txt',
            'perturbation'  => mt_rand(1,2),
            'image_width'  => 230,
            'image_height'  => 60,
            'num_lines'  => 3,
            'background' => __DIR__ . '/../assets/backgrounds/bg4.jpg'
        ];
        $this->config = $config;
    }

    public function getCaptcha()
    {
        $types = [SecureImage::SI_CAPTCHA_MATHEMATIC, SecureImage::SI_CAPTCHA_WORDS];

        $img = new SecureImage($this->config);

        $res = $img->show($this->config['background']);
        $manager = new ImageManager(array('driver' => 'gd'));
        $image = $manager->make($res);
        echo $image->response();
    }

    public function check($captcha)
    {
        $img = new SecureImage();
        return $img->check($captcha);
    }
}