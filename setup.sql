CREATE TABLE TheUser (
  computingID VARCHAR(50) PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  pwd VARCHAR(255),
  UNIQUE (email)
);

CREATE TABLE Professor (
  profID VARCHAR(50)  PRIMARY KEY,
  email VARCHAR(50) NOT NULL,
  prof_name VARCHAR(50) NOT NULL,
  UNIQUE (email)
);

CREATE TABLE writtenByUser (
  reviewID INT PRIMARY KEY,
  computingID VARCHAR(50) NOT NULL,
  FOREIGN KEY (computingID) REFERENCES TheUser(computingID)
);

CREATE TABLE taughtBy (
  classID INT PRIMARY KEY,
  profID VARCHAR(50) NOT NULL,
  -- FOREIGN KEY (classID) REFERENCES classIdentity(classID),
  FOREIGN KEY (profID) REFERENCES Professor(profID)
);

CREATE TABLE classDescription (
  name VARCHAR(50) NOT NULL,
  section INT NOT NULL,
  subtitle TEXT,
  description TEXT,
  credits INT NOT NULL,
  PRIMARY KEY (name, section)
  -- FOREIGN KEY (name) REFERENCES classType(name)
);

CREATE TABLE classType (
  name VARCHAR(50) PRIMARY KEY,
  department VARCHAR(50) NOT NULL
);

CREATE TABLE classIdentity (
  classID INT PRIMARY KEY,
  section INT NOT NULL,
  name VARCHAR(50) NOT NULL
  -- FOREIGN KEY (section) REFERENCES classDescription(section),
  -- FOREIGN KEY (name) REFERENCES classDescription(name)
);

CREATE TABLE ClassRequirement (
  classID INT NOT NULL,
  requirement VARCHAR(50) NOT NULL,
  PRIMARY KEY (classID, requirement),
  FOREIGN KEY (classID) REFERENCES classIdentity(classID)
);

