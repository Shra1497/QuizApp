-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2023 at 06:56 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `levelmaster`
--

DROP TABLE IF EXISTS `levelmaster`;
CREATE TABLE IF NOT EXISTS `levelmaster` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levelmaster`
--

INSERT INTO `levelmaster` (`level_id`, `level_name`) VALUES
(1, 'Beginner'),
(2, 'Intermediate'),
(3, 'Professional');

-- --------------------------------------------------------

--
-- Table structure for table `questionmaster`
--

DROP TABLE IF EXISTS `questionmaster`;
CREATE TABLE IF NOT EXISTS `questionmaster` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `level_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option1` varchar(50) DEFAULT NULL,
  `option2` varchar(50) DEFAULT NULL,
  `option3` varchar(50) DEFAULT NULL,
  `option4` varchar(50) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionmaster`
--

INSERT INTO `questionmaster` (`question_id`, `topic_id`, `level_id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 1, 'What is the national game of India?', 'Hockey', 'Cricket', 'Kabaddi', 'None of the above', 'Hockey'),
(2, 1, 1, 'Who among the following is known as Flying Sikh of India?', 'Kapil Dev ', 'PT Usha', 'Milka Singh', 'Joginder Singh', 'Milka Singh'),
(3, 1, 1, 'How many players make a baseball team?', '8', '4', '9', '6', '9'),
(4, 1, 1, 'How many players participate in a volleyball team?', '3', '5', '6', '8', '6'),
(5, 1, 2, 'Which sport was Muhammad Ali known for?', 'Boxing', 'Cricket', 'Swimming', 'Tennis', 'Boxing'),
(7, 1, 2, 'Which country is called the \'father of cricket\'?', 'India', 'England', 'Sri Lanka', 'none of these', 'England'),
(8, 1, 2, 'How many squares or squares are there in the game of chess?', '64', '65', '68', '66', '64'),
(9, 1, 3, 'Who is the third bowler in the world to take 600 wickets in Test cricket?', 'Anil Kumble', 'Jasprit Bumrah', 'Javagal Srinath', 'Ishant Sharma', 'Anil Kumble'),
(10, 1, 3, 'When is National Sports Day celebrated?', '12 August', '29 August', '20 August', '27 August', '29 August'),
(11, 1, 3, 'Which award has been named Major Dhyan Chand Khel Ratna Award?', 'Indira Gandhi Khel Ratna Award', 'Rajiv Gandhi Khel Ratna Award', 'Jawaharlal Nehru Khel Ratna Award', 'Sanjay Gandhi Khel Ratna Award', 'Rajiv Gandhi Khel Ratna Award'),
(12, 4, 1, 'How many members can be nominated by the President?', '11', '9', '5', '2', '2'),
(13, 4, 1, 'Which language is not included in the constitution?', 'Telugu', 'English', 'Odia', 'Marathi', 'English'),
(14, 4, 1, 'Which of the following are the two houses of the Parliament?', 'Lok Sabha and Legislative Assembly', 'Lok Sabha and Rajya Sabha', 'Rajya Sabha and Legislative Assembly', 'Lok Sabha and President', 'Lok Sabha and Rajya Sabha'),
(15, 4, 1, 'Which of these is called Punjab Kesari?', 'Bhagat Singh', 'Lala Lajpat Rai', 'Subhash Chandra Bose', 'Sukhdev', 'Lala Lajpat Rai'),
(16, 4, 2, 'A Supreme Court judge must have been a high Court judge for at least?', '5 Years', '10 Years', '12 Years', '15 Years', '5 Years'),
(17, 4, 2, 'The \'Council of State\' which is also known as?', 'Rajya Sabha', 'Parliament', 'Assembly', 'Lok Sabha', 'Rajya Sabha'),
(18, 4, 2, 'Which of the following High Court is the oldest High Court in India?', 'Calcutta High Court', 'Madras High Court', 'Allahabad High court', 'Delhi High Court', 'Calcutta High Court'),
(19, 4, 3, 'Who was the founder of the Republican Party?', 'Namboo Dripad', 'Mulji Vaishya', 'Dr. B. R. Ambedkar', 'Sripad Dange', 'Dr. B. R. Ambedkar'),
(20, 4, 3, 'Now who is the Vice President of India in 2022?', 'Three-third majority', 'Two fourth majority', 'Two-thirds majority', 'One-fourth majority', 'Two-thirds majority'),
(21, 4, 3, 'What is the retirement age of Supreme Court Judges?', '60 years', '62 years', '65 years', '66 years', '65 years'),
(22, 3, 1, 'Dandiya Rass is a famous dance form of', 'Andhra Pradesh', 'Haryana', 'Gujarat', 'Meghalaya', 'Gujarat'),
(23, 3, 1, 'The word \'yoga\' philosophy belongs to', 'Gautam', 'Kannada', 'Jaimini', 'Patanjali', 'Patanjali'),
(24, 3, 1, 'Bhimsen Joshi is a noted', 'Violin Player', 'Sitarist', 'Tabla Player', 'Vocalist', 'Vocalist'),
(25, 3, 1, 'Nusrat Fateh Ali Khan is a famous', 'Folk singer', 'Qawwali singer', 'Pop singer', 'Hindustani classical singer', 'Qawwali singer'),
(26, 3, 2, 'Which among the following is not a classical dance of India?', 'Kuchipudi', 'Odissi', 'Manipuri', 'Rasleela', 'Rasleela'),
(27, 3, 2, 'The Lavani Dance belongs to which State?', 'Mizoram', 'Nagaland', 'Sikkim', 'Maharashtra', 'Maharashtra'),
(28, 3, 2, 'The famous \'Mona Lisa\' was painted by', 'Leonardo Da Vinci', 'Michelangelo', 'Picasso', 'Vincent Van Gogh', 'Leonardo Da Vinci'),
(29, 3, 3, 'Who among the following is a famous santoor player?', 'Hari Prasad Chaurasia', 'Ravi Shankar', 'Zakir Hussain', 'Shiv Kumar Sharma', 'Shiv Kumar Sharma'),
(30, 3, 3, ' Which one of the following dances involves solo performance?', 'Bharatanatyam', 'Kuchipudi', 'Kathak', 'Odissi', 'Bharatanatyam'),
(31, 3, 3, 'The \'first lady\' of the Indian silver', 'Madhubala', 'Devika Rani', 'Durga Khote', 'Nargis Dutt', 'Devika Rani');

-- --------------------------------------------------------

--
-- Table structure for table `quizmaster`
--

DROP TABLE IF EXISTS `quizmaster`;
CREATE TABLE IF NOT EXISTS `quizmaster` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `attempted_questions` int(11) DEFAULT '0',
  `correct_questions` int(11) DEFAULT '0',
  `wrong_questions` int(11) DEFAULT '0',
  `obtained_marks` int(11) DEFAULT '0',
  `quiz_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizmaster`
--

INSERT INTO `quizmaster` (`quiz_id`, `topic_id`, `user_email`, `attempted_questions`, `correct_questions`, `wrong_questions`, `obtained_marks`, `quiz_date`) VALUES
(16, 1, 'abc@gmail.com', 2, 1, 1, 1, '2023-02-24 11:26:19'),
(15, 3, 'abc@gmail.com', 10, 8, 2, 16, '2023-02-27 11:20:23'),
(17, 3, 'abc@gmail.com', 10, 8, 2, 16, '2023-02-27 11:20:23'),
(22, 3, 'shraddharhatole14997@gmail.com', 10, 7, 3, 14, '2023-02-27 12:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `rankmaster`
--

DROP TABLE IF EXISTS `rankmaster`;
CREATE TABLE IF NOT EXISTS `rankmaster` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rankmaster`
--

INSERT INTO `rankmaster` (`rank_id`, `user_email`, `score`, `date`) VALUES
(1, 'abc@gmail.com', 34, '2023-02-27 16:50:23'),
(2, 'shraddharhatole14997@gmail.com', 14, '2023-02-27 17:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `topicmaster`
--

DROP TABLE IF EXISTS `topicmaster`;
CREATE TABLE IF NOT EXISTS `topicmaster` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(100) DEFAULT NULL,
  `marks_per_question` int(11) DEFAULT NULL,
  `user_attempted` int(11) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topicmaster`
--

INSERT INTO `topicmaster` (`topic_id`, `topic_name`, `marks_per_question`, `user_attempted`) VALUES
(1, 'Sports', 1, NULL),
(2, 'Science & Technology', 2, NULL),
(3, 'Arts', 2, NULL),
(4, 'Politics', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usermaster`
--

DROP TABLE IF EXISTS `usermaster`;
CREATE TABLE IF NOT EXISTS `usermaster` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermaster`
--

INSERT INTO `usermaster` (`user_id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
