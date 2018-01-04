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
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="A complete landing page solution for any business">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="favicon.ico">
		<title>Install Flarum | Hexa</title>
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/strokegap/style.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/linearicons/style.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/slick-carousel/slick/slick.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/fancybox/dist/jquery.fancybox.min.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/vendor/animate.css/animate.min.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/css/bundle.css">
		<link rel="stylesheet" href="https://myhexa.co/assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Google%20Sans:400,500,600,700%7COpen+Sans:400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
		<header class="header header-shrink header-inverse fixed-top">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="/">
						<span class="logo-default">
          <img src="https://myhexa.co/assets/img/hexa-white.svg" alt="">
        </span>
						<span class="logo-inverse">
          <img src="https://myhexa.co/assets/img/hexa.svg" alt="">
        </span>
					</a>
					<div class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
						<span class="lnr lnr-text-align-right nav-hamburger"></span>
						<span class="lnr lnr-cross nav-close"></span>
					</div>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-rounded btn-default u-w-110" href="https://myhexa.co" target="_blank">Visit Hexa</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-rounded btn-white u-w-160" href="https://github.com/myhexa/flarum-installer">View on GitHub</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<section class="u-py-100 u-pt-lg-200 u-pb-lg-150 u-flex-center" style="background: linear-gradient(-180deg, #BCC5CE 0%, #929EAD 98%), radial-gradient(at top left, rgba(255,255,255,0.30) 0%, rgba(0,0,0,0.30) 100%);
 background-blend-mode: screen; background-size:cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center text-white">
						<h1 class="text-white">
    			Install Flarum Software
    		</h1>
						<div class="u-h-4 u-w-50 bg-white rounded mx-auto my-4"></div>
						<p class="lead">
							During this installation, Flarum will be installed onto
							<?php
$hostname = getenv('HTTP_HOST');
echo $hostname; ?>
						</p>
						<button class="btn btn-white btn-rounded mt-4 u-w-200" data-scrollto="step1">Continue</button>

					</div>
				</div>
			</div>
		</section>
		<section class="pb-0 u-pt-100" id="step1">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 m-auto text-center">
						<div class="card box-shadow-v2 bg-white u-of-hidden">
							<h2 class="bg-hexa m-0 py-3 text-white">Basic Info</h2>
							<div class="p-5 u-px-md-70 u-pb-80">
								<form method="post">
									<input class="u-mb-25" type="text" name="forumTitle" placeholder="Forum Title" required>
									<input class="u-mb-25" type="text" name="primaryColor" placeholder="Primary Color (ex: #000000)">
									<button class="btn btn-primary btn-rounded mt-4" data-scrollto="step2">Next Step</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="pb-0 u-pt-100" id="step2">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 m-auto text-center">
						<div class="card box-shadow-v2 bg-white u-of-hidden">
							<h2 class="bg-default m-0 py-3 text-white">MySQL Details</h2>
							<div class="p-5 u-px-md-70 u-pb-80">
								<input class="u-mb-25" type="text" name="mysqlDatabase" placeholder="DB Name" required>
								<input class="u-mb-25" type="text" name="mysqlUsername" placeholder="DB Username" required>
								<input class="u-mb-25" type="password" name="mysqlPassword" placeholder="DB Password" required>
								<button class="btn btn-default btn-rounded mt-4" data-scrollto="step3">Next Step</button>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="pb-0 u-pt-100" id="step3">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 m-auto text-center">
						<div class="card box-shadow-v2 bg-white u-of-hidden">
							<h2 class="bg-hexa m-0 py-3 text-white">Account Details</h2>
							<div class="p-5 u-px-md-70 u-pb-80">
								<input class="u-mb-25" type="text" name="adminUsername" placeholder="Username" required>
								<input class="u-mb-25" type="email" name="adminEmail" placeholder="Email Address" required>
								<input class="u-mb-25" type="email" value="12345678" placeholder="Password" disabled>
								<button type="submit" class="btn btn-primary btn-rounded mt-4" name="install">Install Now</button>
								</form>
							</div>
						</div>
						<br>Need some assistance? Check out our forum where you can find answers and post your questions. <a href="https://talk.myhexa.co/t/flarum-installer" target="_blank" style="text-decoration: underline">Visit Forum</a>
						<br>
						<br>
					</div>
				</div>
			</div>
		</section>
		<script src="https://myhexa.co/assets/vendor/jquery/dist/jquery.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/popper.js/dist/popper.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/isotope/dist/isotope.pkgd.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/parallax.js/parallax.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/wow/dist/wow.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/vide/dist/jquery.vide.min.js"></script>
		<script src="https://myhexa.co/assets/vendor/appear-master/dist/appear.min.js"></script>
		<script src="https://myhexa.co/assets/js/smoothscroll.js"></script>
		<script src="https://myhexa.co/assets/js/bundle.js"></script>
		<script src="https://myhexa.co/assets/js/fury.js"></script>
	</body>

	</html>
