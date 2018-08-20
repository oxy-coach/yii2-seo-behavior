<?php
namespace oxycoach\seobehavior;

/**
 * Helps to generate transliterated string from cyrillic
 */
class TransliterationHelper
{
    /**
     * Creating slug from string
     * @param string $str Input string
     * @return string Generated slug
     */
    public static function createSlug(string $str)
    {
        $chpu = trim($str);
        $chpu = self::translit($chpu);
        $chpu = str_replace("'", '', $chpu);
        $chpu = str_replace('"', '', $chpu);
        $chpu = str_replace(" ", '-', $chpu);
        $chpu = str_replace(".", '', $chpu);
        $chpu = str_replace(",", '', $chpu);
        $chpu = str_replace("+", '', $chpu);
        $chpu = str_replace("/", '-', $chpu);
        $chpu = str_replace("\\", '-', $chpu);
        $pattern = '|[^A-Za-z0-9ЙФЯЧЫЦУВСМАКЕПИТРНГОЬБЛШЩДЮЖЗХЭЪЁёйфячыцувсмакепитрнгоьблшщдюзжхэъ-]|';
        $chpu = preg_replace($pattern, '', $chpu);
        $chpu = strtolower($chpu);
        $chpu = preg_replace('/[\-]{2,}/', '-', $chpu);
        $chpu = iconv('UTF-8', 'UTF-8//IGNORE', $chpu);
        return $chpu;
    }

    /**
     * Transliterate cyrillic string
     * @param string $string String to transliterate
     * @return string Result string
     */
    private static function transliterate(string $string)
    {
        $converter = [
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ];
        return strtr($string, $converter);
    }
}
