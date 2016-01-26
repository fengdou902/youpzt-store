<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// TAXONOMY OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();

// -----------------------------------------
// Page Taxonomy Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => 'product_cat_option',
  'title'     => '自定义分类选项',
  'taxonomy' => 'product_cat',
  'context'   => 'normal',
  'only_edit_show_all'=>true,
  'priority'  => 'default',
  'sections'  => array(

    // begin: a section
    array(
      'name'  => 'section_product_cat',
      'icon'  => 'fa fa-cog',

      // begin: fields
      'fields' => array(

        // begin: a field
        array(
          'id'        => 'product_cat_thumbnail',
          'type'      => 'image',
          'title'     => '缩略图',
          'desc'      => '',
          'help'      => '作为产品分类的缩略图',
        ),
        // end: a field

      ), // end: fields
    ), // end: a section

  ),
);

// -----------------------------------------
// Page Side Metabox Options               -
// -----------------------------------------
$options[]    = array(
  'id'        => '_custom_page_side_options',
  'title'     => '自定义页面侧边选项',
  'post_type' => 'page',
  'context'   => 'side',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'section_3',
      'fields' => array(

        array(
          'id'        => 'section_3_image_select',
          'type'      => 'image_select',
          'options'   => array(
                    'value-1' => 'http://codestarframework.com/assets/images/placeholder/65x65-2ecc71.gif',
                    'value-2' => 'http://codestarframework.com/assets/images/placeholder/65x65-e74c3c.gif',
                    'value-3' => 'http://codestarframework.com/assets/images/placeholder/65x65-3498db.gif',
          ),
          'default'   => 'value-2',
        ),

        array(
          'id'            => 'section_3_text',
          'type'          => 'text',
          'attributes'    => array(
            'placeholder' => 'do stuff'
          )
        ),

        array(
          'id'      => 'section_3_switcher',
          'type'    => 'switcher',
          'label'   => 'Are you sure ?',
          'default' => true
        ),

      ),
    ),

  ),
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => '_custom_post_options',
  'title'     => '产品选项',
  'post_type' => 'product',
  'context'   => 'normal',
  'priority'  => 'high',
  'sections'  => array(

    array(
      'name'   => 'section_4',
      'fields' => array(
        array(
          'id'          => 'product_gallery',
          'type'        => 'gallery',
          'title'       => '产品相册',
          'add_title'   => '添加相册',
          'edit_title'  => '编辑相册',
          'clear_title' => '移除相册',
        ),
        array(
          'id'    => 'section_4_text',
          'type'  => 'text',
          'title' => 'Text Field',
        ),

        array(
          'id'    => 'section_4_textarea',
          'type'  => 'textarea',
          'title' => 'Textarea Field',
        ),

        array(
          'id'    => 'section_4_upload',
          'type'  => 'upload',
          'title' => 'Upload Field',
        ),

        array(
          'id'    => 'section_4_switcher',
          'type'  => 'switcher',
          'title' => 'Switcher Field',
          'label' => 'Yes, Please do it.',
        ),

      ),
    ),

  ),
);

YOUPZTFramework_Taxonomy::instance( $options );
