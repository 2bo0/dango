CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザー名',
  `login` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザーID',
  `pass` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'パスワード',
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'メールアドレス',
  `stat` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'ユーザー状態\n0 : 未指定\n1 : 有効\n2 : 仮登録\n9 : 無効',
  `permission` int(11) NOT NULL DEFAULT '0' COMMENT '権限\n0 : 未指定\n1 : ページ投稿者\n98 : 運営管理者\n99 : システム管理者',
  `created_in` datetime NOT NULL COMMENT '作成日時',
  `created_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '作成者ID',
  `created_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作成者IP',
  `updated_at` datetime NOT NULL COMMENT '更新日時',
  `updated_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '更新者ID',
  `updated_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新者IP',
  `deleted_flg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '削除フラグ\n0 : 未削除\n1 : 削除済',
  PRIMARY KEY (`id`),
  KEY `auth_login_pass` (`login`,`pass`),
  KEY `auth_email_pass` (`email`,`pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pc_title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'タイトル',
  `sp_title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'タイトル',
  `pc_body` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '本文',
  `sp_body` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '本文',
  `pc_page_template_id` bigint(20) NOT NULL DEFAULT '0',
  `sp_page_template_id` bigint(20) NOT NULL DEFAULT '0',
  `stat` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'ページ状態\n0 : 未指定\n1 : 有効\n2 : 下書き\n9 : 無効',
  `release_date` datetime NOT NULL COMMENT '公開日時',
  `created_in` datetime NOT NULL COMMENT '作成日時',
  `created_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '作成者ID',
  `created_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作成者IP',
  `updated_at` datetime NOT NULL COMMENT '更新日時',
  `updated_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '更新者ID',
  `updated_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新者IP',
  `deleted_flg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '削除フラグ\n0 : 未削除\n1 : 削除済',
  PRIMARY KEY (`id`),
  KEY `search` (`stat`,`release_date`,`pc_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `page_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'タイトル',
  `path` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'テンプレートファイルの保存場所のROOTディレクトリのパス',
  `site_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'サイト区分\n0 : 未指定\n1 : PC\n2 : SP',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '説明',
  `stat` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'ページ状態\n0 : 未指定\n1 : 有効\n2 : 下書き\n9 : 無効',
  `created_in` datetime NOT NULL COMMENT '作成日時',
  `created_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '作成者ID',
  `created_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作成者IP',
  `updated_at` datetime NOT NULL COMMENT '更新日時',
  `updated_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '更新者ID',
  `updated_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新者IP',
  `deleted_flg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '削除フラグ\n0 : 未削除\n1 : 削除済',
  PRIMARY KEY (`id`),
  KEY `search` (`site_type`,`stat`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
