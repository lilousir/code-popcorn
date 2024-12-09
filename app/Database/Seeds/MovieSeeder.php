<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $data = [

                [
                    "title" => "Avengers",
                    "release_date" => "2012-04-25",
                    "duration" => "143",
                    "rating" => "Tous publics",
                    "description" => "Lorsque Nick Fury, le directeur du S.H.I.E.L.D., l'organisation qui préserve la paix au plan mondial, cherche à former une équipe de choc pour empêcher la destruction du monde, Iron Man, Hulk, Thor, Captain America, Hawkeye et Black Widow répondent présents.",
                    "slug" => "avengers"
                ],
                [
                    "title" => "Harry Potter à l'école des sorciers",
                    "release_date" => "2001-12-05",
                    "duration" => "152",
                    "rating" => "Tous publics",
                    "description" => "Orphelin, Harry Potter a été recueilli à contrecœur par son oncle Vernon et sa tante Pétunia, aussi cruels que mesquins, qui n'hésitent pas à le faire dormir dans le placard sous l'escalier. Constamment maltraité, il doit en outre supporter les jérémiades de son cousin Dudley, garçon cupide et archi-gâté par ses parents. De leur côté, Vernon et Pétunia détestent leur neveu dont la présence leur rappelle sans cesse le tempérament imprévisible des parents du garçon et leur mort mystérieuse.",
                    "slug" => "harry-potter-a-lecole-des-sorciers"
                ],
                [
                    "title" => "Harry Potter et la chambre des secrets",
                    "release_date" => "2002-12-04",
                    "duration" => "158",
                    "rating" => "Tous publics",
                    "description" => "Alors que l'oncle Vernon, la tante Pétunia et son cousin Dudley reçoivent d'importants invités à dîner, Harry Potter est contraint de passer la soirée dans sa chambre. Dobby, un elfe, fait alors son apparition. Il lui annonce que de terribles dangers menacent l'école de Poudlard et qu'il ne doit pas y retourner en septembre. Harry refuse de le croire.Mais sitôt la rentrée des classes effectuée, ce dernier entend une voix malveillante. Celle-ci lui dit que la redoutable et légendaire Chambre des secrets est à nouveau ouverte, permettant ainsi à l'héritier de Serpentard de semer le chaos à Poudlard. Les victimes, retrouvées pétrifiées par une force mystérieuse, se succèdent dans les couloirs de l'école, sans que les professeurs - pas même le populaire Gilderoy Lockhart - ne parviennent à endiguer la menace. Aidé de Ron et Hermione, Harry doit agir au plus vite pour sauver Poudlard.",
                    "slug" => "harry-potter-et-la-chambre-des-secrets"
                ],
                [
                    "title" => "Harry Potter et le Prisonnier d'Azkaban",
                    "release_date" => "2004-06-02",
                    "duration" => "141",
                    "rating" => "Tous publics",
                    "description" => "Sirius Black, un dangereux sorcier criminel, s'échappe de la sombre prison d'Azkaban avec un seul et unique but : retrouver Harry Potter, en troisième année à l'école de Poudlard. Selon la légende, Black aurait jadis livré les parents du jeune sorcier à leur assassin, Lord Voldemort, et serait maintenant déterminé à tuer Harry...",
                    "slug" => "harry-potter-et-le-prisonnier-dazkaban"
                ],
                [
                    "title" => "Harry Potter et la Coupe de Feu",
                    "release_date" => "2005-11-30",
                    "duration" => "157",
                    "rating" => "Tous publics",
                    "description" => "La quatrième année à l'école de Poudlard est marquée par le Tournoi des trois sorciers. Les participants sont choisis par la fameuse coupe de feu qui est à l'origine d'un scandale. Elle sélectionne Harry Potter alors qu'il n'a pas l'âge légal requis !",
                    "slug" => "harry-potter-et-la-coupe-de-feu"
                ],
                [
                    "title" => "Harry Potter et l'Ordre du Phénix",
                    "release_date" => "2007-07-11",
                    "duration" => "128",
                    "rating" => "Tous publics",
                    "description" => "Alors qu'il entame sa cinquième année d'études à Poudlard, Harry Potter découvre que la communauté des sorciers ne semble pas croire au retour de Voldemort, convaincue par une campagne de désinformation orchestrée par le Ministre de la Magie Cornelius Fudge. Afin de le maintenir sous surveillance,  L'Armée de Dumbledore, pour leur enseigner l'art de la défense contre les forces du Mal et se préparer à la guerre qui s'annonce...",
                    "slug" => "harry-potter-et-lordre-du-phenix"
                ],
                [
                    "title" => "Harry Potter et le Prince de sang mêlé",
                    "release_date" => "2009-07-15",
                    "duration" => "153",
                    "rating" => "Tous publics",
                    "description" => "L'étau démoniaque de Voldemort se resserre sur l'univers des Moldus et le monde de la sorcellerie. Poudlard a cessé d'être un havre de paix, le danger rode au coeur du château... Mais Dumbledore est plus décidé que jamais à préparer Harry à son combat final, désormais imminent. Ensemble, le vieux maître et le jeune sorcier vont tenter de percer à jour les défenses de Voldemort. Pour les aider dans cette délicate entreprise, Dumbledore va relancer et manipuler son ancien collègue, le Professeur Horace Slughorn, qu'il croit en possession d'informations vitales sur le jeune Voldemort. Mais un autre mal hante cette année les étudiants : le démon de l'adolescence !",
                    "slug" => "harry-potter-et-le-prince-de-sang-mele"
                ],

                    [
                        "title" => "Harry Potter et les reliques de la mort - partie 1",
                        "release_date" => "2010-11-24",
                        "duration" => "146",
                        "rating" => "-12",
                        "description" => "Le pouvoir de Voldemort s'étend. Celui-ci contrôle maintenant le Ministère de la Magie et Poudlard. Harry, Ron et Hermione décident de terminer le travail commencé par Dumbledore, et de retrouver les derniers Horcruxes pour vaincre le Seigneur des Ténèbres. Mais il reste bien peu d'espoir aux trois sorciers, qui doivent réussir à tout prix.",
                        "slug" => "harry-potter-et-les-reliques-de-la-mort-partie-1"
                    ],
                    [
                        "title" => "Harry Potter et les reliques de la mort - partie 2",
                        "release_date" => "2001-07-13",
                        "duration" => "130",
                        "rating" => "-12",
                        "description" => "Dans la 2e Partie de cet épisode final, le combat entre les puissances du bien et du mal de l’univers des sorciers se transforme en guerre sans merci. Les enjeux n’ont jamais été si considérables et personne n’est en sécurité. Mais c’est Harry Potter qui peut être appelé pour l’ultime sacrifice alors que se rapproche l’ultime épreuve de force avec Voldemort.",
                        "slug" => "harry-potter-et-les-reliques-de-la-mort-partie-2"
                    ],
                    [
                        "title" => "Avengers L'ère d'Ultron",
                        "release_date" => "2015-04-22",
                        "duration" => "141",
                        "rating" => "Tous publics",
                        "description" => "Alors que Tony Stark tente de relancer un programme de maintien de la paix jusque-là suspendu, les choses tournent mal et les super-héros Iron Man, Captain America, Thor, Hulk, Black Widow et Hawkeye vont devoir à nouveau unir leurs forces pour combattre le plus puissant de leurs adversaires : le terrible Ultron, un être technologique terrifiant qui s’est juré d’éradiquer l’espèce humaine. Afin d’empêcher celui-ci d’accomplir ses sombres desseins, des alliances inattendues se scellent, les entraînant dans une incroyable aventure et une haletante course contre le temps…",
                        "slug" => "avengers-lere-dultron"
                    ],
                    [
                        "title" => "Avengers: Infinity War",
                        "release_date" => "2018-04-25",
                        "duration" => "156",
                        "rating" => "Tous publics",
                        "description" => "Les Avengers et leurs alliés devront être prêts à tout sacrifier pour neutraliser le redoutable Thanos avant que son attaque éclair ne conduise à la destruction complète de l’univers.",
                        "slug" => "avengers-infinity-war"
                    ],
                    [
                        "title" => "Avengers: Endgame",
                        "release_date" => "2019-04-24",
                        "duration" => "181",
                        "rating" => "Tous publics",
                        "description" => "Thanos ayant anéanti la moitié de l’univers, les Avengers restants resserrent les rangs dans ce vingt-deuxième film des Studios Marvel, grande conclusion d’un des chapitres de l’Univers Cinématographique Marvel.",
                        "slug" => "avengers-endgame"
                    ],
                    [
                        "title" => "Spider-Man",
                        "release_date" => "2002-06-12",
                        "duration" => "121",
                        "rating" => "Tous publics",
                        "description" => "Orphelin, Peter Parker est élevé par sa tante May et son oncle Ben dans le quartier Queens de New York. Tout en poursuivant ses études à l'université, il trouve un emploi de photographe au journal Daily Bugle. Il partage son appartement avec Harry Osborn, son meilleur ami, et rêve de séduire la belle Mary Jane. Cependant, après avoir été mordu par une araignée génétiquement modifiée, Peter voit son agilité et sa force s'accroître et se découvre des pouvoirs surnaturels. Devenu Spider-Man, il décide d'utiliser ses nouvelles capacités au service du bien. Au même moment, le père de Harry, le richissime industriel Norman Osborn, est victime d'un accident chimique qui a démesurément augmenté ses facultés intellectuelles et sa force, mais l'a rendu fou. Il est devenu le Bouffon Vert, une créature démoniaque qui menace la ville. Entre lui et Spider-Man, une lutte sans merci s'engage.",
                        "slug" => "spider-man"
                    ],



                    [
                        "title" => "Spider-Man 2",
                        "release_date" => "2004-07-14",
                        "duration" => "127",
                        "rating" => "Tous publics",
                        "description" => "Ecartelé entre son identité secrète de Spider-Man et sa vie d'étudiant, Peter Parker n'a pas réussi à garder celle qu'il aime, Mary Jane, qui est aujourd'hui comédienne et fréquente quelqu'un d'autre. Guidé par son seul sens du devoir, Peter vit désormais chacun de ses pouvoirs à la fois comme un don et comme une malédiction. Par ailleurs, l'amitié entre Peter et Harry Osborn est elle aussi menacée. Harry rêve plus que jamais de se venger de Spider-Man, qu'il juge responsable de la mort de son père. La vie de Peter se complique encore lorsque surgit un nouvel ennemi : le redoutable Dr Otto Octavius. Cerné par les choix et les épreuves qui engagent aussi bien sa vie intime que l'avenir du monde, Peter doit affronter son destin et faire appel à tous ses pouvoirs afin de se battre sur tous les fronts...",
                        "slug" => "spider-man-2"
                    ],
                    [
                        "title" => "Spider-Man 3",
                        "release_date" => "2007-05-01",
                        "duration" => "139",
                        "rating" => "Tous publics",
                        "description" => "",
                        "slug" => "spider-man-3"
                    ],
                    [
                        "title" => "The Amazing Spider-Man",
                        "release_date" => "2012-07-04",
                        "duration" => "137",
                        "rating" => "Tous publics",
                        "description" => "Abandonné par ses parents lorsqu’il était enfant, Peter Parker a été élevé par son oncle Ben et sa tante May. Il est aujourd’hui au lycée, mais il a du mal à s’intégrer. Comme la plupart des adolescents de son âge, Peter essaie de comprendre qui il est et d’accepter son parcours. Amoureux pour la première fois, lui et Gwen Stacy découvrent les sentiments, l’engagement et les secrets. En retrouvant une mystérieuse mallette ayant appartenu à son père, Peter entame une quête pour élucider la disparition de ses parents, ce qui le conduit rapidement à Oscorp et au laboratoire du docteur Curt Connors, l’ancien associé de son père. Spider-Man va bientôt se retrouver face au Lézard, l’alter ego de Connors. En décidant d’utiliser ses pouvoirs, il va choisir son destin…",
                        "slug" => "the-amazing-spider-man"
                    ],
                    [
                        "title" => "The Amazing Spider-Man : le destin d'un Héros",
                        "release_date" => "2014-04-30",
                        "duration" => "144",
                        "rating" => "Tous publics",
                        "description" => "Ce n’est un secret pour personne que le combat le plus rude de Spider-Man est celui qu’il mène contre lui-même en tentant de concilier la vie quotidienne de Peter Parker et les lourdes responsabilités de Spider-Man. Mais Peter Parker va se rendre compte qu’il fait face à un conflit de bien plus grande ampleur. Être Spider-Man, quoi de plus grisant ? Peter Parker trouve son bonheur entre sa vie de héros, bondissant d’un gratte-ciel à l’autre, et les doux moments passés aux côté de Gwen. Mais être Spider-Man a un prix : il est le seul à pouvoir protéger ses concitoyens new-yorkais des abominables méchants qui menacent la ville. Face à Electro, Peter devra affronter un ennemi nettement plus puissant que lui. Au retour de son vieil ami Harry Osborn, il se rend compte que tous ses ennemis ont un point commun : OsCorp.",
                        "slug" => "the-amazing-spider-man-le-destin-dun-heros"
                    ],
                    [
                        "title" => "Spider-Man: Homecoming",
                        "release_date" => "2017-07-12",
                        "duration" => "133",
                        "rating" => "Tous publics",
                        "description" => "Après ses spectaculaires débuts dans Captain America : Civil War, le jeune Peter Parker découvre peu à peu sa nouvelle identité, celle de Spider-Man, le super-héros lanceur de toile. Galvanisé par son expérience avec les Avengers, Peter rentre chez lui auprès de sa tante May, sous l’œil attentif de son nouveau mentor, Tony Stark. Il s’efforce de reprendre sa vie d’avant, mais au fond de lui, Peter rêve de se prouver qu’il est plus que le sympathique super héros du quartier. L’apparition d’un nouvel ennemi, le Vautour, va mettre en danger tout ce qui compte pour lui...",
                        "slug" => "spider-man-homecoming"
                    ],
                    [
                        "title" => "Spider-Man: Far From Home",
                        "release_date" => "2019-07-03",
                        "duration" => "130",
                        "rating" => "Tous publics",
                        "description" => "L'araignée sympa du quartier décide de rejoindre ses meilleurs amis Ned, MJ, et le reste de la bande pour des vacances en Europe. Cependant, le projet de Peter de laisser son costume de super-héros derrière lui pendant quelques semaines est rapidement compromis quand il accepte à contrecoeur d'aider Nick Fury à découvrir le mystère de plusieurs attaques de créatures, qui ravagent le continent !",
                        "slug" => "spider-man-far-from-home"
                    ],
                    [
                        "title" => "Spider-Man: No Way Home",
                        "release_date" => "2021-12-15",
                        "duration" => "148",
                        "rating" => "Tous publics",
                        "description" => "Pour la première fois dans son histoire cinématographique, Spider-Man, le héros sympa du quartier est démasqué et ne peut désormais plus séparer sa vie normale de ses lourdes responsabilités de super-héros. Quand il demande de l'aide à Doctor Strange, les enjeux deviennent encore plus dangereux, le forçant à découvrir ce qu'être Spider-Man signifie véritablement.",
                        "slug" => "spider-man-no-way-home"
                    ],
                    [
                        "title" => "Spider-Man : Across The Spider-Verse",
                        "release_date" => "2018-12-12",
                        "duration" => "141",
                        "rating" => "Tous publics",
                        "description" => "Après avoir retrouvé Gwen Stacy, Spider-Man, le sympathique héros originaire de Brooklyn, est catapulté à travers le Multivers, où il rencontre une équipe de Spider-Héros chargée d'en protéger l'existence. Mais lorsque les héros s'opposent sur la façon de gérer une nouvelle menace, Miles se retrouve confronté à eux et doit redéfinir ce que signifie être un héros afin de sauver les personnes qu'il aime le plus.",
                        "slug" => "spider-man-across-the-spider-verse"
                    ],
                    [
                        "title" => "Spider-Man : New Generation",
                        "release_date" => "2023-05-31",
                        "duration" => "113",
                        "rating" => "Tous publics",
                        "description" => "Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-américain et portoricain qui vit à Brooklyn et s’efforce de s’intégrer dans son nouveau collège à Manhattan. Mais la vie de Miles se complique quand il se fait mordre par une araignée radioactive et se découvre des super-pouvoirs : il est désormais capable d’empoisonner ses adversaires, de se camoufler, de coller littéralement aux murs et aux plafonds ; son ouïe est démultipliée... Dans le même temps, le plus redoutable cerveau criminel de la ville, le Caïd, a mis au point un accélérateur de particules nucléaires capable d’ouvrir un portail sur d’autres univers. Son invention va provoquer l’arrivée de plusieurs autres versions de Spider-Man dans le monde de Miles, dont un Peter Parker plus âgé, Spider-Gwen, Spider-Man Noir, Spider-Cochon et Peni Parker, venue d’un dessin animé japonais.",
                        "slug" => "spider-man-new-generation" ],

                        [
                            "title" => "Vaiana la légende du bout du monde",
                            "release_date" => "2016-11-30",
                            "duration" => "100",
                            "rating" => "Tous publics",
                            "description" => "Il y a 3 000 ans, les plus grands marins du monde voyagèrent dans le vaste océan Pacifique...",
                            "slug" => "vaiana-la-legende-du-bout-du-monde"
                        ],
                        [
                            "title" => "Vaiana 2",
                            "release_date" => "2024-11-27",
                            "duration" => "90",
                            "rating" => "Tous publics",
                            "description" => "Après avoir reçu une invitation inattendue de ses ancêtres...",
                            "slug" => "vaiana-2"
                        ],
                        [
                            "title" => "Mais où est donc passée la septième compagnie",
                            "release_date" => "1973-12-01",
                            "duration" => "80",
                            "rating" => "Tous publics",
                            "description" => "Pendant la débâcle française de 1940, la 7ème compagnie se réfugie dans les bois...",
                            "slug" => "mais-ou-est-donc-passee-la-septieme-compagnie"
                        ],
                        [
                            "title" => "On a retrouvé la 7ème compagnie",
                            "release_date" => "1974-12-03",
                            "duration" => "90",
                            "rating" => "Tous publics",
                            "description" => "Tentant de rejoindre le sud de la France, les rescapés de la 7ème compagnie...",
                            "slug" => "on-a-retrouve-la-septieme-compagnie"
                        ],
                        [
                            "title" => "La Septième compagnie au clair de lune",
                            "release_date" => "1975-01-02",
                            "duration" => "90",
                            "rating" => "tous publics",
                            "description" => "Sous l'Occupation, le héros de la Septième compagnie Chaudard...",
                            "slug" => "la-septieme-compagnie-au-clair-de-lune"
                        ],
                        [
                            "title" => "Deadpool & Wolverine",
                            "release_date" => "2024-07-24",
                            "duration" => "127",
                            "rating" => "-12",
                            "description" => "Après avoir échoué à rejoindre l’équipe des Avengers, Wade Wilson...",
                            "slug" => "deadpool-wolverine"
                        ],
                        [
                            "title" => "Deadpool",
                            "release_date" => "2016-02-10",
                            "duration" => "108",
                            "rating" => "-12",
                            "description" => "Deadpool, est l'anti-héros le plus atypique de l'univers Marvel...",
                            "slug" => "deadpool"
                        ],
                        [
                            "title" => "Deadpool 2",
                            "release_date" => "2018-05-13",
                            "duration" => "120",
                            "rating" => "-12",
                            "description" => "L’insolent mercenaire de Marvel remet le masque...",
                            "slug" => "deadpool-2"
                        ],


                          [  "title" => "Pirates des Caraïbes : La Malédiction du Black Pearl",
                            "release_date" => "2003-08-13",
                            "duration" => "143",
                            "rating" => "Tous publics",
                            "description" => "Jack Sparrow, un pirate aussi rusé que séduisant, voit sa vie idyllique de flibustier bouleversée lorsque son ennemi juré, le capitaine Barbossa, lui vole son bateau, le Black Pearl, puis attaque la ville de Port Royal, kidnappant au passage la fille du gouverneur, Elizabeth Swann. Will Turner, un ami d'enfance d'Elizabeth, s'allie à Jack pour sauver la jeune femme et récupérer le bateau.",
                            "slug" => "pirates-des-caraibes-la-malediction-du-black-pearl"
                        ],
                    [
                        "title" => "Pirates des Caraïbes : Le Secret du Coffre Maudit",
                        "release_date" => "2006-08-02",
                        "duration" => "150",
                        "rating" => "Tous publics",
                        "description" => "Jack Sparrow se retrouve une fois de plus entraîné dans une course effrénée pour récupérer le légendaire Coffre de Davy Jones, une relique magique qui lui permettrait d'échapper à une dette de sang envers le terrible capitaine du Hollandais Volant. Will Turner et Elizabeth Swann se retrouvent eux aussi impliqués dans cette aventure, où ils devront affronter monstres marins et trahisons.",
                        "slug" => "pirates-des-caraibes-le-secret-du-coffre-maudit"
                    ],
                    [
                        "title" => "Pirates des Caraïbes : Jusqu'au Bout du Monde",
                        "release_date" => "2007-05-23",
                        "duration" => "169",
                        "rating" => "Tous publics",
                        "description" => "Alors que Jack Sparrow est enfermé dans le royaume de Davy Jones, ses amis Elizabeth Swann, Will Turner et le capitaine Barbossa s'allient pour le sauver et contrer la menace grandissante de Lord Beckett et de la Compagnie des Indes Orientales, qui cherchent à anéantir l'âge d'or de la piraterie.",
                        "slug" => "pirates-des-caraibes-jusquau-bout-du-monde"
                    ],
                    [
                        "title" => "Pirates des Caraïbes : La Fontaine de Jouvence",
                        "release_date" => "2011-05-18",
                        "duration" => "137",
                        "rating" => "Tous publics",
                        "description" => "Dans cette nouvelle aventure, Jack Sparrow croise la route de la mystérieuse Angelica, une femme de son passé, et se retrouve à bord du Queen Anne's Revenge, le navire du légendaire pirate Barbe Noire. Ensemble, ils partent à la recherche de la légendaire Fontaine de Jouvence, mais doivent faire face à des sirènes et de nombreuses trahisons.",
                        "slug" => "pirates-des-caraibes-la-fontaine-de-jouvence"
                    ],
                    [
                        "title" => "Pirates des Caraïbes : La Vengeance de Salazar",
                        "release_date" => "2017-05-24",
                        "duration" => "129",
                        "rating" => "Tous publics",
                        "description" => "Jack Sparrow doit affronter son ennemi le plus redoutable, le capitaine Salazar, qui cherche à éliminer tous les pirates des mers. Pour survivre, Jack devra trouver le Trident de Poséidon, un artefact légendaire qui confère à son possesseur un contrôle total sur les mers.",
                        "slug" => "pirates-des-caraibes-la-vengeance-de-salazar"
                    ],


                    [
                        "title" => "Les Bronzés",
                        "release_date" => "1978-11-01",
                        "duration" => "95",
                        "rating" => "Tous publics",
                        "description" => "Un groupe de vacanciers se retrouve dans un club de vacances en Côte d'Ivoire. Entre amours, amitiés et situations rocambolesques, ils vivent des vacances mémorables, marquées par des moments drôles et cocasses.",
                        "slug" => "les-bronzes"
                    ],
                    [
                        "title" => "Les Bronzés font du ski",
                        "release_date" => "1979-11-22",
                        "duration" => "87",
                        "rating" => "Tous publics",
                        "description" => "Les mêmes vacanciers se retrouvent cette fois-ci à la montagne pour des vacances au ski. Entre chutes, aventures amoureuses et incidents hilarants, ils découvrent que la montagne peut réserver bien des surprises.",
                        "slug" => "les-bronzes-font-du-ski"
                    ],
                    [
                        "title" => "Les Bronzés 3 : Amis pour la vie",
                        "release_date" => "2006-02-01",
                        "duration" => "97",
                        "rating" => "Tous publics",
                        "description" => "Des années après leurs premières vacances ensemble, les anciens amis se retrouvent dans une luxueuse villa en Sardaigne. Malgré les années passées, les tensions et les mésaventures ne tardent pas à refaire surface, pour le plus grand plaisir des spectateurs.",
                        "slug" => "les-bronzes-3-amis-pour-la-vie"
                    ],

                [
                    "title" => "Le Roi Lion",
                    "release_date" => "1994-11-23",
                    "duration" => "88",
                    "rating" => "Tous publics",
                    "description" => "Dans la savane africaine, un jeune lionceau nommé Simba doit affronter les épreuves de la vie pour reprendre sa place légitime en tant que roi, après avoir été manipulé par son oncle Scar.",
                    "slug" => "le-roi-lion"
                ],
                [
                    "title" => "Le Roi Lion 3 : Hakuna Matata",
                    "release_date" => "2004-02-10",
                    "duration" => "77",
                    "rating" => "Tous publics",
                    "description" => "Cette aventure hilarante raconte l'histoire du Roi Lion à travers les yeux de Timon et Pumbaa, révélant leur version des événements avec humour et émotion.",
                    "slug" => "le-roi-lion-3-hakuna-matata"
                ],
                [
                    "title" => "Aladdin",
                    "release_date" => "1992-11-25",
                    "duration" => "90",
                    "rating" => "Tous publics",
                    "description" => "Dans la ville d'Agrabah, un jeune garçon pauvre nommé Aladdin découvre une lampe magique contenant un génie exubérant qui peut exaucer trois vœux. Ensemble, ils tentent de déjouer les plans machiavéliques du vizir Jafar.",
                    "slug" => "aladdin"
                ],
                [
                    "title" => "La Petite Sirène",
                    "release_date" => "1990-11-28",
                    "duration" => "83",
                    "rating" => "Tous publics",
                    "description" => "Ariel, une jeune sirène fascinée par le monde des humains, passe un pacte dangereux avec la sorcière Ursula pour devenir humaine et conquérir l'amour du prince Éric.",
                    "slug" => "la-petite-sirene"
                ],
                [
                    "title" => "Raiponce",
                    "release_date" => "2010-11-24",
                    "duration" => "100",
                    "rating" => "Tous publics",
                    "description" => "Raiponce, une jeune fille aux cheveux magiques enfermée dans une tour, s'échappe avec l'aide de Flynn Rider, un charmant voleur, pour vivre l'aventure qu'elle a toujours rêvé.",
                    "slug" => "raiponce"
                ],
                [
                "title" => "Blanche-Neige et les Sept Nains",
            "release_date" => "1938-05-04",
            "duration" => "83",
            "rating" => "Tous publics",
            "description" => "La douce Blanche-Neige, poursuivie par sa belle-mère jalouse, trouve refuge chez sept nains adorables qui l'aident à échapper à la méchante reine.",
            "slug" => "blanche-neige-et-les-sept-nains"
        ],
    [
        "title" => "La Belle au bois dormant",
        "release_date" => "1959-07-29",
        "duration" => "75",
        "rating" => "Tous publics",
        "description" => "Maudite par la sorcière Maléfique, la princesse Aurore sombre dans un sommeil profond jusqu'à ce qu'un prince courageux brise le sort avec un baiser d'amour véritable.",
        "slug" => "la-belle-au-bois-dormant"
    ],
    [
        "title" => "Cendrillon",
        "release_date" => "1950-12-14",
        "duration" => "74",
        "rating" => "Tous publics",
        "description" => "Avec l'aide de sa marraine la bonne fée, Cendrillon parvient à échapper à la cruauté de sa belle-famille pour rencontrer le prince charmant lors d'un bal magique.",
        "slug" => "cendrillon"
    ],
    [
        "title" => "Coco",
        "release_date" => "2017-11-29",
        "duration" => "105",
        "rating" => "Tous publics",
        "description" => "Miguel, un jeune garçon passionné de musique, se retrouve dans le monde des morts où il découvre les secrets de sa famille et la véritable importance de la mémoire.",
        "slug" => "coco"
    ],
    [
        "title" => "Les Nouveaux Héros",
        "release_date" => "2015-02-11",
        "duration" => "102",
        "rating" => "Tous publics",
        "description" => "Hiro, un prodige de la robotique, forme une équipe de super-héros improbables avec son robot Baymax pour déjouer une menace qui plane sur la ville de San Fransokyo.",
        "slug" => "les-nouveaux-heros"
    ],
    [
        "title" => "Bienvenue chez les Robinson",
        "release_date" => "2007-10-17",
        "duration" => "95",
        "rating" => "Tous publics",
        "description" => "Lewis, un jeune inventeur, voyage dans le futur et rencontre une famille excentrique, les Robinson, qui l'aident à comprendre l'importance de croire en soi.",
        "slug" => "bienvenue-chez-les-robinson"
    ],
    [
        "title" => "La Planète au trésor : Un nouvel univers",
        "release_date" => "2002-11-27",
        "duration" => "95",
        "rating" => "Tous publics",
        "description" => "Jim Hawkins embarque pour une aventure spatiale à la recherche d'un légendaire trésor intergalactique, accompagné d'un équipage hétéroclite et d'un robot loyal.",
        "slug" => "la-planete-au-tresor-un-nouvel-univers"
    ],
    [
        "title" => "Les Indestructibles",
        "release_date" => "2004-11-24",
        "duration" => "115",
        "rating" => "Tous publics",
        "description" => "Une famille de super-héros tente de mener une vie normale mais doit reprendre du service pour affronter un super-vilain menaçant le monde.",
        "slug" => "les-indestructibles"
    ],
    [
        "title" => "Les Indestructibles 2",
        "release_date" => "2018-07-04",
        "duration" => "118",
        "rating" => "Tous publics",
        "description" => "Alors qu'Hélène est appelée à sauver le monde, Bob reste à la maison pour s'occuper des enfants, découvrant que bébé Jack-Jack a des pouvoirs hors du commun.",
        "slug" => "les-indestructibles-2"
    ],
    [
        "title" => "Kuzco, l'empereur mégalo",
        "release_date" => "2001-02-28",
        "duration" => "78",
        "rating" => "Tous publics",
        "description" => "Transformé en lama par une sorcière, l'empereur Kuzco doit apprendre l'humilité et l'amitié pour retrouver son trône.",
        "slug" => "kuzco-lempereur-megalo"
    ],

            [
                "title" => "Frère des ours",
                "release_date" => "2004-04-14",
                "duration" => "85",
                "rating" => "Tous publics",
                "description" => "Après avoir été transformé en ours, Kenai apprend la valeur de l'amour et de la fraternité en voyageant avec Koda, un ourson espiègle.",
                "slug" => "frere-des-ours"
            ],
            [
                "title" => "Zootopie",
                "release_date" => "2016-02-17",
                "duration" => "108",
                "rating" => "Tous publics",
                "description" => "Judy Hopps, une lapine policière, fait équipe avec le rusé renard Nick Wilde pour résoudre une mystérieuse affaire dans la métropole animalière de Zootopie.",
                "slug" => "zootopie"
            ],
            [
                "title" => "Volt, star malgré lui",
                "release_date" => "2008-11-26",
                "duration" => "96",
                "rating" => "Tous publics",
                "description" => "Volt, un chien-star de la télévision, découvre la vraie vie en croyant encore posséder des super-pouvoirs, accompagné d'une chatte et d'un hamster fan.",
                "slug" => "volt-star-malgre-lui"
            ],
            [
                "title" => "Toy Story",
                "release_date" => "1995-11-22",
                "duration" => "81",
                "rating" => "Tous publics",
                "description" => "Woody, un cow-boy en peluche, et Buzz l'Éclair, un jouet spatial, doivent surmonter leurs différends pour retrouver leur place auprès d'Andy.",
                "slug" => "toy-story"
            ],
            [
                "title" => "Toy Story 2",
                "release_date" => "2000-02-02",
                "duration" => "92",
                "rating" => "Tous publics",
                "description" => "Lorsque Woody est enlevé par un collectionneur, Buzz et ses amis jouets partent en mission pour le sauver avant qu'il ne soit vendu à un musée.",
                "slug" => "toy-story-2"
            ],
            [
                "title" => "Toy Story 3",
                "release_date" => "2010-07-14",
                "duration" => "103",
                "rating" => "Tous publics",
                "description" => "Les jouets d'Andy se retrouvent dans une garderie où ils doivent affronter les défis d'un nouvel environnement tout en restant unis.",
                "slug" => "toy-story-3"
            ],
            [
                "title" => "Toy Story 4",
                "release_date" => "2019-06-26",
                "duration" => "100",
                "rating" => "Tous publics",
                "description" => "Woody retrouve une vieille amie, Bo Peep, et doit décider entre rester avec ses amis jouets ou vivre une nouvelle aventure.",
                "slug" => "toy-story-4"
            ],
            [
                "title" => "Cruella",
                "release_date" => "2021-05-26",
                "duration" => "134",
                "rating" => "Tous publics",
                "description" => "L'histoire d'origine de Cruella d'Enfer, une créatrice de mode audacieuse et ambitieuse, et son ascension dans le monde impitoyable de la mode à Londres dans les années 1970.",
                "slug" => "cruella"
            ],
            [
                "title" => "Alice au pays des merveilles",
                "release_date" => "2010-03-24",
                "duration" => "109",
                "rating" => "Tous publics",
                "description" => "Alice retourne au pays des merveilles où elle découvre son destin : mettre fin au règne de la Reine Rouge et restaurer la paix.",
                "slug" => "alice-au-pays-des-merveilles"
            ],
            [
                "title" => "La Nuit au musée",
                "release_date" => "2007-02-07",
                "duration" => "108",
                "rating" => "Tous publics",
                "description" => "Larry Daley, un gardien de nuit, découvre que les expositions du musée prennent vie la nuit, menant à des aventures hilarantes et inattendues.",
                "slug" => "la-nuit-au-musee"
            ],
            [
                "title" => "La Nuit au musée 2",
                "release_date" => "2009-05-20",
                "duration" => "105",
                "rating" => "Tous publics",
                "description" => "Larry Daley retrouve ses amis du musée, cette fois pour sauver les expositions historiques transférées dans les archives du Smithsonian.",
                "slug" => "la-nuit-au-musee-2"
            ],
            [
                "title" => "La Nuit au musée : Le Secret des Pharaons",
                "release_date" => "2015-02-04",
                "duration" => "97",
                "rating" => "Tous publics",
                "description" => "Larry et ses amis du musée partent à Londres pour résoudre le mystère de la tablette magique qui donne vie aux expositions.",
                "slug" => "la-nuit-au-musee-3-le-secret-des-pharaons"
            ],
            [
                "title" => "Astérix & Obélix : Mission Cléopâtre",
                "release_date" => "2002-01-30",
                "duration" => "107",
                "rating" => "Tous publics",
                "description" => "Cléopâtre défie César en construisant un somptueux palais en seulement trois mois, avec l'aide d'Astérix, Obélix et Panoramix.",
                "slug" => "asterix-obelix-mission-cleopatre"
            ],
            [
                "title" => "La Cité de la peur",
                "release_date" => "1994-03-09",
                "duration" => "99",
                "rating" => "Tous publics",
                "description" => "Un tueur en série frappe pendant le Festival de Cannes, tandis qu'une attachée de presse farfelue tente de promouvoir son film.",
                "slug" => "la-cite-de-la-peur"
            ],
            [
                "title" => "Le Dîner de cons",
                "release_date" => "1998-04-15",
                "duration" => "80",
                "rating" => "Tous publics",
                "description" => "Un éditeur cynique invite un 'con' à dîner pour se moquer de lui, mais la soirée tourne au désastre.",
                "slug" => "le-diner-de-cons"
            ],
            [
                "title" => "Intouchables",
                "release_date" => "2011-11-02",
                "duration" => "112",
                "rating" => "Tous publics",
                "description" => "L'amitié inattendue entre un aristocrate tétraplégique et un jeune homme des banlieues devient une source d'inspiration.",
                "slug" => "intouchables"
            ],
            [
                "title" => "Les Visiteurs",
                "release_date" => "1993-01-27",
                "duration" => "107",
                "rating" => "Tous publics",
                "description" => "Un chevalier du Moyen Âge et son écuyer sont accidentellement transportés à l'époque moderne, où ils provoquent des désastres hilarants.",
                "slug" => "les-visiteurs"
            ],
            [
                "title" => "Les Visiteurs 2 : Les Couloirs du temps",
                "release_date" => "1998-02-11",
                "duration" => "118",
                "rating" => "Tous publics",
                "description" => "De retour dans le présent, Godefroy et Jacquouille doivent corriger les perturbations temporelles causées par leur précédent voyage.",
                "slug" => "les-visiteurs-2-les-couloirs-du-temps"
            ],
            [
                "title" => "Le Grand Bleu",
                "release_date" => "1988-05-11",
                "duration" => "168",
                "rating" => "Tous publics",
                "description" => "Une plongée dans la rivalité et l'amitié entre deux apnéistes légendaires, sur fond de paysages marins sublimes.",
                "slug" => "le-grand-bleu"
            ],
            [
                "title" => "Evil Dead Rise",
                "release_date" => "2023-04-21",
                "duration" => "96",
                "rating" => "-16",
                "description" => "Deux sœurs doivent survivre à une force démoniaque terrifiante qui menace leur famille dans un immeuble de Los Angeles.",
                "slug" => "evil-dead-rise"
            ],
            [
                "title" => "Abigail",
                "release_date" => "2019-08-22",
                "duration" => "110",
                "rating" => "-12",
                "description" => "Suite au kidnapping de la fille d’un puissant magnat de la pègre, un groupe de criminels amateurs pensaient simplement devoir enfermer et surveiller cette jeune ballerine afin de pouvoir réclamer une rançon de 50 millions de dollars.",
                "slug" => "abigail"
            ],
            [
                "title" => "Sans un bruit",
                "release_date" => "2018-06-20",
                "duration" => "90",
                "rating" => "Tous publics",
                "description" => "Dans un monde envahi par des créatures sensibles au moindre bruit, une famille lutte pour survivre en silence.",
                "slug" => "sans-un-bruit"
            ],
            [
                "title" => "Sans un bruit 2",
                "release_date" => "2021-06-16",
                "duration" => "97",
                "rating" => "Tous publics",
                "description" => "La famille Abbott doit survivre hors de leur refuge, en rencontrant de nouvelles menaces et des alliés inattendus.",
                "slug" => "sans-un-bruit-2"
            ],
            [
                "title" => "Sans un bruit 3",
                "release_date" => "2024-03-08",
                "duration" => "110",
                "rating" => "Tous publics",
                "description" => "Une nouvelle perspective sur l'apocalypse silencieuse révèle davantage de secrets sur l'origine des créatures.",
                "slug" => "sans-un-bruit-3"
            ],
            [
                "title" => "Smile",
                "release_date" => "2022-09-28",
                "duration" => "115",
                "rating" => "-12",
                "description" => "Une psychiatre est hantée par des visions terrifiantes après avoir été témoin d'un événement traumatisant.",
                "slug" => "smile"
            ],
            [
                "title" => "Conjuring : Les dossiers Warren",
                "release_date" => "2013-07-21",
                "duration" => "112",
                "rating" => "-12",
                "description" => "Les enquêteurs paranormaux Ed et Lorraine Warren aident une famille à se débarrasser d'une présence démoniaque.",
                "slug" => "conjuring-les-dossiers-warren"
            ],
            [
                "title" => "Conjuring 2 : Le cas Enfield",
                "release_date" => "2016-06-29",
                "duration" => "134",
                "rating" => "-12",
                "description" => "Ed et Lorraine Warren enquêtent sur une maison hantée à Enfield, en Angleterre.",
                "slug" => "conjuring-2-le-cas-enfield"
            ],
            [
                "title" => "Conjuring 3 : Sous l'emprise du diable",
                "release_date" => "2021-06-09",
                "duration" => "112",
                "rating" => "-12",
                "description" => "Les Warren plongent dans une affaire judiciaire où un homme clame avoir été possédé par un démon.",
                "slug" => "conjuring-3-sous-lemprise-du-diable"
            ],
            [
                "title" => "Imaginary",
                "release_date" => "2024-04-05",
                "duration" => "104",
                "rating" => "-12",
                "description" => "Une entité maléfique émerge de l'imagination d'une enfant, créant une terreur indescriptible pour sa famille.",
                "slug" => "imaginary"
            ]
        ];


        // Insérer les films dans la table movie
        $this->db->table('movies')->insertBatch($data);
    }
}
