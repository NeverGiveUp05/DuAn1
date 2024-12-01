-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2024 at 09:39 AM
-- Server version: 5.7.44
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id` int(11) NOT NULL,
  `nguoi_dung_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `danh_gia` int(11) NOT NULL,
  `ngay_binh_luan` date NOT NULL,
  `trang_thai` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `binh_luan`
--

INSERT INTO `binh_luan` (`id`, `nguoi_dung_id`, `san_pham_id`, `noi_dung`, `danh_gia`, `ngay_binh_luan`, `trang_thai`) VALUES
(1, 4, 1, 'san pham tot', 4, '2024-11-20', b'1'),
(2, 2, 3, 'hay lam', 5, '2024-11-21', b'1'),
(3, 2, 1, 'hayyyyyyy', 5, '2024-11-25', b'1'),
(4, 2, 1, 'chat luong cao', 5, '2024-11-28', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `giam_gia`
--

CREATE TABLE `giam_gia` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `phan_tram_giam` decimal(10,2) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int(11) NOT NULL,
  `nguoi_dung_id` int(11) NOT NULL,
  `trang_thai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_tao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang_chi_tiet`
--

CREATE TABLE `gio_hang_chi_tiet` (
  `id` int(11) NOT NULL,
  `gio_hang_id` int(11) NOT NULL,
  `san_pham_chi_tiet_id` int(11) NOT NULL,
  `so_luong` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(11) NOT NULL,
  `nguoi_dung_id` int(11) NOT NULL,
  `tong_tien` int(255) NOT NULL,
  `ngay_tao` date NOT NULL,
  `doanh_thu` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `nguoi_dung_id`, `tong_tien`, `ngay_tao`, `doanh_thu`) VALUES
(1, 4, 2000000, '2024-11-19', NULL),
(2, 5, 600000, '2024-12-01', 600000),
(3, 2, 2000000, '2024-12-17', 2000000),
(4, 5, 1200000, '2024-11-28', 1200000),
(5, 2, 3000000, '2024-11-22', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don_chi_tiet`
--

CREATE TABLE `hoa_don_chi_tiet` (
  `id` int(11) NOT NULL,
  `hoa_don_id` int(11) NOT NULL,
  `san_pham_chi_tiet_id` int(11) NOT NULL,
  `so_luong` int(255) NOT NULL,
  `gia` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hoa_don_chi_tiet`
--

INSERT INTO `hoa_don_chi_tiet` (`id`, `hoa_don_id`, `san_pham_chi_tiet_id`, `so_luong`, `gia`) VALUES
(1, 1, 1, 10, 200000),
(2, 2, 2, 2, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `lich_su_hoa_don`
--

CREATE TABLE `lich_su_hoa_don` (
  `id` int(11) NOT NULL,
  `hoa_don_id` int(11) NOT NULL,
  `trang_thai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci,
  `thoi_gian` datetime NOT NULL,
  `nguoi_sua_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lich_su_hoa_don`
--

INSERT INTO `lich_su_hoa_don` (`id`, `hoa_don_id`, `trang_thai`, `ghi_chu`, `thoi_gian`, `nguoi_sua_id`) VALUES
(1, 1, 'Pending', NULL, '2024-11-20 00:00:00', 1),
(2, 1, 'Confirmed', NULL, '2024-11-21 00:00:00', 1),
(4, 1, 'Processing', 'oke', '2024-12-01 00:20:18', 1),
(5, 1, 'Shipped', NULL, '2024-12-01 00:20:52', 1),
(6, 1, 'Delivered', NULL, '2024-12-01 00:22:25', 1),
(7, 2, 'Pending', NULL, '2024-12-01 07:33:14', 1),
(8, 1, 'Delivered', NULL, '2024-12-01 10:24:30', 1),
(9, 1, 'Returned', 'khách trả lại', '2024-12-01 12:03:54', 1),
(11, 2, 'Processing', NULL, '2024-12-01 12:16:10', 1),
(12, 2, 'Completed', NULL, '2024-12-01 12:16:32', 1),
(13, 1, 'Canceled', NULL, '2024-12-01 12:18:12', 1),
(14, 3, 'Completed', NULL, '2024-12-01 06:03:48', 1),
(15, 4, 'Completed', NULL, '2024-11-30 13:08:49', 1),
(16, 5, 'Completed', NULL, '2024-12-01 06:14:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loai_hang`
--

CREATE TABLE `loai_hang` (
  `id` int(11) NOT NULL,
  `ten_loai_hang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loai_hang`
--

INSERT INTO `loai_hang` (`id`, `ten_loai_hang`) VALUES
(1, 'IVY moda'),
(2, 'IVY men'),
(3, 'IVY kids');

-- --------------------------------------------------------

--
-- Table structure for table `mau_sac`
--

CREATE TABLE `mau_sac` (
  `id` int(11) NOT NULL,
  `ten_mau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mau` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mau_sac`
--

INSERT INTO `mau_sac` (`id`, `ten_mau`, `ma_mau`) VALUES
(1, 'Trắng', '#fff');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung_sp_yeuthich`
--

CREATE TABLE `nguoidung_sp_yeuthich` (
  `id` int(11) NOT NULL,
  `nguoi_dung_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` text COLLATE utf8mb4_unicode_ci,
  `dia_chi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioi_tinh` bit(1) NOT NULL,
  `quyen_id` int(11) NOT NULL,
  `trang_thai` bit(1) NOT NULL,
  `ngay_tao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `email`, `mat_khau`, `so_dien_thoai`, `ten`, `hinh_anh`, `dia_chi`, `gioi_tinh`, `quyen_id`, `trang_thai`, `ngay_tao`) VALUES
(1, 'admin@gmail.com', '123', '0988123456', 'Nguyen Van A', NULL, 'Hà Nội', b'1', 1, b'1', '2024-11-15'),
(2, 'taconga12@gmail.com', '123', '00000', 'Dabi', NULL, 'HCM', b'1', 2, b'1', '2024-11-21'),
(3, 'hello@gmail.com', '123', '0968123456', 'Hiii', NULL, 'Binh Thuan', b'0', 3, b'1', '2024-11-28'),
(4, 'hi@gmail.com', '123', '0972965888', 'Nguyễn Thị B', NULL, 'Ha Noi', b'0', 3, b'0', '2024-11-12'),
(5, 'client@gmail.com', '123', '0988123888', 'Ly Mui Pu', '', 'Hà Nội', b'0', 3, b'1', '2024-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `id` int(11) NOT NULL,
  `ten_quyen` enum('quan_tri','nhan_vien','khach_hang') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`id`, `ten_quyen`) VALUES
(1, 'quan_tri'),
(2, 'nhan_vien'),
(3, 'khach_hang');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id` int(11) NOT NULL,
  `loai_hang_id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh_chi_tiet_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh_chi_tiet_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh_chi_tiet_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_nhap` int(255) NOT NULL,
  `gia_ban` int(255) NOT NULL,
  `ngay_nhap_kho` date NOT NULL,
  `so_luong_nhap` int(255) NOT NULL,
  `so_luong_ban` int(255) NOT NULL,
  `so_luot_xem` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `loai_hang_id`, `ten_san_pham`, `mo_ta`, `hinh_anh`, `hinh_anh_chi_tiet_1`, `hinh_anh_chi_tiet_2`, `hinh_anh_chi_tiet_3`, `gia_nhap`, `gia_ban`, `ngay_nhap_kho`, `so_luong_nhap`, `so_luong_ban`, `so_luot_xem`) VALUES
(1, 1, 'Camellia Midi - Đầm Lụa Phối Hoa', 'hi', 'http://localhost/DuAn/public/images/image2.1.webp', 'http://localhost/DuAn/public/images/image2.2.webp', 'http://localhost/DuAn/public/images/image2.3.webp', 'http://localhost/DuAn/public/images/image2.4.webp', 100000, 200000, '2024-11-20', 50, 15, 9),
(2, 1, 'Đầm Cổ Chéo Xếp Ly', 'hiii', 'http://localhost/DuAn/public/images/image3.1.webp', 'http://localhost/DuAn/public/images/image3.2.webp', 'http://localhost/DuAn/public/images/image3.3.webp', 'http://localhost/DuAn/public/images/image3.4.webp', 200000, 300000, '2024-11-14', 100, 20, 67),
(3, 2, 'Áo Thun Regular In Hình', 'san pham tot', 'http://localhost/DuAn/public/images/1721052778nam1.1.webp', 'http://localhost/DuAn/public/images/1721052778nam1.2.webp', 'http://localhost/DuAn/public/images/1721052778nam1.3.webp', 'http://localhost/DuAn/public/images/1721052778nam1.4.webp\r\n', 120000, 200000, '2024-11-22', 100, 50, 41);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham_chi_tiet`
--

CREATE TABLE `san_pham_chi_tiet` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `mau_sac_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `so_luong` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `san_pham_chi_tiet`
--

INSERT INTO `san_pham_chi_tiet` (`id`, `san_pham_id`, `mau_sac_id`, `size_id`, `so_luong`) VALUES
(1, 1, 1, 2, 100),
(2, 2, 1, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `ten_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `ten_size`) VALUES
(1, 'L'),
(2, 'M'),
(3, 'S');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `giam_gia`
--
ALTER TABLE `giam_gia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `gio_hang_chi_tiet`
--
ALTER TABLE `gio_hang_chi_tiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_chi_tiet_id` (`san_pham_chi_tiet_id`),
  ADD KEY `gio_hang_id` (`gio_hang_id`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `hoa_don_chi_tiet`
--
ALTER TABLE `hoa_don_chi_tiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoa_don_id` (`hoa_don_id`),
  ADD KEY `san_pham_chi_tiet_id` (`san_pham_chi_tiet_id`);

--
-- Indexes for table `lich_su_hoa_don`
--
ALTER TABLE `lich_su_hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoa_don_id` (`hoa_don_id`),
  ADD KEY `nguoi_sua_id` (`nguoi_sua_id`);

--
-- Indexes for table `loai_hang`
--
ALTER TABLE `loai_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mau_sac`
--
ALTER TABLE `mau_sac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nguoidung_sp_yeuthich`
--
ALTER TABLE `nguoidung_sp_yeuthich`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quyen_id` (`quyen_id`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loai_hang_id` (`loai_hang_id`);

--
-- Indexes for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mau_sac_id` (`mau_sac_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `giam_gia`
--
ALTER TABLE `giam_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hang_chi_tiet`
--
ALTER TABLE `gio_hang_chi_tiet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hoa_don_chi_tiet`
--
ALTER TABLE `hoa_don_chi_tiet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lich_su_hoa_don`
--
ALTER TABLE `lich_su_hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `loai_hang`
--
ALTER TABLE `loai_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mau_sac`
--
ALTER TABLE `mau_sac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nguoidung_sp_yeuthich`
--
ALTER TABLE `nguoidung_sp_yeuthich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);

--
-- Constraints for table `giam_gia`
--
ALTER TABLE `giam_gia`
  ADD CONSTRAINT `giam_gia_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `gio_hang_chi_tiet`
--
ALTER TABLE `gio_hang_chi_tiet`
  ADD CONSTRAINT `gio_hang_chi_tiet_ibfk_1` FOREIGN KEY (`san_pham_chi_tiet_id`) REFERENCES `san_pham_chi_tiet` (`id`),
  ADD CONSTRAINT `gio_hang_chi_tiet_ibfk_2` FOREIGN KEY (`gio_hang_id`) REFERENCES `gio_hang` (`id`);

--
-- Constraints for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `hoa_don_chi_tiet`
--
ALTER TABLE `hoa_don_chi_tiet`
  ADD CONSTRAINT `hoa_don_chi_tiet_ibfk_1` FOREIGN KEY (`hoa_don_id`) REFERENCES `hoa_don` (`id`),
  ADD CONSTRAINT `hoa_don_chi_tiet_ibfk_2` FOREIGN KEY (`san_pham_chi_tiet_id`) REFERENCES `san_pham_chi_tiet` (`id`);

--
-- Constraints for table `lich_su_hoa_don`
--
ALTER TABLE `lich_su_hoa_don`
  ADD CONSTRAINT `lich_su_hoa_don_ibfk_1` FOREIGN KEY (`hoa_don_id`) REFERENCES `hoa_don` (`id`),
  ADD CONSTRAINT `lich_su_hoa_don_ibfk_2` FOREIGN KEY (`nguoi_sua_id`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `nguoidung_sp_yeuthich`
--
ALTER TABLE `nguoidung_sp_yeuthich`
  ADD CONSTRAINT `nguoidung_sp_yeuthich_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `nguoidung_sp_yeuthich_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);

--
-- Constraints for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD CONSTRAINT `nguoi_dung_ibfk_1` FOREIGN KEY (`quyen_id`) REFERENCES `quyen` (`id`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`loai_hang_id`) REFERENCES `loai_hang` (`id`);

--
-- Constraints for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  ADD CONSTRAINT `san_pham_chi_tiet_ibfk_1` FOREIGN KEY (`mau_sac_id`) REFERENCES `mau_sac` (`id`),
  ADD CONSTRAINT `san_pham_chi_tiet_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `san_pham_chi_tiet_ibfk_3` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
