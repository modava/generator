<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$ns = explode('\\', $generator->modelClass)[0];
$alias = $generator->getYiiAlias();

echo "<?php\n";
?>

use <?= $alias ?>widgets\NavbarWidgets;
use yii\helpers\Html;
use common\grid\MyGridView;
use backend\widgets\ToastrWidget;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid px-xxl-15 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?> Html::encode($this->title) <?= "?>\n" ?>
        </h4>
        <a class="btn btn-outline-light btn-sm" href="<?= "<?=" ?> \yii\helpers\Url::to(['create']); <?= "?>" ?>"
           title="<?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>">
            <i class="fa fa-plus"></i> <?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>
        </a>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper index">

                <?= $generator->enablePjax ? "<?php Pjax::begin(['id' => 'dt-pjax', 'timeout' => false, 'enablePushState' => true, 'clientOptions' => ['method' => 'GET']]); ?>\n" : '' ?>
                <?= "<?=" ?> ToastrWidget::widget(['key' => 'toastr-' . $searchModel->toastr_key .
                '-index']) <?= "?>\n" ?>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="dataTables_wrapper dt-bootstrap4">
                                <?php if ($generator->indexWidgetType === 'grid'): ?>
                                    <?= "<?= " ?>MyGridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '
                                        {errors}
                                        <div class="pane-single-table">
                                            {items}
                                        </div>
                                        <div class="pager-wrap clearfix">
                                            {summary}' .
                                            Yii::$app->controller->renderPartial('@backend/views/layouts/my-gridview/_pageTo',
                                            [
                                                'totalPage' => $totalPage,
                                                'currentPage' =>
                                                Yii::$app->request->get($dataProvider->getPagination()->pageParam)
                                            ]) .
                                            Yii::$app->controller->renderPartial('@backend/views/layouts/my-gridview/_pageSize')
                                            .
                                            '{pager}
                                        </div>
                                    ',
                                    'tableOptions' => [
                                    'id' => 'dataTable',
                                    'class' => 'dt-grid dt-widget pane-hScroll',
                                    ],
                                    'myOptions' => [
                                    'class' => 'dt-grid-content my-content pane-vScroll',
                                    'data-minus' => '{"0":95,"1":".hk-navbar","2":".nav-tabs","3":".hk-pg-header","4":".hk-footer-wrap"}'
                                    ],
                                    'summaryOptions' => [
                                    'class' => 'summary pull-right',
                                    ],
                                    'pager' => [
                                    'firstPageLabel' => Yii::t('<?= $generator->messageCategory ?>', 'First'),
                                    'lastPageLabel' => Yii::t('<?= $generator->messageCategory ?>', 'Last'),
                                    'prevPageLabel' => Yii::t('<?= $generator->messageCategory ?>', 'Previous'),
                                    'nextPageLabel' => Yii::t('<?= $generator->messageCategory ?>', 'Next'),
                                    'maxButtonCount' => 5,

                                    'options' => [
                                    'tag' => 'ul',
                                    'class' => 'pagination pull-left',
                                    ],

                                    // Customzing CSS class for pager link
                                    'linkOptions' => ['class' => 'page-link'],
                                    'activePageCssClass' => 'active',
                                    'disabledPageCssClass' => 'disabled page-disabled',
                                    'pageCssClass' => 'page-item',

                                    // Customzing CSS class for navigating link
                                    'prevPageCssClass' => 'paginate_button page-item prev',
                                    'nextPageCssClass' => 'paginate_button page-item next',
                                    'firstPageCssClass' => 'paginate_button page-item first',
                                    'lastPageCssClass' => 'paginate_button page-item last',
                                    ],
                                    'columns' => [
                                    [
                                    'class' => 'yii\grid\SerialColumn',
                                    'header' => 'STT',
                                    'headerOptions' => [
                                    'width' => 60,
                                    'rowspan' => 2
                                    ],
                                    'filterOptions' => [
                                    'class' => 'd-none',
                                    ],
                                    ],
                                    <?php if (in_array('title', $generator->getColumnNames())) { ?>
                                        [
                                        'attribute' => 'title',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                        return Html::a($model->title, ['view', 'id' => $model->id], [
                                        'title' => $model->title,
                                        'data-pjax' => 0,
                                        ]);
                                        }
                                        ],
                                    <?php } ?>

                                    <?php
                                    $count = 0;
                                    if (($tableSchema = $generator->getTableSchema()) === false) {
                                        foreach ($generator->getColumnNames() as $name) {
                                            if (in_array($name, ['id', 'status', 'slug', 'created_at', 'created_by', 'updated_at', 'updated_by'])) {
                                                continue;
                                            }
                                            if (++$count < 6) {
                                                echo "\t\t\t\t\t\t\t\t\t\t'" . $name . "',\n";
                                            } else {
                                                echo "\t\t\t\t\t\t\t\t\t\t//'" . $name . "',\n";
                                            }
                                        }
                                    } else {
                                        foreach ($tableSchema->columns as $column) {
                                            if (in_array($column->name, ['id', 'status', 'slug', 'created_at', 'created_by', 'updated_at', 'updated_by'])) {
                                                continue;
                                            }
                                            $format = $generator->generateColumnFormat($column);
                                            if (++$count < 6) {
                                                echo "\t\t\t\t\t\t\t\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                            } else {
                                                echo "\t\t\t\t\t\t\t\t\t\t//'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if (in_array('created_by', $generator->getColumnNames())) { ?>
                                        [
                                        'attribute' => 'created_by',
                                        'value' => 'userCreated.userProfile.fullname',
                                        'headerOptions' => [
                                        'width' => 150,
                                        ],
                                        ],
                                    <?php } ?>
                                    <?php if (in_array('created_by', $generator->getColumnNames())) { ?>
                                        [
                                        'attribute' => 'created_at',
                                        'format' => 'date',
                                        'headerOptions' => [
                                        'width' => 150,
                                        ],
                                        ],
                                    <?php } ?>
                                    [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => Yii::t('<?= $generator->messageCategory ?>', 'Actions'),
                                    'template' => '{update} {delete}',
                                    'buttons' => [
                                    'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('<?= $generator->messageCategory ?>', 'Update'),
                                    'alia-label' => Yii::t('<?= $generator->messageCategory ?>', 'Update'),
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-info btn-xs'
                                    ]);
                                    },
                                    'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:;', [
                                    'title' => Yii::t('<?= $generator->messageCategory ?>', 'Delete'),
                                    'class' => 'btn btn-danger btn-xs btn-del',
                                    'data-title' => Yii::t('<?= $generator->messageCategory ?>', 'Delete?'),
                                    'data-pjax' => 0,
                                    'data-url' => $url,
                                    'btn-success-class' => 'success-delete',
                                    'btn-cancel-class' => 'cancel-delete',
                                    'data-placement' => 'top'
                                    ]);
                                    }
                                    ],
                                    'headerOptions' => [
                                    'width' => 150,
                                    ],
                                    ],
                                    ],
                                    ]); ?>
                                <?php else: ?>
                                    <?= "<?= " ?>ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemOptions' => ['class' => 'item'],
                                    'itemView' => function ($model, $key, $index, $widget) {
                                    return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                                    },
                                    ]) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $generator->enablePjax ? "<?php Pjax::end(); ?>\n" : '' ?>
            </section>
        </div>
    </div>
</div>
<?= "<?php\n" ?>
$urlChangePageSize = \yii\helpers\Url::toRoute(['perpage']);
$script = <<< JS
$('body').on('click', '.success-delete', function(e){
e.preventDefault();
var url = $(this).attr('href') || null;
if(url !== null){
$.post(url);
}
return false;
});
var customPjax = new myGridView();
customPjax.init({
pjaxId: '#dt-pjax',
urlChangePageSize: '$urlChangePageSize',
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);