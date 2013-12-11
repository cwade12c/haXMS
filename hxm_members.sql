CREATE TABLE IF NOT EXISTS `hxm_members` (
  `id` varchar(10) NOT NULL,
  `email` varchar(159) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `key` varchar(32) NOT NULL,
  `group` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
