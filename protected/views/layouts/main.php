<?php /* @var $this Controller */ ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!--font-awesome-->

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="container" id="page">

            <div id="header">
                <div id="logo">

                    <?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->




            <div id="mainmenu">
                <?php
                $contact = Contact::model()->findByPk(Yii::app()->user->id);
                if ($contact != null)
                    $varuser = 'contact';
                else
                    $varuser = 'client';


                $this->widget(
                        'booster.widgets.TbNavbar', array(
                    'type' => '',
                    'brand' => '<img src="' . Yii::app()->request->baseUrl . '/images/logo-africanpress.png" width="150" />',
                    'brandUrl' => array('/site/index'),
                    'collapse' => true, // requires bootstrap-responsive.css
                    // 'fixed' => false,
                    'fluid' => true,
                    'items' => array(
                        array(
                            'class' => 'booster.widgets.TbMenu',
                            'type' => 'navbar',
                            'items' => array(
                                array('label' => Yii::t('app', 'Home'), 'url' => array('/site/index'), 'visible' => Yii::app()->user->isGuest),
                                array(
                                    'label' => Yii::t('app', 'For who and how?'),
                                    'url' => Yii::app()->request->baseUrl . '/site/howtouse',
                                    'visible' => Yii::app()->user->isGuest,
                                    'items' => array(
                                        array('label' => Yii::t('app', 'For who and how'), 'url' => array('/site/forwhoandhow')),
                                        array('label' => Yii::t('app', 'How to use'), 'url' => array('/site/howtouse')),
                                        array('label' => Yii::t('app', 'Tips to write'), 'url' => array('/site/tipstowrite')),
                                     //   array('label' => Yii::t('app', 'Press'), 'url' => '#'),
                                    )
                                ),
                                array('label' => Yii::t('app', 'Costs of Use'), 'url' => array('/site/costofuse'), 'visible' => Yii::app()->user->isGuest),
                                array(
                                    'visible' => Yii::app()->user->isGuest,
                                    'label' => Yii::t('app', 'About Us'),
                                    'url' => '#',
                                    'items' => array(
                                        array('label' => Yii::t('app', 'About the African Press List'), 'url' => array('/site/about')),
                                        array('label' => Yii::t('app', 'Contact us'), 'url' => array('/site/contact')),
                                    )
                                ),
                                array('icon' => 'briefcase', 'label' => Yii::t('app', 'My Dashboard'), 'url' => array('/' . $varuser . '/dashbord/'), 'visible' => !Yii::app()->user->isGuest),
                                // Connected USer    
                                array('label' => Yii::t('app', 'My Releases'), 'url' => array('/contact/pressreleases'), 'visible' => ( (!Yii::app()->user->isGuest ) && ($contact != null)),),
                                array('label' => Yii::t('app', 'Black List'), 'url' => array('/Client/blacklist'), 'visible' => ( (!Yii::app()->user->isGuest) && ($contact != null)),),
                                //Navbar For Client 
                                array(
                                    'visible' => (!Yii::app()->user->isGuest && $contact == null),
//                                    'icon'=>'book     ',
                                    'label' => Yii::t('app', 'My Contact Lists'),
                                    'url' => '/press/scheduled',
                                    'items' => array(
                                        array('label' => Yii::t('app', 'Create New List'), 'url' => array('/listContact/create')),
                                        array('label' => Yii::t('app', 'View Contact Lists'), 'url' => array('/listContact/')),
                                        
                                    )),
                                
                                
                               // array('label' => Yii::t('app', 'Create New List'), 'url' => array('/listContact/create'), 'visible' => (!Yii::app()->user->isGuest && $contact == null),),
                               // array('label' => Yii::t('app', 'My Contact List'), 'url' => array('/listContact/'), 'visible' => (!Yii::app()->user->isGuest && $contact == null)),
                             
                                
                             //   array('label' => Yii::t('app', 'New Press Release'), 'url' => array('/press/create'), 'visible' => (!Yii::app()->user->isGuest && $contact == null),),
                                array(
                                    'visible' => (!Yii::app()->user->isGuest && $contact == null),
//                                    'icon'=>'book     ',
                                    'label' => Yii::t('app', 'My Press Releases'),
                                    'url' => '/press/scheduled',
                                    'items' => array(
                                        
                                        array('label' => Yii::t('app', 'New Press Release'), 'url' => array('/press/create')),
                                        array('label' => Yii::t('app', 'Press Drafts'), 'url' => array('/press/drafts')),
                                        array('label' => Yii::t('app', 'Press Scheduled'), 'url' => array('/press/scheduled')),
                                        array('label' => Yii::t('app', 'Press Sent on '), 'url' => array('/press/released')),
                                    )),
                                 array(
                                    'visible' =>  ( !Yii::app()->user->isGuest && $contact == null),
//                                    'icon'=>'book     ',
                                    'label' => Yii::t('app','My Administration'),
                                    'url' => '',
                                    'items' => array(

                                        array('label' => 'Extend Membership', 'url' => array('/client/extendmembership')),
                                        array('label' => 'Add credits', 'url' => array('/Client/increasecredit')),
                                        array('label' => 'My Financials', 'url' => array('/client/myfinancials')),
                                    //    array('label' => 'Spent Credits History', 'url' => array('')),


                                    )),
                                
                            ),
                        ),
                        
                        
        
                                
                               
                                
                               
                        
                        
                        
                        //'<form class="navbar-form navbar-left" action=""><div class="form-group"><input type="text" class="form-control" placeholder="Search"></div></form>',
                        array(
                            'class' => 'booster.widgets.TbMenu',
                            'type' => 'navbar',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                
                                array('label' => Yii::t('app', 'Sign-Up'), 'items' => array(
                                        array('label' => Yii::t('app', 'As Client'), 'url' => array('/user/registrationClient')),
                                        array('label' => Yii::t('app', 'As Journalist'), 'url' => array('/user/registration')),
                                    )
                                    , 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::t('app', 'My Space'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::t('app', 'My Profile'), 'icon' => 'wrench white', 'url' => array('/user/profile'), 'visible' => !Yii::app()->user->isGuest),
                                array('icon' => 'off  ',
                                    'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'url' => array('/user/logout'),
                                   // 'label' => Yii::app()->getModule('user')->t("Logout") , 'url' => array('/user/logout'),
                                    'visible' => !Yii::app()->user->isGuest),
//                                
                            // array('label' => 'Settings ', 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                            //    array('label' => 'My Profile', 'url' => array('/user/create')), 
                            // array('label' => 'My Profile', 'url' => array('/contact/update/'.Yii::app()->user->id)), 
                            // 'url' => array('contact/dashbord' //'visible' => !Yii::app()->user->isGuest), 
                            //or 'url' => array('/contact/view/id'),
                            // array('label' => 'Logout', 'url' => array('/user/logout'),)// 'visible' => !Yii::app()->user->isGuest)    
                            ),
                        ),
                    //    ),
                    //   ),
                    ),
                        )
                );
                ?>



            </div>

            <br>
                <div id="mainmenu">
                <?php
