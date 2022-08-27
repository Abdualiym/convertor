<?php

namespace app\convertor;

interface CSVParserInterface
{
    public function validateRowCount(int $rowLimit, bool $throwWhenExceed): void;

    public function getParsedArray(): array;
}
