<?php
/**
 * @author: Sergey Naryshkin
 * @date: 15.02.2018
 */

namespace SnowSerge\Sql2Orm\Dto;


interface FieldDto
{
    public function printDeclaration(): string;
    public function printGetter(): string;
    public function printSetter(): string;
}