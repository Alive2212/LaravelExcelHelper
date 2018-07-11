<?php
/**
 * Created by PhpStorm.
 * User: alive
 * Date: 4/17/18
 * Time: 2:58 AM
 */

namespace Alive2212\LaravelExcelHelper;

use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class ExcelHelper
{
    protected $options = [
        'store_format' => 'xls',
        'download_format' => 'xls',
        'title' => 'title',
        'creator' => 'user',
        'company' => 'Alive Co',
        'description' => 'this is excel file from table',
        'sheet' => 'sheet1',
    ];

    protected $excel = '';

    protected $table = '';

    protected $arrayTable = [];

    /**
     * ExcelHelper constructor.
     */
    public function __construct()
    {
    }

    static function create(){
//        dd("Taylor Swift felt to Babak Nodoust Love");
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     * download excel
     */
    public function download()
    {
        return $this->excel->store($this->options['store_format'])->download($this->options['download_format']);
    }

    /**
     * @param $arrayTable
     */
    public function exportTable($arrayTable)
    {
        $this->arrayTable = $arrayTable;
        $this->table();
        $this->options;
        $this->createExcelFile();
    }

    public function createExcelFile()
    {
        $options = $this->options;
        $table = $this->table;
        $this->excel = Excel::create('payments', function (LaravelExcelWriter $excel) use ($table, $options) {
            $excel->setTitle($options['title']);
            $excel->setCreator($options['creator'])->setCompany($options['company']);
            $excel->setDescription($options['description']);
            $closer = function (LaravelExcelWorksheet $sheet) use ($table){
                $sheet->fromArray($table, null, 'A1', false, false);
            };
            $excel->sheet("sheet", $closer);
        });
        return $this;
    }

    /**
     * @param $arrayTables
     * @return array
     * @internal param string $key
     * @internal param $arrayTable
     */
    public function getTitleOfArrayTable($arrayTables)
    {
        $result = [];
        foreach ($arrayTables as $arrayTable) {
            list($titles, $key) = $this->titleCrawler($arrayTable);
            foreach ($titles as $title) {
                if (!is_int(array_search($title, $result))) {
                    array_push($result, $title);
                }
            }
        }
        return $result;
    }

    /**
     * @param $arrayTable
     * @param string $parentKey
     * @return array
     */
    public function titleCrawler($arrayTable, $parentKey = '')
    {
        $result = [];
        $titlesKey = '';
        foreach ($arrayTable as $key => $value) {
            if (is_array($value)) {
                list($titles, $titlesKey) = $this->titleCrawler($value, $parentKey == '' ? $key : $parentKey . '.' . $key);
                foreach ($titles as $titleKey => $titleValue) {
                    array_push($result, $titlesKey == '' ? $titleValue : $titlesKey . '.' . $titleValue);
                }
            } else {
                array_push($result, $parentKey == '' ? $key : $parentKey . '.' . $key);
            }
        }
        return array($result, $titlesKey);
    }

    /**
     * @param array $titles
     * @param bool $setHeader
     * @return $this
     */
    public function table($titles = [], $setHeader = true)
    {
        $arrayTable = $this->arrayTable;
        $result = [];
        if (count($titles) == 0) {
            $titles = $this->getTitleOfArrayTable($arrayTable);
        }
        if ($setHeader) {
            array_push($result, $titles);
        }
        foreach ($arrayTable as $item) {
            $arrayTableRecord = [];
            foreach ($titles as $title) {
                if (array_key_exists(explode('.', $title)[0], $item)) {
                    array_push($arrayTableRecord, $this->getInnerValue($item, $title));
                } else {
                    array_push($arrayTableRecord, null);
                }
            }
            array_push($result, $arrayTableRecord);
        }
        $this->table = $result;
        return $this;
    }

    /**
     * @param $array
     * @param $key
     * @return mixed
     */
    public function getInnerValue($array, $key)
    {
        $keyTree = explode('.', $key);
        if (count($keyTree) > 1) {
            $key = $keyTree[0];
            unset($keyTree[0]);
            return $this->getInnerValue($array[$key], implode('.', $keyTree));
        } else {
            return $array[$keyTree[0]];
        }
    }

    /**
     * @param $arrayTable
     * @return mixed
     */
    public function arrayToTable($arrayTable)
    {
        $this->getTitleOfArrayTable($arrayTable);
        $this->table($arrayTable);
        return $arrayTable;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static)->$name(...$arguments);
    }

    /**
     * @return array
     */
    public function getArrayTable(): array
    {
        return $this->arrayTable;
    }

    /**
     * @param array $arrayTable
     */
    public function setArrayTable(array $arrayTable)
    {
        $this->arrayTable = $arrayTable;
    }

    /**
     * @return string
     */
    public function getExcel()
    {
        return $this->excel;
    }

    /**
     * @param string $excel
     */
    public function setExcel(string $excel)
    {
        $this->excel = $excel;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable(string $table)
    {
        $this->table = $table;
    }

}