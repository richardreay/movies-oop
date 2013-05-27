CREATE TABLE genres (
	genre_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(80) NOT NULL,
	PRIMARY KEY (genre_id)
);
CREATE TABLE countries (
	country_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	PRIMARY KEY (country_id)
);
CREATE TABLE languages (
	language_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	PRIMARY KEY (language_id)
);
CREATE TABLE actors (
	actors_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	fname VARCHAR(200) NOT NULL,
	lname VARCHAR(200) NOT NULL,
	gender CHAR(1) NOT NULL,
	dob DATE NOT NULL,
	image VARCHAR(80),
	nationality SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY (actors_id),
	FOREIGN KEY (nationality) REFERENCES countries(country_id)
);
CREATE TABLE directors (
	director_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	fname VARCHAR(200) NOT NULL,
	lname VARCHAR(200) NOT NULL,
	gender CHAR(1) NOT NULL,
	dob DATE NOT NULL,
	image VARCHAR(80),
	nationality SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY (director_id),
	FOREIGN KEY (nationality) REFERENCES countries(country_id)
);
CREATE TABLE movies (
	movie_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	title VARCHAR(200) NOT NULL,
	release_date DATE NOT NULL,
	director_id MEDIUMINT UNSIGNED NOT NULL,
	duration SMALLINT UNSIGNED NOT NULL,
	synopsis TEXT NOT NULL,
	country_id SMALLINT UNSIGNED NOT NULL,
	language_id SMALLINT UNSIGNED NOT NULL,
	poster VARCHAR(80),
	PRIMARY KEY (movie_id),
	FOREIGN KEY (country_id) REFERENCES countries(country_id),
	FOREIGN KEY (language_id) REFERENCES languages(language_id),
	FOREIGN KEY (director_id) REFERENCES directors(director_id)
);
CREATE TABLE movies_actors (
	movie_id MEDIUMINT UNSIGNED NOT NULL REFERENCES movies(movie_id),
	actors_id MEDIUMINT UNSIGNED NOT NULL REFERENCES actors(actors_id),
	PRIMARY KEY (movie_id, actors_id)
);
CREATE TABLE genres_movies (
	movie_id MEDIUMINT UNSIGNED NOT NULL REFERENCES movies(movie_id),
	genre_id SMALLINT UNSIGNED NOT NULL REFERENCES genres(genre_id),
	PRIMARY KEY (movie_id, genre_id)
);

INSERT INTO countries (name) VALUES 
('United States'),
('United Kingdom'),
('France'),
('Italy'),
('Germany'),
('Spain'),
('Portugal'),
('Sweden'),
('Norway'),
('Denmark'),
('Finland'),
('Russia'),
('Canada'),
('Brazil'),
('Argentina'),
('Mexico'),
('Japan'),
('China'),
('South Korea'),
('Australia'),
('New Zealand'),
('Ireland');

INSERT INTO languages (name) VALUES
('English'),
('French'),
('German'),
('Spanish'),
('Portugese'),
('Russian'),
('Korean'),
('Mandarin'),
('Arabic');

INSERT INTO genres (name) VALUES
('Horror'),
('Thriller'),
('Drama'),
('Comedy'),
('Romance'),
('Sci-Fi'),
('Action'),
('War'),
('Western'),
('Adventure'),
('Crime'),
('History');

INSERT INTO directors (fname, lname, gender, dob, image, nationality) VALUES
('Frank', 'Darabont', 'm', '1959-01-28', 'fdarabont.jpg', '3'),
('Francis', 'Ford Coppola', 'm', '1939-04-07', 'ffordcoppola.jpg', '1'),
('Quentin', 'Tarantino', 'm', '1963-03-27', 'qtarantino.jpg', '1'),
('Sergio', 'Leone', 'm', '1929-01-03', 'sleone.jpg', '4'),
('Sidney', 'Lumet', 'm', '1924-06-25', 'slumet.jpg', '1'),
('Christopher', 'Nolan', 'm', '1970-07-30', 'cnolan.jpg', '2'),
('Steven', 'Spielberg', 'm', '1946-12-18', 'sspielberg.jpg', '1'),
('Peter', 'Jackson', 'm', '1961-10-31', 'fdarabont.jpg', '21'),
('David', 'Fincher', 'm', '1962-08-28', 'dfincher.jpg', '1'),
('Irvin', 'Kershner', 'm', '1923-04-29', 'ikershner.jpg', '1');

