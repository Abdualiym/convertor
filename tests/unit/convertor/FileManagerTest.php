<?php

namespace unit\convertor;

use app\convertor\FileManager;
use Codeception\Test\Unit;
use UnitTester;

class FileManagerTest extends Unit
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

    public function testInputFileCorrect(): void
    {
        verify($this->file->getInputFile())->equals(self::BASE_DIR . '/input.csv');
    }

    public function testCorrectSaveToJson(): void
    {
        $array = [
            'itemName' => 'Total',
            'parent' => null,
            'children' => [
                [
                    'itemName' => 'ПВЛ',
                    'parent' => 'Total',
                    'children' => []
                ]
            ]
        ];

        $this->file->saveAsJson($array);

        $outputFile = self::BASE_DIR . '/output.json';
        verify($outputFile)->fileExists();

        verify($outputFile)->jsonFileEqualsJsonFile($outputFile);
    }
}
