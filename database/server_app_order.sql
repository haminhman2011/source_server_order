-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 08:37 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `server_app_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT '1',
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `created_date` int(11) UNSIGNED NOT NULL,
  `modified_date` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_food`
--

CREATE TABLE `detail_order_food` (
  `id` int(11) NOT NULL,
  `order_food_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detail_order_food`
--

INSERT INTO `detail_order_food` (`id`, `order_food_id`, `product_id`, `quantity`, `created_by`, `modified_by`, `created_date`, `modified_date`, `status`) VALUES
(1, 1, 1, 1, 1, 1, 1508827946, 1508827946, -1),
(2, 1, 2, 2, 1, 1, 1508827946, 1508827946, -1),
(3, 1, 1, 1, 1, 1, 1508834285, 1508834285, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imme_device`
--

CREATE TABLE `imme_device` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `system` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `imei` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt',
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL,
  `created_date` int(11) UNSIGNED NOT NULL,
  `modified_date` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imme_device`
--

INSERT INTO `imme_device` (`id`, `name`, `system`, `imei`, `ip`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 'Android SDK built for x86', 'sdk_google_phone_x86', '000000000000000', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(2, 'Android 2', 'sdk_google_phone_x86', '000000000000001', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(3, 'Android 3', 'sdk_google_phone_x86', '000000000000002', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(4, 'Android 4', 'sdk_google_phone_x86', '000000000000003', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(5, 'Android 5', 'sdk_google_phone_x86', '000000000000004', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(6, 'Android 6', 'sdk_google_phone_x86', '000000000000005', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(7, 'Android 7', 'sdk_google_phone_x86', '000000000000006', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(8, 'Android 8', 'sdk_google_phone_x86', '000000000000007', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(9, 'Android 9', 'sdk_google_phone_x86', '000000000000008', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781),
(10, 'Android 10', 'sdk_google_phone_x86', '000000000000009', '10.0.0.2', 1, 1, 1, 1506069781, 1506069781);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module_child`
--

CREATE TABLE `module_child` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `role` text,
  `module_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_food`
--

CREATE TABLE `order_food` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tables_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info_order` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_date_order` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_food`
--

INSERT INTO `order_food` (`id`, `full_name`, `phone`, `tables_id`, `created_by`, `modified_by`, `created_date`, `modified_date`, `email`, `info_order`, `note`, `created_date_order`, `status`) VALUES
(1, 'Ha minh man1', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1508988360, 1),
(2, 'Ha minh man2', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1508901960, 1),
(3, 'Ha minh man3', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1508815560, 1),
(4, 'Ha minh man4', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1508991960, 1),
(5, 'Ha minh man5', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1509085560, 1),
(6, 'Ha minh man6', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1509179160, 1),
(7, 'Ha minh man7', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1509269160, 1),
(8, 'Ha minh man8', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1509359160, 1),
(9, 'Ha minh man9', '01685524224', 1, 1, 1, 1508827945, 1508834285, 'man@gmail.com', 'dat hang qua dien thoai', '', 1509542760, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_food_log`
--

CREATE TABLE `order_food_log` (
  `id` int(11) NOT NULL,
  `order_food_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_quantity` double(50,0) DEFAULT NULL,
  `total_price` double(50,0) DEFAULT NULL,
  `tables_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `product_type_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt',
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_by` int(11) UNSIGNED NOT NULL,
  `created_date` int(11) UNSIGNED NOT NULL,
  `modified_date` int(11) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `note`, `product_type_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`, `code`) VALUES
(1, 'Súp Bóng Cá Cua', '50000', 'sup_bong_bong_ca.jpg', 'Trong bóng cá có chứa rất nhiều phân tử collagen có tác dụng làm chậm quá trình lão hoá và giúp da căng mịn, sáng đẹp đó.', 1, 1, 1, 1, 1505986583, 1505986583, 'MA001'),
(2, 'Súp Rong Biển Hải Sâm', '80000', 'sup_cua_hai_sam.png', 'Hải sâm là thực phẩm rất tốt cho sức khỏe. Hải sâm thường dùng ngâm rượu, làm thuốc hay các món ăn hấp dẫn. Tuy nhiên, nếu không biết cách sơ chế, bạn sẽ làm mất chất dinh dưỡng của món ăn này.', 1, 1, 1, 1, 1505986746, 1505986746, 'MA002'),
(3, 'Súp Trúc Xinh Hải Sản', '225000', 'sup_truc_xinh_hai_san.png', 'Súp Hải Sản có thành phần chính là hải sản, nguyên liệu tươi ngon và bổ dưỡng rất thích hợp với mọi lứa tuổi người dùng.', 1, 1, 1, 1, 1505986958, 1505986958, 'MA003'),
(4, ' Chả giò Triều Châu', '100000', 'chagioTrieuChau.png', 'Ẩm thực Trung Hoa luôn độc đáo và hấp dẫn bởi được phối trộn theo yêu cầu của việc ăn uống, thích hợp với tính chất của từng loại thực phẩm được dùng, khiến cho món ăn không những ngon mà còn có tác dụng bổ dưỡng.', 1, 1, 1, 1, 1505987314, 1505987314, 'MA004'),
(5, 'Gỏi củ hủ dừa tôm càng', '150000', 'goi_cu_dua_tom_cang.png', 'Gỏi Củ Hũ Dừa là phần thân non rất trắng trên cùng của cây dừa. Đây là loại thực phẩm giàu dinh dưỡng và tốt cho sức khỏe. Củ hũ dừa được chế biến ra các món ăn thơm ngon như xào với thơm (dứa), ngâm xổi, canh nấu thịt, củ hũ dừa tôm thịt hoặc bóp gỏi.', 1, 1, 1, 1, 1505989896, 1505989896, 'MA005'),
(6, 'Gỏi ba miền', '100000', 'goi_ba_mien.png', 'Với sự kết hợp hài hòa thú vị giữa các nguyên liệu và nước chấm đặc trưng, món cuốn từ lâu đã có một vị trí quan trọng trong nền ẩm thực Việt Nam. Cùng xem những biến tấu thú vị của món ăn này khắp ba miền, mỗi biến tấu lại có những đặc sắc riêng khó chối từ.', 1, 1, 1, 1, 1505989994, 1505989994, 'MA006'),
(7, 'Gỏi hải sản', '200000', 'goi_hai_san.jpg', 'Món gỏi hải sản tôm mực này có đủ màu sắc của rau củ và hải sản rất bắt mắt. Vị  chua chua, cay cay, ngọt ngọt hòa đều rất dễ ăn. Bạn có thể ăn kèm với bánh đa nướng hoặc phồng tôm. Đây được coi là món ăn thường xuyên vào ngày hè của gia đình mình.', 1, 1, 1, 1, 1506045330, 1506045330, 'MA008'),
(8, 'Thú linh chiên giòn', '100000', 'thu_linh_chien_gion.png', 'Món ăn này các bạn hãy ăn nóng cùng với cơm. Với vị giòn thơm ngon của các gia vị sẽ giúp cho bữa ăn gia đình của bạn trở nên thơm ngon và hấp dẫn hơn. Một món ăn khá độc đáo và thơm ngon. ', 1, 1, 1, 1, 1506045678, 1506045678, 'MA009'),
(9, 'Mực nướng muối ớt', '250000', 'muc_nuong_muoi_ot.png', 'Món ăn đậm đà hương vị biển, được rất nhiều thượng khách yêu thích bởi sự dai, dòn và thơm của mực.', 2, 1, 1, 1, 1506046590, 1506046590, 'HS001'),
(10, 'Mực chiến nước mấm', '250000', 'muc_chien_nuoc_mam.png', 'Mực chiên nước mắm là một món ăn tuy cách chế biến đơn giản nhưng lại mang đến cho người ăn một khẩu vị thật khác khi dùng chúng. Vị ngọt và giòn của mực hòa cùng vị mặn của nước mắm khiến ta ăn một miếng lại muốn dùng thêm một miếng. Mực chiên nước mắm vừa là món nhậu vừa là một món ăn hằng ngày.', 2, 1, 1, 1, 1506046913, 1506046913, 'HS002'),
(11, 'Mức ống hập gừng', '119000', 'muc_ong_hap_gung.png', 'Món mực hấp chắc hẳn không còn xa lạ gì đối với người thưởng thức ẩm thực, bởi đây không chỉ là món ăn ngon, hấp dẫn mà còn rất tốt cho sức khỏe', 2, 1, 1, 1, 1506047169, 1506047169, 'HS003'),
(12, 'Cua cốm miến tay cầm Hong Kong', '600000', 'cua_gom.png', '- Cua Cốm hay còn gọi là Cua hai da, là cua đang trong quá trình lột xác để lớn lên, chuẩn bị thành cua lột.\r\n- Điểm đặc biệt của Cua Cốm: Trong tất cả các giai đoạn phát triển của con cua, giai đoạn cốm (khoảng vài ngày trước khi lột) là giai đoạn mà cua chắc thịt và ngon nhất, nhiều chất dinh dưỡng nhất. Phần vỏ non mềm, bùi, có lớp da non bên trong. Thịt rất ngọt và chắc. Gạch của con cua cốm rất béo và bùi, không bị cứng và ăn dễ gây ngán như ở con cua gạch.', 2, 1, 1, 1, 1506047827, 1506047827, 'HS004'),
(13, 'Cua Gạch', '500000', 'cua_gach.png', ' Cua cái sau khi giao phối sẽ từ từ xuất hiện gạch trong khoang bụng, từ ít tới nhiều.\r\n- Để phân biệt được, ta dùng ngón tay, mũi dao thái lan, đầu nhỏ của cây muỗng, ... mở khe nối giữa khoang bụng và mu cua (nằm sau lưng cua), để cua nằm ngữa và chắc chắn là cua đã bị trói cẩn thận không còn khả năng kẹp, vì cách làm này sẽ làm cho cua đau nên sẽ động dậy mạnh), ta sẽ thấy hai hình tam giác nhỏ xíu, nếu là màu cam (hoặc đỏ đầy đặn thì đó là Cua Gạch son thương phẩm), nếu chỉ một bên màu cam còn bên kia còn màu tối thì cua chỉ mới lên gạch nửa bên mu thôi.', 2, 1, 1, 1, 1506048145, 1506048145, 'HS005'),
(14, 'Cua thịt', '400000', 'cua_thit.png', '- Cua Cà Mau chính gốc được lựa chọn cẩn thận.\r\n- Cua được bắt và chuyển ngay đến tay khách hàng, không để qua nhiều ngày (hiện tượng gây mất thịt của cua).\r\n- Cua được mua lại từ những nông dân, không qua thương lái nên đảm bảo giá tốt nhất cho khách hàng.', 2, 1, 1, 1, 1506049539, 1506049539, 'HS007'),
(15, 'Tôm hùm Sashimi', '1000000', 'tom_hum_Sashimi.png', 'Tôm hùm Sashimi là một món ăn vừa ngon miệng lại không hề có cảm giác ngấy. Với vị ngọt tự nhiên từ thịt tôm hùm kết hợp với vị thanh của một số loại rau củ quả xen lẫn gia vị tổng hợp chua chua, cay cay,… sẽ khiến bạn muốn ăn mãi không thôi. Cách làm tôm hùm Sashimi cũng khá đơn giản, quan trọng là bạn phải biết kết hợp hài hòa giữa các nguyên liệu và nêm nếm gia vị vừa phải để phù hợp với khẩu vị của từng người.', 2, 1, 1, 1, 1506049680, 1506049680, 'HS008'),
(16, 'Tôm hùm bỏ lò phomai', '1000000', 'tom_hum_phomai.png', 'Tôm hùm khi kết hợp cùng pho mai Mozzarella hảo hạng sẽ tạo nên món Tôm hùm bỏ lò phô mai tuyệt hảo. Sau khi cắt tiết,  tôm được gập sống lưng, co mình để đẩy dòng gạch son (tiết tôm hùm) ra khỏi cơ thể, khiến các sợi cơ của thịt tôm được săn hơn, bện chặt chẽ vào nhau, làm vị thịt tôm hùm ngọt sâu hơn. Ngay lúc ấy, thịt tôm hùm sẽ được đem sơ chế trong môi trường nhiệt độ dưới 20 độ C để giữ trọn hương vị tươi ngon của thịt tôm. Kế đó mới đem bỏ lò phô mai. Lớp phô mai Mozzarella sánh mịn, mềm mại, phủ đều bên ngoài cuộn thịt tôm săn chắc khiến thịt tôm đậm đà, ngậy nhưng không béo. Đẳng cấp của tôm hùm nướng phô mai mà những chuyên gia ẩm thực nổi tiếng nhất cũng mong được thưởng thức chính là như vậy.', 2, 1, 1, 1, 1506049753, 1506049753, 'HS009'),
(17, 'Tiết canh tôm hùm', '1500000', 'tom_hum_tiet_canh.png', 'Những con tôm hùm còn tươi đang bơi sẽ được các đầu bếp dùng dụng cụ chuyên dụng để chích nhẹ vào phần mặt dưới, nơi tiếp xúc giữa mình và đầu để lấy tiết. Sau đó đợi tiết đông là có thể thưởng thức được. Vị ngọt tươi thơm mát của tiết tôm hùm chắc chắn sẽ khiến bạn có những trải nghiệm rất thú vị.', 2, 1, 1, 1, 1506049855, 1506049855, 'HS010'),
(18, 'Tôm hùm nướng mọi', '2000000', 'tom_hum_nuong_moi.png', 'Tôm hùm nướng mọi là một món nhậu khoái khẩu của các đấng mày râu. Với chút cay cay của ớt, vị thơm nồng đượm của tỏi, sả băm nhỏ quyện đều trên mình tôm kết hợp với độ giòn của thịt tôm nướng nóng sẽ làm cho món ăn trở nên thú vị, cuốn hút đến lạ thường.  Se lạnh một chút mà được ngồi nhâm nhi ăn món tôm hùm nướng mọi với bạn bè thì quả thật là tuyệt vời', 2, 1, 1, 1, 1506049972, 1506049972, 'HS011'),
(19, 'Tôm hùm nấu lẩu', '1800000', 'tom_hum_nau_lau.png', 'Những con tôm hùm tươi ngon nhất được lựa chọn sau đó sẽ được tách bóc vỏ và đầu để làm cho nồi nước dùng thêm ngọt. Còn phần thịt tôm bên trong sẽ cho vào nhúng sau. Vị ngọt của thịt tôm ăn ghém kèm với các loại rau thanh mát sẽ là một món ăn vô cùng hấp dẫn. Trong quá trình thưởng thức món lẩu tôm hùm, các bạn nên chú ý đến thời gian nhúng nõn tôm, không nên nhúng lâu quá nhưng thế tôm sẽ bị dai và không còn giữ được hương vị thơm ngọt tự nhiên nữa.', 6, 1, 1, 1, 1506050060, 1506050060, 'ML001'),
(20, 'Lẩu cua nấu Thái', '300000', 'cua_nau_lau_thai.png', '- Nồi lẩu có sắc đỏ bắt mắt từ nước dùng và mai cua biển, cùng vị thơm nồng đặc trưng, mang đến nhiều trải nghiệm thú vị khi thưởng thức.\r\n- Lẩu cua biển nấu Thái - món ngon níu chân thực khách.', 6, 1, 1, 1, 1506050454, 1506050454, 'ML002'),
(21, 'Lẩu cua nấu bầu', '229000', 'cua_nau_lau_bau.png', '- Lẩu cua biển nấu bầu là món ăn được ưa chuộng nhất. Vị đặc trưng của Cua hòa cùng vị ngọt thanh thanh của bầu càng làm món ăn thêm hấp dẫn.\r\n\r\n- Những chú Cua gạch son, thịt chắc làm cho nước lẩu ngọt tự nhiên nên ăn không ngán.', 6, 1, 1, 1, 1506050547, 1506050547, 'ML003'),
(22, 'Cá thác lát chiên giòn', '90000', 'ca_tl_chien_gion.png', 'Thác lác nguyên con được ướp với xả và chiên giòn tạo ra món ăn có hương vị thơm ngon, giòn ngọt với vị dai rất hấp dẫn.', 3, 1, 1, 1, 1506050821, 1506050821, 'MC001'),
(23, 'Cá thác lác chiên cốm', '50000', 'ca_thac_lac_chien_com.png', 'Món chả cá thác lác chiên cốm thơm lừng vị cốm, khi ăn cảm nhận đầu tiên là vị giòn giòn của cốm bên ngoài, dẻo dai ngòn ngọt của thịt cá bên trong. Món chả cá thác lác chiên cốm chắc chắn sẽ làm hài lòng gia đình bạn đó vậy thì còn chờ gì nữa mà không đưa món ăn đơn giản dễ chế biến này vào thực đơn gia đình bạn ngay hôm nay nhỉ. Khi ăn bạn có thể chấm kèm chút tương ớt nhé', 3, 1, 1, 1, 1506050967, 1506050967, 'MC002'),
(24, 'Cá mao ếch sống nước muối ớt', '500000', 'ca_ao_ech_song_nuong_muoi_ot.png', 'Cá mao ếch ở đây được làm sạch, tẩm ướp, nêm nếm gia vị đầy đủ trước khi chế biến. Món cá mao ếch nướng muối ớt. Kết hợp cùng một ít rau răm, rau mống, bắp chuối, cà chua, thơm cùng một ít mắm càng làm cho mùi vị của món thêm phần đậm đà hơn. Khi chín, da của cá mao ếch nứt lộ ra phần thịt trắng nõn. Khi ăn, cá có vị rất dai và ngọt. Nhìn món cá hấp dẫn được bày lên bàn ăn, bạn chỉ muốn thưởng thức ngay.', 3, 1, 1, 1, 1506051393, 1506051393, 'MC003'),
(25, 'Heo rừng nướng giả cầy', '400000', 'lon_rung_nuong_gia_cay.png', 'Lợn rừng vốn chịu sự đào thải khắc nghiệt của tự nhiên, cùng với việc phải vận động liên tục và được hấp thụ những chất bổ dưỡng từ nguồn thức ăn là cây cỏ tự nhiên nên thịt lợn rừng có hương vị thơm ngon, thịt gần như không có mỡ, da dày, giòn, hàm lượng cholesteron thấp và giá trị dinh dưỡng mà thịt lợn rừng mang lại khá cao và hiển nhiên đây luôn là món ăn mà đông đảo người dùng không muốn bỏ qua.', 4, 1, 1, 1, 1506051745, 1506051745, 'MSR001'),
(26, 'KHÔ BÒ CAMPUCHIA', '250000', 'kho_bo_campuchia.png', 'Khô bò hay thịt bò khô là thịt bò lọc bỏ mỡ, đem ướp gia vị mặn ngọt rồi sấy khô ở nhiệt độ thấp (khoảng 70 °C). Thịt này đôi khi được đem muối hoặc phơi nắng. Kết quả là một loại thức ăn chơi có thể giữ lâu ngày mà không cần cất tủ đá hay tủ lạnh.', 5, 1, 1, 1, 1506063694, 1506063694, 'TAN001'),
(27, 'Bò lúc lắc khoai tây', '300000', 'bo_luc_lac_khoai_tay.png', 'Thịt bò lúc lắc luôn là một món khoái khẩu của nhiều người, do miếng bò được xào chín tới rất mềm và mọng, ngấm gia vị ướp đậm đà, ăn kèm với các loại rau củ và phần sốt rất đưa cơm', 5, 1, 1, 1, 1506063877, 1506063877, 'TAN002'),
(28, 'Heniken Pháp(chai)', '50000', 'ken_chai_phap.jpg', 'Bia Heineken chai 250ml - thùng 20 chai,  được nhập khẩu từ Pháp.                                                          Chất lượng thượng hạng , Hương vị tuyệt hảo và độc đáo . Bia Heineken từ lâu đã là lựa chọn số 1 của những người yêu bia tại Việt nam ', 7, 1, 1, 1, 1506064117, 1506064117, 'DU001'),
(29, 'Bia Heineken lon 500ml', '20000', 'ken_lon.png', 'Bia Heineken lon 500ml - thùng 24 lon, được nhập khẩu từ Hà Lan.                                                          Chất lượng thượng hạng , Hương vị tuyệt hảo và độc đáo . Bia Heineken từ lâu đã là lựa chọn số 1 của những người yêu bia tại Việt nam                                                                                         ', 7, 1, 1, 1, 1506064232, 1506064232, 'DU002'),
(30, 'Coca Cola Nhật chai nhôm nắp vặn 300ml', '33000', 'cocacola_nhat.png', 'Coca Cola dạng chai nhôm nội địa Nhật Bản thích hợp mọi lúc mọi nơi đặc biệt cho những chuyến Picnic hoặc mang đến công sở để thưởng thức. Do được thiết kế dạng chai và nắp bằng nhôm nên có thể tái sử dụng nhiều lần ( bỏ nước vào tủ lạnh rất nhanh lạnh). Nắp có thể đóng mở dễ dàng, tránh trường hợp rơi hay nghiêng.', 7, 1, 1, 1, 1506064364, 1506064364, 'DU003');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `image`, `created_by`, `modified_by`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Các món khai vị', 'menu_food.png', 1, 1, 1505984469, 1505984469, 1),
(2, 'Hải sản', 'menu_food.png', 1, 1, 1505984504, 1505984504, 1),
(3, 'Các món cá', 'menu_food.png', 1, 1, 1505984519, 1505984519, 1),
(4, 'Đặc sản rừng', 'menu_food.png', 1, 1, 1505984537, 1505984537, 1),
(5, 'Món ăn nhanh', 'menu_food.png', 1, 1, 1505984561, 1505984561, 1),
(6, 'Các món lẩu', 'menu_food.png', 1, 1, 1505984574, 1505984574, 1),
(7, 'Đồ uống', 'menu_drink.png', 1, 1, 1505984727, 1505984727, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permissions` text,
  `note` text,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '-1:đã xóa, 0: không kích hoạt, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `syslog`
--

CREATE TABLE `syslog` (
  `id` int(11) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `level` tinyint(2) NOT NULL COMMENT '1: Error, 2: Warning, 3: Info; 4: Trace',
  `log_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `syslog`
--

INSERT INTO `syslog` (`id`, `category`, `message`, `prefix`, `level`, `log_time`) VALUES
(1, 'yii\\base\\UnknownPropertyException', 'exception \'yii\\base\\UnknownPropertyException\' with message \'Getting unknown property: yii\\gii\\generators\\crud\\Generator::isModal\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Component.php:147\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(229): yii\\base\\Component->__get(\'isModal\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(49): yii\\gii\\Generator->saveStickyAttributes()\n#2 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1505727648),
(2, 'yii\\base\\UnknownPropertyException', 'exception \'yii\\base\\UnknownPropertyException\' with message \'Getting unknown property: yii\\gii\\generators\\crud\\Generator::isModal\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Component.php:147\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(229): yii\\base\\Component->__get(\'isModal\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(49): yii\\gii\\Generator->saveStickyAttributes()\n#2 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1505727688),
(3, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'fa\' (T_STRING)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\BillTable.php:28\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505727826),
(4, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'backend\\controllers\\common\\utils\\model\\Model\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductTypeController.php:98\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505815339),
(5, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined offset: 4\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php:389\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php(389): yii\\base\\ErrorHandler->handleError(8, \'Undefined offse...\', \'C:\\\\xampp\\\\htdocs...\', 389, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(303): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(yii\\gii\\generators\\crud\\Generator))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(225): yii\\gii\\Generator->render(\'controller.php\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#6 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#12 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#13 {main}', 'IP: ::1; UserId: 1', 1, 1505890699),
(6, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined offset: 4\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php:389\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php(389): yii\\base\\ErrorHandler->handleError(8, \'Undefined offse...\', \'C:\\\\xampp\\\\htdocs...\', 389, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(303): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(yii\\gii\\generators\\crud\\Generator))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(225): yii\\gii\\Generator->render(\'controller.php\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#6 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#12 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#13 {main}', 'IP: ::1; UserId: 1', 1, 1505890728),
(7, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined offset: 4\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php:389\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php(389): yii\\base\\ErrorHandler->handleError(8, \'Undefined offse...\', \'C:\\\\xampp\\\\htdocs...\', 389, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(303): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(yii\\gii\\generators\\crud\\Generator))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(225): yii\\gii\\Generator->render(\'controller.php\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#6 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#12 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#13 {main}', 'IP: ::1; UserId: 1', 1, 1505890740),
(8, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined offset: 4\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php:389\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php(389): yii\\base\\ErrorHandler->handleError(8, \'Undefined offse...\', \'C:\\\\xampp\\\\htdocs...\', 389, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(303): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(yii\\gii\\generators\\crud\\Generator))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(225): yii\\gii\\Generator->render(\'controller.php\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#6 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#12 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#13 {main}', 'IP: ::1; UserId: 1', 1, 1505890746),
(9, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined offset: 4\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php:389\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\default\\controller.php(389): yii\\base\\ErrorHandler->handleError(8, \'Undefined offse...\', \'C:\\\\xampp\\\\htdocs...\', 389, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\Generator.php(303): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(yii\\gii\\generators\\crud\\Generator))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(225): yii\\gii\\Generator->render(\'controller.php\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#6 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#12 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#13 {main}', 'IP: ::1; UserId: 1', 1, 1505890946),
(10, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: image\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductTypeController.php:106\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductTypeController.php(106): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 106, Array)\n#1 [internal function]: backend\\controllers\\ProductTypeController->actionSave()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product-type/sa...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: ::1; UserId: 1', 1, 1505894413),
(11, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php:96\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php(96): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 96, Array)\n#1 [internal function]: backend\\controllers\\ProductController->actionSave()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product/save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: ::1; UserId: 1', 1, 1505897653),
(12, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php:96\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php(96): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 96, Array)\n#1 [internal function]: backend\\controllers\\ProductController->actionSave()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product/save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: ::1; UserId: 1', 1, 1505897715),
(13, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'backend\\controllers\\Model\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php:99\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505897728),
(14, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'?\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505900708),
(15, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'Yii\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505900720),
(16, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'Yii\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505900750),
(17, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'Yii\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505900965),
(18, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'Yii\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505900995),
(19, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'Yii\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:40\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505901019),
(20, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \')\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php:105\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505962580),
(21, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'Url\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\views\\product\\_search.php:56\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505963835),
(22, 'yii\\db\\Exception', 'exception \'PDOException\' with message \'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'server_app_order.product_type\' doesn\'t exist\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php:917\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(917): PDOStatement->execute()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(390): yii\\db\\Command->queryInternal(\'fetchColumn\', 0)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(438): yii\\db\\Command->queryScalar()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(339): yii\\db\\Query->queryScalar(\'COUNT(*)\', Object(yii\\db\\Connection))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(319): yii\\db\\ActiveQuery->queryScalar(\'COUNT(*)\', NULL)\n#5 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTypeTable.php(55): yii\\db\\Query->count()\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTypeTable.php(25): backend\\models\\table\\ProductTypeTable->getModels()\n#7 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(21): backend\\models\\table\\ProductTypeTable->getData()\n#8 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(42): common\\utils\\table\\TableFacade->getData()\n#9 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductTypeController.php(37): common\\utils\\table\\TableFacade->getDataTable()\n#10 [internal function]: backend\\controllers\\ProductTypeController->actionIndexTable()\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#12 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#13 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'index-table\', Array)\n#14 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product-type/in...\', Array)\n#15 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#16 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#17 {main}\n\nNext exception \'yii\\db\\Exception\' with message \'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'server_app_order.product_type\' doesn\'t exist\nThe SQL being executed was: SELECT COUNT(*) FROM (SELECT DISTINCT * FROM `product_type` WHERE `product_type`.`status`=1) `c`\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Schema.php:636\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(932): yii\\db\\Schema->convertException(Object(PDOException), \'SELECT COUNT(*)...\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(390): yii\\db\\Command->queryInternal(\'fetchColumn\', 0)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(438): yii\\db\\Command->queryScalar()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(339): yii\\db\\Query->queryScalar(\'COUNT(*)\', Object(yii\\db\\Connection))\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(319): yii\\db\\ActiveQuery->queryScalar(\'COUNT(*)\', NULL)\n#5 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTypeTable.php(55): yii\\db\\Query->count()\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTypeTable.php(25): backend\\models\\table\\ProductTypeTable->getModels()\n#7 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(21): backend\\models\\table\\ProductTypeTable->getData()\n#8 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(42): common\\utils\\table\\TableFacade->getData()\n#9 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductTypeController.php(37): common\\utils\\table\\TableFacade->getDataTable()\n#10 [internal function]: backend\\controllers\\ProductTypeController->actionIndexTable()\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#12 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#13 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'index-table\', Array)\n#14 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product-type/in...\', Array)\n#15 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#16 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#17 {main}\r\nAdditional Information:\r\nArray\n(\n    [0] => 42S02\n    [1] => 1146\n    [2] => Table \'server_app_order.product_type\' doesn\'t exist\n)\n', 'IP: ::1; UserId: 1', 1, 1505977686),
(23, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$htmlAction\' (T_VARIABLE), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTypeTable.php:43\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1505981650),
(24, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php:61\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php(61): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 61, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\ProductTable.php(25): backend\\models\\table\\ProductTable->getModels()\n#2 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(21): backend\\models\\table\\ProductTable->getData()\n#3 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(42): common\\utils\\table\\TableFacade->getData()\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ProductController.php(37): common\\utils\\table\\TableFacade->getDataTable()\n#5 [internal function]: backend\\controllers\\ProductController->actionIndexTable()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'index-table\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'product/index-t...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}', 'IP: ::1; UserId: 1', 1, 1506063513),
(25, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'backend\\controllers\\Product\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\TablesController.php:101\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1506071595),
(26, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'backend\\controllers\\AccessControl\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:23\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: -', 1, 1506133348),
(27, 'yii\\base\\InvalidParamException', 'exception \'yii\\base\\InvalidParamException\' with message \'Response content must not be an array.\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php:1045\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php(338): yii\\web\\Response->prepare()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Response->send()\n#2 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#3 {main}', 'IP: ::1; UserId: -', 1, 1506135048),
(28, 'yii\\base\\InvalidParamException', 'exception \'yii\\base\\InvalidParamException\' with message \'Response content must not be an array.\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php:1045\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php(338): yii\\web\\Response->prepare()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Response->send()\n#2 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#3 {main}', 'IP: ::1; UserId: -', 1, 1506135087),
(29, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:37\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(37): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 37, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionDataAll()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'data-all\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/data-a...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: ::1; UserId: -', 1, 1506135851),
(30, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined variable: variable\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:43\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(43): yii\\base\\ErrorHandler->handleError(8, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 43, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionDataAll()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'data-all\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/data-a...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: ::1; UserId: -', 1, 1506158057),
(31, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined variable: product\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:66\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(66): yii\\base\\ErrorHandler->handleError(8, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 66, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionProductType()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'product-type\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/produc...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508149823),
(32, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined variable: product\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:66\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(66): yii\\base\\ErrorHandler->handleError(8, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 66, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionProductType()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'product-type\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/produc...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508149851),
(33, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:60\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(60): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 60, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionProductType()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'product-type\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/produc...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508206619),
(34, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:38\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(38): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 38, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionDataAll()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'data-all\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/data-a...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508206664),
(35, 'system', 'Đăng nhập vào tài khoản admin thất bại.', 'IP: 192.168.68.39; UserId: -', 2, 1508206765),
(36, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:65\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(65): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 65, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionProductType()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'product-type\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/produc...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508235318),
(37, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:38\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(38): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 38, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionDataAll()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'data-all\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/data-a...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508293490),
(38, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312769),
(39, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312834),
(40, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312848),
(41, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312866),
(42, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312937);
INSERT INTO `syslog` (`id`, `category`, `message`, `prefix`, `level`, `log_time`) VALUES
(43, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508312998),
(44, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313021),
(45, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313025),
(46, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:91\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(91): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 91, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313120),
(47, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: imei\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:91\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(91): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 91, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313220),
(48, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313264),
(49, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313287),
(50, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:92\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(92): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 92, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313301),
(51, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Trying to get property of non-object\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:102\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(102): yii\\base\\ErrorHandler->handleError(8, \'Trying to get p...\', \'C:\\\\xampp\\\\htdocs...\', 102, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313406),
(52, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: product_type_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:98\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php(98): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 98, Array)\n#1 [internal function]: backend\\controllers\\ApiDataController->actionClassifyProduct()\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'classify-produc...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/classi...\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#7 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#8 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508313508),
(53, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Trying to get property of non-object\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php:219\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\generators\\crud\\Generator.php(219): yii\\base\\ErrorHandler->handleError(8, \'Trying to get p...\', \'C:\\\\xampp\\\\htdocs...\', 219, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2-gii\\controllers\\DefaultController.php(50): yii\\gii\\generators\\crud\\Generator->generate()\n#2 [internal function]: yii\\gii\\controllers\\DefaultController->actionView(\'crud\')\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'gii/default/vie...\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: -', 1, 1508494015),
(54, 'system', 'Đăng nhập vào tài khoản admin thất bại.', 'IP: ::1; UserId: -', 2, 1508494585),
(55, 'yii\\web\\HttpException:500', 'exception \'yii\\web\\ServerErrorHttpException\' with message \'Máy chủ đã gặp sự cố nội bộ.\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:133\nStack trace:\n#0 [internal function]: backend\\controllers\\ApiDataController->actionSaveOrder()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save-order\', Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'api-data/save-o...\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#7 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508495155),
(56, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Cannot use object of type stdClass as array\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:138\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508553328),
(57, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Cannot use object of type stdClass as array\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:125\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508553368),
(58, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Cannot use object of type stdClass as array\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:139\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 192.168.68.39; UserId: -', 1, 1508553573),
(59, 'yii\\base\\UnknownPropertyException', 'exception \'yii\\base\\UnknownPropertyException\' with message \'Getting unknown property: backend\\models\\Tables::name\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Component.php:147\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\BaseActiveRecord.php(286): yii\\base\\Component->__get(\'name\')\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\views\\order-food\\view.php(32): yii\\db\\BaseActiveRecord->__get(\'name\')\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(331): require(\'C:\\\\xampp\\\\htdocs...\')\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(251): yii\\base\\View->renderPhpFile(\'C:\\\\xampp\\\\htdocs...\', Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\View.php(153): yii\\base\\View->renderFile(\'C:\\\\xampp\\\\htdocs...\', Array, Object(backend\\controllers\\OrderFoodController))\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(383): yii\\base\\View->render(\'view\', Array, Object(backend\\controllers\\OrderFoodController))\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(58): yii\\base\\Controller->render(\'view\', Array)\n#7 [internal function]: backend\\controllers\\OrderFoodController->actionView()\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view\', Array)\n#11 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view\', Array)\n#12 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#13 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#14 {main}', 'IP: ::1; UserId: 1', 1, 1508553845),
(60, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508593909),
(61, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508593909),
(62, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508593938),
(63, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508593938),
(64, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508593999),
(65, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508594000),
(66, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508594423),
(67, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'$orderFood\' (T_VARIABLE)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\ApiDataController.php:135\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: 10.0.0.122; UserId: -', 1, 1508594424),
(68, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'DatetimepickerAsset\' (T_STRING), expecting \']\'\' in C:\\xampp\\htdocs\\server_app_order\\backend\\assets\\AppAsset.php:60\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1508814295),
(69, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:65\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(65): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 65, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(123): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508817457),
(70, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:65\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(65): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 65, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(126): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508818210),
(71, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:65\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(65): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 65, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(126): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508818408),
(72, 'yii\\web\\HttpException:500', 'exception \'yii\\web\\ServerErrorHttpException\' with message \'Máy chủ đã gặp sự cố nội bộ.\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php:145\nStack trace:\n#0 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#7 {main}', 'IP: ::1; UserId: 1', 1, 1508818497),
(73, 'yii\\web\\HttpException:500', 'exception \'yii\\web\\ServerErrorHttpException\' with message \'Máy chủ đã gặp sự cố nội bộ.\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php:145\nStack trace:\n#0 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#6 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#7 {main}', 'IP: ::1; UserId: 1', 1, 1508818547),
(74, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:65\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(65): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 65, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(128): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508825595),
(75, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:66\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(66): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 66, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(128): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508826277),
(76, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:68\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(68): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 68, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(128): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508826312),
(77, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Array to string conversion\' in C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php:69\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\model\\Model.php(69): yii\\base\\ErrorHandler->handleError(8, \'Array to string...\', \'C:\\\\xampp\\\\htdocs...\', 69, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(128): common\\utils\\model\\Model::saveMultiple(Object(backend\\models\\OrderFood), Object(common\\utils\\model\\ModelBuilder))\n#2 [internal function]: backend\\controllers\\OrderFoodController->actionSave()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#4 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#5 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'save\', Array)\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/save\', Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#8 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#9 {main}', 'IP: ::1; UserId: 1', 1, 1508826400),
(78, 'yii\\base\\ErrorException:8', 'exception \'yii\\base\\ErrorException\' with message \'Undefined index: tables_id\' in C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\OrderFoodTable.php:64\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\OrderFoodTable.php(64): yii\\base\\ErrorHandler->handleError(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 64, Array)\n#1 C:\\xampp\\htdocs\\server_app_order\\backend\\models\\table\\OrderFoodTable.php(25): backend\\models\\table\\OrderFoodTable->getModels()\n#2 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(21): backend\\models\\table\\OrderFoodTable->getData()\n#3 C:\\xampp\\htdocs\\server_app_order\\common\\utils\\table\\TableFacade.php(42): common\\utils\\table\\TableFacade->getData()\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(40): common\\utils\\table\\TableFacade->getDataTable()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionIndexTable()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'index-table\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/inde...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}', 'IP: ::1; UserId: 1', 1, 1508834138),
(79, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'Url\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\views\\order-food\\_modal_check_tables.php:91\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1508988030),
(80, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'Url\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\views\\order-food\\_modal_check_tables.php:91\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1508988037),
(81, 'yii\\base\\InvalidParamException', 'exception \'yii\\base\\InvalidParamException\' with message \'Response content must not be an array.\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php:1045\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Response.php(338): yii\\web\\Response->prepare()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Response->send()\n#2 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#3 {main}', 'IP: ::1; UserId: 1', 1, 1509006034),
(82, 'yii\\base\\ErrorException:4', 'exception \'yii\\base\\ErrorException\' with message \'syntax error, unexpected \'=>\' (T_DOUBLE_ARROW)\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php:232\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1509006138),
(83, 'yii\\base\\ErrorException:1', 'exception \'yii\\base\\ErrorException\' with message \'Class \'backend\\controllers\\Json\' not found\' in C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php:232\nStack trace:\n#0 [internal function]: yii\\base\\ErrorHandler->handleFatalError()\n#1 {main}', 'IP: ::1; UserId: 1', 1, 1509006164),
(84, 'yii\\db\\Exception', 'exception \'PDOException\' with message \'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'`order_food`.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON \' at line 1\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php:917\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(917): PDOStatement->execute()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(231): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\n\nNext exception \'yii\\db\\Exception\' with message \'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'`order_food`.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON \' at line 1\nThe SQL being executed was: SELECT order_food.id as order_food_id `order_food`.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON order_food.id = tables_order.order_food_id WHERE `order_food`.`created_date_order` >= 1508964720\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Schema.php:636\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(932): yii\\db\\Schema->convertException(Object(PDOException), \'SELECT order_fo...\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(231): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\r\nAdditional Information:\r\nArray\n(\n    [0] => 42000\n    [1] => 1064\n    [2] => You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'`order_food`.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON \' at line 1\n)\n', 'IP: ::1; UserId: 1', 1, 1509007932),
(85, 'yii\\db\\Exception', 'exception \'PDOException\' with message \'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON order_food.i\' at line 1\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php:917\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(917): PDOStatement->execute()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(231): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\n\nNext exception \'yii\\db\\Exception\' with message \'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON order_food.i\' at line 1\nThe SQL being executed was: SELECT order_food.id `order_food`.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON order_food.id = tables_order.order_food_id WHERE `order_food`.`created_date_order` >= 1508964780\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Schema.php:636\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(932): yii\\db\\Schema->convertException(Object(PDOException), \'SELECT order_fo...\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(231): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\r\nAdditional Information:\r\nArray\n(\n    [0] => 42000\n    [1] => 1064\n    [2] => You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'.`created_date_order` FROM `order_food` LEFT JOIN `tables_order` ON order_food.i\' at line 1\n)\n', 'IP: ::1; UserId: 1', 1, 1509007999);
INSERT INTO `syslog` (`id`, `category`, `message`, `prefix`, `level`, `log_time`) VALUES
(86, 'yii\\db\\Exception', 'exception \'PDOException\' with message \'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'order_food.created_date_order1\' in \'where clause\'\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php:917\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(917): PDOStatement->execute()\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(234): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\n\nNext exception \'yii\\db\\Exception\' with message \'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'order_food.created_date_order1\' in \'where clause\'\nThe SQL being executed was: SELECT `order_food`.`created_date_order`, `order_food`.`id` AS `order_food_id`, `tables`.`id` AS `tables_id`, `tables`.`name` AS `tables_name` FROM `order_food` LEFT JOIN `tables_order` ON order_food.id = tables_order.order_food_id LEFT JOIN `tables` ON tables_order.tables_id = `tables`.id WHERE `order_food`.`created_date_order1` >= 1508968620\' in C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Schema.php:636\nStack trace:\n#0 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(932): yii\\db\\Schema->convertException(Object(PDOException), \'SELECT `order_f...\')\n#1 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Command.php(362): yii\\db\\Command->queryInternal(\'fetchAll\', NULL)\n#2 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\Query.php(213): yii\\db\\Command->queryAll()\n#3 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\db\\ActiveQuery.php(135): yii\\db\\Query->all(NULL)\n#4 C:\\xampp\\htdocs\\server_app_order\\backend\\controllers\\OrderFoodController.php(234): yii\\db\\ActiveQuery->all()\n#5 [internal function]: backend\\controllers\\OrderFoodController->actionViewTablesOrder()\n#6 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): call_user_func_array(Array, Array)\n#7 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Controller.php(156): yii\\base\\InlineAction->runWithParams(Array)\n#8 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Module.php(525): yii\\base\\Controller->runAction(\'view-tables-ord...\', Array)\n#9 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\web\\Application.php(102): yii\\base\\Module->runAction(\'order-food/view...\', Array)\n#10 C:\\xampp\\htdocs\\server_app_order\\vendor\\yiisoft\\yii2\\base\\Application.php(380): yii\\web\\Application->handleRequest(Object(yii\\web\\Request))\n#11 C:\\xampp\\htdocs\\server_app_order\\backend\\web\\index.php(22): yii\\base\\Application->run()\n#12 {main}\r\nAdditional Information:\r\nArray\n(\n    [0] => 42S22\n    [1] => 1054\n    [2] => Unknown column \'order_food.created_date_order1\' in \'where clause\'\n)\n', 'IP: ::1; UserId: 1', 1, 1509011845);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imei_device_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `imei_device_id`, `created_by`, `modified_by`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Bàng Số 01', 1, 1, 1, 1506070555, 1506070555, 1),
(2, 'Bàn số 02', 2, 1, 1, 1506072326, 1506072326, 1),
(3, 'Bàn số 03', 3, 1, 1, 1506072345, 1506072345, 1),
(4, 'Bàn số 04', 4, 1, 1, 1506072355, 1506072355, 1),
(5, 'Bàn số 05', 5, 1, 1, 1506072364, 1506072364, 1),
(6, 'Bàn số 06', 6, 1, 1, 1506072374, 1506072374, 1),
(7, 'Bàn số 07', 7, 1, 1, 1506072387, 1506072387, 1),
(8, 'Bàn số 08', 8, 1, 1, 1506072397, 1506072397, 1),
(9, 'Bàn số 09', 9, 1, 1, 1506072409, 1506072409, 1),
(10, 'Bàn số 10', 10, 1, 1, 1506072419, 1506072419, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables_order`
--

CREATE TABLE `tables_order` (
  `id` int(11) NOT NULL,
  `order_food_id` int(11) DEFAULT NULL,
  `tables_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tables_order`
--

INSERT INTO `tables_order` (`id`, `order_food_id`, `tables_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 6, 1),
(6, 6, 9, 1),
(7, 7, 10, 1),
(8, 8, 5, 1),
(9, 9, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_template`
--

CREATE TABLE `tbl_template` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT '1',
  `modified_by` int(11) UNSIGNED DEFAULT NULL,
  `created_date` int(11) UNSIGNED NOT NULL,
  `modified_date` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 1: kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Họ và tên',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_extension` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Số nội bộ',
  `status` tinyint(6) NOT NULL DEFAULT '1' COMMENT '-1: đã xóa, 0: không kích hoạt, 1: kích hoạt',
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: user thường, 1: admin, 100: super admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `auth_key`, `password_hash`, `token`, `email`, `phone`, `phone_extension`, `status`, `created_date`, `modified_date`, `created_by`, `modified_by`, `last_login`, `role_id`, `type`) VALUES
(1, 'admin', '', '7cQuboiD43v27zFSWgJHTJWIal6tukje', '$2y$13$hLYAOEZJ31jrgw2xeRDQj.I1K//8BybKU3aLpwoSXhbpN3fqA5l.C', 'XGMvl2RJJUB3eGW3y9vJrMFMqmDZ52fI_1497337668', 'phamquanghieu0206@gmail.com', '01682405889', '1', 1, 1392559490, 1497372972, NULL, NULL, 1509070457, NULL, 100),
(2, 'man.ha', 'hà minh mẫn', 'BiEw5P8Nzup73q62fZYdDcNB8HqgmNNx', '$2y$13$53t55KYoXlqgveUTbdBqieDjZtPv/2MWGK9k9.PojkixK3Q3tkRf2', NULL, 'a@gmail.com', '01685524224', '0838383838', 1, 1509074771, 1509074771, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `detail_order_food`
--
ALTER TABLE `detail_order_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_food_id` (`order_food_id`),
  ADD KEY `product_id_d_o` (`product_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `imme_device`
--
ALTER TABLE `imme_device`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_child`
--
ALTER TABLE `module_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `tables_id` (`tables_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syslog`
--
ALTER TABLE `syslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imei_device_id` (`imei_device_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `tables_order`
--
ALTER TABLE `tables_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_food__1` (`order_food_id`),
  ADD KEY `tables_id__1` (`tables_id`);

--
-- Indexes for table `tbl_template`
--
ALTER TABLE `tbl_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`token`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_order_food`
--
ALTER TABLE `detail_order_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `imme_device`
--
ALTER TABLE `imme_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module_child`
--
ALTER TABLE `module_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `syslog`
--
ALTER TABLE `syslog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tables_order`
--
ALTER TABLE `tables_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_template`
--
ALTER TABLE `tbl_template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_order_food`
--
ALTER TABLE `detail_order_food`
  ADD CONSTRAINT `order_food_id` FOREIGN KEY (`order_food_id`) REFERENCES `order_food` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_id_d_o` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imme_device`
--
ALTER TABLE `imme_device`
  ADD CONSTRAINT `created_by_i` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modified_by_i` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `module_child`
--
ALTER TABLE `module_child`
  ADD CONSTRAINT `module_child_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Constraints for table `order_food`
--
ALTER TABLE `order_food`
  ADD CONSTRAINT `tables_id_or` FOREIGN KEY (`tables_id`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `created_by_p` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modified_by_p` FOREIGN KEY (`modified_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_type_id` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `imei_device_id` FOREIGN KEY (`imei_device_id`) REFERENCES `imme_device` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tables_order`
--
ALTER TABLE `tables_order`
  ADD CONSTRAINT `order_food__1` FOREIGN KEY (`order_food_id`) REFERENCES `order_food` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tables_id__1` FOREIGN KEY (`tables_id`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
