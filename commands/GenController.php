<?php

namespace app\commands;

use app\converter\CSVParser;
use app\converter\FileManager;
use app\converter\TreeConvertor;
use RuntimeException;
use yii\console\Controller;
use yii\console\ExitCode;

class GenController extends Controller
{
    public function actionTree(string $inputFilePath = '/app/files', string $outputFilePath = '/app/files', int $rowLimit = 20000, bool $throwWhenExceed = true): int
    {
        try {
            $file = new FileManager($inputFilePath, $outputFilePath);

            $parser = new CSVParser($file->getInputFile());
            $parser->validateRowCount($rowLimit, $throwWhenExceed);
            $parsedArray = $parser->getParsedArray();

            $convertor = new TreeConvertor();
            $result = $convertor->convert($parsedArray);

            $file->saveAsJson($result);

            echo "Done\n";
            return ExitCode::OK;
        } catch (RuntimeException $e) {
            echo $e->getMessage() . "\n";
            return ExitCode::DATAERR;
        }
    }
}
