-- Generation Time: 20-Abr-2018 às 21:38
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numero` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `apelido`, `email`, `numero`) VALUES
(53, 'asad', 'sdsaf', 'ddg', 241424),
(54, 'dgdg', 'dgdg', 'dgdg', 343434),
(55, 'dgdg', 'dgdg', 'dgdg', 343434),
(56, 'dgdg', 'dgdg', 'dgdg', 343434),
(57, 'dgdg', 'dgdg', 'dgdg', 343434),
(58, 'Tatiana Tozzi', 'Tati', 'tatitozzi@hotmail.com', 1111),
(59, 'Projeto DW', 'opi', 'projetodw2@g', 44444),
(60, 'Projeto DW', 'opi', 'projetodw2@g', 44444),
(61, 'Projeto DW', 'opi', 'projetodw2@g', 44444),
(62, 'Projeto DW', 'opi', 'projetodw2@g', 44444),
(63, 'Projeto DW', 'opi', 'projetodw2@g', 44444),
(64, 'Projeto DW', 'dw', 'projetodw2@gmail.com', 47996061);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `pessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_pessoa_telefone` (`pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `telefones`
--
ALTER TABLE `telefones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `telefones`
--
ALTER TABLE `telefones`
  ADD CONSTRAINT `pk_pessoa_telefone` FOREIGN KEY (`pessoa`) REFERENCES `pessoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
