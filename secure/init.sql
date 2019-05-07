-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- TODO: create tables
CREATE TABLE 'users' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'username' TEXT UNIQUE NOT NULL,
    'password' TEXT NOT NULL
);

-- Users seed data
INSERT INTO `users` (
username,
password
) VALUES
('jcn66', '$2y$10$G8EoHLs5K289N4o3V.8aR.8EZse7UBgh.Qdl4sLH9ouXs5nDUQ3y2');
-- password: jH89345k
INSERT INTO `users` (
username,
password
) VALUES
('kws77', '$2y$10$zGqJKFJDymFUA54vW95/4.RDaP9kBXubSZ9hw3t5HocUZp.bbvefa');
-- password: kelephant86
INSERT INTO `users` (
username,
password
) VALUES
('eboard23', '$2y$10$fsMB8HL4ClKOzxo5kJoRZOQIjJfvRJe7UkOJ8fyPTPIbXqGDu38qW');
-- password: eboard2332



CREATE TABLE 'sessions' (
	'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	'user_id' INTEGER NOT NULL,
	'session' TEXT NOT NULL UNIQUE
);

CREATE TABLE 'members' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'name' TEXT NOT NULL,
    'netid' TEXT NOT NULL UNIQUE,
    'year' TEXT NOT NULL,
    'alumni' BOOLEAN NOT NULL,
    'eboard' BOOLEAN NOT NULL,
    'major' TEXT,
    'minor' TEXT,
    'bio' TEXT,
    'phonenumber' INTEGER
);



