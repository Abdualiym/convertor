<?php

namespace app\commands;

use app\convertor\CSVParserInterface;
use app\convertor\FileManagerInterface;
use app\useCases\TreeService;
use Exception;
use yii\console\Controller;
use yii\console\ExitCode;

class GenController extends Controller
{
    private FileManagerInterface $file;
    private CSVParserInterface $parser;
    private TreeService $service;

    public function __construct($id, $module, FileManagerInterface $file, CSVParserInterface $parser, TreeService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->file = $file;
        $this->parser = $parser;
        $this->service = $service;
    }

    public function actionTree(string $inputFilePath = '/app/files', string $outputFilePath = '/app/files', int $rowLimit = 20000, bool $throwWhenExceed = true): int
    {
        try {
            $this->file->setup($inputFilePath, $outputFilePath);
            $this->parser->validateRowCount($rowLimit, $throwWhenExceed);
            $this->service->convert($this->file, $this->parser);
            echo "Done\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            return ExitCode::DATAERR;
        }
    }
}
