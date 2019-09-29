<?php

namespace App;

use Illuminate\Http\Request;

class DataModel //extends Model
{
    private static $urlMoneyList = "http://www.cbr.ru/scripts/XML_val.asp?d=0";
    private static $arrayMoneyList = [];
    private static $moneyValue;

    /**
     * @param $url string
     */
    private static function MoneyList($url)
    {

        $xml = new \SimpleXMLElement(file_get_contents($url));
        foreach ($xml->Item as $item) {
            self::$arrayMoneyList[] = [$item->Name->__toString(), trim($item->ParentCode->__toString())];
        }
    }

    /**
     * @param $url string
     */
    private static function Money($url)
    {
        $xml = new \SimpleXMLElement(file_get_contents($url));

        if (!empty($xml->Record->Value)) {
            self::$moneyValue = $xml->Record->Value->__toString();
        } else {
            self::$moneyValue = "нет данных";
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function dataForm(Request $request): array
    {
        self::MoneyList(self::$urlMoneyList);
        $input = $request->all();

        $dateDefault = $input['date'] ?? date('Y-m-d');
        $id = $input['id'] ?? 'R01235';

        list($year, $month, $day) = explode('-', $dateDefault);
        $dateURL = $day . "/" . $month . "/" . $year;
        $urlMoney = "http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1="
            . $dateURL . "&date_req2="
            . $dateURL . "&VAL_NM_RQ="
            . $id;

        self::Money($urlMoney);

        $data = [
            'ogrn' => $input['ogrn'],
            '_token' => $input['_token'],
            'money' => self::$moneyValue,
            'date' => $dateDefault,
            'id' => $id,
            'arrMoney' => self::$arrayMoneyList
        ];
        return $data;
    }

}
