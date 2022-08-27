<?php

namespace app\convertor;

use yii\helpers\VarDumper;

class TreeConvertor
{
    public const THROUGH_COMP = 'Прямые компоненты';

    public function convert(array $dataArray): array
    {
        $indexedArray = $this->indexByParent($dataArray);
        $tree = [];
        foreach ($indexedArray as $id => &$data) {
            if (empty($data['Parent'])) {
                $tree[$id] = &$data;
            } else {
                $indexedArray[$data['Parent']]['children'][$id] = &$data;
                if ($data['Type'] === self::THROUGH_COMP) {
                    $indexedArray[$data['Parent']]['children'][$id]['children'] = &$indexedArray[$data['Relation']]['children'];
                }
            }
        }
        unset($data);

        return $this->reFormatTree($tree);
    }

    private function reFormatTree(array $tree): array
    {
        $newTree = [];
        foreach ($tree as $itemName => $array) {
            $new = [];
            $new['itemName'] = $array['Item Name'];
            $new['parent'] = $array['Parent'];
            $new['children'] = (isset($array['children']) && is_array($array['children']) && count($array['children']))
                ? $this->reFormatTree($array['children'])
                : [];
            $newTree[] = $new;
        }

        return $newTree;
    }

    private function indexByParent($array): array
    {
        $indexedArray = [];
        foreach ($array as $item) {
            $indexedArray[$item['Item Name']] = $item;
        }
        return $indexedArray;
    }
}