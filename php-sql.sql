-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 20, 2024 lúc 09:16 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `serein`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(10) NOT NULL,
  `collection` varchar(40) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `banner_show` int(11) NOT NULL DEFAULT 0 COMMENT '0 là không show, 1 là show',
  `action` varchar(30) NOT NULL,
  `background` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `collection`, `title`, `des`, `link`, `img`, `banner_show`, `action`, `background`) VALUES
(1, 'Bộ sưu tập', 'Dấu Ấn', 'Mỗi chúng ta là một cá thể độc nhất trên thế giới, vậy nên, hãy thoải mái sáng tạo theo cách riêng của bạn. Dù ở bất kỳ phiên bản nào, Serein Jewelry luôn đồng hành cùng bạn ghi lại “DẤU ẤN” riêng bạn.\r\n', '/shop', 'Public/img/vong-tay-vang-dinh-kim-cuong.png', 0, 'Mua ngay', ''),
(2, 'Đăng ký ngay', 'Freeship', 'Tham gia thành viên ngay hôm nay để nhận ưu đãi đặc biệt - mã freeship giúp bạn tiết kiệm chi phí vận chuyển và có thể sử dụng trong 2 lần mua sắm. Đừng bỏ lỡ cơ hội tiện ích này, hãy đăng ký ngay để trải nghiệm mua sắm tiết kiệm và thuận lợi! ', '/register', 'Public/img/bannerfreeship.png', 1, 'Đăng ký ngay', 'Public/img/Untitled-1-01.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tổng hợp', '../assets/upload/Untitled5224.png', 'dsadw', 'Đang hoạt động', '2023-11-02 17:00:00', '2023-11-29 15:33:39'),
(2, 'Vòng cổ', '../assets/upload/Untitled231d.png', 'ds891273912sada2', 'Đang hoạt động', '2023-11-05 11:22:36', '2023-11-29 15:33:39'),
(3, 'Nhẫn', '../assets/upload/Untitled123.png', 'dadasd214r21gdfvbedw', 'Đang hoạt động', '2023-11-05 11:22:36', '2023-11-29 15:33:39'),
(12, 'Vòng tay', NULL, 'Vòng tay được thiết kế độc đáo', 'Đang hoạt động', '2024-01-30 22:09:32', '2024-01-30 22:09:32'),
(15, 'Bộ sưu tập mùa xuân', 'Public/Upload/img/sbxmxmk000155-bong-tai-bac-dinh-da-pnjsilver-4002 (2).png', 'Bộ sưu tập mùa xuân giành cho dẹp lễ tết', 'Đang hoạt động', '2024-02-01 01:17:56', '2024-02-01 01:17:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorites`
--

CREATE TABLE `favorites` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`) VALUES
(3, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `voucher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `total_amount`, `user_id`, `quantity`, `created_at`, `voucher`) VALUES
(8, 2070900000, 957452, 0, '2024-02-20 20:13:05', 'freeship'),
(9, 2070900000, 957452, 0, '2024-02-20 20:15:33', 'freeship');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_product` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_quantity` int(10) NOT NULL DEFAULT 123,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bestseller` int(50) NOT NULL,
  `product_like` int(50) NOT NULL,
  `product_new` int(1) NOT NULL COMMENT '0 là không , 1 là sản phẩm mới',
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `price`, `description`, `default_quantity`, `created_at`, `updated_at`, `bestseller`, `product_like`, `product_new`, `slug`) VALUES
(1, 'Vòng cổ mặt dây chuyền hoa hồng vàng 18K', 'Public/img/Mặt-Dây-Nữ-Vàng-18k-M292.png', 5000000, 'Vòng cổ mặt dây chuyền hoa hồng vàng 18K', 134, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 1, 0, 0, ''),
(2, 'Nhẫn cưới vàng 18K đính kim cương 2 carat', 'Public/img/nhan-cuoi-kim-cuong-vang-18k-pnj-1.png', 100000000, 'Nhẫn cưới vàng 18K đính kim cương 2 carat', 120, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 1, 0, ''),
(3, 'Bông tai vàng 18K đính đá sapphire', 'Public/Upload/img/mat-day-chuyen-bac-dinh-da-pnjsilver-hinh-thien-nga-01.png', 3000000, 'Bông tai vàng 18K đính đá sapphire', 120, '2023-11-05 11:17:37', '2024-02-01 00:58:36', 0, 0, 1, ''),
(4, 'Vòng tay vàng 18K đính đá ruby', 'Public/img/vong-tay-vang-18k-dinh-da-ruby-pnj-001.png', 1500000, '1', 122, '2023-11-05 11:17:37', '2023-12-03 08:26:04', 1, 0, 0, ''),
(5, 'Nhẫn vàng 18K đính đá citrine', 'Public/img/nhan-vang-18k-dinh-da-citrine-pnj-1.png', 7000000, 'Nhẫn vàng 18K đính đá citrine', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 1, 0, ''),
(6, 'Dây chuyền bạc 925 đính đá CZ', 'Public/img/day-chuyen-bac.png', 1500000, 'Dây chuyền bạc 925 được đính đá CZ vô cùng sang trọng , tôn vinh vẻ đẹp của người sở hữu', 10, '2023-11-05 11:17:37', '2024-02-16 17:03:01', 0, 0, 1, ''),
(7, 'Nhẫn bạc 925 đính đá CZ', 'Public/img/N2.0122-.png', 500000, 'Nhẫn bạc 925 đính đá CZ', 123, '2023-11-05 11:17:37', '2023-07-19 17:00:00', 1, 0, 0, ''),
(8, 'Bông tai bạc 925 đính đá', 'Public/img/bong-tai-bac-3.png', 1500000, 'Bông tai bạc 925 đính đá', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 1, 0, ''),
(9, 'Vòng tay bạc 925 trơn', 'Public/img/vong-bac.png', 1000000, 'Vòng tay bạc 925 trơn', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 1, ''),
(10, 'Nhẫn cưới bạc 925 đính đá CZ', 'Public/img/nhan-bac-3.png', 300000, 'Nhẫn cưới bạc 925 đính đá CZ', 123, '0000-00-00 00:00:00', '2023-07-19 17:00:00', 221, 100, 0, ''),
(11, 'Vòng cổ mặt dây chuyền hoa hồng vàng 18K', 'Public/img/Mặt-Dây-Nữ-Vàng-18k-M292.png', 5000000, 'Vòng cổ mặt dây chuyền hoa hồng vàng 18K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 240, 100, 0, ''),
(12, 'Nhẫn cưới vàng 18K đính kim cương 2 carat', 'Public/img/nhan-cuoi-kim-cuong-pnj-chung-doi-vang-18k.png', 100000000, 'Nhẫn cưới vàng 18K đính kim cương 2 carat', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 1, ''),
(13, 'Bông tai vàng 18K đính đá sapphire', 'Public/img/bong-tai-vang-2.png', 3000000, 'Bông tai vàng 18K đính đá sapphire', 123, '2023-07-20 05:00:00', '2024-01-26 22:17:39', 1, 0, 0, ''),
(14, 'Vòng tay vàng 18K đính đá ruby', 'Public/img/vong-tay-vang-dinh-kim-cuong.png', 2000000, '', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(15, 'Nhẫn vàng 18K đính đá citrine', 'Public/img/nhan-vang-18k-dinh-da-citrine-pnj-2.png', 7000000, 'Nhẫn vàng 18K đính đá citrine', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(16, 'Dây chuyền bạc 925 đính đá CZ', 'Public/img/day-chuyen-bac.png', 2000000, 'Dây chuyền bạc 925 đính đá CZ', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(17, 'Nhẫn bạc 925 đính đá CZ', 'Public/img/nhan-bac-dinh-da-pnjsilver-01.png', 500000, 'Nhẫn bạc 925 đính đá CZ', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(18, 'Bông tai bạc 925 đính đá', 'Public/img/bong-tai-bac-3.png', 1500000, 'Bông tai bạc 925 đính đá', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(20, 'Nhẫn cưới bạc 925 đính đá CZ', 'Public/img/nhan-bac-dinh-da-pnjsilver-01.png', 300000, 'Nhẫn cưới bạc 925 đính đá CZ', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(21, 'Dây chuyền vàng 18K đính kim cương 5 carat', 'Public/img/Mặt-Dây-Nữ-Vàng-18k-M292.png', 200000000, 'Dây chuyền vàng 18K đính kim cương 5 carat', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(22, 'Nhẫn Kim Cương Vàng 18K', 'Public/img/nhan-nu-trang-suc-kim-cuong-vang-trang-18K-DFH0114R-g1.png', 330000000, 'Nhẫn Kim Cương Vàng 18K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(24, 'Lắc tay vàng trắng 14K', 'Public/img/vong-tay-bac-2.png', 50000000, 'Lắc tay vàng trắng 14K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(25, 'Vòng tay Vàng 18K đính đá CZ ', 'Public/img/vong-tay-pnj-vang-18k-dinh-da-cz-02.png', 120000000, 'Vòng tay Vàng 18K đính đá CZ', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(26, 'Nhẫn Kim Tiền Vàng 18K', 'Public/img/day-chuyen-vang-dinh-kim-cuong.png', 200000000, 'Dây chuyền vàng 18K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(27, 'Dây chuyền vàng 18K đính kim cương 5 carat', 'Public/img/day-chuyen-vang-dinh-kim-cuong.png', 15000000, 'Nhẫn Kim Tiền Vàng 18K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(28, 'Nhẫn Cưới Vàng Trắng Kim Cương', 'Public/img/nhan-bac-2.png', 270000000, 'Nhẫn Cưới Vàng Trắng Kim Cương', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, ''),
(31, 'Vòng tay Kim cương Vàng trắng 18K', 'Public/img/vo-vong-tay-kim-cuong-vang-trang-18k-pnj-01.png', 1900000000, 'Vòng tay Kim cương Vàng trắng 18K', 123, '2023-07-20 05:00:00', '0000-00-00 00:00:00', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(1, 2, 3),
(3, 6, 1),
(4, 16, 2),
(5, 13, 1),
(6, 6, 1),
(7, 28, 1),
(9, 24, 1),
(10, 2, 1),
(11, 9, 1),
(12, 24, 1),
(13, 28, 1),
(14, 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size_id` int(10) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `quantity`, `price`) VALUES
(1, 1, 8, 20, 5520000),
(2, 2, 11, 20, 110000000),
(3, 3, 7, 20, 0),
(4, 1, 8, 20, 0),
(6, 3, 7, 20, 0),
(7, 4, 11, 20, 0),
(8, 5, 11, 20, 0),
(10, 7, 11, 20, 0),
(11, 8, 11, 20, 0),
(12, 9, 11, 20, 0),
(13, 9, 11, 0, 0),
(14, 10, 7, 0, 0),
(15, 11, 11, 0, 0),
(16, 12, 7, 0, 0),
(17, 13, 8, 0, 0),
(18, 14, 8, 0, 0),
(19, 15, 9, 0, 0),
(20, 16, 9, 0, 0),
(21, 17, 10, 0, 0),
(22, 18, 11, 0, 0),
(24, 20, 10, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(7, '10'),
(8, '11'),
(9, '12'),
(10, '13'),
(11, '14'),
(12, '15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `img`, `product_id`) VALUES
(1, 'Public/img/bong-tai-bac-3.png', 8),
(3, 'Public/img/bong-tai-bac-dinh-da-pnjsilver-4002.png', 8),
(4, 'Public/img/bong-tai-bac-2.png', 8),
(8, 'Public/img/nhan-cuoi-kim-cuong-pnj-chung-doi-vang-18k.png', 2),
(11, 'Public/ing/bong-tai-vang-2.png', 3),
(14, 'Public/img/vong-tay-vang-18k-dinh-da-ruby-pnj-001.png', 4),
(17, 'Publi/img/nhan-vang-18k-dinh-da-citrine-pnj-1.png', 5),
(18, 'Public/img/nhan-vang-18k-dinh-da-citrine-pnj-2.png', 5),
(20, 'Public/img/day-chuyen-bac.png', 6),
(23, 'Public/img/N2.0122-.png', 7),
(26, 'Public/img/vong-bac.png', 9),
(27, 'Public/img/vong-tay-bac.png', 9),
(28, 'Public/img/vong-tay-kieng-bac-tron.png', 9),
(29, 'Public/img/nhan-bac-3.png', 10),
(32, 'Public/img/Mặt-Dây-Nữ-Vàng-18k-M292.png', 11),
(35, 'Public/img/nhan-cuoi-kim-cuong-pnj-chung-doi-vang-18k.png', 12),
(38, 'Public/img/bong-tay-vang.png', 13),
(39, 'Public/img/vong-tay-vang-dinh-kim-cuong.png', 14),
(40, 'Public/img/nhan-vang-18k-dinh-da-citrine-pnj-2.png', 15),
(41, 'Public/img/day-chuyen-bac.png', 16),
(42, 'Public/img/nhan-bac-dinh-da-pnjsilver-01.png', 17),
(43, 'Public/img/bong-tai-bac-3.png', 18),
(44, 'Public/img/bong-tai-bac-dinh-da-pnjsilver-4002.png', 18),
(45, 'Public/img/nhan-bac-dinh-da-pnjsilver-01.png', 20),
(46, 'Public/img/Mặt-Dây-Nữ-Vàng-18k-M292.png', 21),
(47, 'Public/img/nhan-nu-trang-suc-kim-cuong-vang-trang-18K-DFH0114R-g1.png', 22),
(49, 'Public/img/vong-tay-bac-2.png', 24),
(50, 'Public/img/vong-tay-pnj-vang-18k-dinh-da-cz-02.png', 25),
(51, 'Public/img/day-chuyen-vang-dinh-kim-cuong.png', 26),
(52, 'Public/img/day-chuyen-vang-dinh-kim-cuong.png', 27),
(53, 'Public/img/nhan-bac-2.png', 28),
(54, 'Public/img/vo-vong-tay-kim-cuong-vang-trang-18k-pnj-01.png', 31),
(55, 'Public/img/default.png', NULL),
(56, 'Public/img/nhan-cuoi-kim-cuong-pnj-chung-doi-vang-18k.png', 2),
(57, 'Public/img/nhan-cuoi-kim-cuong-vang-18k-pnj-1.png', 2),
(58, 'Public/img/nhan-vang-18k-dinh-da-citrine-pnj-2.png', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `verify_code` int(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `avatar` varchar(255) NOT NULL DEFAULT 'Public/img/default.jpg',
  `phone` varchar(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `sex` set('Nam','Nữ','Chưa biết','') NOT NULL DEFAULT 'Chưa biết',
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `is_admin`, `verify_code`, `created_at`, `updated_at`, `avatar`, `phone`, `address`, `sex`, `slug`) VALUES
(1, 'Đinh Trọng Phúc', 'phuc1903@gmail.com', '89d0b14531aa7879fa397278524c696f', 1, 0, '2024-01-26 21:35:37', '2024-02-15 15:40:36', 'Public/img/pictureMy.jpg', '0377461482', 'Quan 12 , TP HCM', 'Nam', ''),
(957449, 'Phúc', 'phucdinh19@gmail.com', '', 0, 0, '2024-01-31 19:00:56', '2024-01-31 19:00:56', 'Public/img/default.jpg', '0377461482', 'Quận 12', 'Nam', ''),
(957451, 'aaa', 'khanhnguyenp689@gmail.com', '$2y$10$oU2/cHmw0.jvq94sEsOypeQTEYXsm0HDkqWN.OYJOtn3yS5tAU79y', 0, 0, '2024-01-31 19:15:14', '2024-01-31 19:15:14', 'Public/img/default.jpg', '', '', 'Chưa biết', ''),
(957452, 'Đinh Trọng Phúc', 'phuc@gmail.com', '$2y$10$D7iOP8hCXTyRv6hqbhLh/uXwemm434ZJLZfF/FP1ChTtppHoLDV7S', 1, 0, '2024-02-15 16:11:58', '2024-02-19 15:46:18', 'Public/img/default.jpg', '0377461482', 'Quận 12, TPHCM', 'Nam', 'dinh-trong-phuc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_voucher`
--

CREATE TABLE `user_voucher` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `voucher_id` int(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_voucher`
--

INSERT INTO `user_voucher` (`id`, `user_id`, `voucher_id`, `quantity`) VALUES
(2, 1, 1, 2),
(3, 957451, 1, 2),
(4, 957452, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_type` enum('percent','amount') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `discount_max` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 50,
  `user_count` int(11) NOT NULL,
  `day_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `day_end` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id`, `code`, `discount_type`, `discount_value`, `discount_max`, `quantity`, `user_count`, `day_start`, `day_end`) VALUES
(1, 'freeship', 'amount', 24000.00, 200000, 46, 2, '2024-01-27 18:11:20', '2024-02-28 18:11:20');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`product_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_voucher`
--
ALTER TABLE `user_voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vourcher_id` (`voucher_id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957453;

--
-- AUTO_INCREMENT cho bảng `user_voucher`
--
ALTER TABLE `user_voucher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Các ràng buộc cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Các ràng buộc cho bảng `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD CONSTRAINT `thumbnails_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `user_voucher`
--
ALTER TABLE `user_voucher`
  ADD CONSTRAINT `user_voucher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_voucher_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
