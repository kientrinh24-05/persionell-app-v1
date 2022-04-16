-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
<<<<<<< HEAD:shop (3).sql
-- Thời gian đã tạo: Th4 16, 2022 lúc 07:34 AM
=======
-- Thời gian đã tạo: Th4 15, 2022 lúc 05:41 PM
>>>>>>> 3437f096cd57084d47606e0fdeb456db3204d92d:shop.sql
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anhsanpham`
--

CREATE TABLE `anhsanpham` (
  `id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `anhsanpham`
--

INSERT INTO `anhsanpham` (`id`, `url`, `sanpham_id`, `created_at`, `updated_at`) VALUES
(3, '/public/uploads/images/5413-avatar-2.jpg', 8, '2022-02-09 04:25:50', NULL),
(4, '/public/uploads/images/3692-user_avatar-31-512.png', 8, '2022-02-09 04:25:50', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `id` int(11) NOT NULL,
  `tieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doantrich` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `noidung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `hinhanh` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`id`, `tieude`, `doantrich`, `noidung`, `danhmuc_id`, `hinhanh`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'bai viet 1', 'doan trich 1', 'noi dung 1', 2, '', 1, '2022-02-09 09:05:33', NULL),
(2, 'bai viet 1', '12341231', 'noi dung 1', 2, '', 1, '2022-02-09 09:06:14', NULL),
(3, 'bai viet 1', '1212', '21212', 2, '', 1, '2022-02-09 09:09:30', NULL),
(4, 'bai viet 1sadsad', '1212', '21212', 2, '/public/uploads/images/2392-avatar.jpeg', 1, '2022-02-09 09:37:12', NULL),
(6, 'bài viến demo', 'cỞ ví dụ này, bảng mẹ sanpham c\r\n\r\n', 'cỞ ví dụ này, bảng mẹ sanpham c', 2, '/public/uploads/images/2764-tải xuống.jpg', 1, '2022-04-16 05:15:45', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `donhang_id` int(11) NOT NULL,
  `soluongmua` int(11) NOT NULL,
  `dongia` double NOT NULL,
  `sale` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `sanpham_id`, `donhang_id`, `soluongmua`, `dongia`, `sale`, `created_at`, `updated_at`) VALUES
(3, 8, 7, 1, 500000, 5, '2022-02-09 07:15:15', NULL),
(4, 6, 7, 3, 20000, 5, '2022-02-09 07:15:15', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia_sanpham`
--

CREATE TABLE `danhgia_sanpham` (
  `id` int(11) NOT NULL,
  `danhgia` tinyint(4) NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc_blog`
--

CREATE TABLE `danhmuc_blog` (
  `id` int(11) NOT NULL,
  `tendanhmuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc_blog`
--

INSERT INTO `danhmuc_blog` (`id`, `tendanhmuc`, `mota`, `created_at`, `updated_at`) VALUES
(2, 'tin moi', 'well', '2022-02-09 05:48:52', NULL),
(3, ' trai tym', 'thoi gian', '2022-02-09 05:55:57', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `tongtien` double NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `tongtien`, `khachhang_id`, `trangthai`, `created_at`, `updated_at`) VALUES
(7, 560000, 7, 1, '2022-02-09 07:23:32', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id`, `hoten`, `phone`, `diachi`, `email`, `password`, `avatar`, `note`, `created_at`, `updated_at`) VALUES
(7, 'HUY', '0963174428', '321321', 'lexuanhuy4497@gmail.com', NULL, 'employee-avatar.png', '2121', '2022-02-09 07:22:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noidung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `hoten`, `email`, `phone`, `chude`, `noidung`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 'huy4', 'lexuanhuy4497@gmail.com', '0963174428', '2132', 'noi dung 1', 1, '2022-02-09 06:51:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `tennhanvien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `gioitinh` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sodienthoai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cccd` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maPB` int(11) NOT NULL,
  `Hesoluong` float NOT NULL,
  `trinhdo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chucvu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luutru` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD:shop (3).sql
--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `tennhanvien`, `ngaysinh`, `gioitinh`, `sodienthoai`, `diachi`, `cccd`, `maPB`, `Hesoluong`, `trinhdo`, `chucvu`, `luutru`) VALUES
(1, 'thao', '2022-04-07', 'nam', '0374236231', 'dương b hà nôi', '0123456789', 1, 2.5, 'tiến sĩ', 'kế tians', 0),
(2, 'thao tghi', '2000-12-12', 'nữ', '0374236231', 'đường a', '0123456789', 2, 2.5, 'đại học', 'kế toán', 0),
(3, 'huy', '1997-01-12', 'nam', '0379563562', 'đương bnmj', '0147852369', 2, 2.5, 'đại học', 'quản lý nhân sự', 0);

=======
>>>>>>> 3437f096cd57084d47606e0fdeb456db3204d92d:shop.sql
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `tenphongban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluongnv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD:shop (3).sql
--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`id`, `tenphongban`, `soluongnv`) VALUES
(1, 'kế toán', 5),
(2, 'Nhân sự', 4);

=======
>>>>>>> 3437f096cd57084d47606e0fdeb456db3204d92d:shop.sql
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `tensanpham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `giaban` double NOT NULL,
  `soluong` int(11) NOT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `sale` float NOT NULL,
  `hinhanh` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `danhgia` float NOT NULL,
  `luotmua` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `tensanpham`, `mota`, `giaban`, `soluong`, `danhmuc_id`, `sale`, `hinhanh`, `danhgia`, `luotmua`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'phi hanh gia 1', 'co ay ', 20000, 5, 2, 5, '/public/uploads/images/4165-avatar-2.jpg', 5, 0, 1, '2022-02-09 03:58:58', NULL),
(5, 'haha', '1212', 20000, 5, 2, 5, '/public/uploads/images/935-avatar.jpeg', 5, 0, 1, '2022-02-09 04:02:50', NULL),
(6, 'phi hanh gia', '12121', 20000, 100, 1, 5, '/public/uploads/images/5368-avatar.jpeg', 5, 0, 1, '2022-02-09 04:04:54', NULL),
(7, 'hi san pham mew', '1212', 120000, 100, 1, 5, '/public/uploads/images/1187-user_avatar-31-512.png', 5, 0, 1, '2022-02-09 04:05:36', NULL),
(8, 'nhieu anh', 'mo ta 2', 500000, 40, 2, 5, '/public/uploads/images/3216-user_avatar-31-512.png', 5, 0, 1, '2022-02-09 04:25:50', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the`
--

CREATE TABLE `the` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `thoigiantao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `the`
--

INSERT INTO `the` (`id`, `ten`, `mota`, `soluong`, `thoigiantao`) VALUES
(1, 'tag_demo1', 'mota dem 1', 0, '2022-04-07 02:53:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thesanpham`
--

CREATE TABLE `thesanpham` (
  `id` int(11) NOT NULL,
  `tenthe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mau` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thesanpham`
--

INSERT INTO `thesanpham` (`id`, `tenthe`, `mota`, `created_at`, `mau`) VALUES
(1, 'tag1', 'mota11\r\n', '2022-04-05 07:36:13', 'blue');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'avatar-default.jpg', '2022-02-08 16:28:34', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anhsanpham`
--
ALTER TABLE `anhsanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhgia_sanpham`
--
ALTER TABLE `danhgia_sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmuc_blog`
--
ALTER TABLE `danhmuc_blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maPB` (`maPB`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `the`
--
ALTER TABLE `the`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thesanpham`
--
ALTER TABLE `thesanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anhsanpham`
--
ALTER TABLE `anhsanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `danhgia_sanpham`
--
ALTER TABLE `danhgia_sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `danhmuc_blog`
--
ALTER TABLE `danhmuc_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
<<<<<<< HEAD:shop (3).sql
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 3437f096cd57084d47606e0fdeb456db3204d92d:shop.sql

--
-- AUTO_INCREMENT cho bảng `phongban`
--
ALTER TABLE `phongban`
<<<<<<< HEAD:shop (3).sql
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 3437f096cd57084d47606e0fdeb456db3204d92d:shop.sql

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `the`
--
ALTER TABLE `the`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `thesanpham`
--
ALTER TABLE `thesanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`maPB`) REFERENCES `phongban` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
