<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

$settings      = array(
  'menu_title' => '设置',
  'menu_type'  => 'add_submenu_page',
  'menu_parent'=>'youpzt_store',
  'menu_slug'  => 'youpzt_store_options',
  'ajax_save'  => true,
);

$options        = array();

$options[]      = array(
  'name'        => 'general',
  'title'       => '常规',
  'icon'        => 'fa fa-gears',
  // begin: fields
  'fields'      => array(
            // begin: a field
            array(
              'id'      => 'text_1',
              'type'    => 'text',
              'title'   => 'Text',
            ),
            // end: a field
            array(
              'id'      => 'textarea_1',
              'type'    => 'textarea',
              'title'   => 'Textarea',
              'help'    => 'This option field is useful. You will love it!',
            ),

            array(
              'id'      => 'upload_1',
              'type'    => 'upload',
              'title'   => '上传',
              'help'    => 'Upload a site logo for your branding.',
            ),

            array(
              'id'      => 'switcher_1',
              'type'    => 'switcher',
              'title'   => 'Switcher',
              'label'   => 'You want to update for this framework ?',
            ),

            array(
              'id'      => 'color_picker_1',
              'type'    => 'color_picker',
              'title'   => 'Color Picker',
              'default' => '#3498db',
            ),

            array(
              'id'      => 'checkbox_1',
              'type'    => 'checkbox',
              'title'   => 'Checkbox',
              'label'   => 'Did you like this framework ?',
            ),

            array(
              'id'      => 'radio_1',
              'type'    => 'radio',
              'title'   => 'Radio',
              'options' => array(
                'yes'   => 'Yes, Please.',
                'no'    => 'No, Thank you.',
              ),
              'help'    => 'Are you sure for this choice?',
            ),

            array(
              'id'             => 'select_1',
              'type'           => 'select',
              'title'          => 'Select',
              'options'        => array(
                  'bmw'          => 'BMW',
                  'mercedes'     => 'Mercedes',
                  'volkswagen'   => 'Volkswagen',
                  'other'        => 'Other',
              ),
              'default_option' => 'Select your favorite car',
            ),

            array(
              'id'      => 'number_1',
              'type'    => 'number',
              'title'   => 'Number',
              'default' => '10',
              'after'   => ' <i class="cs-text-muted">$ (dollars)</i>',
            ),

            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => 'This is info notice field for your highlight sentence.',
            ),

            array(
              'type'    => 'notice',
              'class'   => 'warning',
              'content' => 'This is info warning field for your highlight sentence.',
            ),

            array(
              'id'      => 'text_2',
              'type'    => 'text',
              'title'   => 'Text',
              'desc'    => 'Some description here for this option field.',
            ),

  ), // end: fields
);

$options[]      = array(
  'name'        => 'weixin_option',
  'title'       => '微信',
  'icon'        => 'fa fa-wechat',
  // begin: fields
  'fields'      => array(
            array(
              'type'    => 'heading',
              'content' => '接口设置',
            ),
            array(
              'id'      => 'wx_token',
              'type'    => 'text',
              'title'   => '微信Token',
              'after'    => ' <small class="cs-text-warning">( * 必须 )</small>',
              'validate' => 'required',
            ),
            array(
              'id'      => 'wx_appid',
              'type'    => 'text',
              'title'   => '微信AppID',
              'after'    => ' <small class="cs-text-warning">( * 必须 )</small>',
              'validate' => 'required',
            ),
            array(
              'id'      => 'wx_appsecret',
              'type'    => 'text',
              'title'   => '微信APPSecret',
              'after'    => ' <small class="cs-text-warning">( * 必须 )</small>',
              'validate' => 'required',
            ),
          array(
            'type'    => 'heading',
            'content' => '自定义回复',
          ),
          array(
              'id'      => 'wx_welcome',
              'type'    => 'textarea',
              'title'   => '用户关注时回复',
            ),
  ), // end: fields
);

$options[]      = array(
  'name'        => 'product',
  'title'       => '产品',
  'icon'        => 'fa fa-archive',
  // begin: fields
  'fields'      => array(
                array(
                  'type'    => 'notice',
                  'class'   => 'info',
                  'content' => '接口设置',
                ),

                array(
                  'id'      => 'wx_advanced_api',
                  'type'    => 'switcher',
                  'title'   => '开启服务号高级接口',
                  'info'   => '只有认证过的服务号，才开启这个功能',
                ),
  ), // end: fields
);

