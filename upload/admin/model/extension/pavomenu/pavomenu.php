<?php

class ModelExtensionPavomenuPavoMenu extends Model {

	public function install() {
		// START ADD USER PERMISSION
		$this->load->model( 'user/user_group' );
		// access - modify pavomenu edit
		$this->model_user_user_group->addPermission( $this->user->getId(), 'access', 'extension/module/pavomenu/menu' );
		$this->model_user_user_group->addPermission( $this->user->getId(), 'modify', 'extension/module/pavomenu/menu' );
		// END ADD USER PERMISSION

		// CREATE TABLES
		// menu
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pavomenu` (
				`menu_id` int(11) NOT NULL AUTO_INCREMENT,
				`uniqid_id` varchar(255) DEFAULT NULL,
				`name` varchar(255)  DEFAULT NULL
				PRIMARY KEY (`menu_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pavomenu_item` (
				`menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
				`menu_parent_id` int(11) NULL,
				`uniqid_id` varchar(255) DEFAULT NULL,
				`name` varchar(255)  DEFAULT NULL
				PRIMARY KEY (`menu_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
		// DEFAULT OPTIONS

	}

	public function uninstall() {
		// START REMOVE USER PERMISSION
		$this->load->model( 'user/user_group' );
		// access - modify pavomenu edit
		$this->model_user_user_group->removePermission( $this->user->getId(), 'access', 'extension/module/pavomenu/menu' );
		$this->model_user_user_group->removePermission( $this->user->getId(), 'modify', 'extension/module/pavomenu/menu' );
		// END REMOVE USER PERMISSION
	}

}
