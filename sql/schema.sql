DROP DATABASE IF EXISTS student_course_hub;
CREATE DATABASE student_course_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_course_hub;

DROP TABLE IF EXISTS InterestedStudents;
DROP TABLE IF EXISTS ProgrammeModules;
DROP TABLE IF EXISTS Programmes;
DROP TABLE IF EXISTS Modules;
DROP TABLE IF EXISTS AdminUsers;
DROP TABLE IF EXISTS Staff;
DROP TABLE IF EXISTS Levels;

CREATE TABLE Levels (
    LevelID INT PRIMARY KEY,
    LevelName VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Staff (
    StaffID INT PRIMARY KEY,
    Name VARCHAR(120) NOT NULL
);

CREATE TABLE Modules (
    ModuleID INT PRIMARY KEY AUTO_INCREMENT,
    ModuleName VARCHAR(150) NOT NULL,
    ModuleLeaderID INT NULL,
    Description TEXT NULL,
    Image VARCHAR(255) NULL,
    FOREIGN KEY (ModuleLeaderID) REFERENCES Staff(StaffID) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_modules_leader (ModuleLeaderID)
);

CREATE TABLE Programmes (
    ProgrammeID INT PRIMARY KEY AUTO_INCREMENT,
    ProgrammeName VARCHAR(150) NOT NULL,
    LevelID INT NOT NULL,
    ProgrammeLeaderID INT NULL,
    Description TEXT NULL,
    Image VARCHAR(255) NULL,
    IsPublished TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (LevelID) REFERENCES Levels(LevelID) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (ProgrammeLeaderID) REFERENCES Staff(StaffID) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_programmes_level (LevelID),
    INDEX idx_programmes_published (IsPublished)
);

CREATE TABLE ProgrammeModules (
    ProgrammeModuleID INT PRIMARY KEY AUTO_INCREMENT,
    ProgrammeID INT NOT NULL,
    ModuleID INT NOT NULL,
    Year TINYINT NOT NULL,
    FOREIGN KEY (ProgrammeID) REFERENCES Programmes(ProgrammeID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ModuleID) REFERENCES Modules(ModuleID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT chk_programmemodules_year CHECK (Year BETWEEN 1 AND 4),
    UNIQUE KEY uq_programme_module_year (ProgrammeID, ModuleID, Year),
    INDEX idx_programmemodules_programme_year (ProgrammeID, Year),
    INDEX idx_programmemodules_module (ModuleID)
);

CREATE TABLE InterestedStudents (
    InterestID INT AUTO_INCREMENT PRIMARY KEY,
    ProgrammeID INT NOT NULL,
    StudentName VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    RegisteredAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProgrammeID) REFERENCES Programmes(ProgrammeID) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY uq_interest_programme_email (ProgrammeID, Email),
    INDEX idx_interest_programme_registered (ProgrammeID, RegisteredAt)
);

CREATE TABLE AdminUsers (
    AdminUserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(80) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    Role ENUM('admin', 'editor') NOT NULL DEFAULT 'editor',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
