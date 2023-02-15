CREATE TABLE Owner(
    PhoneNumber     CHAR(12) PRIMARY KEY,
    Address VARCHAR(40) NOT NULL,
    Name    VARCHAR(20) NOT NULL,
    Email   VARCHAR(25) NOT NULL,
    Password    VARCHAR(20) NOT NULL);
 
CREATE TABLE HasPet(
    Color   VARCHAR(20) NOT NULL,
    Name    VARCHAR(15) NOT NULL,
    Birth   VARCHAR(10) NOT NULL,
    Type    VARCHAR(30) NOT NULL,
    Weight  VARCHAR(11) NOT NULL,
    Sex     VARCHAR(6)  NOT NULL,
    PID     CHAR(16)    PRIMARY KEY,
    PhoneNumber CHAR(12)    NOT NULL,
    FOREIGN KEY(PhoneNumber) REFERENCES Owner (PhoneNumber)  ON UPDATE CASCADE ON DELETE CASCADE);
 
 
CREATE TABLE PetBirth(
    Birth VARCHAR(10)   PRIMARY KEY,
    Age VARCHAR(8)  NOT NULL);
 
CREATE TABLE Mammalia(          
    PID CHAR(16)    PRIMARY KEY,
    Sterilization   VARCHAR(3) NOT NULL,  
    FOREIGN KEY (PID) REFERENCES HasPet (PID)  ON UPDATE CASCADE ON DELETE CASCADE);
 
CREATE TABLE Birds(        
    PID CHAR(16)    PRIMARY KEY,
    NumberOfReplaceFeathers INTEGER NOT NULL,  
    FOREIGN KEY (PID) REFERENCES HasPet (PID)  ON UPDATE CASCADE ON DELETE CASCADE);
 
CREATE TABLE Reptiles(
    PID CHAR(16)    PRIMARY KEY,
    NumberOfMolts   INTEGER NOT NULL,
    FOREIGN KEY (PID) REFERENCES HasPet (PID)  ON UPDATE CASCADE ON DELETE CASCADE);
 
CREATE TABLE Vaccine(
    VacID   VARCHAR(17) PRIMARY KEY,
    Name    VARCHAR(40) NOT NULL);
 
CREATE TABLE Ussage(
    Name    VARCHAR(40) NOT NULL,
    Dosage  VARCHAR(50) NOT NULL);
 
