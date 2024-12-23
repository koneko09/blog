-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 09:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `myblog_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `disabled` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category`, `slug`, `disabled`) VALUES
(2, 'Crime', 'crime', 0),
(3, 'shoe strings', 'shoe-strings', 0),
(4, 'Sports', 'sports', 0),
(5, 'Lifestyle', 'lifestyle', 0),
(6, 'New category', 'new-category', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `image`, `date`, `slug`) VALUES
(1, 8, 3, 'Triá»ƒn khai dá»± Ã¡n LÆ°u trá»¯ Code lÃªn Hosting 2', '<h1>ðŸ“ Ná»™i dung chÃ­nh</h1><h1>1. Upload Source Code lÃªn Hosting</h1><blockquote>\r\n<p>ÄÃ¢y lÃ  bÆ°á»›c Ä‘áº§u Ä‘á»ƒ táº£i dá»± Ã¡n lÃªn Hosting</p>\r\n</blockquote><h2>1. Äáº§u tiÃªn truy cáº­p vÃ o Báº£ng Ä‘iá»u khiá»ƒn cá»§a tÃ i khoáº£n Infinityfree Ä‘Ã£ Ä‘Äƒng kÃ½</h2><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/343cbc8d-9b6b-4312-871a-879bdf088af8/Screenshot_2024-02-27_215650.png\" alt=\"Screenshot 2024-02-27 215650.png\"></p><h2>2. Äi Ä‘áº¿n thÆ° má»¥c htdocs rá»“i táº¡o 1 thÆ° má»¥c má»›i Ä‘áº·t tÃªn lÃ  admin0 (hoáº·c tÃªn tuá»³ Ã½)</h2><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/aaf2dc41-be95-4e7b-905f-a83d59ad7b2d/Screenshot_2024-02-27_221437.png\" alt=\"Screenshot 2024-02-27 221437.png\"></p><h2>3. Táº£i lÃªn source code TinyManager dÃ¹ng Ä‘á»ƒ quáº£n lÃ½ Hosting thay cho trÃ¬nh quáº£n lÃ½ máº·c Ä‘á»‹nh</h2><p><a href=\"https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/27a09b76-bbe5-4afd-9675-433be041c173/TinyManager.zip\">TinyManager.zip</a></p><ul>\r\n<li>Giáº£i nÃ©n file zip á»Ÿ trÃªn rá»“i táº£i vÃ o thÆ° má»¥c admin0 vá»«a táº¡o. TinyManager gá»“m cÃ³ cÃ¡c file â€œconfig.php, index.php, translation.jsonâ€.</li>\r\n<li>Sau Ä‘Ã³ má»Ÿ tab trÃ¬nh duyá»‡t má»›i, truy cáº­p vÃ o Ä‘Æ°á»ng dáº«n mydomain/admin0. Trong Ä‘Ã³ mydomain lÃ  tÃªn miá»n cá»§a báº¡n.</li>\r\n</ul><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/0ef47c83-2f37-4c9f-b49b-09038b441a25/Untitled.png\" alt=\"Untitled\"></p><blockquote>\r\n<p>TÃªn Ä‘Äƒng nháº­p vÃ  máº­t kháº©u máº·c Ä‘á»‹nh Ä‘á»u lÃ  user.</p>\r\n</blockquote><ul>\r\n<li>Báº¡n cÃ³ thá»ƒ Ä‘á»•i tÃªn Ä‘Äƒng nháº­p vÃ  máº­t kháº©u á»Ÿ pháº§n config (admin0/config). Truy cáº­p <a href=\"https://tinyfilemanager.github.io/docs/pwd.html\">https://tinyfilemanager.github.io/docs/pwd.html</a> Ä‘á»ƒ táº¡o máº­t kháº©u mÃ£ hoÃ¡, má»—i má»™t cáº·p tÃ i khoáº£n máº­t kháº©u ngÄƒn cÃ¡ch nhau bá»Ÿi 1 dáº¥u pháº©y â€,â€. Cáº·p cuá»‘i khÃ´ng cáº§n cÃ³ dáº¥u pháº©y</li>\r\n<li>VD:</li>\r\n</ul><pre><code class=\"language-php\">// ÄÄƒng nháº­p tÃªn ngÆ°á»i dÃ¹ng vÃ  máº­t kháº©u\r\n// NgÆ°á»i dÃ¹ng: array(\'TÃªn ngÆ°á»i dÃ¹ng\' => \'Máº­t kháº©u\', \'TÃªn ngÆ°á»i dÃ¹ng2\' => \'Máº­t kháº©u2\', ...)\r\n// Táº¡o hÃ m bÄƒm máº­t kháº©u an toÃ n - <https://tinyfilemanager.github.io/docs/pwd.html>\r\n$auth_users = array(\r\n    \'tinvu\' => \'Máº­t kháº©u sau khi Ä‘Æ°á»£c mÃ£ hoÃ¡\',\r\n    \'user\' => \'$2y$10$Fg6Dz8oH9fPoZ2jJan5tZuv6Z4Kp7avtQ9bDfrdRntXtPeiMAZyGO\', //12345\r\n    \'user\' => \'$2y$10$Vb4cJ2PhNGMepuU6MKRejO4afgMJRFj1nIXtGVj5rYk/F.SFx5VaC\' //user\r\n);\r\n</code></pre><h2>4. Táº£i lÃªn Source Code vÃ  giáº£n nÃ©n lÃªn hosting</h2><ul>\r\n<li>Sau khi Ä‘Äƒng nháº­p vÃ o, ta chá»n Táº£i lÃªn, táº£i tá»‡p source code lÃªn tá»« URL (Upload from URL).</li>\r\n</ul><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/e0d6c5ae-42e2-4c10-88e6-679e07a4e87b/Untitled.png\" alt=\"Untitled\"></p><ul>\r\n<li>Sau Ä‘Ã³ Ä‘iá»n URL sau vÃ o:</li>\r\n</ul><pre><code class=\"language-markdown\"><https://dl.dropboxusercontent.com/scl/fi/ur5hy3zqmqqiwnnob5dv7/Stikked-PHP-8._Ho-n_Ch-nh.zip?rlkey=z8s6mugdfqnuw1lyd1kgtzz5y&dl=0>\r\n</code></pre><ul>\r\n<li>Sau khi táº£i lÃªn thÃ nh cÃ´ng, quay láº¡i Ä‘á»ƒ Ä‘á»•i tÃªn file vá»«a táº£i lÃªn</li>\r\n</ul><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/0ef0831d-7638-40a3-9a82-f95b3a755529/Untitled.png\" alt=\"Untitled\"></p><blockquote>\r\n<p>XoÃ¡ bá» nhá»¯ng pháº§n thá»«a sau Ä‘uÃ´i zip</p>\r\n</blockquote><ul>\r\n<li>Báº¥m vÃ o file .zip, chá»n giáº£i nÃ©n, chá» Ä‘á»£i vÃ  sau khi giáº£i nÃ©n thÃ nh cÃ´ng ta Ä‘Ã£ upload source lÃªn Hosting xong.</li>\r\n</ul><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/bec71d2b-da28-4d19-8b06-e70611e39a83/Untitled.png\" alt=\"Untitled\"></p><h1></h1><h2></h2><ul>\r\n<li></li>\r\n<li></li>\r\n</ul><h1>2. Chá»‰nh sá»­a pháº§n config cá»§a Source</h1><h2>1. Truy cáº­p vÃ o tá»‡p â€œstikked.phpâ€ á»Ÿ Ä‘Æ°á»ng dáº«n \"/application/config/stikked.php\" Ä‘á»ƒ chá»‰nh sá»­a DATABASE phÃ¹ há»£p</h2><p>Ta cáº§n chá»‰nh sá»­a 5 trÆ°á»ng chÃ­nh nhÆ° sau:</p><ul>\r\n<li>$config[\'base_url\'] = \'<a href=\"http://duongdandensource/\">http://duongdandensource/</a>\'; (Ä‘Æ°á»ng dáº«n Ä‘áº¿n trang web, trong Ä‘Ã³ duongdandensource lÃ  chá»‰ Ä‘áº¿n nÆ¡i báº¡n lÆ°u trá»¯ source code vá»«a táº£i lÃªn, báº¯t buá»™c cÃ³ dáº¥u gáº¡ch chÃ©o á»Ÿ cuá»‘i.</li>\r\n</ul><blockquote>\r\n<p>VD: <a href=\"http://tinvu.rf.gd/\">http://tinvu.rf.gd/</a></p>\r\n</blockquote><p><img src=\"///////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/9ad52b84-af90-4142-8741-dbef6a3e3105/Untitled.png\" alt=\"Untitled\"></p><ul>\r\n<li>$config[\'db_hostname\'] = \'hostname\'; (hostname tÆ°Æ¡ng á»©ng hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL HOSTNAME: <a href=\"http://sql212.infinityfree.com\">sql212.infinityfree.com</a></li>\r\n<li>$config[\'db_database\'] = \'dbname\'; (dbname lÃ  tÃªn cÆ¡ sá»Ÿ dá»¯ liá»‡u cá»§a báº¡n) VD: epiz_34188701_test</li>\r\n<li>$config[\'db_username\'] = \'username\'; (username tÆ°Æ¡ng á»©ng vá»›i hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL USERNAME: epiz_34188701)</li>\r\n<li>$config[\'db_password\'] = \'pass\'; (pass tÆ°Æ¡ng á»©ng vá»›i hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL PASSWORD, báº¥m Show/Hide Ä‘á»ƒ hiá»‡n ra)</li>\r\n</ul><p>á»ž trÃªn lÃ  nhá»¯ng pháº§n chÃ­nh quang trá»ng, ngoÃ i ra trong tá»‡p â€œstikked.phpâ€ cÃ²n nhiá»u pháº§n ná»¯a, vd má»™t vÃ i thá»© nhÆ°:</p><ul>\r\n<li>$config[\'site_name\'] = \'LÆ°u trá»¯ Code\'; //Chá»‰nh sá»­a tÃªn cá»§a trang web</li>\r\n<li>$config[\'theme\'] = \'stikkedizr\'; //Chá»‰nh theme cá»§a trang web, cÃ³ nhiá»u theme Ä‘á»ƒ lá»±a chá»n nhÆ°: default, bootstrap, gabdark, gabdark3, geocities, snowkat, stikkedizr, cleanwhite, i386;</li>\r\n</ul><p>NhÆ°ng theo tÃ´i tháº¥y theme stikkedizr hoáº·c bootstrap lÃ  á»•n nháº¥t vÃ¬ cÃ¡c lá»—i Ä‘Ã£ Ä‘Æ°á»£c tÃ´i sá»­a cho há»£p vá»›i phiÃªn báº£n PhP Ä‘á»i cao hiá»‡n táº¡i vÃ  mÃ£ nguá»“n má»Ÿ nÃ y Ä‘Ã£ khÃ´ng Ä‘Æ°á»£c tÃ¡c giáº£ báº£o trÃ¬ tá»« 2019.</p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<!-- notionvc: 9c3a1bcb-61b9-4bf3-bc34-6477ea780f1b --></p><h1>TrÃªn Ä‘Ã¢y lÃ  nhá»¯ng hÆ°á»›ng dáº«n cÆ¡ báº£n nháº¥t, khi ráº£nh tÃ´i sáº½ cáº­p nháº­t thÃªm bÃ¬a viáº¿t nÃ y. Cáº£m Æ¡n vÃ¬ Ä‘Ã£ Ä‘á»c!</h1>', 'uploads/17347968121.jpg', '2024-12-19 23:19:07', 'sdf'),
(2, 8, 5, 'Triá»ƒn khai dá»± Ã¡n LÆ°u trá»¯ Code lÃªn Hosting 1', '<h1>ðŸ“ Ná»™i dung chÃ­nh</h1><h1>1. Upload Source Code lÃªn Hosting</h1><blockquote>\r\n<p>ÄÃ¢y lÃ  bÆ°á»›c Ä‘áº§u Ä‘á»ƒ táº£i dá»± Ã¡n lÃªn Hosting</p>\r\n</blockquote><h2>1. Äáº§u tiÃªn truy cáº­p vÃ o Báº£ng Ä‘iá»u khiá»ƒn cá»§a tÃ i khoáº£n Infinityfree Ä‘Ã£ Ä‘Äƒng kÃ½</h2><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/343cbc8d-9b6b-4312-871a-879bdf088af8/Screenshot_2024-02-27_215650.png\" alt=\"Screenshot 2024-02-27 215650.png\"></p><h2>2. Äi Ä‘áº¿n thÆ° má»¥c htdocs rá»“i táº¡o 1 thÆ° má»¥c má»›i Ä‘áº·t tÃªn lÃ  admin0 (hoáº·c tÃªn tuá»³ Ã½)</h2><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/aaf2dc41-be95-4e7b-905f-a83d59ad7b2d/Screenshot_2024-02-27_221437.png\" alt=\"Screenshot 2024-02-27 221437.png\"></p><h2>3. Táº£i lÃªn source code TinyManager dÃ¹ng Ä‘á»ƒ quáº£n lÃ½ Hosting thay cho trÃ¬nh quáº£n lÃ½ máº·c Ä‘á»‹nh</h2><p><a href=\"https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/27a09b76-bbe5-4afd-9675-433be041c173/TinyManager.zip\">TinyManager.zip</a></p><ul>\r\n<li>Giáº£i nÃ©n file zip á»Ÿ trÃªn rá»“i táº£i vÃ o thÆ° má»¥c admin0 vá»«a táº¡o. TinyManager gá»“m cÃ³ cÃ¡c file â€œconfig.php, index.php, translation.jsonâ€.</li>\r\n<li>Sau Ä‘Ã³ má»Ÿ tab trÃ¬nh duyá»‡t má»›i, truy cáº­p vÃ o Ä‘Æ°á»ng dáº«n mydomain/admin0. Trong Ä‘Ã³ mydomain lÃ  tÃªn miá»n cá»§a báº¡n.</li>\r\n</ul><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/0ef47c83-2f37-4c9f-b49b-09038b441a25/Untitled.png\" alt=\"Untitled\"></p><blockquote>\r\n<p>TÃªn Ä‘Äƒng nháº­p vÃ  máº­t kháº©u máº·c Ä‘á»‹nh Ä‘á»u lÃ  user.</p>\r\n</blockquote><ul>\r\n<li>Báº¡n cÃ³ thá»ƒ Ä‘á»•i tÃªn Ä‘Äƒng nháº­p vÃ  máº­t kháº©u á»Ÿ pháº§n config (admin0/config). Truy cáº­p <a href=\"https://tinyfilemanager.github.io/docs/pwd.html\">https://tinyfilemanager.github.io/docs/pwd.html</a> Ä‘á»ƒ táº¡o máº­t kháº©u mÃ£ hoÃ¡, má»—i má»™t cáº·p tÃ i khoáº£n máº­t kháº©u ngÄƒn cÃ¡ch nhau bá»Ÿi 1 dáº¥u pháº©y â€,â€. Cáº·p cuá»‘i khÃ´ng cáº§n cÃ³ dáº¥u pháº©y</li>\r\n<li>VD:</li>\r\n</ul><pre><code class=\"language-php\">// ÄÄƒng nháº­p tÃªn ngÆ°á»i dÃ¹ng vÃ  máº­t kháº©u\r\n// NgÆ°á»i dÃ¹ng: array(\'TÃªn ngÆ°á»i dÃ¹ng\' => \'Máº­t kháº©u\', \'TÃªn ngÆ°á»i dÃ¹ng2\' => \'Máº­t kháº©u2\', ...)\r\n// Táº¡o hÃ m bÄƒm máº­t kháº©u an toÃ n - <https://tinyfilemanager.github.io/docs/pwd.html>\r\n$auth_users = array(\r\n    \'tinvu\' => \'Máº­t kháº©u sau khi Ä‘Æ°á»£c mÃ£ hoÃ¡\',\r\n    \'user\' => \'$2y$10$Fg6Dz8oH9fPoZ2jJan5tZuv6Z4Kp7avtQ9bDfrdRntXtPeiMAZyGO\', //12345\r\n    \'user\' => \'$2y$10$Vb4cJ2PhNGMepuU6MKRejO4afgMJRFj1nIXtGVj5rYk/F.SFx5VaC\' //user\r\n);\r\n</code></pre><h2>4. Táº£i lÃªn Source Code vÃ  giáº£n nÃ©n lÃªn hosting</h2><ul>\r\n<li>Sau khi Ä‘Äƒng nháº­p vÃ o, ta chá»n Táº£i lÃªn, táº£i tá»‡p source code lÃªn tá»« URL (Upload from URL).</li>\r\n</ul><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/e0d6c5ae-42e2-4c10-88e6-679e07a4e87b/Untitled.png\" alt=\"Untitled\"></p><ul>\r\n<li>Sau Ä‘Ã³ Ä‘iá»n URL sau vÃ o:</li>\r\n</ul><pre><code class=\"language-markdown\"><https://dl.dropboxusercontent.com/scl/fi/ur5hy3zqmqqiwnnob5dv7/Stikked-PHP-8._Ho-n_Ch-nh.zip?rlkey=z8s6mugdfqnuw1lyd1kgtzz5y&dl=0>\r\n</code></pre><ul>\r\n<li>Sau khi táº£i lÃªn thÃ nh cÃ´ng, quay láº¡i Ä‘á»ƒ Ä‘á»•i tÃªn file vá»«a táº£i lÃªn</li>\r\n</ul><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/0ef0831d-7638-40a3-9a82-f95b3a755529/Untitled.png\" alt=\"Untitled\"></p><blockquote>\r\n<p>XoÃ¡ bá» nhá»¯ng pháº§n thá»«a sau Ä‘uÃ´i zip</p>\r\n</blockquote><ul>\r\n<li>Báº¥m vÃ o file .zip, chá»n giáº£i nÃ©n, chá» Ä‘á»£i vÃ  sau khi giáº£i nÃ©n thÃ nh cÃ´ng ta Ä‘Ã£ upload source lÃªn Hosting xong.</li>\r\n</ul><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/bec71d2b-da28-4d19-8b06-e70611e39a83/Untitled.png\" alt=\"Untitled\"></p><h1></h1><h2></h2><ul>\r\n<li></li>\r\n<li></li>\r\n</ul><h1>2. Chá»‰nh sá»­a pháº§n config cá»§a Source</h1><h2>1. Truy cáº­p vÃ o tá»‡p â€œstikked.phpâ€ á»Ÿ Ä‘Æ°á»ng dáº«n \"/application/config/stikked.php\" Ä‘á»ƒ chá»‰nh sá»­a DATABASE phÃ¹ há»£p</h2><p>Ta cáº§n chá»‰nh sá»­a 5 trÆ°á»ng chÃ­nh nhÆ° sau:</p><ul>\r\n<li>$config[\'base_url\'] = \'<a href=\"http://duongdandensource/\">http://duongdandensource/</a>\'; (Ä‘Æ°á»ng dáº«n Ä‘áº¿n trang web, trong Ä‘Ã³ duongdandensource lÃ  chá»‰ Ä‘áº¿n nÆ¡i báº¡n lÆ°u trá»¯ source code vá»«a táº£i lÃªn, báº¯t buá»™c cÃ³ dáº¥u gáº¡ch chÃ©o á»Ÿ cuá»‘i.</li>\r\n</ul><blockquote>\r\n<p>VD: <a href=\"http://tinvu.rf.gd/\">http://tinvu.rf.gd/</a></p>\r\n</blockquote><p><img src=\"////https://prod-files-secure.s3.us-west-2.amazonaws.com/fbf2eaee-761e-41f1-b325-a78ca6c578dd/9ad52b84-af90-4142-8741-dbef6a3e3105/Untitled.png\" alt=\"Untitled\"></p><ul>\r\n<li>$config[\'db_hostname\'] = \'hostname\'; (hostname tÆ°Æ¡ng á»©ng hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL HOSTNAME: <a href=\"http://sql212.infinityfree.com\">sql212.infinityfree.com</a></li>\r\n<li>$config[\'db_database\'] = \'dbname\'; (dbname lÃ  tÃªn cÆ¡ sá»Ÿ dá»¯ liá»‡u cá»§a báº¡n) VD: epiz_34188701_test</li>\r\n<li>$config[\'db_username\'] = \'username\'; (username tÆ°Æ¡ng á»©ng vá»›i hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL USERNAME: epiz_34188701)</li>\r\n<li>$config[\'db_password\'] = \'pass\'; (pass tÆ°Æ¡ng á»©ng vá»›i hÃ¬nh áº£nh trÃªn lÃ  ná»™i dung á»Ÿ pháº§n MYSQL PASSWORD, báº¥m Show/Hide Ä‘á»ƒ hiá»‡n ra)</li>\r\n</ul><p>á»ž trÃªn lÃ  nhá»¯ng pháº§n chÃ­nh quang trá»ng, ngoÃ i ra trong tá»‡p â€œstikked.phpâ€ cÃ²n nhiá»u pháº§n ná»¯a, vd má»™t vÃ i thá»© nhÆ°:</p><ul>\r\n<li>$config[\'site_name\'] = \'LÆ°u trá»¯ Code\'; //Chá»‰nh sá»­a tÃªn cá»§a trang web</li>\r\n<li>$config[\'theme\'] = \'stikkedizr\'; //Chá»‰nh theme cá»§a trang web, cÃ³ nhiá»u theme Ä‘á»ƒ lá»±a chá»n nhÆ°: default, bootstrap, gabdark, gabdark3, geocities, snowkat, stikkedizr, cleanwhite, i386;</li>\r\n</ul><p>NhÆ°ng theo tÃ´i tháº¥y theme stikkedizr hoáº·c bootstrap lÃ  á»•n nháº¥t vÃ¬ cÃ¡c lá»—i Ä‘Ã£ Ä‘Æ°á»£c tÃ´i sá»­a cho há»£p vá»›i phiÃªn báº£n PhP Ä‘á»i cao hiá»‡n táº¡i vÃ  mÃ£ nguá»“n má»Ÿ nÃ y Ä‘Ã£ khÃ´ng Ä‘Æ°á»£c tÃ¡c giáº£ báº£o trÃ¬ tá»« 2019.</p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<!-- notionvc: 9c3a1bcb-61b9-4bf3-bc34-6477ea780f1b --></p><h1>TrÃªn Ä‘Ã¢y lÃ  nhá»¯ng hÆ°á»›ng dáº«n cÆ¡ báº£n nháº¥t, khi ráº£nh tÃ´i sáº½ cáº­p nháº­t thÃªm bÃ¬a viáº¿t nÃ y. Cáº£m Æ¡n vÃ¬ Ä‘Ã£ Ä‘á»c!</h1>', 'uploads/173481380633.jpg', '2024-12-19 23:19:07', 'sdf'),
(6, 11, 3, 'Test bÃ i viáº¿t ngÆ°á»i dÃ¹ng', '<p>DÃ¹ngd</p>', 'uploads/173482369520.jpg', '2024-12-22 04:12:00', 'test-bai-vit-ngi-dung'),
(7, 11, 5, 'BÃ i sá»‘ 5', '<p>BÃ i sá»‘ 5</p>', 'uploads/173483066928.jpg', '2024-12-22 08:24:08', 'bai-s-5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `image`, `date`, `role`) VALUES
(8, 'dtdung0711@gmail.com', 'dtdung0711@gmail.com', '$2y$10$.fO8STIqmroPJrXjHesw.OHD5yTV.BGbHxw7Gfh4zdGgc5iNUIxXy', '0359438636', 'uploads/avatar/ThuPhap.jpg', '2024-12-09 12:48:02', 'admin'),
(11, 'DÅ©ng', 'user@gmail.com', '$2y$10$1BoLBGd8CvJs85OJ9sWMY.azMYI6NoIkR2M5tk0QCYcU6TfaBI5ZS', '', 'uploads/avatar/boarding-pass.jpg', '2024-12-22 04:09:22', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
