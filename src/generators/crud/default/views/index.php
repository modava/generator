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

echo "<?php\n";
?>

use <?= $ns ?>\<?= $generator->messageCategory ?>\<?= ucfirst($generator->messageCategory) ?>Module;
use <?= $ns ?>\<?= $generator->messageCategory ?>\widgets\NavbarWidgets;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\ToastrWidget;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= "<?=" ?> ToastrWidget::widget(['key' => 'toastr-' . $searchModel->toastr_key . '-index']) <?= "?>\n" ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?> Html::encode($this->title) <?= "?>\n" ?>
        </h4>
        <a class="btn btn-outline-light" href="<?= "<?=" ?> \yii\helpers\Url::to(['create']); <?= "?>" ?>"
           title="<?= "<?=" ?> <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>">
            <i class="fa fa-plus"></i> <?= "<?=" ?> <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?></a>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">

                <?= $generator->enablePjax ? "<?php Pjax::begin(); ?>\n" : '' ?>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="dataTables_wrapper dt-bootstrap4">
                                <?php if ($generator->indexWidgetType === 'grid'): ?>
<?= "<?= " ?>GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '
                                        {errors}
                                        <div class="row">
                                            <div class="col-sm-12">
                                                {items}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" role="status" aria-live="polite">
                                                    {pager}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers">
                                                    {summary}
                                                </div>
                                            </div>
                                        </div>
                                    ',
                                    'pager' => [
                                        'firstPageLabel' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'First'),
                                        'lastPageLabel' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Last'),
                                        'prevPageLabel' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Previous'),
                                        'nextPageLabel' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Next'),
                                        'maxButtonCount' => 5,

                                        'options' => [
                                            'tag' => 'ul',
                                            'class' => 'pagination',
                                        ],

                                        // Customzing CSS class for pager link
                                        'linkOptions' => ['class' => 'page-link'],
                                        'activePageCssClass' => 'active',
                                        'disabledPageCssClass' => 'disabled page-disabled',
                                        'pageCssClass' => 'page-item',

                                        // Customzing CSS class for navigating link
                                        'prevPageCssClass' => 'paginate_button page-item',
                                        'nextPageCssClass' => 'paginate_button page-item',
                                        'firstPageCssClass' => 'paginate_button page-item',
                                        'lastPageCssClass' => 'paginate_button page-item',
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
                                    <?php if(in_array('title', $generator->getColumnNames())) { ?>
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
                                                if(in_array($name, ['id', 'status', 'slug', 'created_at', 'created_by', 'updated_at', 'updated_by'])) {
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
                                                if(in_array($column->name, ['id', 'status', 'slug', 'created_at', 'created_by', 'updated_at', 'updated_by'])) {
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
<?php if(in_array('created_by', $generator->getColumnNames())) { ?>
                                        [
                                            'attribute' => 'created_by',
                                            'value' => 'userCreated.userProfile.fullname',
                                            'headerOptions' => [
                                                'width' => 150,
                                            ],
                                        ],
<?php } ?>
<?php if(in_array('created_by', $generator->getColumnNames())) { ?>
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
                                            'header' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Actions'),
                                            'template' => '{update} {delete}',
                                            'buttons' => [
                                                'update' => function ($url, $model) {
                                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'title' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Update'),
                                                        'alia-label' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Update'),
                                                        'data-pjax' => 0,
                                                        'class' => 'btn btn-info btn-xs'
                                                    ]);
                                                },
                                                'delete' => function ($url, $model) {
                                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:;', [
                                                        'title' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Delete'),
                                                        'class' => 'btn btn-danger btn-xs btn-del',
                                                        'data-title' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Delete?'),
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
$script = <<< JS
$('body').on('click', '.success-delete', function(e){
    e.preventDefault();
    var url = $(this).attr('href') || null;
    if(url !== null){
        $.post(url);
    }
    return false;
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);