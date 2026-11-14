-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2022 at 10:04 AM
-- Server version: 5.7.37
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scaitin_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'scaithead', '786123786'),
(2, 'atul', 'A2ul@fuckyou');

-- --------------------------------------------------------

--
-- Table structure for table `s_adm`
--

CREATE TABLE `s_adm` (
  `id` int(255) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `s_adm`
--

INSERT INTO `s_adm` (`id`, `Name`, `Phone`, `Address`) VALUES
(1, 'Shshai kasera', '6307628891', 'Sirathu '),
(2, 'Abc', '1234567890', 'Gsgsv s '),
(3, 'abbba', '12345667778', 'dsfsdfs'),
(4, 'Atul TIWARI', '8957048630', 'Ramesh'),
(5, 'Amit pal', '9956598563', 'Punvar paschim Sarita kaushambi'),
(6, 'Santosh Kumar', '9369291244', 'Punvar paschim Sarira kaushambi'),
(7, 'Santosh Kumar', '9369291244', 'Punwar pashchim Sarira kaushambi'),
(8, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'),
(9, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'),
(10, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'),
(11, 'Atul tiwaree', '8957048639', 'Rampur dhamawan sirathu Kaushambi '),
(12, 'Atul tiwaree', '8957048639', 'Rampur dhamawan sirathu Kaushambi '),
(13, 'Ramu kumar', '7783926037', 'Sarsawan'),
(14, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'),
(15, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'),
(16, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'),
(17, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'),
(18, 'KM SHUBHI SHUKLA', '7080385531', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'),
(19, 'KM SHUBHI SHUKLA', '6392497030', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'),
(20, 'KM SHUBHI SHUKLA', '9455070569', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'),
(21, 'KM SHUBHI SHUKLA', '8303724047', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'),
(22, 'KM SHUBHI SHUKLA', '8303724047', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'),
(23, 'KM SHUBHI SHUKLA ', '8303724047', 'PURE NIDHAU AHARI BUGURAJ LUXMIGANJ '),
(24, 'mnn', '7767679879', 'y8y8'),
(25, 'Laxmikant tripathi', '9125003585', 'Paur'),
(26, 'Himanshu soni', '9569165079', 'Hinauta kaushambi'),
(27, 'Sachin Pandey', '9305072883', 'Village Uno Post Sarswan Subdistrict Manjhanpur District Kaushambi'),
(28, '1001223', '9506767795', 'Kumhiyawan kaushambi');

-- --------------------------------------------------------

--
-- Table structure for table `s_cer_det`
--

CREATE TABLE `s_cer_det` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enroll` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roll` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `s_cer_det`
--

INSERT INTO `s_cer_det` (`id`, `name`, `fname`, `mname`, `enroll`, `roll`, `dob`, `course`, `duration`, `gender`, `photo`) VALUES
(1, 'SUDEER KUMAR', 'CHHEDI LAL', 'GIRJA DEVI', '1435302', '1001215', '07-07-2001', 'ADCA', '1 Year', 'male', 'upload/Atul Tiwaree1632853719.jpg'),
(2, 'SHIVBABU', 'HARISHCHANDRA ', 'SHAKUNTLA DEVI', '1435303', '1001216', '10-06-2002', 'ADCA', '1 Year', 'male', 'upload/Atul1632974184.jpg'),
(4, 'RAMU KUMAR', 'CHAGGU', 'FHUL KUMARI', '1435307', '1001220', '03-12-2005', 'ADCA', '1 Year', 'male', ''),
(7, 'SHUBHAM SAHU', 'GULAB CHANDRA SAHU', 'RENU DEVI', '1425308', '1001221', '10-03-2005', 'ADCA', '1 Year', 'male', ''),
(8, 'RISHI KUMAR TIWARI', 'RAM BABU TIWARI', 'KALPANA TIWARI', '1435306', '1001219', '09-01-2003', 'ADCA', '1 Year', 'male', ''),
(9, 'ABHISHEK', 'RAJ KUMAR TIWARI', 'UMA DEVI', '1435305', '1001218', '26-06-2001', 'ADCA', '1 Year', 'male', ''),
(10, 'NAIM AHMAD', 'SHARIF AHMAD', 'WFATUN NISA', '1435309', '1001222', '01-071996', 'ADCA', '1 Year', 'male', ''),
(11, 'MAHENDRA KUMAR CHAURASIYA', 'RAM NIHORE CHAURASIYA', 'CHAMPA DEVI', '14353013', '10012236', '11-09-1998', 'ADCA', '1 Year', 'male', ''),
(12, 'AKASH CHAURASIYA', 'ASHOK KUMAR', 'VITTAN DEVI', '14353012', '10012235', '04-05-2001', 'ADCA', '1 Year', 'male', ''),
(22, 'VARSHA MODANWAL', 'DINESH  KUMAR GUPTA', 'REENA DEVI GUPTA', '14353015', '10012237', '03/07/2003', 'ADCA', '1 Year', 'female', 'upload/VARSHA MODANWAL1635757534.jpg'),
(31, 'KM SHUBHI SHUKLA', 'AJAY KUMAR', 'ARCHANA SHUKLA', '14353021', '10012242', '10/06/2002', 'ADCA', '1 Year', 'female', 'upload/KM SHUBHI SHUKLA1642140300.jpg'),
(32, 'SAKSHI KESHARWANI', 'BHAGWAN DAS KESHARWANI', 'RITA DEVI', '1435011', '10012234', '15/10/2003', 'ADCA', '1 Year', 'female', 'upload/SAKSHI KESHARWANI1642341617.jpg'),
(33, 'RASHMI DEVI', 'MAHESH KUMAR JAYSAWAL', 'SANGITA DEVI', '14353010', '1001223', '18/08/2003', 'ADCA', '1 Year', 'female', 'upload/RASHMI DEVI1642341766.jpg'),
(34, 'RAMU  KUMAR', 'CHHANGGU', 'PHOOL KUMARI', '14353019', '10012240', '03/12/2005', 'ADCA', '1 Year', 'male', 'upload/RAMU  KUMAR1642821362.jpg'),
(35, 'ASHUTOSH  MISHRA', 'KAMALA  KANT  MISHRA', 'RENU  DEVI', '14353022', '10012243', '25/07/2003', 'ADCA', '1 Year', 'male', 'upload/ASHUTOSH  MISHRA1644044837.jpg'),
(36, 'HARI OM DWIVEDI', 'GOVIND PRASAD DWIVEDI', 'KANCHAN  DWIVEDI', '14353023', '10012244', '18/06/2003', 'ADCA', '1 Year', 'male', 'upload/HARI OM DWIVEDI1644379003.jpg'),
(37, 'SANGEETA DEVI', 'FOOL CHANDRA ', 'URMILA DEVI', '14353027', '10012248', '01/03/2003', 'ADCA', '1 Year', 'female', 'upload/SANGEETA DEVI1646389069.jpg'),
(38, 'PRADEEP  KUMAR', 'SAMPAT  LAL ', 'CHHOTAKI  DEVI', '14353028', '10012249', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/PRADEEP  KUMAR1647007504.jpg'),
(39, 'AMIT KUMAR', 'UMESH CHANDRA', 'KALPANA DEVI', '14353026', '10012247', '12/09/2000', 'ADCA', '1 Year', 'male', 'upload/AMIT KUMAR1648309117.jpg'),
(40, 'SONU KUMAR', 'JAGAT PAL', 'RAJKALI', '14353030', '10012251', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/SONU KUMAR1648781649.jpg'),
(41, 'HIMANSHU  SONI', 'ASHOK KUMAR  SONI', 'SONAM  SONI', '14353031', '14353031', '24/04/2003', 'ADCA', '1 Year', 'male', 'upload/HIMANSHU  SONI1648782009.jpg'),
(42, 'YUVRAJ SINGH', 'RAM KUMAR SINGH', 'NEELU DEVI', '14353029', '10012250', '20/04/2003', 'ADCA', '1 Year', 'male', 'upload/YUVRAJ SINGH1650343584.jpg'),
(43, 'NITESH KUMAR', 'SURESH KUMAR', 'MEERA DEVI', '14353032', '10012253', '08/05/2004', 'ADCA', '1 Year', 'male', 'upload/NITESH KUMAR1653627802.jpg'),
(44, 'SUDHEER SINGH', 'RAM CHANDRA', 'RAJ KUMARI', '14353033', '10012254', '11/03/1994', 'ADCA', '1 Year', 'male', 'upload/SUDHEER SINGH1653823939.jpg'),
(45, 'GHANSHYAM', 'RAM MOHAN', 'VED RANI', '14353034', '10012256', '05/02/2001', 'ADCA', '1 Year', 'male', 'upload/GHANSHYAM1655952162.jpg'),
(46, 'SACHIN', 'MAHENDRA KUMAR', 'RAJPATI', '14353036', '10012258', '11/02/2002', 'ADCA', '1 Year', 'male', 'upload/SACHIN1655986372.jpg'),
(47, 'SANTOSH KUMAR', 'SUNEEL KUMAR', 'FOOL MATI', '14353037', '10012259', '04/07/1999', 'ADCA', '1 Year', 'male', 'upload/SANTOSH KUMAR1655986825.jpg'),
(48, 'SHIVA  PRAJAPATI', 'LALLU PRASAD', 'LAKKHI', '14353038', '10012260', '15/02/2006', 'ADCA', '1 Year', 'male', 'upload/SHIVA  PRAJAPATI1655987185.jpg'),
(49, 'SHIVNARESH DWIVEDI', 'SIVAKANT DWIVEDI', 'NISHA DWIVEDI', '1197223', '2198723', '29/04/2002', 'TALLY', '6 Months', 'male', 'upload/SHIVNARESH DWIVEDI1656857054.jpg'),
(50, 'SHIVNARESH DWIVEDI', 'SIVAKANT DWIVEDI', 'NISHA DWIVEDI', '14353018', '10012239', '29/04/2002', 'ADCA', '1 Year', 'male', 'upload/SHIVNARESH DWIVEDI1656857272.jpg'),
(51, 'ANIKET KUMAR', 'ASHOK  KUMAR', 'SAROJ DEVI', '14353039', '10012261', '12/10/2005', 'ADCA', '1 Year', 'male', 'upload/ANIKET KUMAR1656936184.jpg'),
(52, 'LAXMIKANT   TRIPATHI', 'SHIVA  KANT', 'SAVITA   TRIPATHI', '14353040', '10012262', '18/10/2006', 'ADCA', '1 Year', 'male', 'upload/LAXMIKANT   TRIPATHI1656936529.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `s_det`
--

CREATE TABLE `s_det` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `s_det`
--

INSERT INTO `s_det` (`id`, `name`, `phone`, `course`, `profile`, `pass`) VALUES
(1, 'Pankaj Mishare', '9648314179', 'DCA', 'photo/.6140623f1f84f8.60642073Pankaj Mishare.png', 'A2ul@fuck'),
(2, 'Rishi kumar tiwari', '9559747752', 'ADCA', 'photo/.61407dc209b1c2.87939015Rishi kumar tiwari.jpg', '1234'),
(3, 'Ramu kumar', '7783926037', 'ADCA', 'photo/.61407e72bfa774.13204766Ramu kumar.jpg', '1234'),
(4, 'Subham shahu', '9335714463', 'ADCA', 'photo/.61407ed677a4d1.10891755Subham shahu.jpg', '1234'),
(5, 'Naim Ahmad', '6386647328', 'ADCA', 'photo/.61407f2976a349.64646285Naim Ahmad.jpg', '1234'),
(6, 'Rashmi Devi', '9506767765', 'ADCA', 'photo/.61407facdd21e7.73059719Rashmi Devi.jpg', '1234'),
(7, 'Sakshi Kesharwani', '9336492269', 'ADCA', 'photo/.614080629f1474.94429451Sakshi Kesharwani.jpg', '1234'),
(8, 'Akhilesh Kumar', '9392098260', 'ADCA', 'photo/.6140810ad52995.68748556Akhilesh Kumar.jpg', '1234'),
(11, 'Pradeep Kumari', '8657048630', 'ADCA', 'photo/.61422585a2f326.91667479Pradeep Kumari.png', 'Fg'),
(12, 'Atul Tiwaree', '8957048630', 'DTP', 'photo/.614425418d7146.27991264Atul Tiwaree.jpg', 'Ff'),
(13, 'Prince Mishra', '8604120922', 'ADCA', 'photo/.61442b95506297.46534712Prince Mishra.jpg', '1234'),
(14, 'Rahul Tiwari', '9511193602', 'ADCA', 'photo/.614d48ae86ea39.70064745Rahul Tiwari.jpg', '1234'),
(15, 'Ayushi verma', '9838028231', 'SELECT COURSE', 'photo/.614d4913346644.49073315Ayushi verma.jpg', '1234'),
(16, 'sachin ', '8545819615', 'ADCA', 'photo/.614d495f77ad55.89055200sachin .jpg', '1234'),
(17, 'Vishnu prasad', '8815944246', 'ADCA', 'photo/.614d49d1723be6.63509197Vishnu prasad.jpg', '1234'),
(18, 'Anjula', '9794688941', 'ADCA', 'photo/.614d4a0b855849.08419725Anjula.jpg', '1234'),
(19, 'Usha devi', '9838754071', 'ADCA', 'photo/.614d4a5440d007.81923456Usha devi.jpg', '1234'),
(20, 'Ravi kumar', '7317363016', 'ADCA', 'photo/.614d4ab9b25051.81478108Ravi kumar.jpg', '1234'),
(21, 'Harshit mishra', '8173964414', 'ADCA', 'photo/.614d4b0e0873a0.84008816Harshit mishra.jpg', '1234'),
(22, 'shiva prajapati', '817234932', 'ADCA', 'photo/.614d4b8bbd8c70.35037375shiva prajapati.jpg', '1234'),
(23, 'umesh kumar', '8956610098', 'ADCA', 'photo/.614d4bda8aac29.02330697umesh kumar.jpg', '1234'),
(24, 'shiv kumar', '8601653550', 'ADCA', 'photo/.614d4c42ad6f88.93784079shiv kumar.jpg', '1234'),
(25, 'Aunj saroj', '7752856272', 'ADCA', 'photo/.614d4c92b13382.06380558Aunj saroj.jpg', '1234'),
(26, 'Sachin pal', '7080039516', 'ADCA', 'photo/.614d4cdc017f33.29898159Sachin pal.jpg', '1234'),
(27, 'Yuvraj singh', '7028223690', 'ADCA', 'photo/.614d4d3424bef6.63045489Yuvraj singh.jpg', '1234'),
(28, 'Satendra kumar', '9919154163', 'ADCA', 'photo/.614d4da8b06678.12102975Satendra kumar.jpg', '1234'),
(29, 'VIMLA DEVI', '6394413287', 'ADCA', 'photo/.614d4e09824e80.91627205VIMLA DEVI.jpg', '1234'),
(30, 'Mithlesh kumar', '9628767808', 'ADCA', 'photo/.614d4e5c3fe5f9.99922996Mithlesh kumar.jpg', '1234'),
(31, 'Neeraj yadav', '752301620', 'ADCA', 'photo/.614d4ed31d92b9.92344655Neeraj yadav.jpg', '1234'),
(32, 'Anshika singh', '6306208702', 'ADCA', 'photo/.614d4f6456c760.32538984Anshika singh.jpg', '1234'),
(33, 'Abhiraj', '8960946241', 'ADCA', 'photo/.614d4fdb364eb9.46597809Abhiraj.jpg', '1234'),
(34, 'Prveen kumar', '8081643474', 'ADCA', 'photo/.614d512e47d527.70262161Prveen kumar.jpg', '1234'),
(35, 'Anushka ', '9118886062', 'ADCA', 'photo/.614d51adf09984.42399078Anushka .jpg', '1234'),
(36, 'Sangeeta Devi', '7275360833', 'ADCA', 'photo/.614d5234a38a47.24370457Sangeeta Devi.jpg', '1234'),
(37, 'Shalu', '8303276470', 'ADCA', 'photo/.614d527b3af2e2.17759055Shalu.jpg', '1234'),
(38, 'Deen dayal ', '9580468990', 'ADCA', 'photo/.614d52c4dcf587.47608944Deen dayal .jpg', '1234'),
(39, 'Aryan singh', '9569436806', 'ADCA', 'photo/.614d53564a6697.87951753Aryan singh.jpg', '1234'),
(40, 'Rishi kumar', '6392098260', 'ADCA', 'photo/.614d53b26d54c8.21970479Rishi kumar.jpg', '1234'),
(41, 'Vineet paday', '9651414586', 'ADCA', 'photo/.614d5444942c04.58895379Vineet paday.jpg', '1234'),
(42, 'Ram keshan ', '7460066830', 'ADCA', 'photo/.614d55e929d614.18746856Ram keshan .jpg', '1234'),
(43, 'Chhat pal rajpoot', '8950396098', 'ADCA', 'photo/.614d56d44d23b0.88032504Chhat pal rajpoot.jpg', '1234'),
(44, 'Varsha modanwal', '8081574007', 'ADCA', 'photo/.614d5843a9b640.17517841Varsha modanwal.jpg', '1234'),
(45, 'Hsrsh tripathi', '8090383295', 'ADCA', 'photo/.614d590a297500.09458374Hsrsh tripathi.jpg', '1234'),
(46, 'shivam yada', '6203273093', 'ADCA', 'photo/.614d5a3d3b9c88.18616239shivam yada.jpg', '1234'),
(47, '', '', 'SELECT COURSE', 'photo/.621753bb4b4034.84925949.php', ''),
(48, '', '', 'SELECT COURSE', 'photo/.6244f4d1c730a7.05700541.php', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_adm`
--
ALTER TABLE `s_adm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_cer_det`
--
ALTER TABLE `s_cer_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_det`
--
ALTER TABLE `s_det`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `s_adm`
--
ALTER TABLE `s_adm`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `s_cer_det`
--
ALTER TABLE `s_cer_det`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `s_det`
--
ALTER TABLE `s_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
