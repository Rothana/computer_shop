-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2013 at 06:18 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbitonecomputer`
--

-- --------------------------------------------------------

--
-- Table structure for table `rln_advertise`
--

CREATE TABLE IF NOT EXISTS `rln_advertise` (
  `adv_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adv_title` varchar(255) DEFAULT NULL,
  `adv_link` varchar(255) DEFAULT NULL,
  `adv_status` int(11) DEFAULT '1',
  `adv_img` varchar(255) DEFAULT NULL,
  `adv_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rln_advertise`
--

INSERT INTO `rln_advertise` (`adv_id`, `adv_title`, `adv_link`, `adv_status`, `adv_img`, `adv_order`) VALUES
(2, 'Online', 'http://itkonkhmer.com/', 1, 'Online050113160801947.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rln_category`
--

CREATE TABLE IF NOT EXISTS `rln_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_url` varchar(255) DEFAULT NULL,
  `category_parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `rln_category`
--

INSERT INTO `rln_category` (`category_id`, `category_name`, `category_url`, `category_parent`) VALUES
(9, 'Computer Laptop', 'laptop', '0'),
(10, 'Computer Desktop', 'desktop', '0'),
(11, 'Dell', 'dell_laptop', '9'),
(12, 'Toshiba', 'toshiba_laptop', '9'),
(13, 'ASUS', 'asus_laptop', '9'),
(14, 'HP', 'hp_laptop', '9'),
(15, 'Acer', 'acer_laptop', '9'),
(16, 'Samsung ', 'samsung_laptop', '9'),
(17, 'Sony', 'sony_laptop', '9'),
(18, 'Lenovo', 'lenovo_laptop', '9'),
(19, 'Printers', 'printer', '0'),
(20, 'Monitor LCD', 'monitor', '0'),
(21, 'Projectors', 'projector', '0'),
(22, 'Accessories', 'accessories', '0'),
(23, 'Scanner', 'scanner', '0'),
(24, 'Clone', 'clone', '10'),
(25, 'Brand Dell', 'brand_dell', '10'),
(26, 'Server', 'sever', '10'),
(27, 'Brand Acer', 'brand_acer', '10'),
(28, 'HP', 'hp_printer', '19'),
(29, 'ESPSON', 'espson', '19'),
(30, 'CANON', 'canon', '19'),
(31, 'SHAP', 'shap', '19'),
(32, 'BROTHER', 'brother', '19'),
(33, 'SAMSUNG', 'samsung_printer', '19'),
(34, 'Acer', 'acer_monitor', '20'),
(35, 'Dell', 'dell_monitor', '20'),
(36, 'Samsung', 'samsung_monitor', '20'),
(37, 'LCD Projector', 'lcd_projector', '21'),
(38, 'Mouse', 'mouse', '22'),
(39, 'HDD', 'hdd', '22'),
(40, 'CPU', 'cpu', '22'),
(41, 'RAM', 'ram', '22'),
(42, 'Canon', 'canon_scanner', '23'),
(43, 'EPSON', 'epson_scanner', '23');

-- --------------------------------------------------------

--
-- Table structure for table `rln_image`
--

CREATE TABLE IF NOT EXISTS `rln_image` (
  `img_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `img_image1` varchar(255) DEFAULT NULL,
  `img_image2` varchar(255) DEFAULT NULL,
  `img_image3` varchar(255) DEFAULT NULL,
  `img_image4` varchar(255) DEFAULT NULL,
  `img_image5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `rln_image`
--

INSERT INTO `rln_image` (`img_id`, `img_image1`, `img_image2`, `img_image3`, `img_image4`, `img_image5`) VALUES
(25, 'desktops_page1_xtreme_desktops_2013599338220.png', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(26, '169271446824425.png', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(27, '169271357986749.png', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(34, 'Invalid', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(36, 'latp686730363.jpg', 'dsc9654-13575893242127600855.jpg', 'vizilap1757820307.jpg', 'url60296595.jpg', 'toshiba-p-series-20131161288952.jpg'),
(37, 'leak-iphone-5-0927818246.927818246.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(38, 'map1570534990.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(39, 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(40, 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(41, 'Toshiba_Student_FA21891318118.png', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(42, 'mac-ipad186841610.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(43, 'dsc9654-13575893241652474008.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(44, 'printers1226351202.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(45, 'storejet_25_mobile_usb_y_cable843235730.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(46, 'hp-computer-printer-1045677272206918.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(47, '2013-05-09-0003281448549892627.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(48, 'main-1-lenovo-0707131196508674.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg'),
(49, 'url1772988150.jpg', 'vizilap1479473349.jpg', 'dsc9654-1357589324864155948.jpg', 'noimage.jpg', 'noimage.jpg'),
(50, 'itone-show1511088318.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg', 'noimage.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rln_page`
--

