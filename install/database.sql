-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 04:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viserlab_bisurv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `access`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '5ff1c3531ed3f1609679699.jpg', NULL, '$2y$10$Z7ifEDvfu5QNI0HpDI1EeuxtokN0BBrQ75jariAYOFGuwKZ2w0iOO', NULL, '2021-01-04 03:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT 0,
  `click_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `question_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bv_logs`
--

CREATE TABLE `bv_logs` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `position` int(10) DEFAULT NULL COMMENT '1=L,2=R',
  `amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(50) DEFAULT NULL,
  `details` varchar(191) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `method_code` int(10) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `method_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `final_amo` decimal(18,8) DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `admin_feedback` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT 1,
  `sms_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password Reset', 'Password Reset', '<div>We have received a request to reset the password for your account on <b>{{time}} .<br></b></div><div>Requested From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div><div><br></div><br><div><div><div>Your account recovery code is:&nbsp;&nbsp; <font size=\"6\"><b>{{code}}</b></font></div><div><br></div></div></div><div><br></div><div><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><br>', 'Your account recovery code is: {{code}}', ' {\"code\":\"Password Reset Code\",\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-07-07 05:44:08'),
(2, 'PASS_RESET_DONE', 'Password Reset Confirmation', 'You have Reset your password', '<div><p>\r\n    You have successfully reset your password.</p><p>You changed from&nbsp; IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}}&nbsp;</b> on <b>{{time}}</b></p><p><b><br></b></p><p><font color=\"#FF0000\"><b>If you did not changed that, Please contact with us as soon as possible.</b></font><br></p></div>', 'Your password has been changed successfully', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-07 10:23:47'),
(3, 'EVER_CODE', 'Email Verification', 'Please verify your email address', '<div><br></div><div>Thanks For join with us. <br></div><div>Please use below code to verify your email address. <br></div><div><br></div><div>Your email verification code is:<font size=\"6\"><b> {{code}}</b></font></div>', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-07 10:26:22'),
(4, 'SVER_CODE', 'SMS Verification ', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 0, 1, '2019-09-24 23:04:05', '2020-03-08 01:28:52'),
(5, '2FA_ENABLE', 'Google Two Factor - Enable', 'Google Two Factor Authentication is now  Enabled for Your Account', '<div>You just enabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Enabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Your verification code is: {{code}}', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:42:59'),
(6, '2FA_DISABLE', 'Google Two Factor Disable', 'Google Two Factor Authentication is now  Disabled for Your Account', '<div>You just Disabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Disabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Google two factor verification is disabled', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:43:46'),
(16, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply ', 'Reply Support Ticket', '<div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> {{reply}}<br></p></div><div><br></div>', '{{subject}}\r\n\r\n{{reply}}\r\n\r\n\r\nClick here to reply:  {{link}}', '{\"ticket_id\":\"Support Ticket ID\", \"ticket_subject\":\"Subject Of Support Ticket\", \"reply\":\"Reply from Staff/Admin\",\"link\":\"Ticket URL For relpy\"}', 1, 1, '2020-06-08 18:00:00', '2020-05-04 02:24:40'),
(206, 'DEPOSIT_COMPLETE', 'Automated Deposit - Successful', 'Deposit Completed Successfully', '<div>Your deposit of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-24 18:00:00', '2020-07-07 06:39:22'),
(207, 'DEPOSIT_REQUEST', 'Manual Deposit - User Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>submitted successfully<b> .<br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div>', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\n', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}', 1, 1, '2020-05-31 18:00:00', '2020-06-01 18:00:00'),
(208, 'DEPOSIT_APPROVE', 'Manual Deposit - Admin Approved', 'Your Deposit is Approved', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>is Approved .<b><br></b></div><div><b><br></b></div><div><b>Details of your Deposit :<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br></div>', 'Admin Approve Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}} transaction : {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-16 18:00:00', '2020-06-14 18:00:00'),
(209, 'DEPOSIT_REJECT', 'Manual Deposit - Admin Rejected', 'Your Deposit Request is Rejected', '<div>Your deposit request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} has been rejected</b>.<b><br></b></div><br><div>Transaction Number was : {{trx}}</div><div><br></div><div>if you have any query, feel free to contact us.<br></div><br><div><br><br></div>\r\n\r\n\r\n\r\n{{rejection_message}}', 'Admin Rejected Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\",\"rejection_message\":\"Rejection message\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(210, 'WITHDRAW_REQUEST', 'Withdraw  - User Requested', 'Withdraw Request Submitted Successfully', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been submitted Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"4\" color=\"#FF0000\"><b><br></b></font></div><div><font size=\"4\" color=\"#FF0000\"><b>This may take {{delay}} to process the payment.</b></font><br></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br><br></div>', '{{amount}} {{currency}} withdraw requested by {{withdraw_method}}. You will get {{method_amount}} {{method_currency}} in {{duration}}. Trx: {{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"delay\":\"Delay time for processing\"}', 1, 1, '2020-06-07 18:00:00', '2020-06-14 18:00:00'),
(211, 'WITHDRAW_REJECT', 'Withdraw - Admin Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Rejected.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You should get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div>----</div><div><font size=\"3\"><br></font></div><div><font size=\"3\"> {{amount}} {{currency}} has been <b>refunded </b>to your account and your current Balance is <b>{{post_balance}}</b><b> {{currency}}</b></font></div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Rejection :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br><br></div>', 'Admin Rejected Your {{amount}} {{currency}} withdraw request. Your Main Balance {{main_balance}}  {{method}} , Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(212, 'WITHDRAW_APPROVE', 'Withdraw - Admin  Approved', 'Withdraw Request has been Processed and your money is sent', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Processed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Processed Payment :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br></div>', 'Admin Approve Your {{amount}} {{currency}} withdraw request by {{method}}. Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-10 18:00:00', '2020-06-06 18:00:00'),
(215, 'BAL_ADD', 'Balance Add by Admin', 'Your Account has been Credited', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(216, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your Account has been Debited', '<div>{{amount}} {{currency}} has been subtracted from your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}</b></font>', '{{amount}} {{currency}} debited from your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(217, 'matching_bonus', 'Matching bonus', 'Binary Commission', 'Congratulation, You get  {{amount}} {{currency}}&nbsp; For BV {{paid_bv}}. And your current balance is {{post_balance}}&nbsp;<span style=\"color: rgb(33, 37, 41);\">&nbsp;{{currency}}</span>. Transaction number {{trx}}.', 'Congratulation, You get {{amount}} {{currency}}  For BV {{paid_bv}}. And your current balance is {{post_balance}}  {{currency}}.', ' {\r\n                \"amount\":\"matching bonus amount\",\r\n                \"paid_bv\":\"For BV\",\r\n                \"post_balance\":\" After Balance\",\r\n                \"currency\":\"Site Currency\",\r\n                \"trx\":\"Transaction number\"\r\n            }', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(218, 'plan_purchased', 'Plan Purchased', 'Plan Purchased successfully', 'Congratulation, you successfully&nbsp;Purchased {{plan}},&nbsp; {{amount}} {{currency}}&nbsp; And your current balance is {{post_balance}}&nbsp;<span style=\"color: rgb(33, 37, 41);\">&nbsp;{{currency}}</span>. Transaction number {{trx}}', 'Congratulation, you successfully Purchased {{plan}},  {{amount}} {{currency}}  And your current balance is {{post_balance}}  {{currency}}. Transaction number {{trx}}', ' {\r\n                    \"plan\":\"Plan name\",\r\n                    \"amount\":\"Plan price\",\r\n                \"post_balance\":\" After Balance\",\r\n                \"currency\":\"Site Currency\",\r\n                \"trx\":\"Transaction number\"\r\n            }', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(220, 'referral_commission', 'Referral Commission', 'Referral Commission', '<font color=\"#212529\">Congratulation, you get </font>Referral <font color=\"#212529\">Commission from user {{username}} ,&nbsp; &nbsp;{{amount}} {{currency}}&nbsp; And your current balance is {{post_balance}}&nbsp;</font><span style=\"color: rgb(33, 37, 41);\">&nbsp;{{currency}}</span><span style=\"color: rgb(33, 37, 41);\">. Transaction number {{trx}}</span>', 'Congratulation, you get Referral Commission from user {{username}} ,   {{amount}} {{currency}}  And your current balance is {{post_balance}}  {{currency}}. Transaction number {{trx}}', ' {\r\n                    \"username\":\"commission From user\",\r\n                    \"amount\":\"Plan price\",\r\n                \"post_balance\":\" After Balance\",\r\n                \"currency\":\"Site Currency\",\r\n                \"trx\":\"Transaction number\"\r\n            }', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(221, 'BAL_SEND', 'Balance Send', 'Balance Transfer Successfully', '<div>Balance transferred successfully complete. You send  {{amount}} {{currency}}  to  {{username}}  And charge to transfer  {{charge}}  {{currency}} .</div><div><br></div><div>Transaction number {{trx}} .<br></div><div><br></div><div> Your Current Balance is {{balance_now}}  {{currency}}.</div>', 'Balance transferred successfully complete. You send {{amount}} {{currency}} to {{username}} And charge to transfer {{charge}} {{currency}} .\r\n\r\nTransaction number {{trx}} .\r\n\r\nYour Current Balance is {{balance_now}} {{currency}}.', '{\"amount\":\"Send Amount\", \"username\":\"Receiver Username\",\"charge\":\"Transfer charge\" ,\"balance_now\":\" After Balance\", \"currency\":\"currency\",\"trx\":\"Transaction number\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(222, 'BAL_RECEIVE', 'Balance Received', 'Balance Received Successfully', 'Balance received successfully. You got {{amount}} \r\n{{currency}} from&nbsp; {{username}}  And charge to transfer  {{charge}}  \r\n{{currency}} .<div><div><br></div><div>Transaction number {{trx}} .<br></div><div><br></div><div> Your Current Balance is {{balance_now}}  {{currency}}.</div></div>', 'Balance received successfully. You got {{amount}} {{currency}} from  {{username}} And charge to transfer {{charge}} {{currency}} .\r\n\r\nTransaction number {{trx}} .\r\n\r\nYour Current Balance is {{balance_now}} {{currency}}.', '{\"amount\":\"Received Amount\", \"username\":\"Sender Username\",\"charge\":\"Transfer charge\" ,\"balance_now\":\" After Balance\", \"currency\":\"currency\",\"trx\":\"Transaction number\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(223, 'SURVEY_COMPLETED', 'Survey  - User completed', 'You have completed Survey Successfully', '<div>You have successfully completed a survey named {{survey_name}} .</div><div><b style=\"font-size: 1rem;\"><br></b></div><div><span style=\"font-size: 1rem;\">You got</span><b style=\"font-size: 1rem;\"> {{amount}} {{currency}}</b><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">&nbsp;&nbsp;</span>as reward<span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">.</span></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br><br></div>', 'You have Successfully completed a survey named {{survey_name}}. You got {{amount}} {{currency}} as reward.', '{\"survey_name\":\"Survey Name\",\"amount\":\"Reward Amount\",\"post_balance\":\"Current Balance\",\"currency\":\"Site Currency\"}', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` int(10) UNSIGNED NOT NULL,
  `act` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"58dd135ef7bbaa7\\/default\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2022-03-01 02:55:15'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\r\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\r\n<div class=\"g-recaptcha\" data-sitekey=\"{{sitekey}}\" data-callback=\"verifyCaptcha\"></div>\r\n<div id=\"g-recaptcha-error\"></div>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"6Lfpm3cUAAAAAGIjbEJKhJNKS4X1Gns9ANjh8MfH\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2022-03-01 03:29:47'),
(3, 'custom-captcha', 'Custom Captcha', 'Just Put Any Random String', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 23:16:05', '2022-03-01 03:29:44'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google-analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"Demo\"}}', 'ganalytics.png', 0, NULL, NULL, '2020-07-21 01:07:30'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"713047905830100\"}}', 'fb_com.PNG', 0, NULL, NULL, '2022-02-23 07:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"mlm\",\"binary mlm\",\"php mlm\",\"survey\"],\"description\":\"Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularly raised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\\r\\n\\r\\nWhy do we use it?\\r\\nIt is a long-established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem Ipsum will uncover many websites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humor and the like).\",\"social_title\":\"Binary MLM &amp; Survey Platform\",\"social_description\":\"Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularly raised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\\r\\n\\r\\nWhy do we use it?\\r\\nIt is a long-established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem Ipsum will uncover many websites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humor and the like).\",\"image\":\"621e01dd493e51646133725.png\"}', '2020-07-04 23:42:52', '2022-03-01 08:54:03'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"About Us\",\"subheading\":\"15 Years Of Your Trust\",\"video_link\":\"https:\\/\\/www.youtube.com\\/watch?v=WOb4cj7izpE\",\"description\":\"<div style=\\\"text-align:justify;\\\"><div>We are not just an online version of any Business market, but also, the reflection of each and every MLM business.\\u00a0We are an international financial company engaged in investment activities, which are related to MLM on financial markets by qualified professional traders.<\\/div><\\/div><blockquote style=\\\"margin:0 0 0 40px;border:none;padding:0px;\\\"><\\/blockquote><blockquote style=\\\"margin:0 0 0 40px;border:none;padding:0px;\\\"><\\/blockquote><blockquote style=\\\"margin:0 0 0 40px;border:none;padding:0px;\\\"><\\/blockquote><blockquote style=\\\"margin:0 0 0 40px;border:none;padding:0px;\\\"><\\/blockquote>\",\"left_button\":\"More About\",\"left_button_link\":\"about-us\",\"right_button\":\"Explore More\",\"right_button_link\":\"about-us\",\"background_image\":\"6215d5c3b5a6d1645598147.jpg\"}', '2020-10-28 00:51:20', '2022-02-28 05:11:08'),
(25, 'blog.content', '{\"heading\":\"Blog Posts\",\"subheading\":\"Our Latest News And Tips\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-10-28 00:51:34', '2022-02-28 05:20:26'),
(27, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Get In Touch With Us\",\"short_details\":\"We are here for you always! please fill up the information and feel free ask if you have any query.\",\"email_address\":\"contact@demo.com\",\"contact_details\":\"1205 Tipu Sultan Road, Malibag, Dhaka\",\"contact_number\":\"(123) 456 - 7890\",\"background_image\":\"607144211bf0c1618035745.png\"}', '2020-10-28 00:59:19', '2022-02-23 06:21:38'),
(28, 'counter.content', '{\"heading\":\"Counter\",\"subheading\":\"Our Strategy\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-10-28 01:04:02', '2022-02-28 05:18:58'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', '2020-11-12 04:07:30', '2022-02-23 00:48:18'),
(33, 'service.content', '{\"heading\":\"Our Services\",\"subheading\":\"Why We are The Best\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-12-01 00:47:44', '2022-02-28 05:11:42'),
(34, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-hand-holding-heart\\\"><\\/i>\",\"title\":\"Profitable\",\"description\":\"You can get the golden opportunity to actually win a lot of profit here.\"}', '2020-12-01 00:48:27', '2020-12-12 14:28:18'),
(35, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-lock\\\"><\\/i>\",\"title\":\"Secure\",\"description\":\"Gives ultimate security with 2FA authentication with this system\"}', '2020-12-01 00:48:38', '2020-12-12 14:27:27'),
(36, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-language\\\"><\\/i>\",\"title\":\"Language\",\"description\":\"This site can be easily translated into your own language.\"}', '2020-12-01 00:49:30', '2020-12-12 14:26:22'),
(37, 'service.element', '{\"icon\":\"<i class=\\\"fab fa-btc\\\"><\\/i>\",\"title\":\"Crypto\",\"description\":\"Cryptocurrency stored on our servers is covered by our insurance policy.\"}', '2020-12-01 00:49:41', '2020-12-12 14:25:13'),
(38, 'service.element', '{\"icon\":\"<i class=\\\"far fa-life-ring\\\"><\\/i>\",\"title\":\"Support\",\"description\":\"We always provide the best \\nsupport to all our users.\"}', '2020-12-01 00:50:03', '2020-12-12 14:41:18'),
(39, 'service.element', '{\"icon\":\"<i class=\\\"fas fa-globe-americas\\\"><\\/i>\",\"title\":\"Global\",\"description\":\"We support a variety of the most popular digital currencies.\"}', '2020-12-01 00:50:37', '2020-12-12 14:20:11'),
(40, 'how_it_works.content', '{\"heading\":\"How\",\"subheading\":\"Hot to Get Started\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-12-01 00:51:07', '2022-02-28 05:14:21'),
(41, 'how_it_works.element', '{\"icon\":\"<i class=\\\"las la-user-plus\\\"><\\/i>\",\"title\":\"Create An Account\"}', '2020-12-01 00:52:11', '2022-02-23 01:20:13'),
(42, 'how_it_works.element', '{\"icon\":\"<i class=\\\"las la-hand-pointer\\\"><\\/i>\",\"title\":\"Choose Plan\"}', '2020-12-01 00:52:26', '2022-02-23 01:20:30'),
(43, 'how_it_works.element', '{\"icon\":\"<i class=\\\"las la-users\\\"><\\/i>\",\"title\":\"Invite More People\"}', '2020-12-01 00:52:57', '2022-02-23 01:20:49'),
(44, 'team.content', '{\"heading\":\"Team\",\"subheading\":\"Our Expert Team\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-12-01 00:53:36', '2022-02-28 05:21:10'),
(45, 'team.element', '{\"has_image\":\"1\",\"name\":\"MR. Jhon\",\"designation\":\"someone @ anything\",\"image\":\"6215fbad125cc1645607853.jpg\"}', '2020-12-01 01:03:34', '2022-02-23 03:17:33'),
(46, 'team.element', '{\"has_image\":\"1\",\"name\":\"Jon Doi\",\"designation\":\"CEO @ Adobe\",\"image\":\"6215fab36bf651645607603.png\"}', '2020-12-01 01:03:53', '2022-02-23 03:13:23'),
(48, 'team.element', '{\"has_image\":\"1\",\"name\":\"MR. Jhon\",\"designation\":\"CEO @ Adobe\",\"image\":\"6215fab9a67261645607609.jpg\"}', '2020-12-01 01:04:12', '2022-02-23 03:13:29'),
(49, 'mlmPlan.content', '{\"has_image\":\"1\",\"heading\":\"Pricing Plan\",\"sub_heading\":\"Our Pricing Plan\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\",\"background_image\":\"608116bd3561b1619072701.jpg\"}', '2020-12-01 01:04:48', '2022-02-23 01:29:51'),
(50, 'latestTrx.content', '{\"heading\":\"Transaction\",\"sub_heading\":\"Our Latest Transaction\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-12-01 01:05:37', '2022-02-23 03:48:14'),
(52, 'counter.element', '{\"title\":\"Total Invest\",\"counter_digit\":\"9M\",\"icon\":\"<i class=\\\"las la-money-bill-wave-alt\\\"><\\/i>\"}', '2020-12-01 01:09:49', '2022-02-23 03:41:52'),
(53, 'counter.element', '{\"title\":\"Total Deposit\",\"counter_digit\":\"10M+\",\"icon\":\"<i class=\\\"las la-wallet\\\"><\\/i>\"}', '2020-12-01 01:10:07', '2022-02-23 03:36:56'),
(54, 'counter.element', '{\"title\":\"Total Withdraw\",\"counter_digit\":\"8M+\",\"icon\":\"<i class=\\\"las la-hand-holding-usd\\\"><\\/i>\"}', '2020-12-01 01:10:20', '2022-02-23 03:45:11'),
(55, 'counter.element', '{\"title\":\"Total Users\",\"counter_digit\":\"1300+\",\"icon\":\"<i class=\\\"fas fa-users\\\"><\\/i>\"}', '2020-12-01 01:10:33', '2022-02-23 03:44:48'),
(56, 'testimonial.content', '{\"heading\":\"Our Happy Client\",\"sub_heading\":\"We always care for our clients, lets see what\'s their opinion about us.\"}', '2020-12-01 01:11:00', '2022-02-23 04:58:32'),
(61, 'subscribe.content', '{\"heading\":\"Subscribe\",\"subheading\":\"Dont Forget To Subscribe\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus!\"}', '2020-12-01 01:14:58', '2022-02-28 05:15:12'),
(62, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Popular Words in the Multi-Level Marketing Industry\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">While MLMs focus almost exclusively on direct selling, this is not an accurate synonym because direct selling is simply the method by which distributors in MLMs sell products and\\/or recruit new members. Direct selling is the idea that sales people leverage their personal contacts and relationships, whereas salesmen at a normal company are often working with people that they don\\u2019t personally know. Multi-level marketing companies that have lasted many years or even decades have generally done a better job of emphasizing direct sales over recruiting.<\\/font><br \\/><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\"><br \\/><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">In 1979, a landmark ruling involving Amway helped to legitimize the multi-level marketing industry. The FTC found that Amway was not operating as a pyramid scheme according to the strict statutory definition of one, but did order the company to stop deceiving its distributors about their income potential.<\\/font><\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621ca6983ca221646044824.jpg\"}', '2020-12-01 01:16:46', '2022-02-28 04:40:24'),
(63, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"History of Multi Level Marketing in the world\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">The first recognized MLM businesses in the United States were the California Vitamin Company (founded in the 1920s and later renamed Nutrilite in 1939), and the California Perfume Company (incorporated in 1909 and later renamed Avon Products in 1932).<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\"><br \\/><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">In 1979, a landmark ruling involving Amway helped to legitimize the multi-level marketing industry. The FTC found that Amway was not operating as a pyramid scheme according to the strict statutory definition of one, but did order the company to stop deceiving its distributors about their income potential.<\\/font><\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621cab660c5a11646046054.jpg\"}', '2020-12-01 01:16:47', '2022-03-01 06:15:31'),
(64, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"What is Multi-Level Marketing? What You Need to Know About the Industry\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">This stands in stark contrast to most standard businesses, where employees are rewarded for sales made to other businesses (B2B companies) or to consumers (B2C companies). Additionally, obtaining a higher rank within multi-level marketing companies depends on your ability to recruit others, rather than by appointment. MLMs that rely too heavily on recruitment rather than emphasizing direct sales generally fail over time because of the natural progression of pyramid schemes which are unsustainable in the long run.<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621caba48f7f41646046116.jpg\"}', '2020-12-01 01:16:48', '2022-02-28 05:01:56'),
(65, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Melaleuca CEO Frank VanderSloot Promises to Resign if World Record Attempt Fails\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;\\\"><font face=\\\"PT Sans, Arial, Helvetica, sans-serif\\\"><span style=\\\"font-size:16px;\\\">In an interview with East Idaho News today, Melalecua CEO Frank Vandersloot promised to resign his executive position with the company if his world record rowing attempt fails. VanderSloot will attempt to complete a 100-meter row on a Concept 2 Rower within 15.3 seconds on Tuesday, which also happens to be his 70th birthday.<\\/span><\\/font><br \\/><\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621cab5a8a2761646046042.jpg\"}', '2020-12-01 01:16:49', '2022-02-28 05:00:42'),
(66, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Amway Co-Founder Richard DeVos Passes Away at Age 92\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">Rick DeVos announced earlier today that his grandfather and co-founder of Amway Richard DeVos has passed away at age 92. DeVos got his start in the multi-level marketing world as a distributor with Nutrilite, a direct selling company that primarily sold vitamins and supplements. Along with his partner Jay Van Andel, DeVos eventually started his own MLM called Amway (short for American Way), which eventually purchased Nutrilite in 1972. Since then, Amway has grown to become the largest MLM in the U.S., boasting over 3 million distributors worldwide.<\\/font><br \\/><\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621cab51dfa241646046033.jpg\"}', '2020-12-01 01:16:51', '2022-02-28 05:00:34'),
(67, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"2020 Top 50 MLM Companies in the U.S.\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">*Note: 2019 revenue numbers coming soon.<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\"><br \\/><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">Below is the comprehensive list of multi-level marketing companies generating the most amount of revenue in the United States. After compiling this list, we noticed some interesting trends:<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\"><br \\/><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">Only 2 companies in the Top 10 were founded after the year 2000. Out of the Top 50, only 20 were founded after 2000.<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">38% (19 total) of the Top 50 MLMs were in the supplements industry, by far the most popular category. The Beauty industry is second with 16% (8 total).<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">Of the Top 10, 50% of the companies are in the Beauty industry.<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#000000\\\" face=\\\"Open Sans, Arial, sans-serif\\\">Have any others you\\u2019d like to add to the top MLMs list? Let us know in the comments.<\\/font><\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;font-weight:700;line-height:1.3;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;padding:0px;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p>\",\"blog_image\":\"621cab133a8081646045971.jpg\"}', '2020-12-01 01:22:19', '2022-02-28 04:59:31'),
(68, 'footer_section.content', '{\"website_footer\":\"We are a worldwide trusted company . This secured website with a user-friendly interface and support of various languages is a breeze to use. Additionally, this site has both desktop and mobile. This secured website with a user-friendly interface and support of various languages is a breeze to use. Additionally, this site has both desktop and mobile.\",\"copyright\":\"Copyright \\u00a9 2021. All Rights Reserved\"}', '2020-12-01 01:23:24', '2021-04-10 00:21:51'),
(70, 'marketing_tool.element', '{\"title\":\"Binary MLM calculator\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#555555\\\" face=\\\"Roboto, sans-serif\\\" size=\\\"4\\\">Yes, the binary plan has been popular since the early days and the calculations were made manually. However, a binary system calculation with many networkers is a clutter-job. The emergence of binary calculators or simulators resolved this difficulty.<\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;text-align:justify;\\\"><font color=\\\"#555555\\\" face=\\\"Roboto, sans-serif\\\" size=\\\"4\\\">By providing the necessary input on the binary calculator like the package details, compensations, and other expenses, an output can be simulated.<\\/font><\\/p>\"}', '2020-12-01 01:24:08', '2020-12-13 12:27:42'),
(71, 'marketing_tool.element', '{\"title\":\"Hybrid binary plan\",\"description\":\"<p class=\\\"text-s-1-2\\\" style=\\\"margin-bottom:1rem;line-height:2rem;color:rgb(49,49,49);letter-spacing:0.26px;word-spacing:1px;font-family:Gordita, \'Helvetica Neue\', Helvetica, sans-serif;\\\"><font size=\\\"4\\\">A binary plan can be modified by combining with other compensation plans.\\u00a0<span class=\\\"font-weight-medium\\\">Why should an MLM company go for a hybrid plan?<\\/span><\\/font><\\/p><p class=\\\"text-s-1-2\\\" style=\\\"margin-bottom:1rem;line-height:2rem;color:rgb(49,49,49);letter-spacing:0.26px;word-spacing:1px;font-family:Gordita, \'Helvetica Neue\', Helvetica, sans-serif;\\\"><span style=\\\"font-size:large;color:rgb(49,49,49);letter-spacing:0.26px;\\\">MLM company strategies vary and they might even have their own custom plan to add in the existing binary plan. The plans are chosen by analyzing the present marketing situations. With the best marketing plan, companies can become popular and beneficial in productivity.<\\/span><\\/p>\"}', '2020-12-01 01:24:08', '2020-12-13 12:29:42'),
(72, 'marketing_tool.element', '{\"title\":\"Advantages\\/Benefits of Binary MLM Plan\",\"description\":\"<p style=\\\"margin:-10px 0px 15px;padding:0px;\\\"><font face=\\\"Gordita, Helvetica Neue, Helvetica, sans-serif\\\" size=\\\"4\\\"><span style=\\\"letter-spacing:0.26px;word-spacing:1px;\\\">Inside leg placement: Inside leg placement is used to balance the legs in the binary tree. Distributors will add new members to the weak leg to balance the sales volume and active participation is assured.<\\/span><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;\\\"><font face=\\\"Gordita, Helvetica Neue, Helvetica, sans-serif\\\" size=\\\"4\\\"><span style=\\\"letter-spacing:0.26px;word-spacing:1px;\\\">Cycle point: A minimum sales volume is set for commission payment by binary companies. The pay leg must meet this volume or else the commission won\\u2019t be commenced until it meets the cycle point.<\\/span><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;\\\"><font face=\\\"Gordita, Helvetica Neue, Helvetica, sans-serif\\\" size=\\\"4\\\"><span style=\\\"letter-spacing:0.26px;word-spacing:1px;\\\">Individual volume threshold: A sales volume threshold is set to make sure every distributor contributes to the binary business.<\\/span><\\/font><\\/p><p style=\\\"margin:-10px 0px 15px;padding:0px;\\\"><font face=\\\"Gordita, Helvetica Neue, Helvetica, sans-serif\\\" size=\\\"4\\\"><span style=\\\"letter-spacing:0.26px;word-spacing:1px;\\\">Leg flush: MLM companies can flush out both weak and strong leg sales or reset sales volume to zero<\\/span><\\/font><\\/p>\"}', '2020-12-01 01:24:11', '2020-12-13 12:25:55'),
(73, 'faq.content', '{\"heading\":\"FAQs\",\"subheading\":\"Frequently Asked Questions\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2020-12-01 01:24:57', '2022-02-28 05:19:37'),
(79, 'sign_up.content', '{\"has_image\":\"1\",\"background_image\":\"621779ceb45c31645705678.png\"}', '2020-12-01 01:28:59', '2022-02-24 06:27:59'),
(80, 'sign_in.content', '{\"has_image\":\"1\",\"title\":\"Login Account\",\"short_details\":\"To login into the site please enter your username and password\",\"register_section_title\":\"Well Come To MLM world\",\"register_section_short_details\":\"Haven\'t registered yet! don\'t worry just fillip all the information below and get your account now.\",\"background_image\":\"621752517dacf1645695569.png\"}', '2020-12-01 01:29:34', '2022-02-24 03:39:29'),
(82, 'slider.element', '{\"has_image\":[\"1\"],\"title\":\"MLMLab\",\"subtitle\":\"Multilevel Marketing Platform\",\"left_button\":\"sign in\",\"left_button_link\":\"login\",\"right_button\":\"sign up\",\"right_button_link\":\"register\",\"description\":\"We are a dedicated Binary Multilevel Marketing company for every MLM plan with custom features.\",\"background_image\":\"606ef184693bb1617883524.jpg\"}', '2020-12-01 02:07:41', '2021-04-08 06:07:07'),
(83, 'breadcrumb.content', '{\"has_image\":\"1\",\"background_image\":\"5fc60b6f0b76e1606814575.jpg\"}', '2020-12-01 03:22:55', '2020-12-01 03:22:55'),
(84, 'social_icon.element', '{\"title\":\"twitter\",\"social_icon\":\"<i class=\\\"lab la-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', '2020-12-05 01:00:59', '2022-02-23 00:48:40'),
(85, 'social_icon.element', '{\"title\":\"youtube\",\"social_icon\":\"<i class=\\\"fab fa-youtube\\\"><\\/i>\",\"url\":\"https:\\/\\/www.youtube.com\\/\"}', '2020-12-05 01:01:07', '2022-02-23 00:48:47'),
(86, 'social_icon.element', '{\"title\":\"instagram\",\"social_icon\":\"<i class=\\\"lab la-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', '2020-12-05 01:01:15', '2022-02-23 00:49:08'),
(87, 'social_icon.element', '{\"title\":\"telegram\",\"social_icon\":\"<i class=\\\"lab la-telegram-plane\\\"><\\/i>\",\"url\":\"https:\\/\\/www.telegram.com\\/\"}', '2020-12-05 01:02:49', '2022-02-23 00:49:17'),
(89, 'feature.content', '{\"heading\":\"Feature Overview\",\"sub_heading\":\"We support the most secure services and features. This secured website supports a user-friendly interface and various attractive features that ready to use.\"}', '2020-12-13 12:19:28', '2020-12-17 14:31:51'),
(90, 'feature.element', '{\"title\":\"Full Control\",\"description\":\"You will have full control over the system. This includes everything from investment plans to payment processor configuration.\",\"feature_icon\":\"<i class=\\\"las la-file-contract\\\"><\\/i>\"}', '2020-12-13 12:20:16', '2020-12-13 12:20:16'),
(92, 'team.element', '{\"has_image\":\"1\",\"name\":\"Sergio Leonel\",\"designation\":\"CEO @ Adobe\",\"image\":\"6215fbb9c87e61645607865.png\"}', '2021-04-08 06:51:21', '2022-02-23 03:17:46'),
(93, 'slider.element', '{\"has_image\":[\"1\"],\"title\":\"MlmLab\",\"subtitle\":\"Multilevel Marketing Platform\",\"left_button\":\"sign in\",\"left_button_link\":\"login\",\"right_button\":\"sign up\",\"right_button_link\":\"register\",\"description\":\"We are a dedicated Binary Multilevel Marketing company for every MLM plan with custom features.\",\"background_image\":\"60714f72554721618038642.jpg\"}', '2021-04-10 01:08:45', '2021-04-10 01:10:50'),
(95, 'notice.content', '{\"description\":\"Get survey responses from around the world in minutes with Audience Target the types of people you want to hear from based on specific attributes, like country, gender, age, income, employment status, and more. A survey panel owned exclusively by members, empowering you to exchange your data and opinions for company shares. Get survey responses from around the world in minutes with Audience Target the types of people you want to hear from based on specific attributes, like country, gender, age, income, employment status, and more. A survey panel owned exclusively by members, empowering you to exchange your data and opinions for company shares.\"}', '2022-02-14 05:16:42', '2022-02-14 05:16:42'),
(97, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Multilevel Marketing Platform\",\"subheading\":\"Win more commissions by making more members and increase your capital. And you can earn more money by viewing advertisements on our site.\",\"left_button\":\"sign in\",\"left_button_link\":\"login\",\"right_button\":\"sign up\",\"right_button_link\":\"register\",\"background_image\":\"6215d4a0db2491645597856.png\"}', '2022-02-23 00:26:29', '2022-02-28 05:04:31'),
(98, 'about.element', '{\"icon\":\"<i class=\\\"las la-gem\\\"><\\/i>\",\"paragraph\":\"Best Platform with 1000+ happy clients\"}', '2022-02-23 00:43:27', '2022-02-23 00:43:27'),
(99, 'about.element', '{\"icon\":\"<i class=\\\"las la-chart-line\\\"><\\/i>\",\"paragraph\":\"We will grow your business in whole world\"}', '2022-02-23 00:43:47', '2022-02-23 00:43:47'),
(100, 'about.element', '{\"icon\":\"<i class=\\\"las la-award\\\"><\\/i>\",\"paragraph\":\"We will 100% money back guarantee in 30 days\"}', '2022-02-23 00:44:07', '2022-02-23 00:44:07'),
(101, 'about.element', '{\"icon\":\"<i class=\\\"las la-headphones-alt\\\"><\\/i>\",\"paragraph\":\"We have a strong customer support in 24\\/7 days\"}', '2022-02-23 00:44:24', '2022-02-23 00:46:06'),
(102, 'how_it_works.element', '{\"icon\":\"<i class=\\\"las la-wallet\\\"><\\/i>\",\"title\":\"Get Commission\"}', '2022-02-23 01:21:01', '2022-02-23 01:21:01'),
(103, 'team.element', '{\"has_image\":\"1\",\"name\":\"Abu Raihan\",\"designation\":\"CEO, RevPtc\",\"image\":\"6215fbd7e49a71645607895.jpg\"}', '2022-02-23 03:18:15', '2022-02-23 03:18:16'),
(104, 'team.element', '{\"has_image\":\"1\",\"name\":\"Mumu\",\"designation\":\"CEO, RevPtc\",\"image\":\"6215fbea0dd6d1645607914.jpg\"}', '2022-02-23 03:18:34', '2022-02-23 03:18:34'),
(105, 'testimonial.element', '{\"name\":\"Sifatullah Shuvo\",\"rating\":\"4\",\"say\":\"Accusamus debitis consequuntur pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, laborum dolore, sequi asperiores.\"}', '2022-02-23 05:03:34', '2022-02-23 05:03:34'),
(106, 'testimonial.element', '{\"name\":\"Mumu\",\"rating\":\"3\",\"say\":\"Accusamus debitis consequuntur pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, laborum dolore, sequi asperiores.\"}', '2022-02-23 05:03:45', '2022-02-23 05:03:45'),
(107, 'testimonial.element', '{\"name\":\"Zahidul Islam\",\"rating\":\"2\",\"say\":\"Accusamus debitis consequuntur pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, laborum dolore, sequi asperiores.\"}', '2022-02-23 05:04:19', '2022-02-23 05:04:19'),
(108, 'payment.content', '{\"heading\":\"Easy Payment\",\"subheading\":\"Our Payment System For You\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2022-02-23 05:12:09', '2022-02-28 05:16:10'),
(109, 'faq.element', '{\"question\":\"How to making a withdrawal?\",\"answer\":\"You can make a withdrawal from the Withdraw page. Where possible we are required to send funds back to the payment method that was used to deposit the original funds.\\r\\nFor further details relating to processing times and any applicable fees, please refer to the Withdrawals section of our Payments page.\\r\\nYou can make a withdrawal from the Withdraw page. Where possible we are required to send funds back to the payment method that was used to deposit the original funds.\\r\\nFor further details relating to processing times and any applicable fees, please refer to the Withdrawals section of our Payments page.\"}', '2022-02-23 05:56:40', '2022-02-23 05:56:40'),
(110, 'faq.element', '{\"question\":\"I have not received my withdrawal\",\"answer\":\"The processing time for your withdrawal will vary depending on your payment method.\\r\\nYou can view further information on withdrawal clearance times by visiting our Payment Method page. If you are unable to locate your withdrawal after the processing time has passed, please Contact Us.\"}', '2022-02-23 05:57:02', '2022-02-23 05:57:02'),
(111, 'faq.element', '{\"question\":\"Advantages\\/Benefits of Binary MLM Plan\",\"answer\":\"Unlimited depth: Binary plan allows distributors to add members to unlimited levels and earn a high income.\\r\\n\\r\\nGroup work: With left leg or right spilling preferences, the distributors become active as they have to balance the tree for compensations.\\r\\n\\r\\nQuick growth: Binary plan offers quick business growth opportunities.\\r\\n\\r\\nCarry forward: Unpaid sales volume (SV) after present binary payout cycle is carry forward for the next binary payout cycle.\\r\\n\\r\\nSpillover: New members after completing the first level is spilled over to the unlimited downline levels.\"}', '2022-02-23 05:57:15', '2022-02-23 05:57:15'),
(112, 'faq.element', '{\"question\":\"How Does the Binary MLM Plan Works?\",\"answer\":\"Binary MLM plan is a network marketing compensation strategy used by many top-performing MLM companies. The new members sponsored by distributors are added either on the left or right leg. Upon adding two new members on either side of the subtree, a binary tree gets formed\"}', '2022-02-23 05:57:24', '2022-02-23 06:00:08'),
(113, 'faq.element', '{\"question\":\"What is a Binary MLM Plan?\",\"answer\":\"The binary MLM plan is defined as a compensation plan that consists of two legs (left &amp; right) or subtrees under every distributor. Upon adding subtrees, a binary tree gets formed. New members joining after them are spilled over to the downlines or next business level.\"}', '2022-02-23 05:57:33', '2022-02-23 05:57:33'),
(114, 'reset_password.content', '{\"has_image\":\"1\",\"background_image\":\"621768fd1c76a1645701373.png\"}', '2022-02-24 05:16:13', '2022-02-24 05:16:13'),
(115, 'auth.content', '{\"has_image\":\"1\",\"background_image\":\"62178538cd2711645708600.png\"}', '2022-02-24 07:16:40', '2022-02-24 07:16:41'),
(116, 'testimonial.element', '{\"name\":\"Mohamamd Islam\",\"rating\":\"5\",\"say\":\"Accusamus debitis consequuntur pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, laborum dolore\"}', '2022-02-27 00:51:58', '2022-02-27 00:51:58'),
(117, 'testimonial.element', '{\"name\":\"Mr Rasel\",\"rating\":\"4\",\"say\":\"pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, laborum dolore, sequi asperiores.\"}', '2022-02-27 00:52:25', '2022-02-27 00:52:25'),
(118, 'testimonial.element', '{\"name\":\"Agun Islam\",\"rating\":\"5\",\"say\":\"cusamus debitis consequuntur pariatur explicabo hic neque, vero qui maiores enim ad cupiditate placeat eos quia a deleniti, l\"}', '2022-02-27 00:52:45', '2022-02-27 00:52:45'),
(119, 'latest_trx.content', '{\"heading\":\"Transaction\",\"subheading\":\"Our Latest Transaction\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2022-02-28 04:19:14', '2022-02-28 05:18:14'),
(120, 'mlm_plan.content', '{\"heading\":\"Pricing Plan\",\"subheading\":\"Our Pricing Plan\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2022-02-28 04:36:52', '2022-02-28 05:17:01'),
(121, 'top_earner.content', '{\"heading\":\"Survey\",\"subheading\":\"Our Top Survey Earners\",\"description\":\"Necessitatibus sapiente ex earum omnis, commodi doloribus! Iste corrupti error maiores inventore.\"}', '2022-02-28 07:14:49', '2022-03-01 05:34:44'),
(122, 'email_verify_page.content', '{\"has_image\":\"1\",\"background_image\":\"621cd4afa8d201646056623.png\"}', '2022-02-28 07:55:46', '2022-02-28 07:57:04'),
(123, 'sms_verify_page.content', '{\"has_image\":\"1\",\"background_image\":\"621cd53b58ea61646056763.png\"}', '2022-02-28 07:59:23', '2022-02-28 07:59:23'),
(124, '2fa_verify_page.content', '{\"has_image\":\"1\",\"background_image\":\"621cd62f8622b1646057007.png\"}', '2022-02-28 08:03:27', '2022-02-28 08:03:27');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(125, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '2022-03-01 04:26:31', '2022-03-01 04:26:31'),
(126, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, &amp; installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">We Don\'t support any child porn or such material.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No harassing material that may cause people to retaliate against you.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No phishing pages.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious Botnets are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious hacking materials, trojans, viruses, &amp; malicious bots running or for download are forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Php\\/CGI proxies are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">CGI-IRC is strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Terms &amp; Questions for Users<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Before getting to this site, you are consenting to be limited by these site Terms and Questions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Support<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p class=\\\"my-3 font-18 font-weight-bold\\\" style=\\\"font-size:18px;margin-right:0px;margin-left:0px;\\\">On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Hang tight for additional update discharge.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Ownership<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Warranty<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Unauthorized\\/Illegal Usage<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Fiverr, Seoclerks Sellers Or Affiliates<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Payment\\/Refund Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;color:rgb(54,54,54);font-family:Exo, sans-serif;\\\">Free Balance \\/ Coupon Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '2022-03-01 04:26:51', '2022-03-01 04:26:51'),
(127, 'faq.element', '{\"question\":\"How to earn money from bisurv via survey?\",\"answer\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}', '2022-03-01 06:26:53', '2022-03-01 06:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` int(11) DEFAULT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_form` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `alias`, `image`, `name`, `status`, `parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `input_form`, `created_at`, `updated_at`) VALUES
(1, 101, 'paypal', '621b1433434811645941811.jpg', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-zlbi7986064@personal.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-02-27 00:06:30'),
(2, 102, 'perfect_money', '621b14065662a1645941766.jpg', 'Perfect Money', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"6451561651551\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-02-27 00:06:32'),
(3, 103, 'stripe', '6216178f9a7371645614991.jpg', 'Stripe Hosted', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-02-27 00:06:35'),
(4, 104, 'skrill', '621b145c9aad01645941852.jpg', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-02-27 00:06:39'),
(5, 105, 'paytm', '621b146d5e8ad1645941869.jpg', 'PayTM', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-02-27 00:06:42'),
(6, 106, 'payeer', '621e34c6ede911646146758.jpg', 'Payeer', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.payeer\"}}', NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 19:59:19'),
(7, 107, 'paystack', '621e34d73d9391646146775.jpg', 'PayStack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.paystack\"}}\r\n', NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 19:59:35'),
(8, 108, 'voguepay', '621e351dea5301646146845.jpg', 'VoguePay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:00:46'),
(9, 109, 'flutterwave', '621e3542201421646146882.jpg', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"demo_publisher_key\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"demo_secret_key\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"demo_encryption_key\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:01:22'),
(10, 110, 'razorpay', '621e3550bd0bc1646146896.jpg', 'RazorPay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:01:36'),
(11, 111, 'stripe_js', '621e355dbf0371646146909.jpg', 'Stripe Storefront', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:01:49'),
(12, 112, 'instamojo', '621e3568c0fb01646146920.jpg', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:02:00'),
(13, 501, 'blockchain', '621e3576a10911646146934.jpg', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:02:14'),
(14, 502, 'blockio', '621e35d66c78d1646147030.jpg', 'Block.io', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"covidvai2020\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.blockio\"}}', NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:03:50'),
(15, 503, 'coinpayments', '621e35e2ecf891646147042.jpg', 'CoinPayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"7638eebaf4061b7f7cdfceb14046318bbdabf7e2f64944773d6550bd59f70274\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"Cb6dee7af8Eb9E0D4123543E690dA3673294147A5Dc8e7a621B5d484a3803207\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:04:03'),
(16, 504, 'coinpayments_fiat', '621e35ef924e71646147055.jpg', 'CoinPayments Fiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:04:15'),
(17, 505, 'coingate', '621e360db509b1646147085.jpg', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:04:45'),
(18, 506, 'coinbase_commerce', '621e36221cea21646147106.jpg', 'Coinbase Commerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.coinbase_commerce\"}}', NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:05:06'),
(24, 113, 'paypal_sdk', '621e362d9864a1646147117.jpg', 'Paypal Express', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:05:17'),
(25, 114, 'stripe_v3', '621e363aa12da1646147130.jpg', 'Stripe Checkout', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51HuxFUHyGzEKoTKAfIosswAQduMOGU4q4elcNr8OE6LoBZcp2MHKalOW835wjRiF6fxVTc7RmBgatKfAt1Qq0heb00rUaCOd2T\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51HuxFUHyGzEKoTKAueAuF9BrMDA5boMcpJLLt0vu4q3QdPX5isaGudKNe6OyVjZP1UugpYd6JA7i7TczRWsbutaP004YmBiSp5\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"w5555\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.stripe_v3\"}}', NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:05:30'),
(27, 115, 'mollie', '621e364cc21d41646147148.jpg', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"admin@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2022-03-01 20:05:48'),
(30, 116, 'cashmaal', '621e3655ebbd01646147157.png', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.cashmaal\"}}', NULL, NULL, NULL, '2022-03-01 20:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_code` int(11) DEFAULT NULL,
  `gateway_alias` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `per_question_paid` decimal(28,16) DEFAULT 0.0000000000000000,
  `sitename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(4) NOT NULL DEFAULT 0,
  `agree_policy` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `secure_password` tinyint(4) NOT NULL DEFAULT 0,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `social_login` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'social login',
  `social_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_template` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sys_version` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bv_price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_bv` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_bv` int(11) DEFAULT NULL,
  `cary_flash` tinyint(1) DEFAULT NULL,
  `notice` blob DEFAULT NULL,
  `free_user_notice` blob DEFAULT NULL,
  `matching_bonus_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matching_when` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid` datetime DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `bal_trans_per_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `bal_trans_fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `per_question_paid`, `sitename`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_api`, `base_color`, `secondary_color`, `mail_config`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `agree_policy`, `secure_password`, `registration`, `social_login`, `social_credential`, `active_template`, `sys_version`, `bv_price`, `total_bv`, `max_bv`, `cary_flash`, `notice`, `free_user_notice`, `matching_bonus_time`, `matching_when`, `last_paid`, `last_cron`, `bal_trans_per_charge`, `bal_trans_fixed_charge`, `created_at`, `updated_at`) VALUES
(1, '1.0000000000000000', 'biSurv', 'USD', '$', 'no-reply@viserlab.com', '<table style=\"color: rgb(0, 0, 0); font-family: &quot;Times New Roman&quot;; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(0, 23, 54); text-decoration-style: initial; text-decoration-color: initial;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#001736\"><tbody><tr><td valign=\"top\" align=\"center\"><table class=\"mobile-shell\" width=\"650\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"td container\" style=\"width: 650px; min-width: 650px; font-size: 0pt; line-height: 0pt; margin: 0px; font-weight: normal; padding: 55px 0px;\"><div style=\"text-align: center;\"><img src=\"https://i.imgur.com/C9IS7Z1.png\" style=\"height: 240 !important;width: 338px;margin-bottom: 20px;\"></div><table style=\"width: 650px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td style=\"padding-bottom: 10px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"tbrr p30-15\" style=\"padding: 60px 30px; border-radius: 26px 26px 0px 0px;\" bgcolor=\"#000036\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td style=\"color: rgb(255, 255, 255); font-family: Muli, Arial, sans-serif; font-size: 20px; line-height: 46px; padding-bottom: 25px; font-weight: bold;\">Hi {{name}} ,</td></tr><tr><td style=\"color: rgb(193, 205, 220); font-family: Muli, Arial, sans-serif; font-size: 20px; line-height: 30px; padding-bottom: 25px;\">{{message}}</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table style=\"width: 650px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"p30-15 bbrr\" style=\"padding: 50px 30px; border-radius: 0px 0px 26px 26px;\" bgcolor=\"#000036\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody><tr><td class=\"text-footer1 pb10\" style=\"color: rgb(0, 153, 255); font-family: Muli, Arial, sans-serif; font-size: 18px; line-height: 30px; text-align: center; padding-bottom: 10px;\">© 2021 ViserLab. All Rights Reserved.</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>', '****************', '7376E7', '47498f', '{\"name\":\"php\"}', 0, 1, 0, 0, 0, 1, 0, 1, 0, '{\"google_client_id\":\"53929591142-l40gafo7efd9onfe6tj545sf9g7tv15t.apps.googleusercontent.com\",\"google_client_secret\":\"BRdB3np2IgYLiy4-bwMcmOwN\",\"fb_client_id\":\"277229062999748\",\"fb_client_secret\":\"1acfc850f73d1955d14b282938585122\"}', 'basic', NULL, '10', '100', 500, 1, 0x3c683520636c6173733d22636172642d7469746c6520746578742d7072696d61727922207374796c653d226d617267696e2d626f74746f6d3a20302e3572656d3b20666f6e742d7765696768743a203630303b206c696e652d6865696768743a20312e333b20666f6e742d73697a653a20323070783b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c2073616e732d73657269663b2070616464696e673a203070783b207472616e736974696f6e3a20616c6c20302e337320656173652030733b20636f6c6f723a2072676228302c203137352c20323535292021696d706f7274616e743b223e416c6c2055736572206e6f746963653c2f68353e3c683520636c6173733d22636172642d7469746c6520746578742d7072696d61727922207374796c653d226d617267696e2d626f74746f6d3a20302e3572656d3b206c696e652d6865696768743a20312e333b2070616464696e673a203070783b207472616e736974696f6e3a20616c6c20302e337320656173652030733b223e3c7020636c6173733d22636172642d7465787422207374796c653d22223e3c666f6e7420636f6c6f723d22233231323532392220666163653d224f70656e2053616e732c2073616e732d7365726966223e4d756c74692d6c6576656c206d61726b6574696e672069732061206469766572736520616e642076617269656420696e6475737472792c20656d706c6f79696e67206d616e7920646966666572656e74207374727563747572657320616e64206d6574686f6473206f662073656c6c696e672e20416c74686f756768207468657265206d6179206265207369676e69666963616e7420646966666572656e63657320696e20686f77206d756c74692d6c6576656c206d61726b65746572732073656c6c2074686569722070726f6475637473206f722073657276696365732c20636f726520636f6e73756d65722070726f74656374696f6e207072696e6369706c657320617265206170706c696361626c6520746f206576657279206d656d626572206f662074686520696e6475737472792e2054686520436f6d6d697373696f6e207374616666206f66666572732074686973206e6f6e2d62696e64696e672067756964616e636520746f20617373697374206d756c74692d6c6576656c206d61726b657465727320696e206170706c79696e672074686f736520636f7265207072696e6369706c657320746f20746865697220627573696e657373207072616374696365732e3c2f666f6e743e3c62723e3c2f703e3c2f68353e, 0x3c683520636c6173733d22636172642d7469746c6520746578742d7072696d61727922207374796c653d226d617267696e2d626f74746f6d3a20302e3572656d3b20666f6e742d7765696768743a203630303b206c696e652d6865696768743a20312e333b20666f6e742d73697a653a20323070783b20666f6e742d66616d696c793a202671756f743b4f70656e2053616e732671756f743b2c2073616e732d73657269663b2070616464696e673a203070783b207472616e736974696f6e3a20616c6c20302e337320656173652030733b20636f6c6f723a2072676228302c203137352c20323535292021696d706f7274616e743b223e467265652055736572206e6f746963653c2f68353e3c7020636c6173733d22636172642d7465787422207374796c653d22223e3c666f6e7420636f6c6f723d22233231323532392220666163653d224f70656e2053616e732c2073616e732d7365726966223e4d756c74692d6c6576656c206d61726b6574696e672069732061206469766572736520616e642076617269656420696e6475737472792c20656d706c6f79696e67206d616e7920646966666572656e74207374727563747572657320616e64206d6574686f6473206f662073656c6c696e672e20416c74686f756768207468657265206d6179206265207369676e69666963616e7420646966666572656e63657320696e20686f77206d756c74692d6c6576656c206d61726b65746572732073656c6c2074686569722070726f6475637473206f722073657276696365732c20636f726520636f6e73756d65722070726f74656374696f6e207072696e6369706c657320617265206170706c696361626c6520746f206576657279206d656d626572206f662074686520696e6475737472792e2054686520436f6d6d697373696f6e207374616666206f66666572732074686973206e6f6e2d62696e64696e672067756964616e636520746f20617373697374206d756c74692d6c6576656c206d61726b657465727320696e206170706c79696e672074686f736520636f7265207072696e6369706c657320746f20746865697220627573696e657373207072616374696365732e3c2f666f6e743e3c62723e3c2f703e, 'daily', '1', NULL, '2021-03-18 10:13:43', '10.00000000', '5.00000000', NULL, '2022-03-01 08:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', 'home', 'templates.basic.', '[\"about\",\"service\",\"how_it_works\",\"mlm_plan\",\"top_earner\",\"counter\",\"latest_trx\",\"blog\",\"testimonial\",\"subscribe\",\"payment\"]', 1, '2020-07-11 06:23:58', '2022-02-28 07:12:53'),
(2, 'About', 'about-us', 'templates.basic.', '[\"about\",\"top_earner\",\"how_it_works\",\"faq\"]', 0, '2020-07-11 06:35:35', '2022-02-28 07:35:18'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2022-02-23 06:38:03'),
(5, 'Contact', 'contact', 'templates.basic.', '[\"faq\"]', 1, '2020-10-22 01:14:53', '2022-02-23 06:02:24'),
(6, 'Faq', 'faq', 'templates.basic.', '[\"faq\"]', 0, '2020-12-01 03:27:45', '2020-12-01 03:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `price` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `bv` int(10) DEFAULT NULL,
  `ref_com` decimal(16,8) DEFAULT NULL,
  `tree_com` decimal(16,8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Radio, 2=>Checkbox	',
  `custom_input` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>No, 1=>Yes',
  `custom_input_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>Not Required, 1=>Required',
  `custom_question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(11) NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `supportticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `users` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_report` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_earning` decimal(28,8) DEFAULT 0.00000000,
  `completed_survey` int(10) DEFAULT 0,
  `ref_id` int(11) NOT NULL DEFAULT 0,
  `pos_id` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `plan_id` int(11) NOT NULL DEFAULT 0,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `total_ref_com` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `total_binary_com` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `total_invest` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `survey_earning`, `completed_survey`, `ref_id`, `pos_id`, `position`, `plan_id`, `firstname`, `lastname`, `username`, `email`, `mobile`, `balance`, `total_ref_com`, `total_binary_com`, `total_invest`, `password`, `image`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0.00000000', 0, 0, 0, 0, 1, 'Test', 'User', 'username', 'admin@viserlab.com', '5454545454', '36.03000000', '5.00000000', '0.00000000', '0.00000000', '$2y$10$iYUAGXweGfvmToMQHdjbkO2yA1f2J9SsL.d9iGntxMoLdagNchSTi', '1645944324_username.jpg', '{\"address\":\"Address a\",\"city\":\"City\",\"state\":\"State\",\"zip\":\"1208\",\"country\":\"Bahrain\"}', 1, 1, 1, NULL, NULL, 0, 1, 'SPLN5KQGIWVNYYC5', NULL, NULL, NULL, NULL, '2022-03-01 08:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_extras`
--

CREATE TABLE `user_extras` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `paid_left` int(10) NOT NULL DEFAULT 0,
  `paid_right` int(10) NOT NULL DEFAULT 0,
  `free_left` int(10) NOT NULL DEFAULT 0,
  `free_right` int(10) NOT NULL DEFAULT 0,
  `bv_left` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `bv_right` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_extras`
--

INSERT INTO `user_extras` (`id`, `user_id`, `paid_left`, `paid_right`, `free_left`, `free_right`, `bv_left`, `bv_right`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 5, 4, '10.00000000', '0.00000000', '2020-12-10 15:20:43', '2022-03-01 07:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `location`, `browser`, `os`, `longitude`, `latitude`, `country`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', ' - -  -  ', 'Chrome', 'Windows 10', '', '', '', '', '2022-03-01 08:49:20', '2022-03-01 08:49:20'),
(2, 1, '127.0.0.1', ' - -  -  ', 'Chrome', 'Windows 10', '', '', '', '', '2022-03-01 08:50:25', '2022-03-01 08:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(18,8) NOT NULL,
  `charge` decimal(18,8) NOT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `after_charge` decimal(18,8) NOT NULL,
  `withdraw_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(18,8) DEFAULT NULL,
  `max_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(18,8) DEFAULT NULL,
  `rate` decimal(18,8) DEFAULT NULL,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bv_logs`
--
ALTER TABLE `bv_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_extras`
--
ALTER TABLE `user_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bv_logs`
--
ALTER TABLE `bv_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_extras`
--
ALTER TABLE `user_extras`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
