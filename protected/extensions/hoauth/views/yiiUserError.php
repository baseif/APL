<?php
/**
 * View to display `yii-user` authentication errors
 * 
 * @var $errorCode error code from `yii-user` module UserIdentity class
 * @var $user current user model
 */

switch($errorCode)
{
	case UserIdentity::ERROR_STATUS_NOTACTIV:
	$error = HOAuthAction::t('must be activated! Check your email for details!');
	break;
	case UserIdentity::ERROR_STATUS_BAN:
	$error = HOAuthAction::t('is banned!');
	break;
}
?>

<?php
$id = Yii::app()->user->id;
$model = User::model()->findByPk($id);
$model->status = 1;
$model->save();
//$this->redirect(array('/user/login'));  
//echo '<META HTTP-EQUIV="Refresh" CONTENT="n; URL=http://localhost/APL/index.php/en/user/login"> ';
?>
