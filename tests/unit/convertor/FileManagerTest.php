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
    public const BASE_DIR = 'tests/_data/files';

    public function testInputFileCorrect(): void
    {
        $file = new FileManager(self::BASE_DIR, self::BASE_DIR);
        verify($file->getInputFile())->equals(self::BASE_DIR . '/input.csv');
    }

    public function testCorrectSaveToJson(): void
    {
        $file = new FileManager(self::BASE_DIR, self::BASE_DIR);
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

        $file->saveAsJson($array);

        $outputFile = self::BASE_DIR . '/output.json';
        verify($outputFile)->fileExists();

        verify($outputFile)->jsonFileEqualsJsonFile($outputFile);
    }
}
