-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 10:28 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `inserirAluno` (IN `_nome` VARCHAR(60), IN `_apelido` VARCHAR(60), IN `_dataNascimento` DATE, IN `_genero` ENUM("M","F"), IN `_necEspecial` ENUM("nao","sim"), IN `_descricao` TEXT, IN `_idEncarregado` BIGINT, IN `_tipoDocumento` VARCHAR(45), IN `_nrDocumento` VARCHAR(20), IN `_rua` VARCHAR(60), IN `_bairro` VARCHAR(60), IN `_quarteirao` VARCHAR(10), IN `_avenida` VARCHAR(60), IN `_nrCasa` INT(10))  begin

declare idActual bigint; 
declare turma varchar(20);
declare idade int(1);
declare alterar bigint;
declare referencia int;
declare entidade int;

set idade=year(now())-year(_dataNascimento);
select id into idActual from codigo;
 if(idade=0) then
	set turma=1;
	elseif(idade=1) then
		set turma=2;
		elseif(idade=2) then
			set turma=3;
			elseif(idade=3) then
				set turma=4;
			elseif(idade=4) then
				set turma=5;
			else
				set turma=6;
end if;
	
	insert into aluno (idALuno, nome, apelido, dataNascimento, genero,necEspecial, descricao, idEncarregado, idTurma, created_at, updated_at, tipoDocumento , nrDocumento  )
    values (idActual, _nome, _apelido, _dataNascimento, _genero, _necEspecial, _descricao, _idEncarregado, turma, now(), now(), _tipoDocumento ,  _nrDocumento  );
	
    select gerarReferencia(idActual) into referencia;
    select entidade into entidade from laravel.entidade ;
    
    insert into inscricao (idInscricao, estado, entidade ) values 
    (idActual, "Pendente", entidade);
    
    insert into alunoinscricao (idAluno, idInscricao, referencia, created_at, updated_at) values (idActual, idActual, referencia, now(), now());
    insert into endereco (idAluno, rua, bairro, avenida, quarteirao, numeroCasa, created_at, updated_at) 
    values(idActual, _rua, _bairro, _avenida, _quarteirao, _nrCasa, now(), now() );
    set alterar=idActual+1;
     update encarregado set encarregado.password=idActual where idEncarregado=_idEncarregado;
     update codigo set id=alterar, updated_at=now() where id=idActual; 
     
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserirEncarregado` (IN `_nome` VARCHAR(60), IN `_apelido` VARCHAR(60), IN `_telefone` VARCHAR(15), IN `_email` VARCHAR(100), IN `_password` VARCHAR(40), IN `_genero` ENUM("F","M"), IN `_tipoDocumento` VARCHAR(45), IN `_nrDocumento` VARCHAR(20), IN `_dataNascimento` DATE)  BEGIN
	insert into encarregado (nome, apelido, telefone, email, encarregado.password,tipoDocumento,nrDocumento, genero, dataNascimento, created_at, updated_at)
    values ( _nome, _apelido, _telefone, _email, _password,_tipoDocumento, _nrDocumento, _genero,_dataNascimento, now(), now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserirResponsavel` (IN `_idReponsavel` BIGINT, IN `_nome` VARCHAR(60), IN `_apelido` VARCHAR(60), IN `_telefone` VARCHAR(15), IN `_nomeFoto` VARCHAR(255), IN `_genero` ENUM("F","M"), IN `_idAluno` BIGINT)  BEGIN
	
    insert into responsavel (idReponsavel, nome, apelido,  genero, nomeFoto, created_at, updated_at,  telefone)
    values (_idReponsavel, _nome, _apelido, _genero,_nomeFoto, now(), now(), _telefone);
    
    insert into alunoreponsavel(idAluno, idReponsavel, created_at, updated_at) 
    values(_idAluno, _idReponsavel, now(), now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Reclamar` (`_tipoR` VARCHAR(60), `_descr` TEXT, `_idEnc` BIGINT(20))  BEGIN
	/*declare _cEnc bigint(20);
	set cEnc = 0;*/
   
    if(_idEnc  in(select idEncarregado from Encarregado )) then
		begin
			insert into reclamacao(tipo,descricao,idEncarregado)
			values(_tipoR,_descr,_idEnc);
		end;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ResolverReclamacao` (`_codR` INT(10), `_codFunc` INT(10))  BEGIN
	
    declare resolvida int(2);
	declare verifyCodeF int(10);
    
    select idFuncionario into verifyCodeF from reclamacao where idReclamacao = _codR;
   
    if(_codR in(select idReclamacao from reclamacao)) then
		begin
				
				if((select estado from reclamacao where idReclamacao = _codR) = '0')then
					begin
						update reclamacao set estado = '1' where idReclamacao=_codR;
						update reclamacao set idFuncionario = _codFunc where idReclamacao=_codR;
                        update reclamacao set dataResolucao = now() where idReclamacao=_codR;
                        select "A Reclamacao passou de nao resolvida para resolvida" as sucesso;
					end;
				else
					if(verifyCodeF = _codFunc) then
						begin
							update reclamacao set estado = '0' where idReclamacao=_codR;
							update reclamacao set idFuncionario = null where idReclamacao=_codR;
							update reclamacao set dataResolucao = null  where idReclamacao=_codR;
                            select "A Reclamacao passou de resolvida para nao resolvida" as sucesso;
						end;
						else
							select "Somente pode desfazer as que forem resolvidas por ti." as ERRO;
					end if;
				end if;
		end;
	else
		select "O codigo selecionado da reclamacao nao existe." as ERRO;
	end if;
		
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarInscricao` (IN `_idInscricao` BIGINT, IN `_estado` ENUM("Pendente","Inscrito"), IN `_idFuncionario` INT)  BEGIN
	update inscricao set estado=_estado, idFuncionario=_idFuncionario where idInscrica=_idInscricao;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `gerarReferencia` (`_idAluno` BIGINT(20)) RETURNS VARCHAR(30) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci BEGIN
RETURN concat(_idAluno,month(now()));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminfuncionario`
--

CREATE TABLE `adminfuncionario` (
  `idAdministrador` int(10) UNSIGNED NOT NULL,
  `idFuncionario` int(10) UNSIGNED NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminfuncionario`
--

INSERT INTO `adminfuncionario` (`idAdministrador`, `idFuncionario`, `data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2019-11-20 17:00:17', '2019-11-20 15:00:17', '2019-11-20 15:00:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataNascimento` date NOT NULL,
  `genero` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoDocumento` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nrDocumento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `necEspecial` enum('sim','nao') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nao',
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idEncarregado` bigint(20) UNSIGNED NOT NULL,
  `idTurma` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`idAluno`, `nome`, `apelido`, `dataNascimento`, `genero`, `nomeFoto`, `tipoDocumento`, `nrDocumento`, `necEspecial`, `descricao`, `idEncarregado`, `idTurma`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20190000, 'Kleiton', 'Machanguele', '2017-05-05', 'M', '', '', '', 'nao', '', 1, 2, '2019-10-21 17:53:25', '2019-10-21 17:53:25', NULL),
(20190001, 'Junior', 'Cossa', '2016-06-09', 'M', '', '', '', 'nao', '', 2, 3, '2019-10-21 17:58:38', '2019-10-21 17:58:38', NULL),
(20190002, 'Denise', 'kliton', '2017-06-06', 'F', NULL, 'B.I', '1234123123B', 'nao', '', 4, 2, '2019-10-29 18:18:50', '2019-10-29 18:18:50', NULL),
(20190003, 'derick', 'fernanda', '2017-08-19', 'M', NULL, 'B.I', '123123123r3', 'nao', NULL, 24, 2, '2019-10-30 04:41:15', '2019-10-30 04:41:15', NULL),
(20190004, 'Salmento', 'Feito', '2017-08-19', 'M', NULL, 'B.I', '123412341B2', 'nao', NULL, 29, 2, '2019-10-30 09:59:06', '2019-10-30 09:59:06', NULL),
(20190012, 'jose', 'joel', '2015-08-19', 'M', NULL, 'B.I', '909090123A', 'nao', NULL, 38, 5, '2019-10-30 17:14:36', '2019-10-30 17:14:36', NULL),
(20190013, 'jose', 'qualquer', '2017-08-19', 'M', NULL, 'B.I', '1234121341Bp', 'nao', NULL, 40, 3, '2019-11-21 14:26:33', '2019-11-21 14:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alunodisciplina`
--

CREATE TABLE `alunodisciplina` (
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `idDisciplina` int(10) UNSIGNED NOT NULL,
  `classificacao` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alunoinscricao`
--

CREATE TABLE `alunoinscricao` (
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `idInscricao` bigint(20) UNSIGNED NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `referencia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alunoinscricao`
--

INSERT INTO `alunoinscricao` (`idAluno`, `idInscricao`, `data`, `referencia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20190000, 20190000, '2019-10-18', 0, NULL, NULL, NULL),
(20190001, 20190001, '2019-10-18', 0, '2019-10-21 17:58:38', '2019-10-21 17:58:38', NULL),
(20190002, 20190002, '2019-10-29', 2019000210, '2019-10-29 18:18:50', '2019-10-29 18:18:50', NULL),
(20190003, 20190003, '2019-10-30', 2019000310, '2019-10-30 04:41:15', '2019-10-30 04:41:15', NULL),
(20190004, 20190004, '2019-10-30', 2019000410, '2019-10-30 09:59:06', '2019-10-30 09:59:06', NULL),
(20190012, 20190012, '2019-10-30', 2019001210, '2019-10-30 17:14:37', '2019-10-30 17:14:37', NULL),
(20190013, 20190013, '2019-11-21', 2019001311, '2019-11-21 14:26:33', '2019-11-21 14:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alunomensalidade`
--

CREATE TABLE `alunomensalidade` (
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `idMensalidade` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL DEFAULT '2019-10-18',
  `valorPago` decimal(10,3) NOT NULL,
  `divida` decimal(10,3) NOT NULL,
  `situacao` enum('paga','Naopaga') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alunoreponsavel`
--

CREATE TABLE `alunoreponsavel` (
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `idReponsavel` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alunoreponsavel`
--

INSERT INTO `alunoreponsavel` (`idAluno`, `idReponsavel`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20190001, 1, '2019-10-21 18:15:51', '2019-10-21 18:15:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `codigo`
--

CREATE TABLE `codigo` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codigo`
--

INSERT INTO `codigo` (`id`, `created_at`, `updated_at`) VALUES
(20190014, '2019-10-21 17:15:10', '2019-11-21 14:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(10) UNSIGNED NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `encarregado`
--

CREATE TABLE `encarregado` (
  `idEncarregado` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomeFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `tipoDocumento` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nrDocumento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encarregado`
--

INSERT INTO `encarregado` (`idEncarregado`, `nome`, `apelido`, `telefone`, `email`, `nomeFoto`, `password`, `dataNascimento`, `tipoDocumento`, `nrDocumento`, `genero`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jose', 'Machanguele', '849229123', 'jose@gmail.com', '', '123456', NULL, '', '', 'M', '2019-10-21 17:31:09', NULL, NULL),
(2, 'Denise', 'Cossa', '849229124', 'denise@gmail.com', '', '123456', NULL, '', '', 'F', '2019-10-21 17:36:56', '2019-10-21 17:36:56', NULL),
(4, 'Adelia', 'Chitlango', '849221124', 'adelia@gmail.com', '', '20190002', NULL, '', '', 'F', '2019-10-21 18:02:28', '2019-10-21 18:02:28', NULL),
(24, 'Teste', 'Testando', '841234123', 'klitont81@gmail.com', NULL, '20190003', '2000-02-02', 'Passaporte', '123412341B1', 'M', '2019-10-29 20:36:25', '2019-10-29 20:36:25', NULL),
(29, 'Marcos', 'Fabiao', '849221010', 'kliton1@gmail.com', NULL, '20190004', '2011-08-19', 'B.I', '1234121341B', 'M', '2019-10-30 09:50:44', '2019-10-30 09:50:44', NULL),
(38, 'Abel', 'Joel', '849229754', 'abel@gmail.com', NULL, '20190012', '2000-06-19', 'B.I', '090909123C', 'M', '2019-10-30 16:52:38', '2019-10-30 16:52:38', NULL),
(40, 'Delfim', 'Junior', '841234761', 'junior@gmail.com', NULL, '20190013', '2011-08-19', 'B.I', '1283432341B11', 'M', '2019-11-21 14:25:42', '2019-11-21 14:25:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` bigint(20) UNSIGNED NOT NULL,
  `idAluno` bigint(20) UNSIGNED NOT NULL,
  `rua` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quarteirao` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avenida` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numeroCasa` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`idEndereco`, `idAluno`, `rua`, `bairro`, `quarteirao`, `avenida`, `numeroCasa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20190002, 'Centro piloto', 'Infulene D', '48', 'Acordos de Lusaka', NULL, NULL, NULL, NULL),
(2, 20190003, '15', 'patrice', '45', 'patrice', 12345, '2019-10-30 04:41:15', '2019-10-30 04:41:15', NULL),
(3, 20190004, 'O', 'Patrice', '45', 'Patrice', 123, '2019-10-30 09:59:06', '2019-10-30 09:59:06', NULL),
(11, 20190012, 'Q', 'laulane', '12', 'laulane', 1, '2019-10-30 17:14:37', '2019-10-30 17:14:37', NULL),
(12, 20190013, 'O', 'laulane', '45', 'Patrice', 12, '2019-11-21 14:26:33', '2019-11-21 14:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entidade`
--

CREATE TABLE `entidade` (
  `idEntidade` int(11) NOT NULL,
  `entidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entidade`
--

INSERT INTO `entidade` (`idEntidade`, `entidade`) VALUES
(1, 331201);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(10) UNSIGNED NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeFoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `apelido`, `email`, `genero`, `nomeFoto`, `cargo`, `created_at`, `updated_at`, `deleted_at`, `password`) VALUES
(1, 'salmento', 'chitlango', 'chitlango11@gmail.com', 'M', '', 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'chitlango11');

-- --------------------------------------------------------

--
-- Table structure for table `inscricao`
--

CREATE TABLE `inscricao` (
  `idInscricao` bigint(20) UNSIGNED NOT NULL,
  `estado` enum('Pendente','Inscrito') COLLATE utf8mb4_unicode_ci NOT NULL,
  `idFuncionario` int(10) UNSIGNED DEFAULT NULL,
  `valorPago` decimal(6,2) DEFAULT NULL,
  `entidade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inscricao`
--

INSERT INTO `inscricao` (`idInscricao`, `estado`, `idFuncionario`, `valorPago`, `entidade`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20190000, 'Pendente', NULL, NULL, NULL, '2019-10-21 17:53:25', '2019-10-21 17:53:25', NULL),
(20190001, 'Pendente', NULL, NULL, NULL, '2019-10-21 17:58:38', '2019-10-21 17:58:38', NULL),
(20190002, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190003, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190004, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190005, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190006, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190007, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190008, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190009, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190010, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190011, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190012, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL),
(20190013, 'Pendente', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mensalidade`
--

CREATE TABLE `mensalidade` (
  `idMensalidade` int(10) UNSIGNED NOT NULL,
  `prazo` date NOT NULL,
  `valor` double(10,3) NOT NULL,
  `mes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_10_18_072320_encarregado', 1),
(4, '2019_10_18_104743_funcionario', 1),
(5, '2019_10_18_110227_mensalidade', 1),
(6, '2019_10_18_111844_turma', 1),
(7, '2019_10_18_113013_disciplina', 1),
(8, '2019_10_18_113819_inscricao', 1),
(9, '2019_10_18_164253_aluno', 1),
(10, '2019_10_18_173820_endereco', 1),
(11, '2019_10_18_174927_responsavel', 1),
(12, '2019_10_18_175721_aluno_responsavel', 1),
(13, '2019_10_18_180601_aluno_inscricao', 1),
(14, '2019_10_18_181833_aluno_disciplina', 1),
(15, '2019_10_18_190922_aluno_pagamento', 1),
(16, '2019_10_18_200624_reclamacao', 1),
(17, '2019_10_18_204116_admin_funcionario', 1),
(18, '2019_10_18_205501_professor_disciplina', 1),
(19, '2019_10_20_151506_auto_increment_turma', 2),
(21, '2019_10_21_114822_remove_local_foto', 3),
(22, '2019_10_21_121140_add_column_telefone_responsavel', 4),
(23, '2019_10_21_170231_codigo', 4);

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
-- Table structure for table `professordisciplina`
--

CREATE TABLE `professordisciplina` (
  `idFuncionario` int(10) UNSIGNED NOT NULL,
  `idDisciplina` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reclamacao`
--

CREATE TABLE `reclamacao` (
  `idReclamacao` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataReclamacao` datetime NOT NULL DEFAULT current_timestamp(),
  `dataResolucao` datetime DEFAULT NULL,
  `idEncarregado` bigint(20) UNSIGNED NOT NULL,
  `idFuncionario` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `estado` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsavel`
--

CREATE TABLE `responsavel` (
  `idReponsavel` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsavel`
--

INSERT INTO `responsavel` (`idReponsavel`, `nome`, `apelido`, `genero`, `nomeFoto`, `created_at`, `updated_at`, `deleted_at`, `telefone`) VALUES
(1, 'kliton', 'Tonela', 'M', '', '2019-10-21 18:15:50', '2019-10-21 18:15:50', NULL, '842121211');

-- --------------------------------------------------------

--
-- Table structure for table `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(10) UNSIGNED NOT NULL,
  `designacao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantVagas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turma`
--

INSERT INTO `turma` (`idTurma`, `designacao`, `quantVagas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Azaleia', '30', '2019-10-30 11:18:55', '2019-10-30 11:21:01', NULL),
(2, 'Jasmine', '30', '2019-10-30 11:21:01', '2019-10-30 11:21:01', NULL),
(3, 'Calendula', '30', '2019-10-30 11:21:01', '2019-10-30 11:21:01', NULL),
(4, 'Camelia', '30', '2019-10-30 11:21:01', '2019-10-30 11:21:01', NULL),
(5, 'Cravina', '30', '2019-10-30 11:21:01', '2019-10-30 11:21:01', NULL),
(6, 'Amarilis', '30', '2019-10-30 11:21:01', '2019-10-30 11:21:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `valores`
--

CREATE TABLE `valores` (
  `idValor` int(11) NOT NULL,
  `valorPagar` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminfuncionario`
--
ALTER TABLE `adminfuncionario`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD KEY `adminfuncionario_idfuncionario_foreign` (`idFuncionario`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idAluno`),
  ADD KEY `aluno_idencarregado_foreign` (`idEncarregado`),
  ADD KEY `aluno_idturma_foreign` (`idTurma`);

--
-- Indexes for table `alunodisciplina`
--
ALTER TABLE `alunodisciplina`
  ADD PRIMARY KEY (`idAluno`,`idDisciplina`),
  ADD KEY `alunodisciplina_iddisciplina_foreign` (`idDisciplina`);

--
-- Indexes for table `alunoinscricao`
--
ALTER TABLE `alunoinscricao`
  ADD PRIMARY KEY (`idAluno`,`idInscricao`),
  ADD KEY `alunoinscricao_idinscricao_foreign` (`idInscricao`);

--
-- Indexes for table `alunomensalidade`
--
ALTER TABLE `alunomensalidade`
  ADD PRIMARY KEY (`idAluno`,`idMensalidade`),
  ADD KEY `alunomensalidade_idmensalidade_foreign` (`idMensalidade`);

--
-- Indexes for table `alunoreponsavel`
--
ALTER TABLE `alunoreponsavel`
  ADD PRIMARY KEY (`idAluno`,`idReponsavel`),
  ADD KEY `alunoreponsavel_idreponsavel_foreign` (`idReponsavel`);

--
-- Indexes for table `codigo`
--
ALTER TABLE `codigo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`);

--
-- Indexes for table `encarregado`
--
ALTER TABLE `encarregado`
  ADD PRIMARY KEY (`idEncarregado`),
  ADD UNIQUE KEY `encarregado_telefone_unique` (`telefone`),
  ADD UNIQUE KEY `encarregado_email_unique` (`email`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`),
  ADD KEY `endereco_idaluno_foreign` (`idAluno`);

--
-- Indexes for table `entidade`
--
ALTER TABLE `entidade`
  ADD PRIMARY KEY (`idEntidade`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`idInscricao`),
  ADD KEY `inscricao_idfuncionario_foreign` (`idFuncionario`);

--
-- Indexes for table `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD PRIMARY KEY (`idMensalidade`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `professordisciplina`
--
ALTER TABLE `professordisciplina`
  ADD PRIMARY KEY (`idFuncionario`,`idDisciplina`),
  ADD KEY `professordisciplina_iddisciplina_foreign` (`idDisciplina`);

--
-- Indexes for table `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD PRIMARY KEY (`idReclamacao`),
  ADD KEY `reclamacao_idencarregado_foreign` (`idEncarregado`),
  ADD KEY `reclamacao_idfuncionario_foreign` (`idFuncionario`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`idReponsavel`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`);

--
-- Indexes for table `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`idValor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idAluno` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20190014;

--
-- AUTO_INCREMENT for table `codigo`
--
ALTER TABLE `codigo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20190016;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encarregado`
--
ALTER TABLE `encarregado`
  MODIFY `idEncarregado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `entidade`
--
ALTER TABLE `entidade`
  MODIFY `idEntidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `idInscricao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20190014;

--
-- AUTO_INCREMENT for table `mensalidade`
--
ALTER TABLE `mensalidade`
  MODIFY `idMensalidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reclamacao`
--
ALTER TABLE `reclamacao`
  MODIFY `idReclamacao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `idReponsavel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminfuncionario`
--
ALTER TABLE `adminfuncionario`
  ADD CONSTRAINT `adminfuncionario_idfuncionario_foreign` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`);

--
-- Constraints for table `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_idencarregado_foreign` FOREIGN KEY (`idEncarregado`) REFERENCES `encarregado` (`idEncarregado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_idturma_foreign` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alunodisciplina`
--
ALTER TABLE `alunodisciplina`
  ADD CONSTRAINT `alunodisciplina_idaluno_foreign` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `alunodisciplina_iddisciplina_foreign` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Constraints for table `alunoinscricao`
--
ALTER TABLE `alunoinscricao`
  ADD CONSTRAINT `alunoinscricao_idaluno_foreign` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `alunoinscricao_idinscricao_foreign` FOREIGN KEY (`idInscricao`) REFERENCES `inscricao` (`idInscricao`);

--
-- Constraints for table `alunomensalidade`
--
ALTER TABLE `alunomensalidade`
  ADD CONSTRAINT `alunomensalidade_idaluno_foreign` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `alunomensalidade_idmensalidade_foreign` FOREIGN KEY (`idMensalidade`) REFERENCES `mensalidade` (`idMensalidade`);

--
-- Constraints for table `alunoreponsavel`
--
ALTER TABLE `alunoreponsavel`
  ADD CONSTRAINT `alunoreponsavel_idaluno_foreign` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `alunoreponsavel_idreponsavel_foreign` FOREIGN KEY (`idReponsavel`) REFERENCES `responsavel` (`idReponsavel`);

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_idaluno_foreign` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`);

--
-- Constraints for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_idfuncionario_foreign` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`);

--
-- Constraints for table `professordisciplina`
--
ALTER TABLE `professordisciplina`
  ADD CONSTRAINT `professordisciplina_iddisciplina_foreign` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`),
  ADD CONSTRAINT `professordisciplina_idfuncionario_foreign` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`);

--
-- Constraints for table `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD CONSTRAINT `reclamacao_idencarregado_foreign` FOREIGN KEY (`idEncarregado`) REFERENCES `encarregado` (`idEncarregado`),
  ADD CONSTRAINT `reclamacao_idfuncionario_foreign` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionario` (`idFuncionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
