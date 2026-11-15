<?php
require_once __DIR__ . '/../connection.php';

// Data from /Users/giniedigital/Downloads/stoodooc_scait.sql (Exported from cPanel phpMyAdmin)
$cpanel_s_adm = [
    [1, 'Shshai kasera', '6307628891', 'Sirathu '],
    [2, 'Abc', '1234567890', 'Gsgsv s '],
    [3, 'abbba', '12345667778', 'dsfsdfs'],
    [4, 'Atul TIWARI', '8957048630', 'Ramesh'],
    [5, 'Amit pal', '9956598563', 'Punvar paschim Sarita kaushambi'],
    [6, 'Santosh Kumar', '9369291244', 'Punvar paschim Sarira kaushambi'],
    [7, 'Santosh Kumar', '9369291244', 'Punwar pashchim Sarira kaushambi'],
    [8, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'],
    [9, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'],
    [10, 'Ankur Mishr', '9170576766', 'Dever manshanpur. Kauhambi'],
    [11, 'Atul tiwaree', '8957048639', 'Rampur dhamawan sirathu Kaushambi '],
    [12, 'Atul tiwaree', '8957048639', 'Rampur dhamawan sirathu Kaushambi '],
    [13, 'Ramu kumar', '7783926037', 'Sarsawan'],
    [14, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'],
    [15, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'],
    [16, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'],
    [17, 'KM SHUBHI SHUKLA', '7080385531', 'PURA NIDHU LUXMIGANJ'],
    [18, 'KM SHUBHI SHUKLA', '7080385531', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'],
    [19, 'KM SHUBHI SHUKLA', '6392497030', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'],
    [20, 'KM SHUBHI SHUKLA', '9455070569', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'],
    [21, 'KM SHUBHI SHUKLA', '8303724047', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'],
    [22, 'KM SHUBHI SHUKLA', '8303724047', 'PURE NIDHU LUXMIGANJ UNCHAHAR RAEBARALI'],
    [23, 'KM SHUBHI SHUKLA ', '8303724047', 'PURE NIDHAU AHARI BUGURAJ LUXMIGANJ '],
    [24, 'mnn', '7767679879', 'y8y8'],
    [25, 'Laxmikant tripathi', '9125003585', 'Paur'],
    [26, 'Himanshu soni', '9569165079', 'Hinauta kaushambi'],
    [27, 'Sachin Pandey', '9305072883', 'Village Uno Post Sarswan Subdistrict Manjhanpur District Kaushambi'],
    [28, '1001223', '9506767795', 'Kumhiyawan kaushambi'],
    [29, 'Sachin ', '8545819615', 'Kantipar'],
    [30, 'AKASh', '9580848558', 'Jajauli'],
    [31, 'Mohit ', '8795715325', 'Ram Charan ka Pura '],
    [32, 'manya ', '8817608144', 'nahstan'],
    [33, 'Ashish Kumar ', '9565473481', 'Teva'],
    [34, 'Suneel Kumar ', '7458025443', 'Sarsawan '],
    [35, 'Jatin kesharwani', '9919583033', 'Te2a'],
    [36, 'Jatin kesharwani', '9919583033', 'Te2'],
    [37, 'Jatin kesharwani', '9919583033', 'Te2'],
    [38, 'Youraj singh', '9792994743', 'Pashchim sharira'],
    [39, 'Youraj singh', '9792994743', 'Pashchim sharira'],
    [40, 'Sachin kumar', '9918492892', 'Shiwara'],
    [41, 'Rajesh Kumar ', '6387303562', 'Jajauli '],
    [42, 'Rajesh Kumar ', '6387303562', 'Jajauli '],
    [43, 'Shubh', '8932072261', 'Tewa Manjhanpur Kaushambi'],
    [44, 'Shubh', '8932072261', 'Tewa Manjhanpur Kaushambi'],
    [45, 'Ankit chaudhari', '8115081861', 'Tewa'],
    [46, 'govind  prasad', '7318427120', 'machhauli post jafarpur mahawa karari kaushambi'],
    [47, 'Jitendra Kumar ', '9648100627', 'Nijampur hadhi'],
    [48, 'Atul singh ', '6306723492', 'Adhouli '],
    [49, 'Govind Prasad', '7318427120', 'Paschim Sharira'],
    [50, 'Subhash singh ', '8756698101', 'Sarsawan manjhanpur Kaushambi '],
    [51, 'Govind Prasad ', '7318427120', 'Tewa'],
    [52, 'Manjee singh', '9170428336', 'Noorpur hazipur kaushambi '],
    [53, 'deepu saroj', '6390472343', 'baraisa manjhanpur kaushambi'],
    [54, 'deepu saroj', '6390472343', 'baraisa manjhanpur kaushambi'],
    [55, 'deepu saroj', '6390472343', 'baraisa manjhanpur kaushambiambi'],
    [56, 'deepu saroj', '6390472343', 'Tewa Kaushambi U.P'],
    [57, 'Krushna ingle', '7875402658', 'Krushna ingle'],
    [58, 'Pooja devi', '7275683669', 'Sarsawan ']
];

$cpanel_s_cer_det = [
    [1, 'SUDEER KUMAR', 'CHHEDI LAL', 'GIRJA DEVI', '1435302', '1001215', '07-07-2001', 'ADCA', '1 Year', 'male', 'upload/Atul Tiwaree1632853719.jpg'],
    [2, 'SHIVBABU', 'HARISHCHANDRA ', 'SHAKUNTLA DEVI', '1435303', '1001216', '10-06-2002', 'ADCA', '1 Year', 'male', 'upload/Atul1632974184.jpg'],
    [4, 'RAMU KUMAR', 'CHAGGU', 'FHUL KUMARI', '1435307', '1001220', '03-12-2005', 'ADCA', '1 Year', 'male', ''],
    [7, 'SHUBHAM SAHU', 'GULAB CHANDRA SAHU', 'RENU DEVI', '1425308', '1001221', '10-03-2005', 'ADCA', '1 Year', 'male', ''],
    [9, 'ABHISHEK', 'RAJ KUMAR TIWARI', 'UMA DEVI', '1435305', '1001218', '26-06-2001', 'ADCA', '1 Year', 'male', ''],
    [10, 'NAIM AHMAD', 'SHARIF AHMAD', 'WFATUN NISA', '1435309', '1001222', '01-071996', 'ADCA', '1 Year', 'male', ''],
    [11, 'MAHENDRA KUMAR CHAURASIYA', 'RAM NIHORE CHAURASIYA', 'CHAMPA DEVI', '14353013', '10012236', '11-09-1998', 'ADCA', '1 Year', 'male', ''],
    [12, 'AKASH CHAURASIYA', 'ASHOK KUMAR', 'VITTAN DEVI', '14353012', '10012235', '04-05-2001', 'ADCA', '1 Year', 'male', ''],
    [22, 'VARSHA MODANWAL', 'DINESH  KUMAR GUPTA', 'REENA DEVI GUPTA', '14353015', '10012237', '03/07/2003', 'ADCA', '1 Year', 'female', 'upload/VARSHA MODANWAL1635757534.jpg'],
    [31, 'KM SHUBHI SHUKLA', 'AJAY KUMAR', 'ARCHANA SHUKLA', '14353021', '10012242', '10/06/2002', 'ADCA', '1 Year', 'female', 'upload/KM SHUBHI SHUKLA1642140300.jpg'],
    [32, 'SAKSHI KESHARWANI', 'BHAGWAN DAS KESHARWANI', 'RITA DEVI', '1435011', '10012234', '15/10/2003', 'ADCA', '1 Year', 'female', 'upload/SAKSHI KESHARWANI1642341617.jpg'],
    [33, 'RASHMI DEVI', 'MAHESH KUMAR JAYSAWAL', 'SANGITA DEVI', '14353010', '1001223', '18/08/2003', 'ADCA', '1 Year', 'female', 'upload/RASHMI DEVI1642341766.jpg'],
    [34, 'RAMU  KUMAR', 'CHHANGGU', 'PHOOL KUMARI', '14353019', '10012240', '03/12/2005', 'ADCA', '1 Year', 'male', 'upload/RAMU  KUMAR1642821362.jpg'],
    [37, 'SANGEETA DEVI', 'FOOL CHANDRA ', 'URMILA DEVI', '14353027', '10012248', '01/03/2003', 'ADCA', '1 Year', 'female', 'upload/SANGEETA DEVI1646389069.jpg'],
    [38, 'PRADEEP  KUMAR', 'SAMPAT  LAL ', 'CHHOTAKI  DEVI', '14353028', '10012249', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/PRADEEP  KUMAR1647007504.jpg'],
    [39, 'AMIT KUMAR', 'UMESH CHANDRA', 'KALPANA DEVI', '14353026', '10012247', '12/09/2000', 'ADCA', '1 Year', 'male', 'upload/AMIT KUMAR1648309117.jpg'],
    [40, 'SONU KUMAR', 'JAGAT PAL', 'RAJKALI', '14353030', '10012251', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/SONU KUMAR1648781649.jpg'],
    [41, 'HIMANSHU  SONI', 'ASHOK KUMAR  SONI', 'SONAM  SONI', '14353031', '14353031', '24/04/2003', 'ADCA', '1 Year', 'male', 'upload/HIMANSHU  SONI1648782009.jpg'],
    [42, 'YUVRAJ SINGH', 'RAM KUMAR SINGH', 'NEELU DEVI', '14353029', '10012250', '20/04/2003', 'ADCA', '1 Year', 'male', 'upload/YUVRAJ SINGH1650343584.jpg'],
    [43, 'NITESH KUMAR', 'SURESH KUMAR', 'MEERA DEVI', '14353032', '10012253', '08/05/2004', 'ADCA', '1 Year', 'male', 'upload/NITESH KUMAR1653627802.jpg'],
    [44, 'SUDHEER SINGH', 'RAM CHANDRA', 'RAJ KUMARI', '14353033', '10012254', '11/03/1994', 'ADCA', '1 Year', 'male', 'upload/SUDHEER SINGH1653823939.jpg'],
    [45, 'GHANSHYAM', 'RAM MOHAN', 'VED RANI', '14353034', '10012256', '05/02/2001', 'ADCA', '1 Year', 'male', 'upload/GHANSHYAM1655952162.jpg'],
    [46, 'SACHIN', 'MAHENDRA KUMAR', 'RAJPATI', '14353036', '10012258', '11/02/2002', 'ADCA', '1 Year', 'male', 'upload/SACHIN1655986372.jpg'],
    [47, 'SANTOSH KUMAR', 'SUNEEL KUMAR', 'FOOL MATI', '14353037', '10012259', '04/07/1999', 'ADCA', '1 Year', 'male', 'upload/SANTOSH KUMAR1655986825.jpg'],
    [48, 'SHIVA  PRAJAPATI', 'LALLU PRASAD', 'LAKKHI', '14353038', '10012260', '15/02/2006', 'ADCA', '1 Year', 'male', 'upload/SHIVA  PRAJAPATI1655987185.jpg'],
    [49, 'SHIVNARESH DWIVEDI', 'SIVAKANT DWIVEDI', 'NISHA DWIVEDI', '1197223', '2198723', '29/04/2002', 'TALLY', '6 Months', 'male', 'upload/SHIVNARESH DWIVEDI1656857054.jpg'],
    [50, 'SHIVNARESH DWIVEDI', 'SIVAKANT DWIVEDI', 'NISHA DWIVEDI', '14353018', '10012239', '29/04/2002', 'ADCA', '1 Year', 'male', 'upload/SHIVNARESH DWIVEDI1656857272.jpg'],
    [51, 'ANIKET KUMAR', 'ASHOK  KUMAR', 'SAROJ DEVI', '14353039', '10012261', '12/10/2005', 'ADCA', '1 Year', 'male', 'upload/ANIKET KUMAR1656936184.jpg'],
    [52, 'LAXMIKANT   TRIPATHI', 'SHIVA  KANT', 'SAVITA   TRIPATHI', '14353040', '10012262', '18/10/2006', 'ADCA', '1 Year', 'male', 'upload/LAXMIKANT   TRIPATHI1656936529.jpg'],
    [54, 'SONAKSHI GAUTAM', 'INDRA  PAL', 'ROOP RANI ', '14353042', '10012264', '08/06/2000', 'ADCA', '1 Year', 'female', 'upload/SONAKSHI GAUTAM1661742906.jpg'],
    [55, 'USHA  DEVI', 'RAMBABU MAURYA ', 'KANTI DEVI', '14353046', '10012266', '01/02/2004', 'ADCA', '1 Year', 'female', 'upload/USHA  DEVI1662002834.jpg'],
    [56, 'ANJULA', 'BALRAM', 'GYANMATI', '14353045', '10012265', '18/06/1999', 'ADCA', '1 Year', 'female', 'upload/ANJULA1662002988.jpg'],
    [57, 'HARSH TRIPATHI', 'SANJEEV KUMAR TRIPAATHI', 'ARTI DEVI', '14353041', '10012263', '25/09/2005', 'ADCA', '1 Year', 'male', 'upload/HARSH TRIPATHI1662003150.jpg'],
    [60, 'HARI OM DWIVEDI', 'GOVIND PRASAD DWIVEDI', 'KANCHAN DEIVEDI', '14353023', '10012244', '18/06/2002', 'ADCA', '1 Year', 'male', 'upload/HARI OM DWIVEDI1663064825.jpg'],
    [61, 'RAMESH  KUMAR', 'CHUNNA  LAL  MAURYA ', 'KESHPATI', '14353047', '10012267', '01/01/1996', 'ADCA', '1 Year', 'male', 'upload/RAMESH  KUMAR1663243255.jpg'],
    [62, 'ASHISH KUMAR', 'DINAI LAL', 'ANGANI DEVI', '14353049', '10012269', '26/10/2003', 'ADCA', '1 Year', 'male', 'upload/ASHISH KUMAR1663565101.jpg'],
    [63, 'ASHA DEVI', 'RAM BADAN', 'PHOOL KALI', '1435056', '10012276', '02/05/1998', 'ADCA', '1 Year', 'female', 'upload/ASHA DEVI1665808130.jpg'],
    [64, 'DIVYA MISHRA', 'RAJENDRA KUMAR MISHRA', 'GODAVALI DEVI', '14353057', '10012277', '20/07/2002', 'ADCA', '1 Year', 'female', 'upload/DIVYA MISHRA1665808273.jpg'],
    [65, 'AKASH', 'SANTOSH KUMAR', 'KESHRANI', '1435058', '10012278', '10/09/2002', 'ADCA', '1 Year', 'female', 'upload/AKASH1665808368.jpg'],
    [66, 'PRANJAL SRIVASTAVA', 'RAJENDRA PRASAD SRIVASTAVA', 'NEETA SRIVASTAVA', '14353060', '10012280', '29/05/2001', 'ADCA', '1 Year', 'female', 'upload/PRANJAL SRIVASTAVA1665808588.jpg'],
    [67, 'ANUSHKA', 'PURSHOTTAM', 'RANNO DEVI', '14353055', '10012275', '20/082002', 'ADCA', '1 Year', 'female', 'upload/ANUSHKA1665808689.jpg'],
    [68, 'SAPNA DEVI', 'KALLOO PRASAD', 'SHANTI DEVI', '14353064', '10012284', '18/07/1999', 'ADCA', '1 Year', 'female', 'upload/SAPNA DEVI1665809039.jpg'],
    [69, 'VIGYA TRIPATHI ', 'NIJANAND', 'GOMTI DEVI', '14353063', '10012283', '24/10/2005', 'ADCA', '1 Year', 'female', 'upload/VIGYA TRIPATHI 1665809192.jpg'],
    [70, 'KAJAL KUMAREE', 'SHIV PRATAP', 'ARATI DEVI', '14353062', '10012282', '15/10/2007', 'ADCA', '1 Year', 'female', 'upload/KAJAL KUMAREE1665809285.jpg'],
    [71, 'RITANSHI DEVI', 'RAJENDRA KUMAR', 'MAMTA DEVI', '14353061', '10012281', '18/05/2007', 'ADCA', '1 Year', 'female', 'upload/RITANSHI DEVI1665809466.jpg'],
    [72, 'PRADYUMNA NARAYAN', 'MANOJ KUMAR', 'MAYA DEVI', '14353065', '10012285', '16/12/2003', 'ADCA', '1 Year', 'female', 'upload/PRADYUMNA NARAYAN1665809654.jpg'],
    [73, 'AYUSH KESHARWANI', 'VINDO KUMAR KEAHARWANI', 'SONI DEVI KESHARWANI', '14353059', '10012279', '17/10/2006', 'ADCA', '1 Year', 'male', 'upload/AYUSH KESHARWANI1665809789.jpg'],
    [74, 'SHWETA ', 'PURSHOTTAM JAISWAL', 'RANNO DEVI', '14353054', '10012274', '31/12/1999', 'ADCA', '1 Year', 'female', 'upload/SHWETA 1665809903.jpg'],
    [75, 'SATEESH KUMAR', 'PURSHOTTAM LAL', 'GAYATRI DEVI', '14353053', '10012273', '30/10/2003', 'ADCA', '1 Year', 'male', 'upload/SATEESH KUMAR1665810019.jpg'],
    [76, 'PRAMOD KUMAR', 'DILIP KUMAR', 'SOMWATI ', '14353052', '10012272', '15/11/1997', 'ADCA', '1 Year', 'male', 'upload/PRAMOD KUMAR1665810147.jpg'],
    [77, 'ABHAY SHUKLA', 'CHANDRA SHEKHAR SHUKLA', 'ANJU SHUKLA', '14353051', '10012271', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/ABHAY SHUKLA1665810487.jpg'],
    [78, 'ARTI  DEVI ', 'RAMAPATI   SHUKLA', 'SUSHMA  SHUKLA', '12353065', '10013285', '31/07/1989', 'TYPING', 'Select Duration', 'female', 'upload/ARTI  DEVI 1665910365.jpg'],
    [79, 'RAHUL', 'RAJENDRA PRASAD DWIVEDI', 'POONAM DEVI', '14353024', '10012245', '05/07/2004', 'ADCA', '1 Year', 'male', 'upload/RAHUL1667013065.jpg'],
    [80, 'ADARSH PRATAP SINGH ', 'ARVIND SINGH', 'RITA SINGH', '14353066', '10012286', '15/01/2002', 'ADCA', '1 Year', 'male', 'upload/ADARSH PRATAP SINGH 1667905804.jpg'],
    [81, 'ANSHIKA MISHRA ', 'KAUSHLENDRA KUMAR MISHRA', 'SHIV DEVI', '14353067', '10012287', '04/05/2005', 'ADCA', '1 Year', 'female', 'upload/ANSHIKA MISHRA 1667906184.jpg'],
    [82, 'MANJAY  KUMAR', 'RAKESH KUMAR', 'KALAWATI  DEVI', '14353071', '10012291', '11/08/2005', 'ADCA', '1 Year', 'male', 'upload/MANJAY  KUMAR1668234064.jpg'],
    [83, 'MANJAY  KUMAR', 'RAKESH KUMAR', 'KALAWATI  DEVI', '14353071', '10012291', '11/08/2005', 'ADCA', '1 Year', 'male', 'upload/MANJAY  KUMAR1668234065.jpg'],
    [84, 'AMAR  JEET ', 'CHHOTE LAL', 'SUMAN DEVI', '14353072', '10012292', '12/07/2003', 'ADCA', '1 Year', 'male', 'upload/AMAR  JEET 1670053573.jpg'],
    [85, 'CHHATRAPAL RAJPOOT ', 'BRIJ LAL', 'GOMATI DEVI', '14353073', '10012293', '17/06/2006', 'ADCA', '1 Year', 'male', 'upload/CHHATRAPAL RAJPOOT 1671087097.jpg'],
    [86, 'NAGESHVAR NATH SINGH ', 'LAXMI KANT SINGH', 'GITA DEVI', '14353074', '10012294', '01/05/2009', 'ADCA', '1 Year', 'male', 'upload/NAGESHVAR NATH SINGH 1671087566.jpg'],
    [87, 'MOHIT KUMAR', 'PANCHAM LAL', 'KUSUM ', '14353076', '10012296', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/MOHIT KUMAR1676461201.jpg'],
    [88, 'MITHLESH KUMAR', 'GAYA PRASAD ', 'GAYATRI DEVI', '14353078', '10012298', '25/03/2007', 'ADCA', '1 Year', 'male', 'upload/MITHLESH KUMAR1677467038.jpg'],
    [89, 'ADITYA SINGH CHAUHAN', 'BEERENDRA SINGH', 'NEELAM SINGH', '14353079', '10012299', '08/03/2001', 'ADCA', '1 Year', 'male', 'upload/ADITYA SINGH CHAUHAN1677495845.jpg'],
    [90, 'JAY NARAYAN', 'BRIJESH MAURYA', 'KAILASHIYA DEVI', '14353080', '10012300', '13/07/2002', 'ADCA', '1 Year', 'male', 'upload/JAY NARAYAN1677496412.jpg'],
    [91, 'ASHUTOSH MISHRA', 'KAMALA KANT MISHRA', 'RENU DEVI', '14353022', '10012243', '25/07/2003', 'ADCA', '1 Year', 'male', 'upload/ASHUTOSH MISHRA1677842771.jpg'],
    [92, 'ASHISH KUMAR', 'HARI BACHCHA', 'SARITA DEVI', '12353066', '10013286', '25/10/2000', 'TYPING', '6 Months', 'male', 'upload/ASHISH KUMAR1678852152.jpg'],
    [93, 'SAKSHI KESHAWANI', 'AJAY KUMAR', 'ARCHANA DEVI', '14353082', '10012302', '05/05/1997', 'ADCA', '1 Year', 'female', 'upload/SAKSHI KESHAWANI1679712872.jpg'],
    [94, 'ARCHANA DEVI', 'KIRSHNA OJHA', 'KANTI DEVI', '14353083', '10012303', '03/07/2004', 'ADCA', '1 Year', 'female', 'upload/ARCHANA DEVI1679714336.jpg'],
    [95, 'SADHANA DEVI', 'DILEEP KUMAR', 'RANI DEVI', '14353084', '10012304', '12/09/2003', 'ADCA', '1 Year', 'male', 'upload/SADHANA DEVI1680061113.jpg'],
    [96, 'AYUSHI DEVI', 'ADITYA  NARAYAN', 'SADHANA DEVI', '14353085', '10012305', '01/11/2003', 'ADCA', '1 Year', 'female', 'upload/AYUSHI DEVI1680064226.jpg'],
    [97, 'LALITA DEVI', 'SHIV  MOHAN', 'RAM RATI DEVI', '14353086', '10012306', '01/01/1995', 'ADCA', '1 Year', 'female', 'upload/LALITA DEVI1680231877.jpg'],
    [99, 'RAVAT  KUMAR', 'CHANDRA  PAL', 'URMILA DEVI', '14353088', '10012308', '06/07/2003', 'ADCA', '1 Year', 'male', 'upload/RAVAT  KUMAR1680232846.jpg'],
    [100, 'SADHANA DEVI', 'DILEEP KUMAR', 'RANI DEVI', '1197224', '2198725', '12/09/2003', 'TALLY', '6 Months', 'female', 'upload/SADHANA DEVI1680946447.jpg'],
    [101, 'AYUSHI DEVI', 'ADITYA NARAYAN', 'SADHANA DEVI', '1197225', '2198726', '01/11/2003', 'TALLY', '6 Months', 'female', 'upload/AYUSHI DEVI1680946753.jpg'],
    [102, 'SANDEEP SINGH', 'AMAR SINGH', 'USHA DEVI', '14353081', '10012301', '08/07/2005', 'ADCA', '1 Year', 'male', 'upload/SANDEEP SINGH1681192343.jpg'],
    [103, 'RAJ NARAYAN PANDEY', 'DINESH PANDEY', 'VIDYA DEVI', '14353089', '10012309', '05/07/2005', 'ADCA', '1 Year', 'male', 'upload/RAJ NARAYAN PANDEY1681975345.jpg'],
    [104, 'RAMSUMIT  TIWARI', 'KAUSHAL TIWARI', 'SANJU DEVI', '14353090', '10012310', '02/06/2007', 'ADCA', '1 Year', 'male', 'upload/RAMSUMIT  TIWARI1681976859.jpg'],
    [105, 'Simran', 'Random Father', 'Random mother', '78678976', '2010344', '12-May-2002', 'ADCA', '6 Months', 'male', 'upload/Simran1683009645.jpg'],
    [106, 'PRIYA DEVI', 'DILIP  KUMAR', 'RANI DEVI', '14353080', '10012307', '24/05/2004', 'ADCA', '1 Year', 'female', 'upload/PRIYA DEVI1684136112.jpg'],
    [107, 'ISHTIKHAR AHMAD', 'RASUL AHMAD', 'SAYDA BEGAM', '14353092', '10012312', '01/01/2006', 'ADCA', '1 Year', 'male', 'upload/ISHTIKHAR AHMAD1684815262.jpg'],
    [108, 'VIVEK KUMAR', 'BHUBHRAM', 'ASHA DEVI', '14353091', '10012311', '01/01/2006', 'ADCA', '1 Year', 'male', 'upload/VIVEK KUMAR1684815386.jpg'],
    [109, 'NAVYA  DEVI', 'SHRAVAN  KUMAR  MISHRA', 'PRABHAWATI  DEVI', '14353093', '10012313', '24/06/2006', 'ADCA', '1 Year', 'female', 'upload/NAVYA  DEVI1685333359.jpg'],
    [110, 'SHIVAM KESHARWANI', 'SATISH CHANDRA KESHARWANI', 'PUSHPA DEVI', '14354001', '10012320', '01/06/2005', 'ADCA', '1 Year', 'Select Gender', 'upload/SHIVAM KESHARWANI1689138556.jpg'],
    [111, 'ANUJ KUMAR', 'RAMASHANKAR', 'SAROJ DEVI', '14354007', '10012323', '02/05/2006', 'ADCA', '1 Year', 'male', 'upload/ANUJ KUMAR1691495479.jpg'],
    [112, 'SANDEEP KUMAR', 'KESHLAL', 'SUMITA DEVI', '14354006', '10012322', '01/01/2004', 'ADCA', '1 Year', 'male', 'upload/SANDEEP KUMAR1691495603.jpg'],
    [113, 'Sujal panday', 'Pratigyeshver panday', 'Savita panday', '1197226', '2198727', '20/08/2004', 'TALLY', '6 Months', 'male', 'upload/Sujal panday1694497090.jpg'],
    [114, 'Sujal panday', 'Pratigyeshver panday', 'Savita panday', '1197226', '2198727', '20/08/2004', 'TALLY', '6 Months', 'male', 'upload/Sujal panday1694497442.jpg'],
    [115, 'Rani', 'Raj', 'Savita', '1197225', '2198620', '10/4/2005', 'TALLY', '6 Months', 'male', 'upload/Rani1694497660.jpg'],
    [116, 'PRAVESH KUMAR', 'GYAN PRAKASH', 'SUNITA DEVI', '14354011', '10012327', '21/07/1998', 'ADCA', '1 Year', 'male', 'upload/PRAVESH KUMAR1696314847.jpg'],
    [117, 'RADHA SINGH', 'PHOOL SINGH', 'KALPANA SINGH', '14354012', '10012328', '27/07/2003', 'ADCA', '1 Year', 'female', 'upload/RADHA SINGH1697702585.jpg'],
    [118, 'KHUSHI AGRAHARI', 'DILEEP CHANDRA', 'MENKA DEVI', '14354013', '10012329', '04/08/2004', 'ADCA', '1 Year', 'female', 'upload/KHUSHI AGRAHARI1700220619.jpg'],
    [119, 'DIVYA DEVI', 'SHRAWAN KUMAR', 'PRABHAWATI', '14354015', '10012331', '01/06/2003', 'ADCA', '1 Year', 'female', 'upload/DIVYA DEVI1703050553.jpg'],
    [120, 'SUNEEL KUMAR', 'RAM LAL', 'SUMITRA DEVI', '14354016', '10012332', '22/08/2006', 'ADCA', '1 Year', 'male', 'upload/SUNEEL KUMAR1703062592.jpg'],
    [121, 'AKSHAY PAL', 'CHANDRA SHEKHAR', 'MAYA DEVI', '14354023', '10012339', '12/05/2003', 'ADCA', '1 Year', 'male', 'upload/AKSHAY PAL1706353270.jpg'],
    [122, 'AKSHAY PAL', 'CHANDRA SHEKHAR', 'MAYA DEVI', '14354023', '10012339', '12/05/2003', 'ADCA', '1 Year', 'male', 'upload/AKSHAY PAL1706353702.jpg'],
    [123, 'ANJALI DEVI', 'RAMBABOO', 'RANNO DEVI', '14354025', '10012340', '02/07/1994', 'ADCA', '1 Year', 'female', 'upload/ANJALI DEVI1707304573.jpg'],
    [124, 'PAWAN KUMAR', 'NANHU PRASAD', 'INDRA KALI', '1197228', '2198723', '28/11/1993', 'TALLY', '6 Months', 'male', 'upload/PAWAN KUMAR1709021749.jpg'],
    [125, 'PAWAN KUMAR', 'NANHU PRASAD', 'INDRA KALI', '1197228', '2198729', '28/11/1993', 'TALLY', '6 Months', 'male', 'upload/PAWAN KUMAR1709021946.jpg'],
    [126, 'POOJA DEVI', 'RAM PRASAD', 'SARSWATI DEVI', '14354029', '10012344', '03/06/2001', 'ADCA', '1 Year', 'female', 'upload/POOJA DEVI1711794128.jpg'],
    [127, 'SALONI', 'LAVLESH KUMAR', 'SIMA DEVI', '14354030', '10012345', '10/10/2006', 'ADCA', '1 Year', 'female', 'upload/SALONI1711794761.jpg'],
    [128, 'REVATI RAMAN SHUKLA', 'RADHE SHYAM SHUKLA', 'MEENA SHUKLA	', '14354031', '10012346', '03/07/2002', 'ADCA', '1 Year', 'male', 'upload/REVATI RAMAN SHUKLA1711795194.jpg'],
    [129, 'PRASUN SINGH', 'MAYANK SINGH', 'MANJU SINGH', '14354032', '10012347', '21/07/2006', 'ADCA', '1 Year', 'male', 'upload/PRASUN SINGH1711795527.jpg'],
    [130, 'SOMESH MISHRA', 'RAMA  SHANKAR  MISHRA', 'KIRAN MISHRA', '14354034', '10012349', '26/12/2005', 'ADCA', '1 Year', 'male', 'upload/SOMESH MISHRA1714647094.jpg'],
    [131, 'ANOOP KUMAR', 'RAMMOORAT', 'SHIV DEVI', '14354035', '10012350', '13/09/2006', 'ADCA', '1 Year', 'male', 'upload/ANOOP KUMAR1714707233.jpg'],
    [132, 'SACHIN PAL', 'JAG MOHAN PAL', 'RANI DEVI', '14354036', '10012351', '10/10/2006', 'ADCA', '1 Year', 'male', 'upload/SACHIN PAL1715051865.jpg'],
    [133, 'SACHIN KUMAR', 'DUKH PAL', 'KAMALA DEVI', '4354037', '10012352', '03/02/2003', 'ADCA', '1 Year', 'male', 'upload/SACHIN KUMAR1715312728.jpg'],
    [136, 'SHIVAM OJHA', 'SHIVAKANT OJHA', 'MANORMA DEVI', '14354038', '10012353', '12/12/2004', 'ADCA', '1 Year', 'male', 'upload/SHIVAM OJHA1715665544.jpg'],
    [137, 'SHIKHA DEVI', 'DHIRENDRA SINGH', 'MADHU DEVI', '14354039', '10012354', '10/03/2007', 'ADCA', '1 Year', 'female', 'upload/SHIKHA DEVI1716615700.jpg'],
    [138, 'YOURAJ SINGH', 'SAHADEV', 'NIRMALA DEVI', '14354042', '10012357', '12/05/2006', 'ADCA', '1 Year', 'male', 'upload/YOURAJ SINGH1718354339.jpg'],
    [139, 'NITIN KUMAR', 'MADAN PAL', 'SHOBHA DEVI', '14354042', '10012355', '21-10-2007', 'ADCA', '1 Year', 'male', 'upload/NITIN KUMAR1718354532.jpg'],
    [140, 'JATIN KESHARWANI', 'RAHESH KUMAR', 'SONI DEVI', '14354041', '10012356', '1-1-2008', 'ADCA', '1 Year', 'male', 'upload/JATIN KESHARWANI1718354715.jpg'],
    [141, 'SHIVAM KUMAR PAL', 'RAJU PAL', 'SANGEETA  DEVI', '14354043', '10012358', '10/06/2013', 'ADCA', '1 Year', 'male', 'upload/SHIVAM KUMAR PAL1718355028.jpg'],
    [142, 'JITENDRA KUMAR ', 'GIDHARI  LAL', 'KUSHMA  DEVI', '14354044', '10012359', '01/01/2009', 'ADCA', '1 Year', 'male', 'upload/JITENDRA KUMAR 1718355631.jpg'],
    [143, 'Mohd Ayub ', 'Nasir Khan ', 'Juveda Khatun', '14354045', '10012359', '01/05/1987', 'ADCA', '1 Year', 'male', 'upload/Mohd Ayub 1718880401.jpg'],
    [144, 'Mohd Ayub ', 'Nasir Khan ', 'Juveda Khatun', '14354046', '10012362', '01/05/1987', 'ADCA', '1 Year', 'male', 'upload/Mohd Ayub 1718880599.jpg'],
    [145, 'GOVIND SHUKLA', 'CHINTAMANI', 'ANEETA DEVI', '14354048', '10012364', '10/03/2006', 'ADCA', '1 Year', 'male', 'upload/GOVIND SHUKLA1719990365.jpg'],
    [146, 'RAJ KUMAR', 'SHIVBARAN', 'URMILA  DEVI', '14354049', '10012365', '06/08/2007', 'ADCA', '1 Year', 'male', 'upload/RAJ KUMAR1720000397.jpg'],
    [147, 'ANKIT KUMAAR', 'NOKHELAL', 'AMRAWATI', '14354047', '10012363', '08/10/2008', 'ADCA', '1 Year', 'male', 'upload/ANKIT KUMAAR1720003014.jpg'],
    [148, 'RAJESH KUMAR', 'RAM DEEN', 'SAROJ DEVI', '1435026', '10012341', '15/07/2002', 'ADCA', '1 Year', 'male', 'upload/RAJESH KUMAR1720003168.jpg'],
    [149, 'ANOOP KUMAR', 'RAM KISHUN', 'SUNITA DEVI', '14354050', '10012366', '07/04/2008', 'ADCA', '1 Year', 'male', 'upload/ANOOP KUMAR1721880208.jpg'],
    [150, 'KISHORI LAL', 'SUBEDAR', 'JAMUNI DEVI', '14354051', '10012367', '01/09/2005', 'ADCA', '1 Year', 'male', 'upload/KISHORI LAL1721882132.jpg'],
    [151, 'UDAYBHAN CHAURASIYA', 'SURYABHAN CHAURASIYA', 'KANTI DEVI', '14354052', '10012368', '18/09/2007', 'ADCA', '1 Year', 'male', 'upload/UDAYBHAN CHAURASIYA1721882459.jpg'],
    [152, 'ANKIT CHAUDHARI', 'SOHAN LAL', 'SHANTEE  DEVI', '14354053', '10012369', '01/01/2010', 'ADCA', '1 Year', 'male', 'upload/ANKIT CHAUDHARI1721882678.jpg'],
    [153, 'SHUBH', 'INDRMANI', 'JYOTI', '14354054', '10012370', '26/04/2011', 'ADCA', '1 Year', 'male', ''],
    [154, 'VANSH KESHARWANI', 'HARISHANKAR KESHARWANI', 'VIJAYLAXMI', '14354055', '10012371', '21/09/2008', 'ADCA', '1 Year', 'male', 'upload/VANSH KESHARWANI1722328667.jpg']
];

// 1. Sync s_adm (Admission Inquiries)
$admInserted = 0;
foreach ($cpanel_s_adm as $adm) {
    list($origId, $name, $phone, $addr) = $adm;
    $chk = mysqli_prepare($con, "SELECT id FROM s_adm WHERE Name = ? AND Phone = ? AND Address = ? LIMIT 1");
    mysqli_stmt_bind_param($chk, "sss", $name, $phone, $addr);
    mysqli_stmt_execute($chk);
    $res = mysqli_stmt_get_result($chk);
    $exists = mysqli_fetch_assoc($res);
    mysqli_stmt_close($chk);

    if (!$exists) {
        $ins = mysqli_prepare($con, "INSERT INTO s_adm (Name, Phone, Address) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($ins, "sss", $name, $phone, $addr);
        if (mysqli_stmt_execute($ins)) {
            $admInserted++;
        }
        mysqli_stmt_close($ins);
    }
}

// 2. Sync s_cer_det (Student Certificates 2021-2024 from cPanel SQL)
$cerInserted = 0;
$cerUpdated = 0;
foreach ($cpanel_s_cer_det as $stu) {
    list($origId, $name, $fname, $mname, $enroll, $roll, $dob, $course, $duration, $gender, $photo) = $stu;
    $chk = mysqli_prepare($con, "SELECT id, photo FROM s_cer_det WHERE roll = ? AND enroll = ? AND course = ? LIMIT 1");
    mysqli_stmt_bind_param($chk, "sss", $roll, $enroll, $course);
    mysqli_stmt_execute($chk);
    $res = mysqli_stmt_get_result($chk);
    $existing = mysqli_fetch_assoc($res);
    mysqli_stmt_close($chk);

    if (!$existing) {
        $ins = mysqli_prepare($con, "INSERT INTO s_cer_det (name, fname, mname, enroll, roll, dob, course, duration, gender, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($ins, "ssssssssss", $name, $fname, $mname, $enroll, $roll, $dob, $course, $duration, $gender, $photo);
        if (mysqli_stmt_execute($ins)) {
            $cerInserted++;
        }
        mysqli_stmt_close($ins);
    } elseif (!empty($photo) && $existing['photo'] !== $photo) {
        $upd = mysqli_prepare($con, "UPDATE s_cer_det SET photo = ?, dob = ? WHERE id = ?");
        $eid = (int)$existing['id'];
        mysqli_stmt_bind_param($upd, "ssi", $photo, $dob, $eid);
        if (mysqli_stmt_execute($upd)) {
            $cerUpdated++;
        }
        mysqli_stmt_close($upd);
    }
}

// 3. Clean s_det spam rows & ensure Manjeet Singh (id=51) exists
@mysqli_query($con, "DELETE FROM s_det WHERE name = '' OR profile LIKE '%.php'");
$chkDet = mysqli_query($con, "SELECT id FROM s_det WHERE phone = '9170428336' LIMIT 1");
if ($chkDet && mysqli_num_rows($chkDet) === 0) {
    $insDet = mysqli_prepare($con, "INSERT INTO s_det (name, phone, course, profile, pass) VALUES ('Manjeet singh ', '9170428336', 'DTP', 'photo/.689c43f77c49e2.10520513Manjeet singh .jpg', 'Manjeet@1234')");
    mysqli_stmt_execute($insDet);
    mysqli_stmt_close($insDet);
}

$totCerRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM s_cer_det"));
$totAdmRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS cnt FROM s_adm"));

// 4. Export full unified database dump to scaitin_academy.sql (cPanel 2021-2024 + MongoDB 2024-2026)
$dumpSql = "-- SCAIT Unified Master SQL Dump (cPanel 2021-2024 + MongoDB 2024-2026)\n";
$dumpSql .= "-- Generated at: " . date('Y-m-d H:i:s') . "\n\n";
$dumpSql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\nSET time_zone = \"+00:00\";\nSET NAMES utf8mb4;\n\n";

$tablesRes = mysqli_query($con, "SHOW TABLES");
while ($tRow = mysqli_fetch_row($tablesRes)) {
    $table = $tRow[0];
    $createRes = mysqli_query($con, "SHOW CREATE TABLE `$table`");
    if ($createRes && ($cRow = mysqli_fetch_row($createRes))) {
        $dumpSql .= "-- --------------------------------------------------------\n";
        $dumpSql .= "-- Table structure for table `$table`\n";
        $dumpSql .= "-- --------------------------------------------------------\n\n";
        $dumpSql .= "DROP TABLE IF EXISTS `$table`;\n";
        $dumpSql .= $cRow[1] . ";\n\n";
    }
    $dataRes = mysqli_query($con, "SELECT * FROM `$table`");
    if ($dataRes && mysqli_num_rows($dataRes) > 0) {
        $dumpSql .= "-- Dumping data for table `$table`\n\n";
        while ($dRow = mysqli_fetch_assoc($dataRes)) {
            $cols = array_map(function($c) { return "`$c`"; }, array_keys($dRow));
            $vals = array_map(function($v) use ($con) {
                return $v === null ? "NULL" : "'" . mysqli_real_escape_string($con, $v) . "'";
            }, array_values($dRow));
            $dumpSql .= "INSERT INTO `$table` (" . implode(", ", $cols) . ") VALUES (" . implode(", ", $vals) . ");\n";
        }
        $dumpSql .= "\n";
    }
}
@file_put_contents(__DIR__ . '/../scaitin_academy.sql', $dumpSql);

$summary = [
    'synced_at' => date('Y-m-d H:i:s'),
    's_cer_det_inserted' => $cerInserted,
    's_cer_det_updated' => $cerUpdated,
    's_adm_inserted' => $admInserted,
    'total_s_cer_det' => (int)$totCerRow['cnt'],
    'total_s_adm' => (int)$totAdmRow['cnt']
];

@file_put_contents(__DIR__ . '/../scratch/.cpanel_sql_synced', json_encode($summary, JSON_PRETTY_PRINT));

if (php_sapi_name() === 'cli') {
    echo "cPanel SQL Sync Complete:\n" . json_encode($summary, JSON_PRETTY_PRINT) . "\n";
}
