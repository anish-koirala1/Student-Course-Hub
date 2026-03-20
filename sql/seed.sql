USE student_course_hub;

INSERT INTO Levels (LevelID, LevelName) VALUES
(1, 'Undergraduate'),
(2, 'Postgraduate');

INSERT INTO Staff (StaffID, Name) VALUES
(1, 'Dr. Alice Johnson'), (2, 'Dr. Brian Lee'), (3, 'Dr. Carol White'), (4, 'Dr. David Green'),
(5, 'Dr. Emma Scott'), (6, 'Dr. Frank Moore'), (7, 'Dr. Grace Adams'), (8, 'Dr. Henry Clark'),
(9, 'Dr. Irene Hall'), (10, 'Dr. James Wright'),
(11, 'Dr. Sophia Miller'), (12, 'Dr. Benjamin Carter'), (13, 'Dr. Chloe Thompson'), (14, 'Dr. Daniel Robinson'),
(15, 'Dr. Emily Davis'), (16, 'Dr. Nathan Hughes'), (17, 'Dr. Olivia Martin'), (18, 'Dr. Samuel Anderson'),
(19, 'Dr. Victoria Hall'), (20, 'Dr. William Scott');

INSERT INTO Modules (ModuleID, ModuleName, ModuleLeaderID, Description, Image) VALUES
(1, 'Introduction to Programming', 1, 'Covers the fundamentals of programming using Python and Java.', NULL),
(2, 'Mathematics for Computer Science', 2, 'Teaches discrete mathematics, linear algebra, and probability theory.', NULL),
(3, 'Computer Systems & Architecture', 3, 'Explores CPU design, memory management, and assembly language.', NULL),
(4, 'Databases', 4, 'Covers SQL, relational database design, and NoSQL systems.', NULL),
(5, 'Software Engineering', 5, 'Focuses on agile development, design patterns, and project management.', NULL),
(6, 'Algorithms & Data Structures', 6, 'Examines sorting, searching, graphs, and complexity analysis.', NULL),
(7, 'Cyber Security Fundamentals', 7, 'Provides an introduction to network security, cryptography, and vulnerabilities.', NULL),
(8, 'Artificial Intelligence', 8, 'Introduces AI concepts such as neural networks, expert systems, and robotics.', NULL),
(9, 'Machine Learning', 9, 'Explores supervised and unsupervised learning, including decision trees and clustering.', NULL),
(10, 'Ethical Hacking', 10, 'Covers penetration testing, security assessments, and cybersecurity laws.', NULL),
(11, 'Computer Networks', 1, 'Teaches TCP/IP, network layers, and wireless communication.', NULL),
(12, 'Software Testing & Quality Assurance', 2, 'Focuses on automated testing, debugging, and code reliability.', NULL),
(13, 'Embedded Systems', 3, 'Examines microcontrollers, real-time OS, and IoT applications.', NULL),
(14, 'Human-Computer Interaction', 4, 'Studies UI/UX design, usability testing, and accessibility.', NULL),
(15, 'Blockchain Technologies', 5, 'Covers distributed ledgers, consensus mechanisms, and smart contracts.', NULL),
(16, 'Cloud Computing', 6, 'Introduces cloud services, virtualization, and distributed systems.', NULL),
(17, 'Digital Forensics', 7, 'Teaches forensic investigation techniques for cybercrime.', NULL),
(18, 'Final Year Project', 8, 'A major independent project where students develop a software solution.', NULL),
(19, 'Advanced Machine Learning', 11, 'Covers deep learning, reinforcement learning, and cutting-edge AI techniques.', NULL),
(20, 'Cyber Threat Intelligence', 12, 'Focuses on cybersecurity risk analysis, malware detection, and threat mitigation.', NULL),
(21, 'Big Data Analytics', 13, 'Explores data mining, distributed computing, and AI-driven insights.', NULL),
(22, 'Cloud & Edge Computing', 14, 'Examines scalable cloud platforms, serverless computing, and edge networks.', NULL),
(23, 'Blockchain & Cryptography', 15, 'Covers decentralized applications, consensus algorithms, and security measures.', NULL),
(24, 'AI Ethics & Society', 16, 'Analyzes ethical dilemmas in AI, fairness, bias, and regulatory considerations.', NULL),
(25, 'Quantum Computing', 17, 'Introduces quantum algorithms, qubits, and cryptographic applications.', NULL),
(26, 'Cybersecurity Law & Policy', 18, 'Explores digital privacy, GDPR, and international cyber law.', NULL),
(27, 'Neural Networks & Deep Learning', 19, 'Delves into convolutional networks, GANs, and AI advancements.', NULL),
(28, 'Human-AI Interaction', 20, 'Studies AI usability, NLP systems, and social robotics.', NULL),
(29, 'Autonomous Systems', 11, 'Focuses on self-driving technology, robotics, and intelligent agents.', NULL),
(30, 'Digital Forensics & Incident Response', 12, 'Teaches forensic analysis, evidence gathering, and threat mitigation.', NULL),
(31, 'Postgraduate Dissertation', 13, 'A major research project where students explore advanced topics in computing.', NULL);

