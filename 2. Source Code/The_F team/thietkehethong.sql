-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 30, 2018 lúc 05:37 AM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thietkehethong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Admin_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_Name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_Phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_Mail` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_User_Name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_Password` varchar(41) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `Admin_Id`, `Admin_Name`, `Admin_Phone`, `Admin_Mail`, `Admin_User_Name`, `Admin_Password`, `create_time`, `update_time`) VALUES
(1, 'huynhlehoangduc@gmail.com', 'Huỳnh Lê Hoàng Đức', '01693376006', 'huynhlehoangduc@gmail.com', 'huynhlehoangduc@gmail.com', '709233395bcfc2f27f4cf2aa8eac279575211893', '2018-04-28 23:06:48', '2018-04-28 23:06:48'),
(2, 'tranthianhthu@gmail.com', 'Trần Thị Anh Thư', '0981872864', 'tranthianhthu@gmail.com', 'tranthianhthu@gmail.com', '709233395bcfc2f27f4cf2aa8eac279575211893', '2018-04-29 21:38:48', '2018-04-29 21:38:48'),
(3, 'huynhlehoangduc1@gmail.com', 'Huỳnh Lê Hoàng Đức', '01693376006', 'huynhlehoangduc1@gmail.com', 'huynhlehoangduc1@gmail.com', '709233395bcfc2f27f4cf2aa8eac279575211893', '2018-05-02 22:08:56', '2018-05-02 22:08:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `Customer_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Customer_Name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Customer_Phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Customer_Mail` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Customer_Address` text COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `Invoice_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Customer_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Note` text COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `Invoice_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Product_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quantity` smallint(6) DEFAULT NULL,
  `Customer_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `Product_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Product_Name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Product_Cost` bigint(20) DEFAULT NULL,
  `Product_Instock` smallint(6) DEFAULT NULL,
  `Product_Description` text COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `Product_Id`, `Product_Name`, `Product_Cost`, `Product_Instock`, `Product_Description`, `create_time`, `update_time`) VALUES
(8, 'son001', 'Son3ce đỏ cam', 300000, 40, 'Son rất đẹp.\r\nĐược chọn lọc từ những cây son đẹp nhất từ Hàn Quốc.\r\nĐem lại bở môi mềm mại căng mọng cho chị em.\r\n', '2018-05-06 15:14:42', '2018-05-28 23:00:29'),
(9, 'son002', 'son 3ce hồng cam', 20000, 7, 'Son rất đẹp.\r\nĐược chọn lựa kĩ càng từ những cây son ở Hàn Quốc.\r\nTự tin giúp chị em phụ nữ có đôi môi căng mọng.', '2018-05-06 16:04:38', '2018-05-28 23:00:29'),
(10, 'son003', 'son 3ce hồng đất', 200000, 9, 'Son rất đẹp', '2018-05-06 21:16:15', '2018-05-22 12:04:56'),
(11, 'son004', 'Son 3ce cam đất', 200000, 13, 'Son rất đỉnh', '2018-05-06 21:17:01', '2018-05-22 12:01:12'),
(12, 'son005', 'Son 3ce đỏ đất', 200000, 14, 'Son rất đỉnh được chị em phụ nữ tin dùng.', '2018-05-06 21:20:36', '2018-05-22 11:58:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `Product_Id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_image_link` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `Product_Id`, `product_image_link`) VALUES
(13, 'son002', '../Common/Imagesson002son-3ce-a1.jpg'),
(22, 'son001', '../Common/Imagesson001son-3ce-a1.jpg'),
(25, 'son001', '../Common/Imagesson001son-1.jpg'),
(26, 'son003', '../Common/Imagesson003Son-3.jpg'),
(27, 'son004', '../Common/Imagesson004son-2.jpg'),
(28, 'son005', '../Common/Imagesson005son-3CE-Barbapapa-Matte-Lip-Color-820x820.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
