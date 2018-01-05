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

    private $captchaTypes = [
        SecureImage::SI_CAPTCHA_MATHEMATIC,
        SecureImage::SI_CAPTCHA_WORDS,
    ];

    /**
     * Captcha constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $config = [
            'ttf_file' => 'AHGBold.ttf',
            'wordlist_file' => 'words.txt',
            'perturbation'  => 0.5,
            'image_width'  => 230,
            'image_height'  => 60,
            'num_lines'  => 3,
            'background' => 'bg4.jpg',
            'captcha_type' => 'random'
        ];
        if ($config['captcha_type'] == 'random') {
            $config['captcha_type'] = $this->captchaTypes[array_rand($this->captchaTypes)];
        }
        $config['ttf_file'] = __DIR__ . '/../assets/' . $config['ttf_file'];
        $config['wordlist_file'] = __DIR__ . '/../assets/words/' . $config['wordlist_file'];
        $config['background'] = __DIR__ . '/../assets/backgrounds/' . $config['background'];
        $this->config = $config;
    }

    public function getCaptcha()
    {
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