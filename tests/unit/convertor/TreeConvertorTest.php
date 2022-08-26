<?php

namespace unit\convertor;

use app\converter\CSVParser;
use app\converter\TreeConvertor;
use Codeception\Test\Unit;
use UnitTester;
use yii\helpers\VarDumper;

class TreeConvertorTest extends Unit
{
    /**
     * @var UnitTester
     */
    public $tester;

    public function testGotCorrectTree(): void
    {
        $convertor = new TreeConvertor();
        $array = [
            0 => [
                'Item Name' => 'Total',
                'Type' => 'Изделия и компоненты',
                'Parent' => '',
                'Relation' => '',
            ],
            1 => [
                'Item Name' => 'ПВЛ',
                'Type' => 'Изделия и компоненты',
                'Parent' => 'Total',
                'Relation' => '',
            ],
            2 => [
                'Item Name' => 'Стандарт.#1',
                'Type' => 'Варианты комплектации',
                'Parent' => 'ПВЛ',
                'Relation' => '',
            ]
        ];

        $tree = $convertor->convert($array);
        verify($tree[0])->arrayHasKey('itemName');
        verify($tree[0])->arrayHasNotKey('Type');
    }
}
