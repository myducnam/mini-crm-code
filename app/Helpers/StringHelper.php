<?php

use Illuminate\Support\HtmlString;

// 自作helper関数

if (! function_exists('convert_semicolon_to')) {
    /**
     * セミコロンを指定文字に変換する
     *
     * @param string $string
     * @param string $glue 区切り文字
     *
     * @return string
     */
    function convert_semicolon_to($string, $glue)
    {
        $exploded = explode(';', $string);

        return implode($glue, $exploded);
    }
}

if (! function_exists('mb_str_pad')) {
    /**
     * マルチバイト文字の桁数を指定し、残りを指定文字で埋める
     *
     * @see https://www.php.net/manual/ja/ref.mbstring.php#90611
     *
     * @param string $input
     * @param int $padLength 文字桁数
     * @param string $padString 埋める文字列
     * @param $padStyle STR_PAD_RIGHT:左詰め右埋め
     *
     * @return string
     */
    function mb_str_pad($input, $padLength, $padString = ' ', $padStyle = STR_PAD_RIGHT)
    {
        $mbPadLength = strlen($input) - mb_strlen($input, 'UTF-8') + $padLength;

        return str_pad($input, $mbPadLength, $padString, $padStyle);
    }
}

if (! function_exists('empty_to_null')) {
    function empty_to_null($value)
    {
        return '' === $value ? null : $value;
    }
}

if (! function_exists('nl2br_e')) {
    function nl2br_e($value)
    {
        return new HtmlString(nl2br(e($value)));
    }
}
