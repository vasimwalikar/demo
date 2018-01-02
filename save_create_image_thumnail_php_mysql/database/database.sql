CREATE DATABASE image_test;
USE image_test;
CREATE TABLE IF NOT EXISTS `tbl_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
INSERT INTO `tbl_images` (`id`, `image_name`) VALUES
(5, '54741_1400140247.png'),
(6, '253534_1400140264.jpeg'),
(7, '602283_1400140264.png'),
(8, '110099_1400140284.png'),
(9, '648729_1400140301.png'),
(10, '834064_1400140301.png');
