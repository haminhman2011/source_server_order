<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\gii\generators\models;

use Yii;
use yii\gii\CodeFile;

/**
 * This generator will generate one or multiple ActiveRecord classes for the specified database table.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\generators\model\Generator {
	public $tableName = 'default';
	public $modelClass = 'default';
	public $generateDataTable = true;
	public $generateBeforeSave = true;
	public $generateQuery = true;
	public $tableNs = 'backend\models\table';
	public $ns = 'backend\models';
	public $queryNs = 'backend\models\query';
	public $queryBaseClass = 'backend\utilities\query\CustomActiveQuery';
	public $messageCategory = 'yii';
	public $defaultLanguage = 'vi';

	/**
	 * @inheritdoc
	 */
	public function getName() {
		return 'All Double Model Generator';
	}

	/**
	 * @inheritdoc
	 */
	public function getDescription() {
		return 'Khởi tạo model cho tất cả table trong database, bao gồm: file model, file modal base, file datatable(nếu có), file custom active query(nếu có)';
	}

	/**
	 * @inheritdoc
	 */
	public function requiredTemplates() {
		return [ 'model.php', 'modelbase.php' ];
	}

	public function rules() {
		return array_merge( parent::rules(),
			[
				[ [ 'generateDataTable', 'generateBeforeSave', 'tableName', 'modelClass', 'defaultLanguage' ], 'safe' ],
				[ [ 'tableName' ], 'validateTableName', 'skipOnEmpty' => true ],
				[ [ 'modelClass' ], 'validateModelClass', 'skipOnEmpty' => true ],
			] );
	}

	public function scenarios() {
		$scenarios        = parent::scenarios();
		$scenarios['all'] = [ ];

		return $scenarios;
	}

	public function attributeLabels() {
		return array_merge( parent::attributeLabels(),
			[
				'generateDataTable'  => 'Tạo data table',
				'generateBeforeSave' => 'Tạo giá trị mặc định trước khi save',
				'generateQuery'      => 'Sử dụng class cutom active query',
				'messageCategory'    => 'Tên category nếu kích hoạt đa ngôn ngữ',
				'enableI18N'         => 'Đa ngôn ngữ'
			] );
	}

	/**
	 * @inheritdoc
	 */
	public function generate() {
		$files     = [ ];
		$relations = $this->generateRelations();
		$db        = $this->getDbConnection();

		foreach ( $db->getSchema()->tableNames as $tableName ) {
			// model :
			$modelClassName = $this->generateClassName( $tableName );
			$queryClassName = $this->generateQuery ? $this->generateQueryClassName( $modelClassName ) : false;
			$tableSchema    = $db->getTableSchema( $tableName );
			$params         = [
				'tableName'      => $tableName,
				'className'      => $modelClassName,
				'queryClassName' => $queryClassName,
				'tableSchema'    => $tableSchema,
				'labels'         => $this->generateLabels( $tableSchema ),
				'rules'          => $this->generateRules( $tableSchema ),
				'relations'      => isset( $relations[ $tableName ] ) ? $relations[ $tableName ] : [ ],
				'beforeSave'     => $this->generateBeforeSave,
				'hasAttribute'   => count(array_intersect(['created_by', 'modified_by', 'created_date', 'modified_date'], $tableSchema->getColumnNames())) == 4
			];
			if ( ! file_exists( Yii::getAlias( '@' . str_replace( '\\', '/', $this->ns ) ) . '/' . $modelClassName . '.php' ) ) {
				$files[] = new CodeFile(
					Yii::getAlias( '@' . str_replace( '\\', '/', $this->ns ) ) . '/' . $modelClassName . '.php', $this->render( 'model.php', $params )
				);
			}
			$files[] = new CodeFile(
				Yii::getAlias( '@' . str_replace( '\\', '/', $this->ns ) ) . '/base/' . $modelClassName . 'Base.php', $this->render( 'modelbase.php', $params )
			);
			if ( $this->generateDataTable &&
			     ! file_exists( Yii::getAlias( '@' . str_replace( '\\', '/', $this->tableNs ) ) . '/' . $modelClassName . 'Table.php' )
			) {
				$params  = [
					'tableName'      => $tableName,
					'className'      => $modelClassName,
					'tableClassName' => $modelClassName . 'Table',
					'tableNs'        => $this->tableNs,
					'labels'         => $this->generateLabels( $tableSchema ),
				];
				$files[] = new CodeFile(
					Yii::getAlias( '@' . str_replace( '\\', '/', $this->tableNs ) ) . '/' . $modelClassName . 'Table.php', $this->render( 'table.php', $params )
				);
			}
			// query :
			if ( $queryClassName ) {
				$params['className']      = $queryClassName;
				$params['modelClassName'] = $modelClassName;
				$files[]                  = new CodeFile(
					Yii::getAlias( '@' . str_replace( '\\', '/', $this->queryNs ) ) . '/' . $queryClassName . '.php', $this->render( 'query.php', $params )
				);
			}
		}

		return $files;
	}
}