INSERT INTO members
    (name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Armine Kalbakian', 'ask267', 'Junior', 'FALSE', 'TRUE', 'Anthropology & Archaeology', ' Business, Global Health', 'Little Armenia, Los Angeles, CA', '404-044-0000');

INSERT INTO members
    (name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Margot Chirkjian', 'mkc224', 'Junior', 'FALSE', 'TRUE', 'Global and Public Health Sciences', ' ', 'Baltimore, Maryland', '');

INSERT INTO members
    (name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Salpi Bocchieriyan', 'sab475', '2nd Year, PhD Student', 'TRUE', 'TRUE', 'Archaeology', ' ', 'Denver, Colorado', ' ');

INSERT INTO members
    (name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Tigran Mehrabyan', 'tm545', 'Senior', 'FALSE', 'TRUE', 'Biological Engineering', '', 'Yerevan, Armenia', ' ');

INSERT INTO members
    (name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Prof. Lori Khatchadourian', 'lk323', 'Faculty Advisor', 'FALSE', 'TRUE', 'Department: Near Eastern Studies; Archaeology', ' ', 'Ithaca, NY', ' ');

INSERT INTO members(name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Maya Martirossyan
', 'mmm457', 'First Year, PhD Student', 'FALSE', 'FALSE', 'Department: Materials Science and Engineering', ' ', 'Glendale, California', ' ');

INSERT INTO members(name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Alice Gevorgyan
', 'ag997', 'Freshman', 'FALSE', 'FALSE', 'Plant Sciences', ' ', 'San Carlos, California', ' ');


INSERT INTO members(name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Anna Srapionyan
', 'as3348', 'PhD 2019', 'TRUE', 'FALSE', 'Applied Mathematics', ' ', 'Yerevan, Armenia', ' ');

INSERT INTO members(name, netid, year, alumni, eboard, major, minor, bio, phonenumber)
values('Mané Mehrabyan
', 'mm2327', 'Class of 2017', 'TRUE', 'FALSE', 'Design and Environmental Analysis', 'Business, Theater', 'Yerevan, Armenia', ' ');


CREATE TABLE 'member_images' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'member_id' INTEGER NOT NULL,
    'ext' TEXT NOT NULL,
    'membername' TEXT NOT NULL
);


INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(1,'jpg','Armine Kalbakian');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(2,'jpg','Margot Chirikjian');
-- source: original content, Jasmine Ng's image

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(3,'jpg','Salpi Bocchieriyan');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(4,'jpg','Tigran Mehrabyan');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(5,'jpg','Prof. Lori Khatchadourian');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(6,'jpg','Maya Martirossyan');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(7,'jpg','Alice Gevorgyan');
-- source: original content, Armenian Students Organization at Cornell

INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(8,'jpg','Anna Srapionyan');
-- source: original content, Armenian Students Organization at Cornell


INSERT INTO `member_images` (
member_id,
ext,
membername
) VALUES
(9,'jpg','Mané Mehrabyan');
-- source: original content, Armenian Students Organization at Cornell

CREATE TABLE 'gal_images' (
     'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'filename' TEXT NOT NULL,
    'ext' TEXT NOT NULL,
    'alt' TEXT
);

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('1', 'jpg', 'Our Members at Clubfest');
-- source: original content, Armenian Students Organization at Cornell
INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('2', 'jpg', 'Our President in Armenia');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('3', 'jpg', 'Our Annual Picnic');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('4', 'jpg', 'Students at Clubfest');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('5', 'jpg', 'Proud Armenians and their flag');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('6', 'jpg', 'Our members bonding over a meal');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('7', 'jpg', 'Our members enjoying a meal');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('8', 'jpg', 'Our president showing some Armenian pride');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('9', 'jpg', 'Our members feeling the love at Mann Library');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('10', 'jpg', 'Our President, Armine Kalbakian');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('11', 'jpg', 'Never too crowded for some Armenian pride!');
-- source: original content, Armenian Students Organization at Cornell

INSERT into 'gal_images'
    (filename, ext, alt)
VALUES
    ('12', 'jpg', 'A wonderful day in the park');
-- source: original content, Armenian Students Organization at Cornell


CREATE TABLE 'events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'description' TEXT,
    'time' TEXT NOT NULL,
    'location' TEXT NOT NULL
);

INSERT INTO `events` (
title,
description,
time,
location
) VALUES
('Awareness Dinner','A chance to learn about the history of Armenia', '02/12/19, 8 PM', 'WSH 220');

INSERT INTO `events` (
title,
description,
time,
location
) VALUES
('Annual BBQ','Come eat with our members and professors', '02/23/19, 5 PM', 'Stewart Park');
INSERT INTO `events` (
title,
description,
time,
location
) VALUES
('Ice Cream Social','Come meet the members and eat Cornell Dairy Treats!', '03/29/19, 3 PM', 'Klarman Atrium');



CREATE TABLE 'blogs' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'link' TEXT NOT NULL,
    'date' TEXT NOT NULL,
    'author' TEXT NOT NULL
);

INSERT INTO `blogs` (
title,
link,
date,
author
) VALUES
('Today marks 104th anniversary of Armenian Genocide','https://www.panorama.am/en/news/2019/04/24/Armenian-Genocide/2103987?fbclid=IwAR0AkM1lDNBww8uDHSBKXIduFIumlN0UhEvk4WFYqHQelWFtOVJi2II5h6I', 'April 24, 2019', 'Panorama Staff');

INSERT INTO `blogs` (
title,
link,
date,
author
) VALUES
('15 Reasons why you should go to Armenia','https://www.bloomberg.com/news/photo-essays/2019-04-23/armenia-travel-guide-churches-brandy-mountains?fbclid=IwAR1F9E9HGVoth9v3fl3Yh68QfUi-V4HWw2YlSaYiWtW3B8RgkjnJU_tlKbk', 'April 23, 2019', 'Benjamin Kemper');

INSERT INTO `blogs` (
title,
link,
date,
author
) VALUES
('Today marks prominent writer Hovhannes Tumanyan’s 150th birthday','https://www.panorama.am/en/news/2019/02/19/Hovhannes-Tumanyan-birthday/2074576?fbclid=IwAR21VU28H2gWO55W78_rNEKgo7EnCKTNUDzib-E5IlMf3PZC3u889akyO44', 'April 30, 2019', 'Panorama Staff');
INSERT INTO `blogs` (
title,
link,
date,
author
) VALUES
('Armenia is a Wine Lovers Paradise','https://www.deccanchronicle.com/sunday-chronicle/triptease/050519/armenia-is-a-wine-lovers-paradise.html?fbclid=IwAR03VbUcVtUN9ua04ILwh9HAV1dXTuhbvtfF0YBTKeA7V8YUGc868gAnpgo', 'May 6, 2019', 'Benjamin Kemper');

CREATE TABLE 'event_suggestions' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'description' TEXT NOT NULL
);

INSERT INTO `event_suggestions` (
title, description
) VALUES
("Ice Skating Fundraiser","You should have an ice skating event for the public to donate");
INSERT INTO `event_suggestions` (
title, description
) VALUES
("Armenian Food Night","Something like the Chinese and Filipino food nights");
INSERT INTO `event_suggestions` (
title, description
) VALUES
("Armenian Movie Night","Show off art from Armenia");




CREATE TABLE 'donations' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'donor_name' TEXT NOT NULL,
    'amount' INTEGER NOT NULL,
    'cause' TEXT NOT NULL
);

INSERT INTO `donations` (
donor_name,amount,
cause
) VALUES
('Jasmine Ng',10,'Alumnae donation');

-- TODO: initial seed data

-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!

CREATE TABLE `members_tags`
(
    `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `tag` TEXT NOT NULL UNIQUE
);

INSERT INTO `members_tags`
(
tag)
VALUES
    ('name');

INSERT INTO `members_tags`
(
tag)
VALUES
    ('year');

INSERT INTO `members_tags`
(
tag)
VALUES
    ('major');


COMMIT;
