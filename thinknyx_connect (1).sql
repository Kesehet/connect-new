-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 10:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thinknyx_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `created_at`, `updated_at`, `username`, `image`, `first_name`, `last_name`, `email`, `password`, `status`) VALUES
(1, '2020-06-29 03:37:41', NULL, 'ganesh', '', 'ganesh', 'khadka', 'atul.vashishat@gmail.com', '$2y$10$EfuO3zxparVff92F3pJHfOaCuY.NTnF/a2tbocaoXdirezu2/YWFS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `advancepayments`
--

CREATE TABLE `advancepayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisals`
--

CREATE TABLE `appraisals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `goal_id` varchar(255) DEFAULT NULL,
  `user_comment` text DEFAULT NULL,
  `manager_comment` text DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(5) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fy` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appraisals`
--

INSERT INTO `appraisals` (`id`, `user_id`, `goal_id`, `user_comment`, `manager_comment`, `rating`, `status`, `created_at`, `updated_at`, `fy`) VALUES
(1, 59, '1', 'Contributed in creating a delivery channel for Newsletter Delivery.', 'Thank you so much for your support on this initiative.', 4, 3, '2021-03-10 12:13:33', '2021-03-12 00:12:05', '2020-21'),
(2, 59, '2', 'Trained internal team members on Ansible.', 'Thank you for your all support, need your support for other such sessions for internal experts.', 5, 3, '2021-03-10 12:14:21', '2021-03-12 00:12:05', '2020-21'),
(3, 59, '3', 'This is something which is missed.', 'Need to work on this.', 2, 3, '2021-03-10 12:14:39', '2021-03-12 00:12:05', '2020-21'),
(4, 59, '4', 'Contributed well in this as well.', 'Great work done!', 4, 3, '2021-03-10 12:15:27', '2021-03-12 00:12:05', '2020-21'),
(5, 59, '5', 'Adhering to the Thinknyx Core Values always.', 'Completely agree!', 5, 3, '2021-03-10 12:16:08', '2021-03-12 00:12:05', '2020-21'),
(6, 59, '6', 'Apart from completing the internal initiative of Docker Lint, according to me I stick to the Goals and have successfully achieved them.', 'Great work done', 4, 3, '2021-03-10 12:16:47', '2021-03-12 00:12:05', '2020-21'),
(7, 59, '7', 'Have not worked on any.', 'Your support for ELK was really outstanding!', 4, 3, '2021-03-10 12:17:02', '2021-03-12 00:12:05', '2020-21'),
(8, 59, '8', 'Effectively delivered multiple trainings. The only miss from myself is that instant feedback of participants was not reported at time, which resulted in escalation. So will stick on reporting it timely.', 'You did a fantastic job, try to focus on the areas we discussed for escalated cases.', 5, 3, '2021-03-10 12:18:07', '2021-03-12 00:12:05', '2020-21'),
(9, 59, '9', 'I hope I managed it well.', 'Need some improvements in this area as we discussed.', 4, 3, '2021-03-10 12:18:29', '2021-03-12 00:12:05', '2020-21'),
(10, 59, '10', 'Multiple new things on Azure Cloud along with GCP which I delivered.', 'The learning curve was really great for you and you have shown flying colors in this area always.', 5, 3, '2021-03-10 12:19:17', '2021-03-12 00:12:05', '2020-21'),
(11, 59, '11', 'Improvement of communication skills is still in progress, I am working on it.', 'Indeed, this is one area where you can improve many things.', 0, 3, '2021-03-10 12:19:38', '2021-03-12 00:12:05', '2020-21'),
(12, 60, '1', 'I Think i have not done anything in this', 'Ok', 2, 3, '2021-03-10 12:56:38', '2021-03-12 00:02:20', '2020-21'),
(13, 60, '2', 'I Think i have not done anything in this', 'N/A', 2, 3, '2021-03-10 12:58:17', '2021-03-12 00:02:20', '2020-21'),
(14, 60, '3', 'No any videos made and published', 'Try to complete this from now onwards', 2, 3, '2021-03-10 13:00:02', '2021-03-12 00:02:20', '2020-21'),
(15, 60, '4', 'I have learnt few things in this year like PHP and also worked on UI designing', 'Great work', 3, 3, '2021-03-10 13:06:40', '2021-03-12 00:02:20', '2020-21'),
(16, 60, '5', 'Yes, all of them in this  origination are very helpful to everyone.', 'Great', 3, 3, '2021-03-10 13:09:33', '2021-03-12 00:02:20', '2020-21'),
(17, 60, '226', 'I have created ppt for zebix and also for conference posters and i design UI for AMS, EMS and also for quiz portal', 'Your support on this was really helpful for the team', 5, 3, '2021-03-10 13:11:04', '2021-03-12 00:02:20', '2020-21'),
(18, 60, '227', 'I have learnt PHP for supporting PHP project.', 'Good job', 4, 3, '2021-03-10 13:13:37', '2021-03-12 00:02:20', '2020-21'),
(19, 60, '228', 'yes almost time i have completed my task but some of the time i have delayed in work because of some of the issue.', 'Need to focus on time management more', 3, 3, '2021-03-10 13:15:10', '2021-03-12 00:02:20', '2020-21'),
(20, 60, '229', 'Yes i have prepared posters for this created ppt for this', 'There is improvement required to get the work done without others support', 3, 3, '2021-03-10 13:16:04', '2021-03-12 00:02:20', '2020-21'),
(21, 60, '230', 'In this i have done mistake in quiz portal i have entered wrong detail. But for next time i will take care for this.', 'Focus more from next time to avoid such mistakes', 2, 3, '2021-03-10 13:17:34', '2021-03-12 00:02:20', '2020-21'),
(22, 60, '231', 'Yes i have worked in this to improve my communication skills.', 'Thanks, still need lots of improvements in this area', 0, 3, '2021-03-10 13:18:41', '2021-03-12 00:02:20', '2020-21'),
(23, 62, '1', 'UI PATH (Whatsapp Automation) : Created a Workflow to send the Details of our DevOps in Action Conference to Clients through Whatsapp Automation', 'This was a great work done', 4, 4, '2021-03-12 00:25:54', '2021-03-12 00:49:07', '2020-21'),
(24, 62, '2', 'Delivered 3 Knowledge Transfer Session for the Team \r\n             - RPA\r\n             - UI PATH (Whatsapp Automation) : Created a Workflow to send the Details of our DevOps in Action Conference to Clients through Whatsapp Automation \r\n             - Ansible Automation', 'Great work done', 4, 4, '2021-03-12 00:26:20', '2021-03-12 00:49:07', '2020-21'),
(25, 62, '3', 'Technical Blogs:\r\n             - Delivered Technical Blogs on RPA [UI Path & Automation Anywhere]\r\n             - Blogs on Ansible Automation\r\n\r\n          CheatSheets:\r\n             - Ansible CheatSheets\r\n             - Linux CheatSheets', 'Ansible and Linux cheatsheet work was done really well and have added a great value.', 5, 4, '2021-03-12 00:26:46', '2021-03-12 00:49:07', '2020-21'),
(26, 62, '4', 'Tried to Deliver Tasks for Projects and Internal tasks within deadlines with utmost quality', 'You did a complete justice here', 4, 4, '2021-03-12 00:27:05', '2021-03-12 00:49:07', '2020-21'),
(27, 62, '5', 'Working in an environment like Thinknyx has taught me a lot and it is one of the major reason for my interest to get better everyday', 'Keep up the learning spirits', 4, 4, '2021-03-12 00:27:26', '2021-03-12 00:49:07', '2020-21'),
(28, 62, '12', 'Airbus Ansible Automation for Capgemini\r\n              - Developed Ansible Playbooks for Airbus \r\n\r\n           DPASL WordPress Website Development Project\r\n              - Assist Atul for Tpasl wordpress website Re-development and Dpasl website from scratch with thinknyx wordpress theme[Capitol]\r\n\r\n           Account Management System [Internal Project]\r\n              - Deploying AMS on server\r\n              - HTML Changes for Beautification of Front-End Pages', 'Complete Agree', 5, 4, '2021-03-12 00:27:44', '2021-03-12 00:49:07', '2020-21'),
(29, 62, '13', 'Improving Testing:\r\n           To get better with Testing softwares, websites, technical documentations for application be fully ready to go live', 'Great work done so far', 4, 4, '2021-03-12 00:28:14', '2021-03-12 00:49:07', '2020-21'),
(30, 62, '14', 'Technical questions for Quiz portal:\r\n\r\n           Application Deployment on servers:\r\n              - AMS\r\n              - LMS', 'Your support and work done was really helpful and did added a great value to the organization', 4, 4, '2021-03-12 00:28:37', '2021-03-12 00:49:07', '2020-21'),
(31, 62, '15', 'Technical PPTs:\r\n             - RPA [UI Path]\r\n             - Automation Anywhere\r\n\r\n           Conference Posters:\r\n\r\n           Documentation for V2umart Website:', 'Well done', 4, 4, '2021-03-12 00:28:51', '2021-03-12 00:49:07', '2020-21'),
(32, 62, '16', 'Excel/CSV Automation: To collect data from a Bill and convert it into csv file\r\n           SMS Automation: To send the data from csv file as SMS  \r\n           Whatsapp Automation: To send the Details of our DevOps in Action Conference to Clients through Whatsapp Automation\r\n           Web Automation: To collect data from e-commerce website and convert it to excel sheet', 'Great skills shown in this area', 4, 4, '2021-03-12 00:29:16', '2021-03-12 00:49:07', '2020-21');

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_name` varchar(255) NOT NULL,
  `zip_code` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `designation_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `join_date` date NOT NULL,
  `job_type` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `salary` bigint(20) NOT NULL,
  `age` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `event` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fyears`
--

CREATE TABLE `fyears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` char(7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fyears`
--

INSERT INTO `fyears` (`id`, `year`, `created_at`, `updated_at`) VALUES
(1, '2020-21', '2020-09-24 04:13:27', '2020-09-24 04:13:37'),
(2, '2021-22', '2022-06-22 20:21:45', '2022-06-22 20:21:45'),
(3, '2022-23', '2022-06-22 20:24:20', '2022-06-22 20:24:20'),
(4, '2023-24', '2023-04-07 12:22:15', '2023-04-07 12:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `goal_type` tinyint(5) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_no` tinyint(5) DEFAULT NULL,
  `status` tinyint(5) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fy` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `user_id`, `goal_type`, `title`, `description`, `order_no`, `status`, `created_at`, `updated_at`, `fy`) VALUES
(1, 0, 1, 'Innovation – New initiatives that has not seen before in Thinknyx, must be measurable at least once per year (eventually more often), customer focused, and ultimately delivering value.', '<p>Reason for Objective – Innovation involves new ideas or processes, better solutions to meeting customer needs, or achieving a goal in a new way. Combined, they are key to providing businesses with a competitive edge.</p><p>KPI (metric) – No. of successful new value initiatives launched and related feedback by the stakeholders.</p>', 1, 0, '0000-00-00 00:00:00', '2020-08-31 01:03:56', '2020-21'),
(2, 0, 1, 'Internal Knowledge Sharing – Self Driven knowledge sharing sessions for internal Thinknyx team in order to build organizational skills and capabilities.', '<p>Reason for Objective – Create a learning culture and build internal skills and capabilities.</p><p>KPI (metric) – No. of internal sessions delivered and feedback received by the participants.</p>', 2, 0, '0000-00-00 00:00:00', '2020-08-31 01:04:25', '2020-21'),
(3, 0, 1, 'Technical Documentation - Publishing Technical Blog and Technical PPT (short video) one each every month.', '<p>Reason for Objective – Blogging enables you to reach the billions of people that use the Internet. Blogging help you promote yourself or your business. It will in turn help an employee to enhance his/her writing and logical skills.</p><p>KPI (metric) – No. of blogs and videos published.</p>', 3, 0, '0000-00-00 00:00:00', '2020-08-31 01:04:36', '2020-21'),
(4, 0, 1, 'Internal and External Customer Satisfaction (Internal Customers are Thinknyx’s employees).', '<p>1.  Increase customer satisfaction scores by 10% over the next 2 quarters (Q3, Q4). </p><p>Reason for Objective – Higher customer satisfaction scores = happier customers = les churn and more referrals.</p><p> KPI (metric) – Customer satisfaction ratings on post-support survey.</p><p>2.  Improve number of “fully satisfied” customer ratings of the support they received by 10% over the next two quarters (Q3, Q4).</p><p>Reason for Objective - Unless a problem is 100% solved, a customer will not be fully satisfied.</p><p> KPI (metric) – A “fully satisfied” (or similar) rating on a post – support survey.</p>', 4, 0, '0000-00-00 00:00:00', '2020-08-31 01:04:53', '2020-21'),
(5, 0, 1, 'Living by the Thinknyx core values and behaviours – Demonstrate company core values and behaviour on day to day basis while collaborating with internal and external customers.', '<p>Reason for Objective – Alignment between organizational values and an individual values helps in seamless operations and maintains the company culture.</p><p>KPI (metric) – Peer Feedback, Customer feedback.</p>', 5, 0, '0000-00-00 00:00:00', '2020-08-31 01:05:04', '2020-21'),
(6, 59, 2, 'Thinknyxâ€™s Internal Technical Initiatives', 'Docker Lint by Octâ€™2020\r\nMailer Utility by Novâ€™2020\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 2, '2020-09-22 05:55:31', '2021-07-23 13:31:12', '2020-21'),
(7, 59, 2, 'Technical Client Projects: Delivering assigned projects', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 2, '2020-09-22 05:55:51', '2021-07-23 13:31:12', '2020-21'),
(8, 59, 2, 'Effectively Delivering Trainings: Delivering assigned trainings.', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors, minimum/zero Lab cost wastage.', 3, 2, '2020-09-22 05:56:04', '2021-07-23 13:31:12', '2020-21'),
(9, 59, 2, 'Team Management: Managing direct reports efficiently.', 'KPI - Feedback of the stakeholders', 4, 2, '2020-09-22 05:56:20', '2021-07-23 13:31:12', '2020-21'),
(10, 59, 2, 'Learning and Implementing Latest Technologies: Learning and Implementing latest technologies in ongoing projects and training assignments.', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 2, '2020-09-22 05:56:36', '2021-07-23 13:31:12', '2020-21'),
(11, 59, 3, 'Improving Communication Skills', 'Need to work on improving the communication and speaking skills.', 1, 2, '2020-09-22 05:57:21', '2021-07-23 13:31:12', '2020-21'),
(12, 62, 2, 'Supporting Projects', 'Learning new technologies as instructed and supporting projects with respect to the assigned task. (Eg. Learning RPA etc)\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum error', 1, 2, '2020-09-22 06:26:03', '2022-06-23 12:48:15', '2020-21'),
(13, 62, 2, 'Supporting Development Projects', 'Application Testing -Improve Testing process to dig out minute errors/bugs for application to be fully ready to go live.\r\nContainerization of AMS application -Explore Containers, Docker to able to implement containerization of AMS application.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the   defined timelines, zero or minimum errors.', 2, 2, '2020-09-22 06:27:25', '2022-06-23 12:48:15', '2020-21'),
(14, 62, 2, 'Thinknyxâ€™s internal Technical Initiatives', 'Creating Automation of applications through github actions with running scripts which will save time in future.\r\nHandling the deployment of applications on thinknyxserver, maintaining related technical documentation of every new application deployed. \r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 2, '2020-09-22 06:28:31', '2022-06-23 12:48:15', '2020-21'),
(15, 62, 2, 'Creating Presentation Decks/ Technical Documents', 'Creating Presentations & Technical documents as when required by the team. \r\nKPI â€“ Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 2, '2020-09-22 06:30:31', '2022-06-23 12:48:15', '2020-21'),
(16, 62, 2, 'RPA Use Cases', 'Monthly one use case along with Documentation and Demo.\r\nKPI â€“ Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 2, '2020-09-22 06:31:02', '2022-06-23 12:48:15', '2020-21'),
(17, 62, 3, 'Communication Skills', 'Improving Communication Skills', 1, 2, '2020-09-22 06:32:06', '2022-06-23 12:48:15', '2020-21'),
(220, 61, 2, 'Effective Team Management and Development.', '<p>Managing Team members efficiently and omitting bottlenecks in work flow of the organization. Skilling junior members in PHP and mobile development so that they can support Development Projects.</p><p>KPI - Feedback of the stakeholders ; Timely work delivery by the team ; Assigning value add tasks to team members.</p>', 1, 2, '2020-09-22 14:15:52', '2020-09-24 12:50:04', '2020-21'),
(221, 61, 2, 'Delivering Development Projects (External).', '<p>Responsible for delivering end to end assigned external development projects. (ongoing – HTC).</p><p>KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.</p>', 2, 2, '2020-09-22 14:17:23', '2020-09-24 12:50:04', '2020-21'),
(222, 61, 2, 'Delivering Development Projects (Internal).', '<p>Responsible for delivering end to end assigned internal development projects. (ongoing –  Employee Management System (EMS) – Thinknyx Connect, AMS).</p><p>KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.</p>', 3, 2, '2020-09-22 14:19:12', '2020-09-24 12:50:04', '2020-21'),
(223, 61, 2, 'Learning and Implementing new Technologies.', '<p>Learning and Implementing new technologies in ongoing projects.</p><p>Create a mobile application for EMS. Oct’20 – Dec’20 create a skeleton of the application ; Jan’21 – Mar’21 - add other API, Design and Security checks in EMS app.</p><p>KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.</p>', 4, 2, '2020-09-22 14:22:04', '2020-09-24 12:50:04', '2020-21'),
(224, 61, 2, 'Adhoc Tasks.', '<p>Responsible for Adhoc tasks assigned in order to support the team. (eg. Technical Documentation, Attending Client Calls, Creating Proposals  etc.)</p><p>KPI - Feedback received by stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.</p>', 5, 2, '2020-09-22 14:23:43', '2020-09-24 12:50:04', '2020-21'),
(225, 61, 3, 'PDP', '<p>1. Improving Communication Skills. </p><p>2. Developer to Full Stack Developer.</p>', 1, 2, '2020-09-22 14:25:09', '2020-09-24 12:50:04', '2020-21'),
(226, 60, 2, 'Creating Presentation Decks and UI Designing', 'Creating Presentations & Videos as when required by the team. Responsible for UI designing for upcoming and ongoing projects.\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 1, '2020-09-22 20:05:34', '2021-07-23 15:08:42', '2020-21'),
(227, 60, 2, 'Supporting Projects', 'Learning new technologies as instructed and supporting projects with respect to the assigned task. (Eg. Learning GCP)\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 1, '2020-09-22 20:06:06', '2021-07-23 15:08:42', '2020-21'),
(228, 60, 2, 'Office Administration', 'Responsible for tasks assigned related to office management and administration.\r\nKPI –Feedback related to Proper functioning of office by various stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 1, '2020-09-22 20:06:34', '2021-07-23 15:08:42', '2020-21'),
(229, 60, 2, 'Contributing in Conferences', 'Responsible for assigned tasks related to online and physical Thinknyx conferences. (eg. Managing Logistics, Designing Conference Posters, follow up with candidates etc.)\r\nKPI - Feedback received by stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 1, '2020-09-22 20:06:53', '2021-07-23 15:08:42', '2020-21'),
(230, 60, 2, 'Adhoc Tasks', 'Responsible for Adhoc tasks assigned in order to support the team. (eg. Learning new technologies as instructed, Testing of a Tool/App, word doc, excel doc conversions/creations  etc.)\r\nKPI - Feedback received by stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 1, '2020-09-22 20:07:16', '2021-07-23 15:08:42', '2020-21'),
(231, 60, 3, 'Communication Skills', 'Improving Communication Skills', 1, 1, '2020-09-22 20:08:02', '2021-07-23 15:08:42', '2020-21'),
(232, 58, 2, 'Responsible for Entire Training Vertical', 'a.       Training Vertical Strategy Development & Implementation in order to increase revenue of training vertical and seamless operations.\r\n\r\nb.       Delivering Trainings.\r\n\r\nc.       Manging entire training vertical with a focus on increasing the revenue as compared to last year.\r\n\r\nd.       Networking with new clients, vendors so that we can have some permanent clients/vendors.\r\n\r\ne.       Capabilities Data (Trainers Skill Database) – work along with Head – Trainings to put this task to closures by Nov’20.\r\n\r\nf.        Ensuring delivery of new skills training assignments by freelancer trainers by working along with Head – Trainings.\r\n\r\ng.       Hiring 1-2 in-house trainer.\r\n\r\n\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors, minimum/zero Lab cost wastage.', 1, 2, '2020-09-22 20:33:08', '2020-09-24 12:49:18', '2020-21'),
(233, 58, 2, 'Effective Team Management', 'Managing direct and indirect reports efficiently and omitting bottlenecks in work flow of the organization.\r\n\r\n\r\nKPI - Feedback of the stakeholders ; Timely delivery by the team ; Assigning value add tasks to team members.', 2, 2, '2020-09-22 20:33:32', '2020-09-24 12:49:18', '2020-21'),
(234, 58, 2, 'Learning and Implementing Latest Technologies', 'Upskilling and Implementing latest technologies in ongoing training assignments and projects.\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 2, '2020-09-22 20:33:52', '2020-09-24 12:49:18', '2020-21'),
(235, 58, 2, 'Contributing to Projects', 'wherever possible effectively contributing to projects in the hour of need if asked for support.\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 2, '2020-09-22 20:34:14', '2020-09-24 12:49:18', '2020-21'),
(236, 58, 2, 'Business Strategy', 'Contributing to development and implementation of business strategy along with the CEO.\r\n\r\nKPI - Effectively Support the CEO in creating Thinknyx’s business strategy.', 5, 2, '2020-09-22 20:34:33', '2020-09-24 12:49:18', '2020-21'),
(237, 58, 3, 'Self Improvement and evolvement for Thinknyx Growth', '1. Develop impactful communication skills\r\n2. Develop project management skills (timely decision making)\r\n3. Build knowledge around Hot Skills in market', 1, 2, '2020-09-22 20:37:00', '2020-09-24 12:49:18', '2020-21'),
(238, 64, 2, 'Training Leader.', 'To become one of the strong leader in Training Market across Globe', 1, 2, '2020-12-26 16:25:09', '2022-08-04 14:06:41', '2020-21'),
(239, 64, 2, 'Customer Oriented', 'Design Training Programs as per the client need and achieve maximum feedback in Training Delivery', 2, 2, '2020-12-26 16:26:52', '2022-08-04 14:06:41', '2020-21'),
(240, 64, 2, 'Global Presence.', 'Become Global Training Company with Authorized Training Offerings', 3, 2, '2020-12-26 16:29:15', '2022-08-04 14:06:41', '2020-21'),
(241, 64, 3, 'Techno Functional Consultant', 'Being into the training industry from so long i want to learn technical skills and want to consult many organization on a learning front.', 1, 2, '2021-03-12 10:12:56', '2022-08-04 14:06:41', '2020-21'),
(242, 64, 2, 'Increase Thinknyx outreach', 'Outreaching to new clients and in turn increasing brand awareness.\r\nKPI – Increased number of  clients, Increased number of training requests.', 1, 2, '2021-07-06 17:02:45', '2022-08-04 14:06:41', '2021-22'),
(243, 64, 2, 'Managing Training Vertical', 'End to end management of Thinknyx’s Training Vertical.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the  defined timelines, zero or minimum errors, increased profits.', 2, 2, '2021-07-06 17:03:49', '2022-08-04 14:06:41', '2021-22'),
(244, 64, 2, 'Thinknyx Internal Iniatives', 'Timely Publishing Thinknyx’s Newsletter\r\nCreating Presentations, documents, proposals etc as and when required by the team\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 2, '2021-07-06 17:05:04', '2022-08-04 14:06:41', '2021-22'),
(245, 64, 2, 'Managing Staffing request', 'Supporting and supervising team members for closure of staffing requests. \r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, No. of position closures.', 4, 2, '2021-07-06 17:06:52', '2022-08-04 14:06:41', '2021-22'),
(246, 64, 2, 'Team Management', 'Managing direct reports efficiently.\r\nKPI - Feedback of the internal and external stakeholders.', 5, 2, '2021-07-06 17:08:53', '2022-08-04 14:06:41', '2021-22'),
(247, 64, 3, 'Improving MS Office Skills', 'Will work towards gaining knowledge on MS office suite', 1, 2, '2021-07-06 17:45:59', '2022-08-04 14:06:41', '2021-22'),
(248, 59, 2, 'Thinknyx’s Internal Technical Initiatives', 'Thinknyx’s Internal Technical Initiatives: Browser based SSH Utility\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 2, '2021-07-14 08:36:41', '2021-07-23 13:31:12', '2021-22'),
(249, 59, 2, 'Technical Client Projects', 'Technical Client Projects: Delivering assigned projects.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 2, '2021-07-14 08:37:06', '2021-07-23 13:31:12', '2021-22'),
(250, 59, 2, 'Effectively Delivering Trainings', 'Effectively Delivering Trainings: Delivering assigned trainings.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors, minimum/zero Lab cost wastage.', 3, 2, '2021-07-14 08:37:17', '2021-07-23 13:31:12', '2021-22'),
(251, 59, 2, 'Team Management', 'Team Management: Managing direct reports efficiently.\r\nKPI - Feedback of the stakeholders', 4, 2, '2021-07-14 08:37:30', '2021-07-23 13:31:12', '2021-22'),
(252, 59, 2, 'Learning and Implementing Latest Technologies', 'Learning and Implementing Latest Technologies: Learning and Implementing latest technologies in ongoing projects and training assignments.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 2, '2021-07-14 08:37:46', '2021-07-23 13:31:12', '2021-22'),
(253, 59, 3, 'Upgrading Skills', 'Adding OpenShift, Openstack, Cloud Security into my knowledge bucket.', 1, 2, '2021-07-14 08:38:13', '2021-07-23 13:31:12', '2021-22'),
(254, 62, 2, 'Supporting Projects', 'Supporting Internal Projects as currently contributing to Quiz Portal, Dockerlint Utility Etc.\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 2, '2021-07-20 16:52:45', '2022-06-23 12:48:15', '2021-22'),
(255, 62, 2, 'Supporting Development Projects:', 'Application Testing – Improve Testing process to dig out minute errors/bugs for application to be fully ready to go live. \r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the   defined timelines, zero or minimum errors.', 2, 2, '2021-07-20 16:53:19', '2022-06-23 12:48:15', '2021-22'),
(256, 62, 2, 'Thinknyx’s internal Technical Initiatives:', 'Creating training labs and test the labs which are on GitHub repositories. Implement any DevOps projects or training related tasks.\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 2, '2021-07-20 16:54:20', '2022-06-23 12:48:15', '2021-22'),
(257, 62, 2, 'Creating Presentation Docs/ Technical Documents -', 'Creating Technical Documentations such as PPT\'s, Videos, Blogs, SOP, Cheat-sheets. \r\n\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 2, '2021-07-20 16:56:20', '2022-06-23 12:48:15', '2021-22'),
(258, 62, 2, 'Knowledge Transfer sessions :', 'Delivering knowledge transfer sessions every week or two.\r\n\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 2, '2021-07-20 16:56:56', '2022-06-23 12:48:15', '2021-22'),
(259, 62, 3, 'Professional Development Plan Goals:', '- Improving Communication skills\r\n- Growing my skillsets in major DevOps tools, currently focusing on Docker, AWS and later on looking forward to work on Kubernetes.', 1, 2, '2021-07-20 16:57:32', '2022-06-23 12:48:15', '2021-22'),
(260, 66, 2, 'Manpower Planning and Talent Acquisition Process', 'Handling end-to-end recruitment.\r\n·         Sourcing and screening profiles as per requirement\r\n\r\n·         Screening the Candidate based upon the Educational qualification, Technical skills, Communication skill and experience\r\n\r\nSourcing the Candidates through Naukri, Linkedin  also through Reference\r\nScheduling and Tracking the Shortlisted Candidates until they join\r\nTo follow up on TAT for critical position', 1, 2, '2021-07-21 17:11:38', '2022-08-04 14:07:45', '2021-22'),
(261, 66, 2, 'Vendor Management', 'To tie up with external consultants for meeting PAN India requirements(vendors/Portals etc)', 2, 2, '2021-07-21 17:12:51', '2022-08-04 14:07:45', '2021-22'),
(262, 66, 2, 'Updation of Recruitment Tracker and sharing of Information', 'Updation of all Resource Requisition\r\nTo update recruitment tracker with details such as (recruiter/no.of position/no. Of profiles shared/Turn around Time/position closed/existing position) on daily basis', 3, 2, '2021-07-21 17:13:36', '2022-08-04 14:07:45', '2021-22'),
(263, 66, 2, 'Database Management', 'To keep track of all profiles being forwarded for a particular position\r\nTo ensure maintenance of database of profiles received via walk-in/references/e-mails', 4, 2, '2021-07-21 17:14:36', '2022-08-04 14:07:45', '2021-22'),
(264, 66, 2, 'Innovative initiatives introduced in recruitment', 'Employer Branding  Strategy by Sharing social media posts about the exciting things happening in our office — work-related or otherwise\r\nFollowing Recruitment marketing process of promoting our employer brand to job seekers and utilizing marketing best practices to attract top talent.\r\nCrucial profile closure through Talent rediscovery from database', 5, 2, '2021-07-21 17:15:38', '2022-08-04 14:07:45', '2021-22'),
(265, 66, 3, 'Talent Acquisition Future Readiness', 'Making inventory of  Talent Database keeping in view of incremental and radical change happening in market.\r\nPro actively making a collection of Technological and human capital behavioral change', 1, 2, '2021-07-21 18:01:00', '2022-08-04 14:07:45', '2021-22'),
(266, 60, 2, 'Managing Internal Projects', 'Taking the responsibility of managing the internal projects like Quiz Portal, Connect Portal, Newsletter Portal, etc.\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 1, '2021-07-22 17:05:28', '2021-07-23 15:08:42', '2021-22'),
(267, 60, 2, 'Supporting Projects', 'Learning new technologies as instructed and supporting projects with respect to the assigned task. (Eg. Learning GCP)\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 1, '2021-07-22 17:05:55', '2021-07-23 15:08:42', '2021-22'),
(268, 60, 2, 'Creating Presentation Decks and UI Designing', 'Creating Presentations & Videos as when required by the team. Responsible for UI designing for upcoming and ongoing projects.\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 1, '2021-07-22 17:06:19', '2021-07-23 15:08:42', '2021-22'),
(269, 60, 2, 'Office Administration', 'Responsible for tasks assigned related to office management and administration.\r\nKPI –Feedback related to Proper functioning of office by various stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 1, '2021-07-22 17:06:45', '2021-07-23 15:08:42', '2021-22'),
(270, 60, 2, 'Contributing in Conferences', 'Responsible for assigned tasks related to online and physical Thinknyx conferences. (eg. Managing Logistics, Designing Conference Posters, follow up with candidates etc.)\r\nKPI - Feedback received by stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 1, '2021-07-22 17:07:05', '2021-07-23 15:08:42', '2021-22'),
(271, 60, 3, 'Improving Communication Skills', 'Improving Communication Skills', 1, 1, '2021-07-22 17:07:56', '2021-07-23 15:08:42', '2021-22'),
(272, 70, 2, 'Streamline the Monthly News Letter', '1) To streamline the monthly newsletter publishing\r\n2) Improve the news letter content by implementing continuous feedbacks\r\n\r\nKPI - Publish it regularly, Feedback from the key stakeholders.', 1, 2, '2022-04-27 14:44:03', '2022-06-29 16:02:26', '2022-23'),
(273, 70, 2, 'Implement TAP', '1) Make TAP live with first 5 quizzes\r\n2) Add 2 quizzes per month\r\n3) Publish prior notifications in social media every month\r\n4) Implement continuous feedback and suggestions to improve TAP\r\n5) In 2nd phase of TAP, include a high level blog with each quizzes being live\r\n6) In 3rd phase - Implement TAP playground\r\n7) In 4th phase - Implement TAP gamification\r\n\r\nKPI - Implement TAP and ensure 20 assessments would be live in next 6 months.', 2, 2, '2022-04-27 15:21:14', '2022-06-29 16:02:26', '2022-23'),
(274, 70, 2, 'Smooth execution of projects', '1) Ensure the corresponding team member\'s presence on the project calls with client\r\n2) Ensure that the project tasks are being progressed towards the completion of the project\r\n3) Ensure to keep project stakeholders in sync\r\n4) Keep track of project tasks and ensure to get those completed within the defined timelines, scope and budget\r\n\r\nKPI - Customer Satisfaction, No unnecessary escalation, Scheduled deliveries.', 3, 2, '2022-04-27 15:27:15', '2022-06-29 16:02:26', '2022-23'),
(275, 70, 2, 'Implement PMO in the organization', 'Implement PMO in the organization to keep the different verticals in sync and in track.\r\n\r\nKPI - Smooth execution of deliveries across different verticals.', 4, 2, '2022-04-27 15:35:52', '2022-06-29 16:02:26', '2022-23'),
(276, 70, 2, 'Improve Social Media Presence', 'Improve and regularize the updates going to different social media platform starting with biweekly posts and aiming to reduce it a weekly posts.\r\n\r\nKPI - Increase traffic on our social networking sites.', 5, 2, '2022-04-27 15:53:45', '2022-06-29 16:02:26', '2022-23'),
(277, 70, 3, 'Technical Trainings & Certifications', '1) Enhance my capabilities in JIRA as a project management tool and train internal team on the same for effective project management and would try to extend my training capabilities for the external clients as well if there is any opportunity comes in.\r\n2) Learn and get certified on Kubernetes (CKA)', 1, 2, '2022-04-27 16:00:36', '2022-06-29 16:02:26', '2022-23'),
(278, 62, 2, 'Delivering Internal Projects', '1. Virgin Media O2 and Kubernetes Project - Deliver Projects as per requirement of the client in stipulated time frame proposed by the stakeholders with best coding practices.\r\n2. Support other projects – Contributing in other projects if there are any requirements which align with my skills. Currently extending the support in Etisalat project to write Ansible playbooks for OpenStack.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 2, '2022-04-30 12:00:40', '2022-06-23 12:48:15', '2022-23'),
(279, 62, 2, 'Knowledge Transfer Sessions: -', '1.	Knowledge Transfer sessions – Conduct Knowledge transfer session for team members if new use case is being implemented in the project or member might be aligned in different project\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 2, '2022-04-30 12:02:17', '2022-06-23 12:48:15', '2022-23'),
(280, 62, 3, 'My Personal Development Goals', '1.	Learning following skills to enhance my technology skills for upcoming projects [Ansible, Containers]\r\n2.	Improve on technology skills which I have basic understanding and take it to an Advance level [Git, CI/CD, Scripting] \r\n3.	Working on my communication skills', 1, 2, '2022-04-30 12:07:14', '2022-06-23 12:48:15', '2022-23'),
(281, 74, 2, 'OpenShift and Kubernetes Project', 'Aim to work on the OpenShift and Kubernetes project from scratch.', 1, 0, '2022-05-28 11:47:48', '2022-06-30 06:18:39', '2022-23'),
(282, 74, 2, 'Organization Development', 'Works with the team and management to drive organizational growth and enhance the brand value of Thinknyx Tecnologies LLP.', 2, 0, '2022-05-28 11:51:07', '2022-06-08 16:41:41', '2022-23'),
(283, 74, 3, 'RHCA', '1)Plan for this year to become an RHCA, and completion of CKA, CKAD certification \r\n2)Develop project management competencies that will help me deliver the project successfully.', 1, 0, '2022-05-28 11:53:06', '2022-06-30 06:42:23', '2022-23'),
(284, 62, 2, 'TAP [Thinknyx Assessment Portal]', '1.	TAP – Thinknyx Assessment Platform [Preparing question sets and perform the manual testing for the platform for upcoming questions sets]\r\n\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 2, '2022-06-23 12:24:53', '2022-06-23 12:48:15', '2022-23'),
(285, 62, 2, 'Thinknyx’s internal Technical Initiatives: -', '1.	Creating/Uploading technical questions on the Quizizz portal for SOC Batches\r\n2.	News for Thinknyx monthly Newsletter\r\n3.	Automating Internal processes – [Automate processes, needed for trainings using Ansible roles or Terraform modules which will save time if performed manually each time]\r\n4.	Delivering Assessments – [Deliver assessments for HTD batches if Team is aligned in different tasks or trainings]', 4, 2, '2022-06-23 12:25:17', '2022-06-23 12:48:15', '2022-23'),
(286, 62, 2, 'Creating Technical Documentation:–', '1.Technology Guides and Cheat-sheets – [Prepare Technology Guide and Cheat-sheets for TAP so that person can refresh their knowledge with Guides before attempting the quiz]\r\n2.SOP – [Prepare SOP or step by step Documentation of POC (Proof of concept) of new technology tool being used in the project]\r\n3. Creating Blogs', 5, 2, '2022-06-23 12:26:09', '2022-06-23 12:48:15', '2022-23'),
(287, 71, 2, 'Supporting Projects', 'Supporting and Delivering assigned Internal and External Projects\r\n\r\n1. I will be working on upcoming Etisalat Kubernetes Project.\r\n\r\n2. I will be supporting for SyslogNG migration project.\r\n\r\n3. I will be supporting for Optimization and maintaining of Ansible projects for client ‘Virgin Media O2’.', 1, 0, '2022-06-23 15:03:25', '2022-06-23 15:03:25', '2022-23'),
(288, 71, 2, 'Effectively Delivering Trainings', 'Delivering assigned trainings (internal/external).', 2, 0, '2022-06-23 15:03:51', '2022-06-23 15:03:51', '2022-23'),
(289, 71, 2, 'Thinknyx’s Internal Technical Initiatives: -', '1. Sharing Technical News for Newsletter each month\r\n\r\n2. Working on TAP Portal and providing various questions on monthly basis', 3, 0, '2022-06-23 15:04:12', '2022-06-23 15:04:12', '2022-23'),
(290, 71, 2, 'Creating Presentation Docs/ Technical Documents', '1. Creating Technical Documentations such as PPT\'s, Guides, Blogs, SOP, Cheat-sheets', 4, 0, '2022-06-23 15:04:41', '2022-06-23 15:04:41', '2022-23'),
(291, 71, 3, 'Professional Development Plan Goals', 'I will be working on my communication skills.\r\n\r\n- Growing my skillsets in Kubernetes, Docker and Openshift as these technologies are required for future phases of ongoing projects\r\n\r\n- I will be handling client calls in near future and prepare myself to handle critical situations which will help me grow as on professional as well as on personal level.\r\n\r\n- I will be preparing myself on technical level and grow from beginner to intermediate and advance in near future.', 1, 0, '2022-06-23 15:05:11', '2022-06-23 15:05:11', '2022-23'),
(292, 72, 2, 'As a TRAINER:', 'Goal 1: \r\n--SOC Training Program:: To deliver\r\n-- OS & DB Basics \r\n-Automation Scripting\r\nGoal 2:\r\n-- Learn new technologies::\r\n--Cloud Basics\r\n   (AWS,GCP,Azure)\r\n--Linux Fundamentals', 1, 1, '2022-06-26 02:33:55', '2023-05-07 16:04:58', '2022-23'),
(293, 72, 3, 'Learn new technologies::', '--Cloud Basics\r\n   (AWS,GCP,Azure)\r\n--Linux Fundamentals\r\nAttain Certifications\r\n--RHCSA\r\n--RHCE', 1, 1, '2022-06-26 02:35:33', '2023-05-07 16:04:58', '2022-23'),
(294, 72, 2, 'As an Asst. MANAGER:', 'Goal 1:\r\nHandling Program E2E\r\nGoal 2:\r\n--Improving Processes using automotive ways.', 2, 1, '2022-06-26 02:37:05', '2023-05-07 16:04:58', '2022-23'),
(295, 74, 2, 'Training Deliver', 'Aim to learn and deliver training for various technologies like Cloud and Microservice', 3, 0, '2022-06-30 08:08:41', '2022-06-30 09:28:20', '2022-23'),
(296, 74, 2, 'Project owner to Solution Architect', 'Short-term objective: Take ownership of the project and carry it out successfully.\r\nLong-term objective: To be a Solution Architect for DevOps.', 4, 0, '2022-06-30 08:24:52', '2022-06-30 08:24:52', '2022-23'),
(297, 64, 2, 'Increase Thinknyx outreach', 'Outreaching to new clients and in turn increasing brand awareness. KPI – Increased number of clients, Increased number of training requests.', 1, 2, '2022-07-01 09:26:09', '2022-08-04 14:06:41', '2022-23'),
(298, 64, 2, 'Managing Talent Transformation Vertical', 'End to end management of Thinknyx’s Training Vertical. KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors, increased profits.', 2, 2, '2022-07-01 09:26:31', '2022-08-04 14:06:41', '2022-23'),
(299, 64, 2, 'Increase Staffing Business Vertical', 'Creating awareness among the existing and new clients for staffing vertical and bringing business on the table.', 3, 2, '2022-07-01 09:27:04', '2022-08-04 14:06:41', '2022-23'),
(300, 64, 2, 'Thinknyx Internal Initiatives', 'Creating Presentations, documents, proposals etc as and when required by the team. KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 2, '2022-07-01 09:27:35', '2022-08-04 14:06:41', '2022-23'),
(301, 64, 2, 'Team Management', 'Managing direct reports efficiently. KPI - Feedback of the internal and external stakeholders.', 5, 2, '2022-07-01 09:28:10', '2022-08-04 14:06:41', '2022-23'),
(302, 64, 3, 'Improving MS Office and Softskill Skills', 'Will work towards gaining knowledge on MS office and Softskill area.', 1, 2, '2022-07-01 09:43:21', '2022-08-04 14:06:41', '2022-23'),
(303, 67, 2, 'Talent Acquisition Specialist', 'Coordinate with hiring managers to identify staffing needs in different areas and departments.\r\n\r\nWith full-cycle recruiting, using various interview techniques and evaluation methods.\r\n\r\nHands on exposure on closing niche and senior / leadership roles with minimal intervention.\r\n\r\nHands on exposure on closing niche and senior / leadership roles with minimal intervention.\r\n\r\nSource potential applicants through online channels, such as Naukri, LinkedIn and other professional networks and references.\r\n\r\nDeveloped contacts through new joiners and helped sourcing maximum candidates under the referral scheme.\r\n\r\nCoordinate with department managers to forecast future hiring needs.\r\n\r\n- Forecast quarterly and annual hiring needs by department.\r\n\r\n- Develop long-term recruiting strategies and future trusting relationships with potential hires.', 1, 0, '2022-07-03 22:52:37', '2022-07-04 10:26:20', '2022-23'),
(304, 67, 3, 'Client Interaction', '- building relationships with clients to ensure that their needs are met, they are satisfied with the services and/or products provided by the company and any challenges are overcome.', 1, 0, '2022-07-04 10:27:21', '2022-07-04 10:27:21', '2022-23'),
(305, 67, 2, 'Vendor Relationship Management Process', '- Communication, \r\n-built partnership\r\n-create a win win situation.', 2, 0, '2022-07-04 10:28:42', '2022-07-04 10:28:42', '2022-23'),
(306, 67, 2, 'Communication and Interpersonal Skills Development', '-Improve Communication Skills \r\n-Email Etiquettes', 3, 0, '2022-07-04 10:29:28', '2022-07-04 10:29:28', '2022-23'),
(307, 67, 2, 'Database Management', '-Proficiency in documenting processes and keeping up with industry trends.\r\n \r\n- Maintaining the applicant\'s entire data in an excel sheet', 4, 0, '2022-07-04 10:30:03', '2022-07-04 10:30:03', '2022-23'),
(308, 66, 2, 'Client Handling', '	Maintaining credible relationship with clients by committed on timely delivery and consistent sustenance of quality profile.\r\n•	Maintain maximum 48 hours TAT on profile delivery from date & time of order receivable \r\n•	Target 100% match from JD’s. (Measurement is applicable if clear JD provided by client) \r\n	Agile on resolving client queries and develop strategies for improving customer services.\r\n•	Maintain maximum 1-day TAT\r\n	Customer focus approached by being adaptable to understand the client need, pattern and behaviour\r\n•	Maintain 95% repeat order from client base', 1, 2, '2022-07-04 10:45:35', '2022-08-04 14:07:45', '2022-23'),
(309, 66, 2, 'Vendor Management', '	To tie up with external consultants for meeting PAN India requirements (vendors/Portals etc)\r\n	To follow up on TAT for critical position\r\n•	Maintain maximum 24 hours TAT on profile delivery from date & time of order receivable \r\n	Analysis on vendor productivity on quarterly basis \r\n	Managing Vendors KPI\r\n•	Quality\r\n•	Delivery\r\n•	Discipline\r\n•	Productivity\r\n•	Compliance', 2, 2, '2022-07-04 10:47:01', '2022-08-04 14:07:45', '2022-23'),
(310, 66, 2, 'People Management', '	Enable people performance by imparting continuous learning through training and guidance \r\n	Educating team to enterprise priorities, competition and required capabilities \r\n	Maintain high performance and engaged workforce \r\n	Attrition rate of High performers cannot be more than 3% \r\no	The definition of high performance means Cluster 1 performers.i.e. A & A+ PMS rated\r\no	High performers (HP)attrition means\r\n “No. of HP exit/HP average strength*100', 3, 2, '2022-07-04 10:49:57', '2022-08-04 14:07:45', '2022-23'),
(311, 66, 2, 'Updation of Recruitment Tracker and sharing of Information', '	Updation of all Resource Requisition\r\n	To update recruitment tracker with details such as (recruiter/no.of position/no. Of profiles shared/Turnaround Time/position closed/existing position) on daily basis', 4, 2, '2022-07-04 10:51:00', '2022-08-04 14:07:45', '2022-23'),
(312, 66, 2, 'Database Management', '	To keep track of all profiles being forwarded for a particular position\r\n	To ensure maintenance of database of profiles received via walk-in/references/e-mails\r\n	Maintain strong data base based on following: \r\n•	Strategic position profiles data base like CIO, CXO, CFO, CTO, CHRO, CEO\r\n•	Niche profile those rarely available in market\r\n•	High entry load profile (to reduce searching time)\r\n•	Futuristic profiles based on change in technology, pattern and behaviour of business and the model\r\n	The futuristic profile collection would be based on maximum 3 year of forecast for industries. The data would be collected from business existing clients, magazine and journals as well as SBP document of my organization.', 5, 2, '2022-07-04 10:52:01', '2022-08-04 14:07:45', '2022-23'),
(313, 66, 3, 'Productivity Management', '	Revenue realization from Team\r\n	Revenue realization from Vendor \r\n	Productivity analysis of each team member \r\n	Profile selection rate Vs Profile rejection rate \r\n	Candidate Selection Vs Rejection Rate Vs Offer Rejection Rate Vs Joining Rate', 1, 2, '2022-07-04 10:53:12', '2022-08-04 14:07:45', '2022-23'),
(314, 69, 2, 'PMS-Goal 2022-23', 'S.NO. Deliverables KRA(S) KPI Weightage\r\n\r\n1 Talent- Acquisition Process · Handling end-to-end recruitment cycle till closure of the postion · Shortlisting & screening candidates profiles, Interview Coordination,Salary Negotiation, Refrence check , Closing formalities etc. -Targeting of at atleast 2 offers (on monthly basis) 70%\r\n\r\n2 Updation of Recruitment Tracker To update recruitment tracker with details which includes( no. of postion/no. of profiles shared/postion closed etc on daily basis)as record Maintaning 100percent of recruitment tracker on daily and monthly basis(which would be helpful to get information for all current/old records of candidates) 5%\r\n\r\n3 Database Management · To keep all track records of profiles regarding a particular postion · To keep record of databases -Updating the database -keeping the proper records 10%\r\n\r\n4 Vendor Management · To tie up with external consultants for meeting PAN India requirements(vendors/Portals etc -Tieing up with 2-3 vendors for Financial year 5%\r\n\r\n5 Upgradation of New Technologies To innovate new ideas for development of work process -To bring out innovatve ideas for company, which can help in growth of recruitment& company.\r\n\r\n-Suggesting new clients for company', 1, 0, '2022-08-07 21:39:33', '2022-08-07 21:39:33', '2022-23'),
(315, 68, 2, 'External Project Implementation', 'Contribute to implementing the use cases, requirements, and documentation as per the needs of each client or project. Currently playing a supporting role in the ETS project for OpenStack Ansible and implementing TF modules of Azure on TFE and GitLab.\r\nLearning Ansible by writing roles and playbooks to prepare myself for the Virgin 02 project. Learn and play around to become proficient in Docker, K8s and OpenShift for the upcoming projects.\r\n\r\nKPI: Quality of code, TAT, Feedback from clients', 1, 1, '2022-10-17 11:20:52', '2022-10-17 11:23:44', '2022-23'),
(316, 68, 2, 'Internal Project/Task Implementation', 'Support Suraj and the team to keep TAP updated with the right question sets. Brainstorm and bring out ideas for Phase-2 of TAP.\r\nAutomate repetitive tasks required for the training by writing TF scripts and modules, Ansible playbooks and setting up a pipeline for the execution.\r\n\r\nKPI: Performance of TAP Phase-1, Quality of code, TAT, Ease of conducting lab exercises, Feedback from trainers and zero cost wastage on cloud platforms', 2, 1, '2022-10-17 11:21:38', '2022-10-17 11:23:44', '2022-23'),
(317, 68, 2, 'Talent Reformation', 'Deliver training on the concepts of Cloud Computing, AWS, Azure, Terraform and Ansible.\r\nPrepare for training on the different tools involved in the CI/CD and keep myself updated with the new releases of tools.\r\n\r\nKPI: TAT, Feedback from stakeholders, minimum errors, and zero Lab cost wastage', 3, 1, '2022-10-17 11:22:08', '2022-10-17 11:23:44', '2022-23'),
(318, 68, 2, 'Content Creation', 'Create content for Podman through a series of blogs and videos. Promote the content written in the right community.\r\nPlan and create a content roadmap for the TAP tools. Write blogs leading to TAP to gain traffic.\r\n\r\nKPI: Performance of blogs, Organic traffic on Thinknyx website, Lead conversions to TAP', 4, 1, '2022-10-17 11:22:24', '2022-10-17 11:23:44', '2022-23'),
(319, 68, 2, 'Learning', 'Attend training and perform labs to learn new concepts and tools. Write code and learn to\r\nbe prepared for any requirement.\r\nLearn concepts in architecture and CI/CD and prepare to handle client calls. Conduct KT\r\nsessions with the tech team on the technologies I’d be learning.\r\n\r\nKPI: Feedback from internal tech. team, CI/CD tools ability, and architectural capability', 5, 1, '2022-10-17 11:22:46', '2022-10-17 11:23:44', '2022-23'),
(320, 68, 3, 'Professional Development Plan', '• Improve your professional and networking relationships.\r\n• Become proficient in Docker and Containerization technology\r\n• Read books relevant to DevOps, Soln. Architecture, and tools involved in CI/CD\r\n• Take up leadership responsibilities\r\n• Improve your communication skills in the workplace.\r\n\r\nKPI: Communicational, professional and leadership ability', 1, 1, '2022-10-17 11:23:20', '2022-10-17 11:23:44', '2022-23'),
(321, 63, 2, 'test 1', 'test 1ffff', 1, 1, '2023-03-28 14:23:39', '2023-03-28 14:31:05', '2022-23'),
(322, 63, 2, 'test 2', 'test 2', 2, 1, '2023-03-28 14:23:51', '2023-03-28 14:31:05', '2022-23'),
(323, 63, 2, 'test 3', 'test 3', 3, 1, '2023-03-28 14:24:03', '2023-03-28 14:31:05', '2022-23'),
(324, 63, 2, 'test 4', 'test 4', 4, 1, '2023-03-28 14:24:16', '2023-03-28 14:31:05', '2022-23'),
(325, 63, 3, 'pdp test 2', 'pdp', 1, 1, '2023-03-28 14:24:32', '2023-03-28 14:31:05', '2022-23'),
(326, 63, 2, 'test 5', 'test 5', 5, 1, '2023-03-28 14:24:45', '2023-03-28 14:31:05', '2022-23'),
(327, 0, 1, 'Innovation – New initiatives that have not seen before in Thinknyx, must be measurable at least once per year (eventually more often), customer focused, and ultimately delivering value.', 'Objective –Innovation involves new ideas or processes, better solutions to meeting customer needs, or achieving a goal in a new way. Combined, they are key to providing businesses with a competitive edge.\r\nKPI (metric) – No. of successful new value initiatives launched and related feedback by the stakeholders.', 1, 0, '2023-04-07 05:00:00', '2023-04-07 05:00:00', '2023-24'),
(328, 0, 1, 'Internal Knowledge Sharing – Self Driven knowledge sharing sessions for internal Thinknyx team in order to build organizational skills and capabilities.', 'Objective – Create a learning culture and build internal skills and capabilities.\r\nKPI (metric) – No. of internal sessions delivered and feedback received by the participants.', 2, 0, '2023-04-07 05:00:00', '2023-04-07 05:00:00', '2023-24'),
(329, 0, 1, 'Technical Documentation - Publishing Technical Blog and Technical PPT (short video) one each every month.', 'Objective – Blogging enables you to reach the billions of people that use the Internet. Blogging help you promote yourself or your business. It will in turn help an employee to enhance his/her writing and logical skills.\r\nKPI (metric) – No. of blogs and videos published.', 3, 0, '2023-04-07 05:00:00', '2023-04-07 05:00:00', '2023-24'),
(330, 0, 1, 'Internal and External Customer Satisfaction (Internal Customers are Thinknyx’s employees)', '1. Increase customer satisfaction scores by 10% over the next 3 quarters (Q2,Q3, Q4).\r\nObjective – Higher customer satisfaction scores = happier customers = less churn and more referrals.\r\nKPI (metric) – Customer satisfaction ratings on post-support survey.\r\n2. Improve number of “fully satisfied” customer ratings of the support they received by 10% over the next three quarters (Q2, Q3, Q4).\r\nObjective - Unless a problem is 100% solved, a customer will not be fully satisfied.\r\nKPI (metric) – A “fully satisfied” (or similar) rating on a post – support survey.', 4, 0, '2023-04-07 05:00:00', '2023-04-07 05:00:00', '2023-24'),
(331, 0, 1, 'Living by the Thinknyx’s core values and behaviours – Demonstrate company core values and behaviour on day to day basis while collaborating with internal and external customers.', 'Objective – Alignment between organizational values and an individual values helps in seamless operations and maintains the company culture.\r\nKPI (metric) – Peer Feedback, Customer feedback.', 5, 0, '2023-04-07 05:00:00', '2023-04-07 05:00:00', '2023-24'),
(332, 72, 2, 'Revamp in Connect Portal, adding new Sections in Newsletter,', 'I have added Managerial access to Connect, would make changes in Connect Portal as and when required. Would be developing Internal projects to automate the tasks.', 1, 1, '2023-05-07 14:47:17', '2023-05-07 16:04:58', '2023-24'),
(333, 72, 2, 'Linux Sessions', 'Have been delivering Linux sessions to increase internal strength, would be delivering such sessions on different technologies like cloud basics, aws to the new joinees.', 2, 1, '2023-05-07 14:53:37', '2023-05-07 16:04:58', '2023-24'),
(334, 72, 2, 'Technology Videos, promotional videos and Cheatsheets', 'Have been delivering technology videos one every month for Thinknyx YouTube channel, two YouTube shorts every month. I will be creating promotional videos, png and GIFs for TAP, thinknyx.com. I will continue to do the same in future. Have helped in preparation of Technology Cheatsheets and will be doing too.', 3, 1, '2023-05-07 15:05:16', '2023-05-07 16:04:58', '2023-24'),
(335, 72, 2, 'Internal feedbacks and External Feedbacks', 'Internal feedbacks for my work in trainings and Internal Projects, I will focus on getting full 100%, I have been working on tasks and will try to deliver the same in this year too. I will put my best efforts to handle E2E meetings in a better way, be it assigning co-organizers in my absence or flawless online conduction of trainings. I will deliver more trainings on technologies like DevOps- Docker, Kubernetes, CI/CD,AWS ,Azure. and put best efforts for learning Ansible. Will get 9 and above out of 10 on all my trainings. I will be delivering feedback report to the external customer without anomalies.', 4, 1, '2023-05-07 15:37:47', '2023-05-07 16:04:58', '2023-24'),
(336, 72, 2, 'Thinknyx Core Values', 'Will be delivering my task internally and externally on time with perfection, by studying each delivery thoroughly. Collaborate with my colleagues for a better performance.', 5, 1, '2023-05-07 16:01:29', '2023-05-07 16:04:58', '2023-24'),
(337, 72, 3, 'Enhance my skills for delivering trainings.s', 'I would be preparing for certifications (AWS, GCP) for upgrading my training skills.', 1, 1, '2023-05-07 16:04:32', '2023-05-07 16:04:58', '2023-24');

-- --------------------------------------------------------

--
-- Table structure for table `goals_bkk`
--

CREATE TABLE `goals_bkk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `goal_type` tinyint(5) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_no` tinyint(5) DEFAULT NULL,
  `status` tinyint(5) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fy` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals_bkk`
--

INSERT INTO `goals_bkk` (`id`, `user_id`, `goal_type`, `title`, `description`, `order_no`, `status`, `created_at`, `updated_at`, `fy`) VALUES
(1, 59, 2, 'Thinknyx’s Internal Technical Initiatives', 'Docker Lint by Oct’2020\r\nMailer Utility by Nov’2020\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 1, 2, '2020-09-22 11:25:31', '2020-09-22 11:33:11', NULL),
(2, 59, 2, 'Technical Client Projects: Delivering assigned projects', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 2, 2, '2020-09-22 11:25:51', '2020-09-22 11:33:11', NULL),
(3, 59, 2, 'Effectively Delivering Trainings: Delivering assigned trainings.', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors, minimum/zero Lab cost wastage.', 3, 2, '2020-09-22 11:26:04', '2020-09-22 11:33:11', NULL),
(4, 59, 2, 'Team Management: Managing direct reports efficiently.', 'KPI - Feedback of the stakeholders', 4, 2, '2020-09-22 11:26:20', '2020-09-22 11:33:11', NULL),
(5, 59, 2, 'Learning and Implementing Latest Technologies: Learning and Implementing latest technologies in ongoing projects and training assignments.', 'KPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 2, '2020-09-22 11:26:36', '2020-09-22 11:33:11', NULL),
(6, 59, 3, 'Improving Communication Skills', 'Need to work on improving the communication and speaking skills.', 1, 2, '2020-09-22 11:27:21', '2020-09-22 11:33:11', NULL),
(7, 62, 2, 'Supporting Projects', 'Learning new technologies as instructed and supporting projects with respect to the assigned task. (Eg. Learning RPA etc)\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum error', 1, 0, '2020-09-22 11:56:03', '2020-09-22 11:56:03', NULL),
(8, 62, 2, 'Supporting Development Projects', 'Application Testing -Improve Testing process to dig out minute errors/bugs for application to be fully ready to go live.\r\nContainerization of AMS application -Explore Containers, Docker to able to implement containerization of AMS application.\r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the   defined timelines, zero or minimum errors.', 2, 0, '2020-09-22 11:57:25', '2020-09-22 11:59:24', NULL),
(9, 62, 2, 'Thinknyx’s internal Technical Initiatives', 'Creating Automation of applications through github actions with running scripts which will save time in future.\r\nHandling the deployment of applications on thinknyxserver, maintaining related technical documentation of every new application deployed. \r\nKPI - Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 3, 0, '2020-09-22 11:58:31', '2020-09-22 11:59:46', NULL),
(10, 62, 2, 'Creating Presentation Decks/ Technical Documents', 'Creating Presentations & Technical documents as when required by the team. \r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 4, 0, '2020-09-22 12:00:31', '2020-09-22 12:00:31', NULL),
(11, 62, 2, 'RPA Use Cases', 'Monthly one use case along with Documentation and Demo.\r\nKPI – Feedback of the stakeholders, TAT (Turn Around Time) as per the defined timelines, zero or minimum errors.', 5, 0, '2020-09-22 12:01:02', '2020-09-22 12:01:02', NULL),
(12, 62, 3, 'Communication Skills', 'Improving Communication Skills', 1, 0, '2020-09-22 12:02:06', '2020-09-22 12:08:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `days` float NOT NULL,
  `reason` text NOT NULL,
  `manager_comment` varchar(255) DEFAULT NULL,
  `up_file` varchar(50) DEFAULT NULL,
  `leave_type_offer` tinyint(4) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fy` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `date_from`, `date_to`, `days`, `reason`, `manager_comment`, `up_file`, `leave_type_offer`, `is_approved`, `created_at`, `updated_at`, `fy`) VALUES
(18, 61, 'Sick Leave', '2020-09-18', '2020-09-18', 1, 'Sick Leave', 'Approved', '', 0, 1, '2020-09-17 17:41:49', '2020-10-03 21:52:40', '2020-21'),
(19, 61, 'Casual Leave', '2020-10-17', '2020-10-17', 1, 'I have some urgent work . So I need one day leave . Please Approve my leave .', 'Approved', '', 0, 1, '2020-10-16 18:12:21', '2020-11-18 00:25:27', '2020-21'),
(20, 60, 'Casual Leave', '2020-11-19', '2020-11-20', 2, 'Hello Mam,\r\n\r\nPlease grant me 2 days leave on occasion of Chhat Puja on 19th of November and 20th of November.', 'Approved', '', 0, 1, '2020-11-18 11:17:01', '2020-11-19 20:41:48', '2020-21'),
(21, 62, 'Casual Leave', '2021-02-23', '2021-02-23', 1, 'Personal Work', NULL, '', 0, 1, '2021-02-22 21:15:18', '2021-03-11 15:01:21', '2020-21'),
(22, 62, 'Casual Leave', '2021-02-23', '2021-02-23', 1, 'Personal Work', 'Approved', '', 0, 1, '2021-02-22 21:15:48', '2021-03-11 15:00:59', '2020-21'),
(23, 74, 'Casual Leave', '2022-05-09', '2022-05-09', 1, 'Complete the exit process from previous Organization.', 'Abhishek informed that he wants to cancel the leave and was working on this day.', '', 0, 2, '2022-05-04 13:09:58', '2022-05-06 12:18:38', '2022-23'),
(24, 74, 'Casual Leave', '2022-05-09', '2022-05-09', 1, 'Complete the exit process from previous Organization.', 'Approved', '', 0, 1, '2022-05-06 14:39:26', '2022-05-12 12:30:21', '2022-23'),
(25, 71, 'Annual Leave', '2022-05-13', '2022-05-13', 1, 'Family Function', 'Approved', '', 0, 1, '2022-05-12 17:13:39', '2022-05-16 13:14:24', '2022-23'),
(26, 73, 'Casual Leave', '2022-05-18', '2022-05-20', 3, 'Sister\'s Wedding', 'Please apply these 3 leaves again including unpaid leave.', '', 0, 3, '2022-05-16 16:37:17', '2022-05-18 11:59:37', '2022-23'),
(27, 76, 'Casual Leave', '2022-05-23', '2022-05-25', 3, 'Testing issue', NULL, '', 0, 2, '2022-05-31 00:20:15', '2022-06-02 15:06:26', '2022-23'),
(28, 73, 'Casual Leave', '2022-05-18', '2022-05-20', 3, 'Sisters Marriage', NULL, '', 0, 2, '2022-05-31 14:10:20', '2022-06-23 11:49:27', '2022-23'),
(29, 75, 'Annual Leave', '2022-05-06', '2022-05-11', 4, 'Trip Delhi to Kedarnath with brother.', NULL, '', 0, 1, '2022-05-31 14:19:34', '2022-06-02 15:04:56', '2022-23'),
(30, 71, 'Annual Leave', '2022-05-06', '2022-05-06', 1, 'Personal reason', NULL, '', 0, 1, '2022-05-31 14:29:56', '2022-06-02 15:04:27', '2022-23'),
(31, 72, 'Sick Leave', '2022-06-01', '2022-06-02', 2, 'Down with fever', 'Approved', '', 0, 1, '2022-06-01 08:04:48', '2022-06-02 15:06:03', '2022-23'),
(32, 70, 'Casual Leave', '2022-06-09', '2022-06-09', 1, 'Family Function', 'Approved.', '', 0, 1, '2022-06-06 11:34:02', '2022-06-08 12:22:35', '2022-23'),
(33, 70, 'Casual Leave', '2022-06-16', '2022-06-17', 2, 'Family Function', 'Approved.', '', 0, 1, '2022-06-06 11:35:33', '2022-06-08 12:22:16', '2022-23'),
(34, 73, 'Casual Leave', '2022-06-01', '2022-06-01', 1, 'Internet Issues', 'Approved.', '', 0, 1, '2022-06-08 17:05:58', '2022-06-08 17:20:46', '2022-23'),
(35, 72, 'Annual Leave', '2022-06-03', '2022-06-10', 7, 'sick', 'Please apply unpaid leave and annual leaves seprately', '', 0, 2, '2022-06-10 00:22:51', '2022-06-23 11:47:10', '2022-23'),
(36, 63, 'Annual Leave', '2022-06-01', '2022-06-01', 1, 'Test', 'testing purpose', '', 0, 2, '2022-06-23 11:43:53', '2022-06-23 11:46:00', '2022-23'),
(37, 66, 'Sick Leave', '2022-07-08', '2022-07-08', 1, 'I have my Laparoscopic Gall Bladder Surgery on 8th July.', 'Approved', '', 0, 1, '2022-07-04 11:28:30', '2022-08-04 14:05:32', '2022-23'),
(38, 71, 'Annual Leave', '2022-07-13', '2022-07-14', 2, 'Personal Reason', 'Approved', '', 0, 1, '2022-07-06 14:04:12', '2022-08-04 14:05:00', '2022-23'),
(39, 68, 'Casual Leave', '2022-07-29', '2022-07-30', 1, 'Hello everyone, I will be away tomorrow as I will be out of town and will be back on Monday.', 'Approved', '', 0, 1, '2022-07-28 11:17:16', '2022-08-04 14:04:39', '2022-23'),
(40, 66, 'Sick Leave', '2022-07-11', '2022-07-11', 1, 'I had my Gall Bladder Surgery(Recovery)', NULL, '', 0, 1, '2022-08-05 15:30:25', '2022-08-08 13:53:35', '2022-23'),
(41, 69, 'Casual Leave', '2022-08-02', '2022-08-02', 1, 'Urgent-Famliy Work !!', NULL, '', 0, 1, '2022-08-07 13:59:12', '2022-08-08 13:55:34', '2022-23'),
(42, 69, 'Sick Leave', '2022-08-04', '2022-08-04', 1, 'Sick Leave-Was not well !!', NULL, '', 0, 1, '2022-08-07 14:00:35', '2022-08-08 13:55:17', '2022-23'),
(43, 69, 'Casual Leave', '2022-08-23', '2022-08-23', 1, 'Personal urgent work!!', 'Rejecting as per your email', '', 0, 2, '2022-08-07 14:03:43', '2022-08-08 13:54:30', '2022-23'),
(44, 70, 'Casual Leave', '2022-08-18', '2022-08-19', 2, 'Personal', 'Approved.', '', 0, 1, '2022-08-16 09:10:29', '2022-08-24 12:11:43', '2022-23'),
(45, 66, 'Casual Leave', '2022-08-24', '2022-08-26', 3, 'Going to Hyderabad for a Family Function', 'Approved.', '', 0, 1, '2022-08-17 13:28:11', '2022-08-24 12:11:18', '2022-23'),
(46, 73, 'Annual Leave', '2022-08-19', '2022-08-19', 1, 'Out of town', 'approved', '', 0, 1, '2022-08-21 19:32:15', '2022-08-24 12:10:55', '2022-23'),
(47, 68, 'Casual Leave', '2022-08-29', '2022-08-29', 1, 'Hello everyone, I am out of the station and there is heavy rainfall here, because of which I won\'t be able to travel back before evening.', 'Approved', '', 0, 1, '2022-08-29 07:04:34', '2023-03-06 14:03:15', '2022-23'),
(48, 67, 'Annual Leave', '2022-08-30', '2022-08-30', 1, 'Teej festival', 'Approved', '', 0, 1, '2022-08-29 09:50:48', '2023-03-06 14:02:41', '2022-23'),
(49, 62, 'Casual Leave', '2022-09-08', '2022-09-09', 2, 'I will be traveling for the Ganesh Chaturthi festival.', NULL, '', 0, 1, '2022-09-06 18:08:15', '2023-03-06 14:00:28', '2022-23'),
(50, 70, 'Sick Leave', '2022-09-15', '2022-09-15', 1, 'Medical Urgency', 'Approved', '', 0, 1, '2022-09-16 10:35:15', '2023-03-06 14:02:05', '2022-23'),
(51, 75, 'Casual Leave', '2022-10-20', '2022-10-21', 2, 'Travel', 'Approved', '', 0, 1, '2022-10-19 10:25:35', '2023-03-06 14:01:46', '2022-23'),
(52, 77, 'Casual Leave', '2022-10-20', '2022-10-20', 1, 'I have my son\'s sports day tomorrow.', 'Approved', '', 0, 1, '2022-10-19 10:53:54', '2023-03-06 14:01:25', '2022-23'),
(53, 70, 'Casual Leave', '2022-10-19', '2022-10-20', 2, 'Personal', 'Approved', '', 0, 1, '2022-10-19 12:36:39', '2023-03-06 14:01:09', '2022-23'),
(54, 62, 'Casual Leave', '2022-10-26', '2022-10-27', 2, 'Diwali Celebration', 'Approved', '', 0, 1, '2022-10-21 14:49:48', '2023-03-06 14:00:45', '2022-23'),
(55, 68, 'Casual Leave', '2022-10-26', '2022-10-27', 2, 'Out of station.', 'Approved', '', 0, 1, '2022-10-25 11:46:23', '2023-03-06 14:00:08', '2022-23'),
(56, 75, 'Annual Leave', '2022-10-26', '2022-10-27', 2, 'Personal Reason', NULL, '', 0, 1, '2022-10-25 12:34:31', '2023-03-06 13:59:13', '2022-23'),
(57, 77, 'Sick Leave', '2022-11-22', '2022-11-22', 1, 'Was down with fever and cold.', NULL, '', 0, 1, '2022-11-23 10:03:03', '2023-03-06 13:58:52', '2022-23'),
(58, 68, 'Casual Leave', '2022-12-19', '2022-12-23', 5, 'I would require vacation from December 19th to December 23rd (5 days).', 'Approved', '', 0, 1, '2022-11-24 16:57:34', '2023-03-06 13:59:52', '2022-23'),
(59, 62, 'Casual Leave', '2022-12-19', '2022-12-19', 1, 'Personal reason', NULL, '', 0, 1, '2022-12-15 12:51:57', '2023-03-06 13:58:01', '2022-23'),
(60, 62, 'Casual Leave', '2022-12-28', '2022-12-30', 3, 'I will be out of station', NULL, '', 0, 1, '2022-12-15 12:54:03', '2023-03-06 13:58:31', '2022-23'),
(61, 70, 'Casual Leave', '2022-12-06', '2022-12-09', 4, 'Personal Medical Urgency', NULL, '', 0, 1, '2022-12-15 16:59:23', '2023-03-06 13:57:41', '2022-23'),
(62, 64, 'Annual Leave', '2023-01-27', '2023-01-30', 2, 'Personal', NULL, '', 0, 1, '2023-01-25 18:22:26', '2023-03-06 13:57:14', '2022-23'),
(63, 77, 'Sick Leave', '2023-01-25', '2023-01-25', 1, 'Was down with fever', NULL, '', 0, 1, '2023-01-27 10:01:02', '2023-03-06 13:57:09', '2022-23'),
(64, 77, 'Annual Leave', '2023-02-15', '2023-02-17', 3, 'Personal Work', 'Approved', '', 0, 1, '2023-02-09 11:05:39', '2023-03-06 13:59:29', '2022-23'),
(65, 70, 'Annual Leave', '2023-01-30', '2023-02-03', 5, 'Personal', 'Approved', '', 0, 1, '2023-02-10 17:29:14', '2023-03-06 13:56:39', '2022-23'),
(66, 74, 'Casual Leave', '2023-02-24', '2023-02-24', 1, 'Personal Work', 'Approved', '', 0, 1, '2023-02-23 18:14:19', '2023-03-06 13:56:03', '2022-23'),
(67, 77, 'Annual Leave', '2023-03-09', '2023-03-09', 1, 'Need to attend a family function', 'Approved', '', 0, 1, '2023-03-03 11:26:26', '2023-03-06 13:55:40', '2022-23'),
(68, 77, 'Annual Leave', '2023-04-07', '2023-04-07', 1, 'Planning to go for a trip', 'Approved', '', 0, 1, '2023-03-03 11:27:53', '2023-03-06 13:55:21', '2022-23'),
(71, 63, 'Annual Leave', '2023-01-14', '2023-01-14', 0, 'Test', 'Rejected as was applied for Test Purpose', '', 0, 2, '2023-03-14 14:17:05', '2023-04-21 13:01:56', '2022-23'),
(73, 66, 'Sick Leave', '2023-02-07', '2023-02-10', 4, 'Health Issue', NULL, '', 0, 1, '2023-03-15 10:13:41', '2023-04-21 13:02:19', '2022-23'),
(74, 66, 'Casual Leave', '2023-03-10', '2023-03-10', 1, 'Not in Town', NULL, '', 0, 1, '2023-03-15 10:14:49', '2023-04-21 13:02:47', '2022-23'),
(75, 70, 'Casual Leave', '2023-03-23', '2023-03-23', 1, 'Personal', NULL, '', 0, 1, '2023-03-15 10:48:34', '2023-04-21 13:11:38', '2022-23'),
(76, 70, 'Casual Leave', '2023-05-01', '2023-05-05', 5, 'Visiting hometown', NULL, '', 0, 1, '2023-03-15 10:49:31', '2023-04-21 13:09:21', '2022-23'),
(77, 70, 'Sick Leave', '2023-04-11', '2023-04-11', 1, 'Not Well', NULL, '', 0, 1, '2023-04-12 10:48:20', '2023-04-21 13:11:55', '2023-24'),
(78, 66, 'Casual Leave', '2023-01-10', '2023-01-10', 1, 'Pooja Celebration', NULL, '', 0, 1, '2023-04-19 12:20:02', '2023-04-21 13:05:55', '2023-24'),
(79, 69, 'Sick Leave', '2023-01-11', '2023-01-11', 1, 'Sick Leave', NULL, '', 0, 1, '2023-04-20 08:53:59', '2023-04-21 13:06:45', '2023-24'),
(80, 69, 'Sick Leave', '2023-02-14', '2023-02-14', 1, 'Sick Leave', NULL, '', 0, 1, '2023-04-20 09:09:57', '2023-04-21 13:06:47', '2023-24'),
(81, 73, 'Sick Leave', '2023-01-12', '2023-01-12', 1, '.', NULL, '', 0, 1, '2023-04-20 11:05:29', '2023-04-21 13:12:03', '2023-24'),
(82, 73, 'Annual Leave', '2023-01-26', '2023-01-26', 1, '.', NULL, '', 0, 1, '2023-04-20 11:06:29', '2023-04-21 13:07:55', '2023-24'),
(83, 73, 'Annual Leave', '2023-02-20', '2023-02-20', 1, '.', NULL, '', 0, 1, '2023-04-20 11:07:23', '2023-04-21 13:07:58', '2023-24'),
(84, 73, 'Annual Leave', '2023-02-21', '2023-02-24', 4, '.', NULL, '', 0, 1, '2023-04-20 11:08:05', '2023-04-21 13:08:00', '2023-24'),
(85, 73, 'Annual Leave', '2023-03-04', '2023-03-04', 1, '.', NULL, '', 0, 1, '2023-04-20 11:08:54', '2023-04-21 13:12:13', '2023-24'),
(86, 73, 'Annual Leave', '2023-03-15', '2023-03-15', 1, '.', NULL, '', 0, 1, '2023-04-20 11:09:27', '2023-04-21 13:12:07', '2023-24'),
(87, 73, 'Annual Leave', '2023-03-31', '2023-03-31', 1, '.', NULL, '', 0, 1, '2023-04-20 11:10:06', '2023-04-21 13:08:07', '2023-24'),
(88, 69, 'Sick Leave', '2023-03-27', '2023-03-27', 1, 'Sick Leave', NULL, '', 0, 1, '2023-04-20 16:56:24', '2023-04-21 13:06:50', '2023-24'),
(89, 69, 'Sick Leave', '2023-04-14', '2023-04-14', 1, 'Sick Leave', NULL, '', 0, 1, '2023-04-20 17:01:33', '2023-04-21 13:07:12', '2023-24'),
(90, 67, 'Annual Leave', '2023-02-28', '2023-03-03', 4, 'Husband Heart Operation', NULL, '', 0, 1, '2023-04-20 18:02:43', '2023-04-21 13:06:13', '2023-24'),
(91, 67, 'Sick Leave', '2023-03-06', '2023-03-06', 1, 'Husband and son was sick', NULL, '', 0, 1, '2023-04-20 18:05:50', '2023-04-21 13:06:19', '2023-24'),
(92, 67, 'Annual Leave', '2023-04-19', '2023-04-19', 1, 'Wedding Anniversary', NULL, '', 0, 1, '2023-04-20 18:08:53', '2023-04-21 13:06:35', '2023-24'),
(93, 69, 'Sick Leave', '2023-04-17', '2023-04-17', 1, 'Sick Leave', NULL, '', 0, 1, '2023-04-20 20:22:59', '2023-04-21 13:06:55', '2023-24'),
(94, 69, 'Sick Leave', '2023-04-10', '2023-04-10', 1, 'Mother not well', NULL, '', 0, 1, '2023-04-20 21:28:26', '2023-04-21 13:07:37', '2023-24'),
(95, 69, 'Casual Leave', '2023-03-15', '2023-03-03', 3, 'Personal Work', NULL, '', 0, 1, '2023-04-20 21:31:00', '2023-04-21 13:07:16', '2023-24'),
(96, 69, 'Annual Leave', '2023-01-30', '2023-01-31', 2, 'Personal Leave-Work', NULL, '', 0, 1, '2023-04-20 21:32:54', '2023-04-21 13:07:19', '2023-24'),
(97, 72, 'Annual Leave', '2023-04-28', '2023-04-28', 1, 'Puja at my place', NULL, '', 0, 1, '2023-04-21 11:36:11', '2023-04-21 13:07:51', '2023-24'),
(98, 66, 'Casual Leave', '2023-01-02', '2023-01-02', 1, 'Personal Reason', NULL, '', 0, 1, '2023-04-21 13:34:25', '2023-04-21 14:18:58', '2023-24'),
(99, 67, 'Casual Leave', '2023-05-05', '2023-05-05', 1, 'Puja at home', NULL, '', 0, 1, '2023-04-24 16:51:43', '2023-05-02 15:20:07', '2023-24'),
(100, 72, 'Annual Leave', '2023-03-21', '2023-03-21', 0.5, 'Personal reasons had taken second half off', NULL, '', 0, 1, '2023-04-28 12:24:36', '2023-05-02 15:20:17', '2023-24'),
(101, 67, 'Annual Leave', '2023-04-06', '2023-04-06', 0.5, 'First half due to  personal reason.', NULL, '', 0, 1, '2023-04-28 13:01:08', '2023-05-02 15:19:47', '2023-24'),
(102, 67, 'Annual Leave', '2023-03-27', '2023-03-27', 0.5, 'Second half leave for husband checkup(Personal reason).', NULL, '', 0, 1, '2023-04-28 13:06:24', '2023-05-02 15:19:50', '2023-24'),
(103, 66, 'Casual Leave', '2023-05-08', '2023-05-08', 1, 'Personal Reason', NULL, '', 0, 0, '2023-05-09 15:36:22', '2023-05-09 15:36:22', '2023-24');

-- --------------------------------------------------------

--
-- Table structure for table `managesalaries`
--

CREATE TABLE `managesalaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `designation_type` varchar(255) NOT NULL,
  `working_days` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_10_044553_create_employees_table', 1),
(4, '2019_03_10_050306_create_admins_table', 1),
(5, '2019_03_10_050652_create_cities_table', 1),
(6, '2019_03_10_050845_create_departments_table', 1),
(7, '2019_03_10_050953_create_salaries_table', 1),
(8, '2019_03_14_025243_create_shifts_table', 1),
(9, '2019_03_17_061433_create_leaves_table', 1),
(10, '2019_03_17_094258_create_totalleaves_table', 1),
(11, '2019_03_17_114000_create_profiles_table', 1),
(12, '2019_03_18_061726_create_downloads_table', 1),
(13, '2019_03_24_051434_create_managesalaries_table', 1),
(14, '2019_03_25_143643_create_designations_table', 1),
(15, '2019_04_10_113018_create_advancepayments_table', 1),
(16, '2019_04_21_111757_create_events_table', 1),
(17, '2019_04_26_023012_create_calendars_table', 1),
(18, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(19, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(20, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(21, '2016_06_01_000004_create_oauth_clients_table', 2),
(22, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(23, '2023_05_17_041858_create_tasks_table', 2),
(24, '2023_05_17_055410_create_subtasks_table', 3),
(25, '2023_05_17_060137_subtask', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('atul.vashishat@gmail.com', '$2y$10$mtNANPAWE1YO5gnYpDD9Y.4364Bu2C4WmkUS5ATXH/oMYuQjtaV.C', '2020-08-26 09:28:41'),
('atul.vashishat@thinknyx.com', '$2y$10$F4LfoD5GSyPpOcSybSJd..AHjHqxoWwx36nKrb8P/0Ou4Te/x/8XO', '2020-12-24 23:18:05'),
('yogesh.raheja@thinknyx.com', '$2y$10$KJo7v.zjKBzPPvYHBjU9LuOGN1QON7M3kREFZ7ZoxT91BlRE0gcOK', '2021-11-17 14:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shift` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subtasks`
--

CREATE TABLE `subtasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assigned_to` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('To Do','In Progress','Completed','Approved') NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timesheetdetails`
--

CREATE TABLE `timesheetdetails` (
  `id` int(11) NOT NULL,
  `timesheet_id` int(11) NOT NULL,
  `working_mintus` int(10) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheetdetails`
--

INSERT INTO `timesheetdetails` (`id`, `timesheet_id`, `working_mintus`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 480, 'working on React native api up-to-date on connect server. some issue coming due to passport service', '2020-12-28 17:15:07', '2020-12-28 17:15:07'),
(2, 2, 480, 'AirBus Project', '2020-12-30 01:07:16', '2020-12-30 01:07:16'),
(3, 3, 480, 'Airbus Project', '2020-12-31 02:37:07', '2020-12-31 02:37:07'),
(4, 4, 480, 'Work on react native application . create .apk file and test apk file on mobile and solve issues', '2021-01-04 21:03:51', '2021-01-04 21:03:51'),
(5, 5, 480, 'AWS training :: Basic concepts about AWS.', '2021-01-04 21:05:44', '2021-01-04 21:05:44'),
(6, 6, 480, 'AWS Training: IAM aws account setup and all about IAM.', '2021-01-04 21:07:19', '2021-01-04 21:07:19'),
(7, 7, 480, 'AWS Training :: VPC network design on aws. All about VPC related . RDS, EC2', '2021-01-04 21:09:39', '2021-01-04 21:09:39'),
(8, 8, 480, 'AWS Training: Storage Services S3 and EBS. IAM roles, aws cloud watch, Scaling and Auto Scaling.', '2021-01-04 21:13:07', '2021-01-04 21:13:07'),
(9, 9, 480, 'Airbus Project', '2021-01-05 00:31:37', '2021-01-05 00:31:37'),
(10, 10, 480, 'Airbus Project\r\nChetan Bhai\'s Task on Ansible', '2021-01-06 00:17:14', '2021-01-06 00:17:14'),
(11, 11, 480, 'Airbus Project\r\nAnsible task by Chetan Bhai', '2021-01-06 23:59:36', '2021-01-06 23:59:36'),
(12, 12, 480, 'Airbus Project\r\nAnsible Task by chetan bhai', '2021-01-07 23:50:07', '2021-01-07 23:50:07'),
(13, 13, 480, 'AWS training : Load balancer , S3 client connect with SDK with AWS tool kit.', '2021-01-08 17:19:10', '2021-01-08 17:19:10'),
(14, 14, 480, 'AWS training : SQS , SNS AWS lambda and API gateway services', '2021-01-08 17:20:34', '2021-01-08 17:20:34'),
(15, 15, 480, 'AWS Training : Elastic Cache , AWS Elastic beanstalk, Cloud formation services', '2021-01-08 17:22:55', '2021-01-08 17:22:55'),
(16, 16, 480, 'AWS training : Cloud trail , AWS Config , Organization  and Elastic Container services', '2021-01-08 17:24:59', '2021-01-08 17:24:59'),
(17, 17, 480, 'Airbus Project\r\nAnsible task by Chetan bhai', '2021-01-09 01:31:27', '2021-01-09 01:31:27'),
(18, 18, 480, 'working on react native add leave .\r\nAWS create AMI for ams  working on it', '2021-01-11 22:14:39', '2021-01-11 22:14:39'),
(19, 19, 480, 'Airbus Project', '2021-01-12 00:55:11', '2021-01-12 00:55:11'),
(20, 20, 480, 'working on react native add leave api . AWS create AMI for ams :: some errors related to mysql working on it ..', '2021-01-12 22:09:18', '2021-01-12 22:09:18'),
(21, 21, 480, 'AirBus Project', '2021-01-12 23:48:59', '2021-01-12 23:48:59'),
(22, 22, 480, 'Airbus Project\r\nCapGemini Trainings', '2021-01-13 23:40:58', '2021-01-13 23:40:58'),
(23, 23, 480, 'Airbus Project', '2021-01-14 22:52:31', '2021-01-14 22:52:31'),
(24, 24, 480, 'DPASL Small points done . working on spam mail issue.  AMS aws AMI working on it', '2021-01-15 18:40:07', '2021-01-15 18:40:07'),
(25, 25, 480, 'React native :: drop down and calendar picker issue \r\nworking on it. AWS AMI AMS python done and working on mysql  RDS', '2021-01-15 18:41:50', '2021-01-15 18:41:50'),
(26, 26, 480, 'Airbus Project\r\nTrainings', '2021-01-15 21:49:02', '2021-01-15 21:49:02'),
(27, 27, 480, 'Work on mysql error in  install AMS on AWS server .\r\ntrying to solve that issue ..', '2021-01-15 22:07:30', '2021-01-15 22:07:30'),
(28, 28, 480, 'Team task description Call , AWS Training Preparations,\r\nAMS Installation on AWS done .', '2021-01-18 23:04:11', '2021-01-18 23:04:11'),
(29, 29, 480, 'Airbus Project', '2021-01-18 23:10:08', '2021-01-18 23:10:08'),
(30, 30, 480, 'Airbus Project', '2021-01-19 23:03:13', '2021-01-19 23:03:13'),
(31, 31, 480, 'AWS training preparation .  R&D related to quiz  portal.', '2021-01-20 22:01:25', '2021-01-20 22:01:25'),
(32, 32, 480, 'Video link done on thinknyx website. AMI created for AMS and Document Created with All steps . R&D related to quiz portal', '2021-01-20 22:04:48', '2021-01-20 22:04:48'),
(33, 33, 480, 'Airbus Project', '2021-01-20 22:18:45', '2021-01-20 22:18:45'),
(34, 34, 480, 'Airbus Project', '2021-01-21 23:51:18', '2021-01-21 23:51:18'),
(35, 35, 480, 'Quiz Portal Document. AWS auto scaling and load balancer. work with Himanshu related to HTML and Css', '2021-01-22 21:48:09', '2021-01-22 21:48:09'),
(36, 36, 480, 'Technologies Related Newsletter , Terraforms webinar and AWS AMS AMI final changes given by KUL SIR', '2021-01-22 21:53:10', '2021-01-22 21:53:10'),
(37, 37, 480, 'Airbus Project', '2021-01-22 23:54:41', '2021-01-22 23:54:41'),
(38, 38, 480, 'Doing R&D related to quiz portal that in which framework we have to start work on it WordPress or php or other framework. AWS S3 storage making content and then PPT work. final changes related to AMS document', '2021-01-25 21:49:11', '2021-01-25 21:49:11'),
(39, 39, 480, 'Airbus Project', '2021-01-25 22:36:36', '2021-01-25 22:36:36'),
(40, 40, 480, 'AWS S3 training Preparation . working on Core PHP Quiz projects in my local system.', '2021-01-27 22:12:41', '2021-01-27 22:12:41'),
(41, 41, 480, 'Airbus Project', '2021-01-27 23:06:23', '2021-01-27 23:06:23'),
(42, 42, 480, 'work with Himanshu Related to HTML and CSS.\r\nAWS s3 storage workshop created.\r\nQuiz portal working on local systems.', '2021-01-28 22:36:22', '2021-01-28 22:36:22'),
(43, 43, 480, 'Airbus Project', '2021-01-29 00:31:29', '2021-01-29 00:31:29'),
(44, 44, 480, 'Work with Himanshu related to HTML CSS.\r\nASW Session with S3Workshop.\r\nQuiz portal first draft created', '2021-01-29 22:20:55', '2021-01-29 22:20:55'),
(45, 45, 480, 'Airbus Project', '2021-01-29 22:49:20', '2021-01-29 22:49:20'),
(46, 46, 480, 'working on php objective questions.\r\nquiz portal working on landing page changes', '2021-02-01 22:13:11', '2021-02-01 22:13:11'),
(47, 47, 480, 'Airbus Project', '2021-02-02 00:09:45', '2021-02-02 00:09:45'),
(48, 48, 480, 'questions done and working on use case.\r\nquiz portal front page created and  working on inner page .', '2021-02-02 23:03:53', '2021-02-02 23:03:53'),
(49, 49, 480, 'Airbus Project', '2021-02-02 23:57:07', '2021-02-02 23:57:07'),
(50, 50, 480, 'Airbus Project \r\nQuiz Questions and Use Cases for portal', '2021-02-04 01:35:35', '2021-02-04 01:35:35'),
(51, 51, 480, 'work on quiz portal . login page changed . quiz linked with category also done', '2021-02-04 22:25:30', '2021-02-04 22:25:30'),
(52, 52, 480, 'Objective questions in php and one use case given to Monika Mam. work on quiz portal . quiz linked with category working on it', '2021-02-04 22:26:58', '2021-02-04 22:26:58'),
(53, 53, 480, 'Airbus Project\r\nQuiz Questions and Use Cases for thinknyx quiz portal', '2021-02-05 00:25:11', '2021-02-05 00:25:11'),
(54, 54, 480, 'quiz portal result page without login done .\r\nworking on new category module in backend.\r\nworking on new design', '2021-02-05 22:35:09', '2021-02-05 22:35:09'),
(55, 55, 480, 'Airbus Project', '2021-02-06 00:06:09', '2021-02-06 00:06:09'),
(56, 56, 480, 'quiz portal category page done from backend \r\nquiz portal category page new design done frontend \r\nworking on other pages design', '2021-02-08 21:48:16', '2021-02-08 21:48:16'),
(57, 57, 480, 'Airbus Project', '2021-02-08 23:29:33', '2021-02-08 23:29:33'),
(59, 59, 520, 'working on AMS playbook and ansible', '2021-02-09 15:57:48', '2021-02-09 15:57:48'),
(60, 60, 520, 'working on AMS playbook', '2021-02-09 15:58:32', '2021-02-09 15:58:32'),
(61, 61, 480, 'worked on Ansible and AMS playbook for windows', '2021-02-10 13:36:37', '2021-02-10 13:36:37'),
(62, 62, 480, 'Airbus Project', '2021-02-10 23:58:48', '2021-02-10 23:58:48'),
(63, 63, 480, 'Training work', '2021-02-11 18:39:39', '2021-02-11 18:39:39'),
(64, 64, 480, 'Worked on Quiz portal . Backend Category module \r\nchanged and created new one . working on frontend', '2021-02-11 22:00:27', '2021-02-11 22:00:27'),
(65, 65, 480, 'Quiz portal frontend design changes . Header part , footer part and registration page', '2021-02-11 22:01:42', '2021-02-11 22:01:42'),
(66, 66, 480, 'quiz portal done changes given after demo with Chetan bhai and Monika Mam. No new change pending.', '2021-02-11 22:03:27', '2021-02-11 22:03:27'),
(67, 67, 480, 'Airbus Project', '2021-02-11 22:26:39', '2021-02-11 22:26:39'),
(68, 68, 480, 'Airbus Project', '2021-02-15 22:53:06', '2021-02-15 22:53:06'),
(69, 69, 20, 'Team Meeting', '2021-02-16 11:06:57', '2021-02-16 11:06:57'),
(70, 69, 120, 'Working on Poster and add question to quiz portal', '2021-02-16 11:06:57', '2021-02-16 11:06:57'),
(71, 69, 300, 'Working on task which chetan bhai has given', '2021-02-16 11:06:57', '2021-02-16 11:06:57'),
(72, 70, 20, 'Team Meeting', '2021-02-16 11:09:05', '2021-02-16 11:09:05'),
(73, 70, 240, 'Working designee of quiz portal', '2021-02-16 11:09:05', '2021-02-16 11:09:05'),
(74, 70, 240, 'Working on task given by Chetan bahi', '2021-02-16 11:09:05', '2021-02-16 11:09:05'),
(75, 71, 480, 'Airbus Project', '2021-02-16 23:46:13', '2021-02-16 23:46:13'),
(76, 72, 480, 'Airbus Project', '2021-02-17 23:46:42', '2021-02-17 23:46:42'),
(77, 73, 480, 'Airbus Project', '2021-02-19 02:08:38', '2021-02-19 02:08:38'),
(78, 74, 480, 'Airbus Project', '2021-02-20 00:09:18', '2021-02-20 00:09:18'),
(79, 75, 480, 'Airbus Project', '2021-02-22 23:54:21', '2021-02-22 23:54:21'),
(80, 76, 480, 'Airbus Project', '2021-02-24 23:27:23', '2021-02-24 23:27:23'),
(81, 77, 480, 'Airbus Project', '2021-02-25 23:11:03', '2021-02-25 23:11:03'),
(82, 78, 480, 'AirbusBus Project', '2021-02-26 23:36:18', '2021-02-26 23:36:18'),
(83, 79, 480, 'Kubernetes Session\r\nDocker Basics', '2021-03-02 01:17:05', '2021-03-02 01:17:05'),
(85, 81, 480, 'Advanced Kubernetes Session', '2021-03-03 22:27:04', '2021-03-03 22:27:04'),
(86, 82, 480, 'Advanced Kubernetes Session\r\nInstalled Minikube in the local system', '2021-03-04 22:51:17', '2021-03-04 22:51:17'),
(87, 83, 480, 'Advanced Kubernetes Session', '2021-03-06 00:06:22', '2021-03-06 00:06:22'),
(88, 84, 480, 'Kuberenetes Revision\r\nQuiz Portal Question - Kubernetes [Completed] ; Use Case [In Progress]', '2021-03-08 23:08:10', '2021-03-08 23:08:10'),
(89, 85, 480, 'Ansible and Automation Anywhere Questions for Thinknyx Quiz Portal', '2021-03-10 02:04:34', '2021-03-10 02:04:34'),
(90, 86, 480, 'Quiz portal Questions and Description', '2021-03-11 23:31:46', '2021-03-11 23:31:46'),
(91, 87, 480, 'Quiz portal questions and testing', '2021-03-13 00:05:06', '2021-03-13 00:05:06'),
(92, 88, 480, 'Quiz portal Questions', '2021-03-15 22:31:50', '2021-03-15 22:31:50'),
(93, 89, 480, 'Quiz portal Questions', '2021-03-16 22:06:31', '2021-03-16 22:06:31'),
(94, 90, 480, 'Quiz Questions, Descriptions and Testing', '2021-03-17 20:07:35', '2021-03-17 20:07:35'),
(95, 91, 480, 'Quiz Portal Questions[UI Path] + News for Newsletter', '2021-03-19 21:22:13', '2021-03-19 21:22:13'),
(96, 92, 480, 'Quiz Portal Questions [Wordpress]', '2021-03-22 23:32:55', '2021-03-22 23:32:55'),
(97, 93, 480, 'Quiz Portal Question - [ POWERSHELL Questions sent for review and Testing done for Percentage error; New Changes sent to Himanshu]', '2021-03-23 20:20:24', '2021-03-23 20:20:24'),
(98, 94, 480, 'Quiz questions [RPA] + Descriptions', '2021-03-25 23:09:26', '2021-03-25 23:09:26'),
(99, 95, 480, 'Quiz Question testing + New Changes + Remaining questions of docker and puppet sent for review', '2021-03-26 21:20:00', '2021-03-26 21:20:00'),
(100, 96, 480, 'Quiz Portal Questions on Networking Fundamentals', '2021-03-30 20:40:17', '2021-03-30 20:40:17'),
(101, 97, 480, 'Quiz Questions on SPLUNK and Corrections for Networking fundamental questions', '2021-04-01 00:40:43', '2021-04-01 00:40:43'),
(102, 98, 480, 'Quiz Questions on CCNA + Descriptions', '2021-04-01 22:29:08', '2021-04-01 22:29:08'),
(103, 99, 480, 'Quiz Question for Portal on JFrog', '2021-04-05 21:42:23', '2021-04-05 21:42:23'),
(104, 100, 480, 'Quiz Questions on Maven and Youtube Video', '2021-04-06 23:26:56', '2021-04-06 23:26:56'),
(105, 101, 480, 'Quiz Questions on Selenium and descriptions and Youtube video', '2021-04-07 22:39:40', '2021-04-07 22:39:40'),
(106, 102, 480, 'Ansible Interview preparation', '2021-04-08 22:18:02', '2021-04-08 22:18:02'),
(107, 103, 480, 'Postgres sql database creation on ubuntu server', '2021-04-13 00:33:23', '2021-04-13 00:33:23'),
(108, 104, 480, 'Sent Ansible cheatsheet to kul sir with changes \r\nPostgressql db creation on aws using ansible', '2021-04-14 23:56:58', '2021-04-14 23:56:58'),
(109, 105, 480, 'Ansible collection blog and postgres db playbook using ansible', '2021-04-16 00:37:20', '2021-04-16 00:37:20'),
(110, 106, 480, 'ansible playbook to create postgres db on aws complete , error when variablization. \r\n\r\nBlog on ansible collections', '2021-04-16 23:27:03', '2021-04-16 23:27:03'),
(111, 107, 480, 'Quiz Questions upto 20 And Descriptions completed ; Ansible blog', '2021-04-20 00:49:51', '2021-04-20 00:49:51'),
(112, 108, 480, 'Ansible collection blog and Video', '2021-04-21 13:15:41', '2021-04-21 13:15:41'),
(113, 109, 480, 'Youtube video and sample playbooks for training', '2021-04-22 00:17:22', '2021-04-22 00:17:22'),
(114, 110, 480, 'Added questions in Thinknyx certification portal and added sample playbooks for ansible training (Roles and Vault) and Youtube video', '2021-04-22 22:40:17', '2021-04-22 22:40:17'),
(115, 111, 480, 'Dynamic Inventory and Postgres db creation with sql script', '2021-04-27 23:54:38', '2021-04-27 23:54:38'),
(116, 112, 480, 'Powershell Script; Ansible playbook', '2021-04-29 09:54:45', '2021-04-29 09:54:45'),
(117, 113, 480, 'Ansible playbook', '2021-04-30 11:35:34', '2021-04-30 11:35:34'),
(118, 114, 480, 'Ansible Blog and Playbook', '2021-05-03 22:22:07', '2021-05-03 22:22:07'),
(119, 115, 480, 'Blog on Ec2 instance creation using Ansible playbook', '2021-05-04 23:57:05', '2021-05-04 23:57:05'),
(120, 116, 480, 'Ansible blog on Ec2 creation completed', '2021-05-06 00:11:16', '2021-05-06 00:11:16'),
(121, 117, 480, 'Ansible blog on creation of postgres db completed And only sql script(last task of the playbook) is remaining for ansible playbook', '2021-05-06 23:23:46', '2021-05-06 23:23:46'),
(122, 118, 480, 'Ansible playbook completed and pushed to git,\r\nworking on 3rd Blog on Ansible', '2021-05-07 22:10:17', '2021-05-07 22:10:17'),
(123, 119, 480, 'Ansible Blog 3 - To create postgreSQL database on AWS done. \r\nTo create anisble playbook generic\r\nExplore Quantum computing', '2021-05-10 21:29:25', '2021-05-10 21:29:25'),
(124, 120, 480, 'Quantum computing training and exploration', '2021-05-12 09:21:03', '2021-05-12 09:21:03'),
(125, 121, 480, 'Quantum computing and quiz portal review', '2021-05-13 23:57:29', '2021-05-13 23:57:29'),
(126, 122, 480, 'Create Ansible playbooks generic', '2021-05-18 01:11:48', '2021-05-18 01:11:48'),
(127, 123, 480, 'working on ansible playbook to be made generic\r\nMcq questions and description on quantum computing completed and sent for review', '2021-05-19 00:30:09', '2021-05-19 00:30:09'),
(128, 124, 480, 'Ansible playbook to be made generic task - completed\r\n\r\nTechnology questions and description on Blockchain completed and sent for review', '2021-05-20 01:29:58', '2021-05-20 01:29:58'),
(130, 126, 60, 'TA', '2023-03-17 15:04:49', '2023-03-17 15:04:49'),
(131, 126, 300, 'project', '2023-03-17 15:04:49', '2023-03-17 15:04:49'),
(132, 126, 120, 'XYX', '2023-03-17 15:04:49', '2023-03-17 15:04:49'),
(133, 127, 180, 'XYZ', '2023-03-17 15:08:10', '2023-03-17 15:08:10'),
(134, 127, 60, 'abc', '2023-03-17 15:08:10', '2023-03-17 15:08:10'),
(149, 128, 72, 'asdasd', '2023-05-18 00:02:54', '2023-05-18 00:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timesheet_date` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fy` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `user_id`, `timesheet_date`, `status`, `created_at`, `updated_at`, `fy`) VALUES
(1, 61, '2020-12-25', 1, '2020-12-28 17:15:07', '2020-12-28 17:15:07', '2020-21'),
(2, 62, '2020-12-29', 1, '2020-12-30 01:07:16', '2020-12-30 01:07:16', '2020-21'),
(3, 62, '2020-12-30', 1, '2020-12-31 02:37:07', '2020-12-31 02:37:07', '2020-21'),
(4, 61, '2020-12-28', 1, '2021-01-04 21:03:51', '2021-01-04 21:03:51', '2020-21'),
(5, 61, '2020-12-29', 1, '2021-01-04 21:05:44', '2021-01-04 21:05:44', '2020-21'),
(6, 61, '2020-12-30', 1, '2021-01-04 21:07:19', '2021-01-04 21:07:19', '2020-21'),
(7, 61, '2020-12-31', 1, '2021-01-04 21:09:38', '2021-01-04 21:09:38', '2020-21'),
(8, 61, '2021-01-04', 1, '2021-01-04 21:13:07', '2021-01-04 21:13:07', '2020-21'),
(9, 62, '2021-01-04', 1, '2021-01-05 00:31:37', '2021-01-05 00:31:37', '2020-21'),
(10, 62, '2021-01-05', 1, '2021-01-06 00:17:14', '2021-01-06 00:17:14', '2020-21'),
(11, 62, '2021-01-06', 1, '2021-01-06 23:59:36', '2021-01-06 23:59:36', '2020-21'),
(12, 62, '2021-01-07', 1, '2021-01-07 23:50:07', '2021-01-07 23:50:07', '2020-21'),
(13, 61, '2021-01-05', 1, '2021-01-08 17:19:10', '2021-01-08 17:19:10', '2020-21'),
(14, 61, '2021-01-06', 1, '2021-01-08 17:20:33', '2021-01-08 17:20:33', '2020-21'),
(15, 61, '2021-01-07', 1, '2021-01-08 17:22:55', '2021-01-08 17:22:55', '2020-21'),
(16, 61, '2021-01-08', 1, '2021-01-08 17:24:59', '2021-01-08 17:24:59', '2020-21'),
(17, 62, '2021-01-08', 1, '2021-01-09 01:31:27', '2021-01-09 01:31:27', '2020-21'),
(18, 61, '2021-01-11', 1, '2021-01-11 22:14:39', '2021-01-11 22:14:39', '2020-21'),
(19, 62, '2021-01-11', 1, '2021-01-12 00:55:11', '2021-01-12 00:55:11', '2020-21'),
(20, 61, '2021-01-12', 1, '2021-01-12 22:09:18', '2021-01-12 22:09:18', '2020-21'),
(21, 62, '2021-01-12', 1, '2021-01-12 23:48:59', '2021-01-12 23:48:59', '2020-21'),
(22, 62, '2021-01-13', 1, '2021-01-13 23:40:58', '2021-01-13 23:40:58', '2020-21'),
(23, 62, '2021-01-14', 1, '2021-01-14 22:52:31', '2021-01-14 22:52:31', '2020-21'),
(24, 61, '2021-01-13', 1, '2021-01-15 18:40:07', '2021-01-15 18:40:07', '2020-21'),
(25, 61, '2021-01-14', 1, '2021-01-15 18:41:50', '2021-01-15 18:41:50', '2020-21'),
(26, 62, '2021-01-15', 1, '2021-01-15 21:49:02', '2021-01-15 21:49:02', '2020-21'),
(27, 61, '2021-01-15', 1, '2021-01-15 22:07:30', '2021-01-15 22:07:30', '2020-21'),
(28, 61, '2021-01-18', 1, '2021-01-18 23:04:11', '2021-01-18 23:04:11', '2020-21'),
(29, 62, '2021-01-18', 1, '2021-01-18 23:10:08', '2021-01-18 23:10:08', '2020-21'),
(30, 62, '2021-01-19', 1, '2021-01-19 23:03:13', '2021-01-19 23:03:13', '2020-21'),
(31, 61, '2021-01-19', 1, '2021-01-20 22:01:25', '2021-01-20 22:01:25', '2020-21'),
(32, 61, '2021-01-20', 1, '2021-01-20 22:04:48', '2021-01-20 22:04:48', '2020-21'),
(33, 62, '2021-01-20', 1, '2021-01-20 22:18:45', '2021-01-20 22:18:45', '2020-21'),
(34, 62, '2021-01-21', 1, '2021-01-21 23:51:18', '2021-01-21 23:51:18', '2020-21'),
(35, 61, '2021-01-22', 1, '2021-01-22 21:48:09', '2021-01-22 21:48:09', '2020-21'),
(36, 61, '2021-01-21', 1, '2021-01-22 21:53:10', '2021-01-22 21:53:10', '2020-21'),
(37, 62, '2021-01-22', 1, '2021-01-22 23:54:41', '2021-01-22 23:54:41', '2020-21'),
(38, 61, '2021-01-25', 1, '2021-01-25 21:49:11', '2021-01-25 21:49:11', '2020-21'),
(39, 62, '2021-01-25', 1, '2021-01-25 22:36:36', '2021-01-25 22:36:36', '2020-21'),
(40, 61, '2021-01-27', 1, '2021-01-27 22:12:41', '2021-01-27 22:12:41', '2020-21'),
(41, 62, '2021-01-27', 1, '2021-01-27 23:06:23', '2021-01-27 23:06:23', '2020-21'),
(42, 61, '2021-01-28', 1, '2021-01-28 22:36:22', '2021-01-28 22:36:22', '2020-21'),
(43, 62, '2021-01-28', 1, '2021-01-29 00:31:29', '2021-01-29 00:31:29', '2020-21'),
(44, 61, '2021-01-29', 1, '2021-01-29 22:20:55', '2021-01-29 22:20:55', '2020-21'),
(45, 62, '2021-01-29', 1, '2021-01-29 22:49:20', '2021-01-29 22:49:20', '2020-21'),
(46, 61, '2021-02-01', 1, '2021-02-01 22:13:11', '2021-02-01 22:13:11', '2020-21'),
(47, 62, '2021-02-01', 1, '2021-02-02 00:09:45', '2021-02-02 00:09:45', '2020-21'),
(48, 61, '2021-02-02', 1, '2021-02-02 23:03:52', '2021-02-02 23:03:52', '2020-21'),
(49, 62, '2021-02-02', 1, '2021-02-02 23:57:07', '2021-02-02 23:57:07', '2020-21'),
(50, 62, '2021-02-03', 1, '2021-02-04 01:35:35', '2021-02-04 01:35:35', '2020-21'),
(51, 61, '2021-02-04', 1, '2021-02-04 22:25:30', '2021-02-04 22:25:30', '2020-21'),
(52, 61, '2021-02-03', 1, '2021-02-04 22:26:58', '2021-02-04 22:26:58', '2020-21'),
(53, 62, '2021-02-04', 1, '2021-02-05 00:25:11', '2021-02-05 00:25:11', '2020-21'),
(54, 61, '2021-02-05', 1, '2021-02-05 22:35:09', '2021-02-05 22:35:09', '2020-21'),
(55, 62, '2021-02-05', 1, '2021-02-06 00:06:09', '2021-02-06 00:06:09', '2020-21'),
(56, 61, '2021-02-08', 1, '2021-02-08 21:48:16', '2021-02-08 21:48:16', '2020-21'),
(57, 62, '2021-02-08', 1, '2021-02-08 23:29:33', '2021-02-08 23:29:33', '2020-21'),
(59, 65, '2021-02-08', 1, '2021-02-09 15:57:48', '2021-02-09 15:57:48', '2020-21'),
(60, 65, '2021-02-05', 1, '2021-02-09 15:58:32', '2021-02-09 15:58:32', '2020-21'),
(61, 65, '2021-02-09', 1, '2021-02-10 13:36:37', '2021-02-10 13:36:37', '2020-21'),
(62, 62, '2021-02-10', 1, '2021-02-10 23:58:48', '2021-02-10 23:58:48', '2020-21'),
(63, 59, '2021-02-04', 1, '2021-02-11 18:39:39', '2021-02-11 18:39:39', '2020-21'),
(64, 61, '2021-02-09', 1, '2021-02-11 22:00:27', '2021-02-11 22:00:27', '2020-21'),
(65, 61, '2021-02-10', 1, '2021-02-11 22:01:42', '2021-02-11 22:01:42', '2020-21'),
(66, 61, '2021-02-11', 1, '2021-02-11 22:03:27', '2021-02-11 22:03:27', '2020-21'),
(67, 62, '2021-02-11', 1, '2021-02-11 22:26:39', '2021-02-11 22:26:39', '2020-21'),
(68, 62, '2021-02-15', 1, '2021-02-15 22:53:06', '2021-02-15 22:53:06', '2020-21'),
(69, 60, '2021-02-12', 1, '2021-02-16 11:06:57', '2021-02-16 11:06:57', '2020-21'),
(70, 60, '2021-02-11', 1, '2021-02-16 11:09:05', '2021-02-16 11:09:05', '2020-21'),
(71, 62, '2021-02-16', 1, '2021-02-16 23:46:13', '2021-02-16 23:46:13', '2020-21'),
(72, 62, '2021-02-17', 1, '2021-02-17 23:46:42', '2021-02-17 23:46:42', '2020-21'),
(73, 62, '2021-02-18', 1, '2021-02-19 02:08:38', '2021-02-19 02:08:38', '2020-21'),
(74, 62, '2021-02-19', 1, '2021-02-20 00:09:18', '2021-02-20 00:09:18', '2020-21'),
(75, 62, '2021-02-22', 1, '2021-02-22 23:54:21', '2021-02-22 23:54:21', '2020-21'),
(76, 62, '2021-02-24', 1, '2021-02-24 23:27:23', '2021-02-24 23:27:23', '2020-21'),
(77, 62, '2021-02-25', 1, '2021-02-25 23:11:03', '2021-02-25 23:11:03', '2020-21'),
(78, 62, '2021-02-26', 1, '2021-02-26 23:36:18', '2021-02-26 23:36:18', '2020-21'),
(79, 62, '2021-03-01', 1, '2021-03-02 01:17:05', '2021-03-02 01:17:05', '2020-21'),
(80, 62, '2021-03-02', 1, '2021-03-03 22:25:33', '2021-03-03 22:25:33', '2020-21'),
(81, 62, '2021-03-03', 1, '2021-03-03 22:27:04', '2021-03-03 22:27:04', '2020-21'),
(82, 62, '2021-03-04', 1, '2021-03-04 22:51:17', '2021-03-04 22:51:17', '2020-21'),
(83, 62, '2021-03-05', 1, '2021-03-06 00:06:22', '2021-03-06 00:06:22', '2020-21'),
(84, 62, '2021-03-08', 1, '2021-03-08 23:08:10', '2021-03-08 23:08:10', '2020-21'),
(85, 62, '2021-03-09', 1, '2021-03-10 02:04:34', '2021-03-10 02:04:34', '2020-21'),
(86, 62, '2021-03-11', 1, '2021-03-11 23:31:46', '2021-03-11 23:31:46', '2020-21'),
(87, 62, '2021-03-12', 1, '2021-03-13 00:05:06', '2021-03-13 00:05:06', '2020-21'),
(88, 62, '2021-03-15', 1, '2021-03-15 22:31:50', '2021-03-15 22:31:50', '2020-21'),
(89, 62, '2021-03-16', 1, '2021-03-16 22:06:31', '2021-03-16 22:06:31', '2020-21'),
(90, 62, '2021-03-17', 1, '2021-03-17 20:07:35', '2021-03-17 20:07:35', '2020-21'),
(91, 62, '2021-03-19', 1, '2021-03-19 21:22:13', '2021-03-19 21:22:13', '2020-21'),
(92, 62, '2021-03-22', 1, '2021-03-22 23:32:55', '2021-03-22 23:32:55', '2020-21'),
(93, 62, '2021-03-23', 1, '2021-03-23 20:20:24', '2021-03-23 20:20:24', '2020-21'),
(94, 62, '2021-03-25', 1, '2021-03-25 23:09:26', '2021-03-25 23:09:26', '2020-21'),
(95, 62, '2021-03-26', 1, '2021-03-26 21:20:00', '2021-03-26 21:20:00', '2020-21'),
(96, 62, '2021-03-30', 1, '2021-03-30 20:40:17', '2021-03-30 20:40:17', '2020-21'),
(97, 62, '2021-03-31', 1, '2021-04-01 00:40:43', '2021-04-01 00:40:43', '2020-21'),
(98, 62, '2021-04-01', 1, '2021-04-01 22:29:08', '2021-04-01 22:29:08', '2021-22'),
(99, 62, '2021-04-05', 1, '2021-04-05 21:42:23', '2021-04-05 21:42:23', '2021-22'),
(100, 62, '2021-04-06', 1, '2021-04-06 23:26:56', '2021-04-06 23:26:56', '2021-22'),
(101, 62, '2021-04-07', 1, '2021-04-07 22:39:40', '2021-04-07 22:39:40', '2021-22'),
(102, 62, '2021-04-08', 1, '2021-04-08 22:18:02', '2021-04-08 22:18:02', '2021-22'),
(103, 62, '2021-04-12', 1, '2021-04-13 00:33:23', '2021-04-13 00:33:23', '2021-22'),
(104, 62, '2021-04-14', 1, '2021-04-14 23:56:58', '2021-04-14 23:56:58', '2021-22'),
(105, 62, '2021-04-15', 1, '2021-04-16 00:37:20', '2021-04-16 00:37:20', '2021-22'),
(106, 62, '2021-04-16', 1, '2021-04-16 23:27:03', '2021-04-16 23:27:03', '2021-22'),
(107, 62, '2021-04-19', 1, '2021-04-20 00:49:51', '2021-04-20 00:49:51', '2021-22'),
(108, 62, '2021-04-20', 1, '2021-04-21 13:15:41', '2021-04-21 13:15:41', '2021-22'),
(109, 62, '2021-04-21', 1, '2021-04-22 00:17:22', '2021-04-22 00:17:22', '2021-22'),
(110, 62, '2021-04-22', 1, '2021-04-22 22:40:17', '2021-04-22 22:40:17', '2021-22'),
(111, 62, '2021-04-27', 1, '2021-04-27 23:54:38', '2021-04-27 23:54:38', '2021-22'),
(112, 62, '2021-04-28', 1, '2021-04-29 09:54:45', '2021-04-29 09:54:45', '2021-22'),
(113, 62, '2021-04-29', 1, '2021-04-30 11:35:34', '2021-04-30 11:35:34', '2021-22'),
(114, 62, '2021-05-03', 1, '2021-05-03 22:22:07', '2021-05-03 22:22:07', '2021-22'),
(115, 62, '2021-05-04', 1, '2021-05-04 23:57:05', '2021-05-04 23:57:05', '2021-22'),
(116, 62, '2021-05-05', 1, '2021-05-06 00:11:16', '2021-05-06 00:11:16', '2021-22'),
(117, 62, '2021-05-06', 1, '2021-05-06 23:23:46', '2021-05-06 23:23:46', '2021-22'),
(118, 62, '2021-05-07', 1, '2021-05-07 22:10:17', '2021-05-07 22:10:17', '2021-22'),
(119, 62, '2021-05-10', 1, '2021-05-10 21:29:25', '2021-05-10 21:29:25', '2021-22'),
(120, 62, '2021-05-11', 1, '2021-05-12 09:21:03', '2021-05-12 09:21:03', '2021-22'),
(121, 62, '2021-05-13', 1, '2021-05-13 23:57:28', '2021-05-13 23:57:28', '2021-22'),
(122, 62, '2021-05-17', 1, '2021-05-18 01:11:48', '2021-05-18 01:11:48', '2021-22'),
(123, 62, '2021-05-18', 1, '2021-05-19 00:30:09', '2021-05-19 00:30:09', '2021-22'),
(124, 62, '2021-05-19', 1, '2021-05-20 01:29:58', '2021-05-20 01:29:58', '2021-22'),
(125, 72, '2023-05-17', 1, '2023-03-07 15:17:19', '2023-05-17 23:17:37', '2022-23'),
(126, 63, '2023-03-17', 1, '2023-03-17 15:04:49', '2023-03-17 15:04:49', '2022-23'),
(127, 70, '2023-03-17', 1, '2023-03-17 15:08:10', '2023-03-17 15:08:10', '2022-23'),
(128, 72, '2023-05-18', 1, '2023-05-17 23:28:04', '2023-05-17 23:28:04', '2023-24');

-- --------------------------------------------------------

--
-- Table structure for table `totalleaves`
--

CREATE TABLE `totalleaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `leaveyear` char(7) DEFAULT NULL,
  `totalleaves` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `totalleaves`
--

INSERT INTO `totalleaves` (`id`, `employee_id`, `leaveyear`, `totalleaves`, `created_at`, `updated_at`) VALUES
(8, 1, '2020-21', 18, '2020-08-28 21:37:10', '2020-08-28 21:37:10'),
(34, 53, '2020-21', 18, '2020-09-17 14:36:50', '2020-09-17 14:36:50'),
(35, 56, '2020-21', 18, '2020-09-17 15:21:48', '2020-09-17 15:21:48'),
(36, 58, '2020-21', 18, '2020-09-17 15:30:10', '2020-09-17 15:30:10'),
(37, 59, '2020-21', 18, '2020-09-17 15:35:28', '2020-09-17 15:35:28'),
(38, 60, '2020-21', 18, '2020-09-17 15:38:03', '2020-09-17 15:38:03'),
(39, 61, '2020-21', 18, '2020-09-17 15:40:12', '2020-09-17 15:40:12'),
(40, 62, '2020-21', 18, '2020-09-17 15:42:22', '2020-09-17 15:42:22'),
(41, 63, '2020-21', 18, '2020-09-17 15:44:54', '2020-09-17 15:44:54'),
(42, 64, '2020-21', 18, '2020-10-05 11:15:28', '2020-10-05 11:15:28'),
(43, 65, '2020-21', 18, '2020-12-22 18:46:56', '2020-12-22 18:46:56'),
(44, 66, '2021-22', 18, '2021-06-23 17:49:31', '2021-06-23 17:49:31'),
(45, 67, '2021-22', 18, '2021-11-17 14:31:18', '2021-11-17 14:31:18'),
(46, 68, '2021-22', 18, '2021-11-17 15:00:25', '2021-11-17 15:00:25'),
(47, 69, '2021-22', 18, '2021-12-13 13:37:43', '2021-12-13 13:37:43'),
(48, 70, '2022-23', 18, '2022-04-08 13:57:47', '2022-04-08 13:57:47'),
(49, 71, '2022-23', 18, '2022-04-29 13:27:40', '2022-04-29 13:27:40'),
(50, 72, '2022-23', 18, '2022-04-29 13:33:54', '2022-04-29 13:33:54'),
(51, 73, '2022-23', 18, '2022-04-29 13:49:33', '2022-04-29 13:49:33'),
(52, 74, '2022-23', 18, '2022-05-03 13:21:46', '2022-05-03 13:21:46'),
(53, 75, '2022-23', 18, '2022-05-12 13:23:28', '2022-05-12 13:23:28'),
(54, 76, '2022-23', 18, '2022-05-14 17:09:47', '2022-05-14 17:09:47'),
(55, 63, '2022-23', 18, '2022-06-22 20:06:34', '2022-06-22 20:06:34'),
(56, 77, '2022-23', 18, '2022-08-24 12:15:25', '2022-08-24 12:15:25'),
(57, 78, '2022-23', 18, '2023-03-06 13:47:23', '2023-03-06 13:47:23'),
(58, 79, '2022-23', 18, '2023-03-06 13:53:19', '2023-03-06 13:53:19'),
(59, 1, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(60, 53, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(61, 56, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(62, 58, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(63, 59, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(64, 60, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(65, 61, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(66, 62, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(67, 63, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(68, 64, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(69, 65, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(70, 66, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(71, 67, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(72, 68, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(73, 69, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(74, 70, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(75, 71, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(76, 72, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(77, 73, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(78, 74, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(79, 75, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(80, 76, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(81, 63, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(82, 77, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(83, 78, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15'),
(84, 79, '2023-24', 18, '2023-04-07 12:22:15', '2023-04-07 12:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `userassigns`
--

CREATE TABLE `userassigns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pancard` varchar(20) DEFAULT NULL,
  `uanumber` varchar(20) DEFAULT NULL,
  `aadharcard` varchar(20) DEFAULT NULL,
  `bknumber` varchar(20) DEFAULT NULL,
  `bkname` varchar(20) DEFAULT NULL,
  `ifscode` varchar(20) DEFAULT NULL,
  `certification` varchar(100) DEFAULT NULL,
  `grd_diploma` varchar(100) DEFAULT NULL,
  `uni_grd` varchar(100) DEFAULT NULL,
  `inst_grd` varchar(100) DEFAULT NULL,
  `year_pass_grd` varchar(20) DEFAULT NULL,
  `uni_pg` varchar(50) DEFAULT NULL,
  `inst_pg` varchar(50) DEFAULT NULL,
  `year_pass_pg` varchar(20) DEFAULT NULL,
  `post_grd` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `user_id`, `pancard`, `uanumber`, `aadharcard`, `bknumber`, `bkname`, `ifscode`, `certification`, `grd_diploma`, `uni_grd`, `inst_grd`, `year_pass_grd`, `uni_pg`, `inst_pg`, `year_pass_pg`, `post_grd`, `created_at`, `updated_at`) VALUES
(2, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 14:36:50', '2020-09-17 14:36:50'),
(41, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 15:21:48', '2020-09-17 15:21:48'),
(42, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 15:30:10', '2020-09-17 15:30:10'),
(43, 59, 'QVJCUEM3MzMxQQ==', 'MTAwNzUwNzEwOTIz', 'NDAyMzMxNjUxOTk5', 'NTAxMDAxMDIyNTE1MzA=', 'SERGQyBCQU5LIExURC4=', 'SERGQzAwMDA2NTM=', 'AWS, Azure, Oracle, Docker, Kubernetes, Terraform', 'BCA', 'GNDU', 'DAV College', '2013', 'LPU', 'LPU', '2016', NULL, '2020-09-17 15:35:27', '2020-10-07 17:16:59'),
(44, 60, 'QlhaUEM0MDM0TQ==', 'LS0=', 'MzIwMDAwMDUyMjI4', 'MDI1NjAxNTE3Nzc1Nw==', 'SUNJQ0k=', 'SUNJQzAwMDAyODY=', 'RPA- Automation Anywhere', 'BA- In English Honors', 'LNMU University', 'LNMU University', '2021', NULL, NULL, NULL, NULL, '2020-09-17 15:38:03', '2020-10-08 20:21:37'),
(45, 61, 'QUhOUFY2NzM1RA==', 'LU5BLQ==', 'Nzg5NSAwNDA4IDMyOTA=', 'MDE1NDAxNTE3MjYw', 'SUNJQ0kgQmFuaw==', 'SUNJQzAwMDAyNTA=', '-NA-', 'BCA', 'Himachal Pradesh University', 'NSCBM Govt College Hamirpur', '2003', 'Punjab Technical University (PUT)', 'Apeejay Institute of Management', '2006', NULL, '2020-09-17 15:40:12', '2020-10-09 10:45:29'),
(46, 62, 'REVSUEc1MzQ3UQ==', 'Tm9uZQ==', 'ODA4NzUxNTM5MTI0', 'MTg5MjAxMDAwMDAzNzk3', 'SW5kaWFuIE92ZXJzZWFz', 'SU9CQTAwMDE4OTI=', 'Automation Anywhere Certified Advanced RPA Professional (V11.0), Oracle Cloud Infrastructure 2019 Ce', 'BE', 'Mumbai University', 'Pillai\'s HOC College of Engineering', '2019', 'None', 'None', 'None', NULL, '2020-09-17 15:42:22', '2020-11-09 16:35:44'),
(47, 63, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'B.E. - ECE', 'MDU, Rohtak', 'Apeejay College of Engineering', '2007', 'NA', 'School of Inspired Leadership', '2010', NULL, '2020-09-17 15:44:54', '2020-10-07 14:01:09'),
(48, 64, 'QUxDUFIxMDExUg==', 'MTAwODAxNTM1MTk5', 'NTg2OTU3NTI2MzY1', 'OTExMDEwMDExMDc4NTY2', 'QXhpcyBCYW5r', 'VVRJQjAwMDAwMjI=', 'NA', 'PGDBA from Symbiosis', 'Symbiosis', 'Delhi University', '2002', 'Symbiosis Pune', 'Symbiosis', '2005', NULL, '2020-10-05 11:15:28', '2021-03-11 14:08:54'),
(49, 65, NULL, NULL, NULL, NULL, NULL, NULL, 'ITIL 3', 'Btech', 'RGTU, Bhopal', 'NRI Institute of Technical and Management', '2011', NULL, NULL, NULL, NULL, '2020-12-22 18:46:55', '2021-06-24 12:53:44'),
(50, 66, NULL, NULL, NULL, NULL, NULL, NULL, 'Done Two Month Certificate Course of Swift Tally.erp9 from “NIIT”.', 'B.Com', 'Patna University', 'Patna Women\'s College', '2009', 'SRM University', 'SRM University', '2011', 'MBA', '2021-06-23 17:49:31', '2021-07-05 18:44:03'),
(51, 67, 'Q0FEUFM4MDgxQQ==', 'bmE=', 'ODI1Njk0NjU5OTA1', 'NTAxMDAxNTkxODA2MjI=', 'SERGQyBCYW5r', 'SERGQzAwMDAzMjk=', 'NA', 'BCA', 'Mirza Ghalib College', 'Magadh University', '2004-2007', 'SRM University', 'SRM University', '2009-2011', 'MBA', '2021-11-17 14:31:18', '2021-12-23 10:41:30'),
(52, 68, 'R0xTUEQyOTg1Sg==', 'LQ==', 'NjQxNDg0NjMxMTU1', 'OTE3MjU5OTkwNjgw', 'UGF5dG0gUGF5bWVudHMg', 'UFlUTTAxMjM0NTY=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 15:00:25', '2021-11-24 07:59:46'),
(53, 69, 'REdWUFM0MjU3UA==', 'Tk9UIEFWSUxBQkxF', 'OTI2NjM5NjAyNzUw', 'Mjg0NzEwMTAwMjk4Ng==', 'Q0FOQVJBIEJBTks=', 'Q05SQjAwMDI4NDc=', 'NO CERTIFICATES', 'MBA(HR)', 'MDU UNIVERSITY,ROHTAK', 'DAV INSTITUTE OF MANAGEMENT', '2014', 'AMITY UNIVERSITY-NOIDA', 'DAV INSTITUTE OF MANAGEMENT', '2018', '2018', '2021-12-13 13:37:43', '2021-12-24 20:40:35'),
(54, 70, 'Q1hYUEsyMjEzSA==', 'MTAwOTcxNjQxMDE3', 'NTE3NzIzMjIyMjg2', 'MTAwMzQ5NTA0NzE=', 'SURGQyBCYW5r', 'SURGQjAwMjAxMTI=', 'NA', 'BCA', 'Himalayan University, Arunachal Pradesh', 'Himalayan University, Arunachal Pradesh', '2016', NULL, NULL, NULL, NULL, '2022-04-08 13:57:47', '2022-04-27 17:25:40'),
(55, 71, 'RVVEUEs0NzM1Qg==', 'MTAxNjQ4MDYwOTQ4', 'NTk2MyA0OTIxIDUyMDk=', 'NTAxMDAzNjI1NDE2NDU=', 'SERGQyBCQU5LIExURC4=', 'SERGQzAwMDAxODU=', 'AWS Practitioner, Azure Fundamentals (AZ-900), Azure Administrator Associate (AZ-104)', 'B.Tech.', 'Shivaji University, Kolhapur, Maharashtra', 'Rajarambapu Institute of Technology, Islampur, Maharashtra', '2020', NULL, NULL, NULL, NULL, '2022-04-29 13:27:40', '2022-04-29 13:44:10'),
(56, 72, 'QUhHUEowODg2Tg==', 'SSBkbyBub3QgaGF2ZS4g', 'ODU2NTc0MjcyOTIy', 'NDExNTAxNTA2MzE3', 'SUNJQ0kgYmFuaw==', 'SUNJQzAwMDQxMTU=', 'Certified Microsoft Innovative Educator (MIE)', 'B.Sc/PGDCA', 'Berhampur University,Orissa', 'DAV Koraput,Orissa', '1995', 'IGNOU, New Delhi', 'IGNOU', '2008', 'MCA', '2022-04-29 13:33:54', '2022-04-29 14:28:08'),
(57, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 13:49:33', '2022-04-29 13:49:33'),
(58, 74, 'Q0JWUE01MDExUg==', 'MTAxMzE4ODUwODk0', 'ODgyOTA0MzY2NDc1', 'MDI5NzAxNTYwMzA4', 'SUNJQ0kgQkFOSw==', 'SUNJQzAwMDAyOTc=', 'RedHat Linux 6-7-8, OpenShift, Ansible', 'BCA', 'F.M. University Odisha', 'BCCST Bhubaneswar', '2007', NULL, NULL, NULL, NULL, '2022-05-03 13:21:46', '2022-05-28 11:44:11'),
(59, 75, 'SFZOUEszOTE1RA==', 'TkE=', 'OTU4NTk0ODQ5MTkx', 'MzgzMDcyMzIyMDc=', 'U0JJ', 'U0JJTjAwMDM2NDY=', 'NA', 'BCA', 'IGNOU', 'NA', '2020', NULL, NULL, NULL, NULL, '2022-05-12 13:23:28', '2022-05-12 15:06:15'),
(60, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-14 17:09:47', '2022-05-14 17:09:47'),
(61, 77, 'QUhOUE4yNDczUQ==', 'MTAxODA1OTA2NjQ1', 'NTY1MjI0MTI2ODQ0', 'MzE3MDAxNTAxNDQz', 'SUNJQ0k=', 'SUNJQzAwMDMxNzA=', 'AWS Certified Solutions Architect Associate, Sun Certified Java Associate (SCJA)', 'BE', 'VTU', 'GSSSIETW', '2008', NULL, NULL, NULL, NULL, '2022-08-24 12:15:25', '2022-08-24 12:49:35'),
(62, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-06 13:47:23', '2023-03-06 13:47:23'),
(63, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-06 13:53:19', '2023-03-06 13:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `userip` varbinary(16) NOT NULL,
  `logintime` timestamp NULL DEFAULT NULL,
  `logouttime` timestamp NULL DEFAULT NULL,
  `totaltime` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`id`, `userid`, `userip`, `logintime`, `logouttime`, `totaltime`, `created_at`, `updated_at`) VALUES
(1, 1, 0x3132322e3136312e3234362e323236, '2020-09-17 14:55:41', '2020-09-17 14:58:07', '0:2', '2020-09-17 14:55:41', '2020-09-17 14:58:07'),
(2, 56, 0x3132322e3136312e3234362e323236, '2020-09-17 15:27:08', NULL, NULL, '2020-09-17 15:27:08', '2020-09-17 15:27:08'),
(3, 59, 0x3131372e39362e3235302e323139, '2020-09-17 15:39:37', NULL, NULL, '2020-09-17 15:39:37', '2020-09-17 15:39:37'),
(4, 61, 0x3136392e3134392e3231342e313530, '2020-09-17 15:40:56', '2020-09-17 17:55:50', '2:14', '2020-09-17 15:40:56', '2020-09-17 17:55:50'),
(5, 62, 0x34392e33362e32352e3539, '2020-09-17 15:44:00', NULL, NULL, '2020-09-17 15:44:00', '2020-09-17 15:44:00'),
(6, 60, 0x3130362e3230382e3232302e313139, '2020-09-20 15:58:06', '2020-09-20 15:58:29', '0:0', '2020-09-20 15:58:06', '2020-09-20 15:58:29'),
(7, 60, 0x3137312e35312e3134352e313433, '2020-09-21 09:07:52', '2020-09-21 09:17:11', '0:9', '2020-09-21 09:07:52', '2020-09-21 09:17:11'),
(8, 59, 0x3135372e3131392e3132362e323135, '2020-09-22 11:24:26', NULL, NULL, '2020-09-22 11:24:26', '2020-09-22 11:24:26'),
(9, 63, 0x3132322e3136312e3234322e323236, '2020-09-22 11:31:46', '2020-09-22 11:32:18', '0:0', '2020-09-22 11:31:46', '2020-09-22 11:32:18'),
(10, 56, 0x3132322e3136312e3234322e323236, '2020-09-22 11:32:40', NULL, NULL, '2020-09-22 11:32:40', '2020-09-22 11:32:40'),
(11, 61, 0x3136392e3134392e3234372e3830, '2020-09-22 11:38:25', '2020-09-22 14:29:05', '2:50', '2020-09-22 11:38:25', '2020-09-22 14:29:05'),
(12, 62, 0x34392e33362e32362e323039, '2020-09-22 11:53:44', NULL, NULL, '2020-09-22 11:53:44', '2020-09-22 11:53:44'),
(13, 60, 0x3135372e33352e3235352e313036, '2020-09-22 20:03:46', '2020-09-22 20:15:33', '0:11', '2020-09-22 20:03:46', '2020-09-22 20:15:33'),
(14, 58, 0x3132322e3136322e3231312e313534, '2020-09-22 20:31:56', NULL, NULL, '2020-09-22 20:31:56', '2020-09-22 20:31:56'),
(15, 56, 0x3132322e3136312e3234322e3532, '2020-09-24 12:48:09', '2020-09-24 12:52:25', '0:4', '2020-09-24 12:48:09', '2020-09-24 12:52:25'),
(16, 60, 0x3135372e33352e3233302e3732, '2020-09-24 12:53:34', NULL, NULL, '2020-09-24 12:53:34', '2020-09-24 12:53:34'),
(17, 61, 0x3136392e3134392e3230382e37, '2020-09-24 20:57:35', '2020-09-24 21:01:38', '0:4', '2020-09-24 20:57:35', '2020-09-24 21:01:38'),
(18, 62, 0x34392e33362e32352e3835, '2020-09-25 21:39:53', NULL, NULL, '2020-09-25 21:39:53', '2020-09-25 21:39:53'),
(19, 60, 0x3130362e3230372e31382e313933, '2020-09-29 21:46:03', NULL, NULL, '2020-09-29 21:46:03', '2020-09-29 21:46:03'),
(20, 62, 0x34392e33362e32372e313831, '2020-10-01 21:23:53', NULL, NULL, '2020-10-01 21:23:53', '2020-10-01 21:23:53'),
(21, 60, 0x32372e36312e36352e3233, '2020-10-02 09:36:42', NULL, NULL, '2020-10-02 09:36:42', '2020-10-02 09:36:42'),
(22, 56, 0x3132322e3136312e3234322e313134, '2020-10-03 21:50:47', NULL, NULL, '2020-10-03 21:50:47', '2020-10-03 21:50:47'),
(23, 61, 0x3136392e3134392e3230342e313436, '2020-10-03 22:10:43', '2020-10-03 22:11:35', '0:0', '2020-10-03 22:10:43', '2020-10-03 22:11:35'),
(24, 56, 0x3132322e3136312e3234322e3132, '2020-10-04 16:12:49', '2020-10-04 16:14:32', '0:1', '2020-10-04 16:12:49', '2020-10-04 16:14:32'),
(25, 62, 0x34392e33362e33312e3637, '2020-10-05 10:55:48', NULL, NULL, '2020-10-05 10:55:48', '2020-10-05 10:55:48'),
(26, 56, 0x3132322e3136312e3234322e3132, '2020-10-05 10:59:04', '2020-10-05 11:16:34', '0:17', '2020-10-05 10:59:04', '2020-10-05 11:16:34'),
(27, 59, 0x3132322e3137332e3234392e3234, '2020-10-07 16:57:58', NULL, NULL, '2020-10-07 16:57:58', '2020-10-07 16:57:58'),
(28, 60, 0x3135372e34322e3231362e323237, '2020-10-08 09:29:20', NULL, NULL, '2020-10-08 09:29:20', '2020-10-08 09:29:20'),
(29, 56, 0x3132322e3136312e3234322e3132, '2020-10-08 10:49:47', '2020-10-08 10:52:30', '0:2', '2020-10-08 10:49:47', '2020-10-08 10:52:30'),
(30, 63, 0x3132322e3136312e3234322e3132, '2020-10-08 10:54:40', '2020-10-08 10:57:52', '0:3', '2020-10-08 10:54:40', '2020-10-08 10:57:52'),
(31, 64, 0x34372e33312e3135352e323534, '2020-10-08 12:42:26', NULL, NULL, '2020-10-08 12:42:26', '2020-10-08 12:42:26'),
(32, 62, 0x34392e33362e32342e3433, '2020-10-08 16:09:03', NULL, NULL, '2020-10-08 16:09:03', '2020-10-08 16:09:03'),
(33, 61, 0x3136392e3134392e3234322e3430, '2020-10-09 10:31:16', '2020-10-09 11:32:18', '1:1', '2020-10-09 10:31:16', '2020-10-09 11:32:18'),
(34, 62, 0x34392e33362e32352e3233, '2020-10-09 13:35:46', NULL, NULL, '2020-10-09 13:35:46', '2020-10-09 13:35:46'),
(35, 56, 0x3132322e3136312e3234322e3132, '2020-10-09 13:47:26', '2020-10-09 13:49:06', '0:1', '2020-10-09 13:47:26', '2020-10-09 13:49:06'),
(36, 60, 0x32372e36302e3139322e3936, '2020-10-09 17:17:22', '2020-10-09 17:25:51', '0:8', '2020-10-09 17:17:22', '2020-10-09 17:25:51'),
(37, 63, 0x3130362e3231302e34312e3931, '2020-10-12 12:00:03', NULL, NULL, '2020-10-12 12:00:03', '2020-10-12 12:00:03'),
(38, 63, 0x3132322e3136312e3234312e3837, '2020-10-13 11:52:36', '2020-10-13 12:12:32', '0:19', '2020-10-13 11:52:36', '2020-10-13 12:12:32'),
(39, 56, 0x3132322e3136312e3234312e3837, '2020-10-13 12:12:44', NULL, NULL, '2020-10-13 12:12:44', '2020-10-13 12:12:44'),
(40, 64, 0x34322e3131312e382e3837, '2020-10-13 13:02:09', '2020-10-13 13:10:05', '0:7', '2020-10-13 13:02:09', '2020-10-13 13:10:05'),
(41, 56, 0x3132322e3136312e3234362e313137, '2020-10-14 22:17:06', NULL, NULL, '2020-10-14 22:17:06', '2020-10-14 22:17:06'),
(42, 62, 0x34392e33362e32352e3437, '2020-10-14 22:30:07', NULL, NULL, '2020-10-14 22:30:07', '2020-10-14 22:30:07'),
(43, 58, 0x3130362e3231322e3134382e3434, '2020-10-15 13:34:06', NULL, NULL, '2020-10-15 13:34:06', '2020-10-15 13:34:06'),
(44, 61, 0x3136392e3134392e3233352e313635, '2020-10-16 18:10:58', '2020-10-16 20:00:26', '1:49', '2020-10-16 18:10:58', '2020-10-16 20:00:26'),
(45, 60, 0x3135372e34322e3132382e313735, '2020-10-19 09:16:17', NULL, NULL, '2020-10-19 09:16:17', '2020-10-19 09:16:17'),
(46, 58, 0x3138322e36382e3232362e3539, '2020-10-25 20:50:49', NULL, NULL, '2020-10-25 20:50:49', '2020-10-25 20:50:49'),
(47, 61, 0x3136392e3134392e3230352e3938, '2020-11-02 10:50:11', '2020-11-02 11:24:22', '0:34', '2020-11-02 10:50:11', '2020-11-02 11:24:22'),
(48, 56, 0x3136392e3134392e3230352e3938, '2020-11-02 11:32:42', '2020-11-02 11:34:57', '0:2', '2020-11-02 11:32:42', '2020-11-02 11:34:57'),
(49, 60, 0x3137312e35312e3135382e3630, '2020-11-04 13:18:54', NULL, NULL, '2020-11-04 13:18:54', '2020-11-04 13:18:54'),
(50, 60, 0x32372e36302e3230312e323038, '2020-11-06 17:37:14', NULL, NULL, '2020-11-06 17:37:14', '2020-11-06 17:37:14'),
(51, 60, 0x3137312e35312e3134382e313132, '2020-11-07 13:47:25', NULL, NULL, '2020-11-07 13:47:25', '2020-11-07 13:47:25'),
(52, 56, 0x3131372e39372e3134322e3437, '2020-11-09 16:11:41', NULL, NULL, '2020-11-09 16:11:41', '2020-11-09 16:11:41'),
(53, 61, 0x3136392e3134392e3234332e3732, '2020-11-09 16:23:36', '2020-11-09 16:28:18', '0:4', '2020-11-09 16:23:36', '2020-11-09 16:28:18'),
(54, 60, 0x32372e36312e3130312e313336, '2020-11-10 09:48:07', NULL, NULL, '2020-11-10 09:48:07', '2020-11-10 09:48:07'),
(55, 60, 0x32372e36312e37362e323530, '2020-11-12 14:33:49', NULL, NULL, '2020-11-12 14:33:49', '2020-11-12 14:33:49'),
(56, 62, 0x34392e33362e32372e323037, '2020-11-12 14:47:43', NULL, NULL, '2020-11-12 14:47:43', '2020-11-12 14:47:43'),
(57, 56, 0x3138322e36382e34392e3839, '2020-11-18 00:23:54', NULL, NULL, '2020-11-18 00:23:54', '2020-11-18 00:23:54'),
(58, 60, 0x3135372e33352e3233342e3835, '2020-11-18 11:13:37', NULL, NULL, '2020-11-18 11:13:37', '2020-11-18 11:13:37'),
(59, 56, 0x3138322e36382e34392e3839, '2020-11-19 20:41:36', NULL, NULL, '2020-11-19 20:41:36', '2020-11-19 20:41:36'),
(60, 60, 0x3130362e3230372e32392e323031, '2020-11-26 17:38:12', NULL, NULL, '2020-11-26 17:38:12', '2020-11-26 17:38:12'),
(61, 56, 0x3131372e39392e3136392e3636, '2020-12-22 18:39:33', NULL, NULL, '2020-12-22 18:39:33', '2020-12-22 18:39:33'),
(62, 61, 0x3136392e3134392e3230342e3434, '2020-12-22 21:31:32', '2020-12-22 21:48:36', '0:17', '2020-12-22 21:31:32', '2020-12-22 21:48:36'),
(63, 61, 0x3136392e3134392e3233342e323236, '2020-12-23 22:23:33', '2020-12-23 22:23:42', '0:0', '2020-12-23 22:23:33', '2020-12-23 22:23:42'),
(64, 64, 0x3130332e38372e35362e323135, '2020-12-26 14:32:31', '2020-12-26 16:32:30', '1:59', '2020-12-26 14:32:31', '2020-12-26 16:32:30'),
(65, 56, 0x3131372e39392e3136392e3636, '2020-12-27 13:06:48', '2020-12-27 13:08:49', '0:2', '2020-12-27 13:06:48', '2020-12-27 13:08:49'),
(66, 64, 0x3130332e38372e35372e323339, '2020-12-28 11:05:51', NULL, NULL, '2020-12-28 11:05:51', '2020-12-28 11:05:51'),
(67, 61, 0x3136392e3134392e3235352e313630, '2020-12-28 11:06:21', '2020-12-28 17:19:59', '6:13', '2020-12-28 11:06:21', '2020-12-28 17:19:59'),
(68, 56, 0x3131372e39392e3136392e3636, '2020-12-28 11:07:21', NULL, NULL, '2020-12-28 11:07:21', '2020-12-28 11:07:21'),
(69, 65, 0x3135372e33342e39362e323434, '2020-12-28 13:37:10', NULL, NULL, '2020-12-28 13:37:10', '2020-12-28 13:37:10'),
(70, 62, 0x34392e33362e3131362e323533, '2020-12-29 18:50:16', NULL, NULL, '2020-12-29 18:50:16', '2020-12-29 18:50:16'),
(71, 62, 0x34392e33362e3131382e3637, '2020-12-31 02:36:34', NULL, NULL, '2020-12-31 02:36:34', '2020-12-31 02:36:34'),
(72, 65, 0x3135372e33342e38332e3736, '2021-01-04 13:16:42', NULL, NULL, '2021-01-04 13:16:42', '2021-01-04 13:16:42'),
(73, 61, 0x3136392e3134392e3231362e313732, '2021-01-04 21:00:46', NULL, NULL, '2021-01-04 21:00:46', '2021-01-04 21:00:46'),
(74, 62, 0x34392e33362e3131362e3635, '2021-01-05 00:31:09', NULL, NULL, '2021-01-05 00:31:09', '2021-01-05 00:31:09'),
(75, 60, 0x3232332e3138372e3133302e3733, '2021-01-05 10:22:52', NULL, NULL, '2021-01-05 10:22:52', '2021-01-05 10:22:52'),
(76, 62, 0x34392e33362e3131382e3637, '2021-01-06 00:16:10', NULL, NULL, '2021-01-06 00:16:10', '2021-01-06 00:16:10'),
(77, 62, 0x34392e33362e3131382e3637, '2021-01-06 23:58:32', NULL, NULL, '2021-01-06 23:58:32', '2021-01-06 23:58:32'),
(78, 62, 0x34392e33362e3131382e3637, '2021-01-07 23:49:16', NULL, NULL, '2021-01-07 23:49:16', '2021-01-07 23:49:16'),
(79, 61, 0x3136392e3134392e3231362e3539, '2021-01-08 17:15:27', NULL, NULL, '2021-01-08 17:15:27', '2021-01-08 17:15:27'),
(80, 62, 0x34392e33362e3131382e3637, '2021-01-09 01:29:28', NULL, NULL, '2021-01-09 01:29:28', '2021-01-09 01:29:28'),
(81, 61, 0x3136392e3134392e3139392e313331, '2021-01-11 22:12:28', NULL, NULL, '2021-01-11 22:12:28', '2021-01-11 22:12:28'),
(82, 62, 0x34392e33362e3131382e313335, '2021-01-12 00:54:37', NULL, NULL, '2021-01-12 00:54:37', '2021-01-12 00:54:37'),
(83, 61, 0x3136392e3134392e3232332e313335, '2021-01-12 22:07:46', NULL, NULL, '2021-01-12 22:07:46', '2021-01-12 22:07:46'),
(84, 62, 0x34392e33362e3131382e313335, '2021-01-12 23:48:24', NULL, NULL, '2021-01-12 23:48:24', '2021-01-12 23:48:24'),
(85, 62, 0x34392e33362e3131362e323533, '2021-01-13 23:36:34', NULL, NULL, '2021-01-13 23:36:34', '2021-01-13 23:36:34'),
(86, 62, 0x34392e33362e3131362e323533, '2021-01-14 22:51:08', NULL, NULL, '2021-01-14 22:51:08', '2021-01-14 22:51:08'),
(87, 61, 0x3136392e3134392e3233382e313231, '2021-01-15 18:37:50', NULL, NULL, '2021-01-15 18:37:50', '2021-01-15 18:37:50'),
(88, 62, 0x34392e33362e3131362e323533, '2021-01-15 21:46:53', NULL, NULL, '2021-01-15 21:46:53', '2021-01-15 21:46:53'),
(89, 60, 0x32372e36312e3131322e3638, '2021-01-18 14:58:53', NULL, NULL, '2021-01-18 14:58:53', '2021-01-18 14:58:53'),
(90, 65, 0x3135372e33342e3135352e323132, '2021-01-18 15:14:08', NULL, NULL, '2021-01-18 15:14:08', '2021-01-18 15:14:08'),
(91, 61, 0x3136392e3134392e3235342e323031, '2021-01-18 22:59:17', NULL, NULL, '2021-01-18 22:59:17', '2021-01-18 22:59:17'),
(92, 62, 0x34392e33362e3131382e3637, '2021-01-18 23:09:09', NULL, NULL, '2021-01-18 23:09:09', '2021-01-18 23:09:09'),
(93, 62, 0x34392e33362e3131362e323235, '2021-01-19 23:02:36', NULL, NULL, '2021-01-19 23:02:36', '2021-01-19 23:02:36'),
(94, 61, 0x3136392e3134392e3232342e39, '2021-01-20 21:57:49', NULL, NULL, '2021-01-20 21:57:49', '2021-01-20 21:57:49'),
(95, 62, 0x34392e33362e3131342e313433, '2021-01-20 22:17:14', NULL, NULL, '2021-01-20 22:17:14', '2021-01-20 22:17:14'),
(96, 62, 0x34392e33362e3131342e313433, '2021-01-21 23:50:11', NULL, NULL, '2021-01-21 23:50:11', '2021-01-21 23:50:11'),
(97, 61, 0x3136392e3134392e3139322e313231, '2021-01-22 21:45:23', NULL, NULL, '2021-01-22 21:45:23', '2021-01-22 21:45:23'),
(98, 62, 0x34392e33362e3131342e313433, '2021-01-22 23:54:18', NULL, NULL, '2021-01-22 23:54:18', '2021-01-22 23:54:18'),
(99, 61, 0x3136392e3134392e3234362e36, '2021-01-25 21:40:50', NULL, NULL, '2021-01-25 21:40:50', '2021-01-25 21:40:50'),
(100, 62, 0x34392e33362e3131342e313433, '2021-01-25 22:36:06', NULL, NULL, '2021-01-25 22:36:06', '2021-01-25 22:36:06'),
(101, 61, 0x3136392e3134392e3232302e3630, '2021-01-27 22:10:44', NULL, NULL, '2021-01-27 22:10:44', '2021-01-27 22:10:44'),
(102, 62, 0x34392e33362e3131322e323435, '2021-01-27 23:05:40', NULL, NULL, '2021-01-27 23:05:40', '2021-01-27 23:05:40'),
(103, 61, 0x3136392e3134392e3233322e313630, '2021-01-28 22:34:33', NULL, NULL, '2021-01-28 22:34:33', '2021-01-28 22:34:33'),
(104, 62, 0x34392e33362e3131322e323435, '2021-01-29 00:31:03', NULL, NULL, '2021-01-29 00:31:03', '2021-01-29 00:31:03'),
(105, 61, 0x3136392e3134392e3233342e313036, '2021-01-29 22:19:01', NULL, NULL, '2021-01-29 22:19:01', '2021-01-29 22:19:01'),
(106, 62, 0x34392e33362e3131322e323435, '2021-01-29 22:48:52', NULL, NULL, '2021-01-29 22:48:52', '2021-01-29 22:48:52'),
(107, 61, 0x3136392e3134392e3230352e313831, '2021-02-01 22:11:19', NULL, NULL, '2021-02-01 22:11:19', '2021-02-01 22:11:19'),
(108, 62, 0x34392e33362e3131382e3535, '2021-02-02 00:08:39', NULL, NULL, '2021-02-02 00:08:39', '2021-02-02 00:08:39'),
(109, 61, 0x3136392e3134392e3230322e323431, '2021-02-02 23:01:36', '2021-02-02 23:37:09', '0:35', '2021-02-02 23:01:36', '2021-02-02 23:37:09'),
(110, 62, 0x34392e33362e3131322e3937, '2021-02-02 23:56:39', NULL, NULL, '2021-02-02 23:56:39', '2021-02-02 23:56:39'),
(111, 62, 0x34392e33362e3131342e313237, '2021-02-04 01:34:49', NULL, NULL, '2021-02-04 01:34:49', '2021-02-04 01:34:49'),
(112, 61, 0x3136392e3134392e3234382e323436, '2021-02-04 22:23:47', NULL, NULL, '2021-02-04 22:23:47', '2021-02-04 22:23:47'),
(113, 62, 0x34392e33362e3131382e3535, '2021-02-05 00:21:14', NULL, NULL, '2021-02-05 00:21:14', '2021-02-05 00:21:14'),
(114, 60, 0x3130362e3230372e34382e313037, '2021-02-05 11:10:24', NULL, NULL, '2021-02-05 11:10:24', '2021-02-05 11:10:24'),
(115, 56, 0x3131372e39372e3134352e3434, '2021-02-05 11:10:42', NULL, NULL, '2021-02-05 11:10:42', '2021-02-05 11:10:42'),
(116, 61, 0x3136392e3134392e3233382e3332, '2021-02-05 22:33:23', NULL, NULL, '2021-02-05 22:33:23', '2021-02-05 22:33:23'),
(117, 62, 0x34392e33362e3131362e313835, '2021-02-06 00:05:33', NULL, NULL, '2021-02-06 00:05:33', '2021-02-06 00:05:33'),
(118, 65, 0x3135372e33342e32372e3237, '2021-02-08 09:51:36', NULL, NULL, '2021-02-08 09:51:36', '2021-02-08 09:51:36'),
(119, 61, 0x3136392e3134392e3231322e313639, '2021-02-08 21:44:40', NULL, NULL, '2021-02-08 21:44:40', '2021-02-08 21:44:40'),
(120, 62, 0x34392e33362e3131342e323233, '2021-02-08 23:28:54', NULL, NULL, '2021-02-08 23:28:54', '2021-02-08 23:28:54'),
(121, 65, 0x3135372e33342e3130322e313438, '2021-02-09 13:47:56', NULL, NULL, '2021-02-09 13:47:56', '2021-02-09 13:47:56'),
(122, 65, 0x34372e3234372e36362e3334, '2021-02-10 13:35:56', NULL, NULL, '2021-02-10 13:35:56', '2021-02-10 13:35:56'),
(123, 62, 0x34392e33362e3131362e3533, '2021-02-10 23:58:18', NULL, NULL, '2021-02-10 23:58:18', '2021-02-10 23:58:18'),
(124, 59, 0x3136392e3134392e3230382e313135, '2021-02-11 18:38:08', '2021-02-11 18:39:50', '0:1', '2021-02-11 18:38:08', '2021-02-11 18:39:50'),
(125, 61, 0x3136392e3134392e3230382e313135, '2021-02-11 21:58:13', NULL, NULL, '2021-02-11 21:58:13', '2021-02-11 21:58:13'),
(126, 62, 0x34392e33362e3131362e3933, '2021-02-11 22:26:04', NULL, NULL, '2021-02-11 22:26:04', '2021-02-11 22:26:04'),
(127, 59, 0x3132342e3235332e3137312e3831, '2021-02-12 11:13:02', NULL, NULL, '2021-02-12 11:13:02', '2021-02-12 11:13:02'),
(128, 61, 0x3136392e3134392e3230382e313837, '2021-02-12 16:28:27', '2021-02-12 16:51:13', '0:22', '2021-02-12 16:28:27', '2021-02-12 16:51:13'),
(129, 62, 0x34392e33362e3131342e3233, '2021-02-15 08:45:07', NULL, NULL, '2021-02-15 08:45:07', '2021-02-15 08:45:07'),
(130, 60, 0x3130362e3230372e31362e313537, '2021-02-16 11:01:56', NULL, NULL, '2021-02-16 11:01:56', '2021-02-16 11:01:56'),
(131, 62, 0x34392e33362e3131382e323535, '2021-02-16 23:45:16', NULL, NULL, '2021-02-16 23:45:16', '2021-02-16 23:45:16'),
(132, 62, 0x34392e33362e3131362e313333, '2021-02-17 23:46:17', NULL, NULL, '2021-02-17 23:46:17', '2021-02-17 23:46:17'),
(133, 62, 0x34392e33362e3131322e313635, '2021-02-19 02:08:14', NULL, NULL, '2021-02-19 02:08:14', '2021-02-19 02:08:14'),
(134, 62, 0x34392e33362e3130302e3835, '2021-02-20 00:08:36', NULL, NULL, '2021-02-20 00:08:36', '2021-02-20 00:08:36'),
(135, 62, 0x34392e33362e39382e323535, '2021-02-22 21:13:51', NULL, NULL, '2021-02-22 21:13:51', '2021-02-22 21:13:51'),
(136, 62, 0x34392e33362e3130302e3435, '2021-02-24 23:26:45', NULL, NULL, '2021-02-24 23:26:45', '2021-02-24 23:26:45'),
(137, 62, 0x34392e33362e3130302e3435, '2021-02-25 23:10:31', NULL, NULL, '2021-02-25 23:10:31', '2021-02-25 23:10:31'),
(138, 62, 0x34392e33362e3130302e3435, '2021-02-26 23:35:42', NULL, NULL, '2021-02-26 23:35:42', '2021-02-26 23:35:42'),
(139, 62, 0x34392e33362e3130322e323233, '2021-03-02 01:15:51', NULL, NULL, '2021-03-02 01:15:51', '2021-03-02 01:15:51'),
(140, 62, 0x34392e33362e39382e3935, '2021-03-03 22:23:44', NULL, NULL, '2021-03-03 22:23:44', '2021-03-03 22:23:44'),
(141, 62, 0x34392e33362e3130302e313933, '2021-03-04 22:50:08', NULL, NULL, '2021-03-04 22:50:08', '2021-03-04 22:50:08'),
(142, 62, 0x34392e33362e39382e323033, '2021-03-06 00:05:38', NULL, NULL, '2021-03-06 00:05:38', '2021-03-06 00:05:38'),
(143, 62, 0x34392e33362e39382e323237, '2021-03-08 23:05:46', NULL, NULL, '2021-03-08 23:05:46', '2021-03-08 23:05:46'),
(144, 62, 0x34392e33362e39362e313835, '2021-03-09 23:32:51', NULL, NULL, '2021-03-09 23:32:51', '2021-03-09 23:32:51'),
(145, 59, 0x32372e3235352e3231392e3633, '2021-03-10 08:32:14', NULL, NULL, '2021-03-10 08:32:14', '2021-03-10 08:32:14'),
(146, 60, 0x3130362e3230372e35312e313331, '2021-03-10 10:40:47', NULL, NULL, '2021-03-10 10:40:47', '2021-03-10 10:40:47'),
(147, 62, 0x34392e33362e39362e313835, '2021-03-10 11:21:08', NULL, NULL, '2021-03-10 11:21:08', '2021-03-10 11:21:08'),
(148, 56, 0x3138322e36382e3235302e3237, '2021-03-10 17:39:15', NULL, NULL, '2021-03-10 17:39:15', '2021-03-10 17:39:15'),
(149, 62, 0x34392e33362e39362e313835, '2021-03-11 11:53:34', NULL, NULL, '2021-03-11 11:53:34', '2021-03-11 11:53:34'),
(150, 56, 0x3138322e36382e3235302e3237, '2021-03-11 12:40:07', NULL, NULL, '2021-03-11 12:40:07', '2021-03-11 12:40:07'),
(151, 64, 0x3130332e38372e35362e313432, '2021-03-11 14:01:41', NULL, NULL, '2021-03-11 14:01:41', '2021-03-11 14:01:41'),
(152, 61, 0x34372e33312e31352e313031, '2021-03-11 23:35:57', '2021-03-12 00:34:42', '0:58', '2021-03-11 23:35:57', '2021-03-12 00:34:42'),
(153, 64, 0x3130332e38372e35372e313831, '2021-03-12 10:07:07', NULL, NULL, '2021-03-12 10:07:07', '2021-03-12 10:07:07'),
(154, 56, 0x3138322e36382e3235302e3237, '2021-03-12 13:33:05', NULL, NULL, '2021-03-12 13:33:05', '2021-03-12 13:33:05'),
(155, 62, 0x34392e33362e3130302e3435, '2021-03-13 00:04:02', NULL, NULL, '2021-03-13 00:04:02', '2021-03-13 00:04:02'),
(156, 62, 0x34392e33362e39382e3339, '2021-03-15 22:31:14', NULL, NULL, '2021-03-15 22:31:14', '2021-03-15 22:31:14'),
(157, 62, 0x34392e33362e39382e3339, '2021-03-16 22:05:20', NULL, NULL, '2021-03-16 22:05:20', '2021-03-16 22:05:20'),
(158, 56, 0x3132322e3136312e36332e323434, '2021-03-17 16:38:33', NULL, NULL, '2021-03-17 16:38:33', '2021-03-17 16:38:33'),
(159, 64, 0x3136302e3230322e33372e3438, '2021-03-17 16:49:02', NULL, NULL, '2021-03-17 16:49:02', '2021-03-17 16:49:02'),
(160, 62, 0x34392e33362e3130322e3437, '2021-03-17 20:06:36', NULL, NULL, '2021-03-17 20:06:36', '2021-03-17 20:06:36'),
(161, 62, 0x34392e33362e3130322e313433, '2021-03-19 15:05:31', NULL, NULL, '2021-03-19 15:05:31', '2021-03-19 15:05:31'),
(162, 56, 0x3131372e39392e3136322e3133, '2021-03-19 21:08:15', NULL, NULL, '2021-03-19 21:08:15', '2021-03-19 21:08:15'),
(163, 62, 0x34392e33362e3130322e37, '2021-03-22 23:30:58', NULL, NULL, '2021-03-22 23:30:58', '2021-03-22 23:30:58'),
(164, 62, 0x34392e33362e3130322e313237, '2021-03-23 20:16:47', NULL, NULL, '2021-03-23 20:16:47', '2021-03-23 20:16:47'),
(165, 62, 0x34392e33362e3130302e313431, '2021-03-25 23:07:40', NULL, NULL, '2021-03-25 23:07:40', '2021-03-25 23:07:40'),
(166, 62, 0x34392e33362e3130302e313431, '2021-03-26 21:18:44', NULL, NULL, '2021-03-26 21:18:44', '2021-03-26 21:18:44'),
(167, 62, 0x34392e33362e3130322e313935, '2021-03-30 20:38:58', NULL, NULL, '2021-03-30 20:38:58', '2021-03-30 20:38:58'),
(168, 62, 0x34392e33362e3130322e3437, '2021-04-01 00:39:21', NULL, NULL, '2021-04-01 00:39:21', '2021-04-01 00:39:21'),
(169, 62, 0x34392e33362e3130322e3437, '2021-04-01 22:27:59', NULL, NULL, '2021-04-01 22:27:59', '2021-04-01 22:27:59'),
(170, 62, 0x34392e33362e3130322e37, '2021-04-05 21:41:22', NULL, NULL, '2021-04-05 21:41:22', '2021-04-05 21:41:22'),
(171, 62, 0x34392e33362e3130322e37, '2021-04-06 23:25:55', NULL, NULL, '2021-04-06 23:25:55', '2021-04-06 23:25:55'),
(172, 62, 0x34392e33362e3130322e3539, '2021-04-07 22:35:19', NULL, NULL, '2021-04-07 22:35:19', '2021-04-07 22:35:19'),
(173, 62, 0x34392e33362e3130322e3539, '2021-04-08 12:27:49', NULL, NULL, '2021-04-08 12:27:49', '2021-04-08 12:27:49'),
(174, 62, 0x34392e33362e39362e323235, '2021-04-13 00:26:26', NULL, NULL, '2021-04-13 00:26:26', '2021-04-13 00:26:26'),
(175, 62, 0x34392e33362e3130322e313535, '2021-04-14 23:53:35', NULL, NULL, '2021-04-14 23:53:35', '2021-04-14 23:53:35'),
(176, 62, 0x34392e33362e3130322e313535, '2021-04-16 00:31:50', NULL, NULL, '2021-04-16 00:31:50', '2021-04-16 00:31:50'),
(177, 62, 0x34392e33362e3130322e313535, '2021-04-16 23:24:31', NULL, NULL, '2021-04-16 23:24:31', '2021-04-16 23:24:31'),
(178, 62, 0x34392e33362e3130302e323333, '2021-04-20 00:48:32', NULL, NULL, '2021-04-20 00:48:32', '2021-04-20 00:48:32'),
(179, 62, 0x34392e33362e3130302e323333, '2021-04-21 09:29:31', NULL, NULL, '2021-04-21 09:29:31', '2021-04-21 09:29:31'),
(180, 62, 0x34392e33362e3130302e323333, '2021-04-22 22:34:19', NULL, NULL, '2021-04-22 22:34:19', '2021-04-22 22:34:19'),
(181, 62, 0x34392e33362e3130302e323333, '2021-04-27 23:51:58', NULL, NULL, '2021-04-27 23:51:58', '2021-04-27 23:51:58'),
(182, 62, 0x34392e33362e39362e3635, '2021-04-29 09:53:04', NULL, NULL, '2021-04-29 09:53:04', '2021-04-29 09:53:04'),
(183, 62, 0x34392e33362e39362e3635, '2021-04-30 11:34:23', NULL, NULL, '2021-04-30 11:34:23', '2021-04-30 11:34:23'),
(184, 62, 0x34392e33362e39362e3635, '2021-05-03 09:45:11', NULL, NULL, '2021-05-03 09:45:11', '2021-05-03 09:45:11'),
(185, 65, 0x3135372e33342e3132362e3736, '2021-05-03 09:45:59', NULL, NULL, '2021-05-03 09:45:59', '2021-05-03 09:45:59'),
(186, 62, 0x34392e33362e39362e3635, '2021-05-04 23:50:27', NULL, NULL, '2021-05-04 23:50:27', '2021-05-04 23:50:27'),
(187, 62, 0x34392e33362e39362e3635, '2021-05-06 00:10:20', NULL, NULL, '2021-05-06 00:10:20', '2021-05-06 00:10:20'),
(188, 62, 0x34392e33362e39362e3635, '2021-05-06 23:19:24', NULL, NULL, '2021-05-06 23:19:24', '2021-05-06 23:19:24'),
(189, 62, 0x34392e33362e39362e3635, '2021-05-07 22:08:41', NULL, NULL, '2021-05-07 22:08:41', '2021-05-07 22:08:41'),
(190, 62, 0x34392e33362e39362e3635, '2021-05-10 21:24:06', NULL, NULL, '2021-05-10 21:24:06', '2021-05-10 21:24:06'),
(191, 62, 0x34392e33362e39362e3635, '2021-05-12 09:19:49', NULL, NULL, '2021-05-12 09:19:49', '2021-05-12 09:19:49'),
(192, 62, 0x34392e33362e39362e3635, '2021-05-13 23:56:30', NULL, NULL, '2021-05-13 23:56:30', '2021-05-13 23:56:30'),
(193, 62, 0x34392e33362e39362e3635, '2021-05-14 11:34:48', NULL, NULL, '2021-05-14 11:34:48', '2021-05-14 11:34:48'),
(194, 62, 0x34392e33362e39362e3635, '2021-05-18 01:11:02', NULL, NULL, '2021-05-18 01:11:02', '2021-05-18 01:11:02'),
(195, 62, 0x34392e33362e39362e3635, '2021-05-19 00:28:17', NULL, NULL, '2021-05-19 00:28:17', '2021-05-19 00:28:17'),
(196, 62, 0x34392e33362e39362e3635, '2021-05-20 01:27:37', NULL, NULL, '2021-05-20 01:27:37', '2021-05-20 01:27:37'),
(197, 62, 0x34392e33362e39362e3635, '2021-05-20 15:36:05', NULL, NULL, '2021-05-20 15:36:05', '2021-05-20 15:36:05'),
(198, 62, 0x34392e33362e39362e313835, '2021-06-08 17:25:01', NULL, NULL, '2021-06-08 17:25:01', '2021-06-08 17:25:01'),
(199, 56, 0x3138322e36342e3138332e313233, '2021-06-23 17:17:37', NULL, NULL, '2021-06-23 17:17:37', '2021-06-23 17:17:37'),
(200, 66, 0x3130332e3139352e3230312e3438, '2021-06-24 11:56:06', '2021-06-24 12:56:33', '1:0', '2021-06-24 11:56:06', '2021-06-24 12:56:33'),
(201, 56, 0x3138322e36342e3138332e313233, '2021-06-24 11:56:56', NULL, NULL, '2021-06-24 11:56:56', '2021-06-24 11:56:56'),
(202, 65, 0x3130362e36372e3134382e39, '2021-06-24 12:45:59', NULL, NULL, '2021-06-24 12:45:59', '2021-06-24 12:45:59'),
(203, 56, 0x3131372e39372e3138342e323235, '2021-07-05 13:43:48', NULL, NULL, '2021-07-05 13:43:48', '2021-07-05 13:43:48'),
(204, 66, 0x3130332e3139352e3230312e313937, '2021-07-05 18:31:50', NULL, NULL, '2021-07-05 18:31:50', '2021-07-05 18:31:50'),
(205, 64, 0x3136302e3230322e33372e313530, '2021-07-06 16:58:02', NULL, NULL, '2021-07-06 16:58:02', '2021-07-06 16:58:02'),
(206, 66, 0x3130332e3230382e37302e323030, '2021-07-07 16:49:59', NULL, NULL, '2021-07-07 16:49:59', '2021-07-07 16:49:59'),
(207, 64, 0x3136302e3230322e33372e313736, '2021-07-12 16:16:18', NULL, NULL, '2021-07-12 16:16:18', '2021-07-12 16:16:18'),
(208, 66, 0x3130332e3139352e3230312e313239, '2021-07-12 17:49:15', NULL, NULL, '2021-07-12 17:49:15', '2021-07-12 17:49:15'),
(209, 64, 0x3136302e3230322e33372e313736, '2021-07-13 15:36:05', NULL, NULL, '2021-07-13 15:36:05', '2021-07-13 15:36:05'),
(210, 59, 0x3232332e3137382e3231312e313136, '2021-07-13 19:07:00', '2021-07-13 21:54:14', '2:47', '2021-07-13 19:07:00', '2021-07-13 21:54:14'),
(211, 59, 0x3232332e3137382e3231312e313136, '2021-07-14 08:35:47', '2021-07-14 08:48:34', '0:12', '2021-07-14 08:35:47', '2021-07-14 08:48:34'),
(212, 56, 0x3138322e36342e34302e313032, '2021-07-14 16:49:33', NULL, NULL, '2021-07-14 16:49:33', '2021-07-14 16:49:33'),
(213, 66, 0x3130332e3230382e37302e313633, '2021-07-15 14:05:32', NULL, NULL, '2021-07-15 14:05:32', '2021-07-15 14:05:32'),
(214, 59, 0x3232332e3137382e3231312e313136, '2021-07-16 11:07:07', '2021-07-16 19:22:42', '8:15', '2021-07-16 11:07:07', '2021-07-16 19:22:42'),
(215, 62, 0x34392e33362e3130322e3837, '2021-07-20 16:50:34', NULL, NULL, '2021-07-20 16:50:34', '2021-07-20 16:50:34'),
(216, 66, 0x3130332e3230382e37302e313335, '2021-07-21 13:31:36', NULL, NULL, '2021-07-21 13:31:36', '2021-07-21 13:31:36'),
(217, 64, 0x3136302e3230322e33372e3130, '2021-07-22 15:22:15', NULL, NULL, '2021-07-22 15:22:15', '2021-07-22 15:22:15'),
(218, 66, 0x3130332e3230382e37302e313335, '2021-07-22 16:04:18', NULL, NULL, '2021-07-22 16:04:18', '2021-07-22 16:04:18'),
(219, 59, 0x3232332e3137382e3231312e313136, '2021-07-22 16:38:21', '2021-07-22 16:56:16', '0:17', '2021-07-22 16:38:21', '2021-07-22 16:56:16'),
(220, 60, 0x3232332e3137382e3231312e313136, '2021-07-22 16:55:19', '2021-07-22 16:57:07', '0:1', '2021-07-22 16:55:19', '2021-07-22 16:57:07'),
(221, 56, 0x3132322e3136322e3136332e3935, '2021-07-23 11:59:42', NULL, NULL, '2021-07-23 11:59:42', '2021-07-23 11:59:42'),
(222, 64, 0x3230352e3235342e3137352e323237, '2021-07-23 12:20:50', NULL, NULL, '2021-07-23 12:20:50', '2021-07-23 12:20:50'),
(223, 59, 0x3232332e3137382e3231312e313136, '2021-07-23 13:32:45', '2021-07-23 13:33:15', '0:0', '2021-07-23 13:32:45', '2021-07-23 13:33:15'),
(224, 60, 0x3232332e3138352e35302e313037, '2021-07-23 15:06:18', NULL, NULL, '2021-07-23 15:06:18', '2021-07-23 15:06:18'),
(225, 60, 0x3230322e3134322e39392e313431, '2021-07-24 12:05:24', NULL, NULL, '2021-07-24 12:05:24', '2021-07-24 12:05:24'),
(226, 64, 0x3230352e3235342e3137352e3639, '2021-07-26 17:43:23', NULL, NULL, '2021-07-26 17:43:23', '2021-07-26 17:43:23'),
(227, 62, 0x34392e33362e3130302e3137, '2021-08-02 14:17:16', NULL, NULL, '2021-08-02 14:17:16', '2021-08-02 14:17:16'),
(228, 62, 0x34392e33362e3130302e3137, '2021-08-06 11:02:02', NULL, NULL, '2021-08-06 11:02:02', '2021-08-06 11:02:02'),
(229, 62, 0x34392e33362e39382e313139, '2021-08-09 09:35:15', NULL, NULL, '2021-08-09 09:35:15', '2021-08-09 09:35:15'),
(230, 66, 0x3130332e3139352e3230312e313730, '2021-08-13 18:05:46', NULL, NULL, '2021-08-13 18:05:46', '2021-08-13 18:05:46'),
(231, 62, 0x3130362e3139332e3232312e313038, '2021-08-15 21:04:26', NULL, NULL, '2021-08-15 21:04:26', '2021-08-15 21:04:26'),
(232, 62, 0x34392e33362e39382e3339, '2021-08-22 22:38:24', NULL, NULL, '2021-08-22 22:38:24', '2021-08-22 22:38:24'),
(233, 56, 0x3137312e37392e35342e313734, '2021-08-23 22:56:23', NULL, NULL, '2021-08-23 22:56:23', '2021-08-23 22:56:23'),
(234, 62, 0x34392e33362e3130322e323233, '2021-09-06 21:42:38', NULL, NULL, '2021-09-06 21:42:38', '2021-09-06 21:42:38'),
(235, 62, 0x34392e33362e39382e313837, '2021-09-15 12:28:21', NULL, NULL, '2021-09-15 12:28:21', '2021-09-15 12:28:21'),
(236, 62, 0x34392e33362e39362e3235, '2021-10-06 13:17:40', NULL, NULL, '2021-10-06 13:17:40', '2021-10-06 13:17:40'),
(237, 62, 0x34392e33362e3130302e313533, '2021-10-22 18:27:44', NULL, NULL, '2021-10-22 18:27:44', '2021-10-22 18:27:44'),
(238, 66, 0x3130332e3230382e37302e313230, '2021-11-01 10:21:29', NULL, NULL, '2021-11-01 10:21:29', '2021-11-01 10:21:29'),
(239, 56, 0x3232332e3139302e39352e323236, '2021-11-17 14:25:53', '2021-11-17 15:17:08', '0:51', '2021-11-17 14:25:53', '2021-11-17 15:17:08'),
(240, 68, 0x34392e33372e3138342e313836, '2021-11-17 15:01:41', NULL, NULL, '2021-11-17 15:01:41', '2021-11-17 15:01:41'),
(241, 62, 0x34392e33362e39362e3439, '2021-11-18 09:32:58', NULL, NULL, '2021-11-18 09:32:58', '2021-11-18 09:32:58'),
(242, 66, 0x3130332e3230382e37302e3235, '2021-11-18 10:43:58', NULL, NULL, '2021-11-18 10:43:58', '2021-11-18 10:43:58'),
(243, 68, 0x34392e33372e3138372e323032, '2021-11-24 07:38:06', NULL, NULL, '2021-11-24 07:38:06', '2021-11-24 07:38:06'),
(244, 66, 0x34352e3131392e33312e3435, '2021-12-02 11:39:39', NULL, NULL, '2021-12-02 11:39:39', '2021-12-02 11:39:39'),
(245, 68, 0x34392e33372e3138372e323032, '2021-12-05 18:49:15', NULL, NULL, '2021-12-05 18:49:15', '2021-12-05 18:49:15'),
(246, 62, 0x34392e33362e39382e313139, '2021-12-05 18:57:44', NULL, NULL, '2021-12-05 18:57:44', '2021-12-05 18:57:44'),
(247, 62, 0x34392e33362e3130322e313935, '2021-12-06 13:53:14', NULL, NULL, '2021-12-06 13:53:14', '2021-12-06 13:53:14'),
(248, 64, 0x3138322e36392e3134392e323236, '2021-12-07 17:37:30', NULL, NULL, '2021-12-07 17:37:30', '2021-12-07 17:37:30'),
(249, 66, 0x3130332e3230382e36382e313132, '2021-12-07 17:37:58', NULL, NULL, '2021-12-07 17:37:58', '2021-12-07 17:37:58'),
(250, 59, 0x3232332e3137382e3231332e35, '2021-12-09 08:28:03', NULL, NULL, '2021-12-09 08:28:03', '2021-12-09 08:28:03'),
(251, 56, 0x3232332e3139302e39352e313231, '2021-12-13 13:29:56', NULL, NULL, '2021-12-13 13:29:56', '2021-12-13 13:29:56'),
(252, 67, 0x3232332e3233352e3138372e313233, '2021-12-13 15:41:29', NULL, NULL, '2021-12-13 15:41:29', '2021-12-13 15:41:29'),
(253, 56, 0x3132322e3136312e38332e313434, '2021-12-20 22:46:42', NULL, NULL, '2021-12-20 22:46:42', '2021-12-20 22:46:42'),
(254, 67, 0x34392e33362e3139312e3433, '2021-12-23 10:29:20', NULL, NULL, '2021-12-23 10:29:20', '2021-12-23 10:29:20'),
(255, 67, 0x34392e33362e3138392e313333, '2021-12-24 11:46:50', NULL, NULL, '2021-12-24 11:46:50', '2021-12-24 11:46:50'),
(256, 66, 0x34352e3131392e33312e3236, '2021-12-24 19:33:58', NULL, NULL, '2021-12-24 19:33:58', '2021-12-24 19:33:58'),
(257, 69, 0x3130362e3231302e3130302e313237, '2021-12-24 19:58:45', '2021-12-24 21:15:07', '1:16', '2021-12-24 19:58:45', '2021-12-24 21:15:07'),
(258, 56, 0x3138322e36342e35352e3337, '2021-12-26 15:40:58', NULL, NULL, '2021-12-26 15:40:58', '2021-12-26 15:40:58'),
(259, 62, 0x34392e33362e3130322e313433, '2021-12-27 10:05:57', NULL, NULL, '2021-12-27 10:05:57', '2021-12-27 10:05:57'),
(260, 56, 0x3138322e36342e33332e323230, '2021-12-28 13:04:03', '2021-12-28 13:05:10', '0:1', '2021-12-28 13:04:03', '2021-12-28 13:05:10'),
(261, 67, 0x34392e33362e3139312e3331, '2022-01-02 17:48:19', NULL, NULL, '2022-01-02 17:48:19', '2022-01-02 17:48:19'),
(262, 67, 0x34392e33362e3139312e3331, '2022-01-03 17:35:08', NULL, NULL, '2022-01-03 17:35:08', '2022-01-03 17:35:08'),
(263, 59, 0x3132322e3138312e3131302e323231, '2022-01-04 16:23:50', NULL, NULL, '2022-01-04 16:23:50', '2022-01-04 16:23:50'),
(264, 56, 0x3138322e36342e35322e313930, '2022-01-07 14:53:29', '2022-01-07 14:55:01', '0:1', '2022-01-07 14:53:29', '2022-01-07 14:55:01'),
(265, 62, 0x34392e33362e3130322e313433, '2022-01-14 18:21:56', NULL, NULL, '2022-01-14 18:21:56', '2022-01-14 18:21:56'),
(266, 62, 0x34392e33362e3130302e3835, '2022-01-25 10:14:33', NULL, NULL, '2022-01-25 10:14:33', '2022-01-25 10:14:33'),
(267, 56, 0x3132322e3136312e3136322e323331, '2022-02-18 16:34:39', NULL, NULL, '2022-02-18 16:34:39', '2022-02-18 16:34:39'),
(268, 62, 0x34392e33362e3130322e313833, '2022-02-25 23:34:16', NULL, NULL, '2022-02-25 23:34:16', '2022-02-25 23:34:16'),
(269, 62, 0x34392e33362e3130302e323231, '2022-02-28 19:27:28', NULL, NULL, '2022-02-28 19:27:28', '2022-02-28 19:27:28'),
(270, 60, 0x3230322e3134322e37302e3735, '2022-03-01 12:54:07', NULL, NULL, '2022-03-01 12:54:07', '2022-03-01 12:54:07'),
(271, 56, 0x3232332e3138322e37332e323434, '2022-03-11 14:04:41', NULL, NULL, '2022-03-11 14:04:41', '2022-03-11 14:04:41'),
(272, 56, 0x3132322e3136312e3137362e323036, '2022-03-15 12:43:38', NULL, NULL, '2022-03-15 12:43:38', '2022-03-15 12:43:38'),
(273, 62, 0x34392e33362e39382e323237, '2022-03-30 11:06:32', NULL, NULL, '2022-03-30 11:06:32', '2022-03-30 11:06:32'),
(274, 56, 0x3132322e3136322e3232302e3734, '2022-04-08 13:51:51', NULL, NULL, '2022-04-08 13:51:51', '2022-04-08 13:51:51'),
(275, 70, 0x3130362e3230372e34312e3234, '2022-04-08 14:52:31', NULL, NULL, '2022-04-08 14:52:31', '2022-04-08 14:52:31'),
(276, 69, 0x3232332e3139302e38312e3237, '2022-04-15 12:00:32', '2022-04-15 12:04:19', '0:3', '2022-04-15 12:00:32', '2022-04-15 12:04:19'),
(277, 56, 0x3138322e36382e38362e3336, '2022-04-15 14:19:58', NULL, NULL, '2022-04-15 14:19:58', '2022-04-15 14:19:58'),
(278, 68, 0x34392e33372e3138342e323338, '2022-04-18 10:06:20', NULL, NULL, '2022-04-18 10:06:20', '2022-04-18 10:06:20'),
(279, 70, 0x3232332e3137382e3231302e323231, '2022-04-27 13:19:56', NULL, NULL, '2022-04-27 13:19:56', '2022-04-27 13:19:56'),
(280, 68, 0x34392e33372e3138372e3939, '2022-04-27 20:09:01', NULL, NULL, '2022-04-27 20:09:01', '2022-04-27 20:09:01'),
(281, 70, 0x3232332e3137382e3231302e323231, '2022-04-28 13:16:20', NULL, NULL, '2022-04-28 13:16:20', '2022-04-28 13:16:20'),
(282, 62, 0x34392e33362e3130322e313535, '2022-04-28 15:11:27', NULL, NULL, '2022-04-28 15:11:27', '2022-04-28 15:11:27'),
(283, 56, 0x3138322e36382e38362e3336, '2022-04-29 13:19:46', '2022-04-29 13:53:29', '0:33', '2022-04-29 13:19:46', '2022-04-29 13:53:29'),
(284, 71, 0x3130332e3230382e37312e3835, '2022-04-29 13:34:43', NULL, NULL, '2022-04-29 13:34:43', '2022-04-29 13:34:43'),
(285, 72, 0x34392e33362e3134342e3630, '2022-04-29 13:45:09', '2022-04-29 14:35:54', '0:50', '2022-04-29 13:45:09', '2022-04-29 14:35:54'),
(286, 62, 0x34392e33362e39382e3237, '2022-04-30 11:55:47', NULL, NULL, '2022-04-30 11:55:47', '2022-04-30 11:55:47'),
(287, 72, 0x34392e33362e3134342e3630, '2022-04-30 21:44:59', NULL, NULL, '2022-04-30 21:44:59', '2022-04-30 21:44:59'),
(288, 70, 0x3232332e3137382e3231302e323231, '2022-05-02 16:03:17', NULL, NULL, '2022-05-02 16:03:17', '2022-05-02 16:03:17'),
(289, 72, 0x34392e33362e3134342e3630, '2022-05-02 20:41:34', NULL, NULL, '2022-05-02 20:41:34', '2022-05-02 20:41:34'),
(290, 71, 0x3130332e3230382e36392e3837, '2022-05-02 21:44:26', NULL, NULL, '2022-05-02 21:44:26', '2022-05-02 21:44:26'),
(291, 69, 0x3232332e3139302e38342e313131, '2022-05-02 23:18:56', '2022-05-02 23:28:15', '0:9', '2022-05-02 23:18:56', '2022-05-02 23:28:15'),
(292, 56, 0x3138322e36382e38362e3336, '2022-05-03 13:17:38', '2022-05-03 13:25:35', '0:7', '2022-05-03 13:17:38', '2022-05-03 13:25:35'),
(293, 74, 0x34392e3230372e3232372e3834, '2022-05-04 10:06:43', NULL, NULL, '2022-05-04 10:06:43', '2022-05-04 10:06:43'),
(294, 74, 0x34392e3230372e3232382e3330, '2022-05-05 14:33:34', NULL, NULL, '2022-05-05 14:33:34', '2022-05-05 14:33:34'),
(295, 56, 0x3138322e36382e38362e3336, '2022-05-06 12:17:38', NULL, NULL, '2022-05-06 12:17:38', '2022-05-06 12:17:38'),
(296, 74, 0x34392e3230372e3139372e323334, '2022-05-06 14:38:01', NULL, NULL, '2022-05-06 14:38:01', '2022-05-06 14:38:01'),
(297, 74, 0x34392e3230372e3230342e3636, '2022-05-08 11:41:23', NULL, NULL, '2022-05-08 11:41:23', '2022-05-08 11:41:23'),
(298, 70, 0x3232332e3137382e3230382e34, '2022-05-10 10:05:49', NULL, NULL, '2022-05-10 10:05:49', '2022-05-10 10:05:49'),
(299, 74, 0x34392e3230372e3139362e3839, '2022-05-11 11:00:42', NULL, NULL, '2022-05-11 11:00:42', '2022-05-11 11:00:42'),
(300, 56, 0x3132322e3136312e38322e35, '2022-05-12 12:26:58', NULL, NULL, '2022-05-12 12:26:58', '2022-05-12 12:26:58'),
(301, 67, 0x3135372e33352e31392e313631, '2022-05-12 13:02:32', NULL, NULL, '2022-05-12 13:02:32', '2022-05-12 13:02:32'),
(302, 62, 0x34392e33362e39382e3237, '2022-05-12 13:05:18', NULL, NULL, '2022-05-12 13:05:18', '2022-05-12 13:05:18'),
(303, 68, 0x34392e33372e3138352e3336, '2022-05-12 13:05:24', NULL, NULL, '2022-05-12 13:05:24', '2022-05-12 13:05:24'),
(304, 75, 0x34392e33362e3137392e3738, '2022-05-12 13:49:16', NULL, NULL, '2022-05-12 13:49:16', '2022-05-12 13:49:16'),
(305, 66, 0x3130332e3230382e36382e3438, '2022-05-12 15:03:33', NULL, NULL, '2022-05-12 15:03:33', '2022-05-12 15:03:33'),
(306, 60, 0x3131302e3232372e36342e313839, '2022-05-12 15:09:35', NULL, NULL, '2022-05-12 15:09:35', '2022-05-12 15:09:35'),
(307, 71, 0x3130332e35392e37342e3437, '2022-05-12 17:13:03', NULL, NULL, '2022-05-12 17:13:03', '2022-05-12 17:13:03'),
(308, 69, 0x3232332e3139302e38302e3839, '2022-05-12 18:47:55', '2022-05-12 19:03:20', '0:15', '2022-05-12 18:47:55', '2022-05-12 19:03:20'),
(309, 68, 0x34392e33372e3138352e3336, '2022-05-13 21:26:15', NULL, NULL, '2022-05-13 21:26:15', '2022-05-13 21:26:15'),
(310, 56, 0x3132322e3136312e38332e3335, '2022-05-14 15:03:13', '2022-05-14 15:04:43', '0:1', '2022-05-14 15:03:13', '2022-05-14 15:04:43'),
(311, 76, 0x3130362e3231322e372e3934, '2022-05-14 17:10:54', NULL, NULL, '2022-05-14 17:10:54', '2022-05-14 17:10:54'),
(312, 62, 0x34392e33362e3130302e323333, '2022-05-16 12:13:24', NULL, NULL, '2022-05-16 12:13:24', '2022-05-16 12:13:24'),
(313, 56, 0x3132322e3136312e38332e3335, '2022-05-16 13:13:44', '2022-05-16 23:43:58', '10:30', '2022-05-16 13:13:44', '2022-05-16 23:43:58'),
(314, 73, 0x34352e3131352e3235352e3230, '2022-05-16 16:35:20', NULL, NULL, '2022-05-16 16:35:20', '2022-05-16 16:35:20'),
(315, 66, 0x3130332e3230382e36382e3337, '2022-05-16 19:55:48', NULL, NULL, '2022-05-16 19:55:48', '2022-05-16 19:55:48'),
(316, 56, 0x3132322e3136312e38332e3335, '2022-05-18 11:58:28', NULL, NULL, '2022-05-18 11:58:28', '2022-05-18 11:58:28'),
(317, 74, 0x3135372e34352e3130342e313338, '2022-05-18 14:46:54', NULL, NULL, '2022-05-18 14:46:54', '2022-05-18 14:46:54'),
(318, 62, 0x34392e33362e39362e3439, '2022-05-19 08:44:41', '2022-05-19 08:45:07', '0:0', '2022-05-19 08:44:41', '2022-05-19 08:45:07'),
(319, 70, 0x3232332e3137382e3231302e313932, '2022-05-19 13:44:44', NULL, NULL, '2022-05-19 13:44:44', '2022-05-19 13:44:44'),
(320, 66, 0x3130332e3230382e36382e313435, '2022-05-19 18:00:44', NULL, NULL, '2022-05-19 18:00:44', '2022-05-19 18:00:44'),
(321, 68, 0x3232332e3138362e3231312e35, '2022-05-20 06:43:17', NULL, NULL, '2022-05-20 06:43:17', '2022-05-20 06:43:17'),
(322, 69, 0x3132322e3136312e38302e31, '2022-05-20 21:45:25', '2022-05-20 22:21:13', '0:35', '2022-05-20 21:45:25', '2022-05-20 22:21:13'),
(323, 73, 0x3130332e33382e37302e3131, '2022-05-23 09:12:21', NULL, NULL, '2022-05-23 09:12:21', '2022-05-23 09:12:21'),
(324, 69, 0x323430313a343930303a316336363a32, '2022-05-23 14:20:33', '2022-05-23 14:40:14', '0:19', '2022-05-23 14:20:33', '2022-05-23 14:40:14'),
(325, 74, 0x34392e3230372e3139362e313231, '2022-05-26 16:20:45', NULL, NULL, '2022-05-26 16:20:45', '2022-05-26 16:20:45'),
(326, 74, 0x34392e3230372e3139362e313231, '2022-05-28 11:19:28', NULL, NULL, '2022-05-28 11:19:28', '2022-05-28 11:19:28'),
(327, 56, 0x323430313a343930303a316330303a34, '2022-05-30 14:48:12', '2022-05-31 00:06:24', '9:18', '2022-05-30 14:48:12', '2022-05-31 00:06:24'),
(328, 76, 0x323430313a343930303a316330303a34, '2022-05-31 00:07:02', '2022-05-31 00:28:55', '0:21', '2022-05-31 00:07:02', '2022-05-31 00:28:55'),
(329, 66, 0x323430353a3230313a343031633a6530, '2022-05-31 10:02:25', NULL, NULL, '2022-05-31 10:02:25', '2022-05-31 10:02:25'),
(330, 62, 0x323430353a3230313a32303a36313431, '2022-05-31 13:43:46', '2022-05-31 13:45:19', '0:1', '2022-05-31 13:43:46', '2022-05-31 13:45:19'),
(331, 56, 0x3132322e3137362e3234332e313235, '2022-05-31 13:44:00', '2022-05-31 15:22:46', '1:38', '2022-05-31 13:44:00', '2022-05-31 15:22:46'),
(332, 68, 0x323430353a3230313a643031303a6630, '2022-05-31 13:48:36', NULL, NULL, '2022-05-31 13:48:36', '2022-05-31 13:48:36'),
(333, 73, 0x3131382e39312e3139302e323437, '2022-05-31 13:53:14', NULL, NULL, '2022-05-31 13:53:14', '2022-05-31 13:53:14'),
(334, 75, 0x323430353a3230313a343032633a6330, '2022-05-31 13:57:26', NULL, NULL, '2022-05-31 13:57:26', '2022-05-31 13:57:26'),
(335, 63, 0x323430313a343930303a316336363a62, '2022-05-31 14:05:44', NULL, NULL, '2022-05-31 14:05:44', '2022-05-31 14:05:44'),
(336, 71, 0x323430323a653238303a336532323a33, '2022-05-31 14:29:27', NULL, NULL, '2022-05-31 14:29:27', '2022-05-31 14:29:27'),
(337, 72, 0x323430353a3230313a343031383a3938, '2022-06-01 08:02:49', NULL, NULL, '2022-06-01 08:02:49', '2022-06-01 08:02:49'),
(338, 66, 0x3130332e3230382e36382e313138, '2022-06-01 11:44:29', NULL, NULL, '2022-06-01 11:44:29', '2022-06-01 11:44:29'),
(339, 56, 0x323430313a343930303a316333313a37, '2022-06-02 15:04:10', '2022-06-02 15:06:59', '0:2', '2022-06-02 15:04:10', '2022-06-02 15:06:59'),
(340, 75, 0x323430353a3230313a343032633a6330, '2022-06-02 15:06:27', NULL, NULL, '2022-06-02 15:06:27', '2022-06-02 15:06:27'),
(341, 63, 0x323430313a343930303a316333313a37, '2022-06-03 11:32:42', NULL, NULL, '2022-06-03 11:32:42', '2022-06-03 11:32:42'),
(342, 70, 0x323430313a343930303a313638373a34, '2022-06-06 11:27:32', NULL, NULL, '2022-06-06 11:27:32', '2022-06-06 11:27:32'),
(343, 56, 0x323430313a343930303a316333313a37, '2022-06-08 12:21:35', NULL, NULL, '2022-06-08 12:21:35', '2022-06-08 12:21:35'),
(344, 70, 0x323430313a343930303a313638343a62, '2022-06-08 12:26:50', NULL, NULL, '2022-06-08 12:26:50', '2022-06-08 12:26:50'),
(345, 74, 0x34392e3230372e3231302e323233, '2022-06-08 16:36:16', NULL, NULL, '2022-06-08 16:36:16', '2022-06-08 16:36:16'),
(346, 73, 0x323430353a3230313a343033353a3330, '2022-06-08 17:04:13', NULL, NULL, '2022-06-08 17:04:13', '2022-06-08 17:04:13'),
(347, 72, 0x323430353a3230313a343031383a3938, '2022-06-10 00:20:59', NULL, NULL, '2022-06-10 00:20:59', '2022-06-10 00:20:59'),
(348, 69, 0x323430313a343930303a316333313a39, '2022-06-11 22:10:18', '2022-06-11 22:37:44', '0:27', '2022-06-11 22:10:18', '2022-06-11 22:37:44'),
(349, 68, 0x323430353a3230313a643031303a6630, '2022-06-22 09:49:14', NULL, NULL, '2022-06-22 09:49:14', '2022-06-22 09:49:14'),
(350, 63, 0x323430393a343035363a6531363a6336, '2022-06-22 09:53:31', '2022-06-22 14:57:07', '5:3', '2022-06-22 09:53:31', '2022-06-22 14:57:07'),
(351, 64, 0x323430393a343035363a6531363a6336, '2022-06-22 14:58:38', '2022-06-22 15:14:14', '0:15', '2022-06-22 14:58:38', '2022-06-22 15:14:14'),
(352, 63, 0x323430313a343930303a316336363a36, '2022-06-23 11:42:44', '2022-06-23 11:50:41', '0:7', '2022-06-23 11:42:44', '2022-06-23 11:50:41'),
(353, 56, 0x323430313a343930303a316336363a36, '2022-06-23 11:45:36', '2022-06-23 11:49:59', '0:4', '2022-06-23 11:45:36', '2022-06-23 11:49:59'),
(354, 73, 0x323430353a3230313a343033353a3330, '2022-06-23 12:00:31', NULL, NULL, '2022-06-23 12:00:31', '2022-06-23 12:00:31'),
(355, 62, 0x323430353a3230313a32303a36313431, '2022-06-23 12:06:41', NULL, NULL, '2022-06-23 12:06:41', '2022-06-23 12:06:41'),
(356, 75, 0x323430313a343930303a316336333a33, '2022-06-23 13:09:13', NULL, NULL, '2022-06-23 13:09:13', '2022-06-23 13:09:13'),
(357, 71, 0x323430323a653238303a336532323a33, '2022-06-23 14:56:07', NULL, NULL, '2022-06-23 14:56:07', '2022-06-23 14:56:07'),
(358, 74, 0x34392e3230372e3232352e3532, '2022-06-24 09:46:47', NULL, NULL, '2022-06-24 09:46:47', '2022-06-24 09:46:47'),
(359, 56, 0x323430313a343930303a316336363a36, '2022-06-24 13:18:54', NULL, NULL, '2022-06-24 13:18:54', '2022-06-24 13:18:54'),
(360, 72, 0x323430353a3230313a343031383a3938, '2022-06-26 02:31:16', NULL, NULL, '2022-06-26 02:31:16', '2022-06-26 02:31:16'),
(361, 62, 0x323430353a3230313a32303a36313431, '2022-06-28 19:18:53', NULL, NULL, '2022-06-28 19:18:53', '2022-06-28 19:18:53'),
(362, 71, 0x323430323a653238303a336532323a33, '2022-06-29 15:50:53', NULL, NULL, '2022-06-29 15:50:53', '2022-06-29 15:50:53'),
(363, 56, 0x323430313a343930303a316336363a36, '2022-06-29 15:52:14', '2022-06-29 15:58:21', '0:6', '2022-06-29 15:52:14', '2022-06-29 15:58:21'),
(364, 70, 0x323430313a343930303a316332623a61, '2022-06-29 15:52:58', NULL, NULL, '2022-06-29 15:52:58', '2022-06-29 15:52:58'),
(365, 66, 0x34352e3131392e33312e3838, '2022-06-29 16:28:05', NULL, NULL, '2022-06-29 16:28:05', '2022-06-29 16:28:05'),
(366, 74, 0x34392e3230372e3230382e3731, '2022-06-30 06:17:20', NULL, NULL, '2022-06-30 06:17:20', '2022-06-30 06:17:20'),
(367, 72, 0x323430353a3230313a343031383a3938, '2022-06-30 14:43:19', NULL, NULL, '2022-06-30 14:43:19', '2022-06-30 14:43:19'),
(368, 64, 0x3132322e3137372e3130312e313639, '2022-07-01 08:54:58', NULL, NULL, '2022-07-01 08:54:58', '2022-07-01 08:54:58'),
(369, 66, 0x3130332e3230382e36382e3438, '2022-07-01 10:16:56', NULL, NULL, '2022-07-01 10:16:56', '2022-07-01 10:16:56'),
(370, 67, 0x323430353a3230313a343032353a3538, '2022-07-01 10:54:33', NULL, NULL, '2022-07-01 10:54:33', '2022-07-01 10:54:33'),
(371, 67, 0x323430353a3230313a343032353a3538, '2022-07-03 22:48:50', NULL, NULL, '2022-07-03 22:48:50', '2022-07-03 22:48:50'),
(372, 66, 0x3130332e3230382e36382e3238, '2022-07-04 09:52:59', NULL, NULL, '2022-07-04 09:52:59', '2022-07-04 09:52:59'),
(373, 67, 0x323430353a3230313a343032353a3538, '2022-07-04 09:53:22', '2022-07-04 11:13:07', '1:19', '2022-07-04 09:53:22', '2022-07-04 11:13:07'),
(374, 73, 0x323430353a3230313a343033353a3330, '2022-07-04 13:33:16', NULL, NULL, '2022-07-04 13:33:16', '2022-07-04 13:33:16'),
(375, 71, 0x323430323a653238303a336532323a33, '2022-07-06 14:03:36', NULL, NULL, '2022-07-06 14:03:36', '2022-07-06 14:03:36'),
(376, 56, 0x323430313a343930303a316336383a65, '2022-07-27 18:30:15', NULL, NULL, '2022-07-27 18:30:15', '2022-07-27 18:30:15'),
(377, 68, 0x323430353a3230313a643031303a6630, '2022-07-28 11:16:08', NULL, NULL, '2022-07-28 11:16:08', '2022-07-28 11:16:08'),
(378, 68, 0x323430353a3230313a643031303a6630, '2022-07-29 21:51:55', NULL, NULL, '2022-07-29 21:51:55', '2022-07-29 21:51:55'),
(379, 75, 0x323430313a343930303a316336353a38, '2022-08-01 15:07:42', NULL, NULL, '2022-08-01 15:07:42', '2022-08-01 15:07:42'),
(380, 73, 0x323430353a3230313a343033353a3330, '2022-08-02 10:15:35', NULL, NULL, '2022-08-02 10:15:35', '2022-08-02 10:15:35'),
(381, 71, 0x323430323a653238303a336532323a33, '2022-08-03 12:06:42', NULL, NULL, '2022-08-03 12:06:42', '2022-08-03 12:06:42'),
(382, 56, 0x34352e3131352e3137392e323030, '2022-08-04 14:04:06', '2022-08-04 14:13:08', '0:9', '2022-08-04 14:04:06', '2022-08-04 14:13:08'),
(383, 67, 0x323430353a3230313a343032353a3538, '2022-08-04 14:59:16', NULL, NULL, '2022-08-04 14:59:16', '2022-08-04 14:59:16'),
(384, 66, 0x3130332e3230382e36382e313036, '2022-08-05 15:25:26', NULL, NULL, '2022-08-05 15:25:26', '2022-08-05 15:25:26'),
(385, 69, 0x323430313a343930303a316336363a34, '2022-08-07 13:55:10', '2022-08-07 21:40:21', '7:45', '2022-08-07 13:55:10', '2022-08-07 21:40:21'),
(386, 56, 0x34352e3131352e3137392e323030, '2022-08-08 13:53:04', NULL, NULL, '2022-08-08 13:53:04', '2022-08-08 13:53:04'),
(387, 66, 0x3130332e3230382e36382e3436, '2022-08-09 09:24:26', NULL, NULL, '2022-08-09 09:24:26', '2022-08-09 09:24:26'),
(388, 70, 0x34352e3131352e3137392e323030, '2022-08-12 15:54:39', NULL, NULL, '2022-08-12 15:54:39', '2022-08-12 15:54:39'),
(389, 70, 0x34352e3131352e3137392e323030, '2022-08-16 09:08:08', NULL, NULL, '2022-08-16 09:08:08', '2022-08-16 09:08:08'),
(390, 56, 0x323430313a343930303a316336383a65, '2022-08-16 11:28:41', '2022-08-16 11:29:46', '0:1', '2022-08-16 11:28:41', '2022-08-16 11:29:46'),
(391, 71, 0x323430323a653238303a336532323a33, '2022-08-16 17:29:26', NULL, NULL, '2022-08-16 17:29:26', '2022-08-16 17:29:26'),
(392, 72, 0x323430353a3230313a343031383a3938, '2022-08-16 17:41:59', NULL, NULL, '2022-08-16 17:41:59', '2022-08-16 17:41:59'),
(393, 71, 0x323430323a653238303a336532323a33, '2022-08-17 10:43:59', NULL, NULL, '2022-08-17 10:43:59', '2022-08-17 10:43:59'),
(394, 66, 0x3130332e3230382e36382e3631, '2022-08-17 13:27:10', NULL, NULL, '2022-08-17 13:27:10', '2022-08-17 13:27:10'),
(395, 73, 0x323430353a3230313a343033353a3330, '2022-08-21 19:30:36', NULL, NULL, '2022-08-21 19:30:36', '2022-08-21 19:30:36'),
(396, 56, 0x323430313a343930303a316336383a65, '2022-08-24 12:10:21', NULL, NULL, '2022-08-24 12:10:21', '2022-08-24 12:10:21'),
(397, 70, 0x34352e3131352e3137392e323030, '2022-08-24 12:20:52', NULL, NULL, '2022-08-24 12:20:52', '2022-08-24 12:20:52'),
(398, 77, 0x34392e3230372e3139392e3530, '2022-08-24 12:29:54', NULL, NULL, '2022-08-24 12:29:54', '2022-08-24 12:29:54'),
(399, 77, 0x34392e3230372e3232352e313639, '2022-08-25 13:15:18', NULL, NULL, '2022-08-25 13:15:18', '2022-08-25 13:15:18'),
(400, 69, 0x323430313a343930303a316336363a34, '2022-08-26 08:15:59', NULL, NULL, '2022-08-26 08:15:59', '2022-08-26 08:15:59'),
(401, 68, 0x3130332e322e3233352e323534, '2022-08-29 06:51:14', NULL, NULL, '2022-08-29 06:51:14', '2022-08-29 06:51:14'),
(402, 74, 0x323430323a336138303a6135363a3934, '2022-08-29 09:23:30', NULL, NULL, '2022-08-29 09:23:30', '2022-08-29 09:23:30');
INSERT INTO `userlogs` (`id`, `userid`, `userip`, `logintime`, `logouttime`, `totaltime`, `created_at`, `updated_at`) VALUES
(403, 67, 0x323430353a3230313a343032353a3538, '2022-08-29 09:49:42', NULL, NULL, '2022-08-29 09:49:42', '2022-08-29 09:49:42'),
(404, 73, 0x34352e3131352e3137392e323030, '2022-08-29 10:45:14', NULL, NULL, '2022-08-29 10:45:14', '2022-08-29 10:45:14'),
(405, 75, 0x34352e3131352e3137392e323030, '2022-08-29 12:28:39', NULL, NULL, '2022-08-29 12:28:39', '2022-08-29 12:28:39'),
(406, 74, 0x34392e3230372e3139322e313834, '2022-08-30 10:06:13', NULL, NULL, '2022-08-30 10:06:13', '2022-08-30 10:06:13'),
(407, 71, 0x323430323a653238303a336532323a33, '2022-08-31 08:53:54', NULL, NULL, '2022-08-31 08:53:54', '2022-08-31 08:53:54'),
(408, 77, 0x34392e3230372e3230312e313930, '2022-09-01 09:02:37', NULL, NULL, '2022-09-01 09:02:37', '2022-09-01 09:02:37'),
(409, 56, 0x323430313a343930303a316336383a65, '2022-09-01 11:00:42', NULL, NULL, '2022-09-01 11:00:42', '2022-09-01 11:00:42'),
(410, 62, 0x323430353a3230313a32303a36313431, '2022-09-06 18:02:55', NULL, NULL, '2022-09-06 18:02:55', '2022-09-06 18:02:55'),
(411, 62, 0x323430353a3230313a32303a36313431, '2022-09-07 12:50:16', NULL, NULL, '2022-09-07 12:50:16', '2022-09-07 12:50:16'),
(412, 62, 0x323430353a3230313a32303a36313431, '2022-09-12 09:26:46', NULL, NULL, '2022-09-12 09:26:46', '2022-09-12 09:26:46'),
(413, 70, 0x34352e3131352e3137392e323030, '2022-09-16 10:34:31', NULL, NULL, '2022-09-16 10:34:31', '2022-09-16 10:34:31'),
(414, 75, 0x34352e3131352e3137392e323030, '2022-09-28 16:03:36', NULL, NULL, '2022-09-28 16:03:36', '2022-09-28 16:03:36'),
(415, 74, 0x323430393a343036323a346538613a31, '2022-10-03 09:27:23', NULL, NULL, '2022-10-03 09:27:23', '2022-10-03 09:27:23'),
(416, 73, 0x34352e3131352e3137392e323030, '2022-10-04 11:41:07', NULL, NULL, '2022-10-04 11:41:07', '2022-10-04 11:41:07'),
(417, 67, 0x323430353a3230313a343032353a3538, '2022-10-04 15:25:16', NULL, NULL, '2022-10-04 15:25:16', '2022-10-04 15:25:16'),
(418, 75, 0x34352e3131352e3137392e323030, '2022-10-10 13:53:12', NULL, NULL, '2022-10-10 13:53:12', '2022-10-10 13:53:12'),
(419, 56, 0x323430313a343930303a316336363a32, '2022-10-11 18:26:52', NULL, NULL, '2022-10-11 18:26:52', '2022-10-11 18:26:52'),
(420, 62, 0x323430353a3230313a32303a36313431, '2022-10-12 11:39:09', NULL, NULL, '2022-10-12 11:39:09', '2022-10-12 11:39:09'),
(421, 68, 0x323430353a3230313a643031303a6630, '2022-10-17 11:20:00', NULL, NULL, '2022-10-17 11:20:00', '2022-10-17 11:20:00'),
(422, 75, 0x34352e3131352e3137392e323030, '2022-10-19 10:21:54', NULL, NULL, '2022-10-19 10:21:54', '2022-10-19 10:21:54'),
(423, 77, 0x34392e3230372e3139322e3539, '2022-10-19 10:52:17', NULL, NULL, '2022-10-19 10:52:17', '2022-10-19 10:52:17'),
(424, 70, 0x3132322e3136312e38362e3935, '2022-10-19 12:33:37', NULL, NULL, '2022-10-19 12:33:37', '2022-10-19 12:33:37'),
(425, 75, 0x323430313a343930303a316336343a36, '2022-10-20 13:50:16', NULL, NULL, '2022-10-20 13:50:16', '2022-10-20 13:50:16'),
(426, 70, 0x34352e3131352e3137392e323030, '2022-10-21 09:27:50', NULL, NULL, '2022-10-21 09:27:50', '2022-10-21 09:27:50'),
(427, 62, 0x323430353a3230313a32303a36313431, '2022-10-21 14:48:09', NULL, NULL, '2022-10-21 14:48:09', '2022-10-21 14:48:09'),
(428, 68, 0x323430353a3230313a643031303a6630, '2022-10-25 11:44:21', NULL, NULL, '2022-10-25 11:44:21', '2022-10-25 11:44:21'),
(429, 71, 0x323430393a343037313a323338643a32, '2022-10-25 11:51:10', NULL, NULL, '2022-10-25 11:51:10', '2022-10-25 11:51:10'),
(430, 75, 0x323430393a343036343a3839653a3934, '2022-10-25 12:32:42', NULL, NULL, '2022-10-25 12:32:42', '2022-10-25 12:32:42'),
(431, 64, 0x323430353a3230313a343030373a3661, '2022-10-26 09:32:07', NULL, NULL, '2022-10-26 09:32:07', '2022-10-26 09:32:07'),
(432, 74, 0x323430353a3230313a613030383a6431, '2022-10-27 20:10:47', NULL, NULL, '2022-10-27 20:10:47', '2022-10-27 20:10:47'),
(433, 66, 0x34352e3131392e33312e3437, '2022-11-04 14:10:57', NULL, NULL, '2022-11-04 14:10:57', '2022-11-04 14:10:57'),
(434, 77, 0x34392e3230372e3139322e3539, '2022-11-04 15:33:12', NULL, NULL, '2022-11-04 15:33:12', '2022-11-04 15:33:12'),
(435, 75, 0x323430393a343036343a326238313a35, '2022-11-07 11:53:53', NULL, NULL, '2022-11-07 11:53:53', '2022-11-07 11:53:53'),
(436, 70, 0x34352e3131352e3137392e323030, '2022-11-17 16:25:29', NULL, NULL, '2022-11-17 16:25:29', '2022-11-17 16:25:29'),
(437, 75, 0x34352e3131352e3137392e323030, '2022-11-17 16:25:33', '2022-11-17 16:27:23', '0:1', '2022-11-17 16:25:33', '2022-11-17 16:27:23'),
(438, 77, 0x34392e3230372e3139322e3539, '2022-11-18 15:08:44', NULL, NULL, '2022-11-18 15:08:44', '2022-11-18 15:08:44'),
(439, 77, 0x34392e3230372e3139322e3539, '2022-11-23 10:02:13', NULL, NULL, '2022-11-23 10:02:13', '2022-11-23 10:02:13'),
(440, 68, 0x323430353a3230313a643031303a6630, '2022-11-24 16:55:33', NULL, NULL, '2022-11-24 16:55:33', '2022-11-24 16:55:33'),
(441, 74, 0x3130332e3136352e3136392e3830, '2022-12-07 13:22:11', NULL, NULL, '2022-12-07 13:22:11', '2022-12-07 13:22:11'),
(442, 73, 0x34352e3131352e3137392e323030, '2022-12-13 14:20:54', NULL, NULL, '2022-12-13 14:20:54', '2022-12-13 14:20:54'),
(443, 75, 0x34352e3131352e3137392e323030, '2022-12-14 14:30:06', NULL, NULL, '2022-12-14 14:30:06', '2022-12-14 14:30:06'),
(444, 62, 0x323430353a3230313a32303a36313262, '2022-12-15 12:50:25', NULL, NULL, '2022-12-15 12:50:25', '2022-12-15 12:50:25'),
(445, 70, 0x34352e3131352e3137392e323030, '2022-12-15 16:57:22', NULL, NULL, '2022-12-15 16:57:22', '2022-12-15 16:57:22'),
(446, 77, 0x34392e3230372e3233302e3334, '2022-12-16 11:17:35', NULL, NULL, '2022-12-16 11:17:35', '2022-12-16 11:17:35'),
(447, 77, 0x34392e3230372e3230352e3530, '2022-12-19 18:33:33', NULL, NULL, '2022-12-19 18:33:33', '2022-12-19 18:33:33'),
(448, 75, 0x34352e3131352e3137392e323030, '2022-12-28 13:10:54', NULL, NULL, '2022-12-28 13:10:54', '2022-12-28 13:10:54'),
(449, 67, 0x323430353a3230313a343032353a3562, '2022-12-30 18:01:38', NULL, NULL, '2022-12-30 18:01:38', '2022-12-30 18:01:38'),
(450, 67, 0x323430353a3230313a343032353a3562, '2023-01-02 11:03:09', NULL, NULL, '2023-01-02 11:03:09', '2023-01-02 11:03:09'),
(451, 77, 0x34392e3230372e3230302e3138, '2023-01-05 12:27:35', NULL, NULL, '2023-01-05 12:27:35', '2023-01-05 12:27:35'),
(452, 70, 0x323430313a343930303a316336373a66, '2023-01-10 20:02:33', NULL, NULL, '2023-01-10 20:02:33', '2023-01-10 20:02:33'),
(453, 62, 0x323430353a3230313a32303a36313262, '2023-01-11 22:10:12', NULL, NULL, '2023-01-11 22:10:12', '2023-01-11 22:10:12'),
(454, 74, 0x3130332e3136352e3136392e3531, '2023-01-12 14:47:01', NULL, NULL, '2023-01-12 14:47:01', '2023-01-12 14:47:01'),
(455, 62, 0x323430353a3230313a32303a36313262, '2023-01-17 18:39:54', NULL, NULL, '2023-01-17 18:39:54', '2023-01-17 18:39:54'),
(456, 68, 0x323430353a3230313a643031303a6630, '2023-01-18 08:52:00', NULL, NULL, '2023-01-18 08:52:00', '2023-01-18 08:52:00'),
(457, 64, 0x323430353a3230313a343030373a3630, '2023-01-25 18:21:48', NULL, NULL, '2023-01-25 18:21:48', '2023-01-25 18:21:48'),
(458, 77, 0x34392e3230372e3230372e313731, '2023-01-27 09:59:32', NULL, NULL, '2023-01-27 09:59:32', '2023-01-27 09:59:32'),
(459, 77, 0x34392e3230372e3232322e313037, '2023-02-09 10:55:17', NULL, NULL, '2023-02-09 10:55:17', '2023-02-09 10:55:17'),
(460, 70, 0x34352e3131352e3137392e323034, '2023-02-10 17:28:27', NULL, NULL, '2023-02-10 17:28:27', '2023-02-10 17:28:27'),
(461, 77, 0x34392e3230372e3232322e313037, '2023-02-13 18:52:57', NULL, NULL, '2023-02-13 18:52:57', '2023-02-13 18:52:57'),
(462, 77, 0x34392e3230372e3232322e313037, '2023-02-14 10:15:34', NULL, NULL, '2023-02-14 10:15:34', '2023-02-14 10:15:34'),
(463, 70, 0x34352e3131352e3137392e323034, '2023-02-16 17:11:41', NULL, NULL, '2023-02-16 17:11:41', '2023-02-16 17:11:41'),
(464, 72, 0x323430353a3230313a343031383a3933, '2023-02-16 18:34:37', NULL, NULL, '2023-02-16 18:34:37', '2023-02-16 18:34:37'),
(465, 77, 0x34392e3230372e3139372e3930, '2023-02-20 16:33:38', NULL, NULL, '2023-02-20 16:33:38', '2023-02-20 16:33:38'),
(466, 74, 0x3130332e3136352e3136392e3437, '2023-02-23 18:12:33', NULL, NULL, '2023-02-23 18:12:33', '2023-02-23 18:12:33'),
(467, 77, 0x34392e3230372e3139372e3930, '2023-02-27 18:28:40', NULL, NULL, '2023-02-27 18:28:40', '2023-02-27 18:28:40'),
(468, 74, 0x3130332e3136352e3136392e3437, '2023-03-02 10:27:27', NULL, NULL, '2023-03-02 10:27:27', '2023-03-02 10:27:27'),
(469, 77, 0x34392e3230372e3139372e3930, '2023-03-03 11:18:11', NULL, NULL, '2023-03-03 11:18:11', '2023-03-03 11:18:11'),
(470, 74, 0x3130332e3136352e3136392e3437, '2023-03-06 09:47:11', NULL, NULL, '2023-03-06 09:47:11', '2023-03-06 09:47:11'),
(471, 56, 0x34352e3131352e3137392e323034, '2023-03-06 13:32:52', NULL, NULL, '2023-03-06 13:32:52', '2023-03-06 13:32:52'),
(472, 70, 0x34352e3131352e3137392e323034, '2023-03-06 13:57:19', NULL, NULL, '2023-03-06 13:57:19', '2023-03-06 13:57:19'),
(473, 77, 0x34392e3230372e3139372e3930, '2023-03-06 14:01:28', NULL, NULL, '2023-03-06 14:01:28', '2023-03-06 14:01:28'),
(474, 78, 0x323430313a343930303a316632393a32, '2023-03-06 14:03:30', NULL, NULL, '2023-03-06 14:03:30', '2023-03-06 14:03:30'),
(475, 63, 0x34352e3131352e3137392e323034, '2023-03-06 15:46:13', '2023-03-06 15:46:33', '0:0', '2023-03-06 15:46:13', '2023-03-06 15:46:33'),
(476, 63, 0x34352e3131352e3137392e323034, '2023-03-07 12:52:58', '2023-03-07 14:52:18', '1:59', '2023-03-07 12:52:58', '2023-03-07 14:52:18'),
(477, 70, 0x34352e3131352e3137392e323034, '2023-03-07 13:17:11', '2023-03-07 15:49:32', '2:32', '2023-03-07 13:17:11', '2023-03-07 15:49:32'),
(478, 56, 0x34352e3131352e3137392e323034, '2023-03-07 14:46:49', '2023-03-07 14:49:48', '0:2', '2023-03-07 14:46:49', '2023-03-07 14:49:48'),
(479, 72, 0x323430353a3230313a343031383a3933, '2023-03-08 20:53:01', NULL, NULL, '2023-03-08 20:53:01', '2023-03-08 20:53:01'),
(480, 72, 0x323430353a3230313a343031383a3933, '2023-03-10 11:41:55', NULL, NULL, '2023-03-10 11:41:55', '2023-03-10 11:41:55'),
(481, 70, 0x34352e3131352e3137392e323034, '2023-03-10 15:36:38', NULL, NULL, '2023-03-10 15:36:38', '2023-03-10 15:36:38'),
(482, 72, 0x323430353a3230313a343031383a3933, '2023-03-13 14:51:28', NULL, NULL, '2023-03-13 14:51:28', '2023-03-13 14:51:28'),
(483, 70, 0x34352e3131352e3137392e323034, '2023-03-13 15:09:36', NULL, NULL, '2023-03-13 15:09:36', '2023-03-13 15:09:36'),
(484, 63, 0x323430353a3230313a343031383a3933, '2023-03-13 18:39:27', '2023-03-13 18:41:59', '0:2', '2023-03-13 18:39:27', '2023-03-13 18:41:59'),
(485, 72, 0x323430353a3230313a343031383a3933, '2023-03-14 14:04:00', NULL, NULL, '2023-03-14 14:04:00', '2023-03-14 14:04:00'),
(486, 56, 0x34352e3131352e3137392e323034, '2023-03-14 14:05:28', '2023-03-14 14:08:59', '0:3', '2023-03-14 14:05:28', '2023-03-14 14:08:59'),
(487, 63, 0x34352e3131352e3137392e323034, '2023-03-14 14:09:13', '2023-03-14 14:17:59', '0:8', '2023-03-14 14:09:13', '2023-03-14 14:17:59'),
(488, 70, 0x34352e3131352e3137392e323034, '2023-03-14 14:16:43', NULL, NULL, '2023-03-14 14:16:43', '2023-03-14 14:16:43'),
(489, 66, 0x34352e3131392e33312e313033, '2023-03-15 09:26:44', '2023-03-15 10:17:12', '0:50', '2023-03-15 09:26:44', '2023-03-15 10:17:12'),
(490, 70, 0x34352e3131352e3137392e323034, '2023-03-15 10:44:35', NULL, NULL, '2023-03-15 10:44:35', '2023-03-15 10:44:35'),
(491, 74, 0x3130332e3136352e3136392e3333, '2023-03-15 12:36:43', NULL, NULL, '2023-03-15 12:36:43', '2023-03-15 12:36:43'),
(492, 70, 0x34352e3131352e3137392e323034, '2023-03-16 11:58:44', NULL, NULL, '2023-03-16 11:58:44', '2023-03-16 11:58:44'),
(493, 56, 0x34352e3131352e3137392e323034, '2023-03-16 13:03:17', NULL, NULL, '2023-03-16 13:03:17', '2023-03-16 13:03:17'),
(494, 72, 0x323430353a3230313a343031383a3933, '2023-03-16 13:52:12', NULL, NULL, '2023-03-16 13:52:12', '2023-03-16 13:52:12'),
(495, 62, 0x3135382e3233302e3130302e313032, '2023-03-16 16:19:37', NULL, NULL, '2023-03-16 16:19:37', '2023-03-16 16:19:37'),
(496, 56, 0x34352e3131352e3137392e323034, '2023-03-17 14:54:28', '2023-03-17 15:09:47', '0:15', '2023-03-17 14:54:28', '2023-03-17 15:09:47'),
(497, 63, 0x34352e3131352e3137392e323034, '2023-03-17 15:03:52', '2023-03-17 15:05:24', '0:1', '2023-03-17 15:03:52', '2023-03-17 15:05:24'),
(498, 72, 0x323430353a3230313a343031383a3933, '2023-03-17 17:42:52', NULL, NULL, '2023-03-17 17:42:52', '2023-03-17 17:42:52'),
(499, 72, 0x323430353a3230313a343031383a3933, '2023-03-18 16:09:50', NULL, NULL, '2023-03-18 16:09:50', '2023-03-18 16:09:50'),
(500, 77, 0x34392e3230372e3231372e323432, '2023-03-22 10:18:08', NULL, NULL, '2023-03-22 10:18:08', '2023-03-22 10:18:08'),
(501, 72, 0x323430353a3230313a343031383a3933, '2023-03-22 10:18:24', NULL, NULL, '2023-03-22 10:18:24', '2023-03-22 10:18:24'),
(502, 72, 0x323430353a3230313a343031383a3933, '2023-03-23 22:34:36', NULL, NULL, '2023-03-23 22:34:36', '2023-03-23 22:34:36'),
(503, 77, 0x34392e3230372e3231372e323432, '2023-03-24 08:28:57', NULL, NULL, '2023-03-24 08:28:57', '2023-03-24 08:28:57'),
(504, 72, 0x323430353a3230313a343031383a3933, '2023-03-26 23:37:11', NULL, NULL, '2023-03-26 23:37:11', '2023-03-26 23:37:11'),
(505, 62, 0x323430353a3230313a32303a36313262, '2023-03-28 09:27:18', NULL, NULL, '2023-03-28 09:27:18', '2023-03-28 09:27:18'),
(506, 70, 0x34352e3131352e3137392e323034, '2023-03-28 09:48:18', '2023-03-28 09:49:24', '0:1', '2023-03-28 09:48:18', '2023-03-28 09:49:24'),
(507, 72, 0x323430353a3230313a343031383a3933, '2023-03-28 12:23:08', NULL, NULL, '2023-03-28 12:23:08', '2023-03-28 12:23:08'),
(508, 56, 0x34352e3131352e3137392e323034, '2023-03-28 14:18:49', '2023-03-28 14:28:30', '0:9', '2023-03-28 14:18:49', '2023-03-28 14:28:30'),
(509, 63, 0x34352e3131352e3137392e323034, '2023-03-28 14:23:24', '2023-03-28 14:31:30', '0:8', '2023-03-28 14:23:24', '2023-03-28 14:31:30'),
(510, 70, 0x34352e3131352e3137392e323034, '2023-03-29 09:30:23', NULL, NULL, '2023-03-29 09:30:23', '2023-03-29 09:30:23'),
(511, 72, 0x323430353a3230313a343031383a3933, '2023-03-30 11:05:00', NULL, NULL, '2023-03-30 11:05:00', '2023-03-30 11:05:00'),
(512, 72, 0x34352e3131352e3137392e323034, '2023-03-31 14:37:28', NULL, NULL, '2023-03-31 14:37:28', '2023-03-31 14:37:28'),
(513, 56, 0x34352e3131352e3137392e323034, '2023-04-04 12:45:15', NULL, NULL, '2023-04-04 12:45:15', '2023-04-04 12:45:15'),
(514, 79, 0x3132322e3137332e32342e313439, '2023-04-04 15:53:57', NULL, NULL, '2023-04-04 15:53:57', '2023-04-04 15:53:57'),
(515, 77, 0x34392e3230372e3233352e313035, '2023-04-04 17:24:29', NULL, NULL, '2023-04-04 17:24:29', '2023-04-04 17:24:29'),
(516, 70, 0x34352e3131352e3137392e323034, '2023-04-05 12:25:16', NULL, NULL, '2023-04-05 12:25:16', '2023-04-05 12:25:16'),
(517, 56, 0x34352e3131352e3137392e323034, '2023-04-05 14:08:34', NULL, NULL, '2023-04-05 14:08:34', '2023-04-05 14:08:34'),
(518, 72, 0x323430353a3230313a343031383a3933, '2023-04-07 11:21:54', '2023-04-07 20:32:36', '9:10', '2023-04-07 11:21:54', '2023-04-07 20:32:36'),
(519, 56, 0x34352e3131352e3137392e323034, '2023-04-07 12:21:23', '2023-04-07 12:23:00', '0:1', '2023-04-07 12:21:23', '2023-04-07 12:23:00'),
(520, 63, 0x34352e3131352e3137392e323034, '2023-04-07 12:23:11', '2023-04-07 12:24:20', '0:1', '2023-04-07 12:23:11', '2023-04-07 12:24:20'),
(521, 70, 0x34352e3131352e3137392e323034, '2023-04-07 13:11:15', '2023-04-07 13:15:21', '0:4', '2023-04-07 13:11:15', '2023-04-07 13:15:21'),
(522, 66, 0x34352e3131392e33312e3132, '2023-04-07 16:21:42', NULL, NULL, '2023-04-07 16:21:42', '2023-04-07 16:21:42'),
(523, 72, 0x323430353a3230313a343031383a3933, '2023-04-09 12:43:12', NULL, NULL, '2023-04-09 12:43:12', '2023-04-09 12:43:12'),
(524, 70, 0x34352e3131352e3137392e323034, '2023-04-10 09:34:28', NULL, NULL, '2023-04-10 09:34:28', '2023-04-10 09:34:28'),
(525, 56, 0x34352e3131352e3137392e323034, '2023-04-10 13:54:59', NULL, NULL, '2023-04-10 13:54:59', '2023-04-10 13:54:59'),
(526, 70, 0x323430313a343930303a316335323a66, '2023-04-11 11:28:28', NULL, NULL, '2023-04-11 11:28:28', '2023-04-11 11:28:28'),
(527, 72, 0x323430353a3230313a343031383a3933, '2023-04-11 11:48:29', '2023-04-11 12:46:43', '0:58', '2023-04-11 11:48:29', '2023-04-11 12:46:43'),
(528, 56, 0x34352e3131352e3137392e323034, '2023-04-11 14:11:48', '2023-04-11 14:12:11', '0:0', '2023-04-11 14:11:48', '2023-04-11 14:12:11'),
(529, 70, 0x34352e3131352e3137392e323034, '2023-04-12 10:47:56', NULL, NULL, '2023-04-12 10:47:56', '2023-04-12 10:47:56'),
(530, 72, 0x323430353a3230313a343031383a3933, '2023-04-12 14:45:11', NULL, NULL, '2023-04-12 14:45:11', '2023-04-12 14:45:11'),
(531, 56, 0x34352e3131352e3137392e323034, '2023-04-12 15:19:21', NULL, NULL, '2023-04-12 15:19:21', '2023-04-12 15:19:21'),
(532, 70, 0x34352e3131352e3137392e323034, '2023-04-13 12:56:54', NULL, NULL, '2023-04-13 12:56:54', '2023-04-13 12:56:54'),
(533, 72, 0x34352e3131352e3137392e323034, '2023-04-13 14:02:11', NULL, NULL, '2023-04-13 14:02:11', '2023-04-13 14:02:11'),
(534, 72, 0x323430353a3230313a343031383a3933, '2023-04-18 13:40:16', NULL, NULL, '2023-04-18 13:40:16', '2023-04-18 13:40:16'),
(535, 70, 0x34352e3131352e3137392e323034, '2023-04-18 13:41:14', NULL, NULL, '2023-04-18 13:41:14', '2023-04-18 13:41:14'),
(536, 72, 0x323430353a3230313a343031383a3933, '2023-04-19 07:37:50', NULL, NULL, '2023-04-19 07:37:50', '2023-04-19 07:37:50'),
(537, 73, 0x34352e3131352e3137392e323034, '2023-04-19 11:14:22', NULL, NULL, '2023-04-19 11:14:22', '2023-04-19 11:14:22'),
(538, 77, 0x34392e3230372e3230372e3431, '2023-04-19 11:48:49', NULL, NULL, '2023-04-19 11:48:49', '2023-04-19 11:48:49'),
(539, 66, 0x3130332e3230382e36382e323435, '2023-04-19 12:14:07', NULL, NULL, '2023-04-19 12:14:07', '2023-04-19 12:14:07'),
(540, 69, 0x323430313a343930303a316333303a35, '2023-04-20 08:48:09', NULL, NULL, '2023-04-20 08:48:09', '2023-04-20 08:48:09'),
(541, 67, 0x323430353a3230313a343032353a3531, '2023-04-20 09:28:22', NULL, NULL, '2023-04-20 09:28:22', '2023-04-20 09:28:22'),
(542, 73, 0x34352e3131352e3137392e323034, '2023-04-20 10:58:31', NULL, NULL, '2023-04-20 10:58:31', '2023-04-20 10:58:31'),
(543, 66, 0x3130332e3230382e36382e323435, '2023-04-20 11:03:57', NULL, NULL, '2023-04-20 11:03:57', '2023-04-20 11:03:57'),
(544, 77, 0x34392e3230372e3230372e3431, '2023-04-20 12:28:41', NULL, NULL, '2023-04-20 12:28:41', '2023-04-20 12:28:41'),
(545, 56, 0x34352e3131352e3137392e323034, '2023-04-20 13:12:08', '2023-04-20 13:14:51', '0:2', '2023-04-20 13:12:08', '2023-04-20 13:14:51'),
(546, 63, 0x34352e3131352e3137392e323034, '2023-04-20 13:15:14', NULL, NULL, '2023-04-20 13:15:14', '2023-04-20 13:15:14'),
(547, 66, 0x3130332e3230382e36382e323333, '2023-04-21 10:52:58', NULL, NULL, '2023-04-21 10:52:58', '2023-04-21 10:52:58'),
(548, 72, 0x323430353a3230313a343031383a3933, '2023-04-21 11:35:31', NULL, NULL, '2023-04-21 11:35:31', '2023-04-21 11:35:31'),
(549, 56, 0x34352e3131352e3137392e323034, '2023-04-21 13:01:22', NULL, NULL, '2023-04-21 13:01:22', '2023-04-21 13:01:22'),
(550, 67, 0x323430353a3230313a343032353a3531, '2023-04-21 13:08:41', NULL, NULL, '2023-04-21 13:08:41', '2023-04-21 13:08:41'),
(551, 70, 0x323430313a343930303a316330623a36, '2023-04-21 13:12:09', NULL, NULL, '2023-04-21 13:12:09', '2023-04-21 13:12:09'),
(552, 64, 0x323430353a3230313a343030373a3638, '2023-04-21 17:06:41', NULL, NULL, '2023-04-21 17:06:41', '2023-04-21 17:06:41'),
(553, 67, 0x3138322e36392e3233352e3638, '2023-04-24 13:26:16', NULL, NULL, '2023-04-24 13:26:16', '2023-04-24 13:26:16'),
(554, 77, 0x34392e3230372e3230372e3431, '2023-04-26 15:35:13', NULL, NULL, '2023-04-26 15:35:13', '2023-04-26 15:35:13'),
(555, 67, 0x3138322e36392e3233312e323230, '2023-04-27 12:52:09', NULL, NULL, '2023-04-27 12:52:09', '2023-04-27 12:52:09'),
(556, 72, 0x323430353a3230313a343031383a3933, '2023-04-27 13:34:54', NULL, NULL, '2023-04-27 13:34:54', '2023-04-27 13:34:54'),
(557, 72, 0x323430353a3230313a343031383a3933, '2023-04-28 12:18:28', '2023-04-28 13:52:58', '1:34', '2023-04-28 12:18:28', '2023-04-28 13:52:58'),
(558, 67, 0x3138322e36392e3233352e3137, '2023-04-28 12:57:25', NULL, NULL, '2023-04-28 12:57:25', '2023-04-28 12:57:25'),
(559, 66, 0x34352e3131392e33312e313235, '2023-04-28 13:22:17', NULL, NULL, '2023-04-28 13:22:17', '2023-04-28 13:22:17'),
(560, 70, 0x34352e3131352e3137392e323034, '2023-04-28 17:09:02', NULL, NULL, '2023-04-28 17:09:02', '2023-04-28 17:09:02'),
(561, 67, 0x3138322e36392e3233352e3137, '2023-04-29 08:56:55', NULL, NULL, '2023-04-29 08:56:55', '2023-04-29 08:56:55'),
(562, 67, 0x3138322e36392e3232372e313832, '2023-04-30 13:33:12', NULL, NULL, '2023-04-30 13:33:12', '2023-04-30 13:33:12'),
(563, 56, 0x34352e3131352e3137392e323034, '2023-05-02 15:19:22', NULL, NULL, '2023-05-02 15:19:22', '2023-05-02 15:19:22'),
(564, 67, 0x3132322e3136312e35312e3736, '2023-05-02 15:57:51', NULL, NULL, '2023-05-02 15:57:51', '2023-05-02 15:57:51'),
(565, 72, 0x34392e33362e3134342e3838, '2023-05-02 20:37:59', NULL, NULL, '2023-05-02 20:37:59', '2023-05-02 20:37:59'),
(566, 56, 0x34352e3131352e3137392e323034, '2023-05-03 13:18:26', '2023-05-03 13:18:44', '0:0', '2023-05-03 13:18:26', '2023-05-03 13:18:44'),
(567, 72, 0x34392e33362e3134342e3838, '2023-05-03 14:44:54', NULL, NULL, '2023-05-03 14:44:54', '2023-05-03 14:44:54'),
(568, 77, 0x34392e3230372e3230372e3431, '2023-05-03 17:12:33', NULL, NULL, '2023-05-03 17:12:33', '2023-05-03 17:12:33'),
(569, 72, 0x34392e33362e3134342e3838, '2023-05-05 11:09:43', NULL, NULL, '2023-05-05 11:09:43', '2023-05-05 11:09:43'),
(570, 72, 0x34392e33362e3134342e3838, '2023-05-06 17:02:08', NULL, NULL, '2023-05-06 17:02:08', '2023-05-06 17:02:08'),
(571, 72, 0x34392e33362e3134342e3838, '2023-05-07 14:43:02', NULL, NULL, '2023-05-07 14:43:02', '2023-05-07 14:43:02'),
(572, 67, 0x3132322e3136312e35322e3332, '2023-05-09 08:50:49', NULL, NULL, '2023-05-09 08:50:49', '2023-05-09 08:50:49'),
(573, 72, 0x34392e33362e3134342e3838, '2023-05-09 09:45:50', NULL, NULL, '2023-05-09 09:45:50', '2023-05-09 09:45:50'),
(574, 56, 0x34352e3131352e3137392e323034, '2023-05-09 13:28:44', NULL, NULL, '2023-05-09 13:28:44', '2023-05-09 13:28:44'),
(575, 66, 0x3130332e3230382e36382e323233, '2023-05-09 15:35:17', NULL, NULL, '2023-05-09 15:35:17', '2023-05-09 15:35:17'),
(576, 72, 0x3a3a31, '2023-05-14 12:37:18', NULL, NULL, '2023-05-14 12:37:18', '2023-05-14 12:37:18'),
(577, 72, 0x3a3a31, '2023-05-14 18:46:43', NULL, NULL, '2023-05-14 18:46:43', '2023-05-14 18:46:43'),
(578, 72, 0x3a3a31, '2023-05-16 22:52:34', NULL, NULL, '2023-05-16 22:52:34', '2023-05-16 22:52:34'),
(579, 72, 0x3a3a31, '2023-05-17 19:40:34', NULL, NULL, '2023-05-17 19:40:34', '2023-05-17 19:40:34'),
(580, 72, 0x3a3a31, '2023-05-24 21:48:26', '2023-05-24 22:33:59', '0:45', '2023-05-24 21:48:26', '2023-05-24 22:33:59'),
(581, 73, 0x3a3a31, '2023-05-24 22:30:06', '2023-05-24 22:49:18', '0:19', '2023-05-24 22:30:06', '2023-05-24 22:49:18'),
(582, 72, 0x3a3a31, '2023-05-25 20:32:21', NULL, NULL, '2023-05-25 20:32:21', '2023-05-25 20:32:21'),
(583, 73, 0x3a3a31, '2023-05-25 23:51:13', NULL, NULL, '2023-05-25 23:51:13', '2023-05-25 23:51:13'),
(584, 72, 0x3132372e302e302e31, '2023-05-31 10:17:51', NULL, NULL, '2023-05-31 10:17:51', '2023-05-31 10:17:51'),
(585, 73, 0x3a3a31, '2023-05-31 12:09:47', NULL, NULL, '2023-05-31 12:09:47', '2023-05-31 12:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(20) DEFAULT NULL,
  `leaves_count` bigint(20) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `salary` bigint(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `relieve_date` date DEFAULT NULL,
  `job_type` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `manager` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `tenure` varchar(50) DEFAULT NULL,
  `reason_exit` tinytext DEFAULT NULL,
  `last_working` date DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `spous_name` varchar(50) DEFAULT NULL,
  `mrtl_status` varchar(20) DEFAULT NULL,
  `email_personal` varchar(20) DEFAULT NULL,
  `emr_contact_name` varchar(50) DEFAULT NULL,
  `emr_contact_no` varchar(20) DEFAULT NULL,
  `rel_emr_contact` varchar(50) DEFAULT NULL,
  `exp_bfjoin` varchar(50) DEFAULT NULL,
  `pre_org` varchar(50) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `leaves_count`, `username`, `image`, `first_name`, `last_name`, `role`, `salary`, `email`, `password`, `status`, `phone`, `address`, `gender`, `dob`, `join_date`, `relieve_date`, `job_type`, `city`, `age`, `designation`, `manager`, `department`, `tenure`, `reason_exit`, `last_working`, `father_name`, `blood_group`, `spous_name`, `mrtl_status`, `email_personal`, `emr_contact_name`, `emr_contact_no`, `rel_emr_contact`, `exp_bfjoin`, `pre_org`, `current_address`, `skills`, `remember_token`, `created_at`, `updated_at`) VALUES
(56, 'TT00001', NULL, 'yogeshraheja', '1600338108.jpg', 'Yogesh', 'Raheja', 'admin', NULL, 'yogesh.raheja@thinknyx.com', '$2y$10$hn0NBaf3LmshmVRTgFBxsuyZ1ljWSDtsWIvVFkpf6LKJK/MQ6ArYW', 1, 9810344919, NULL, 'Male', '1985-05-07', '2016-10-16', NULL, 'Regular', 'Faridabad', 35, 'Director & CEO', 'Self', 'IT - Infrastructure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 15:21:48', '2020-09-17 15:21:48'),
(58, 'TT00004', NULL, 'kulbhushanmayer', '', 'Kulbhushan', 'Mayer', 'manager', NULL, 'kulbhushan.mayer@thinknyx.com', '$2y$10$k5ox34pDc7ftwTxMRzFOPuq.Ymm3O1ySuFcftoqaGfvI0fG.1FOKy', 1, 9717996125, NULL, 'Male', '1985-01-01', '2017-01-01', NULL, 'Regular', 'Faridabad', 35, 'Senior Solution Architect', 'Yogesh Raheja', 'IT - Infrastructure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-17 15:30:10', '2020-09-17 15:30:10'),
(59, 'TT00005', NULL, 'chetantalwar', '', 'Chetan', 'Talwar', 'employee', NULL, 'chetan.talwar@thinknyx.com', '$2y$10$x12/fo21bEotHy3itDF8Pe116CZIheklzj6WR94QhT6xD79h/1uM2', 1, 7888356258, '29, Aman Nagar Sodal Road Jalandhar', 'Male', '1993-02-25', '2019-01-01', NULL, 'Regular', 'Faridabad', 27, 'Solution Architect', 'Yogesh Raheja', 'IT - Infrastructure', NULL, NULL, '2022-02-25', 'Rajesh Talwar', 'AB+', 'NA', 'Single', 'chetan.talwar@gmail.', 'Rajesh Talwar', '9316585293', NULL, '3 Yrs', 'Opstree Solutions', '29, Aman Nagar Sodal Road Jalandhar', 'AWS, Azure, Docker, Kubernetes, Devops, Terraform, Ansible, Oracle Cloud, GCP', 'lYrRt54gFJxHEy5foySi7i5DE7pETjI39W4b03tc0llhEn2MlZJqDTU21bao', '2020-09-17 15:35:27', '2022-04-08 14:05:11'),
(60, 'TT00016', NULL, 'himanshukashyap', '1602246140.jpg', 'Himanshu', 'Kashyap', 'employee', NULL, 'himanshu.kashyap@thinknyx.com', '$2y$10$8PB8Sv7BUdGTSS90vUKLr.B.nfbdQFzmyaBPWn1w9VcpEP5Rkl3oC', 1, 9431004461, 'himanshudb10@gmail.com', 'Male', '1999-10-29', '2019-07-10', NULL, 'Regular', 'Faridabad', 20, 'Project Engineer', 'Chetan Talwar', 'Admin', '1 Years 3 Months 2 Days', 'Involuntary Exit, moonlighting', '2023-02-09', 'Hem Chandar Choudhary', 'AB+', 'None', 'Single', 'himanshudbg10@.gmail', '6200072573', '6200072573', NULL, '1 year 2 Month', 'Unicorn infosolutions pvt ltd', 'Sector-2 Faridabad', 'Power Point, UI Deigning.', '4VEfhHtKkXrG4U4N9XyjD9pnXWxUuI3sWkZH5iqCJ3vMZ63QbjYct5aSUzWM', '2020-09-17 15:38:03', '2023-04-04 12:52:29'),
(61, 'TT00018', NULL, 'atulvashishat', '', 'Atul', 'Vashishat', 'employee', NULL, 'atul.vashishat@thinknyx.com', '$2y$10$tn9GG5QGLMxMz6eMmSPO9.1lz/OHooNY3gzriXDA0ZjpydJt4XzgO', 1, 9873755027, 'Flat No 410, Pocket 3C, LIG flats , Dwarka, Sector 16B, Delhi - 110075', 'Male', '1981-05-10', '2020-02-24', '2021-02-12', 'Regular', 'Faridabad', 39, 'Lead Developer', 'Kulbhushan Mayer', 'IT - Development', '0 Years 8 Months 19 Days', 'Better Opportunity', '2021-02-12', 'Ashwani Kumar', 'B+', 'Sarita Sharma', 'Married', 'atul.vashishat@gmail', 'Sanjay', '9818044150', NULL, '12 years', 'SI SYSTEMS', 'Flat No 410, Pocket 3C, LIG flats , Dwarka, Sector 16B, Delhi - 110075', 'php, mysql, javascript, cakephp, magento, laravel, codeignitor, jquery, rest api, soap etc.', NULL, '2020-09-17 15:40:12', '2021-07-23 13:34:14'),
(62, 'TT00019', NULL, 'roopamgaikar', '', 'Roopam', 'Gaikar', 'employee', NULL, 'roopam.gaikar@thinknyx.com', '$2y$10$s7I4.CzT4QDg/8waUdmvNeOMQAKguHdTgDdTB0REmtHXt0uef1sHS', 1, 9870165244, '101/Namaste 2, Ruhi Rehea CHS, Sector 4, Plot no 33, Kopar khairane, Navi Mumbai, Maharashtra', 'Male', '1996-07-25', '2020-03-02', NULL, 'Regular', 'Faridabad', 24, 'Project Engineer', 'Kulbhushan Mayer', 'IT - Infrastructure', '0 Years 7 Months 10 Days', 'Voluntary Exit', '2023-03-31', 'Naresh Gaikar', 'Unknown', 'None', 'Single', 'roopamgaikar@gmail.c', '9892562960', '9870165244', NULL, '2 months', 'Buzzworks', '101/Namaste 2, Ruhi Rehea CHS, Sector 4, Plot no 33, Kopar khairane, Navi Mumbai, Maharashtra', 'Linux, RPA, Wordpress, Ansible', 'IdQIWaNn3w8bog2NcJNZeCmPLOEIEXGGjKgJmot1HiuxCYcBBIFbPSriEt5Y', '2020-09-17 15:42:22', '2023-04-04 12:53:58'),
(63, 'TT00015', NULL, 'divyavohra', '1602061013.jpg', 'Divya', 'Vohra', 'manager', NULL, 'divya.vohra@thinknyx.com', '$2y$10$NtS7OCUDe6ybv3iRbQaBtuG2IzzCUqgyv97/WuLcmuXtcsiWBkvxa', 1, 9810429871, 'E-202, BPTP Park Grandeura, Sector 82, Faridabad, Haryana, 121004', 'Female', '1985-07-10', '2019-01-01', NULL, 'Regular', 'Faridabad', 35, 'HR Head', 'Yogesh Raheja', 'HR', '1 Years 9 Months 10 Days', NULL, NULL, 'R.K. Vohra', 'AB+', 'Yogesh Raheja', 'Married', 'divyaunique@gmail.co', 'Yogesh Raheja', '9810344919', NULL, '12', 'The Nature Conservancy', 'E-202, BPTP Park Grandeura, Sector 82, Faridabad, Haryana, 121004', 'HR, Administration, Operations', 'HTyAVtxuAPgmMZJ04ocjHv610v1nQ4XRqqkjAuXuRWjt6L3weYo6IQzNNzzh', '2020-09-17 15:44:54', '2022-06-14 10:29:08'),
(64, 'TT00021', NULL, 'MonikaRanjan', '', 'Monika', 'Ranjan', 'manager', NULL, 'monika.ranjan@thinknyx.com', '$2y$10$vkrSt/u68lOWOO/MNkZDZe4Fyu/UE7PQ9jQB83YqYM15NP4jKFY4m', 1, 9899000312, '5226, 1st Floor, Kohlapur Road , Kamla Nagar', 'Female', '1981-09-16', '2020-10-05', NULL, 'Regular', 'Faridabad', 39, 'Head - Talent Transformation', 'Kulbhushan Mayer', 'Trainings', '0 Years 0 Months 8 Days', NULL, NULL, 'Narender Kumar', 'O+', 'Mohit Ahuja', 'Married', 'monika.ranjan.ahuja@', 'Mohit Ahuja', '9810310479', NULL, '15+', 'JK Technosoft Limited', '5226, 1st Floor, Kohlapur Road , Kamla Nagar', 'Training & Development', NULL, '2020-10-05 11:15:28', '2023-04-05 14:10:31'),
(65, 'TT00022', NULL, 'SagarGupta', '', 'Sagar', 'Gupta', 'employee', NULL, 'sagar.gupta@thinknyx.com', '$2y$10$SDGqx6fUs2Ee8OxEabkbnuiSU1lO6A4vgvp5Wh47WUteXTrrARPgu', 1, 7798441503, 'Near Patel School, Char Seher Ka Naka Road, Hazira, Gwalior, M.P.', 'Male', '1989-03-07', '2020-12-23', NULL, 'Regular', 'Faridabad', 31, 'DevOps Specialist', 'Yogesh Raheja', 'IT - Infrastructure', NULL, 'PIP Case, Asked to Leave', '2021-08-12', 'P.D. Gupta', 'A+', 'No', 'Single', 'sagarshivgwl@gmail.c', 'Vikas Gupta', '8120310400, 94257046', 'Brother', '8 years approx.', 'Mphasis', 'Near Patel School, Char Seher Ka Naka Road, Hazira, Gwalior, M.P.', 'DevOps Engineer', NULL, '2020-12-22 18:46:55', '2021-11-17 15:16:56'),
(66, 'TT00023', NULL, 'SweetySwaroopa', '1625492187.jpg', 'Sweety', 'Swaroopa', 'manager', NULL, 'sweety.swaroopa@thinknyx.com', '$2y$10$m/MVNcg3W2oEpdul9Y5usefNf7wOXaG7yA0uuUw0fDfazTMDELaqy', 1, 9717576977, 'F-1802,Samridhi Grand Avenue,Techzone-4,Graeter Noida West,U.P-201306', 'Female', '1989-01-08', '2021-06-14', NULL, 'Regular', 'Faridabad', 32, 'Senior Recruitment Specialist', 'Divya Vohra', 'HR', '0 Years 0 Months 21 Days', NULL, NULL, 'Mr. Bijoy Swaroopa', 'O+', 'Ayush Verma', 'Married', 'sweetyrules1@gmail.c', 'Ayush Verma', '9911610303', 'Husband', '7 yrs', 'JK Technosoft Ltd.', 'F-1802,Samridhi Grand Avenue,Techzone-4,Graeter Noida West,U.P-201306', 'End to End Recruitment', NULL, '2021-06-23 17:49:31', '2023-04-04 12:56:43'),
(67, 'TT00024', NULL, 'SwatiSingh', '', 'Swati', 'Singh', 'employee', NULL, 'swati.singh@thinknyx.com', '$2y$10$hzPlaUXczzmqEe0oh6PbieCQjvN49UvV0/q1yP/SBzItAfIJWQ3Z6', 1, 8800287001, 'House No-10374,Gali no 3, Raj Colony, Pacca Field, Maharani Road,Gaya, Bihar 823001', 'Female', '1986-04-01', '2021-10-21', NULL, 'Regular', 'Faridabad', 35, 'Recruiter', 'Sweety Swaroopa', 'HR', '0 Years 1 Months 23 Days', NULL, NULL, 'Ved Prakash Singh', 'A-', 'Rajeev Kumar', 'Married', 'swati.onresponse@gma', 'Rajeev Kumar', '7827007001', 'Husband', '5.4 years', 'Smartshore Infoservices Pvt. Ltd.', 'House no. 206, A block, 5th Avenue, Gaur City 1, Noida Extension-201009', 'Screening, Recruiting, Hiring', NULL, '2021-11-17 14:31:18', '2023-04-04 12:49:45'),
(68, 'TT00025', NULL, 'NijagunaDarshan', '', 'Nijaguna', 'Darshan', 'employee', NULL, 'Nijaguna.Darshan@thinknyx.com', '$2y$10$bkn6ZDo/al9PSx6S679dyuPyYFk1uUMjlFkYSqjG/ovoh0/ePYXgG', 1, 7259990680, 'Aniketana, 10th cross, TPK Road, Sapthagiri Extension, Tumkur 572-102', 'Male', '1997-08-20', '2021-11-01', NULL, 'Regular', 'Faridabad', 24, 'DevOps Specialist', 'Kulbushan Mayer', 'IT - Development', NULL, 'Voluntary Exit', '2023-03-31', 'Nataraj', 'B+', '-', 'Single', 'darshannij@gmail.com', 'NIjaguna Darshan', '8861136933', 'Father', '1.3', 'K2Academy', 'Aniketana, 10th cross, TPK Road, Sapthagiri Extension, Tumkur 572-102', 'Docker, Kubernetes, Python, Data Analysis, Pandas, Terraform, Machine Learning', NULL, '2021-11-17 15:00:25', '2023-04-04 12:54:24'),
(69, 'TT00026', NULL, 'ApurvaSingh', '1640355398.JPG', 'Apurva', 'Singh', 'employee', NULL, 'apurva.singh@thinknyx.com', '$2y$10$c1w3Z7Xyz/temq/94zvKC.dfeAfcjAnIrjOhIxielEigmKKLqgu.y', 1, 9953762381, 'BPTP-Park Elite Floors-Sector 88, Greater Faridabad', 'Female', '1991-08-17', '2021-12-13', NULL, 'Regular', 'Faridabad', 30, 'Recruitment Specialist', 'Sweety Swaroopa', 'HR', '0 Years 0 Months 11 Days', NULL, NULL, 'Rajeev Singh', 'A+', 'single', 'Single', 'singhapurva92@yahoo.', 'Rajeev Singh', '8800580745', 'Father', '5 years', 'Endowment Hunt Solutions', 'Sector88-Greater Faridabad', 'HR-Recruitment Specialist', NULL, '2021-12-13 13:37:43', '2023-04-04 12:57:30'),
(70, 'TT00027', NULL, 'Suraj Kumar', '', 'Suraj', 'Kumar', 'employee', NULL, 'suraj.kumar@thinknyx.com', '$2y$10$g7CeDyPAYXg9HUL1BQVjeuABf0RyJBiODvY4yEjtE5kgmOLDeezxe', 1, 9871292220, 'At+Po- Burhai, P.S- Madhupur, Dist - Deoghar (Jharkhand), Pin- 815353', 'Male', '1992-08-10', '2022-03-01', NULL, 'Regular', 'Faridabad', 29, 'Technical Project Manager', 'Kulbhushan Mayer', 'IT - Infrastructure', NULL, NULL, NULL, 'Sudhir Kumar Baranwal', 'B+', 'Subhangi Mehar', 'Married', 'kumarsuraj.dei@gmail', 'Sourabh Kumar Burnwal', '7305077343', 'Brother', '7.5', 'Imtac India Pvt. Ltd', '#162C, Highland Park Terraces, High Ground Road, Zirakpur, Punjab, Pin-140603', 'Project Management', NULL, '2022-04-08 13:57:47', '2023-04-05 14:11:10'),
(71, 'TT00028', NULL, 'RushikeshKhot', '1651221344.JPG', 'Rushikesh', 'Khot', 'employee', NULL, 'rushikesh.khot@thinknyx.com', '$2y$10$sLvMYheGiQzu0.kn9lb0HOhoi/dntrP5NnOz4vCu2mloFrL0LJmUy', 1, 8928121007, 'A/P Arag, Shiv Sharda Offset, Main Road, Arag, Dist: Sangli, Maharashtra, Pin Code: 416401', 'Male', '1998-10-05', '2022-04-04', '2023-02-14', 'Regular', 'Faridabad', 23, 'DevOps Specialist', 'Kulbhushan Mayer', 'IT - Infrastructure', '0 Years 0 Months 25 Days', 'Voluntary Exit', '2023-02-14', 'Kedari Khot', 'B-', 'NA', 'Single', 'rushi.khot05@gmail.c', 'Ruturaj Chothe', '9730858678', 'Friend', '1.5', 'Capgemini India Pvt. Ltd.', 'A-403, Wing A, iTrend Homes, Hinjewadi Phase-2, Pune, Pin Code: 415411', 'AWS Cloud, Azure Cloud, Terraform, Automation Scripting, Ansible', NULL, '2022-04-29 13:27:40', '2023-04-05 14:13:41'),
(72, 'TT00029', NULL, 'MadhuriJha', '1651221233.png', 'Madhuri', 'Jha', 'admin', NULL, 'madhuri.jha@thinknyx.com', '$2y$10$fDa4ORqQUuRVj3r3q7Og5eKtBvZhkd.3exqNX5vr9jHRaLF9TxR5y', 1, 9868881055, 'Flat # B-803,Shatabdi Rail Vihar, Plot B-9/4, Sector 62, next to Fortis Hospital, NOIDA - 201309, Uttar Pradesh', 'Female', '1975-03-04', '2022-04-04', NULL, 'Regular', 'Faridabad', 47, 'Technical Assistant Manager', 'Monika Ranjan', 'Trainings', '0 Years 0 Months 25 Days', NULL, NULL, 'Wameshwar Jha', 'B+', 'Vishwa B Jha', 'Married', 'madhuri.jha@gmail.co', 'Vishwa B Jha', '9910049243', 'Spouse', '7 years', 'Bharti Public School, Mayur Vihar', 'Flat # B-803,Shatabdi Rail Vihar, Plot B-9/4, Sector 62, next to Fortis Hospital, NOIDA - 201309, Uttar Pradesh', 'software skills like Java,Python,C++,JavaScript,HTML,CSS,VB,Pandas,Basics of Adobe Photoshop', NULL, '2022-04-29 13:33:54', '2022-04-29 14:34:55'),
(73, 'TT00030', NULL, 'PrernaPanchal', '1651222349.png', 'Prerna', 'Panchal', 'employee', NULL, 'p@p.com', '$2y$10$fDa4ORqQUuRVj3r3q7Og5eKtBvZhkd.3exqNX5vr9jHRaLF9TxR5y', 1, 9643770366, NULL, 'Female', '1997-07-12', '2022-04-11', NULL, 'Regular', 'Faridabad', 24, 'Talent Acquisition Specialist', 'Sweety Swaroopa', 'HR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 13:49:33', '2022-04-29 13:52:29'),
(74, 'TT00031', NULL, 'AbhishekMajumdar', '1651566314.png', 'Abhishek', 'Mazumdar', 'employee', NULL, 'abhishek.mazumdar@thinknyx.com', '$2y$10$sGTqoptbb8dEd8wM5r446eaEJFpTQYevek.2zV4UmVRsxPbGTAE5S', 1, 7411073515, 'Plot No-29,Sector 5, NiladriVihar, Chandrasekharpur, Bhubaneswar, Odisha,751021', 'Male', '1983-06-05', '2022-05-02', NULL, 'Regular', 'Home Office', 38, 'DevOps Specialist', 'Kulbhushan Mayer', 'IT - Infrastructure', '0 Years 0 Months 26 Days', NULL, NULL, 'Jyoti Prakash Mazumdar', 'B+', 'Sanghamitra Dey', 'Married', 'a.mazumdar@outlook.c', 'Sanghamitra Dey', '9556094814', 'Spouse', '8 Years', 'Prodevans Technologies Pvt Ltd', '#60, Anjanadri Enclave, Flat-10, 4th floor, Munnekolal, Marathahalli, Bangalore, Karnataka, 560037', 'RHEL Linux, Ansible, OpenShift', NULL, '2022-05-03 13:21:46', '2023-04-05 14:12:04'),
(75, 'TT00032', NULL, 'AmanKumar', '1652345641.JPG', 'Aman', 'Kumar', 'employee', NULL, 'aman.kumar@thinknyx.com', '$2y$10$9DB65AP/6/2B9xCyojppA.j2QOSocp2aNSOPk5hXPzj1rkJ2tF0N6', 1, 7834934352, 'D/O: Ashok Kumar Singh ,mojaradh ,Rohtas,Bihar,802215', 'Male', '2000-04-25', '2022-04-01', NULL, 'Regular', 'Faridabad', 22, 'Project Engineer', 'Kulbhushan Mayer', 'IT - Infrastructure', '0 Years 1 Months 11 Days', NULL, NULL, 'Ashok Kumar Singh', 'B+', 'NA', 'Single', 'amanoncloud@gmail.co', 'Samrat Priyadarshi', '9557840463', 'Brother', '0', 'NA', 'A-46, 3rd Floor, Near ICICI Bank, Ramphal Chowk, Palam Extension, Dwarka Sector 7, New Delhi-110075', 'GCP , Terraform ,python ,Linux', NULL, '2022-05-12 13:23:27', '2023-04-05 14:12:40'),
(76, 'TT99999', NULL, 'ttdevuser', '', 'Dev', NULL, 'employee', NULL, 'sangram.r@thinknyx.com', '$2y$10$36tyYKp3fQGLmzHmH5zu8u5.qfCyLCX3FuqeMJMtai9JQvU4oCdYa', 1, 9876543210, NULL, 'Male', '2000-01-01', '2022-01-01', NULL, 'Regular', 'Other Location', 99, 'Developer', 'Yogesh Raheja', 'IT - Development', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-14 17:09:47', '2022-05-14 17:09:47'),
(77, 'TT00033', NULL, 'DeepthiNarayan', '1661325410.jpg', 'Deepthi', 'Narayan', 'employee', NULL, 'deepthi.narayan@thinknyx.com', '$2y$10$B7rF3b2IcH7adTKPAG8bxOKyn5LB5TakLsL0GRobB5C1ze0pGoSLy', 1, 9742314310, '421, 2nd main, LIC Colony,  Srirampura 2nd Stage, Mysuru-570023', 'Female', '1987-05-16', '2022-08-22', NULL, 'Regular', 'Home Office', 35, 'Technical Specialist', 'Kulbhushan Mayer', 'Trainings', '0 Years 0 Months 2 Days', NULL, NULL, 'H C Ashwatha Narayana', 'A+', 'Suresh Lohith K S', 'Married', 'deepthi.an.87@gmail.', 'Suresh Lohith K S', '9731141414', 'Husband', '10', 'Byjus', 'H930, H block, Brigade Cosmopolis, Whitefield Main Road, Bengaluru-560066', 'HTML, CSS, AWS, React Native, JavaScript, Python', NULL, '2022-08-24 12:15:25', '2023-04-05 14:13:03'),
(78, 'TT00034', NULL, 'Parul Gupta', '', 'Parul', 'Gupta', 'employee', NULL, 'parul.gupta@thinknyx.com', '$2y$10$xmyltL8crJGlj6Upy32x7.wQTWrqRuIPpBlTNloGpcbkWtCtM4CEi', 1, 9873811703, NULL, 'Female', '1984-08-12', '2023-02-27', '2023-03-21', 'Regular', 'Home Office', 38, 'Talent Acquisition Specialist', 'Sweety Swaroopa', 'HR', NULL, 'Voluntary Exit. Personal Reason.', '2023-03-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-06 13:47:23', '2023-04-04 12:47:56'),
(79, 'TT00035', NULL, 'Vinay Kumar', '', 'Vinay', 'Kumar', 'manager', NULL, 'vinay.kumar@thinknyx.com', '$2y$10$I0SO6mHV0GUc19pVJi6Jc.KaFYCwVtNtpwuQa6k7LSAKAk.4joR.S', 1, 9872820553, NULL, 'Male', '2023-03-03', '2023-03-03', NULL, 'Regular', 'Home Office', 0, 'Principal Architect – Security', 'Kulbhushan Mayer', 'IT - Infrastructure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-06 13:53:19', '2023-04-05 14:13:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advancepayments`
--
ALTER TABLE `advancepayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advancepayments_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `appraisals`
--
ALTER TABLE `appraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fyears`
--
ALTER TABLE `fyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals_bkk`
--
ALTER TABLE `goals_bkk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `managesalaries`
--
ALTER TABLE `managesalaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtasks_task_id_foreign` (`task_id`),
  ADD KEY `subtasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `timesheetdetails`
--
ALTER TABLE `timesheetdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `totalleaves`
--
ALTER TABLE `totalleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userassigns`
--
ALTER TABLE `userassigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advancepayments`
--
ALTER TABLE `advancepayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisals`
--
ALTER TABLE `appraisals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fyears`
--
ALTER TABLE `fyears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `goals_bkk`
--
ALTER TABLE `goals_bkk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `managesalaries`
--
ALTER TABLE `managesalaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `timesheetdetails`
--
ALTER TABLE `timesheetdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `totalleaves`
--
ALTER TABLE `totalleaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `userassigns`
--
ALTER TABLE `userassigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advancepayments`
--
ALTER TABLE `advancepayments`
  ADD CONSTRAINT `advancepayments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD CONSTRAINT `subtasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subtasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
