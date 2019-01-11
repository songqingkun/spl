<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/10
 * Time: 11:32
 */

namespace yiswoole\Spl\Component\Validate;


class Rule
{
    protected $ruleMap = [];//验证规则集合

    function getRuleMap(): array
    {
        return $this->ruleMap;
    }

    public function float($msg = null)
    {
        $this->ruleMap['float'] = [
            'arg'   =>  null,
            'msg'   =>  $msg
        ];
        return $this;
    }
}