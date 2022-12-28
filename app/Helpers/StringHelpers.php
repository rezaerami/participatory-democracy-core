<?php


namespace App\Helpers;


use Hashids\Hashids;

class StringHelpers
{
    /**
     * @param $id
     * @return string
     */
    public static function idToHashId($id)
    {
        $hashId = new Hashids(env('HASHIDS_SALT'));
        return $hashId->encode($id);
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function hashIdToId($code)
    {
        $hashId = new Hashids(env('HASHIDS_SALT'));
        return $hashId->decode($code)[0];
    }
}
