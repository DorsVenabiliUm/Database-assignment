CREATE TABLE people(
	a_id int,
	c_id int,
	first_name varchar(30),
	last_name varchar(30),
	PRIMARY KEY(a_id,c_id)
	);
	ALTER TABLE people
		ADD INDEX x(a_id);
	ALTER TABLE people
		ADD INDEX y(c_id);
CREATE TABLE sub_committee(
	id int,
	chair_id int,
	name varchar(30) NOT NULL,
	FOREIGN KEY(id) REFERENCES people(c_id),
	FOREIGN KEY(chair_id) REFERENCES people(c_id),
	PRIMARY KEY(id, name)
	);
	

CREATE TABLE attendee(
	id int PRIMARY KEY,
	conference_attend varchar(30),
	professor_id int,
	student_id int,
	sponsor_id int,
	FOREIGN KEY (id) REFERENCES people(a_id) ON DELETE CASCADE
	);

CREATE TABLE  sponsor(
	ss_id int PRIMARY KEY,
	company varchar(30),
	fee int,
	FOREIGN KEY(ss_id) REFERENCES attendee(id) ON DELETE CASCADE
	);
		
CREATE TABLE company(
	name varchar(30) not null PRIMARY KEY,
	level_of_sponsor varchar(30),
	total_number_of_mails int,
	mails_sent int,
	mails_left int,
	sponsor_id int,
	money_donated int,
	FOREIGN KEY(sponsor_id) REFERENCES sponsor(ss_id) ON DELETE CASCADE
	);

	
CREATE TABLE job(
	title varchar(30),
	location varchar(30),
	payrate varchar(30),
	company_name varchar(30) NOT NULL PRIMARY KEY,
	FOREIGN KEY (company_name) REFERENCES company(name) ON DELETE CASCADE
	);

	
CREATE TABLE student(
	s_id int PRIMARY KEY,
	fee int,
	room_num int,
	FOREIGN KEY(s_id) REFERENCES attendee(id) ON DELETE CASCADE
	);

	
CREATE TABLE room(
	room_number int,
	number_of_beds int,
	sid int,
	PRIMARY KEY(room_number, number_of_beds),
	FOREIGN KEY(sid) REFERENCES student(s_id) ON DELETE CASCADE
	);
	
	
	
CREATE TABLE professor(
	p_id int PRIMARY KEY,
	fee int,
	FOREIGN KEY(p_id) REFERENCES attendee(id) ON DELETE CASCADE
	);
	
CREATE TABLE conference(
	name varchar(30),
	dayin varchar(30),
	attendee_id int,
	session_topic varchar(30),
	money_invoke int,
	PRIMARY KEY(name, dayin),
	FOREIGN KEY(attendee_id) REFERENCES attendee(id) ON DELETE CASCADE
	);
	
