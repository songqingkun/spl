<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/10
 * Time: 14:02
 */

namespace yiswoole\Spl;


class SplArray extends \ArrayObject
{
    function __get($name)
    {
        // TODO: Implement __get() method.
        if (isset($this[$name])) {
            return $this[$name];
        }
        return null;
    }

    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this[$name] = $value;
    }

    function getArrayClone()
    {
        return (array)$this;
    }

    public function get($key)
    {
        $data = $this->getArrayClone();
        if (isset($data[$key])) {
            return $data[$key];
        }
        return null;
    }

    public function set($key, $value)
    {
        $temp = $this;
        $temp = &$temp[$key];
        $temp = $value;
    }

    public function delete($key)
    {
        $data = $this->getArrayClone();
        $copy = &$data;
        if (isset($copy[$key])) {
            unset($copy[$key]);
        }
        parent::__construct($data);
    }

    public function multiple()
    {
        //获取数组中重复的值
        $unique_arr = array_unique($this->getArrayClone());
        return new SplArray(array_diff_assoc($this->getArrayClone(), $unique_arr));
    }
}