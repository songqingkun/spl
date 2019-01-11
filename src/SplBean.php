<?php


/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/4
 * Time: 16:39
 */

namespace yiswoole\Spl;


class SplBean implements \JsonSerializable
{
    public function __construct($data = null)
    {
        if (is_object($data)) {
            $data =get_object_vars($data);
        }
        if (is_array($data)) {
            $this->array2Bean($data);
        }
    }

    final public function jsonSerialize()
    {

    }

    public function test()
    {
        print_r('dddd');
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "";
    }

    public function array2Bean($data = array())
    {
        foreach ($data as $k => $v)
        {
            $this->addProperty($k, $v);
        }
        return $this;
    }

    public function addProperty($name = null, $value = null)
    {
        $this->$name = $value;
    }

    public function getProperty($name = null)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }
}