CREATE DATABASE IF NOT EXISTS BookWise;
USE BookWise;

CREATE TABLE IF NOT EXISTS Textbooks
(
    book_ISBN           VARCHAR(14)         PRIMARY KEY,
    book_Title          VARCHAR(255)        NOT NULL,
    book_Authors        VARCHAR(255)        NOT NULL,
    book_Edition        INT                 NOT NULL,
    book_Subject        VARCHAR(50)         NOT NULL,
    book_Major          VARCHAR(50)         NOT NULL,
    book_Desc           VARCHAR(255)        NOT NULL,
    book_Publisher      VARCHAR(50)         NOT NULL,
    book_Year           INT                 NOT NULL,
    book_Rating         NUMERIC(2, 1)       NOT NULL,
    book_Price          NUMERIC(5, 2)       NOT NULL,
    book_level          INT                 NOT NULL
);

CREATE TABLE IF NOT EXISTS Admins
(
    admin_id            INT                 PRIMARY KEY             AUTO_INCREMENT,
    admin_username      VARCHAR(20)         NOT NULL,
    admin_password      VARCHAR(50)         NOT NULL
);

CREATE TABLE IF NOT EXISTS Users
(
    users_id            INT                 PRIMARY KEY             AUTO_INCREMENT,
    username            VARCHAR(20)         NOT NULL,
    user_password       VARCHAR(50)         NOT NULL,
    user_history        VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Admin_logs
(
    admin_log_id        INT                 PRIMARY KEY             AUTO_INCREMENT,
    admin_id            INT                 NOT NULL,
    log_date            DATE                NOT NULL,
    log_time            TIME                NOT NULL,
    admin_record        VARCHAR(255)        NOT NULL,

    CONSTRAINT admin_fk FOREIGN KEY (admin_id)
        REFERENCES Admins (admin_id)
);

CREATE TABLE IF NOT EXISTS Shop_logs
(
    shop_log_id         INT                 PRIMARY KEY             AUTO_INCREMENT,
    users_id            INT                 NOT NULL,
    shop_date           DATE                NOT NULL,
    shop_time           TIME                NOT NULL,
    shop_record         VARCHAR(255)        NOT NULL,

    CONSTRAINT user_fk FOREIGN KEY (users_id)
        REFERENCES Users (users_id)
);

INSERT INTO Textbooks VALUES
('978-0134686974', 'Precalculus: Concepts Through Functions', 'Michael Sullivan', 4, 'Precalculus', 'Math', 
    'A comprehensive precalculus textbook.', 'Pearson', 2018, 4.4, 57.00, 100),
('978-0321982384', 'Linear Algebra and Its Applications', 'David Lay, Steven Lay, Judi McDonald', 5, 'Linear Algebra', 'Math',
    'An introductory textbook on linear algebra.', 'Pearson', 2014, 4.5, 59.64, 300),
('978-1285741550', 'Calculus: Early Transcendentals', 'James Stewart', 8, 'Calculus', 'Math', 
    'A widely used calculus textbook.', 'Cengage Learning', 2015, 4.4, 36.98, 100),
('978-1466575578', 'Introduction to Probability', 'Joseph K. Blitzstein, Jessica Hwang', 1, 'Probability Theory', 'Math',
    'A foundational textbook on probability theory.', 'Chapman and Hall/CRC', 2014, 4.4, 57.90, 200),
('978-1119254515', 'Statistics', 'Robert S. Witte, John S. Witte', 11, 'Statistics', 'Math',
    'A comprehensive statistics textbook.', 'Wiley', 2016, 4.5, 64.20, 200),
('978-0321977069', 'Fundamentals of Differential Equations', 'R. Nagle, Edward Saff, Arthur Snider', 9, 'Differential Equations',
    'Math', 'A textbook on the basic theories of differential equations and their applications.', 'Pearson', 2017, 4.4, 87.46, 300),
('978-0470054567', 'Partial Differential Equations: An Introduction', 'Walter A. Strauss', 2, 'Partial Differential Equations',
    'Math', 'An introductory textbook on the basic properties of PDEs.', 'Wiley', 2007, 4.2, 79.95, 400),
('978-0357042922', 'Multivariable Calculus', 'James Stewart, Daniel K. Clegg, Saleem Watson', 9, 'Multivariable Calculus', 'Math',
    'A widely used textbook with a focus on problem solving.', 'Cengage Learning', 2020, 4.4, 114.69, 200),
('978-0486661032', 'Advanced Calculus', 'David V. Widder', 2, 'Advanced Calculus', 'Math', 
    'A textbook that explores theories beyond elementary calculus.', 'Dover Publications', 1989, 4.6, 65.52, 300),
('978-0898713619', 'Numerical Linear Algebra', 'Lloyd N. Trefethen, David Bau', 1, 'Numerical Linear Algebra', 'Math',
    'An introductory textbook on the field of numerical linear algebra.', 'SIAM', 1997, 4.6, 41.38, 400),
('978-1118290279', 'Data Structures and Algorithms in Python', 'Michael T. Goodrich, Roberto Tamassia, Michael H. Goldwasser',
    1, 'Data Structures', 'Computer Science', 'A textbook on data structures and algorithms using Python.', 'Wiley', 2013, 4.3, 
    87.35, 200),
('978-1118063330', 'Operating System Concepts', 'Abraham Silberschatz, Peter B. Galvin, Greg Gagne', 9, 'Operating Systems', 
    'Computer Science', 'A comprehensive textbook on operating systems.', 'Wiley', 2012, 4.5, 21.00, 300),
('978-0132943260', 'Database Systems: A Practical Approach to Design, Implementation, and Management', 
    'Thomas Connolly, Carolyn Begg', 6, 'Database Management', 'Computer Science', 
    'A comprehensive guide to database systems and database management.', 'Pearson', 2014, 4.3, 69.57, 300),
('978-0132316811', 'Introduction to the Design and Analysis of Algorithms', 'Anany Levitin', 3, 'Design and Analysis of Algorithms',
    'Computer Science', 'An introductory textbook on algorithm design and analysis.', 'Pearson', 2011, 4.5, 67.38, 300),
('978-0134610993', 'Artificial Intelligence: A Modern Approach', 'Stuart Russell, Peter Norvig', 4, 'Artificial Intelligence',
    'Computer Science', 'An introductory textbook on the theory and practice of AI.', 'Pearson', 2020, 4.6, 149.99, 300),
('978-0133594140', 'Computer Networking: A Top-Down Approach', 'James Kurose, Keith Ross', 7, 'Computer Networks', 
    'Computer Science', 'A foundational textbook on the concepts of networking.', 'Pearson', 2016, 4.2, 109.87, 300),
('978-8178672663', 'Computer Architecture: A Quantitative Approach', 'John L. Hennessy, David A. Patterson', 5, 
    'Computer Organization and Architecture', 'Computer Science', 'A foundational textbook on computer architecture.', 
    'Morgan Kaufmann', 2011, 4.3, 139.54, 100),
('978-0201558029', 'Concrete Mathematics: A Foundation for Computer Science', 'Ronald Graham, Donald Knuth, Oren Patashnik', 2,
    'Elements of Discrete Structures', 'Computer Science', 'An introductory textbook on the mathematics behind computer science.',
    'Addison-Wesley Professional', 1994, 4.6, 73.07, 200),
('978-0073380544', 'Fundamentals of Digital Logic with Verilog Design', 'Stephen Brown, Zvonko Vranesic', 3, 
    'Digital Logic Design Fundamentals', 'Computer Science', 'An introductory textbook on logic circuit design.', 
    'McGraw Hill', 2013, 4.3, 66.40, 100),
('978-1133187790', 'Introduction to the Theory of Computation', 'Michael Sipser', 3, 'Theory of Computation', 'Computer Science',
    'An introductory textbook on theoretical computational theory topics.', 'Cengage Learning', 2012, 4.3, 49.60, 300);

INSERT INTO Admins (admin_username, admin_password) VALUES
('first_admin', '123abc45'),
('second_admin', '34566k4wgf'),
('third_admin', 'kjldlnzsf'),
('fourth_admin', '123908onb'),
('fifth_admin', 'kgngufhsa'),
('sixth_admin', 'vbfyeuifh'),
('seventh_admin', 'puf8bjhsn'),
('eighth_admin', 'fdfytugaa'),
('ninth_admin', 'abc123456'),
('tenth_admin', '9876554yjj');

INSERT INTO Users (username, user_password) VALUES
('first_user', 'password_1'),
('second_user', 'password_2'),
('third_user', 'password_3'),
('fourth_user', 'password_4'),
('fifth_user', 'password_5'),
('sixth_user', 'password_6'),
('seventh_user', 'password_7'),
('eighth_user', 'password_8'),
('ninth_user', 'password_9'),
('tenth_user', 'password_10');

INSERT INTO Admin_logs (admin_id, log_date, log_time, admin_record) VALUES
(1, '2023-11-30', '12:43:00', 'Added new Calculus textbook'),
(1, '2023-11-30', '18:59:00', 'Deleted a Calculus textbook'),
(2, '2023-12-01', '09:36:54', 'Added new Computer Architecture textbook'),
(5, '2023-11-30', '12:43:00', 'Added new textbook info'),
(10, '2023-12-03', '15:23:10', 'Added Data Structure textbook'),
(7, '2023-11-30', '12:43:00', 'Removed a Database textbook'),
(8, '2023-11-29', '16:40:24', 'Added new subject Algebra'),
(6, '2023-12-02', '11:23:40', 'Added new Algebra textbook'),
(1, '2023-12-03', '08:33:20', 'Added new info for Algebra textbook'),
(1, '2023-12-04', '13:02:05', 'Edited info for Algebra textbook');

INSERT INTO Shop_logs (users_id, shop_date, shop_time, shop_record) VALUES
(1, '2023-11-30', '18:23:00', 'Purchased 1 textbook'),
(3, '2023-11-29', '20:13:30', 'Refunded 1 textbook'),
(1, '2023-11-30', '17:26:42', 'Purchased 5 textbooks'),
(9, '2023-12-01', '12:13:46', 'Ordered an Algorithms textbook'),
(8, '2023-12-02', '14:03:32', 'Contacted customor support'),
(1, '2023-11-30', '18:23:00', 'Purchased 3 textbooks'),
(2, '2023-12-03', '15:45:03', 'Refunded 2 textbooks'),
(3, '2023-12-04', '08:13:09', 'Purchased 3 textbooks'),
(4, '2023-12-02', '10:25:30', 'Ordered 4 textbooks'),
(5, '2023-12-01', '14:43:10', 'Purchased 1 textbook');

CREATE VIEW userView AS
    SELECT * FROM Textbooks WHERE book_Major = 'MATH' AND book_level = 100;

CREATE VIEW adminView AS
    SELECT * FROM Admin_logs WHERE log_date = '2023-11-30';