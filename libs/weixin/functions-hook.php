<?php
register_activation_hook( WEIXIN_ROBOT_PLUGIN_FILE,'weixin_robot_create_table');
function weixin_robot_create_table() {	
	global $wpdb;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	if($wpdb->get_var("show tables like '{$wpdb->weixin_users}'") != $wpdb->weixin_users) {
		$sql = "
		CREATE TABLE IF NOT EXISTS `{$wpdb->weixin_users}` (
		  `id` bigint(20) NOT NULL auto_increment,
		  `openid` varchar(30) NOT NULL,
		  `nickname` varchar(50) NOT NULL COMMENT '昵称',
		  `name` varchar(50) NOT NULL COMMENT '姓名',
		  `phone` varchar(20) NOT NULL COMMENT '电话号码',
		  `id_card` varchar(18) NOT NULL COMMENT '身份证',
		  `address` text NOT NULL COMMENT '地址',
		  `subscribe` int(1) NOT NULL default '1',
		  `subscribe_time` int(10) NOT NULL,
		  `sex` int(1) NOT NULL,
		  `city` varchar(255) NOT NULL,
		  `country` varchar(255) NOT NULL,
		  `province` varchar(255) NOT NULL,
		  `language` varchar(255) NOT NULL,
		  `headimgurl` varchar(255) NOT NULL,
		  `unionid` varchar(30) NOT NULL,
		  `last_update` int(10) NOT NULL,
		  PRIMARY KEY  (`id`),
		  UNIQUE KEY `weixin_openid` (`openid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
 
		dbDelta($sql);
	}

	if($wpdb->get_var("show tables like '{$wpdb->weixin_custom_replies}'") != $wpdb->weixin_custom_replies) {
		$sql = "
		CREATE TABLE IF NOT EXISTS `{$wpdb->weixin_custom_replies}` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`keyword` varchar(255)  NOT NULL,
			`match` varchar(10)  NOT NULL DEFAULT 'full',
			`reply` text  NOT NULL,
			`status` int(1) NOT NULL DEFAULT '1',
			`time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`type` varchar(10)  NOT NULL DEFAULT 'text',
			PRIMARY KEY (`id`),
			UNIQUE KEY `keyword` (`keyword`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
 
		dbDelta($sql);
	}

	if($wpdb->get_var("show tables like '$wpdb->weixin_qrcodes'") != $wpdb->weixin_qrcodes) {
		$sql = "
		CREATE TABLE IF NOT EXISTS " . $wpdb->weixin_qrcodes . " (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`scene` int(6)  NOT NULL,
			`name` varchar(255)  NOT NULL,
			`type` varchar(31)  NOT NULL,
			`ticket` text  NOT NULL,
			`expire` int(10) NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		";
 
		dbDelta($sql);
	}
}

?>