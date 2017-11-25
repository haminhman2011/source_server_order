<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\gii\generators\cruds;

use Yii;
use yii\db\ActiveRecord;
use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\Controller;

/**
 * Generates CRUD
 *
 * @property array $columnNames Model column names. This property is read-only.
 * @property string $controllerID The controller ID (without the module ID prefix). This property is
 * read-only.
 * @property array $searchAttributes Searchable attributes. This property is read-only.
 * @property boolean|\yii\db\TableSchema $tableSchema This property is read-only.
 * @property string $viewPath The controller view path. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator {
	public $modelClass = 'backend\models';
	public $controllerClass = '';
	public $baseControllerClass = Controller::class;
	public $isModal = false;
	public $isFilter = false;
	public $isModule = false;
	public $indexWidgetType;
	public $searchModelClass;
	public $viewPath = '';
	public $moduleName = '';
	public $messageCategory = 'yii';
	public $defaultLanguage = 'vi';
	public $models = '';
	public $enableI18N = false;
	/**
	 * @var boolean whether to wrap the `GridView` or `ListView` widget with the `yii\widgets\Pjax` widget
	 * @since 2.0.5
	 */
	public $enablePjax = false;

	/**
	 * @inheritdoc
	 */
	public function getName() {
		return 'CRUDs Generator';
	}

	/**
	 * @inheritdoc
	 */
	public function getDescription() {
		return 'Tạo tất cả file controller và views thực hiện chức năng Thêm Xóa Sửa Xem cho tất cả model đã được tạo';
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return array_merge( parent::attributeLabels(), [
			'modelClass'          => 'Model Class',
			'controllerClass'     => 'Controller Class',
			'viewPath'            => 'Đường dẫn folder view',
			'baseControllerClass' => 'Base Controller Class',
			'indexWidgetType'     => 'Widget Used in Index Page',
			'searchModelClass'    => 'Search Model Class',
			'enablePjax'          => 'Enable Pjax',
			'isModal'             => 'Sử dụng form modal',
			'isFilter'            => 'Sử dụng form filter ở trang index',
			'enableI18N'          => 'Kích hoạt đa ngôn ngữ',
			'messageCategory'     => 'Tên category nếu kích hoạt đa ngôn ngữ',
			'isModule'            => 'Tạo file cho module',
			'moduleName'          => 'Tên module'
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return array_merge( parent::rules(), [
			[ [ 'isFilter', 'defaultLanguage', 'models' ], 'safe' ],
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function hints() {
		return array_merge( parent::hints(), [
			'modelClass'          => 'This is the ActiveRecord class associated with the table that CRUD will be built upon.
                You should provide a fully qualified class name, e.g., <code>app\models\Post</code>.',
			'controllerClass'     => 'This is the name of the controller class to be generated. You should
                provide a fully qualified namespaced class (e.g. <code>app\controllers\PostController</code>),
                and class name should be in CamelCase with an uppercase first letter. Make sure the class
                is using the same namespace as specified by your application\'s controllerNamespace property.',
			'viewPath'            => 'Specify the directory for storing the view scripts for the controller. You may use path alias here, e.g.,
                <code>backend/material/views/product</code>, <code>@backend/material/views/product</code>. If not set, it will default
                to <code>@app/views/ControllerID</code>',
			'baseControllerClass' => 'This is the class that the new CRUD controller class will extend from.
                You should provide a fully qualified class name, e.g., <code>yii\web\Controller</code>.',
			'indexWidgetType'     => 'This is the widget type to be used in the index page to display list of the models.
                You may choose either <code>GridView</code> or <code>ListView</code>',
			'searchModelClass'    => 'This is the name of the search model class to be generated. You should provide a fully
                qualified namespaced class name, e.g., <code>app\models\PostSearch</code>.',
			'enablePjax'          => 'This indicates whether the generator should wrap the <code>GridView</code> or <code>ListView</code>
                widget on the index page with <code>yii\widgets\Pjax</code> widget. Set this to <code>true</code> if you want to get
                sorting, filtering and pagination without page refreshing.',
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function requiredTemplates() {
		return [ 'controller.php' ];
	}

	/**
	 * @inheritdoc
	 */
	public function stickyAttributes() {
		return array_merge( parent::stickyAttributes(), [ 'baseControllerClass', 'indexWidgetType', 'isModal' ] );
	}

	/**
	 * Checks if model class is valid
	 */
	public function validateModelClass() {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		$pk    = $class::primaryKey();
		if ( empty( $pk ) ) {
			$this->addError( 'modelClass', "The table associated with $class must have primary key(s)." );
		}
	}

	public function scenarios() {
		$scenarios        = parent::scenarios();
		$scenarios['all'] = [];

		return $scenarios;
	}

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidParamException
     */
	public function generate() {
		$modelPath = Yii::getAlias( '@app/models/' );
		$models    = $this->models != null ? array_map('strtolower', StringHelper::explode( $this->models )) : [];
		$files     = [];
		foreach ( scandir( $modelPath ) as $key => $modelFile ) {
			$fileName = pathinfo( $modelFile, PATHINFO_FILENAME );
			if ( $modelFile === '.gitkeep' ||
			     ! is_file( $modelPath . '/' . $modelFile ) ||
			     pathinfo( $modelFile, PATHINFO_EXTENSION ) !== 'php') {
				continue;
			}
            if (! empty($models) && ! in_array( strtolower( $fileName ), $models, true ) ) {
                continue;
            }
            $this->controllerClass = $this->moduleName == '' ? 'backend\controllers' : "backend\\$this->moduleName\\controllers";
            $this->controllerClass .= '\\' . explode( '.', $modelFile )[0] . 'Controller';
            $this->modelClass .= '\\' . explode( '.', $modelFile )[0];
            $controllerFile = Yii::getAlias( '@' . str_replace( '\\', '/', ltrim( $this->controllerClass, '\\' ) ) . '.php' );
            $files []       = new CodeFile( $controllerFile, $this->render( 'controller.php', [ 'isModal' => $this->isModal ] ) );

			$viewPath        = $this->getViewPath();
			$templatePhpPath = $this->getTemplatePath() . '/views';

			foreach ( scandir( $templatePhpPath ) as $file ) {
				if ( ! $this->isFilter && $file === '_search.php' ) {
					continue;
				}
				if ( is_file( $templatePhpPath . '/' . $file ) && pathinfo( $file, PATHINFO_EXTENSION ) === 'php' ) {
					$files[] = new CodeFile( "$viewPath/$file", $this->render( "views/$file" ) );
				}
			}
			$this->modelClass = 'backend\models';
		}

		return $files;
	}

	/**
	 * @return string the controller ID (without the module ID prefix)
	 */
	public function getControllerID() {
		$pos   = strrpos( $this->controllerClass, '\\' );
		$class = substr( substr( $this->controllerClass, $pos + 1 ), 0, - 10 );

		return Inflector::camel2id( $class );
	}

    /**
     * @return string the controller view path
     * @throws \yii\base\InvalidParamException
     */
	public function getViewPath() {
		if ( empty( $this->viewPath ) ) {
			return Yii::getAlias( '@app/views/' . $this->getControllerID() );
		} else {
			return Yii::getAlias( $this->viewPath );
		}
	}

	public function getNameAttribute() {
		foreach ( $this->getColumnNames() as $name ) {
			if ( ! strcasecmp( $name, 'title' ) || StringHelper::endsWith( $name, 'name' ) ) {
				return $name;
			}
		}
		/* @var $class \yii\db\ActiveRecord */
		$class = $this->modelClass;
		$pk    = $class::primaryKey();

		return $pk[0];
	}

	public function getDeleteAttribute() {
		foreach ( $this->getColumnNames() as $name ) {
			if ( ! strcasecmp( $name, 'status' ) || StringHelper::endsWith( $name, 'delete' ) ) {
				return $name;
			}
		}
	}

	/**
	 * Generates column format
	 *
	 * @param \yii\db\ColumnSchema $column
	 *
	 * @return string
	 */
	public function generateColumnFormat( $column ) {
		if ( $column->phpType === 'boolean' ) {
			return 'boolean';
		} elseif ( $column->type === 'text' ) {
			return 'ntext';
		} elseif ( stripos( $column->name, 'time' ) !== false && $column->phpType === 'integer' ) {
			return 'datetime';
		} elseif ( stripos( $column->name, 'email' ) !== false ) {
			return 'email';
		} elseif ( stripos( $column->name, 'url' ) !== false ) {
			return 'url';
		} else {
			return 'text';
		}
	}

	/**
	 * Generates URL parameters
	 * @return string
	 */
	public function generateUrlParams() {
		/* @var $class ActiveRecord */
		$class             = $this->modelClass;
		$pks               = $class::primaryKey();
		$modelVariableName = Inflector::variablize( StringHelper::basename( $this->modelClass ) );
		if ( count( $pks ) === 1 ) {
			if ( is_subclass_of( $class, 'yii\mongodb\ActiveRecord' ) ) {
				return "'id' => (string)\${$modelVariableName}->{$pks[0]}";
			} else {
				return "'id' => \${$modelVariableName}->{$pks[0]}";
			}
		} else {
			$params = [];
			foreach ( $pks as $pk ) {
				if ( is_subclass_of( $class, 'yii\mongodb\ActiveRecord' ) ) {
					$params[] = "'$pk' => (string)\${$modelVariableName}->$pk";
				} else {
					$params[] = "'$pk' => \${$modelVariableName}->$pk";
				}
			}

			return implode( ', ', $params );
		}
	}

	/**
	 * Generates action parameters
	 * @return string
	 */
	public function generateActionParams() {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		$pks   = $class::primaryKey();

		if ( count( $pks ) === 1 ) {
			return '$id';
		} else {
			return '$' . implode( ', $', $pks );
		}
	}

    /**
     * Generates parameter tags for phpdoc
     * @return array parameter tags for phpdoc
     * @throws \yii\base\InvalidConfigException
     */
	public function generateActionParamComments() {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		$pks   = $class::primaryKey();
		if ( ( $table = $this->getTableSchema() ) === false ) {
			$params = [];
			foreach ( $pks as $pk ) {
				$params[] = '@param ' . ( substr( strtolower( $pk ), - 2 ) == 'id' ? 'integer' : 'string' ) . ' $' . $pk;
			}

			return $params;
		}
		if ( count( $pks ) === 1 ) {
			return [ '@param ' . $table->columns[ $pks[0] ]->phpType . ' $id' ];
		} else {
			$params = [];
			foreach ( $pks as $pk ) {
				$params[] = '@param ' . $table->columns[ $pk ]->phpType . ' $' . $pk;
			}

			return $params;
		}
	}

    /**
     * Returns table schema for current model class or false if it is not an active record
     * @return boolean|\yii\db\TableSchema
     * @throws \yii\base\InvalidConfigException
     */
	public function getTableSchema() {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		if ( is_subclass_of( $class, ActiveRecord::class) ) {
			return $class::getTableSchema();
		} else {
			return false;
		}
	}

    /**
     * @return array model column names
     * @throws \yii\base\InvalidConfigException
     */
	public function getColumnNames() {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		if ( is_subclass_of( $class, ActiveRecord::class) ) {
			return $class::getTableSchema()->getColumnNames();
		} else {
			/* @var $model \yii\base\Model */
			$model = new $class();

			return $model->attributes();
		}
	}

	public function getColumn( $name ) {
		/* @var $class ActiveRecord */
		$class = $this->modelClass;
		if ( is_subclass_of( $class, ActiveRecord::class) ) {
			return $class::getTableSchema()->getColumn( $name );
		} else {
			/* @var $model \yii\base\Model */
			$model = new $class();

			return $model->attributes();
		}
	}
}
