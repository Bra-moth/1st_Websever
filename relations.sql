CREATE TABLE Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    DateOfBirth DATE NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(255),
    NationalID VARCHAR(255),
    EmergencyContact VARCHAR(255),
    CurrentAddress TEXT,
    AcademicProgram VARCHAR(255)
);

CREATE TABLE Residences (
    ResidenceID INT AUTO_INCREMENT PRIMARY KEY,
    ResidenceName VARCHAR(255) NOT NULL,
    Capacity INT,
    Description TEXT
);

CREATE TABLE RoomTypes (
    RoomTypeID INT AUTO_INCREMENT PRIMARY KEY,
    TypeName VARCHAR(255),
    Description TEXT
);

CREATE TABLE Rooms (
    RoomID INT AUTO_INCREMENT PRIMARY KEY,
    RoomNumber VARCHAR(255),
	ResidenceID VARCHAR(255),
    Occupied ENUM('Yes', 'No')
	FOREIGN KEY ResidenceID REFERENCES Residences(ResidenceID)
);

CREATE TABLE ResidenceDetails (
    ResidenceDetailID INT AUTO_INCREMENT PRIMARY KEY,
    ResidenceID INT,
    RoomTypeID INT,
    AccommodationID INT
);

CREATE TABLE Applications (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    StudentID INT(11),
	RoomTypeID INT(11),
	ResidenceName enum('Moroka', 'Hannentjie', 'Rathaga'),
    Status ENUM('Pending', 'Approved', 'Rejected'),
    DisabilityCriteria ENUM('Yes', 'No'),
    YearOfStudy INT(11),
    ApplicationDate DATETIME,
    ResidenceID INT(11),
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (ResidenceID) REFERENCES Residences(ResidenceID)
	FOREIGN KEY (RoomTypeID) REFERENCES RoomTypes(RoomTypeID)

);


CREATE TABLE Allocations (
    AllocationID INT AUTO_INCREMENT PRIMARY KEY,
    ApplicationID INT,
    RoomID INT,
    AllocationDate DATE,
    FOREIGN KEY (ApplicationID) REFERENCES Applications(ApplicationID),
    FOREIGN KEY (RoomID) REFERENCES Rooms(RoomID)
);
