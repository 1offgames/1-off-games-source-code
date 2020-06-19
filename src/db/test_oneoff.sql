-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 12:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_oneoff`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `customer_id`, `quantity`) VALUES
(4, 2, 1),
(3, 3, 1),
(25, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Action/Adventure'),
(2, 'Strategy'),
(3, 'Role-Playing Game'),
(4, 'Sports'),
(5, 'Simulator'),
(6, 'Shooter'),
(7, 'Fighting'),
(8, 'Racing');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(96) NOT NULL,
  `customer_username` varchar(96) NOT NULL,
  `customer_password` varchar(96) NOT NULL,
  `customer_email` varchar(96) NOT NULL,
  `customer_address` varchar(96) NOT NULL,
  `customer_province` varchar(96) NOT NULL,
  `customer_country` varchar(96) NOT NULL,
  `customer_postal` varchar(96) NOT NULL,
  `customer_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_username`, `customer_password`, `customer_email`, `customer_address`, `customer_province`, `customer_country`, `customer_postal`, `customer_admin`) VALUES
(2, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', '404 admin street, Adminville', 'AD', 'The United States of Admins', '404404', 1),
(3, 'user', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'user@user.ca', '200 User ave, Usertown', 'US', 'CA', '200200', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_total` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `order_status`, `order_total`) VALUES
(1, 3, '2020-06-03', 3, '135.35'),
(2, 3, '2020-06-04', 1, '67.78');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`order_id`, `product_id`, `order_quantity`, `order_price`) VALUES
(1, 13, 1, '99.00'),
(2, 22, 1, '34.00'),
(1, 30, 1, '57.00'),
(1, 45, 1, '45.00');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`platform_id`, `platform_name`) VALUES
(1, 'Windows PC'),
(2, 'Playstation 2'),
(3, 'Playstation 3'),
(4, 'Mobile'),
(5, 'MacOS'),
(6, 'Xbox 360'),
(7, 'Xbox One'),
(8, 'Nintendo 64'),
(9, 'Atari 2600'),
(10, 'Super Nintendo Entertainment System'),
(11, 'Sega Mega Drive'),
(12, 'Nintendo Entertainment System');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(96) NOT NULL,
  `product_quantity` varchar(96) NOT NULL,
  `product_price` decimal(11,2) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_quantity`, `product_price`, `product_description`, `product_image`, `platform_id`, `category_id`) VALUES
(3, 'Heroes of Might and Magic 3: Complete', '6', '81.00', 'Heroes of Might and Magic 3: Complete is a turn based strategy game for people with more free time than they know what to do with and a strong resistance to pulmonary embolisms. This game will keep any numbers obsessed nerd glued to their chair for so lon', 'heroes-of-might-and-magic-3-completewindows-pc.png', 1, 2),
(4, 'Spyro 2: Ripto\'s Rage', '8', '50.00', 'Save Spyroland in this purple dragon and dragonfly thing related adventure. I think there is a cheetah or something as well. Stop the evil Rypto from carrying out his evil plan of doing something you\'ll forget about 5 minutes into the game. Collect insane', 'spyro-2-riptos-rageplaystation-2.png', 2, 1),
(5, 'Grand Theft Auto 2', '14', '30.00', 'Finally Rockstar has created the epitome of car thieving game play with Grand Theft Auto 2. It\'s stunning 2D graphics are the bleeding edgy of technology, and a graphical marvel that is unlikely to be surpassed for many years to come. Oh, yeah, steal cars', 'grand-theft-auto-2playstation-2.png', 2, 1),
(6, 'World of Warcraft: Battlechest', '2', '70.00', 'This now rare collection of games contains three of Blizzards most profitable titles. Don\'t settle for getting the games for free when you buy the current expansion, act now to get this rare edition that is in a cardboard box and ads on it.', 'world-of-warcraft-battlechestwindows-pc.png', 1, 3),
(7, 'The Orange Box', '4', '70.00', 'The Orange Box is a video game compilation containing five games developed by Valve. Two of the games included, Half-Life 2 and its first stand-alone expansion, Episode One, had previously been released as separate products. Three new games were also incl', 'the-orange-boxwindows-pc.png', 1, 6),
(8, 'Stunt Copter', '22', '5.00', 'A game where you fly a helicopter around and drop people into a moving carriage. If you miss you can kill the horse and its sad but otherwise its a great game.', 'stunt-coptermacos.png', 5, 4),
(9, 'NanoSaur', '15', '12.00', 'An action packed third person shooter developed by Pengea Software exclusive for the Mac gaming platform! This timeless unforgettable treasure has you take control of a raptor with a jet pack and laser gun. Enough said.', 'nanosaurmacos.png', 5, 6),
(10, 'Dinosaur Game', '4', '0.00', 'Tap the screen to control a powerful tyrannosaurus rex as he deftly avoids cacti and birds, the most well known predators of the otherwise unstoppable Tyrannosaurus.', 'dinosaur-gamemobile.png', 4, 1),
(12, 'Grand Theft Auto San Andreas', '3', '90.00', 'Fight for your home in this epic third person shooter created by the legendary rockstar. Enjoy an in depth story with twists, turns, and betray by your childhood friends. Oops. I didn\'t mean to spoil that. I\'m sorry.', 'grand-theft-auto-san-andreasplaystation-2.png', 2, 6),
(13, 'Deus Ex', '7', '40.00', 'An unforgettable first person RPG, this tactical and high fidelity game will blow your mind with its branching story and monotonic protagonist.  Stop terrorists and disarm the bomb in this exciting action adenture game by Ion Storm.', 'deus-exwindows-pc.png', 1, 3),
(14, 'Terraria', '45', '10.00', 'This game is amazing and everyone can enjoy it for a million reasons. A game about building, exploring, collecting, fishing, golfing, and building elevators to hell, the game truely has something for everyone and an incredibly charming graphic style and u', 'terrariawindows-pc.png', 1, 1),
(15, 'The Sims 2', '6', '60.00', 'Commonly accepted as the best Sims game before they ruined it, The Sims is a relaxing-until-ti\'s not simulator game where you take care of staggeringly stupid AI characters known as Sims, who seem unable to do even the most basic tasks without setting fir', 'the-sims-2windows-pc.png', 1, 5),
(16, 'The Elder Scrolls III: Morrowind', '3', '80.00', 'A genera defining title, the ambitious Elder Scrolls III: Morrowind is one of the first games to immerse the player in a in depth story and world of freedom with stunning 3D graphics and intense action packed battles that are for sure not just dice rolls.', 'the-elder-scrolls-iii-morrowindwindows-pc.png', 1, 3),
(17, 'Dead Island: Riptide Collectors Edition', '8', '20.00', 'See the products that murdered a publishers reputation due to highly questionable physical content choices! See the game that has more hype behind it than interesting gameplay elements! Proudly never see your friends again after displaying a torn up women', 'dead-island-riptide-collectors-editionwindows-pc.png', 1, 3),
(18, 'Gauntlet Dark Legacy', '2', '120.00', 'Smash buttons in this crazy action adventure RPG choas simulator. Throw obscene amounts of weapons and drink poison bottles as you progress through a vague but serviceable storyline in this classic dungeon crawler.', 'gauntlet-dark-legacyplaystation-2.png', 2, 1),
(19, 'Roller Coaster Tycoon 2', '78', '5.00', 'This special edition of Roller Coaster Rycoon 2 still smells like promotional cereal. Take control of your fantasy theme part as you build rides and attractions and keep your park afloat. Balanced breakfast not included.', 'roller-coaster-tycoon-2windows-pc.png', 1, 5),
(20, 'Sim Ant', '5', '25.00', 'Firaxus presents the most realistic insect simulating game ever created! This PC classic allows you to take control of and ant and try to defend your colony from anys but in red.', 'sim-antwindows-pc.png', 1, 5),
(21, 'X-Com Enemy Unknown', '2', '90.00', 'This in depth stratagy game combines the action of turn based stratagy game, with the intensity of a real time base building game. Fight off the alien menace with your squad of expendable plasma bait in this intense turn based rage inducer.', 'x-com-enemy-unknownwindows-pc.png', 1, 2),
(22, 'Subnautica', '4', '20.00', 'Swim with the alien fishes in this survival crafting game. There are also large fishes that try to eat you, but the game still somehow manages to be relaxing. Explore the deep mystery of the alien planet and avoid gigantic predators in Subnautica.', 'subnauticawindows-pc.png', 1, 1),
(23, 'Flappy Bird', '6', '450.00', 'The game that was such a huge craze, the creator became overwhelmed and removed it from the store. For some reason this made it valuable, so a bunch of people that don\'t deserve to have money.', 'flappy-birdmobile.png', 4, 4),
(24, 'Star Wars Droid Works', '5', '30.00', 'Build droids and test them in complicated puzzle scnarios in this creative game. Press the dance buttona nd watch the droids groove to the beat! Build famous droids from the movies or creator your own anything is possible.', 'star-wars-droid-workswindows-pc.png', 1, 5),
(25, 'Sacrifice', '2', '30.00', 'This game has Tim Curry in it, which should be enough for you to buy it outright. This third person shooter also offers a branching adventure story, where you can pledge to the deity of your choosing, and battle the enemy dieties for supremacy. It\'s more ', 'sacrificewindows-pc.png', 1, 6),
(26, 'Dark Cloud', '3', '70.00', 'This rare adventure RPG tasks you with rebuilding a world destoryed by a evil dark genie. Rescue villagers and reconstruct houses as you delve into dangerous dungeons to rescue your entire town.', 'dark-cloudplaystation-2.png', 2, 1),
(27, 'Champions of Norrath', '2', '50.00', 'This action adventure explores the dark world of Baulders Gate, as you are tasked with defending a world from dark sorcerers. Feature unprecedented co-op and in depth levelu p systems, this game is sure to be a hit with anyone that happens to have four pl', 'champions-of-norrathplaystation-2.png', 2, 1),
(28, 'God Hand', '2', '120.00', 'This rare game got very little recognition when it launched, but long after it left the shelves it gained a cult following. Praised for it\'s combat, comedic story, and allowing the player to hit enemies in the balls, made it an instant classic to anyone l', 'god-handplaystation-2.png', 2, 7),
(29, 'The King of Fighters 2000', '3', '50.00', 'Released in 2000 as the 2nd installment in the Nests Saga, THE KING OF FIGHTERS 2000 features an improved Striker call system with the Active Striker System, which allows the player to call his striker in any situation', 'the-king-of-fighters-2000playstation-2.png', 2, 1),
(30, 'Atlantis II', '54', '69.00', 'Unlike the original Atlantis. This special run if Atlantis it is much faster, the scoring system has been slightly altered from the original, and enemy ships are worth less than the original version, where the of Atlantis must be protected', 'atlantis-iiatari-2600.png', 9, 2),
(31, 'Conker\'s Bad Fur Day', '35', '80.00', 'The day after his 21st birthday bash, Conker\'s sporting the worst hangover ever, and he just can\'t seem to find his way home. Prepare to stagger through randy, raunchy, raucous scenarios crammed full of bad manners', 'conkers-bad-fur-daynintendo-64.png', 8, 1),
(32, 'The Adventures of Batman and Robin', '55', '78.00', 'The Adventures of Batman and Robin is a series of video games released between 1994 and 1995 featuring the DC comic characterc Batman and Robin based on Batman: The Animated Series.', 'the-adventures-of-batman-and-robinsuper-nintendo-entertainment-system.png', 10, 1),
(33, 'E.T. the Extra-Terrestrial', '890', '9.00', 'HELP E.T. GET HOME! What kind of crazy planet is this, anyway? We came here to conduct a simple study of primitive planets, and look what happened! These... Things... came and scared away my friends.', 'et-the-extra-terrestrialatari-2600.png', 9, 5),
(34, 'Blockbuster World Video Game Championship', '1', '999.00', 'The second Blockbuster World Video Game Championships was organised in 1995, splitting contestants into categories - those aged under and including 13, and those aged 14 or above', 'blockbuster-world-video-game-championshipsega-mega-drive.png', 11, 5),
(35, 'The Flintstones - The Surprise At Dinosaur Peak', '15', '50.00', 'The Flintstones - The Surprise at dinosaur peak is believed to have been released in North America exclusively to Blockbuster Video as a rental title', 'the-flintstones-the-surprise-at-dinosaur-peaknintendo-entertainment-system.png', 12, 5),
(36, 'Air Raid', '44', '3.00', 'Air Raid is a 1982 shoot them up published for the Atari 2600 by Men-A-Vision, the only game released by the company', 'air-raidatari-2600.png', 9, 5),
(37, 'Iron Commando', '12', '45.00', 'Take control or either Jake, a soldier, or Chang Li, a martial arts master, in your quest to stop G.H.O.S.T from capturing a radioactive meteorite', 'iron-commandosuper-nintendo-entertainment-system.png', 10, 1),
(38, 'Magical Pop\'n', '33', '90.00', 'Magical Pop\'n is a side-scrolling action-platform video game developed by Polestar and published by Pack-In-Video exclusively for the Super Famicon in Japan on 10 March, 1995.', 'magical-popnsuper-nintendo-entertainment-system.png', 10, 1),
(39, '1080 Snowboarding', '50', '40.00', 'Prepare to experience te the thrills and chills if the ultimate sport 1080 Snowboarding', '1080-snowboardingnintendo-64.png', 8, 8),
(40, '64 Uzomo', '33', '50.00', 'This is a sumo wrestling game released in Japan in 1997. The gameplay simulate sume wrestling', '64-uzomonintendo-64.png', 8, 7),
(41, 'The Legend of Zelda - Majora\'s Mask', '40', '60.00', 'In The Days a Giant Moon is going to crash into the planet and destroy it. It is up to you, a child named Link to go on a grand adventure and save the day!', 'the-legend-of-zelda-majoras-masknintendo-64.png', 8, 1),
(42, 'The Legend of Zelda - Ocarina of Time', '43', '60.00', 'Join the Legendary Link as he journeys across Hyrule to save the day. Join him as he meets a princess, travels through time, and thwarts the plans of the evil Ganondorf!', 'the-legend-of-zelda-ocarina-of-timenintendo-64.png', 8, 1),
(43, 'Aero Fighters Assault', '44', '3.00', 'Aero Fighters Assault is a combat flight simulator. Need we say more?', 'aero-fighters-assaultnintendo-64.png', 8, 6),
(44, 'AeroGauge', '3', '50.00', 'AeroGauge is a futuristic, sci-fi hovercraft racing game designed for the N64 and released in 1998', 'aerogaugenintendo-64.png', 8, 8),
(45, 'Aidyn Chronicles - The First Mage', '500', '1.00', 'Take after the undertaking of Alaron, stranded during childbirth, taken by the merciful Duke Lloyd and brought up in the Duke\'s mansion as a squire.', 'aidyn-chronicles-the-first-magenintendo-64.png', 8, 3),
(46, 'Air Boarder 64', '5', '70.00', 'Air Boarder is a futuristic hoverboard racing game. Basically you go on a hoverboard and race lots.', 'air-boarder-64nintendo-64.png', 8, 8),
(47, 'All Star Baseball 2000', '66', '66.00', 'It\'s a baseball game where you play baseball. Not much else to say, if you like classic games, and like baseball, this is the game for you!', 'all-star-baseball-2000nintendo-64.png', 8, 4),
(48, 'Mario Kart 64', '55', '70.00', 'Put the petal to the metal in this successor to that Super NES classic, Super Mario Kart. Featuring great graphics, and racing!', 'mario-kart-64nintendo-64.png', 8, 8),
(49, 'All Star Tennis', '5', '8.00', 'All Star Tenis is. You Guessed it! A Tennis Simulation Game!! If you like classic games, that happen to involve tennis, this one\'s for you!', 'all-star-tennisnintendo-64.png', 8, 4),
(50, 'Armorines - Project S.W.A.R.M', '6', '70.00', 'This is a first person shooter where you shoot things. It box art also happens to look super cool. Isn\'t that reason enough to buy this gem of a game?', 'armorines-projectSWARMnintendo-64.png', 8, 6),
(51, 'Beetle Adventure Racing', '50', '90.00', 'Looking for a racing game that will appeal to every racing fan? You\'ve found it! Choosefrom several cool, hip Beetle, each with it\' own strengths and weeknesses. Bottom line? If You like racing, and you like beetles, this one\'s for you!', 'beetle-adventure-racingnintendo-64.png', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_text` varchar(255) DEFAULT NULL,
  `review_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`customer_id`, `product_id`, `review_text`, `review_score`) VALUES
(2, 6, 'admin made a review', 9),
(3, 13, 'test', 9),
(3, 22, 'test', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`customer_id`,`product_id`) USING BTREE,
  ADD KEY `card_product_const` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_customer_const` (`customer_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD KEY `orders_customer_const` (`order_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platform_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_platform_const` (`platform_id`),
  ADD KEY `product_catagory_const` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`customer_id`) USING BTREE,
  ADD KEY `review_owner_const` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `card_product_const` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_customer_const` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_customer_const` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_order_const` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_product_const` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_catagory_const` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `product_platform_const` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`platform_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `review_owner_const` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `review_product_const` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
