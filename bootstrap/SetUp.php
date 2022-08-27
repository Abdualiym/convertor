<?php

namespace app\bootstrap;

use app\convertor\CSVParser;
use app\convertor\CSVParserInterface;
use app\convertor\FileManager;
use app\convertor\FileManagerInterface;
use app\convertor\TreeConvertor;
use app\convertor\TreeConvertorInterface;
use ParseCsv\Csv;
use Yii;
use yii\base\BootstrapInterface;
use yii\di\Container;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = Yii::$container;

        $container->setSingleton(FileManagerInterface::class, FileManager::class);

        $container->setSingleton(CSVParserInterface::class, static function (Container $container) {
            return new CSVParser($container->get(FileManagerInterface::class), new Csv());
        });

        $container->setSingleton(TreeConvertorInterface::class, TreeConvertor::class);
    }
}