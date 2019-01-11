<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/11
 * Time: 15:35
 */

namespace yiswoole\Spl;


class SplFileStream extends SplStream
{

    public function __construct(string $resource = '', string $mode = 'r+')
    {
        $fp = fopen($resource, $mode);
        parent::__construct($fp);
    }

    /**
     * 锁定
     * @param int $mode
     * @return bool
     */
    public function lock($mode = LOCK_EX)
    {
        return flock($this->getStream(), $mode);
    }

    /**
     * 解锁
     * @return bool
     */
    public function unlock()
    {
        return flock($this->getStream(), LOCK_UN);
    }

}