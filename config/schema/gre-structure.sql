-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 07-Nov-2017 às 00:31
-- Versão do servidor: 5.5.57-0+deb8u1
-- PHP Version: 7.0.24-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `distritos`
--

CREATE TABLE IF NOT EXISTS `distritos` (
`id` int(11) NOT NULL,
  `inep_codigo` int(11) DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=530010806 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolas`
--

CREATE TABLE IF NOT EXISTS `escolas` (
`id` int(11) NOT NULL,
  `rede` tinyint(1) NOT NULL COMMENT 'Indica se a escola pertence à rede mantida pelo GRE',
  `inep_codigo` varchar(8) NOT NULL,
  `situacao_id` int(11) NOT NULL,
  `nome_longo` varchar(100) NOT NULL,
  `nome_curto` varchar(50) NOT NULL,
  `nome_juridico` varchar(200) NOT NULL,
  `endereco_cep` varchar(8) NOT NULL,
  `endereco_distrito_id` int(11) NOT NULL,
  `endereco_logradouro` varchar(100) NOT NULL,
  `endereco_numero` varchar(10) DEFAULT NULL,
  `endereco_complemento` varchar(50) DEFAULT NULL,
  `endereco_bairro` varchar(60) NOT NULL,
  `infra_agua_filtrada` tinyint(1) NOT NULL DEFAULT '1',
  `infra_agua_abast_publica` tinyint(1) NOT NULL DEFAULT '0',
  `infra_agua_abast_poco` tinyint(1) NOT NULL DEFAULT '0',
  `infra_agua_abast_cacimba` tinyint(1) NOT NULL DEFAULT '0',
  `infra_agua_abast_fonte` tinyint(1) NOT NULL DEFAULT '0',
  `infra_agua_abast_inexistente` tinyint(1) NOT NULL DEFAULT '0',
  `infra_energia_abast_publica` tinyint(1) NOT NULL DEFAULT '0',
  `infra_energia_abast_gerador` tinyint(1) NOT NULL DEFAULT '0',
  `infra_energia_abast_outros` tinyint(1) NOT NULL DEFAULT '0',
  `infra_energia_abast_inexistente` tinyint(1) NOT NULL DEFAULT '0',
  `infra_esgoto_rede` tinyint(1) NOT NULL DEFAULT '0',
  `infra_esgoto_fossa` tinyint(1) NOT NULL DEFAULT '0',
  `infra_esgoto_inexistente` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_coleta` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_queima` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_joga` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_recicla` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_enterra` tinyint(1) NOT NULL DEFAULT '0',
  `infra_lixo_outros` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_almoxarifado` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_alojamento_aluno` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_alojamento_professor` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_area_verde` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_auditorio` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_banheiro_acessivel` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_banheiro_infantil` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_banheiro_chuveiro` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_banheiro_dentro` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_banheiro_fora` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_bercario` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_biblioteca` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_cozinha` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_vias_deficientes` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_despensa` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_lab_ciencias` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_lab_informatica` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_lavanderia` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_parque_infantil` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_patio_coberto` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_patio_descoberto` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_quadra_coberta` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_quadra_descoberta` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_refeitorio` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_sala_leitura` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_sala_diretoria` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_sala_professores` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_sala_recursos` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_sala_secretaria` tinyint(1) NOT NULL DEFAULT '0',
  `infra_dep_nenhuma` tinyint(1) NOT NULL DEFAULT '0',
  `infra_equip_parabolica` int(11) NOT NULL DEFAULT '0',
  `infra_equip_dvd` int(11) NOT NULL DEFAULT '0',
  `infra_equip_som` int(11) NOT NULL DEFAULT '0',
  `infra_equip_tv` int(11) NOT NULL DEFAULT '0',
  `infra_equip_copiadora` int(11) NOT NULL DEFAULT '0',
  `infra_equip_fax` int(11) NOT NULL DEFAULT '0',
  `infra_equip_impressora` int(11) NOT NULL DEFAULT '0',
  `infra_equip_impressora_multi` int(11) NOT NULL DEFAULT '0',
  `infra_equip_filmadora` int(11) NOT NULL DEFAULT '0',
  `infra_equip_projetor` int(11) NOT NULL DEFAULT '0',
  `infra_equip_retroprojetor` int(11) NOT NULL DEFAULT '0',
  `infra_equip_videocassete` int(11) NOT NULL DEFAULT '0',
  `infra_equip_computador` int(11) NOT NULL DEFAULT '0',
  `infra_pc_alunos` int(11) NOT NULL DEFAULT '0',
  `infra_pc_admin` int(11) NOT NULL DEFAULT '0',
  `infra_internet` tinyint(1) NOT NULL DEFAULT '0',
  `infra_internet_banda_larga` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indica se a escola pertence à rede de ensino gerenciada pelo GRE',
  `leg_criacao` varchar(100) DEFAULT NULL,
  `leg_denominacao` varchar(100) DEFAULT NULL,
  `fone_1` varchar(20) DEFAULT NULL,
  `fone_2` varchar(20) DEFAULT NULL,
  `fone_3` varchar(20) DEFAULT NULL,
  `fone_4` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Escolas da rede';

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_locais`
--

CREATE TABLE IF NOT EXISTS `escola_locais` (
`id` int(11) NOT NULL,
  `escola_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `escola_local_tipo_id` int(11) NOT NULL,
  `predio_ocupacao_forma_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_local_compartilhamentos`
--

CREATE TABLE IF NOT EXISTS `escola_local_compartilhamentos` (
`id` int(11) NOT NULL,
  `escola_local_id` int(11) NOT NULL,
  `escola_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_local_tipos`
--

CREATE TABLE IF NOT EXISTS `escola_local_tipos` (
`id` int(11) NOT NULL COMMENT 'Tipos de locais de funcionamento das escolas',
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_salas`
--

CREATE TABLE IF NOT EXISTS `escola_salas` (
`id` int(11) NOT NULL,
  `escola_local_id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola_situacoes`
--

CREATE TABLE IF NOT EXISTS `escola_situacoes` (
`id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL COMMENT 'Descrição curta da situação da Escola.',
  `descricao` text COMMENT 'Descrição longa da situação.',
  `_webapp_label_style` varchar(20) DEFAULT NULL COMMENT 'Alias para estilização do label no webapp',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Situações possíveis para uma Escola.';

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
`id` int(11) NOT NULL,
  `inep_codigo` int(11) DEFAULT NULL,
  `uf_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5300109 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
`id` int(11) NOT NULL,
  `inep_codigo` int(11) DEFAULT NULL,
  `alpha2` varchar(2) DEFAULT NULL,
  `alpha3` varchar(45) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `nacionalidade` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `predio_ocupacao_formas`
--

CREATE TABLE IF NOT EXISTS `predio_ocupacao_formas` (
`id` int(11) NOT NULL COMMENT 'Formas de ocupação de um prédio\n',
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reconhecimentos`
--

CREATE TABLE IF NOT EXISTS `reconhecimentos` (
`id` int(11) NOT NULL,
  `escola_id` int(11) NOT NULL,
  `curso` varchar(60) NOT NULL,
  `ato` varchar(60) NOT NULL,
  `validade` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Reconhecimentos de cursos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `ufs`
--

CREATE TABLE IF NOT EXISTS `ufs` (
`id` int(11) NOT NULL,
  `inep_codigo` int(11) DEFAULT NULL,
  `sigla` varchar(2) DEFAULT NULL,
  `nome` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distritos`
--
ALTER TABLE `distritos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_distrito_municipio_idx` (`municipio_id`);

--
-- Indexes for table `escolas`
--
ALTER TABLE `escolas`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_escola_escola_situacao_idx` (`situacao_id`), ADD KEY `fk_escola_endereco_distrito_idx` (`endereco_distrito_id`);

--
-- Indexes for table `escola_locais`
--
ALTER TABLE `escola_locais`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_escola_locais_escolas_idx` (`escola_id`), ADD KEY `fk_escola_locais_escola_local_tipos_idx` (`escola_local_tipo_id`), ADD KEY `fk_escola_local_predio_ocupacao_forma_idx` (`predio_ocupacao_forma_id`);

--
-- Indexes for table `escola_local_compartilhamentos`
--
ALTER TABLE `escola_local_compartilhamentos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_escola_local_compartilhamento_escola_local_idx` (`escola_local_id`), ADD KEY `fk_escola_local_compartilhamento_escola_idx` (`escola_id`);

--
-- Indexes for table `escola_local_tipos`
--
ALTER TABLE `escola_local_tipos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escola_salas`
--
ALTER TABLE `escola_salas`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sala_escola_local_idx` (`escola_local_id`);

--
-- Indexes for table `escola_situacoes`
--
ALTER TABLE `escola_situacoes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_municipios_ufs1_idx` (`uf_id`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predio_ocupacao_formas`
--
ALTER TABLE `predio_ocupacao_formas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reconhecimentos`
--
ALTER TABLE `reconhecimentos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_reconhecimentos_escolas1_idx` (`escola_id`);

--
-- Indexes for table `ufs`
--
ALTER TABLE `ufs`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distritos`
--
ALTER TABLE `distritos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=530010806;
--
-- AUTO_INCREMENT for table `escolas`
--
ALTER TABLE `escolas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `escola_locais`
--
ALTER TABLE `escola_locais`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `escola_local_compartilhamentos`
--
ALTER TABLE `escola_local_compartilhamentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `escola_local_tipos`
--
ALTER TABLE `escola_local_tipos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tipos de locais de funcionamento das escolas',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `escola_salas`
--
ALTER TABLE `escola_salas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `escola_situacoes`
--
ALTER TABLE `escola_situacoes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5300109;
--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `predio_ocupacao_formas`
--
ALTER TABLE `predio_ocupacao_formas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Formas de ocupação de um prédio\n',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reconhecimentos`
--
ALTER TABLE `reconhecimentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ufs`
--
ALTER TABLE `ufs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `distritos`
--
ALTER TABLE `distritos`
ADD CONSTRAINT `fk_distrito_municipio` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escolas`
--
ALTER TABLE `escolas`
ADD CONSTRAINT `fk_escola_endereco_distrito` FOREIGN KEY (`endereco_distrito_id`) REFERENCES `distritos` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_escola_escola_situacao` FOREIGN KEY (`situacao_id`) REFERENCES `escola_situacoes` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola_locais`
--
ALTER TABLE `escola_locais`
ADD CONSTRAINT `fk_escola_local_escola` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_escola_local_escola_local_tipo` FOREIGN KEY (`escola_local_tipo_id`) REFERENCES `escola_local_tipos` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_escola_local_predio_ocupacao_forma` FOREIGN KEY (`predio_ocupacao_forma_id`) REFERENCES `predio_ocupacao_formas` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola_local_compartilhamentos`
--
ALTER TABLE `escola_local_compartilhamentos`
ADD CONSTRAINT `fk_escola_local_compartilhamento_escola` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_escola_local_compartilhamento_escola_local` FOREIGN KEY (`escola_local_id`) REFERENCES `escola_locais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `escola_salas`
--
ALTER TABLE `escola_salas`
ADD CONSTRAINT `fk_sala_escola_local` FOREIGN KEY (`escola_local_id`) REFERENCES `escola_locais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `municipios`
--
ALTER TABLE `municipios`
ADD CONSTRAINT `fk_municipio_uf` FOREIGN KEY (`uf_id`) REFERENCES `ufs` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `reconhecimentos`
--
ALTER TABLE `reconhecimentos`
ADD CONSTRAINT `fk_reconhecimentos_escolas1` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
