drop table cards;

create table cards (
nom varchar(50),
effect varchar(300),
energies varchar(20),
id serial,
type varchar(5),
atk integer,
def integer,
origine varchar(10)
);

insert into cards values
('Achille','Chimere',     'g',         1,      'mob',         25,     17,     'Grec'),
('Aegis','Si le personnage equipe doit etre detruit, detruisez cette carte a la place',     '',          2,      'equi',      -1,     -1,     'Grec'),
('Affrontement de gladiateur','Un personnage adverse doit combattre un de vos personnages',     'g',          3,      'def',      -1,     -1,     'Romain'),
('Ah Muzen Cab',      'Attaque sans etre attaque, peut attaquer 2x par tours',     'a',            4,      'dieu',     17,     21,     'Maya'),
('Ao Kuang',     'Vos Dragons sont gratuits',     'd',           5,      'dieu',      29,     27,     'Chinois'),
('Amakusa Shiro','effect',     's',         6,      'mob',      17,     21,     'Japonais'),
('Amateratsu','Vos autres Soldats gagnent 3 points d attaque et de defense', 'l', 7, 'dieu', 25, 28, 'Japonais'),
('Ammit','Vous rend les degats qu il inflige. ne peut pas etre affecte par les effets adverses', 't', 8, 'mob', 22, 17, 'Egyptien'),
('Charon','Chaque tour, vous devez defausser une carte de votre main', 'm', 9, 'mob', 18, 21, 'Grec')
;

drop table users;

create table users (
login varchar(50),
mdp varchar(30),
rank integer,
id serial
);

insert into users values
('void','taspasaetreici',3,1),
('thiathias','4012',1,2),
('totor','uuh',2,3),
('rylh','oten',1,4),
('dri','dri',2,5);

drop table decks;

create table decks (
    owner varchar(30),
    nom varchar(10),
    liste varchar(300),
    id serial,
    nb integer
);

insert into decks values
('totor', 'PremierD', '0001:0003:0007:0005', 1, 3 ),
('totor', 'Testu', '0004', 2, 1),
('thiathias', '42', '0002', 3, 0)
;