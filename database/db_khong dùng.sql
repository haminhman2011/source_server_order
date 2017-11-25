SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `module_child` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `role` text,
  `module_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permissions` text,
  `note` text,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '-1:đã xóa, 0: không kích hoạt, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `syslog` (
  `id` int(11) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `level` tinyint(2) NOT NULL COMMENT '1: Error, 2: Warning, 3: Info; 4: Trace',
  `log_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tbl_template` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT '1',
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `created_date` int(11) UNSIGNED NOT NULL,
  `modified_date` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Họ và tên',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_extension` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Số nội bộ',
  `status` tinyint(6) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 0: không kích hoạt, 1: kích hoạt',
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: user thường, 1: admin, 100: super admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `fullname`, `auth_key`, `password_hash`, `token`, `email`, `phone`, `phone_extension`, `status`, `created_date`, `modified_date`, `created_by`, `modified_by`, `last_login`, `role_id`, `type`) VALUES
(1, 'admin', '', '7cQuboiD43v27zFSWgJHTJWIal6tukje', '$2y$13$hLYAOEZJ31jrgw2xeRDQj.I1K//8BybKU3aLpwoSXhbpN3fqA5l.C', 'XGMvl2RJJUB3eGW3y9vJrMFMqmDZ52fI_1497337668', 'phamquanghieu0206@gmail.com', '01682405889', '1', 1, 1392559490, 1497372972, NULL, NULL, 1505120930, NULL, 100);


ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `module_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `syslog`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`token`),
  ADD KEY `role_id` (`role_id`);


ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `module_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `syslog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `tbl_template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `module_child`
  ADD CONSTRAINT `module_child_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
