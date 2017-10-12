CREATE DATABASE rating_system;
USE rating_system;

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_price`) VALUES
(1, 'Smasung Galaxy S3', 500),
(2, 'Micromax Canvas Doodle', 600),
(3, 'Nokia X1', 100),
(4, 'Nokia Lumia 1310', 650),
(5, 'HTC Desire 501', 200),
(6, 'Nokia asha 501', 100),
(7, 'Sony Xperia', 800);

CREATE TABLE IF NOT EXISTS `tbl_products_ratings` (
  `ratings_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ratings_score` int(11) NOT NULL,
  PRIMARY KEY (`ratings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `tbl_products_ratings` (`ratings_id`, `product_id`, `user_id`, `ratings_score`) VALUES
(1, 1, 11, 4),
(2, 2, 11, 3),
(3, 3, 11, 2),
(4, 2, 10, 4),
(5, 2, 9, 3),
(6, 1, 9, 3),
(7, 3, 9, 4),
(8, 4, 9, 5),
(9, 7, 9, 4),
(10, 7, 12, 5),
(11, 6, 12, 3);

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

INSERT INTO `tbl_users` (`user_id`, `user_name`) VALUES
(11, 'Zinedine Zidane'),
(10, 'Shahrukh Khan'),
(9, 'John Doe'),
(12, 'Cristiano Ronaldo');