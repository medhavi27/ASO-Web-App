-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables
CREATE TABLE 'users' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'username' TEXT UNIQUE NOT NULL,
    'password' TEXT NOT NULL
);

-- Users seed data
INSERT INTO `users` (username, password) VALUES ('jcn66', '$2y$10$G8EoHLs5K289N4o3V.8aR.8EZse7UBgh.Qdl4sLH9ouXs5nDUQ3y2'); -- password: jH89345k
INSERT INTO `users` (username, password) VALUES ('kws77', '$2y$10$zGqJKFJDymFUA54vW95/4.RDaP9kBXubSZ9hw3t5HocUZp.bbvefa'); -- password: kelephant86


CREATE TABLE 'sessions' (
	'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	'user_id' INTEGER NOT NULL,
	'session' TEXT NOT NULL UNIQUE
);

CREATE TABLE 'members' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'name' TEXT NOT NULL,
    'netid' TEXT NOT NULL UNIQUE,
    'year' INTEGER NOT NULL,
    'alumni' BOOLEAN NOT NULL,
    'eboard' BOOLEAN NOT NULL,
    'major' TEXT,
    'minor' TEXT,
    'bio' TEXT,
    'phonenumber' INTEGER
);

CREATE TABLE 'member_images' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'member_id' INTEGER NOT NULL,
    'ext' TEXT NOT NULL,
    'name' TEXT NOT NULL
);

INSERT INTO `member_images` (member_id, ext, name) VALUES (1,'.jpg','Armine Kalbakian');

INSERT INTO `member_images` (member_id, ext, name) VALUES (2,'.jpg','Jasmine Ng');

CREATE TABLE 'events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'description' TEXT,
    'time' TEXT NOT NULL,
    'location' TEXT NOT NULL
);

INSERT INTO `events` (title, description, time, location) VALUES ('Awareness Days','Monday and Tuesday is discussion', 'Monday 12:00 PM', 'WSH');

INSERT INTO `events` (title, description, time, location) VALUES ('Ice Cream Social','Come meet the members', 'Wednesday 1:00 PM', 'WSH');

CREATE TABLE 'blogs' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'link' TEXT NOT NULL,
    'date' TEXT NOT NULL,
    'author' TEXT NOT NULL
);

INSERT INTO `blogs` (title, link, date, author) VALUES ('Today marks 104th anniversary of Armenian Genocide','https://www.panorama.am/en/news/2019/04/24/Armenian-Genocide/2103987?fbclid=IwAR0AkM1lDNBww8uDHSBKXIduFIumlN0UhEvk4WFYqHQelWFtOVJi2II5h6I', 'April 24 2019', 'Panorama');

INSERT INTO `blogs` (title, link, date, author) VALUES ('15 Reasons why you should go to Armenia','https://www.bloomberg.com/news/photo-essays/2019-04-23/armenia-travel-guide-churches-brandy-mountains?fbclid=IwAR1F9E9HGVoth9v3fl3Yh68QfUi-V4HWw2YlSaYiWtW3B8RgkjnJU_tlKbk', 'April 23 2019', 'Benjamin Kemper');

CREATE TABLE 'members_and_events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'member_id' INTEGER NOT NULL,
    'event_id' INTEGER NOT NULL
);

INSERT INTO `members_and_events` (member_id,event_id) VALUES (1,1);
INSERT INTO `members_and_events` (member_id,event_id) VALUES (2,2);

CREATE TABLE 'donations' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'donor_name' TEXT NOT NULL,
    'amount' INTEGER NOT NULL,
    'cause' TEXT NOT NULL
);

INSERT INTO `donations` (donor_name,amount, cause) VALUES ('Jasmine Ng',10,'Alumnae donation');

-- TODO: initial seed data

-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!

COMMIT;
