<?php

namespace app\convertor;

use ParseCsv\Csv;
use RuntimeException;

class CSVParser implements CSVParserInterface
{
    private CSV $csv;
    private FileManagerInterface $file;

    public function __construct(FileManagerInterface $file, Csv $csv)
    {
        $this->csv = $csv;
        $this->file = $file;
        $this->init();
    }

    private function init(): void
    {
        $this->csv->input_encoding = 'UTF-8';
        $this->csv->delimiter = ";";
    }

    public function validateRowCount(int $rowLimit = 20000, bool $throwWhenExceed = true): void
    {
        if ($throwWhenExceed) {
            $this->csv->loadFile($this->file->getInputFile());
            if ($this->csv->getTotalDataRowCount() > $rowLimit) {
                throw new RuntimeException("Input file content more than expected $rowLimit rows");
            }
        } else {
            $this->csv->limit = $rowLimit;
        }
    }

    public function getParsedArray(): array
    {
        $this->csv->parseFile($this->file->getInputFile());
        return $this->csv->data;
    }

}
