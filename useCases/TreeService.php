<?php

namespace app\useCases;

use app\convertor\CSVParserInterface;
use app\convertor\FileManagerInterface;
use app\convertor\TreeConvertorInterface;

class TreeService
{
    private TreeConvertorInterface $convertor;

    public function __construct(TreeConvertorInterface $convertor)
    {
        $this->convertor = $convertor;
    }

    public function convert(FileManagerInterface $file, CSVParserInterface $parser): void
    {
        $parsedArray = $parser->getParsedArray();
        $result = $this->convertor->convert($parsedArray);
        $file->saveAsJson($result);
    }

}
