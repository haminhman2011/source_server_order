<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\gii\generators\enum;

use Yii;
use yii\gii\CodeFile;

class Generator extends \yii\gii\generators\model\Generator
{
    public $enumName = '';
    public $properties = '';
    public $ns = 'backend\models\enum';
    public $index = 2;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Enum Generator';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'Khởi tạo clas Enum';
    }

    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['enumName', 'properties', 'index'], 'safe'],
            ]);
    }

    /**
     * @inheritdoc
     */
    public function hints()
    {
        return array_merge(parent::hints(), [
            'enumName'   => 'Sử dụng camel case <code>CustomerStatus</code>.',
            'properties' => 'Danh sách constant <code> pending abvc, done </code>',
            'index'      => 'Giá trị bắt đầu của constant',
        ]);
    }

    public function scenarios()
    {
        $scenarios        = parent::scenarios();
        $scenarios['all'] = [];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $files   = [];
        $files[] = new CodeFile(
            Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '\\' . $this->enumName . '.php', $this->render('enum.php')
        );

        return $files;
    }
}
