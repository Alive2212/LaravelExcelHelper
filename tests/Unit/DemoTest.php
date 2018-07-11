<?php

namespace Alive2212\ExcelHelperTest\Unit;

use Alive2212\ExcelHelper\ExcelHelperServiceProvider;
use Alive2212\ExcelHelper\SkeletonClass;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class DemoTest extends TestCase
{
    protected $app;

    public function __construct()
    {
        $this->app = new Container();
        $this->app->bind('excel', 'Alive2212\ExcelHelper\ExcelHelper');

        $app = $this->createApplication();
    }

    public function createApplication()
    {
        $app = new Container();
        $app->bind('app', 'Illuminate\Container\Container');

        $app->bind('excel', 'Alive2212\ExcelHelper\ExcelHelper');

        Facade::setFacadeApplication($app);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $testArray = [
            [
                'name' => 'Babak',
                'family' => 'Nodoust',
                'description' => 'I am powerful man in dokhan since 2017 for ever',
            ],
            [
                'name' => 'Elnaz',
                'family' => 'Moslemi',
                'description' => 'I am smart woman of the world',
            ],
        ];
        $excelHelper = $this->app->make('excel');

        $skeleton = new SkeletonClass();
        $this->assertTrue(true);
        echo PHP_EOL . "check skeleton" . PHP_EOL;

        $serviceProvider = new ExcelHelperServiceProvider(new Container());
        $this->assertTrue(true);
        echo PHP_EOL . "check service provider" . PHP_EOL;

        $this->assertNotEmpty(($excelHelper->table($testArray)->createExcelFile()));
        echo PHP_EOL . "basic test Passed" . PHP_EOL;

        $this->assertArrayHasKey('store_format', $excelHelper->getOptions());
        echo PHP_EOL . "getOptions method Passed" . PHP_EOL;

        $this->assertNotEmpty($excelHelper->setOptions(['test' => 'I am most strong man in dokhan']));
        echo PHP_EOL . "setOptions method Passed" . PHP_EOL;

        $arrayTable = $excelHelper->getArrayTable();
        $this->assertTrue($arrayTable == []);
        echo PHP_EOL . "getArrayTable Passed" . PHP_EOL;

        $this->assertNull($excelHelper->setArrayTable($testArray));
        echo PHP_EOL . "setArrayTable Passed" . PHP_EOL;

        $this->assertNull(($excelHelper->exportTable($testArray)));
        echo PHP_EOL . "exportTable Passed" . PHP_EOL;

        $this->assertNotEmpty(($excelHelper->getInnerValue($testArray, '1.name')));
        echo PHP_EOL . "exportTable Passed" . PHP_EOL;

        $titles = $excelHelper->titleCrawler($testArray);
        $this->assertTrue($titles[0][0] == "name");
        echo PHP_EOL . "titleCrawler Passed" . PHP_EOL;

        $table = $excelHelper->table($titles[0]);
        $this->assertObjectHasAttribute('options',$table);
        echo PHP_EOL . "titleCrawler Passed" . PHP_EOL;

        $titles = $excelHelper->getTitleOfArrayTable($testArray);
        $this->assertTrue($titles[0] == "name");
        echo PHP_EOL . "titleCrawler Passed" . PHP_EOL;

        $excelHelper->setExcel("");
        $excelHelper->getExcel();
        $this->assertTrue(true);
        echo PHP_EOL . "setter getter of Excel Passed" . PHP_EOL;


        $excelHelper->setArrayTable([]);
        $excelHelper->getArrayTable();
        $this->assertTrue(true);
        echo PHP_EOL . "setter getter of ArrayTable Passed" . PHP_EOL;


    }
}