// Yii User 
//                $this->widget('zii.widgets.CMenu', array(
//                    'items' => array(
//                        array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::app()->getModule('user')->t("Login"), 'visible' => Yii::app()->user->isGuest),
//                        array('url' => Yii::app()->getModule('user')->registrationUrl, 'label' => Yii::app()->getModule('user')->t("Register"), 'visible' => Yii::app()->user->isGuest),
//                        array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest),
//                        array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
//                    ),
//                ));
                ?>
                </div>
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif ?>



                    <?php echo $content; ?>



                <?php //echo 'aaaa'.Yii::app()->getModule('user')->isAdmin();   ?>



                <div class="clear"></div>
                <h4 class="titrepartner"><?php echo Yii::t('app', 'Partners'); ?></h4>
                <div class="partners">
                    <div class="row" >

                        <div class="span-6">
                            <img src=<?php echo Yii::app()->request->baseUrl . '/images/logo.jpg'; ?>  />

                        </div>

                        <div class="span-6">
                            <img src=<?php echo Yii::app()->request->baseUrl . '/images/logo.jpg'; ?>  />

                        </div>

                        <div class="span-6">
                            <img src=<?php echo Yii::app()->request->baseUrl . '/images/logo.jpg'; ?>  />

                        </div>

                        <div class="span-6">
                            <img src=<?php echo Yii::app()->request->baseUrl . '/images/logo.jpg'; ?>  />

                        </div>

                    </div> 

                </div>

                <div class="clear"></div>
                <div id="footer">
<?php echo Yii::t('app', '  Copyright '); ?>  &copy; <?php echo date('Y'); ?> <?php echo Yii::t('app', ' by The WebSide. '); ?><br/>
<?php echo Yii::t('app', ' All Rights Reserved. '); ?>  <br/>
                </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>




                    <?php ?>