CREATE TABLE session(
	dayin varchar(30) NOT NULL,
	start_time varchar(30),
	end_time varchar(30),
	room_number int,
	speaker_id int,
	topic varchar(30) NOT NULL,
	conference_in varchar(30),
	PRIMARY KEY(topic, dayin),
	FOREIGN KEY(conference_in) REFERENCES conference(name),
	FOREIGN KEY(speaker_id) REFERENCES attendee(id) ON DELETE CASCADE
	);
	
	ALTER TABLE session
		ADD INDEX i(dayin);
	ALTER TABLE session
		ADD INDEX n(topic);
	
	ALTER TABLE people
		ADD FOREIGN KEY (a_id) REFERENCES attendee(id) ON DELETE CASCADE;
	ALTER TABLE people
		ADD FOREIGN KEY (c_id) REFERENCES sub_committee(id) ON DELETE CASCADE;
		
	ALTER TABLE attendee 
		ADD FOREIGN KEY(student_id) REFERENCES student(s_id);
	ALTER TABLE attendee 
		ADD FOREIGN KEY(professor_id) REFERENCES professor(p_id);
	ALTER TABLE attendee 
		ADD FOREIGN KEY(sponsor_id) REFERENCES sponsor(ss_id);
	
		
	
	ALTER TABLE attendee
		ADD FOREIGN KEY (conference_attend) REFERENCES conference(name) ON DELETE CASCADE;
		
	ALTER TABLE sponsor
		ADD FOREIGN KEY(company) REFERENCES company(name) ON DELETE CASCADE;
		
	ALTER TABLE student
		ADD FOREIGN KEY(room_num) REFERENCES room(room_number) ON DELETE CASCADE;
		
	ALTER TABLE conference
		ADD FOREIGN KEY(dayin) REFERENCES Session(dayin) ON DELETE CASCADE;
	ALTER TABLE conference
		ADD FOREIGN KEY(session_topic) REFERENCES Session(topic) ON DELETE CASCADE;

	INSERT INTO people(a_id, c_id, first_name, last_name) VALUES
		(1, 0, 'MINGSONG', 'ZHAI');
	INSERT INTO people(a_id, c_id, first_name, last_name) VALUES
		(2, 1, 'Yi', 'Zhan');
	INSERT INTO people(a_id, c_id, first_name, last_name) VALUES
		(3, 2, 'Zhicheng', 'Shen');
	INSERT INTO people(a_id, c_id, first_name, last_name) VALUES
		(4, 0, 'Shuai', 'Ge');
	INSERT INTO people(a_id, c_id, first_name, last_name) VALUES
		(5, 3 ,'Mei', 'Nv');

	INSERT INTO attendee(id) VALUES
		(1),
		(2),
		(3),
		(4),
		(5);

	INSERT INTO sub_committee(id, chair_id, name) VALUES
		(1, 1, 'committee1'),
		(2, 1, 'committee1'),
		(3, 3, 'committee2');
		
	INSERT INTO session(dayin, start_time, end_time, room_number, speaker_id, topic) VALUES
		('DAY1', '8:00', '10:00', 215, 4, 'ER Diagram');
	INSERT INTO session(dayin, start_time, end_time, room_number, speaker_id, topic) VALUES
		('DAY2', '8:00', '10:00', 216, 5, 'Relational Model');
		
	INSERT INTO conference(name, dayin, attendee_id) VALUES
		('How to use sql', 'DAY1', 4);
	INSERT INTO conference(name, dayin, attendee_id) VALUES
		('How to use sql', 'DAY2', 5);
		
		
	INSERT INTO student(s_id, fee) VALUES
		(1, 50);
		
	INSERT INTO room(room_number, number_of_beds, sid) VALUES
		(001, 2, 1);
		
	INSERT INTO professor (p_id, fee) VALUES
		(2, 100);
		
	INSERT INTO sponsor (ss_id,fee) VALUES
		(4, 0),
		(5, 0);
		
	INSERT INTO company(name, level_of_sponsor, total_number_of_mails, mails_sent, sponsor_id,money_donated) VALUES
		('ZHONGSHIHUA', 'silver', 3, 0,  5,3000),
		('ZHONGSHIYOU', 'gold', 4, 1,  4,5000);
	SELECT(total_number_of_mails-mails_sent) AS mails_left FROM company;
	UPDATE company SET mails_left = (total_number_of_mails-mails_sent);
		
	INSERT INTO job(title, location, payrate, company_name) VALUES
		('driver', 'Princess street', '20 per hour', 'ZHONGSHIHUA');
		
	UPDATE attendee SET conference_attend = 'How to use sql' 
					WHERE id = 1;
	UPDATE attendee SET conference_attend = 'How to use sql' 
					WHERE id = 2;
	UPDATE attendee SET conference_attend = 'How to use sql' 
					WHERE id = 3;
	UPDATE attendee SET conference_attend = 'How to use sql' 
					WHERE id = 4;
	UPDATE attendee SET conference_attend = 'How to use sql' 
					WHERE id = 5;
					
	UPDATE student SET room_num = 1
				   WHERE s_id = 1;
	
	UPDATE sponsor SET company = 'ZHONGSHIHUA'
				   WHERE ss_id = 4;
	UPDATE sponsor SET company = 'ZHONGSHIYOU'
				   WHERE ss_id = 5;

	UPDATE session SET conference_in = 'How to use sql'
				   Where topic = 'ER Diagram';
	UPDATE session SET conference_in = 'How to use sql'
				   Where topic = 'Relational Model';
	
	UPDATE conference SET session_topic = 'ER Diagram'
					  WHERE name = 'How to use sql';
	UPDATE conference SET session_topic = 'ER Diagram'
					  WHERE name = 'How to use sql';
			
	UPDATE attendee SET  professor_id = 2
					WHERE  id = 2;
	UPDATE attendee SET student_id =1
					WHERE id =1;
	UPDATE attendee SET sponsor_id = 4
					WHERE id = 4;
	UPDATE attendee SET sponsor_id = 5
					WHERE id =5;