INSERT INTO movies (title, release_date, director_id, duration, synopsis, country_id, language_id, poster) VALUES
('The Shawshank Redemption', '1995-02-17', '1', '142', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', '1', '1', 'theshawshankredemption.jpg'),
('The Godfather', '1972-03-24', '2', '175', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', '1', '1', 'thegodfather.jpg'),
('Pulp Fiction', '1994-10-21', '3', '154', 'The lives of two mob hit men, a boxer, a gangster''s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', '1', '1', 'pulpfiction.jpg'),
('The Good, the Bad and the Ugly', '1966-12-23', '4', '161', 'A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.', '4', '1', 'thegoodthebadandtheugly.jpg'),
('12 Angry Men', '1957-04-01', '5', '96', 'A dissenting juror in a murder trial slowly manages to convince the others that the case is not as obviously clear as it seemed in court.', '1', '1', '12angrymen.jpg'),
('The Dark Knight', '2008-07-24', '6', '152', 'When Batman, Gordon and Harvey Dent launch an assault on the mob, they let the clown out of the box, the Joker, bent on turning Gotham on itself and bringing any heroes down to his level.', '1', '1', 'thedarkknight.jpg'),
('Schindler''s List', '1993-02-18', '7', '195', 'In Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', '1', '1', 'schindlerslist.jpg'),
('The Lord of the Rings: The Return of the King', '2003-12-17', '8', '201', 'Gandalf and Aragorn lead the World of Men against Sauron''s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', '1', '1', 'returnoftheking.jpg'),
('Fight Club', '1999-11-12', '9', '139', 'An insomniac office worker looking for a way to change his life crosses paths with a devil-may-care soap maker and they form an underground fight club that evolves into something much, much more...', '1', '1', 'fightclub.jpg'),
('Star Wars: Episode V - The Empire Strikes Back', '1980-05-21', '10', '124', 'As Luke trains with Master Yoda to become a Jedi Knight, his friends evade the Imperial fleet under the command of Darth Vader who is obsessed with turning Skywalker to the Dark Side of the Force.', '1', '1', 'theempirestrikesback.jpg');

INSERT INTO actors (fname, lname, gender, dob, image, nationality) VALUES
('Tim', 'Robbins', 'm', '1958-10-16', 'timrobbins.jpg', '1'),
('Morgan', 'Freeman', 'm', '1937-06-01', 'morganfreeman.jpg', '1'),
('Marlon', 'Brando', 'm', '1924-04-03', 'marlonbrando.jpg', '1'),
('Al', 'Pacino', 'm', '1940-04-25', 'alpacino.jpg', '1'),
('John', 'Travolta', 'm', '1954-02-18', 'johntravolta.jpg', '1'),
('Samuel', 'L. Jackson', 'm', '1948-12-21', 'samuelljackson.jpg', '1'),
('Eli', 'Wallach', 'm', '1915-12-07', 'eliwallach.jpg', '1'),
('Clint', 'Eastwood', 'm', '1930-05-31', 'clinteastwood.jpg', '1'),
('Martin', 'Balsam', 'm', '1919-11-04', 'martinbalsam.jpg', '1'),
('John', 'Fiedler', 'm', '1925-02-03', 'johnfiedler.jpg', '1'),
('Christian', 'Bale', 'm', '1974-01-30', 'christianbale.jpg', '2'),
('Heath', 'Ledger', 'm', '1979-04-04', 'heathledger.jpg', '20'),
('Liam', 'Neeson', 'm', '1952-06-07', 'liamneeson.jpg', '22'),
('Ben', 'Kingsley', 'm', '1943-12-31', 'benkingsley.jpg', '2'),
('Ian', 'McKellen', 'm', '1939-05-25', 'ianmckellen.jpg', '2'),
('Viggo', 'Mortensen', 'm', '1958-10-20', 'viggomortensen.jpg', '1'),
('Edward', 'Norton', 'm', '1969-08-18', 'edwardnorton.jpg', '1'),
('Brad', 'Pitt', 'm', '1963-12-18', 'bradpitt.jpg', '1'),
('Mark', 'Hamill', 'm', '1951-09-25', 'markhamill.jpg', '1'),
('Harrison', 'Ford', 'm', '1942-07-13', 'harrisonford.jpg', '1');

INSERT INTO movies_actors (movie_id, actors_id) VALUES
('1', '1'),
('1', '2'),
('2', '3'),
('2', '4'),
('3', '5'),
('3', '6'),
('4', '7'),
('4', '8'),
('5', '9'),
('5', '10'),
('6', '11'),
('6', '12'),
('7', '13'),
('7', '14'),
('8', '15'),
('8', '16'),
('9', '17'),
('9', '18'),
('10', '19'),
('10', '20');

INSERT INTO genres_movies (genre_id, movie_id) VALUES
('1', '3'),
('1', '11'),
('2', '11'),
('2', '3'),
('3', '11'),
('3', '2'),
('4', '10'),
('4', '9'),
('5', '3'),
('6', '7'),
('6', '11'),
('6', '3'),
('6', '2'),
('7', '3'),
('7', '8'),
('7', '12'),
('8', '7'),
('8', '10'),
('9', '3'),
('10', '7'),
('10', '10'),
('10', '6');




CREATE TABLE users (
	id int(11) NOT NULL auto_increment,
	email char(128) NOT NULL,
	password char(128) NOT NULL,
	user_salt varchar(50) NOT NULL,
	is_verified tinyint(1) NOT NULL,
	is_active tinyint(1) NOT NULL,
	is_admin tinyint(1) NOT NULL,
	verification_code varchar(65) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE logged_in_member (
	id int(11) NOT NULL auto_increment,
	user_id int(11) NOT NULL,
	session_id char(32) binary NOT NULL,
	token char(128) NOT NULL,
	PRIMARY KEY (id)
);










