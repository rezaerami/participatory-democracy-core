<?php


namespace App\Helpers;


use Hashids\Hashids;

class StringHelpers
{
    /**
     * @return string
     */
    public static function randomKeyGenerate()
    {
        $random = rand(0, 1000000);
        $time = time();
        return StringHelpers::idToHashId($random.$time);
    }


    /**
     * @param $id
     * @return string
     */
    public static function idToHashId($id)
    {
        $hashId = new Hashids(env('HASHIDS_SALT'));
        return $hashId->encode($id) ?? null;
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function hashIdToId($code)
    {
        $hashId = new Hashids(env('HASHIDS_SALT'));

        $result = $hashId->decode($code);

        return $result[0] ?? null;
    }

    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
