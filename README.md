# php-tools

<a href="https://github.com/996icu/996.ICU/blob/master/LICENSE"><img src="https://img.shields.io/badge/support-996.icu-red.svg"></a>

> php Development Kit, years of work experience, packaging simple way to make development easier.

## composer安装

```shell
composer require zetaiota/func
```

## 分词方法
```php
$content = "北京大学生喝进口红酒，在北京大学生活区喝进口红酒";
Dict::participle($content); //参数说明：$content(分词内容) $participle_type(分词切割类型) $type(读取字典类型)
//北京大学|生喝|进口|红酒|，|在|北京大学|生活区|喝|进口|红酒
//$arr 是一个数组 每个单元的结构[词语,词语位置,词性,这个词语是否包含在词典中] 这里只值列出了词语

```