CREATE TABLE BGets(
    VacID   VARCHAR(17),
    PID   CHAR(16),
    NumberOfTimes INTEGER NOT NULL,
    PRIMARY KEY(PID, VacID),
    FOREIGN KEY(PID) REFERENCES Birds(PID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(VacID) REFERENCES Vaccine(VacID));
 
CREATE TABLE MGets(
    VacID   VARCHAR(17),
    PID CHAR(16),
    NumberOfTimes INTEGER NOT NULL,
    PRIMARY KEY(PID, VacID),
    FOREIGN KEY(PID) REFERENCES Mammalia(PID)ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(VacID) REFERENCES Vaccine(VacID));
 
 
CREATE TABLE BookedAppointment(
    TimeDate CHAR(16),
    PhoneNumber CHAR(12),
    AppmType VARCHAR(30) NOT NULL,
    PRIMARY KEY(PhoneNumber,TimeDate),
    FOREIGN KEY(PhoneNumber) REFERENCES Owner(PhoneNumber) ON DELETE CASCADE ON UPDATE CASCADE);
 
 
 
CREATE TABLE Hospital(
    Name    VARCHAR(60) NOT NULL,
    Address    VARCHAR(30),
    Phone    VARCHAR(13) NOT NULL,
    Email    VARCHAR(23) NOT NULL,
    Fax    VARCHAR(14) NOT NULL,
    Password  VARCHAR(20) NOT NULL, 
    City  VARCHAR(15) NOT NULL,
    PRIMARY KEY (Address));
 
 
 
CREATE TABLE Arranges(
    TimeDate CHAR(16),
    PhoneNumber CHAR(12),
    Address    VARCHAR(30),
    RoomNumber    VARCHAR(10) NOT NULL DEFAULT '000',
    PRIMARY KEY(PhoneNumber, TimeDate, Address),
    FOREIGN KEY (PhoneNumber, TimeDate) REFERENCES BookedAppointment(PhoneNumber,TimeDate) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (Address) REFERENCES Hospital (Address) ON UPDATE CASCADE ON DELETE CASCADE);
 
 
CREATE TABLE Veterinarian(
    VetID   CHAR(11)  PRIMARY KEY,
    Department   VARCHAR(10) NOT NULL,
    Name   VARCHAR(15) NOT NULL,
    Password  VARCHAR(20) NOT NULL);
 
 
 
CREATE TABLE WorksIn(
    Address    VARCHAR(30),
    VetID   CHAR(11),      
    Seniority   INTEGER NOT NULL,                                        
    PRIMARY KEY (Address, VetID),
    FOREIGN KEY(Address) REFERENCES Hospital(Address),
    FOREIGN KEY(VetID) REFERENCES Veterinarian(VetID));
   
 
CREATE TABLE ProvidedReport(
    RID    CHAR(10),
    VetID   CHAR(11),
    Time    CHAR(18)    NOT NULL,
    ContentOfTreatment    CHAR(60)   NOT NULL,
    ReasonForComing    CHAR(30)   NOT NULL,
    Comment    CHAR(100)   NOT NULL,
    PRIMARY KEY (RID, VetID),
    FOREIGN KEY(VetID) REFERENCES Veterinarian(VetID));
 
   
CREATE TABLE RIDPID(
    RID CHAR(10),
    PID CHAR(16),
    PRIMARY key (RID, PID),
    FOREIGN KEY(PID) REFERENCES HasPet(PID) ON UPDATE CASCADE ON DELETE CASCADE);
 
   
CREATE TABLE DoesExamination(
    TimeDate CHAR(16),
    VetID    CHAR(11),
    Type       CHAR(40),
    PRIMARY KEY (TimeDate, VetID),
    FOREIGN KEY(VetID) REFERENCES Veterinarian(VetID) ON DELETE CASCADE);
 
 
CREATE TABLE Makes(
    PID     CHAR(16),
    TimeDate CHAR(16),
    VetID   CHAR(11),
    AdverseReaction VARCHAR(30) NOT NULL,
    PRIMARY KEY (PID, TimeDate, VetID),
    FOREIGN KEY(PID) REFERENCES HasPet(PID) ON UPDATE CASCADE ON DELETE CASCADE ,
    FOREIGN KEY(TimeDate, VetID) REFERENCES DoesExamination(TimeDate, VetID));
   
   
CREATE TABLE NameEffect(
    Name    CHAR(20)   PRIMARY KEY,
    EffectDescription   CHAR(30)  NOT NULL);
   
 
CREATE TABLE DIDName(
    DID    CHAR(8)   PRIMARY KEY,
    Name    CHAR(20)   NOT NULL);
   
 
CREATE TABLE Prescribe(
    DID   CHAR(8),
    Frequency  VARCHAR(20),
    RID    CHAR(10),
    VetID   CHAR(11),
    PID CHAR(16),
    PRIMARY KEY(DID, RID, VetID,PID),
    FOREIGN KEY(RID, VetID) REFERENCES ProvidedReport(RID, VetID),
    FOREIGN KEY(PID) REFERENCES RIDPID(PID)ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(DID) REFERENCES DIDName(DID));






INSERT INTO owner VALUES ('778-123-4563','435 North Road', 'Anna','Anna3@mail.com','v151510vnb');
INSERT INTO owner VALUES ('232-156-7854','7890 Express St', 'Maria','Maria@mail.com','a45261752');
INSERT INTO owner VALUES ('604-123-4562','788 Hamilton St','Ewa','Ewwwa@mail.com','s465211892');
INSERT INTO owner VALUES ('232-456-1233','3677 Victoria Drive', 'Anna','Annaa@mail.com','a144624655');
INSERT INTO owner VALUES ('604-756-1234','435 North Road', 'John','Johhhh@mail.com','a11147849');
INSERT INTO owner VALUES ('604-332-3369','777 Richards Street', 'Jack','JJJJack@mail.com','0458a4662');
INSERT INTO owner VALUES ('778-223-2232','679 E Cordova St', 'Jack','Jack33@mail.com','4859a4532');
INSERT INTO owner VALUES ('232-157-1659','3456 Commercial St', 'Amy','Amyyy@mail.com','189a2484');
 
 
INSERT INTO haspet VALUES ('Silver Shaded','Honey','2019-03-15','British Shorthair Cat','8lb', 'Female','A123456781256001','778-123-4563');
INSERT INTO haspet VALUES ('Blue Merle','Buddy','2018-08-07','Border Collie Dog','18lb','Male','A100000001232560','232-156-7854');
INSERT INTO haspet VALUES ('Silver Shaded','Baby','2020-12-25','British Shorthair Cat','5lb','Female','A125624805456120','604-123-4562');
INSERT INTO haspet VALUES ('Chocolate','Bella','2021-11-01','Ragdoll Cat','2lb','She','B459683214596458','232-456-1233');
INSERT INTO haspet VALUES ('Blue','Lucky','2020-12-25','Chihuahua','800G','Male','B598846234561230','604-756-1234');
INSERT INTO haspet VALUES ('Glaucous','Buddy','2018-05-26','Macaw','110g', 'Male','A908723411546210','778-123-4563');
INSERT INTO haspet VALUES ('Green','Five','2021-12-25','Green Anole','3g','Female','A456811454521914','604-123-4562');
INSERT INTO haspet VALUES ('Glaucous','Buddy','2014-06-15','Macaw','125g', 'Male','A589742161248415','604-332-3369');
INSERT INTO haspet VALUES ('Bright Green','Luna','2011-12-03','Pacman Frog','0.8lb','Female','B487592164562130','778-223-2232');
INSERT INTO haspet VALUES ('Brown','Oliver','2020-03-15','Bahaman Anole','5g','Male','A445777124458950','232-157-1659');
INSERT INTO haspet VALUES ('Opaline','Light','2017-05-05','Budgerigar','48g', 'Male','A459871326512456','604-332-3369');
INSERT INTO haspet VALUES ('Grewing','Dark','2017-05-05','Budgerigar','42g', 'Female','A459871326512478','604-332-3369');
INSERT INTO haspet VALUES ('Canary Yellow','Judy','2011-12-03','Atlantic Canary','20g', 'Female','B459871352145987','232-156-7854');
INSERT INTO haspet VALUES ('Brown','Sunny','2020-03-15','Bahaman Anole','3.5g','Female','A445777124458970','232-157-1659');
INSERT INTO haspet VALUES ('Green','Six','2021-12-25','Green Anole','3.5g','Female','A456811454521915','604-123-4562');
 
INSERT INTO petbirth VALUES ('2019-03-15','3');
INSERT INTO petbirth VALUES ('2018-08-07','3.5');
INSERT INTO petbirth VALUES ('2020-12-25','1');
INSERT INTO petbirth VALUES ('2021-11-01','8month');
INSERT INTO petbirth VALUES ('2018-05-26','4');
INSERT INTO petbirth VALUES ('2021-12-25','6month');
INSERT INTO petbirth VALUES ('2014-06-15','8');
INSERT INTO petbirth VALUES ('2011-12-03','11');
INSERT INTO petbirth VALUES ('2020-03-15','2');
INSERT INTO petbirth VALUES ('2017-05-05','5');
 
INSERT INTO mammalia VALUES ('A123456781256001','Yes');
INSERT INTO mammalia VALUES ('A100000001232560','Yes');
INSERT INTO mammalia VALUES ('A125624805456120','No');
INSERT INTO mammalia VALUES ('B459683214596458','Yes');
INSERT INTO mammalia VALUES ('B598846234561230','Yes');
 
INSERT INTO birds VALUES ('A908723411546210',1);
INSERT INTO birds VALUES ('A589742161248415',1);
INSERT INTO birds VALUES ('A459871326512456',2);
INSERT INTO birds VALUES ('A459871326512478',1);
INSERT INTO birds VALUES ('B459871352145987',0);
 
INSERT INTO reptiles VALUES ('A456811454521914',3);
INSERT INTO reptiles VALUES ('B487592164562130',2);
INSERT INTO reptiles VALUES ('A445777124458950',5);
INSERT INTO reptiles VALUES ('A445777124458970',5);
INSERT INTO reptiles VALUES ('A456811454521915',3);
 
INSERT INTO vaccine VALUES ('A0092342112314525','canine distemper virus');
INSERT INTO vaccine VALUES ('A0015487945215487','canine parvovirus');
INSERT INTO vaccine VALUES ('A0000015415456712','canine adenovirus-2 (hepatitis)');
INSERT INTO vaccine VALUES ('A1502498211245568','rabies virus');
INSERT INTO vaccine VALUES ('A0154892012213258','Leptospira species');
INSERT INTO vaccine VALUES ('B1456279892155658','Polyomavirus Vaccine');
 
INSERT INTO ussage VALUES ('canine distemper virus','every three to four weeks until 16 weeks old');
INSERT INTO ussage VALUES ('canine parvovirus','at 8, 12 and 16 weeks of age');
INSERT INTO ussage VALUES ('canine adenovirus-2 (hepatitis)','2 doses');
INSERT INTO ussage VALUES ('rabies virus','2 doses');
INSERT INTO ussage VALUES ('Leptospira species','every six to nine months');
INSERT INTO ussage VALUES ('Polyomavirus Vaccine','one per year');
 
INSERT INTO bgets VALUES ('B1456279892155658','A908723411546210',1);
INSERT INTO bgets VALUES ('B1456279892155658','A589742161248415',1);
INSERT INTO bgets VALUES ('B1456279892155658','A459871326512456',1);
INSERT INTO bgets VALUES ('B1456279892155658','A459871326512478',1);
INSERT INTO bgets VALUES ('B1456279892155658','B459871352145987',1);
 
INSERT INTO mgets VALUES ('A0092342112314525','A100000001232560',3);
INSERT INTO mgets VALUES ('A0015487945215487','A100000001232560',3);
INSERT INTO mgets VALUES ('A0000015415456712','A100000001232560',1);
INSERT INTO mgets VALUES ('A0092342112314525','A125624805456120',2);
INSERT INTO mgets VALUES ('A0015487945215487','A125624805456120',2);
 
INSERT INTO bookedappointment VALUES ('2022-06-30 09:30','778-123-4563','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-06-30 11:30','604-756-1234','General Outpatient Clinic');
INSERT INTO bookedappointment VALUES ('2022-06-30 13:30','232-157-1659','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-01 12:30','778-223-2232','General Outpatient Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-01 16:00','232-156-7854','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-09 16:30','778-123-4563','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-20 11:30','232-156-7854','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-16 12:30','604-123-4562','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-04 14:30','604-332-3369','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-15 11:30','232-157-1659','Specialist Clinic');
INSERT INTO bookedappointment VALUES ('2022-07-22 11:30','232-456-1233','Specialist Clinic');
 
 
 
 
INSERT INTO veterinarian VALUES('A1145297780','Surgery','Joson','1624154980');
INSERT INTO veterinarian VALUES('A1548795002','Cardiology','Nancy','9726dsf38415');
INSERT INTO veterinarian VALUES('A1545965621','Neurology','Joson','6549854zxf');
INSERT INTO veterinarian VALUES('B4546263121','Surgery','Peter','6d5sa4f64');
INSERT INTO veterinarian VALUES('CD154561212','Oncology','Zoey','cxzfvg65d4165');
 
INSERT INTO hospital VALUES('North Road Animal Hospital','435 North Rd','604-936-3355','receptionnrah@gmail.com','604-936-3355','fdhg56xcv4','Coquitlam');
INSERT INTO hospital VALUES('Kensington Square Shopping Centre','6620 Hastings St','604-291-8387','kensing@gmail.com','604-294-8315','sdafg641','Burnaby');
INSERT INTO hospital VALUES('South Burnaby Veterinary Hospital','7665 Edmonds St','604-526-0034','southbvh@gmail.com','604-598-1258','984zxcv984','Burnaby');
INSERT INTO hospital VALUES('Central City Animal Hospital','1-7834 6th St','604-522-3344','CentreC@gmail.com','604-895-5698','56165g4hfj65','Burnaby');
INSERT INTO hospital VALUES('VCA Canada Como Lake Animal Hospital','1960 Como Lake Ave #156','604-931-7760','vachospital@gmail.com','604-987-2354','ghj548t9','Coquitlam');
 
INSERT INTO arranges VALUES('2022-06-30 09:30','778-123-4563','435 North Rd','102');
INSERT INTO arranges VALUES('2022-06-30 11:30','604-756-1234','6620 Hastings St','101');
INSERT INTO arranges VALUES('2022-06-30 13:30','232-157-1659','7665 Edmonds St','103');
INSERT INTO arranges VALUES('2022-07-01 12:30','778-223-2232','6620 Hastings St','102');
INSERT INTO arranges VALUES('2022-07-01 16:00','232-156-7854','7665 Edmonds St','110');
INSERT INTO arranges VALUES('2022-07-09 16:30','778-123-4563','6620 Hastings St','105');
INSERT INTO arranges VALUES('2022-07-20 11:30','232-156-7854','6620 Hastings St','100');
INSERT INTO arranges VALUES('2022-07-16 12:30','604-123-4562','6620 Hastings St','111');
INSERT INTO arranges VALUES('2022-07-04 14:30','604-332-3369','6620 Hastings St','115');
INSERT INTO arranges VALUES('2022-07-15 11:30','232-157-1659','6620 Hastings St','210');
INSERT INTO arranges VALUES('2022-07-22 11:30','232-456-1233','6620 Hastings St','104');
 
 
 
INSERT INTO worksin VALUES('435 North Rd','A1545965621',2);
INSERT INTO worksin VALUES('6620 Hastings St','B4546263121',3);
INSERT INTO worksin VALUES('7665 Edmonds St','CD154561212',5);
INSERT INTO worksin VALUES('1-7834 6th St','A1145297780',6);
INSERT INTO worksin VALUES('1960 Como Lake Ave #156','A1548795002',1);
 
INSERT INTO providedreport VALUES ('D002159821', 'A1145297780',  '2022-06-30 10:25', 'Combined with medication', 'eye inflammation', 'N/A');
INSERT INTO providedreport VALUES ('D002159822', 'A1548795002',  '2022-06-30 14:15', 'Combined with medication', 'cough', 'diagnosed with heart disease');
INSERT INTO providedreport VALUES ('D002159823', 'A1545965621',  '2022-06-30 16:54', 'Combined with medication', 'head tilt', 'N/A');
INSERT INTO providedreport VALUES ('S025698712', 'B4546263121',  '2022-07-01 15:25', 'Combined with medication', 'poor appetite', 'N/A');
INSERT INTO providedreport VALUES ('S025698713', 'CD154561212',  '2022-07-01 17:32', 'Sterilization', 'weakness', 'diagnosed with ovarian cyst');
 
INSERT INTO ridpid VALUES ('D002159821', 'A445777124458970');
INSERT INTO ridpid VALUES ('D002159822',  'B598846234561230');
INSERT INTO ridpid VALUES ('D002159823',  'B459683214596458');
INSERT INTO ridpid VALUES ('S025698712',  'A589742161248415');
INSERT INTO ridpid VALUES ('S025698713', 'A125624805456120');
 
INSERT INTO doesexamination VALUES ('2022-06-29 13:07', 'A1145297780', 'Regular');
INSERT INTO doesexamination VALUES ('2022-06-29 16:35', 'A1548795002', 'Cardiac');
INSERT INTO doesexamination VALUES ('2022-06-30 17:41', 'A1545965621', 'Neurologic');
INSERT INTO doesexamination VALUES ('2022-07-01 08:58', 'B4546263121', 'Regular');
INSERT INTO doesexamination VALUES ('2022-07-01 12:44', 'CD154561212', 'Oncology');
 
INSERT INTO makes VALUES ('B459871352145987', '2022-06-29 13:07', 'A1145297780','N/A');
INSERT INTO makes VALUES ('B598846234561230', '2022-06-29 16:35', 'A1548795002','Poor appetite');
INSERT INTO makes VALUES ('A100000001232560', '2022-06-30 17:41', 'A1545965621','Fatigue');
INSERT INTO makes VALUES ('A589742161248415', '2022-07-01 08:58', 'B4546263121','N/A');
INSERT INTO makes VALUES ('A456811454521915', '2022-07-01 12:44', 'CD154561212','Poor appetite');
 
INSERT INTO nameeffect VALUES ('Vetmedin', 'treat heart disease');
INSERT INTO nameeffect VALUES ('Deracoxib', 'reduce pain');
INSERT INTO nameeffect VALUES ('Drontal', 'remove parasitic worms');
INSERT INTO nameeffect VALUES ('Vanectyl', 'relieve itching');
INSERT INTO nameeffect VALUES ('Clavamox', 'treat bacterial infections');
 
INSERT INTO didname VALUES ('02248211', 'Vetmedin');
INSERT INTO didname VALUES ('02265788', 'Deracoxib');
INSERT INTO didname VALUES ('02169425', 'Drontal');
INSERT INTO didname VALUES ('00170925', 'Vanectyl');
INSERT INTO didname VALUES ('02027879', 'Clavamox');
 
INSERT INTO Prescribe VALUES ('02027879',  'twice a day','D002159821','A1145297780','A445777124458970');
INSERT INTO Prescribe VALUES ('00170925',  'once a day','D002159822','A1548795002','B598846234561230');
INSERT INTO Prescribe VALUES ('02265788',  'once a day','D002159823','A1545965621','B459683214596458');
INSERT INTO Prescribe VALUES ('02169425',  'every 3 months','S025698712','B4546263121','A589742161248415');
INSERT INTO Prescribe VALUES ('02248211',  'twice a day','S025698713','CD154561212','A125624805456120');