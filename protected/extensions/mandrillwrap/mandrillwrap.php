<?php

class mandrillwrap extends CApplicationComponent {

    public $mandrillKey;
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $toName;
    public $text;
    public $html;
    public $subject;
    public $replyEmail;
    public $img1_content;
    public $ext1;
    public $img_name1;
    public $img2_content;
    public $ext2;
    public $img_name2;
    public $img3_content;
    public $ext3;
    public $img_name3;
    public $image1;
    public $image2;
     public $image3;

    public function init() {
        Yii::import('application.vendors.Mandrill');
        define('MANDRILL_API_KEY', 'vx4a-QQzpKypkAqF2U9cfA');
    }

    public function sendEmail() {

        $request_json = '{
						"type":"messages",
						"call":"send",
						"message": {
                                                        "html": "' . $this->html . '",
							"subject":"' . $this->subject . '",
							"to":[
								{
								"email": "' . $this->toEmail . '",
								"name": "' . $this->toName . '"
								}
							],
							"headers":
								{
							 "Reply-To": "' . $this->replyEmail . '"
							},
							"url_strip_qs":true,
							"from_email": "' . $this->fromEmail . '",
							"from_name": "' . $this->fromName . '",
							"text": "' . $this->text . '",
							"track_opens":false,
							"track_clicks":false,
							"auto_text":true,
							"tags":["fal"],
							"google_analytics_domains":["..."],
							"google_analytics_campaign":["..."],
							"metadata":["..."],
                                                        "images":[
                                                            ' . $this->image1 . '
                                                            ' . $this->image2 . '
                                                            ' . $this->image3 . '      
]
							}
						}';

        $ret = Mandrill::call((array) json_decode($request_json));
        return $ret;
    }

}
