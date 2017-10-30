<?php

class ControllerExtensionModulePavoMenu extends Controller {

	/**
	 * data
	 */
	private $data = array();

	// errors storge
	private $errors = array();

	/**
	 * module index create new menu
	 */
	public function index() {
		$this->load->language( 'extension/module/pavomenu' );
		// set page document title
		if ( $this->language && $this->document ) $this->document->setTitle( $this->language->get( 'heading_title' ) );
		$this->data['errors'] = $this->errors;
		$this->data = array_merge( array(
			'header'		=> $this->load->controller( 'common/header' ),
			'column_left' 	=> $this->load->controller( 'common/column_left' ),
			'footer'		=> $this->load->controller( 'common/footer' )
		), $this->data );

		$this->response->setOutput( $this->load->view( 'extension/module/pavomenu/menu', $this->data ) );
	}

	/**
	 * setting general
	 */
	public function settings() {

	}

	/**
	 * install actions
	 * create new permission and tables
	 */
	public function install() {
		// $this->load->model( 'extension/pavomenu/menu' );
		// $this->model_extension_pavomenu_menu->install();
	}

	/**
	 * uninstall actions
	 * remove user permission
	 */
	public function uninstall() {
		// $this->load->model( 'extension/pavomenu/menu' );
		// $this->model_extension_pavomenu_menu->uninstall();
	}
}