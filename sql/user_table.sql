CREATE TABLE users(
    usersId int AUTO_INCREMENT primary KEY,
    usersName varchar (250),
    usersEmail varchar (250),
    usersPwd varchar (250),
    role int DEFAULT 0,
    active int DEFAULT 0,
    verifaction int DEFAULT 0,
    adress varchar (250),
    about varchar (250),
    mobile varchar (250),
    image varchar (250),
    2step int DEFAULT 1,
    position varchar (250),
    person varchar (250),
    otp int,
    otp_expiry datetime

);