$options[]      = array(
  'name'        => 'pay',
  'title'       => '支付',
  'icon'        => 'fa fa-eraser',
  // begin: fields
  'fields'      => array(
            array(
              'id'           => 'pay_type',
              'type'         => 'checkbox',
              'desc'   => '微信支付必须是认证申请过',
              'title'        => '支付方式',
              'options'      => array(
                    'weichat_pay'    => '微信支付',
                    'alipay'     => '支付宝支付',
              ),
              'default'         =>'alipay',
            ),

  ), // end: fields
);
$options[]      = array(
  'name'        => 'jifen',
  'title'       => '积分',
  'icon'        => 'fa fa-star',
  // begin: fields
  'fields'      => array(
            array(
              'id'      => 'open_jifen',
              'type'    => 'switcher',
              'title'   => '开启积分系统',
            ),
            array(
              'id'      => 'wx_appid',
              'type'    => 'number',
              'title'   => '每次签到送积分',
            ),
  ), // end: fields
);
// ------------------------------
// backup                       -
// ------------------------------
$options[]   = array(
  'name'     => 'backup_options',
  'title'    => '备份',
  'icon'     => 'fa fa-shield',
  'fields'   => array(

    array(
      'type'    => 'notice',
      'class'   => 'warning',
      'content' => '你可以保存当前的配置选项，下载备份或导入',
    ),

    array(
      'type'    => 'backup',
    ),

  )
);

// ------------------------------
// validate                     -
// ------------------------------
$options[]   = array(
  'name'     => 'validate_section',
  'title'    => 'Validate',
  'icon'     => 'fa fa-check-circle',
  'fields'   => array(

    array(
      'id'       => 'validate_text_1',
      'type'     => 'text',
      'title'    => 'Email Text',
      'desc'     => 'This text field only accepted email address.',
      'default'  => 'info@domain.com',
      'validate' => 'email',
    ),

    array(
      'id'       => 'numeric_text_1',
      'type'     => 'text',
      'title'    => 'Numeric Text',
      'desc'     => 'This text field only accepted numbers',
      'default'  => '123456',
      'validate' => 'numeric',
    ),

    array(
      'id'       => 'required_text_1',
      'type'     => 'text',
      'title'    => 'Requried Text',
      'after'    => ' <small class="cs-text-warning">( * required )</small>',
      'default'  => 'lorem ipsum',
      'validate' => 'required',
    ),

    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => 'Also you can add your own validate from <strong>themename/cs-framework/functions/validate.php</strong>',
    ),

  )
);

