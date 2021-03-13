CREATE TABLE t_user(
id NUMERIC IDENTITY(1, 1) NOT NULL
, userName VARCHAR(255)
, userPassword VARCHAR(255)
, userStatus INT DEFAULT 1
, userDateCreated DATETIME DEFAULT(GETDATE())
CONSTRAINT PK_user PRIMARY KEY(id)
);

CREATE TABLE t_request(
id NUMERIC IDENTITY(1, 1) NOT NULL
, requestApplicantName VARCHAR(255)
, requestTeamName VARCHAR(255)
, requestBarangay VARCHAR(255)
, requestCity VARCHAR(255)
, requestEmail VARCHAR(255)
, requestDate DATETIME
, requestStatus INT DEFAULT 1
, requestDateCreated DATETIME DEFAULT(GETDATE())
CONSTRAINT PK_request PRIMARY KEY(id)
)

CREATE TABLE t_approved(
id NUMERIC IDENTITY(1, 1) NOT NULL
, approvedRequestID NUMERIC
, approvedUserID NUMERIC
, approvedStatus INT DEFAULT 1
, approvedDateTime DATETIME DEFAULT(GETDATE())
CONSTRAINT PK_approved PRIMARY KEY(id)
CONSTRAINT FK_approved_request FOREIGN KEY (approvedRequestID)
REFERENCES t_request(id)
, CONSTRAINT FK_approved_user FOREIGN KEY (approvedUserID)
REFERENCES t_user(id)
)
