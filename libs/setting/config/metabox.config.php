<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => 'youpzt_store_product_data',
  'title'     => '产品选项',
  'post_type' => 'product',
  'context'   => 'normal',
  'priority'  => 'high',
  'type_box'=>array(
        array(
          'id'=>'product_virtual',
          'title'=>'产品类型',
          'type'=>'select',
          'optgroup'=>'产品类型',
          'select_options'=>array(
                'site_in'=>'站内产品',
                'site_out'=>'站外产品',
            )
          ),
        array(
          'id'=>'product_virtual',
          'title'=>'虚拟',
          'type'=>'checkbox',
          'wrapper_class'=>'change_class'
          ),
    ),
  'sections'  => array(

    array(
      'name'   => 'general_section',
      'title'=>'常规',
      //'icon'  => 'fa fa-tint',
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
          'id'    => 'old_price',
          'type'  => 'number',
          'title' => '原价(¥)',
          'info'=>'商品的原价或线下价，留空则不显示（一般比网售价高）',
          'attributes' => array(
                      'min'   => 1,
                      'width'=>300,
                      'placeholder' => '请填写正整数',
                    ),
        ),
        array(
          'id'    => 'sale_price',
          'type'  => 'number',
          'title' => '网售价(¥)',
          'info'=>'商品的实际售卖价（一般比原价要低）',
          'attributes' => array(
                      'min'   => 1,
                      'width'=>300,
                      'placeholder' => '请填写正整数',
                    ),
        ),

      ),
    ),

    array(
      'name'   => 'stock_section',
      'title'=>'库存',
      //'icon'  => 'fa fa-tint',
      'fields' => array(
        array(
          'id'      => 'stock_status',
          'type'    => 'radio',
          'title'   => '库存状态',
          'class'   => 'horizontal',
          'options' => array(
            'yes'   => '有货',
            'no'    => '缺货',
          ),
          'default'   => 'yes',
          'after'   => '<div class="cs-text-muted">在前端显示是否有货或缺货。</div>',
        ),

      ),
    ),
    // begin: a section
    array(
      'name'  => 'product_attributes',
      'title' => '属性扩展',
      //'icon'  => 'fa fa-tint',
      'fields' => array(

        array(
          'id'              => 'attribute_group',
          'type'            => 'group',
          'button_title'    => '添加属性',
          'accordion_title' => 'att_name',
          'fields'          => array(

            array(
              'id'          => 'att_name',
              'type'        => 'text',
              'title'       => '属性名',
            ),
            array(
              'id'          => 'att_value',
              'type'        => 'textarea',
              'title'       => '属性值',
            ),

          )

        ),
      ),
    ),
    // end: a section
    // begin: a section
    array(
      'name'  => 'advanced_product_data',
      'title' => '高级',
      //'icon'  => 'fa fa-tint',
      'fields' => array(

        array(
          'id'      => 'comment_status',
          'type'    => 'checkbox',
          'title'   => '允许评论',
          'label'   => '',
          'default' => true,
        ),

      ),
    ),
    // end: a section
  ),
);

CSFramework_Metabox::instance( $options );