// ----------------------------------------
// dependencies                           -
// ----------------------------------------
$options[]           = array(
  'name'             => 'dependencies',
  'title'            => 'Dependencies',
  'icon'             => 'fa fa-code-fork',
  'fields'           => array(

    // ------------------------------------
    // Basic Dependencies
    // ------------------------------------
    array(
      'type'         => 'subheading',
      'content'      => 'Basic Dependencies',
    ),

    // ------------------------------------
    array(
      'id'           => 'dep_1',
      'type'         => 'text',
      'title'        => 'If text <u>not be empty</u>',
    ),

    array(
      'id'           => 'dummy_1',
      'type'         => 'notice',
      'class'        => 'info',
      'content'      => 'Done, this text option have something.',
      'dependency'   => array( 'dep_1', '!=', '' ),
    ),
    // ------------------------------------

    // ------------------------------------
    array(
      'id'           => 'dep_2',
      'type'         => 'switcher',
      'title'        => 'If switcher mode <u>ON</u>',
    ),

    array(
      'id'           => 'dummy_2',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => 'Woow! Switcher is ON',
      'dependency'   => array( 'dep_2', '==', 'true' ),
    ),
    // ------------------------------------

    // ------------------------------------
    array(
      'id'           => 'dep_3',
      'type'         => 'select',
      'title'        => 'Select color <u>black or white</u>',
      'options'      => array(
        'blue'       => 'Blue',
        'yellow'     => 'Yellow',
        'green'      => 'Green',
        'black'      => 'Black',
        'white'      => 'White',
      ),
    ),

    array(
      'id'           => 'dummy_3',
      'type'         => 'notice',
      'class'        => 'danger',
      'content'      => 'Well done!',
      'dependency'   => array( 'dep_3', 'any', 'black,white' ),
    ),
    // ------------------------------------

    // ------------------------------------
    array(
      'id'           => 'dep_4',
      'type'         => 'radio',
      'title'        => 'If set <u>No, Thanks</u>',
      'options'      => array(
        'yes'        => 'Yes, Please',
        'no'         => 'No, Thanks',
        'not-sure'   => 'I am not sure!',
      ),
      'default'      => 'yes'
    ),

    array(
      'id'           => 'dummy_4',
      'type'         => 'notice',
      'class'        => 'info',
      'content'      => 'Uh why?!!!',
      'dependency'   => array( 'dep_4_no', '==', 'true' ),
      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
    ),
    // ------------------------------------

    // ------------------------------------
    array(
      'id'           => 'dep_5',
      'type'         => 'checkbox',
      'title'        => 'If checked <u>danger</u>',
      'options'      => array(
        'success'    => 'Success',
        'danger'     => 'Danger',
        'info'       => 'Info',
        'warning'    => 'Warning',
      ),
    ),

    array(
      'id'           => 'dummy_5',
      'type'         => 'notice',
      'class'        => 'danger',
      'content'      => 'Danger!',
      'dependency'   => array( 'dep_5_danger', '==', 'true' ),
      //'dependency' => array( '{ID}_{VALUE}', '==', 'true' ),
    ),
    // ------------------------------------


    // ------------------------------------
    array(
      'id'           => 'dep_8',
      'type'         => 'image',
      'title'        => 'Add a image',
    ),

    array(
      'id'           => 'dummy_8',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => 'Added a image!',
      'dependency'   => array( 'dep_8', '!=', '' ),
    ),
    // ------------------------------------

    // ------------------------------------
    array(
      'id'           => 'dep_9',
      'type'         => 'icon',
      'title'        => 'Add a icon',
    ),

    array(
      'id'           => 'dummy_9',
      'type'         => 'notice',
      'class'        => 'success',
      'content'      => 'Added a icon!',
      'dependency'   => array( 'dep_9', '!=', '' ),
    ),
    // ------------------------------------

    // ------------------------------------
    // Advanced Dependencies
    // ------------------------------------
    array(
      'type'         => 'subheading',
      'content'      => 'Advanced Dependencies',
    ),

    // ------------------------------------
    array(
      'id'           => 'dep_10',
      'type'         => 'text',
      'title'        => 'If text string <u>hello</u>',
    ),

    array(
      'id'           => 'dep_11',
      'type'         => 'text',
      'title'        => 'and this text string <u>world</u>',
    ),

    array(
      'id'           => 'dep_12',
      'type'         => 'checkbox',
      'title'        => 'and checkbox mode <u>checked</u>',
      'label'        => 'Check me!'
    ),

    array(
      'id'           => 'dummy_10',
      'type'         => 'notice',
      'class'        => 'info',
      'content'      => 'Done, Multiple Dependencies worked.',
      'dependency'   => array( 'dep_10|dep_11|dep_12', '==|==|==', 'hello|world|true' ),
    ),
    // ------------------------------------

    // ------------------------------------
    // Another Dependencies
    // ------------------------------------
    array(
      'type'         => 'subheading',
      'content'      => 'Another Dependencies',
    ),

    // ------------------------------------
    array(
      'id'           => 'dep_13',
      'type'         => 'select',
      'title'        => 'If color <u>black or white</u>',
      'options'      => array(
        'blue'       => 'Blue',
        'black'      => 'Black',
        'white'      => 'White',
      ),
    ),

    array(
      'id'           => 'dep_14',
      'type'         => 'select',
      'title'        => 'If size <u>middle</u>',
      'options'      => array(
        'small'      => 'Small',
        'middle'     => 'Middle',
        'large'      => 'Large',
        'xlage'      => 'XLarge',
      ),
    ),

    array(
      'id'           => 'dep_15',
      'type'         => 'select',
      'title'        => 'If text is <u>world</u>',
      'options'      => array(
        'hello'      => 'Hello',
        'world'      => 'World',
      ),
      'dependency'   => array( 'dep_13|dep_14', 'any|==', 'black,white|middle' ),
    ),

    array(
      'id'           => 'dummy_11',
      'type'         => 'notice',
      'class'        => 'info',
      'content'      => 'Well done, Correctly!',
      'dependency'   => array( 'dep_15', '==', 'world' ),
    ),
    // ------------------------------------

  ),
);

CSFramework::instance( $settings, $options );