CREATE TABLE Review (
  reviewID INT PRIMARY KEY AUTO_INCREMENT,
  rating DECIMAL(3,2) CHECK (rating <= 5 AND rating >= 1),
  reviewDescription TEXT,
  reviewTerm TEXT,
  reviewDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE classReview (
  reviewID INT PRIMARY KEY,
  difficulty INT NOT NULL,
  hoursOutside INT NOT NULL,
  classID INT NOT NULL,
  -- FOREIGN KEY (reviewID) REFERENCES Review(reviewID),
  FOREIGN KEY (classID) REFERENCES classIdentity(classID)
);

CREATE TABLE professorReview (
  reviewID INT PRIMARY KEY,
  leniency INT NOT NULL,
  profID VARCHAR(50) NOT NULL,
  -- FOREIGN KEY (reviewID) REFERENCES Review(reviewID) ON DELETE CASCADE
  FOREIGN KEY (profID) REFERENCES Professor(profID)
);


-- Insert dummy data into User table
-- INSERT INTO TheUser (computingID, name, email, profilePicLink)
-- VALUES ('user1', 'John Smith', 'john.smith@example.com', 'http://example.com/profilepic/user1'),
--        ('user2', 'Jane Doe', 'jane.doe@example.com', 'http://example.com/profilepic/user2'),
--        ('user3', 'David Lee', 'david.lee@example.com', 'http://example.com/profilepic/user3');

-- Insert dummy data into Review table
-- INSERT INTO Review (reviewID, rating, reviewDescription, reviewTerm, reviewDate)
-- VALUES (1, 4.5, 'Great prof, highly recommend!', 'Spring 2023','2022-01-01'),
--        (2, 3.0, 'Not bad, but could be better', 'Spring 2021','2022-01-02'),
--        (3, 2.5, 'Would not recommend this prof', 'Fall 2022','2022-01-03'),
--        (4, 4.0, 'Interesting class, learned a lot', 'Spring 2021','2022-01-04'),
--        (5, 3.5, 'Decent class, nothing special','Spring 2020', '2022-01-05'),
--        (6, 2.0, 'Terrible class, avoid if possible', 'Fall 2019','2022-01-06');

-- Insert dummy data into writtenByUser table
-- INSERT INTO writtenByUser (reviewID, computingID)
-- VALUES (1, 'user1'),
--        (2, 'user2'),
--        (3, 'user3'),
-- (4, 'user1'),
--        (5, 'user2'),
--        (6, 'user3');


-- 29 rows (PHYS is repeated in classIdentity since it consists of 2 sections)
INSERT INTO classType (name, department)
VALUES ('HIST1010', 'HIST'),
('CHEM1020', 'CHEM'),
('PHIL2010', 'PHIL'),
('BIOL1110', 'BIOL'),
('ENGL2010', 'ENGL'),
('ECON1010', 'ECON'),
('MATH2010', 'MATH'),
('PSYC1010', 'PSYC'),
('COMM2010', 'COMM'),
('ARTH1010', 'ARTH'),
('STAT2010', 'STAT'),
('PHYS1010', 'PHYS'),
('SOC1010', 'SOC'),
('ANTH2010', 'ANTH'),
('ENGL1010', 'ENGL'),
('MUSC1010', 'MUSC'),
('BIOM2010', 'BIOM'),
('HIST2010', 'HIST'),
('CHEM2010', 'CHEM'),
('PHIL1010', 'PHIL'),
('BIOL2010', 'BIOL'),
('ECON2010', 'ECON'),
('MATH1010', 'MATH'),
('PSYC2010', 'PSYC'),
('COMM1010', 'COMM'),
('ARTH2010', 'ARTH'),
('STAT1010', 'STAT'),
('PHYS2010', 'PHYS'),
('SOC2010', 'SOC');


-- 30 rows
INSERT INTO classIdentity (classID, section, name)
VALUES 
  (65001, 1, 'HIST1010'),
  (13406, 1, 'CHEM1020'),
  (14703, 1, 'PHIL2010'),
  (54053, 1, 'BIOL1110'),
  (70035, 1, 'ENGL2010'),
  (40087, 1, 'ECON1010'),
  (12404, 1, 'MATH2010'),
  (10430, 1, 'PSYC1010'),
  (10009, 1, 'COMM2010'),
  (19265, 1, 'ARTH1010'),
  (10011, 1, 'STAT2010'),
  (10012, 1, 'PHYS1010'),
  (17013, 1, 'SOC1010'),
  (12017, 1, 'ANTH2010'),
  (32015, 1, 'ENGL1010'),
  (10016, 1, 'MUSC1010'),
  (74317, 1, 'BIOM2010'),
  (50018, 1, 'HIST2010'),
  (10019, 1, 'CHEM2010'),
  (29120, 1, 'PHIL1010'),
  (10029, 1, 'BIOL2010'),
  (60322, 1, 'ECON2010'),
  (10423, 1, 'MATH1010'),
  (19225, 1, 'PSYC2010'),
  (10022, 1, 'COMM1010'),
  (13620, 1, 'ARTH2010'),
  (15722, 1, 'STAT1010'),
  (13027, 1, 'PHYS2010'),
  (13028, 2, 'PHYS2010'),
  (11223, 1, 'SOC2010');


-- 30 rows
INSERT INTO classDescription (name, section, subtitle, description, credits)
VALUES ('HIST1010', 1, 'World History', 'A survey of the political, social, and cultural developments of Western civilization from the Reformation to the present.', 3),
('PHIL2010', 1, 'Fundementals of Philosophy','Introduces a broad spectrum of philosophical problems and approaches. Topics include basic questions concerning morality, skepticism and the foundations of knowledge, the mind and its relation to the body, and the existence of God.', 3),
('BIOL1110', 1, 'Introductory Biology', ' This course covers the fundamentals of biology, including the structure and function of cells, genetics, ecology, and evolution.', 3 ),
('ENGL2010', 1, 'Intermediate Writing', ' This course builds on basic writing skills and emphasizes argumentative and analytical writing across a variety of disciplines.', 3),
('ECON1010', 1, 'Principles of Microeconomics', ' This course covers the basic principles of microeconomics, including supply and demand, consumer behavior, and market structure.', 3),
('MATH2010', 1, 'Multivariable Calculus', ' This course covers calculus in multiple dimensions, including vectors, partial derivatives, and multiple integrals.', 3 ),
('PSYC1010', 1, 'Introduction to Psychology', ' This course provides an overview of the major areas of psychology, including cognitive, developmental, social, and abnormal psychology.', 3),
('COMM2010', 1, 'Public Speaking', ' This course covers the principles and practice of effective public speaking, including speech organization, delivery, and audience analysis.', 3),
('ARTH1010', 1,  'Introduction to Art', ' This course introduces students to art history and the principles of visual analysis through the study of major art movements and works of art.', 3),
('STAT2010', 1, 'Statistics for Engineers and Scientists', ' This course covers the principles of statistical inference, including hypothesis testing, regression, and analysis of variance.', 3),
('PHYS1010', 1, 'General Physics I', ' This course covers the fundamental principles of physics, including mechanics, thermodynamics, and waves.', 3),
('SOC1010', 1, 'Introduction to Sociology', ' This course provides an overview of the major concepts and methods in sociology, including social structure, inequality, and social change.', 3),
('ANTH2010', 1, ' Introduction to Anthropology', ' This course introduces students to the four subfields of anthropology - cultural, biological, linguistic, and archaeological - and examines how they interact to provide a holistic understanding of human societies and cultures.', 3),
('ENGL1010', 1, 'Introduction to Literature', ' This course introduces students to the critical analysis of literature, including poetry, drama, and fiction.', 3),
('MUSC1010', 1, 'Introduction to Music', ' This course provides an overview of music history, theory, and analysis, with an emphasis on developing critical listening skills.', 3),
('BIOM2010', 1,  'Cell and Molecular Biology', ' This course covers the structure and function of cells and biomolecules, including DNA, RNA, and proteins.', 3),
('HIST2010', 1, 'Introduction to United States History', ' This course covers major themes and events in US history from colonial times to the present.', 3),
('CHEM2010', 1 , 'General Chemistry II', ' This course covers chemical equilibrium, acid-base chemistry, thermodynamics, and electrochemistry.', 3),
('PHIL1010', 1, 'Ethics', ' This course explores ethical theories and principles, including consequentialism, deontology, and virtue ethics.', 3),
('BIOL2010', 1, 'Genetics', ' This course covers the principles of genetics, including gene expression, genetic variation, and the genetic basis of inheritance.', 3),
('ECON2010', 1, 'Principles of Macroeconomics', ' This course covers the basic principles of macroeconomics, including economic growth, inflation, and monetary policy.', 3),
('MATH1010', 1,  'Single Variable Calculus', ' This course covers the fundamental principles of calculus, including limits, derivatives, and integrals.', 3),
('PSYC2010', 1, 'Developmental Psychology', ' This course covers the major theories and concepts of human development across the lifespan, including physical, cognitive, and social-emotional development.', 3),
('COMM1010', 1, 'Introduction to Mass Communication', ' This course examines the history, theory, and practice of mass communication', 3),
('ARTH2010', 1,  'Introduction to Art History', ' Overview of artistic movements and works from prehistoric to modern times, with emphasis on analysis and interpretation of art in its historical and cultural contexts.', 3),
('STAT1010', 1,  'Introductory Statistics', ' Introduction to statistical methods for data analysis, including collecting, summarizing, and interpreting data, and using statistical software for basic analyses.', 3),
('PHYS2010', 1, 'General Physics I', ' Principles of classical mechanics and thermodynamics, with application of mathematical tools and physical laws to solve problems related to motion, forces, energy, and heat.', 3),
('PHYS2010', 2, 'General Physics I','Principles of classical mechanics and thermodynamics, with application of mathematical tools and physical laws to solve problems related to motion, forces, energy, and heat.', 3),
('SOC2010', 1, 'Introduction to Sociology', 'Overview of sociological perspective and major theoretical approaches used to study society, including analysis of social structures, institutions, and processes, and critical evaluation of social issues and inequalities.', 3);


-- -- Insert dummy data into classReview table
-- INSERT INTO classReview (reviewID, difficulty, hoursOutside, classID)
-- VALUES 
--        (4, 3.5, 3.5, 54053),
--        (5, 2.0, 4.5, 10029),
--        (6, 1.0, 7.0, 70035);
-- Insert dummy data into Professor table
INSERT INTO Professor (profID, email, prof_name)
VALUES ('ys3kz', 'ys3kz@virginia.edu', 'Yixie Sun'),
('sa9w', 'sa9w@virginia.edu.com', 'Simon Anderson'),
('mh6g', 'mh6g@virginia.edu', 'Michael Henderson'),
('jf5d', 'jf5d@virginia.edu', 'Jennifer Ford'),
('bw2t', 'bw2t@virginia.edu', 'Benjamin Wong'),
('kl9m', 'kl9m@virginia.edu', 'Karen Lee'),
('hd4s', 'hd4s@virginia.edu', 'Henry Davies'),
('rc7p', 'rc7p@virginia.edu', 'Rachel Chang'),
('aj8b', 'aj8b@virginia.edu', 'Andrew Jones'),
('cn2v', 'cn2v@virginia.edu', 'Caroline Nguyen'),
('lt6h', 'lt6h@virginia.edu', 'Laura Thompson'),
('bm3k', 'bm3k@virginia.edu', 'Brendan Murphy'),
('fm7t', 'fm7t@virginia.edu', 'Frank Miller'),
('tn8s', 'tn8s@virginia.edu', 'Tina Nguyen'),
('jm2r', 'jm2r@virginia.edu', 'Julie Martin'),
('sw9k', 'sw9k@virginia.edu', 'Steven Wilson'),
('kc4b', 'kc4b@virginia.edu', 'Katie Carter'),
('sl8m', 'sl8m@virginia.edu', 'Samantha Lee'),
('gm6h', 'gm6h@virginia.edu', 'George Mitchell'),
('cp5d', 'cp5d@virginia.edu', 'Carolyn Powell'),
('eh9s', 'eh9s@virginia.edu', 'Elizabeth Hill'),
('jb2t', 'jb2t@virginia.edu', 'James Brown');


-- Insert dummy data into professorReview table
-- INSERT INTO professorReview (reviewID, leniency, profID)
-- VALUES (1, 4.0, 'jb2t'),
--        (2, 2.5, 'eh9s'),
--        (3, 1.0, 'kc4b');


-- Insert dummy data into Class_Requirement table
INSERT INTO ClassRequirement (classID, requirement)
VALUES (11223, 'SOC1600'),
(32015, 'ENGL1000'),
(10019, 'CHEM1600'),
(10430, 'PSYCH1000'),
(10016, 'MUSC1000'),
(19265, 'ARTH1000');


-- Insert dummy data into taughtBy table (30 rows)
INSERT INTO taughtBy (classID, profID)
VALUES  (65001,'ys3kz'),
  (13406, 'mh6g'),
  (14703, 'fm7t'),
  (54053, 'cp5d'),
  (70035, 'rc7p'),
  (40087,'gm6h'),
  (12404, 'rc7p'),
  (10430, 'bm3k'),
  (10009, 'fm7t'),
  (19265,  'sw9k'),
  (10011,  'eh9s'),
  (10012,  'gm6h'),
  (17013, 'kl9m'),
  (12017, 'cp5d'),
  (32015, 'sa9w'),
  (10016, 'cp5d'),
  (74317, 'cn2v'),
  (50018, 'gm6h'),
  (10019, 'tn8s'),
  (29120, 'fm7t'),
  (10029,'jb2t'),
  (60322, 'sl8m'),
  (10423, 'jb2t'),
  (19225, 'hd4s'),
  (10022, 'eh9s'),
  (13620,  'gm6h'),
  (15722,  'bw2t'),
  (13027, 'sa9w'),
  (13028, 'kl9m'),
  (11223, 'cn2v');

