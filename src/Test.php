<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/4
 * Time: 17:23
 */

namespace yiswoole\Spl;

class Test
{
    public function __construct()
    {
//        $info = new \stdClass();
//        $info->id = 1;
//        $splBean = new Student($info);
//        print_r($splBean->getId());
//
//        $splArr = new SplArray([
//            'A', 'B', 'C', 'D', 'A'
//        ]);
//        $splArr->delete(1);
        $splStream = new SplStream(fopen('/home/song/aliases.sh', 'r+'));
        print_r($splStream->getContents());
        $splStream->truncate();
        print_r('-------------------------------------');
        print_r('+++++++++++++++++++++++++++++++++++++');
        print_r($splStream->getContents());
    }

}