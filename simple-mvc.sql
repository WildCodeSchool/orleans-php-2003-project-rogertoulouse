-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : google.sql-pro.online.net
-- Généré le : mer. 13 mai 2020 à 10:19
-- Version du serveur :  5.5.53-0ubuntu0.14.04.1dargor1
-- Version de PHP : 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `google`
--

-- --------------------------------------------------------

--
-- Structure de la table `artworks`
--

CREATE TABLE `artworks` (
                            `id` int(11) NOT NULL,
                            `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                            `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                            `date` date NOT NULL,
                            `category_id` int(11) NOT NULL,
                            `description` text COLLATE utf8_unicode_ci NOT NULL,
                            `size` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
                            `more_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                            `carousel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `artworks`
--

INSERT INTO `artworks` (`id`, `name`, `image`, `date`, `category_id`, `description`, `size`, `more_info`, `carousel`) VALUES
(4, 'Le Jeune Homme au Foulard rouge', 'leJeuneHommeAuFoulardRouge1939.jpg', '1939-01-01', 1, 'C\'est à cette époque que le jeune peintre est remarqué par le poète Max Jacob qui réside, pour son second séjour, à Saint-Benoît-sur-Loire. Ce dernier le met en relation avec \"l\'aristocratie\" de la peinture parisienne : Kahnweiler, Picasso, et Gertrude Stein qui lui achète un grand nombre d’œuvres.\r\nEn 1939, il réalise une série de portraits très vivement colorés, comme \"Le jeune homme au foulard rouge\".', 'H. 75 cm ; L. 56 cm', 'Huile sur toile\r\nMusée des Beaux-Arts d\'Orléans\r\nDon de Marguerite Toulouse', 0),
(5, 'L\'Oiseau Blessé ou La Sologne', 'oiseuBlesseOuLaSologne1971.jpg', '1971-01-01', 2, 'Il se remet complètement en question.\r\n\r\nPeu à peu, il donne du volume et de l\'ampleur aux différents éléments de ses sculptures ; des formes figuratives sont toujours reconnaissables : profil d\'homme, tête de chien ou d\'oiseau, poisson, etc. \r\n\r\n(\"L\'Oiseau blessé\" ou \"La Sologne\" 1971)', '', 'Collection particulière', 0),
(6, 'Portrait de Marcel B', 'portraitMBealu1942.jpg', '1950-01-01', 3, 'Dix fragments inédits des Mémoires de l\'ombre.\r\n\r\nEd. Galerie René Drouin ; 20 mars 1942 ; tiré à 215 ex.\r\n\r\nUn portrait de M. Béalu et 10 illustrations.', '', 'Dessin à l\'encre sur papier\r\n\r\nCollection particulière', 0),
(7, 'Quai Saint Laurent', '2_quai_st_laurent.jpg', '1948-01-01', 4, 'Quai Saint Laurent\r\n\r\nEd. PAB, Alès, 1948\r\n\r\n1948 : édition simple pour quelques amis\r\n\r\n1949 : édition de luxe, avec un dessin en couverture', '', '(épuisé)', 0),
(8, 'La Loire', 'loire.jpg', '1965-01-01', 1, 'Dans les \"arbres-à-fleurs\" et les paysages (\"La Loire\", 1965), il développera plus nettement un thème qui lui deviendra familier : la lutte de la nature contre le monde technologique destructeur de vie.\r\nChaque tableau est traité dans un camaïeu subtil, (bleu, vert, jaune, violet, etc.), éclaboussé de lumière.', 'H. 60 cm ; L. 81 cm', 'Huile sur isorel\r\nCollection particulière', 1),
(9, 'Dans la nature', 'naturec.jpg', '1980-01-01', 1, 'Au cours de cette longue période, il est possible de distinguer plusieurs temps successifs, bien que les limites ne soient pas toujours précises; le peintre a souvent travaillé simultanément dans plusieurs directions. Il suffit d\'observer les éléments constitutifs des tableaux pour saisir les préoccupations du peintre. On reconnaît les symboles de la création industrielle : un bateau, un avion, une auto; et des silhouettes d\'architecture monumentales, aux contours anguleux et agressifs : \"sémaphores\", signaux, cheminées d\'usine. Intégrées à ces silhouettes, on distingue parfois difficilement, des représentations du monde humain, animal ou végétal. Le bestiaire utilisé est assez limité : insecte monstrueux, poisson, profil de tête d\'oiseau ou de \"bête\" (chien ou loup). La végétation est peu présente : fleur ou profil d\'arbre aux branches dénudées. Dans cet environnement hostile, la figure humaine se remarque à peine, réduite à un simple profil ou à un masque qui se découpe sur un espace indéfini; ou encore, petit pantin métallisé, robotisé, renversé, écrasé par la masse de l\'architecture qui le domine, (\"Dans la Nature\", 1980). Mais que ce soit une fleur, un insecte ou un personnage, tous semblent privés à jamais de vie naturelle (\"Taln\", 1984). Le monde technologique est vainqueur. Le peintre visionnaire lance un cri d\'alarme.', 'H. 65 cm ; L. 92 cm', 'Huile sur isorel\r\nCollection particulière', 1),
(10, 'La Table de Repasseuse', 'repasseu.jpg', '1947-01-01', 1, 'La guerre et ses conséquences expliquent peut-être le radical changement de style de l\'après-guerre. A partir de 1945, Roger Toulouse adopte de nouveaux moyens d\'expression picturale.\r\nLes natures mortes tourmentées de cette époque, se caractérisent par des couleurs violentes, juxtaposées, vigoureusement traitées, et par la représentation d\'objets hétéroclites, parfois imaginaires ou difficilement identifiables.\r\nDans \"La table de repasseuse\" (1947), un couteau, une chemise sur une \"jeannette\", un fer à repasser et son support, une boîte à couture d\'où jaillit une paire de ciseaux, sont placés sur une table aux formes anguleuses, irrégulières et fantastiques. Ces objets quotidiens, et par essence inanimés, semblent tordus dans des mouvements convulsifs par une puissante et irrépressible force vitale, ce qui crée un sentiment de malaise et d\'angoisse chez le spectateur.\r\n\r\nCette peinture originale et novatrice est remarquée par Gaston Diehl qui propose au peintre de participer au premier Salon de Mai à Paris en 1945.', 'H. 65 cm ; L. 92.5 cm', 'Huile sur Isorel\r\nMusée des Beaux-Arts d\'Orléans\r\nDon de Marguerite Toulouse', 1);

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

CREATE TABLE `association` (
                               `id` int(11) NOT NULL,
                               `text` text COLLATE latin1_general_ci,
                               `title` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
                               `image` text COLLATE latin1_general_ci,
                               `numberphone` varchar(30) COLLATE latin1_general_ci NOT NULL,
                               `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
                               `email` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `association`
--

INSERT INTO `association` (`id`, `text`, `title`, `image`, `numberphone`, `address`, `email`) VALUES
(1, 'L’association Les Amis de Roger TOULOUSE s’est constituée dans le but d’entretenir la mémoire de l’homme et de maintenir vivante la création originale de l’artiste, de la faire connaître et apprécier par un public toujours plus nombreux, de la faire reconnaître aussi comme étant l’une des plus importantes de l’art contemporain.\r\n\r\nLes objectifs de l’association sont les suivants:\r\n\r\n   éditer une revue qui, grâce aux articles et documents publiés, permettra de rassembler un cercle d’amis motivés par une étude plus approfondie de l’œuvre de Roger TOULOUSE.\r\n\r\n organiser des manifestations pour présenter, faire connaître et reconnaître l’œuvre de l’artiste\r\n\r\n veiller et contribuer à la bonne conservation de l’œuvre (peintures et sculptures)\r\n\r\nrechercher et inventorier les œuvre non répertoriées.\r\n\r\nréunir articles, documents et correspondances de ou sur Roger TOULOUSE.\r\n\r\néditer ou rééditer tout ce qui concerne ou a concerné l’artiste et son œuvre.\r\n\r\nLes Amis de Roger TOULOUSE ont besoin du concours de tous : critiques, collectionneurs, mécènes ...\r\nSi vous avez connu et aimé Roger TOULOUSE, si son œuvre vous émeut, vous surprend, vous interroge, si vous voulez tenter d’approcher le sens de sa création, alors vous avez votre place dans le cercle chaleureux des adhérents de l’association.\r\n\r\nSoyez donc les bienvenus !', 'Qui sommes-nous ?', 'rogertoulouse.jpg', '02 38 54 00 00', '1 rue Fernand Rabier, 45000 Orléans France', 'abel.moittie@wanadoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `biography`
--

CREATE TABLE `biography` (
                             `id` int(11) NOT NULL,
                             `date` date NOT NULL,
                             `info` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `biography`
--

INSERT INTO `biography` (`id`, `date`, `info`) VALUES
(1, '1918-02-19', 'Roger Alphonse Albert Toulouse naît le mardi 19 février à Orléans.'),
(2, '1933-01-02', 'Roger Toulouse suit les cours du soir de l\'Ecole des Beaux-Arts et obtient un premier prix en composition décorative. Il pratique la peinture chez lui avec son frère.'),
(10, '1934-01-01', 'Il reçoit à nouveau un premier prix en composition décorative et suit à plein temps les cours de l\'Ecole des Beaux-Arts à partir d\'octobre.'),
(11, '1935-01-01', 'Au début de l\'année, Roger est très affecté par la mort de son frère. II obtient encore plusieurs prix à l\'Ecole des Beaux-Arts et, à la rentrée, il s\'inscrit au cours d\'architecture.'),
(12, '1936-01-01', 'Roger Toulouse remporte cinq premiers prix à l\'Ecole des Beaux-Arts. Il fait à temps partiel des petits travaux pour gagner un peu d\'argent et se perfectionner. Dans l\'ambiance du Front Populaire, il adhère avec plusieurs de ses camarades aux Jeunesses universitaires antifascistes.'),
(17, '1937-01-01', 'Il participe au Salon des artistes orléanais et le marchand de couleur Lecomte lui propose d\'exposer une quinzaine de peintures dans son magasin. Peu après, Roger se rend à Saint-Benoît pour rencontrer le poète Max Jacob qui a remarqué l\'originalité de ses œuvres. C\'est le début de relations constantes avec le poète qui se poursuivront jusqu\'à sa mort en mars 1944. En juillet, il remporte quatre premiers prix et un deuxième prix à l\'Ecole des Beaux-Arts. Durant l\'été, il visite à Paris les importantes expositions de peinture organisées pour l\'Exposition internationale. Roger Toulouse abandonne ses études d\'architecture et début novembre, il rencontre Kahnweiler et Picasso, puis Georges Maratier, directeur de la galerie de Beaune, qui prend ses œuvres en dépôt. Peu après, la collectionneuse et romancière américaine Gertrude Stein lui rend visite à Orléans et achète un grand nombre de peintures qui partiront aux Etats-Unis. Georges Maratier prend le jeune artiste en contrat à raison de quatre toiles par mois.'),
(18, '1938-01-01', 'Roger Toulouse participe à plusieurs expositions de groupe à la galerie de Beaune et à l\'étranger (à Prague, en Italie, en Angleterre). Maratier lui organise une exposition personnelle du 16 mai au 31 juillet. Les critiques sont encourageantes et André Salmon rédige une notice biographique pour le dictionnaire des peintres Benezit. Le 20 juin, Roger épouse Marguerite Texier en présence de Max Jacob et du poète Marcel Béalu. Le jeune ménage s\'installe chez les parents de Marguerite. En octobre, Roger participe au Salon des Surindépendants.'),
(19, '1939-01-01', 'Du 11 au 31 juillet, une deuxième exposition personnelle de Roger Toulouse se tient à la galerie de Beaune. A la déclaration de guerre, la galerie ferme et Roger, mobilisé comme secrétaire d\'état-major, part dans la région de Bourges avant d\'être affecté dans le Sud-Ouest'),
(20, '1940-01-01', 'Durant sa mobilisation, il dessine beaucoup et peint un peu. Il revient à Orléans début octobre et retrouve à Paris Maratier, qui le fait exposer à la galerie de Berri.'),
(21, '1941-01-01', 'Max Jacob met son jeune ami en relation avec les poètes regroupés sous le vocable des Amis de Rochefort. En juin, les beaux-parents de Roger Toulouse s\'installent au 42, quai Saint-Laurent, à Orléans, où ils aménagent un nouvel atelier pour l\'artiste. En novembre, Maratier prend la direction de la galerie René Drouin, place Vendôme, et il expose à nouveau des toiles de Roger.'),
(22, '1942-01-01', 'Inquiet des persécutions qui frappent sa famille, Max Jacob s\'installe au début de l\'année à Orléans, chez les Texier. Roger fait alors le fameux portrait du Poète à l\'orchidée. Grâce à Georges Maratier et Gaston Diehl, il participe en janvier, à la galerie Berri-Raspail, à une importante manifestation: Les étapes du nouvel art contemporain. Fin mars, la galerie René Drouin édite Dix fragments inédits des Mémoires de l\'ombre de Marcel Béalu, comportant onze illustrations par Roger Toulouse. Gaston Diehl à Paris s\'emploie activement à lui trouver des débouchés dans un contexte peu favorable à la jeune peinture. Fidèle à ses engagements politiques d\'avant-guerre, Roger lutte à sa manière contre l\'occupant en évitant le Service du Travail Obligatoire à de nombreux jeunes gens.'),
(23, '1943-01-01', 'Roger Toulouse est sélectionné au Salon des artistes orléanais et, à Paris, au Salon des Tuileries ainsi que chez Drouant-David. A la rentrée, il est accroché en bonne place au Salon d\'automne, puis à l\'exposition Le rêve et l\'imagination dans l\'art à la galerie Berri-Raspail.'),
(24, '1944-01-01', 'A Paris, il est retenu pour la section orléanaise du Salon des provinces françaises au Palais Galliera, et en mai, à la galerie René Breteau avec plusieurs artistes célèbres. La mort de Max Jacob et les bombardements  de la ville d\'Orléans  perturbent son activité artistique.'),
(25, '1945-01-01', 'Au début de l\'année, Roger Toulouse adopte brusquement un nouveau style expressionniste et coloré. Il expose cette nouvelle peinture chez Maratier, place Vendôme, chez René Breteau, au Salon d\'automne, et pour plusieurs années au Salon de mai que Gaston Diehl vient de fonder.'),
(26, '1946-01-01', 'Il est sélectionné pour l\'exposition Art et Résistance, au musée d\'Art moderne en février, et pour l\'exposition officielle organisée en mars par Balthus au musée de Berne, Les maîtres de l\'Ecole de Paris. Il participe à l\'exposition itinérante de La jeune peinture française, organisée par Les Amis de l\'Art, en France, au Luxembourg et en Afrique du Nord.'),
(27, '1947-01-01', 'Roger Toulouse organise à Orléans une exposition sur Max Jacob à la bibliothèque municipale. Il reçoit le  Prix de la jeune peinture chez Drouant-David. En septembre il rencontre René Guy Cadou à Louisfert. Le directeur de l\'Ecole Normale d\'Instituteurs d\'Orléans lui propose un poste de professeur de dessin qu\'il va occuper pendant trente-deux ans.'),
(28, '1948-01-01', 'René Guy Cadou entreprend une série de poèmes sur des peintures de Roger Toulouse. Une exposition personnelle est organisée à la bibliothèque municipale d\'Orléans. Roger commence une trentaine de gouaches pour illustrer les Histoires improbables d\'André Ferré et, à la fin de l\'année, l\'éditeur Pierre André Benoît lui publie son premier recueil de poèmes Quai Saint-Laurent.'),
(29, '1949-01-01', 'Roger Toulouse participe activement au retour des restes de Max Jacob à Saint-Benoît, le 5 mars. Il continue ses expériences picturales, détruit de nombreuses œuvres et dessine beaucoup. Son style change pour devenir réaliste et symboliste, dans un chromatisme moins agressif. Dès cette époque, son engagement politique à gauche se fait plus actif.'),
(30, '1950-01-01', 'Roger et Marguerite Toulouse emménagent au 9, rue de l\'Abreuvoir, à Orléans. Roger peint, de plus en plus coupé du monde artistique parisien, dans son nouvel atelier qui donne sur la Loire.'),
(31, '1951-01-01', 'La mort de son ami, le poète René Guy Cadou, le touche profondément.'),
(32, '1953-01-01', 'L\'éditeur José Millas-Martin édite les Quatre poèmes de Cadou sur quatre peintures de Roger Toulouse. Roger fait en juin un voyage en Italie avec ses élèves (Florence, Rome, Naples). Il entre en contact avec le poète Pierre Garnier qui va devenir un de ses plus proches amis.'),
(33, '1954-01-01', 'La galerie Le Soleil dans la tête, rue de Vaugirard, organise une exposition personnelle de ses dessins. Pour la première fois Roger Toulouse montre des œuvres composées de triangles.'),
(34, '1956-01-01', 'L\'ouvrage de Pierre Garnier sur Roger Toulouse, édité par les Amis de Rochefort, qui rassemble des poèmes de Bouhier, Cadou, Chaulot et Rousselot, paraît en avril pour l\'exposition personnelle organisée par la galerie Decré à Nantes. A la fin de l\'année, Roger et ses amis réagissent contre l\'intervention soviétique en Hongrie et refusent désormais leur soutien au Parti communiste. Roger Toulouse commence à introduire des triangles dans sa peinture.'),
(35, '1957-01-01', 'Une exposition personnelle de Roger Toulouse à la galerie Gué­négaud à Paris connaît un grand succès. A Orléans, le peintre poursuit ses recherches dans sa nouvelle manière triangulée.'),
(36, '1958-01-01', 'Exposition de groupe à Paris à la galerie Creuze. Il poursuit ses  recherches dans un isolement de plus en plus total'),
(37, '1961-01-01', 'Georges Maratier organise au musée national de Tokyo une exposition de cinquante-cinq œuvres anciennes de Roger Toulouse qui lui appartiennent. Toutes ces peintures sont ensuite vendues sur place.'),
(38, '1962-01-01', 'Exposition de Roger Toulouse à la galerie Cézanne, avec un carton d\'invitation préfacé par Jean Cocteau et André Salmon. A cette occasion, Lily Bazalgette dédicace son ouvrage sur l\'artiste.'),
(39, '1963-01-01', 'En octobre, Roger et Marguerite Toulouse déménagent au 11, rue de l\'Abreuvoir où l\'artiste dispose d\'un vaste atelier lumineux qui donne sur un magnifique cèdre centenaire.'),
(40, '1964-01-01', 'Exposition personnelle à la galerie Six-Sicot à Lille.'),
(41, '1965-01-01', 'Exposition personnelle à la galerie Charamon à Orléans.'),
(42, '1967-01-01', 'En mars, Roger fait une importante donation de dessins de Max Jacob au musée d\'Orléans.'),
(43, '1968-01-01', 'La manufacture Haviland à Limoges lui commande des décors pour des plats en porcelaine et des figurines en terre pour lesquelles il fabrique des armatures métalliques à base de triangles. Pendant quelques années, des émissions culturelles de FR3 ont lieu chez Roger Toulouse qui voit ainsi défiler de nombreux artistes, poètes, écrivains dont Hervé Bazin qui le pousse à faire des sculptures métalliques.'),
(44, '1969-01-01', 'Il réalise, à l\'atelier du vitrail à Limoges, une œuvre pour le Pavillon français de l\'exposition internationale de Montréal : L\'art et la matière. Du 21 juin au 13 juillet a lieu au Centre Artistique et Littéraire de Rochechouart une importante rétrospective et la ville d\'Orléans rend à la fin de l\'année un hommage à l\'artiste à la maison de la culture et à la bibliothèque.'),
(45, '1970-01-01', 'Roger Toulouse aborde la sculpture. Son style évolue rapidement : les triangles  sont remplacés par des formes plus affirmées et compactes à la fin de l\'année.'),
(46, '1972-01-01', 'Exposition de sculptures à Orléans et Nîmes. Roger Toulouse modifie complètement son style en peinture en abandonnant les triangles pour des compositions géométriques inquiétantes et puissamment colorées.'),
(47, '1974-01-01', 'Il participe au Festival de poésie murale organise au château des Stuart à Aubigny-sur-Nère, pour lequel il va créer chaque année de grands panneaux sur des poèmes de Béalu, Bouhier, Brindeau, le prix Nobel Odysseus Elytis, Maya, Reverdy... Dans le cadre du \"un pour cent\", il reçoit plusieurs commandes de sculptures monumentales pour des groupes scolaires du Loiret.'),
(48, '1975-01-01', 'L\'Encyclopaedia Universalis lui consacre un long article. Il est ainsi un des neuf peintres vivants cités dans cet ouvrage.'),
(49, '1976-01-01', 'Roger Toulouse publie son deuxième recueil de poèmes : Magica Forti.'),
(50, '1977-01-01', 'Il inaugure à Limoges une sculpture représentant Saint Martial, et termine deux sculptures monumentales en hommage à Lavoisier et au sociologue Henri Wallon. Il reçoit la commande d\'une grande sculpture en souvenir de René Guy Cadou (groupe scolaire René Guy Cadou).'),
(51, '1978-01-01', 'Roger Toulouse expose au musée de Wichita (USA) et au Salon international d\'art au musée de Toulon, puis à Draguignan.'),
(52, '1979-01-01', 'Il aborde la technique des collages. En décembre, il abandonne l\'enseignement pour se consacrer entièrement à son art. Une exposition a lieu à la Maison de la Culture d\'Orléans.'),
(53, '1980-01-01', 'En mars, Roger Toulouse expose plusieurs œuvres au Coliseum à New York. Il  participe, comme conseiller culturel à la peinture, au comité des programmes de FR3.'),
(54, '1981-01-01', 'Au début de l\'année, il expose à Québec au Palais des Congrès, et en avril à Dreux. Il participe en septembre à la manifestation Grands et jeunes  d\'aujour­d\'hui au Grand Palais.'),
(55, '1982-01-01', 'En janvier, ses œuvres récentes font l\'objet d\'une exposition personnelle à la nouvelle Maison de la Culture d\'Orléans. Il participe à une manifestation d\'art contemporain à Troyes, en juillet, et de nouveau à l\'exposition Grands et jeunes d\'aujourd\'hui. Roger abandonne la sculpture en métal qui le fatigue trop.'),
(56, '1983-01-01', 'Une exposition personnelle est organisée à Briare, au château de Trousse Barrière. Il réalise à la demande de la municipalité cinq mascarons en pierre pour le nouveau musée et la mairie d\'Orléans.'),
(57, '1984-01-01', 'Une exposition personnelle d\'œuvres récentes a lieu au musée des Beaux-Arts de Quimper et en septembre à l\'hôtel de ville de La Rochelle.'),
(58, '1985-01-01', 'Roger Toulouse participe au festival poétique De Rochefort à Nantes en poésie, dans l\'ancienne manufacture des tabacs de Nantes, et au colloque Rencontres avec Max Jacob à Vannes.'),
(59, '1986-01-01', 'Il expose six peintures au nouveau musée des Beaux-Arts d\'Orléans. Il fait de nombreuses illustrations, des peintures, des sculptures en bois, des poèmes.'),
(60, '1988-01-01', 'En mars, Roger Toulouse est victime d\'une chute grave qui l\'immobilise durant de longs mois. Une exposition commune avec Piaubert est organisée à Nantes dans l\'ancienne manufacture des tabacs. Il  publie son troisième recueil de poésies: Le noir éclaire le noir.'),
(61, '1989-01-01', 'Roger participe à la rétrospective du musée d\'Orléans: Max Jacob et les artistes  de son temps. A la fin de l\'année, il retrouve son énergie et modifie sa palette pour peindre des œuvres d\'un blanc éclatant.'),
(62, '1991-01-01', 'A l’occasion du cinquantenaire de la création de l\'Ecole de Rochefort, une importante rétrospective de trente-six œuvres est organisée au musée d\'Agen.'),
(63, '1992-01-01', 'Le blanc s\'efface au profit de couleurs lumineuses éclatantes et les compositions se compliquent de nombreux éléments figuratifs. Puis Roger Toulouse fait des collages avec des couleurs plus ternes, obscurcies par l\'emploi du noir de fumée. Fatigué, il travaille très lentement.'),
(65, '1994-01-01', 'II s\'éteint le 11 septembre, d\'une leucémie qui l\'affaiblissait lentement depuis  de longues années. '),
(96, '1917-01-01', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `carousel`
--

CREATE TABLE `carousel` (
    `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
                        `id` int(11) UNSIGNED NOT NULL,
                        `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'salut les gamers'),
(8, 'dsdd'),
(9, 'dqzd');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
                        `id` int(11) NOT NULL,
                        `title` varchar(80) COLLATE latin1_general_ci NOT NULL,
                        `desc` varchar(255) COLLATE latin1_general_ci NOT NULL,
                        `button` varchar(80) COLLATE latin1_general_ci NOT NULL,
                        `button_link` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `desc`, `button`, `button_link`) VALUES
(1, 'Expos', 'Il n\'y a actuellement pas d\'expositions sur les œuvres de Roger Toulouse, mais la ville                d\'Orléans propose néanmoins d\'autres expositions.', 'Voir les expositions d\'Orléans', 'http://www.orleans-metropole.fr/1340/musees-expositions.htm');

-- --------------------------------------------------------

--
-- Structure de la table `works_category`
--

CREATE TABLE `works_category` (
                                  `id` int(11) NOT NULL,
                                  `category` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `works_category`
--

INSERT INTO `works_category` (`id`, `category`) VALUES
(1, 'peinture'),
(2, 'sculpture'),
(3, 'illustration'),
(4, 'ecriture');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artworks`
--
ALTER TABLE `artworks`
    ADD PRIMARY KEY (`id`),
    ADD KEY `category` (`category_id`);

--
-- Index pour la table `association`
--
ALTER TABLE `association`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `biography`
--
ALTER TABLE `biography`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carousel`
--
ALTER TABLE `carousel`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `works_category`
--
ALTER TABLE `works_category`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artworks`
--
ALTER TABLE `artworks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `association`
--
ALTER TABLE `association`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `biography`
--
ALTER TABLE `biography`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `carousel`
--
ALTER TABLE `carousel`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
    MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `works_category`
--
ALTER TABLE `works_category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artworks`
--
ALTER TABLE `artworks`
    ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `works_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
