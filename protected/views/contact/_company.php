<?php

          $this->widget('booster.widgets.TbSelect2', array(
                                'htmlOptions' => array(
            'multiple' => 'multiple',
        ),
        'asDropDownList' => true,
        'model' => $company,
        'attribute' => 'comp_id',

        'options' => array(
            'placeholder' => $model->getAttributeLabel('comp_name'),
            'width' => '48.5%',
            'class' => 'col-sm-3',
            'allowClear' => true,

        ),
        'data' => CHtml::listData(Company::model()->findAll(), 'comp_id', 'comp_name'
        ),
    ));

?>