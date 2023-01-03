-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 07:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobgatev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `logo` varchar(30) NOT NULL,
  `website` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`user_id`, `name`, `address`, `district_id`, `description`, `logo`, `website`, `linkedin`, `mobile`) VALUES
(5, 'Company One', '7 Oak Street, Havelock,nc, 28532  United States', NULL, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 'user_5.png', NULL, NULL, NULL),
(10, 'Bymatching', 'kalutara', 1, 'we ewhggwf vw fbywfgwefg weywefyw eff wef we fwg efgw cwe cw bw ecnbw ec nbcewncb webc wecgw ecew ewcew cweg cge cgwe cewg cwegc we cwcwecwc ewc ewc wecec ewc ewbjhc kwjh wfwefwf', 'user_10.png', 'www.bymatching.se', 'https://www.linkedin.com/in/ruwan-rohitha-98319b1b2/', '0756431263'),
(11, 'Belengio AAB', 'wefwef hw fbewfbwefhuwbefuh bwef ruwan', NULL, ' baba yaga wewegf vwgewefu wevbufyvbew ybewf bwefiw beuwbfiuwbe uwbeiuwbe iuw befuw befufbewuw wgefewf wewef wef we wewhefwef wf we we fwef jwke wjenfjwe wje w fjw jw fwefw fwe fwef', 'user_1120221009001356.png', 'www.belegioab.com', 'https://www.linkedin.com/in/ruwan-rohitha-98wefb1b2/', '1234567890'),
(17, 'qwdqwd', 'qwdqwdq', NULL, 'wdqwdqwdwqd', 'user_1720221230053117.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `district` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district`) VALUES
(16, 'Ampara'),
(20, 'Anuradhapura'),
(22, 'Badulla'),
(15, 'Batticaloa'),
(1, 'Colombo'),
(7, 'Galle'),
(2, 'Gampaha'),
(9, 'Hambantota'),
(10, 'Jaffna'),
(3, 'Kalutara'),
(4, 'Kandy'),
(25, 'Kegalle'),
(11, 'Kilinochchi'),
(18, 'Kurunegala'),
(12, 'Mannar'),
(5, 'Matale'),
(8, 'Matara'),
(23, 'Moneragala'),
(14, 'Mullaitivu'),
(6, 'Nuwara Eliya'),
(21, 'Polonnaruwa'),
(19, 'Puttalam'),
(24, 'Ratnapura'),
(17, 'Trincomalee'),
(13, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `education_id` int(11) NOT NULL,
  `program` varchar(300) NOT NULL,
  `result` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`education_id`, `program`, `result`, `note`, `user_id`) VALUES
(1, 'Ordinary Level', 'Pass', 'wfewfewfewf\r\nwefwef\r\nwef\r\newf\r\newf\r\newfewfwef\r\nwefw\r\nef\r\nwefwefwef', 8),
(2, 'Advance Level', 'Pass', 'asdsadasdsads dad adsada d\r\nas dasdsa sadagsdvags asd as\r\nasd adasdsa dasdasdasd', 8);

-- --------------------------------------------------------

--
-- Table structure for table `employies`
--

CREATE TABLE `employies` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `birthday` date DEFAULT NULL,
  `website` varchar(300) DEFAULT NULL,
  `linkedin` varchar(300) DEFAULT NULL,
  `github` varchar(300) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `skills` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employies`
--

INSERT INTO `employies` (`user_id`, `first_name`, `last_name`, `description`, `gender`, `address`, `image`, `birthday`, `website`, `linkedin`, `github`, `mobile`, `skills`) VALUES
(8, 'Ruwan', 'Rohitha', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to usingIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using', 'Male', '453/2 old airt port road nagoda', 'user_8.png', '2022-10-13', 'www.ruwanmx.dev.com', 'www.lasiashavbjasbvd jasvdhajvjasvbahjsafasdas/asahfvagfvaf', 'www.grieghbjergreg/ergerg', '0987654321', 'Java,C,Critical Thinking'),
(9, 'r', 'r', '', '', NULL, 'user_9.png', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'wewef', 'wefwef', NULL, NULL, NULL, 'user_1820221230054115.png', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'shanilka', 'shani', NULL, NULL, NULL, 'user_1920221230054946.png', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'w', 'q', NULL, NULL, NULL, 'user_2020221230055826.png', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 't', 'f', NULL, NULL, NULL, 'user_2120221230060116.png', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Luhith', 'Kariyawasam', NULL, NULL, NULL, 'user_2220221230074925.png', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `company_id`) VALUES
(12, 8, 5),
(14, 8, 10),
(15, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `salary` int(11) NOT NULL,
  `salary_type_id` varchar(100) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `job_category_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `state` int(11) NOT NULL COMMENT '1=active\r\n2=closed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `description`, `salary`, `salary_type_id`, `job_type_id`, `job_category_id`, `district_id`, `state`, `created_at`) VALUES
(1, 11, 'wexc ndsbakhsdd h ewfwfe', 'wef bwfehebwhfbwywf yewb b edv fb dfg dfg dfgdfg dgd kdbgd fbdgkdf bkjdgbjdk gbkdjbdgkj bsgg regerg erer', 300, '1', 1, 6, 2, 1, '2022-10-08 22:57:41'),
(2, 11, 'Graphic Designer ', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 70000, '2', 1, 7, 9, 2, '2022-10-09 13:45:56'),
(3, 10, 'wjhef fwef fwf wfiuwfwi uf wiewf wiuwf ', 'w efwef uiw uwuf fuh gdsa iefg gi sdjfejwhfwe fiusdhs hdfjhewf iuwhf snmks dksfo fyewfgwyfg fghdfg sjgshf giewfgwieu fhj bchbhd byhbfwe obwebow efybwe fwefwe ', 5000, '1', 1, 2, 18, 1, '2022-11-14 19:56:32'),
(4, 10, 'First Course sfowfwfwf wfjwfknwjfnwef wef kwf wk', 'w wf wef ewfew fwef wef bwefbwef ywebfuywbe fwfew fwef wfw fuyfew  wuyfbwef yb wef weybf fwbywefb wybb ywefwef wefwewe few few w e', 2000, '1', 1, 1, 3, 1, '2022-11-14 19:58:52'),
(5, 10, ' hrenfu ibfbwfgbwef ewb w e bwefb wefhbewfbnw fwew efwfwefefiwef e uiwefwe fewf wf  ', 'few few fubwfew fubiwufbei ewfewfewfew fwef wef biubfebf iuwbefyu wbfyubwf efewnf ewf ewfh fwef befuiwe biuwfbweb fiwubf eb fwefbwiubfiwbe fefb weuifbewufbew ufwf w we wfbwfuwbfhewu fbewfiuwef uwfweuifgufegw fbdbv nvbjehbvjhbv beffbewf hgef wefi wgfuwefiuew f ewi f gwuf uwifg bewf wfe ewf', 3000, '1', 5, 1, 1, 1, '2022-11-15 02:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=pending\r\n2=accepted\r\n3=rejected',
  `message` text DEFAULT NULL,
  `applied_date` date NOT NULL,
  `responded_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `user_id`, `job_id`, `status`, `message`, `applied_date`, `responded_date`) VALUES
(6, 8, 3, 1, NULL, '2022-11-15', NULL),
(7, 8, 4, 1, NULL, '2022-11-15', NULL),
(8, 8, 5, 2, 'wef wef weew wegrgtrgthjtyjt rhregrgrgegerg ergerghrykrfwrnt', '2022-11-15', NULL),
(9, 8, 1, 3, 'er gerger gergergergerrtj rtegvthfggf gfhjfdhthrthrettherher rherdbcghf gerert', '2022-11-15', NULL),
(10, 8, 2, 3, NULL, '2022-11-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `name`) VALUES
(6, 'Backend Developer'),
(8, 'Database manager'),
(5, 'Frontend Developer'),
(1, 'Full Stack Software Developers'),
(2, 'Full Stack Web Developer'),
(4, 'Mobile Application Developer'),
(10, 'Network Engineer'),
(14, 'Python Developer'),
(3, 'React Developer'),
(12, 'Red-Hat Hacker'),
(11, 'Server Administrator'),
(9, 'System Administrator'),
(7, 'UI UX Designer'),
(13, 'White-Hat Hacker');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`) VALUES
(1, 'Full Time'),
(5, 'Internship'),
(6, 'Months'),
(2, 'Part Time'),
(3, 'Project Wise Time'),
(4, 'Trainee');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `send_date` datetime NOT NULL,
  `states` int(11) NOT NULL COMMENT '1=unread\r\n2=read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciver_id`, `message`, `send_date`, `states`) VALUES
(1, 1, 8, 'loerm ababs dkhsad wjhebwefebyhwhfbb we few f nn vnsvh dfefjh w be jb s fd jvdsfddsjd fjhsdfjhb  sfjhbs d s  fds sfs dsd sd jfd jssdfsfd dsdfs fsfs fdfsd fsdf sfsd dsf f', '2022-11-14 09:17:02', 1),
(2, 8, 1, 'ergergegeg', '2022-11-14 16:55:26', 1),
(3, 5, 1, 'Ammatasiri muge ganan balapanko', '2022-11-14 17:45:39', 1),
(4, 8, 1, 'denne ubata payin ekak homba kata thalenna harida enna epa kna palenna gahanne ballage', '2022-11-14 17:54:15', 1),
(5, 1, 8, 'payin parak dennad man aa aa gemada illnanne ', '2022-11-14 18:03:27', 1),
(6, 8, 1, 'hgewdwef wf wef wf we fw efjewf fwefw eew fe ewf', '2022-11-14 18:07:05', 1),
(7, 1, 9, 'w eew rewf wfewjwjbwbejhwebf hwefbwhebfwbef wbfewb fiweb fw bfiwu efbwiu fbwue ifbwuefbnwoufbowe fwefwef wf', '2022-11-14 18:07:13', 1),
(8, 9, 1, 'we fw hfejhfewvbh wfew bw fhewb fjnwefj kms,vndmbjfhgruhgu nvjsnvuewfn igbreg ergbe rigbeu geurg eugre gue bjnvcsnbjshfru hurwfhndsnfmsd nsnf owfnw ouw hewur oi gegeg g hrth rhr hrthrth rhrt h', '2022-11-14 18:07:26', 1),
(10, 8, 1, 'wefwefewfwefwef wef ewf ewbbwefuw ufboiw fnnowenf iwofejiwo joiwefjw ipjw jfpiwej wpefoijw efpjwef wejowe fjpowf wpoie fhpoiw efph hwefwe fwe fwef w f', '2022-11-14 18:08:59', 1),
(12, 1, 9, 'denne ubata payin udin gin wisik wenn aharida ballo', '2022-11-14 18:25:57', 1),
(13, 1, 8, 'ewrfgewgw we ew fwfwefwe we', '2022-11-14 18:34:13', 1),
(15, 1, 9, 'egerg er gege er ge er gregergregreg regeg ee eer g', '2022-11-14 18:35:51', 1),
(16, 1, 5, 'fefwefwefw fe fwfw', '2022-11-14 18:47:31', 1),
(18, 1, 10, 'ado ballo balapan me paththa huththo ', '2022-11-15 08:02:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `reset_token` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `reset_token`) VALUES
(23, 'ruwanmx.developer@gmail.com', 'a86ce80c14b8e09733299a74aa289807');

-- --------------------------------------------------------

--
-- Table structure for table `salary_types`
--

CREATE TABLE `salary_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_types`
--

INSERT INTO `salary_types` (`id`, `name`) VALUES
(1, 'per Month'),
(2, 'per Year'),
(3, 'per Hour'),
(4, 'per Project'),
(5, 'per Task');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(160) NOT NULL,
  `state` int(1) NOT NULL COMMENT '1=active\r\n2=blocked\r\n3=unverified',
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `state`, `role_id`) VALUES
(1, 'ruwanmx.developer@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 1, 1),
(5, 'company@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 3),
(8, 'emp3@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(9, '1234@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(10, 'com@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 3),
(11, 'com23@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 3),
(12, 'ruwan@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(13, 'ruwan1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(14, 'ruwan6@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(15, 'drrrd@gfg.fgh', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(16, 'drrrdsd@gfg.fgh', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(17, '2020t00904@stu.cmb.ac.lk', 'c4ca4238a0b923820dcc509a6f75849b', 3, 3),
(18, '345345@dgdfg.dff', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(19, '456@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(20, '234@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(21, 'test@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(22, 'test4@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'system_admin'),
(2, 'employee'),
(3, 'company');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `work_id` int(11) NOT NULL,
  `company` varchar(300) NOT NULL,
  `post` varchar(200) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `district` (`district`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `employies`
--
ALTER TABLE `employies`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_types`
--
ALTER TABLE `salary_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `salary_types`
--
ALTER TABLE `salary_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
