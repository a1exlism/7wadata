<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SupportCountry
{

    // define countrys
    private static $countrys = array('en', 'sv', 'hn', 'gt', 'ni', 'gh', 'mx', 'pa', 'do', 'ec', 'co', 'pe', 'bo', 'es', 'jm', 'br', 'cr');
    private static $countrys_info = array(
        'en' =>  array(
            'name' => 'United States',
            'img' => 'usa.png'
            ),
        'sv' =>  array(
            'name' => 'El Salvador',
            'img' => 'el_salvador.png'
            ),
        'gt' =>  array(
            'name' => 'Guatemala',
            'img' => 'guatemala.png'
            ),
        'hn' =>  array(
            'name' => 'Honduras',
            'img' => 'honduras.png'
            ),
        'ni' =>  array(
            'name' => 'Nicaragua',
            'img' => 'nicaragua.png'
            ),
        'gh' =>  array(
            'name' => 'Ghana',
            'img' => 'ghana.jpg'
            ),
        'mx' =>  array(
            'name' => 'Mexico',
            'img' => 'mexico.jpg'
            ),
        'pa' =>  array(
            'name' => 'Panama',
            'img' => 'panama.png'
            ),
        'do' =>  array(
            'name' => 'Dominican',
            'img' => 'dominican_republic.png'
            ),
        'ec' =>  array(
            'name' => 'Ecuador',
            'img' => 'ecuador.png'
            ),
        'co' =>  array(
            'name' => 'Colombia',
            'img' => 'colombia.png'
            ),
        'pe' =>  array(
            'name' => 'Perú',
            'img' => 'peru.png'
            ),
        'bo' =>  array(
            'name' => 'Bolivia',
            'img' => 'bolivia.png'
            ),
        'es' =>  array(
            'name' => 'España',
            'img' => 'spain.png'
            ),
        'jm' =>  array(
            'name' => 'Jamaica',
            'img' => 'jamaica.png'
            ),
        'br' =>  array(
            'name' => 'Brasil',
            'img' => 'brazil.png'
            ),
        'cr' =>  array(
            'name' => 'Costa Rica',
            'img' => 'costa_rica.png'
            )
    );

    // default country
    private static $default_country = 'en';

    public function __construct()
    {
    }

    public static function getSupportCountrys()
    {
        return self::$countrys;
    }

    public static function getCountryInfoByCode($country_code)
    {
        if (empty($country_code)) {
            return null;
        }

        if (!in_array($country_code, self::$countrys)) {
            return null;
        }

        return self::$countrys_info[$country_code];
    }

    public static function getCountryInfoByCodeNotNull($country_code)
    {
        $temp_val = self::getCountryInfoByCode($country_code);

        if (is_null($temp_val)) {
            return self::$countrys_info[$default_country];
        }

        return $temp_val;
    }

    public static function getSupportCountrysDetail()
    {
        return self::$countrys_info;
    }
}
