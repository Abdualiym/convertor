<?php

namespace unit\convertor;

use app\convertor\CSVParser;
use app\convertor\FileManager;
use Codeception\Test\Unit;
use ParseCsv\Csv;
use UnitTester;

class CSVParserTest extends Unit
{
    /**
     * @var UnitTester
     */
    public $tester;
    private $file;
    public const BASE_DIR = 'tests/_data/files';

    protected function _before()
    {
        $this->file = new FileManager();
        $this->file->setup(self::BASE_DIR, self::BASE_DIR);
    }

    public function testGotCorrectArray(): void
    {
        $parser = new CSVParser($this->file, new Csv());
        verify($parser->getParsedArray())->arrayCount(3);
    }
}
