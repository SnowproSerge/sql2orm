<?php
/**
 * @author: Sergey Naryshkin
 * @date: 22.03.2018
 */

namespace SnowSerge\Sql2Orm\Helper;


use PHPUnit\Framework\TestCase;

class ConvertingNamesHelperTest extends TestCase
{

    public function dataProviderSnakeToCamel() :array
    {
        return [
            'simple-f' => ['camel',false,'camel'],
            'snake-f' => ['camel-case-will-work',false,'camelCaseWillWork'],
            'snake_f' => ['camel_case_-_will_work',false,'camelCaseWillWork'],
            'snake-_f' => ['camel_case-will_work',false,'camelCaseWillWork'],
            'Snake-f' => ['Camel_case-will_work',false,'camelCaseWillWork'],
            'SNAKE_f' => ['CAMEL_case-will_work',false,'camelCaseWillWork'],
            'SNAKE_Sf' => ['CAMEL_CASE-WILL_WORK',false,'camelCaseWillWork'],
            'simple-t' => ['camel',true,'Camel'],
            'snake-t' => ['camel-case-will-work',true,'CamelCaseWillWork'],
            'snake_t' => ['camel_case_will_work',true,'CamelCaseWillWork'],
            'snake-_t' => ['camel_case-will_work',true,'CamelCaseWillWork'],
            'Snake-t' => ['Camel_case-will_work',true,'CamelCaseWillWork'],
            'SNAKE_t' => ['CAMEL_case-will_work',true,'CamelCaseWillWork'],
            'SNAKE_St' => ['CAMEL_CASE-WILL_WORK',true,'CamelCaseWillWork']
        ];
    }

    /**
     * @param $in1
     * @param $in2
     * @param $out
     * @throws \Exception
     * @dataProvider dataProviderSnakeToCamel
     */
    public function testSnakeToCamel($in1,$in2,$out) :void
    {
        $this->assertEquals($out,ConvertingNamesHelper::snakeToCamel($in1,$in2));
    }
}
