<?php
/**
 * Created by unkown ide ps.
 * User: phantom
 * Date Time: 6/14/17 4:44 PM
 */

namespace Aop\Utils;

class Parse
{

    public static function xml2array($xml_str)
    {
        libxml_disable_entity_loader(true);
        $xml_string = simplexml_load_string(
            $xml_str,
            'SimpleXMLElement',
            LIBXML_NOCDATA);

        $array = json_decode(json_encode($xml_string), true);
        return $array;
    }

    public static function xml2json($xml_str)
    {
        libxml_disable_entity_loader(true);
        $xml_string = simplexml_load_string(
            $xml_str,
            'SimpleXMLElement',
            LIBXML_NOCDATA);

        $array = json_encode($xml_string);
        return $array;
    }

    /**
     * json to xml
     *
     * @param $json
     * @return string
     */
    public static function json2xml($json)
    {
        $array = json_decode($json, true);
        $xml = self::array2xml($array);

        return $xml;
    }

    public static function array2xml($arr, $dom = 0, $item = 0)
    {
        if (!$dom) {
            $dom = new \DOMDocument("1.0");
        }
        if (!$item) {
            $item = $dom->createElement("root");
            $dom->appendChild($item);
        }
        foreach ($arr as $key => $val) {
            $itemx = $dom->createElement(is_string($key) ? $key : "item");
            $item->appendChild($itemx);
            if (!is_array($val)) {
                $text = $dom->createTextNode($val);
                $itemx->appendChild($text);
            } else {
                self::array2xml($val, $dom, $itemx);
            }
        }
        return $dom->saveXML();
    }

    public static function json2array($json, $assoc = JSON_UNESCAPED_UNICODE)
    {
        $array = json_decode($json, $assoc);

        return $array;
    }

}
