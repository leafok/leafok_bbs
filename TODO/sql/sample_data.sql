SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `admin_config` (`AID`, `UID`, `begin_dt`, `end_dt`, `enable`, `major`) VALUES
(1, 1, '2026-01-01 00:00:00', '2036-01-01 00:00:00', 1, 1);

INSERT INTO `section_class` (`CID`, `cname`, `title`, `enable`, `sort_order`) VALUES
(1, 'SYS', '系统管理', 1, 10);

INSERT INTO `section_config` (`SID`, `sname`, `CID`, `title`, `comment`, `topic_retention`, `announcement`, `enable`, `exp_get`, `recommend`, `set_UID`, `set_dt`, `set_ip`, `sort_order`, `ex_gen_tm`, `ex_update`, `ex_menu_tm`, `ex_menu_update`, `read_user_level`, `write_user_level`) VALUES
(1, 'SYSOP', 1, '论坛管理', '', 0, '', 1, 1, 1, 1, '2026-01-01 00:00:00', '127.0.0.1', 1, NULL, 1, NULL, 1, 0, 1),
(2, 'Test', 1, '测试区', '', 0, '', 1, 0, 0, 1, '2026-01-01 00:00:00', '127.0.0.1', 2, NULL, 1, NULL, 1, 1, 1);

INSERT INTO `section_favorite` (`ID`, `UID`, `SID`) VALUES
(3, 1, 1);

INSERT INTO `section_master` (`MID`, `SID`, `UID`, `begin_dt`, `end_dt`, `enable`, `major`, `memo`) VALUES
(1, 1, 1, '2026-01-01 00:00:00', '2036-01-01 00:00:00', 1, 1, NULL);

INSERT INTO `user_list` (`UID`, `username`, `password`, `temp_password`, `enable`, `verified`, `p_login`, `p_post`, `p_msg`) VALUES
(1, 'sysop', '', '55b8624bb2d098bf1c01a7ad884f0037244ac4bd08b447462cb8b00000e954ba', 1, 1, 1, 1, 1);

INSERT INTO `user_nickname` (`NID`, `UID`, `nickname`, `begin_dt`, `begin_reason`, `end_dt`, `end_reason`) VALUES
(1, 1, '懂王', '2026-01-01 00:00:00', 'R', NULL, NULL);

INSERT INTO `user_pubinfo` (`UID`, `nickname`, `email`, `gender`, `qq`, `introduction`, `photo`, `photo_enable`, `photo_ext`, `life`, `exp`, `visit_count`, `gender_pub`, `last_login_dt`, `last_logout_dt`, `sign_1`, `sign_2`, `sign_3`, `upload_limit`, `login_notify_dt`, `user_timezone`, `game_money`) VALUES
(1, '懂王', 'zhangsan@example.com', 'M', '', '', 0, 0, '', 150, 0, 4, 1, '2026-01-01 00:00:00', '2026-01-01 00:00:00', '', '', '', 1048576, NULL, 'Asia/Shanghai', 0);

INSERT INTO `user_reginfo` (`UID`, `name`, `birthday`, `signup_dt`, `signup_ip`, `memo`) VALUES
(1, '张三', '1995-09-01 00:00:00', '2026-01-01 00:00:00', '127.0.0.1', NULL);
COMMIT;
