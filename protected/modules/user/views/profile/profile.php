<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile"),
);
 $contact= Contact::model()->findByPk(Yii::app()->user->id);
 if ($contact!=null)
     $varuser='contact';
 else
     $varuser='client';
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'url' => array('/user/admin')) : array()),
   // array('label' => UserModule::t('List User'), 'url' => array('/user')),
//    
//    array('label'=>UserModule::t('My Dashbord'), 'url' => array('/'.$varuser.'/dashbord/')), 
    array('label'=>UserModule::t('Edit Login Information'), 'url'=>array('edit'),'icon'=>'edit'),
    array('label'=>UserModule::t('Edit Personal Information'), 'url'=>array('/'.$varuser.'/update/'),'icon'=>'pencil'),
    
    array('label' => UserModule::t('Change password'), 'url' => array('changepassword'),'icon'=>'lock'),
   // array('label' => UserModule::t('Logout'), 'url' => array('/user/logout')),
);
?><h1 class="fa fa-user  fa-4x">
    <?php  if ($contact!=null) 
        echo UserModule::t('My journalist profil');
    else 
        echo UserModule::t('My Client Profil');
    
    ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<?php
$this->widget(
    'booster.widgets.TbDetailView',
    array(
        'data' => array(
            'id' => 1,
            'firstName' => $model->username,
            'email' => $model->email,
            'create_at' => $model->create_at,
            'lastvisit_at' => $model->lastvisit_at,
            'status'=> User::itemAlias("UserStatus", $model->status),
         
           
          'Notification'=> '',
        
          
        ),
        'attributes' => array(
            array('name' => 'firstName', 'label' => UserModule::t('Username').' : '),
            array('name' => 'email', 'label' => UserModule::t('Email').' : '),
            array('name' => 'create_at', 'label' => UserModule::t('Create at').' : '),
            array('name' => 'lastvisit_at', 'label' => UserModule::t('Last Visit').' : '),
            array('name' => 'status', 'label' => UserModule::t('Status').' : '),
           // array('name' => 'Notification', 'label' => 'Notification  : '),    


        ),
    )
);

if ($contact!=null)
{
     if (($contact->contact_name_first==null)||($contact->contact_name_last==null))
         
echo '<span class="label col-md-7  label-info pull-left">'
 
         . '<b class="lead">Please check your personal information.<br> '
         . 'Actually you will not be showen in the <br> search journalist</b></span>';
     
     

}
 ?>
        
  <!--<table class="grid-view" > 
   <tr>
        <th class="label  size-large label-info"><?php // echo CHtml::encode($model->getAttributeLabel('username')); ?></th>-->
        <td><?php // echo CHtml::encode($model->username); ?></td>
    <!--</tr></h3>--> 
    <?php
//    $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
//    if ($profileFields) {
//        foreach ($profileFields as $field) {
            //echo "<pre>"; print_r($profile); die();
            ?>
        <!--	<tr>
                    <th class="label"><?php //echo CHtml::encode(UserModule::t($field->title));  ?></th>
            <td><?php //echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname))));  ?></td>
            </tr>-->
            <?php
//        }$profile->getAttribute($field->varname)
//    }
    ?>
<!--    <tr>
        <th class="label label-info"><?php // echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
        <td><?php // echo CHtml::encode($model->email); ?></td>
    </tr>
    <tr>
        <th class="label label-info"><?php // echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
        <td><?php // echo $model->create_at; ?></td>
    </tr>
    <tr>
        <th class="label label-info"><?php // echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
        <td><?php // echo $model->lastvisit_at; ?></td>
    </tr>
    <tr>
        <th class="label label-info"><?php//  echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
        <td><?php //echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
    </tr>
</table>-->
<BR><BR><BR><BR><BR><BR> 