CREATE TABLE IF NOT EXISTS `rln_page` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) DEFAULT NULL,
  `page_description` text,
  `page_status` int(11) DEFAULT '1',
  `page_image` bigint(20) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `page_view` int(11) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rln_page`
--

INSERT INTO `rln_page` (`page_id`, `page_title`, `page_description`, `page_status`, `page_image`, `page_url`, `page_view`) VALUES
(8, 'About', '&lt;p&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;History&lt;/span&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Since its inception in 2000, CHHAY HOK COMPUTER TRADING has grown steadily and enhanced its business through inspired innovations. We''re continually transforming into a dynamic, customer-driven, talent-powered company that focuses on enhancing our customers'' enjoyment of technology. Like many companies, we come from humble beginnings. We''ve been challenged signi&amp;#64257;cantly from time to time and we''ve learned, changed and grown from each of these challenges.&lt;br /&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Today, CHHAY HOK COMPUTER TRADING operates 3 branches of retail outlets with a commitment to growth and innovation. Our employees strive to provide customers around the nation with superior experiences by responding to their unique needs and aspirations. This commitment to growth and customers has driven strong, consistent earnings growth. Retail is a business that requires constant innovation, new ideas, new ways to delight our customers and new ways to work together. To meet the unique product and service needs of our customers, our stores and operating models are being transformed to shift our focus from product-centric to customer-centric &amp;mdash; a move that poises CHHAY HOK to truly offer the entertainment and technology solutions that meet our customers'' needs, end-to- end.&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;Vision&lt;/span&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; Based on the rapid growth of IT industries in both global and national economy, CHHAY HOK COMPUTER TRADING has set its goal to meet the right need of demanding home users, corporate users and government institutes in order to improve and strengthen quality of IT sector.&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;Mission&lt;/span&gt;&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; CHHAY HOK COMPUTER TRADING has been striving to break the barriers of technology reaching people, our long term mission is to educate people to adopt new way of living with technology and computerization. Everyone can enjoy life with technology and more quality. &lt;/p&gt;', 1, 37, 'about', NULL),
(9, 'Contact', '&lt;p&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;CHHAY HOK (Phsar Thmey)&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Address 1: # 85, Street 126, Sang Khat Phsar Thmey I, Khan Duan Penh, Phnom Penh, Cambodia.&lt;br /&gt;&lt;br /&gt;Ms.Somrith Dalin &amp;nbsp;&lt;br /&gt;Sale&lt;br /&gt;Tel : +855 12 600 717&lt;br /&gt;E-mail : sales11@chhayhok.com&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;CHHAY HOK (Monivong)&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Address 2: # 280D, Monivong Blvd, Khan Duan Penh, Phnom Penh, Cambodia.&lt;br /&gt;Tel : 023 223 339 / H/P : 012 86 2079&lt;br /&gt;&lt;br /&gt;Mr. Chim Chantha &amp;nbsp;&lt;br /&gt;Sales Manager&lt;br /&gt;Tel : +855 12 862 079&lt;br /&gt;E-mail : sales21@chhayhok.com&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;CHHAY HOK (Olympic)&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Address 3: # 17, 18 ,19 Sihanouk Blvd in fron of Mohamontrey Pagoda, Phnom Penh, Cambodia.&lt;br /&gt;&lt;br /&gt;Miss. Khy Srey Houng &amp;nbsp;&lt;br /&gt;Sales Manager&lt;br /&gt;Tel : +855 88 831 88 61 / +855 11 59 34 00&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; +855 88 69 69 788 / +855 12 353 188&lt;br /&gt;E-mail: sales31@chhayhok.com&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;Corporate Sale &amp;nbsp;&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Tel: +855 88 69 69 588 / +855 88 69 69 688&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&lt;br /&gt;E-mail: mkt31@chhayhok.com&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;Project Sale &amp;nbsp;&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Tel: +855 12 33 71 88&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&lt;br /&gt;E-mail: mkt31@chhayhok.com&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-size: medium;&quot;&gt;Service Support &amp;nbsp;&lt;/span&gt;&lt;br /&gt;&lt;br /&gt;Tel: +855 15 93 90 88&amp;nbsp; /&amp;nbsp; +855 77 67 10 88&amp;nbsp;&amp;nbsp; /&amp;nbsp; +855 23 6340 788&amp;nbsp; /&amp;nbsp; +855 23 63 70 788&amp;nbsp; &amp;nbsp;&lt;br /&gt;E-mail: service31@chhayhok.com&lt;/p&gt;', 1, 38, 'contact', NULL),
(10, 'Service', '&lt;p&gt;Service&lt;/p&gt;', 1, 39, 'service', NULL),
(11, 'Announcement', '&lt;p&gt;Under Contruction&lt;/p&gt;', 1, 40, 'announcement', NULL),
(12, 'Promotion', '', 1, 41, 'promotion', NULL),
(13, 'Show Room', '', 1, 50, 'showroom', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rln_post`
--

