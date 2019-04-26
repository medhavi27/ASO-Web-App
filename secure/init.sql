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
CREATE TABLE 'events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'description' TEXT,
    'time' TEXT NOT NULL,
    'location' TEXT NOT NULL

);
CREATE TABLE 'blogs' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'title' TEXT NOT NULL,
    'link' TEXT NOT NULL,
    'date' TEXT NOT NULL,
    'author' TEXT NOT NULL
);
CREATE TABLE 'members_and_events' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'member_id' INTEGER NOT NULL,
    'event_id' INTEGER NOT NULL
);

CREATE TABLE 'donations' (
    'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    'donor_name' TEXT NOT NULL,
    'amount' INTEGER NOT NULL,
    'cause' TEXT NOT NULL
);

-- TODO: initial seed data

-- TODO: FOR HASHED PASSWORDS, LEAVE A COMMENT WITH THE PLAIN TEXT PASSWORD!

COMMIT;
