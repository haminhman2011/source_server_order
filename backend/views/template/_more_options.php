<?php
/**
 * Template more option cho trang idnex
 * Option mặc định là : Kích hoạt, Vô hiệu hóa, Xóa
 * Created by PhpStorm.
 * User: Team
 * Date: 8/16/2017
 * Time: 10:37 AM
 */

use yii\helpers\Url;

/** @var string $url */
/** @var string $table */
/** @var array $params */
$options = [
	Yii::t( 'yii', 'Enable' )  => 1,
	Yii::t( 'yii', 'Disable' ) => 0,
	Yii::t( 'yii', 'Delete' )  => - 1,
];
if ( $params != null ) {
	$options = $params;
}
?>
<div class="action-create form-group">
	<?php if ( Yii::$app->permission->can( Yii::$app->controller->id, 'create' ) ) : ?>
        <a class="btn blue-steel" href="<?= Url::to( [ 'create' ] ) ?>" title="<?= Yii::t( 'yii', 'Create' ) ?>"><?= Yii::t( 'yii', 'Create' ) ?></a>
	<?php endif; ?>
</div>
<div class="action-filter">
    <div class="input-action">
        <select id="select_more_option" class="select" title="" data-url="<?= $url ?>" data-placeholder="More">
            <option></option>
			<?php foreach ( $options as $key => $value ): ?>
                <option value="<?= $value ?>"><?= $key ?></option>
			<?php endforeach ?>
        </select>
    </div>
</div>
<div class="clearfix"></div>
<script>
    'use strict';
    $(function() {
        let body = $('body');
        $('#select_more_option').on('change', function() {
            let action = $(this).val();
            if (action !== '') {
                if ($('.cb-single:checked').length === 0) {
                    body.toast({
                        type: 'warning',
                        content: '<?= Yii::t( 'yii', 'No column selected' ); ?>'
                    });
                    $(this).val('').trigger('change');
                } else {
                    let modelIds = Team.getValues('cb-single:checked', 'id');
                    if (action !== '') {
                        Team.action($(this), '<?= Yii::t( 'yii', 'Are you sure you want to change this item?' ) ?>', $('#<?= $table ?>').DataTable(), {action: action, modelIds: JSON.stringify(modelIds)}, 'warning');
                    } else {
                        body.toast({
                            type: 'warning',
                            content: '<?= Yii::t( 'yii', 'No action selected' ); ?>'
                        });
                    }
                }
            }
        });
    });
</script>