CREATE TABLE IF NOT EXISTS `rln_post` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) DEFAULT NULL,
  `post_price` varchar(255) DEFAULT NULL,
  `post_description` text,
  `post_category` int(11) DEFAULT NULL,
  `post_user` int(11) DEFAULT NULL,
  `post_image` int(11) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  `post_new` int(11) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_view` int(11) DEFAULT '0',
  `post_feature` int(1) DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `rln_post`
--

INSERT INTO `rln_post` (`post_id`, `post_title`, `post_price`, `post_description`, `post_category`, `post_user`, `post_image`, `post_status`, `post_new`, `post_date`, `post_view`, `post_feature`) VALUES
(22, 'Extream Desktop', '550', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 11, 4, 25, 1, 0, '2013-08-24 09:56:21', 7, 1),
(24, 'Ultra Macbook', '1050', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;/p&gt;', 11, 4, 36, 1, 1, '2013-08-25 08:57:21', 34, 1),
(25, 'Mac Pro', '1000', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 14, 4, 42, 1, 1, '2013-08-27 12:59:40', 9, 1),
(26, 'ASUS Laptop', '600', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 13, 4, 43, 1, 1, '2013-08-27 13:03:19', 0, 1),
(27, 'Epson Printer', '300', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 29, 4, 44, 1, 1, '2013-08-27 13:03:42', 1, 1),
(28, 'Mobile Cable', '10', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 38, 4, 45, 1, 1, '2013-08-27 13:04:11', 1, 1),
(29, 'HP printer', '400', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 28, 4, 46, 1, 1, '2013-08-27 13:04:33', 0, 1),
(30, 'Cable', '10', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 39, 4, 47, 1, 1, '2013-08-27 13:04:53', 3, 1),
(31, 'Lenovo', '500', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 18, 4, 48, 1, 1, '2013-08-27 13:05:49', 19, 1),
(32, 'Macbook', '800', '&lt;p&gt;- OS :Boot-up Linux&lt;br /&gt;- Processor : Intel Core i7-3517U (1.9GHz,4MB L3 Cache Turboo Boost Up to 3.00GHz)&lt;br /&gt;- Display : 14.0&quot; HD Acer Cine Crystal LED LCD&lt;br /&gt;- Graphic : Nvidia Geforce GT 620M&amp;nbsp; 1GB&lt;br /&gt;- Memory : 8GB DDR3 Memory&lt;br /&gt;- Storage : 500GB HDD&lt;br /&gt;- Optical Drive : DVD-Super Multi DL Drive&lt;br /&gt;- Card Reader : 2-in-1 Card reader&lt;br /&gt;- WLAN : Acer Nplity 802.11a/b/g/n , Bluetooth : v4.0 + HS&lt;br /&gt;- WWAN : N/A&lt;br /&gt;- Webcam : Acer Crystal Eye HD Webcam 1.3 MP&lt;br /&gt;- Battery : 4-Cell Li-Polymer battery&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', 13, 4, 49, 1, 1, '2013-08-27 13:06:45', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rln_user`
--

CREATE TABLE IF NOT EXISTS `rln_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rln_user`
--

INSERT INTO `rln_user` (`user_id`, `user_name`, `user_username`, `user_password`, `user_type`) VALUES
(3, 'Rothana Choun', 'rothana', 'rothana<3nin', 'administrator'),
(4, 'ITOne Computer', 'itone', 'itone', 'author'),
(6, '', '', '', 'author');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
