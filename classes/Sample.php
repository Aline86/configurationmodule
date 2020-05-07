<?php
class Sample extends ObjectModel
{
 
    public $id_configuration;
    public $id_shop_group;
    public $id_shop;
    public $name;
    public $value;
    public $date_add;
    public $date_upd;
 
    public static $definition = [
        'table' => 'ps_configuration',
        'primary' => 'id_configuration',
        'multilang' => true,
        'fields' => [
            'id_shop_group' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'size' => 25],
            'id_shop' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'size' => 25],
            'name' => ['type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255],
            'value' => ['type' => self::TYPE_STRING, 'validate' => 'isUnsignedInt', 'size' => 255],
            'date_add' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
            'date_upd' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
        ],
    ];
    
}