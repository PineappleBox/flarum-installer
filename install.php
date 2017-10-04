<?php
if(isset($_POST['install'])){
	if(isset($_POST['forumTitle']) && isset($_POST['mysqlDatabase']) && isset($_POST['mysqlUsername']) && isset($_POST['mysqlPassword']) && isset($_POST['adminUsername']) && isset($_POST['adminEmail'])){
		$ftitle = $_POST['forumTitle'];
		$fdbname = $_POST['mysqlDatabase'];
		$fdbuser = $_POST['mysqlUsername'];
		$fdbpass = $_POST['mysqlPassword'];
		$fadmin = $_POST['adminUsername'];
		$femail = $_POST['adminEmail']; 
		$pcolor = $_POST['primaryColor'];
		if( $_SERVER['HTTPS']){
			$flink = "https://".$_SERVER['HTTP_HOST'];
		}else{
			$flink = "http://".$_SERVER['HTTP_HOST'];
		}
		$conn = mysqli_connect('localhost',$fdbuser,$fdbpass);
		$dbcon = mysqli_select_db($conn,$fdbname);
		if(!$conn){
			die("Connection failed : " . mysqli_error());
		}else if(!$dbcon){
			die("Database Connection failed : " . mysqli_error());
		}else{
			$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_access_tokens` (
 `id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` int(10) unsigned NOT NULL,
 `last_activity` int(11) NOT NULL,
 `lifetime` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_api_keys` (
 `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_auth_tokens` (
 `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `payload` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
 `created_at` timestamp NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_discussions` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
 `comments_count` int(10) unsigned NOT NULL DEFAULT '0',
 `participants_count` int(10) unsigned NOT NULL DEFAULT '0',
 `number_index` int(10) unsigned NOT NULL DEFAULT '0',
 `start_time` datetime NOT NULL,
 `start_user_id` int(10) unsigned DEFAULT NULL,
 `start_post_id` int(10) unsigned DEFAULT NULL,
 `last_time` datetime DEFAULT NULL,
 `last_user_id` int(10) unsigned DEFAULT NULL,
 `last_post_id` int(10) unsigned DEFAULT NULL,
 `last_post_number` int(10) unsigned DEFAULT NULL,
 `hide_time` datetime DEFAULT NULL,
 `hide_user_id` int(10) unsigned DEFAULT NULL,
 `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `is_private` tinyint(1) NOT NULL DEFAULT '0',
 `is_approved` tinyint(1) NOT NULL DEFAULT '1',
 `is_locked` tinyint(1) NOT NULL DEFAULT '0',
 `is_sticky` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_discussions_tags` (
 `discussion_id` int(10) unsigned NOT NULL,
 `tag_id` int(10) unsigned NOT NULL,
 PRIMARY KEY (`discussion_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_email_tokens` (
 `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` int(10) unsigned NOT NULL,
 `created_at` timestamp NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_flags` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `post_id` int(10) unsigned NOT NULL,
 `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` int(10) unsigned DEFAULT NULL,
 `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `reason_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `time` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_groups` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name_singular` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `name_plural` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_mentions_posts` (
 `post_id` int(10) unsigned NOT NULL,
 `mentions_id` int(10) unsigned NOT NULL,
 PRIMARY KEY (`post_id`,`mentions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_mentions_users` (
 `post_id` int(10) unsigned NOT NULL,
 `mentions_id` int(10) unsigned NOT NULL,
 PRIMARY KEY (`post_id`,`mentions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_migrations` (
 `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_notifications` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(10) unsigned NOT NULL,
 `sender_id` int(10) unsigned DEFAULT NULL,
 `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `subject_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `subject_id` int(10) unsigned DEFAULT NULL,
 `data` blob,
 `time` datetime NOT NULL,
 `is_read` tinyint(1) NOT NULL DEFAULT '0',
 `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_password_tokens` (
 `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` int(10) unsigned NOT NULL,
 `created_at` timestamp NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_permissions` (
 `group_id` int(10) unsigned NOT NULL,
 `permission` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`group_id`,`permission`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_posts` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `discussion_id` int(10) unsigned NOT NULL,
 `number` int(10) unsigned DEFAULT NULL,
 `time` datetime NOT NULL,
 `user_id` int(10) unsigned DEFAULT NULL,
 `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `content` text COLLATE utf8mb4_unicode_ci,
 `edit_time` datetime DEFAULT NULL,
 `edit_user_id` int(10) unsigned DEFAULT NULL,
 `hide_time` datetime DEFAULT NULL,
 `hide_user_id` int(10) unsigned DEFAULT NULL,
 `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `is_private` tinyint(1) NOT NULL DEFAULT '0',
 `is_approved` tinyint(1) NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`),
 UNIQUE KEY `posts_discussion_id_number_unique` (`discussion_id`,`number`),
 FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_posts_likes` (
 `post_id` int(10) unsigned NOT NULL,
 `user_id` int(10) unsigned NOT NULL,
 PRIMARY KEY (`post_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_settings` (
 `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `value` text COLLATE utf8mb4_unicode_ci,
 PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_tags` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `description` text COLLATE utf8mb4_unicode_ci,
 `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `background_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `background_mode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `position` int(11) DEFAULT NULL,
 `parent_id` int(10) unsigned DEFAULT NULL,
 `default_sort` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `is_restricted` tinyint(1) NOT NULL DEFAULT '0',
 `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
 `discussions_count` int(10) unsigned NOT NULL DEFAULT '0',
 `last_time` datetime DEFAULT NULL,
 `last_discussion_id` int(10) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_users` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
 `is_activated` tinyint(1) NOT NULL DEFAULT '0',
 `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `bio` text COLLATE utf8mb4_unicode_ci,
 `avatar_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `preferences` blob,
 `join_time` datetime DEFAULT NULL,
 `last_seen_time` datetime DEFAULT NULL,
 `read_time` datetime DEFAULT NULL,
 `notifications_read_time` datetime DEFAULT NULL,
 `discussions_count` int(10) unsigned NOT NULL DEFAULT '0',
 `comments_count` int(10) unsigned NOT NULL DEFAULT '0',
 `flags_read_time` datetime DEFAULT NULL,
 `suspend_until` datetime DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `users_username_unique` (`username`),
 UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_users_discussions` (
 `user_id` int(10) unsigned NOT NULL,
 `discussion_id` int(10) unsigned NOT NULL,
 `read_time` datetime DEFAULT NULL,
 `read_number` int(10) unsigned DEFAULT NULL,
 `subscription` enum('follow','ignore') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 PRIMARY KEY (`user_id`,`discussion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_users_groups` (
 `user_id` int(10) unsigned NOT NULL,
 `group_id` int(10) unsigned NOT NULL,
 PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$query = mysqli_query($conn,"CREATE TABLE `hexa-forum_users_tags` (
 `user_id` int(10) unsigned NOT NULL,
 `tag_id` int(10) unsigned NOT NULL,
 `read_time` datetime DEFAULT NULL,
 `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`user_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
				$fpass = '$2y$10$gmKe2WP50D2n7eL92DSrLeEVpwMLYvier5BACjwCh/wYX/YkzlrUS';
				$query2 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_groups`(`id`,`name_singular`, `name_plural`, `color`, `icon`) VALUES ('1','Admin','Admins','#B72A2A','wrench'), ('2','Guest','Guests','',''), ('3','Member','Members','',''),  ('4','Moderator','Moderators','#80349E','bolt')");
				$query3 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_migrations` (`migration`,`extension`) VALUES('2015_02_24_000hexa-forum_create_access_tokens_table',NULL), ('2015_02_24_000hexa-forum_create_api_keys_table',NULL), ('2015_02_24_000hexa-forum_create_config_table',NULL), ('2015_02_24_000hexa-forum_create_discussions_table',NULL), ('2015_02_24_000hexa-forum_create_email_tokens_table',NULL), ('2015_02_24_000hexa-forum_create_groups_table',NULL), ('2015_02_24_000hexa-forum_create_notifications_table',NULL), ('2015_02_24_000hexa-forum_create_password_tokens_table',NULL), ('2015_02_24_000hexa-forum_create_permissions_table',NULL), ('2015_02_24_000hexa-forum_create_posts_table',NULL), ('2015_02_24_000hexa-forum_create_users_discussions_table',NULL), ('2015_02_24_000hexa-forum_create_users_groups_table',NULL), ('2015_02_24_000hexa-forum_create_users_table',NULL), ('2015_09_15_000hexa-forum_create_auth_tokens_table',NULL), ('2015_09_20_224327_add_hide_to_discussions',NULL), ('2015_09_22_030432_rename_notification_read_time',NULL), ('2015_10_07_130531_rename_config_to_settings',NULL), ('2015_10_24_194hexa-forum_add_ip_address_to_posts',NULL), ('2015_12_05_042721_change_access_tokens_columns',NULL), ('2015_12_17_194247_change_settings_value_column_to_text',NULL), ('2016_02_04_095452_add_slug_to_discussions',NULL), ('2017_04_07_114138_add_is_private_to_discussions',NULL), ('2017_04_07_114138_add_is_private_to_posts',NULL), ('2017_04_09_152230_change_posts_content_column_to_mediumtext',NULL), ('2015_09_21_011527_add_is_approved_to_discussions',NULL)");
				$query4 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_migrations` (`migration`,`extension`) VALUES('2015_09_21_011706_add_is_approved_to_posts',NULL), ('2017_07_22_000hexa-forum_add_default_permissions',NULL), ('2015_09_02_000hexa-forum_add_flags_read_time_to_users_table',NULL), ('2015_09_02_000hexa-forum_create_flags_table',NULL), ('2017_07_22_000hexa-forum_add_default_permissions',NULL), ('2015_05_11_000hexa-forum_create_posts_likes_table',NULL), ('2015_09_04_000hexa-forum_add_default_like_permissions',NULL), ('2015_02_24_000hexa-forum_add_locked_to_discussions',NULL), ('2017_07_22_000hexa-forum_add_default_permissions',NULL), ('2015_05_11_000hexa-forum_create_mentions_posts_table',NULL), ('2015_05_11_000hexa-forum_create_mentions_users_table',NULL), ('2015_02_24_000hexa-forum_add_sticky_to_discussions',NULL), ('2017_07_22_000hexa-forum_add_default_permissions',NULL), ('2015_05_11_000hexa-forum_add_subscription_to_users_discussions_table',NULL), ('2015_05_11_000hexa-forum_add_suspended_until_to_users_table',NULL), ('2015_09_14_000hexa-forum_rename_suspended_until_column',NULL), ('2017_07_22_000hexa-forum_add_default_permissions',NULL), ('2015_02_24_000hexa-forum_create_discussions_tags_table',NULL), ('2015_02_24_000hexa-forum_create_tags_table',NULL), ('2015_02_24_000hexa-forum_create_users_tags_table',NULL), ('2015_02_24_000hexa-forum_set_default_settings',NULL), ('2015_10_19_061223_make_slug_unique',NULL), ('2017_07_22_000hexa-forum_add_default_permissions','flarum-approval')");
				$query5 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_permissions` (`group_id`,`permission`) VALUES('2','viewDiscussions'), ('3','discussion.flagPosts'), ('3','discussion.likePosts'), ('3','discussion.reply'), ('3','discussion.replyWithoutApproval'), ('3','discussion.startWithoutApproval'), ('3','startDiscussion'), ('3','viewUserList'), ('4','discussion.approvePosts'), ('4','discussion.editPosts'), ('4','discussion.hide'), ('4','discussion.lock'), ('4','discussion.rename'), ('4','discussion.sticky'), ('4','discussion.tag'), ('4','discussion.viewFlags'), ('4','discussion.viewIpsPosts'), ('4','user.suspend')");
				$query6 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_settings` (`key`,`value`) VALUES('version','0.1.0-beta.7'), ('allow_post_editing','reply'), ('allow_renaming','10'), ('allow_sign_up','1'), ('custom_less',''), ('default_locale','en'), ('default_route','/all'), ('extensions_enabled','[".'"flarum-approval","flarum-bbcode","flarum-emoji","flarum-english","flarum-flags","flarum-likes","flarum-lock","flarum-markdown","flarum-mentions","flarum-sticky","flarum-subscriptions","flarum-suspend","flarum-tags"]'."'), ('forum_title','".$ftitle."'), ('forum_description',''), ('mail_driver','mail'), ('mail_from','noreply@localhost'), ('theme_colored_header','1'), ('theme_dark_mode','0'), ('theme_primary_color','".$pcolor."'), ('theme_secondary_color','#FFFFFF'), ('welcome_message','Welcome to your new forum! You can change this message from your dashboard. Good Luck!'), ('welcome_title','Thanks for using the Hexa auto-installer!'), ('flarum-tags.max_primary_tags','1'), ('flarum-tags.min_primary_tags','1'), ('flarum-tags.max_secondary_tags','3'), ('flarum-tags.min_secondary_tags','0')");
				$query7 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_tags`(`id`, `name`, `slug`, `description`, `color`, `background_path`, `background_mode`, `position`, `parent_id`, `default_sort`, `is_restricted`, `is_hidden`, `discussions_count`, `last_time`, `last_discussion_id`) VALUES ('1','General','general',NULL,'#888',NULL,NULL,'0',NULL,NULL,'0','0','0',NULL,NULL)");
				$query8 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_users`(`id`, `username`, `email`, `is_activated`, `password`, `bio`, `avatar_path`, `preferences`, `join_time`, `last_seen_time`, `read_time`, `notifications_read_time`, `discussions_count`, `comments_count`, `flags_read_time`, `suspend_until`) VALUES ('1','".$fadmin."','".$femail."','1','".$fpass."',NULL,NULL,NULL,'".date("Y-m-d h:i:sa")."','".date("Y-m-d h:i:sa")."',NULL,NULL,'0','0',NULL,NULL)");
				$query9 = mysqli_multi_query($conn,"INSERT INTO `hexa-forum_users_groups`(`user_id`, `group_id`) VALUES ('1','1')");
				file_put_contents("installer.zip", fopen("installer-files.zip", 'r'));
				$zip = new ZipArchive;
				$zip->open('installer.zip');
				$zip->extractTo('./');
				$zip->close();
				$myFile = "installer.zip";
				$installerFile = "install.php";
				unlink($myFile);
				unlink(basename(__FILE__));
				$config = "<?php" . " return array (
				  'debug' => true,
				  'database' => 
				  array (
					'driver' => 'mysql',
					'host' => 'localhost',
					'database' => '".$fdbname."',
					'username' => '".$fdbuser."',
					'password' => '".$fdbpass."',
					'charset' => 'utf8mb4',
					'collation' => 'utf8mb4_unicode_ci',
					'prefix' => 'hexa-forum_',
					'port' => '3306',
				  ),
				  'url' => '".$flink."',
				  'paths' => 
				  array (
					'api' => 'api',
					'admin' => 'admin',
				  ),
				);";
				file_put_contents("config.php", "");
				file_put_contents("config.php", $config);
				header('Location: '.$flink);
		}
	}
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Install Flarum | Hexa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="https://myhexa.co/back/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://myhexa.co/scss/bootstrap/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://myhexa.co/dist/theme.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://myhexa.co/dist/theme.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    </head>
<body class="signin-page">
                  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" role="navigation">
                <div class="container">
                  <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-2">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand" href="#"><img src="img/logo.png" class="d-none d-lg-inline mr-2 w-25" /></a>
                  <div class="collapse navbar-collapse justify-content-end" id="navbar-collapse-2">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co" target="_blank">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/features" target="_blank">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/pricing" target="_blank">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://myhexa.co/contact" target="_blank">Contact Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://community.myhexa.co" target="_blank">Community</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link nav-link--rounded ml-lg-2" target="_blank" href="http://flarum-demo.myhexa.co">View Demo Site</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        <br><br><br><br><br><br><div class="wrapper"><h1>Install Flarum</h1>
<p>This <a href="http://flarum.org">Flarum</a> auto-installer was created by the team at <a href="https://myhexa.co">Hexa</a>.</p></div>
<form method="post">
  <div id="error" style="display:none"></div>
<br><h3 class="lead"><b>Basic Information:</b></h3><br>
  <div class="FormGroup">
    <div class="form-field">
      <input type="text" name="forumTitle" placeholder="Forum Title" required>
    </div>
          <div class="FormField">
      <input type="text" name="primaryColor" placeholder="Primary Color (ex: #000000)">
    </div>
  </div>
<br><h3 class="lead"><b>MySQL Details:</b></h3><br>
      <div class="form-field">
      <input type="text" name="mysqlDatabase" placeholder="DB Name" required>
    </div>
    <div class="form-field">
      <input type="text" name="mysqlUsername" placeholder="DB Username" required>
    </div>
    <div class="form-field">
      <input type="password" name="mysqlPassword" placeholder="DB Password" required>
	</div>
<br><h3 class="lead"><b>Account Details:</b></h3><br>
  <div class="FormGroup">
    <div class="form-field">
      <input type="text" name="adminUsername" placeholder="Username" required>
    </div>
    <div class="form-field">
      <input type="text" name="adminEmail" placeholder="Email Address" required>
    </div>
    <div class="FormField">
      <input type="text" value="12345678" placeholder="Password" disabled>
    </div>
  </div><br>
<div class="wrapper">
  <div class="FormButtons">
<button type="submit" class="btn-shadow btn-shadow-dark btn-pill" name="install"><i class="zmdi zmdi-check"></i> INSTALL FORUM</button><br><br>
<a href="index"><i class="zmdi zmdi-arrow-left"></i> Back to Welcome Screen</a>
  </div>
  </div>
</form>
<div class="index-features-cta">
  <div class="container">
    <div class="info">
      <strong>
At Hexa, we believe code is AWESOME!
</strong>
      <p>
        It takes a lot of time and hard work to put together these projects.<br> Please show your support by sharing this project!
      </p>
    </div>
    <a href="https://twitter.com/home?status=I%20just%20installed%20%40flarum%20using%20the%20%40myhexa%20auto-installer.%20You%20should%20really%20check%20out%20their%20stuff!%20It's%20really%20AWESOME!!!">Share on Twitter</a>
  </div>
</div>
<div class="wrapper"><br>
  <div class="alert alert-inverse" role="alert">
  Running into any issues during installation? Please click <a href="https://community.myhexa.co/t/flarum-installer">here</a> to let us know about them.
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
      </div>
    </div>
  </body>
</html>
