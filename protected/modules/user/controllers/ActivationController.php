<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';

	
	/**
	 * Activation user account
	 */
	public function actionActivation () {
		$email = $_GET['email'];
		$activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
			if (isset($find)&&$find->status) {
                            
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),
                                'content'=>UserModule::t("Your account is active.")));
			} 
                        
                        elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
                            
                            
                            $client = Client::model()->findByPk($find->id);
                            $journalist = Contact::model()->findByPk($find->id);
                            
                            if(count($client)>0){
                                $message = 'We are pleased to welcome you to the AfricaPressList. 
                                    Your account has been activated and please click the link below in order to work with the AfricaPressList.';
                            }
                            
                            if(count($journalist)>0){
                                $message = 'We are pleased to welcome you to the AfricaPressList. 
                                    Your registration has been completed and please click the link below in order to check your profile at the AfricaPressList. 
                                    Completing your profile helps to be found earlier. That is good for you, since we want to promote your skills 
                                    and interests to companies looking for qualified copywriters, free lance journalists, photographers, cameramen, etc.';
                            }
                            
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t($message)));
			} else {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
			}
		} else {
			$this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
		}
	}

}