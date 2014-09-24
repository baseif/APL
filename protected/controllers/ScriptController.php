<?php

class ScriptController extends Controller {

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('outbound', 'usersendemailnotification', 'usersendemail'),
                'users' => array('*'),
            ),
        );
    }

    public function actionOutbound() {
        $email = Yii::app()->mandrillwrap;
        $presses = Press::model()->findAll();
        $date = date("Y-m-d H:i:s");
        foreach ($presses as $press) {
            $user_press = $press->pressUser;        
            $user_package = UserPackage::model()->findByPk($user_press->user_id);
            
               
            $credit_history = new CreditHistory;
            if (($press->press_status == 'Q') && ($press->press_date_started <= $date)) {
                $contacts = $press->list->contacts;
                //print_r ($user_package . "here "); 
 
		$credit = $user_package->utype_credits;
                $content = '';
                $press_contacts_mailed = 0;
                $press_contacts_failed = 0;
                if ($credit > count($contacts)) { //&&($user_package->utype_expires < $date)
                    foreach ($contacts as $contact) {
                        $press_run = new PressRun;
                        $press_run->press_id = $press->press_id;
                        $press_run->contact_id = $contact->contact_id;
                        $content = $press->press_content;
                        $content = str_replace("\r\n", '', $content);
                   //     $content = htmlentities($content, ENT_QUOTES);
                        $email->html = $content;
                        $email->subject = $press->press_subject;
                        $email->fromName = $press->press_sender_name;
                        $email->fromEmail = $press->press_sender_email;
                        $email->replyEmail = $press->press_replyto_email;
                        $email->toName = $contact->contact_name_last . ' ' . $contact->contact_name_first;
                        $email->toEmail = $contact->contact_email;
                        $extension1 = pathinfo($press->press_file_1, PATHINFO_EXTENSION);
                        if (!empty($press->press_file_1)) {
                            $img1_content = file_get_contents(Yii::app()->basePath . '/uploads/' . $press->press_file_1);
                            $img1_content = base64_encode($img1_content);

                            switch ($extension1) {
                                case 'jpg':
                                case 'jpeg':
                                    $ext1 = "image/jpeg";
                                    $img_name1 = basename($press->press_file_1, ".jpg");
                                    break;
                                case 'gif':
                                    $ext1 = "image/gif";
                                    $img_name1 = basename($press->press_file_1, ".gif");

                                    break;
                                case 'png':
                                    $ext1 = "image/png";
                                    $img_name1 = basename($press->press_file_1, ".png");

                                    break;
                            }

                            $email->image1 = '{     
                                                            "type": "' . $ext1 . '",
                                                            "name": "' . $img_name1 . '",
                                                            "content": "' . $img1_content . '"
                                                          }';

                            if (!empty($press->press_file_2) || !empty($press->press_file_3))
                                $email->image1 = $email->image1 . ',';
                        } else {
                            $email->image1 = '';
                        }

                        $extension2 = pathinfo($press->press_file_2, PATHINFO_EXTENSION);
                        if (!empty($press->press_file_2)) {
                            $img2_content = file_get_contents(Yii::app()->basePath . '/uploads/' . $press->press_file_2);
                            $img2_content = base64_encode($img2_content);

                            switch ($extension2) {
                                case 'jpg':
                                case 'jpeg':
                                    $ext2 = "image/jpeg";
                                    $img_name2 = basename($press->press_file_2, ".jpg");
                                    break;
                                case 'gif':
                                    $ext2 = "image/gif";
                                    $img_name2 = basename($press->press_file_2, ".gif");

                                    break;
                                case 'png':
                                    $ext2 = "image/png";
                                    $img_name2 = basename($press->press_file_2, ".png");

                                    break;
                            }

                            $email->image2 = '{     
                                                            "type": "' . $ext2 . '",
                                                            "name": "' . $img_name2 . '",
                                                            "content": "' . $img2_content . '"
                                                          }';

                            if (!empty($press->press_file_3))
                                $email->image2 = $email->image2 . ',';
                        } else {
                            $email->image2 = '';
                        }

                        $extension3 = pathinfo($press->press_file_3, PATHINFO_EXTENSION);
                        if (!empty($press->press_file_3)) {
                            $img3_content = file_get_contents(Yii::app()->basePath . '/uploads/' . $press->press_file_3);
                            $img3_content = base64_encode($img3_content);

                            switch ($extension3) {
                                case 'jpg':
                                case 'jpeg':
                                    $ext3 = "image/jpeg";
                                    $img_name3 = basename($press->press_file_3, ".jpg");
                                    break;
                                case 'gif':
                                    $ext3 = "image/gif";
                                    $img_name3 = basename($press->press_file_3, ".gif");

                                    break;
                                case 'png':
                                    $ext3 = "image/png";
                                    $img_name3 = basename($press->press_file_3, ".png");

                                    break;
                            }

                            $email->image3 = '{     
                                                            "type": "' . $ext3 . '",
                                                            "name": "' . $img_name3 . '",
                                                            "content": "' . $img3_content . '"
                                                          }';
                        } else {
                            $email->image3 = '';
                        }


                        $ret = $email->sendEmail();

                        if ($ret[0]->status == "sent") {
                            $press_contacts_mailed = $press_contacts_mailed + 1;
                            $press_journalist = new PressJournalist;
                            $press_journalist->contact_id = $contact->contact_id;
                            $press_journalist->press_content = $press->press_content;
                            $press_journalist->press_subject = $press->press_subject;
                            $press_journalist->press_date = $press->press_date;
                            $press_journalist->save(false);
                            $credit = $credit - 1;
                        } else {
                            $press_contacts_failed = $press_contacts_failed + 1;
                        }
                        $press_run->mandrill_message_id = $ret[0]->_id;
                        $press_run->mandrill_status = $ret[0]->status;
                        $press_run->save(false);
                    }
                    $press->press_contacts_mailed = $press_contacts_mailed;
                    $press->press_contacts_failed = $press_contacts_failed;

                    if ($press_contacts_mailed > 0) {
                        $press->press_date_completed = date('Y-m-d H:i:s');
                        $press->press_status = 'C';
                    } else {
                        $press->press_status = 'F';
                      $result = $this->actionUserSendEmail($user_press->user_id);
                    }

                   $user_press->save();
                    $press->save();
                } else {

                  $result1 = $this->actionUserSendEmailNotification($user_press->user_id);
                    $press->press_status = 'D';
                    $press->save();
                }
                $user_package->utype_credits = $credit;
                $user_press->user_credits=$credit;
                $credit_history->ch_user = $press->press_user;
                $credit_history->ch_type = "MAILRUN";
                $credit_history->ch_amount = $press_contacts_mailed;
                $credit_history->ch_target_id = $press->list->list_id;
                $credit_history->ch_notes = "";
                $credit_history->ch_date = $date;
                $user_press->save(false);
                $user_package->save(false);
                $credit_history->save(FALSE);
            }
        }
