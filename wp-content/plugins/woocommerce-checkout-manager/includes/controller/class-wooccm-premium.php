<?php

class WOOCCM_Checkout_Premium_Controller {

  protected static $_instance;

  public function __construct() {
    $this->init();
  }

  public static function instance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
  
  
  function remove_menu() {
    ?>
    <style>
      
      li.toplevel_page_wooccm {
        display:none;
      }
      
    </style>
    <?php
  }

  // Admin    
  // -------------------------------------------------------------------------

  public function add_page() {
    include_once( WOOCCM_PLUGIN_DIR . 'includes/view/backend/pages/premium.php' );
  }

  function add_menu() {
    add_menu_page(WOOCCM_PLUGIN_NAME, WOOCCM_PLUGIN_NAME, 'manage_woocommerce', WOOCCM_PREFIX, array($this, 'add_page'));
    add_submenu_page(WOOCCM_PREFIX, esc_html__('Premium', 'woocommerce-checkout-manager'), esc_html__('Premium', 'woocommerce-checkout-manager'), 'manage_woocommerce', WOOCCM_PREFIX, array($this, 'add_page'));
  }

  public function init() {
    add_action('admin_menu', array($this, 'add_menu'));
    add_action('admin_head', array($this, 'remove_menu'));
  }

}

WOOCCM_Checkout_Premium_Controller::instance();

