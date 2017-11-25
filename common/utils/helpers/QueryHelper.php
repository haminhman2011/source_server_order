<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 7/19/2017
 * Time: 11:27 AM
 */

namespace common\utils\helpers;

class QueryHelper
{
    /**
     * @param $query
     * @param array $params
     *
     * @return array|null
     * @throws \yii\db\Exception
     */
    public static function queryColumn($query, array $params = [])
    {
        if (empty($query)) {
            return null;
        }

        return \Yii::$app->db->createCommand($query)->bindValues($params)->queryColumn();
    }

    /**
     * @param $query
     * @param array $params
     *
     * @return array|null
     * @throws \yii\db\Exception
     */
    public static function queryAll($query, array $params = [])
    {
        if (empty($query)) {
            return null;
        }

        return \Yii::$app->db->createCommand($query)->bindValues($params)->queryAll();
    }

    /**
     * @param $query
     * @param array $params
     *
     * @return false|string
     * @throws \yii\db\Exception
     */
    public static function queryScalar($query, array $params = [])
    {
        if (empty($query)) {
            return null;
        }

        return \Yii::$app->db->createCommand($query)->bindValues($params)->queryScalar();
    }

    /**
     * @param $query
     * @param array $params
     *
     * @return false|null|string
     * @throws \yii\db\Exception
     */
    public static function queryOne($query, array $params = [])
    {
        if (empty($query)) {
            return null;
        }

        return \Yii::$app->db->createCommand($query)->bindValues($params)->queryOne();
    }

    /**
     * @param $query
     * @param array $params
     * @param string $fetchMode
     *
     * @return array|false|null
     * @throws \yii\db\Exception
     */
    public static function query($query, array $params = [], $fetchMode = 'column')
    {
        if (empty($query)) {
            return null;
        }

        switch ($fetchMode) {
            case 'all':
                return self::queryAll($query, $params);
                break;
            case 'one':
                return self::queryOne($query, $params);
                break;
            case 'scalar':
                return self::queryScalar($query, $params);
                break;
            default:
                return self::queryColumn($query, $params);
                break;
        }
    }

    /**
     * @param $query
     * @param array $params
     *
     * @return string
     */
    public static function getRawSql($query, array $params = [])
    {
        return \Yii::$app->db->createCommand($query)->bindValues($params)->getRawSql();
    }

    /**
     * @param $tableName
     * @param $columns
     * @param $datas
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function batchInsert($tableName, $columns, $datas)
    {
        return \Yii::$app->db->createCommand()->batchInsert($tableName, $columns, $datas)->execute() > 0;
    }

    /**
     * @param $query
     * @param $params
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function execute($query, $params)
    {
        return \Yii::$app->db->createCommand($query)->bindValues($params)->execute() > 0;
    }
}