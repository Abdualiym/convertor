<?php

namespace app\converter;

use ParseCsv\Csv;
use RuntimeException;

class CSVParser
{
    private CSV $csv;
    private string $inputFile;

    public function __construct(string $inputFile)
    {
        $this->csv = new Csv();
        $this->inputFile = $inputFile;
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
            $this->csv->loadFile($this->inputFile);
            if ($this->csv->getTotalDataRowCount() > $rowLimit) {
                throw new \RuntimeException("Input file content more than expected $rowLimit rows");
            }
        } else {
            $this->csv->limit = $rowLimit;
        }
    }

    public function getParsedArray(): array
    {
        $this->csv->parseFile($this->inputFile);
        return $this->csv->data;
    }

}
