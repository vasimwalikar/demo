--
-- Database: `phpcooker_script`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(20) NOT NULL AUTO_INCREMENT,
  `product_title` varchar(150) NOT NULL,
  `product_desc` text NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_price` decimal(12,2) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` enum('0','1') NOT NULL COMMENT '0-active,1-inactive',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_title`, `product_desc`, `product_brand`, `product_price`, `product_image`, `product_status`) VALUES
(1, 'Vagitable', 'This is best Vagitable', 'test brand', '200.00', 'intro_cream_of_crop.jpg', '1'),
(2, 'Broccoli', 'Broccoli is best in test', 'new brand', '250.00', 'broccoli.jpg', '1'),
(3, 'cucumbers', 'Friesh cucumbers for saled', 'test brand', '150.00', 'cucumbers.jpg', '1'),
(4, 'carrots', 'carrots is testy', 'new brand', '300.00', 'carrots.jpg', '1');

