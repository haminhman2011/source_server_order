<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\Bill;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\BillTable;
use yii\helpers\Url;

class BillController extends Controller
{
    /**
    * Hiện danh sách Bill.
    *
    * @return string
    */
    public function actionIndex()
    {
		$bill = new Bill();
        return $this->render('index', ['bill' => $bill]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new BillTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết Bill.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $billId = Yii::$app->request->get('id', '');
        $bill = $this->findModel($billId);
		return $this->render('view', [
			'bill' => $bill
		]);
	}

    /**
    * Hiện trang create Bill.
    *
    * @return string
    */
    public function actionCreate()
    {
		$bill = new Bill();
		return $this->render('create', [
			'bill' => $bill,
		]);
    }

    /**
    * Hiện trang update Bill.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $billId = Yii::$app->request->get('id', '');
		$bill = $this->findModel($billId);
		return $this->render('update', [
			'bill' => $bill
		]);
	}

    /**
    * Lưu Bill model.
    *
    * @return string:
    * - url: lưu thành công
    * - json: lưu thất bại, trả vể object lỗi
    * - An internal server error occurred: không load được model
    * @throws \yii\base\InvalidParamException
    * @throws NotFoundHttpException
    * @throws ServerErrorHttpException
    * @throws \yii\base\Exception
    * @throws \yii\db\Exception
    * @throws \yii\base\InvalidCallException
    */
	public function actionSave() {
		$billId = Yii::$app->request->post('Bill')['id'];
		$bill   = $billId != '' ? $this->findModel($billId) : new Bill();

		if ( $bill->load( Yii::$app->request->post() ) ) {
			if ( $bill->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($bill->errors);
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}


    /**
    * Cập nhật status Bill.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $billId = Yii::$app->request->post( 'id', '');
        $bill = Bill::findOne(['id' => $billId, 'status' => 1]);
        return $bill != null && $bill->updateAttributes( [ 'status' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax Bill.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectBill() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $bills = Bill::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'name', $query ] )->select( [ 'id', 'name' ] );

            return $this->asJson( [
                'total_count' => $bills->count(),
                'items'       => $bills->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}

    /**
    * @return mixed
    * @throws \PHPExcel_Exception
    * @throws \PHPExcel_Reader_Exception
    * @throws \PHPExcel_Writer_Exception
    */
    public function actionExportBill() {
        $objPHPExcel = new \PHPExcel();

        //PAGE SETUP
        //$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $titles = ['Name'];
        $colums = range('A', 'A');
        foreach ($colums as $key => $column) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValue($column . '2', $titles[$key]);
        }

        $row = 3;
        $bills = Bill::find()->status()->all();
        foreach ($bills as $bill) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $bill->name);
            $row++;
        }

        //ACTIVE SHEET STYLE FORMAT
        $objPHPExcel->getActiveSheet()->getStyle('A2:A2')->getFont()->setBold(true)->setSize(11);
        $objPHPExcel->getActiveSheet()->getStyle('A2:A2')->getAlignment()->applyFromArray(array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER))->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A2:A$row")->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=Bills_18.09.2017 16:42:47.xlsx ');
        header('Content-Transfer-Encoding: binary ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        return $objWriter->save('php://output');
    }

	/**
	* Tìm Bill model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $billId
	* @return Bill the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($billId) {
        if (($model = Bill::findOne(['id' => $billId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
