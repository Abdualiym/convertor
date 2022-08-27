<?php

namespace app\convertor;

interface FileManagerInterface
{
    public function getInputFile(): string;

    public function setup(string $inputFilePath, string $outputFilePath): void;

    public function saveAsJson(array $data): void;
}