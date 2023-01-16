<?php

if (! function_exists('xml_to_array')) {
    function xml_to_array(string $xmlContent): array
    {
        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA + LIBXML_NOBLANKS);
        $json = str_replace('{}', '""', json_encode($xml));

        return json_decode($json, true);
    }
}