INSERT INTO Programmes (ProgrammeID, ProgrammeName, LevelID, ProgrammeLeaderID, Description, Image, IsPublished) VALUES
(1, 'BSc Computer Science', 1, 1, 'A broad computer science degree covering programming, AI, cybersecurity, and software engineering.', NULL, 1),
(2, 'BSc Software Engineering', 1, 2, 'A specialized degree focusing on the development and lifecycle of software applications.', NULL, 1),
(3, 'BSc Artificial Intelligence', 1, 3, 'Focuses on machine learning, deep learning, and AI applications.', NULL, 1),
(4, 'BSc Cyber Security', 1, 4, 'Explores network security, ethical hacking, and digital forensics.', NULL, 1),
(5, 'BSc Data Science', 1, 5, 'Covers big data, machine learning, and statistical computing.', NULL, 1),
(6, 'MSc Machine Learning', 2, 11, 'A postgraduate degree focusing on deep learning, AI ethics, and neural networks.', NULL, 1),
(7, 'MSc Cyber Security', 2, 12, 'A specialized programme covering digital forensics, cyber threat intelligence, and security policy.', NULL, 1),
(8, 'MSc Data Science', 2, 13, 'Focuses on big data analytics, cloud computing, and AI-driven insights.', NULL, 1),
(9, 'MSc Artificial Intelligence', 2, 14, 'Explores autonomous systems, AI ethics, and deep learning technologies.', NULL, 1),
(10, 'MSc Software Engineering', 2, 15, 'Emphasizes software design, blockchain applications, and cutting-edge methodologies.', NULL, 1);

INSERT INTO ProgrammeModules (ProgrammeID, ModuleID, Year) VALUES
(1, 1, 1), (1, 2, 1), (1, 3, 1), (1, 4, 1),
(2, 1, 1), (2, 2, 1), (2, 3, 1), (2, 4, 1),
(3, 1, 1), (3, 2, 1), (3, 3, 1), (3, 4, 1),
(4, 1, 1), (4, 2, 1), (4, 3, 1), (4, 4, 1),
(5, 1, 1), (5, 2, 1), (5, 3, 1), (5, 4, 1),
(1, 5, 2), (1, 6, 2), (1, 7, 2), (1, 8, 2),
(2, 5, 2), (2, 6, 2), (2, 12, 2), (2, 14, 2),
(3, 5, 2), (3, 9, 2), (3, 8, 2), (3, 10, 2),
(4, 7, 2), (4, 10, 2), (4, 11, 2), (4, 17, 2),
(5, 5, 2), (5, 6, 2), (5, 9, 2), (5, 16, 2),
(1, 11, 3), (1, 13, 3), (1, 15, 3), (1, 18, 3),
(2, 13, 3), (2, 15, 3), (2, 16, 3), (2, 18, 3),
(3, 13, 3), (3, 15, 3), (3, 16, 3), (3, 18, 3),
(4, 15, 3), (4, 16, 3), (4, 17, 3), (4, 18, 3),
(5, 9, 3), (5, 14, 3), (5, 16, 3), (5, 18, 3),
(6, 19, 1), (6, 24, 1), (6, 27, 1), (6, 29, 1), (6, 31, 1),
(7, 20, 1), (7, 26, 1), (7, 30, 1), (7, 23, 1), (7, 31, 1),
(8, 21, 1), (8, 22, 1), (8, 27, 1), (8, 28, 1), (8, 31, 1),
(9, 19, 1), (9, 24, 1), (9, 28, 1), (9, 29, 1), (9, 31, 1),
(10, 23, 1), (10, 22, 1), (10, 25, 1), (10, 26, 1), (10, 31, 1);

INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email) VALUES
(1, 'John Doe', 'john.doe@example.com'),
(4, 'Jane Smith', 'jane.smith@example.com'),
(6, 'Alex Brown', 'alex.brown@example.com'),
(9, 'Priya Patel', 'priya.patel@example.com');

INSERT INTO AdminUsers (Username, PasswordHash, Role) VALUES
('admin', '$2y$12$ftacAi3DIW/7gB6303603.JyluRyNGULe5h5kj7IruYdl2oRDKH0W', 'admin'),
('editor', '$2y$12$ftacAi3DIW/7gB6303603.JyluRyNGULe5h5kj7IruYdl2oRDKH0W', 'editor');
