drop table cards;

create table cards (
nom varchar(50),
effect varchar(300),
img varchar(100),
energies varchar(20),
id serial,
type varchar(5),
atk integer,
def integer,
origine varchar(10)
);

insert into cards values
('void','void','void','void',1,'',-1,-1,'void'),
('centaure','effect','void','bbn',2,'mob',12,16,'grec'),
('hydre','effect','void','bbb',3,'mob',26,22,'grec'),
('glaive','effect','void','g',4,'equi',-1,-1,'grec'),
('hoplite','effect','void','gg',5,'mob',13,11,'grec'),
('phenix','effect','void','ffff',6,'mob',20,28,'egyptien')
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

create table decks;