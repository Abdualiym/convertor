<?php

namespace unit\convertor;

use app\converter\CSVParser;
use Codeception\Test\Unit;
use UnitTester;
use yii\helpers\VarDumper;

class CSVParserTest extends Unit
{
    /**
     * @var UnitTester
     */
    public $tester;

    public function testGotCorrectArray(): void
    {
        $parser = new CSVParser(FileManagerTest::BASE_DIR . '/input.csv');
        verify($parser->getParsedArray())->arrayCount(3);
    }
}