//        if(!isset($_POST['mandrill_events'])) {
//    echo 'A mandrill error occurred: Invalid mandrill_events';
//    exit;
//}
//$mail = array_pop(json_decode($_POST['mandrill_events']));
// 
//        try {
//    $webhooks = Yii::app()->webhooks;
//    $result = $webhooks->getlist();
        //print_r($result);
        /*
          Array
          (
          [0] => Array
          (
          [id] => 42
          [url] => http://example/webhook-url
          [description] => My Example Webhook
          [auth_key] => gplJ8yWptFTqCoq5S1SHPA
          [events] => Array
          (
          [0] => send
          [1] => open
          [2] => click
          )

          [created_at] => 2013-01-01 15:30:27
          [last_sent_at] => 2013-01-01 15:30:49
          [batches_sent] => 42
          [events_sent] => 42
          [last_error] => example last_error
          )

          )
         */
//} catch(Mandrill_Error $e) {
//    // Mandrill errors are thrown as exceptions
//    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
//    // A mandrill error occurred: Mandrill_Invalid_Key - Invalid API key
//    throw $e;
//}
        //  $this->render('outbound');
    }

    public function actionUserSendEmailNotification($pk) {
        $user_press = Client::model()->findByPk($pk);
        $email = Yii::app()->mandrillwrap;
        $content = "inviting to upgrade credit limit";
        $email->html = $content;
        $email->subject = "mailing can't be send";
        $email->fromName = "Administrator Affrica Presslist";
        $email->fromEmail = "Administrator@africapresslist.com";
        $email->toName = $user_press->porfile_name_last;
        $email->toEmail = $user_press->user_email;
        return $email->sendEmail();
    }

    public function actionUserSendEmail($pk) {
        $user_press = Client::model()->findByPk($pk);
        $email = Yii::app()->mandrillwrap;
        $content = "credits are deducted ";
        $email->html = $content;
       $email->subject = "mailing can't be send";
        $email->fromName = "Administrator Affrica Presslist";
        $email->fromEmail = "Administrator@africapresslist.com";
        $email->toName = $user_press->porfile_name_last;
        $email->toEmail = $user_press->user_email;
        return $email->sendEmail();
    }

}
