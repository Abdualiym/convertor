<?php

namespace app\convertor;

interface TreeConvertorInterface
{
    public function convert(array $dataArray): array;
}