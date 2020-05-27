<?php


namespace src\Participle;


use src\Participle\Lib\VicDict;
use src\Participle\Lib\VicWord;

//参考资料：https://github.com/lizhichao/VicWord
//qq的分词 http://nlp.qq.com/semantic.cgi#page2
//百度的分词 http://ai.baidu.com/tech/nlp/lexical
class Dict
{
    /**
     * @description 添加词库
     *
     * @param string $words          词语
     * @param string $part_of_speech 词性
     * @param string $type           类型
     *
     * @return bool|int
     * @throws \Exception
     */
    public static function addWord($words, $part_of_speech, $type = 'igb')
    {
        $dict = new VicDict($type);

        $dict->add($words, $part_of_speech);

        return $dict->save();
    }

    /**
     * @description 分词
     * @modify
     *
     * @param  string $content         分词段落
     * @param int     $participle_type 分词切割类型
     * @param string  $type            读取字典类型
     *
     * @return array
     * @throws \Exception
     */
    public static function participle($content, $participle_type = 1, $type = 'igb')
    {
        $participle = new VicWord($type);

        switch ($participle_type) {
            case $participle_type == 1;
                return $participle->getWord($content);
            case $participle_type == 2;
                return $participle->getShortWord($content);
            default;
                return $participle->getAutoWord($content);
        }
    }

}