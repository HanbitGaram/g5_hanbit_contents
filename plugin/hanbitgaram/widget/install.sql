CREATE TABLE `[[G5_TABLE_PREFIX]]hanbitgaram_widget` (
  `fw_id` bigint(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fw_subject` varchar(255) NOT NULL,
  `fw_contents` longtext DEFAULT NULL,
  `fw_type` varchar(20) NOT NULL,
  `fw_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;