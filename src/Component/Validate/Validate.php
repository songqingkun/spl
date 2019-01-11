<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/10
 * Time: 11:22
 */

namespace yiswoole\Spl\Component\Validate;


use yiswoole\Spl\SplArray;

class Validate
{
    protected $columns = [];//需要验证的数据
    protected $error;

    protected $verifyData = [];//验证通过的数据

    public function addColumn($name)
    {
        $rule = new Rule();
        $this->columns[$name] = [
            'rule'  =>  $rule
        ];
        return $rule;
    }

    protected function validate($data = [])
    {
        $splArr = new SplArray();
        //循环检测需要验证的数据
        foreach ($this->columns as $column => $item) {
            /**@var Rule $rule*/
            $rule = $item['rule'];
            $rules = $rule->getRuleMap();

            foreach ($rules as $ruleName => $ruleInfo) {
                if (!call_user_func([$this, $ruleName], $splArr, $column, $ruleInfo['arg'])) {
                    return false;
                }
            }

            $this->verifyData[$column] = $splArr->get($column);
        }

        return true;
    }
}