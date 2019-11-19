# deposit-integration-test
 
1) create database name = "integration"

2) insert default account 

-- --------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `integration`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `no` char(10) NOT NULL,
  `pin` char(4) NOT NULL,
  `name` char(50) NOT NULL,
  `balance` int(11) NOT NULL,
  `waterCharge` int(11) NOT NULL,
  `electricCharge` int(11) NOT NULL,
  `phoneCharge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1212312121', '9999', 'Mary Happy', 1006596, 500, 1290, 560),
('9999999999', '1111', 'Test Real', 900000, 500, 199, 222);
COMMIT;
