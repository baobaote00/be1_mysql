-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3309
-- Thời gian đã tạo: Th10 14, 2020 lúc 04:11 AM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `be1`
--
CREATE DATABASE IF NOT EXISTS `be1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `be1`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Tẩy rửa'),
(2, 'Máy móc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_price`, `product_photo`) VALUES
(1, 'Nước Lau Sàn Sunlight Tinh Dầu Thiên Nhiên - Hương Hoa Diên Vỹ 3.8kg', 'Giúp sàn nhà bạn sạch bóng không tì vết và ngát hương thơm chỉ sau một lần lau nhẹ\r\nCó thể sử dụng sản phẩm cho các không gian trong nhà như: phòng ngủ, phòng khách bếp và phòng tắm, mang lại vẻ sáng bóng cho tổ ấm của bạn.\r\nĐánh bay vết bẩn nhanh chóng- Giúp sàn nhà bạn sạch bóng không tì vết và ngát hương thơm chỉ sau một lần lau nhẹ\r\n- Có thể sử dụng sản phẩm cho các không gian trong nhà như: phòng ngủ, phòng khách bếp và phòng tắm, mang lại vẻ sáng bóng cho tổ ấm của bạn.\r\n- Đánh bay vết bẩn nhanh chóng\r\nGiá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Tuy nhiên tuỳ vào từng loại sản phẩm hoặc phương thức, địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, ...', 78000, '48b520f3b84fe0ca3c68529d624e33e3.jpg'),
(2, 'Máy Khuếch Tán Tinh Dầu Kiêm Đèn Ngủ Mini USB Xiaomi HL (120ml)', 'Ba chức năng: làm ẩm không khí, khuếch tán tinh dầu, đèn ngủ\r\nDung tích: 120ml\r\nĐiều khiển bằng một nút bấm\r\nChất liệu: nhựa ABS + PP\r\nĐế silicon chống trượt\r\nPhương thức sạc: USB\r\nChức năng tắt nguồn thông minh và an toàn', 279000, '8dbc6c26f8b6ae8ef1feddba70494179.jpg'),
(3, 'Bàn Chải Đánh Răng Điện Oral B Vitality', 'Bàn chải điện được kiểm nghiệm làm sạch răng tốt hơn so với bàn chải thông thường\r\nKiểu dáng thiết kế tạo thế cầm chắc chắn,bọc lót khi cầm không bị rơi\r\nRất tốt cho cả trẻ nhỏ và người lớn ( khuyến khích trẻ tự bảo vệ răng miệng )\r\nHữu dụng khi trẻ bị viêm lợi hay đang kiềng răng\r\nĐánh răng với tốc độ chậm hơn giúp làm sạch răng lợi nhạy cảm\r\nGiúp chải răng sạch trong mọi ngõ ngách\r\nOral-B là nhãn hiệu được các nha sĩ khuyên dùng', 497000, 'a4ac08485ff7545e6f4c728df9841fa3.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
