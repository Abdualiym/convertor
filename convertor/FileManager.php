<?php

namespace app\convertor;

use RuntimeException;

class FileManager
{
    public const INPUT_FILE = 'input.csv';
    public const OUTPUT_FILE = 'output.json';
    private string $inputFile;
    private string $outputFile;

    public function __construct(string $inputFilePath, string $outputFilePath)
    {
        $this->inputFile = rtrim($inputFilePath, '/') . DIRECTORY_SEPARATOR . self::INPUT_FILE;
        if (!is_file($this->inputFile)) {
            throw new RuntimeException('No such input file or directory');
        }

        $this->outputFile = rtrim($outputFilePath, '/') . DIRECTORY_SEPARATOR . self::OUTPUT_FILE;
        if (!is_dir($outputFilePath)) {
            throw new RuntimeException('No such output file directory');
        }
    }

    public function getInputFile(): string
    {
        return $this->inputFile;
    }

    private function toJson(array $data)
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        } catch (\JsonException $e) {
            throw new RuntimeException("Error on converting to json: " . $e->getMessage());
        }
    }

    public function saveAsJson(array $data): void
    {
        $jsonData = $this->toJson($data);
        file_put_contents($this->outputFile, $jsonData);
    }
}