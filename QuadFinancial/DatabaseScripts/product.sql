Drop DATABASE IF EXISTS `QuadFinancial`;
CREATE DATABASE `QuadFinancial` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE QuadFinancial;
-- Tables
----------------------------------------------------------------------------------------------------
--UserType
----------------------------------------------------------------------------------------------------
CREATE TABLE `UserType` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY(`id`),
  UNIQUE KEY (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
----------------------------------------------------------------------------------------------------
--Users
----------------------------------------------------------------------------------------------------
CREATE TABLE `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `Password` char(32) NOT NULL,
  `ResetNextLogin` bool,
  `PasswordDate`TIMESTAMP,
  `UserTypeId` int(11) NOT NULL,
  `IsLocked` bool NOT NULL,
  `Deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`UserName`),
  KEY `fk_user_usertype` (`UserTypeId`),
  CONSTRAINT `fk_user_usertype` FOREIGN KEY (`UserTypeid`) REFERENCES `UserType` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
----------------------------------------------------------------------------------------------------
--Category
----------------------------------------------------------------------------------------------------
CREATE TABLE `Category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(512) NOT NULL,
  `CreatedOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `AlteredOn` TIMESTAMP,
  `UserId` int(11) NOT NULL,
  `Deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY(`Id`),
  UNIQUE KEY (`Name`),
  KEY `fk_category_user` (`UserId`),
  CONSTRAINT `fk_category_user` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
----------------------------------------------------------------------------------------------------
--Accounts
----------------------------------------------------------------------------------------------------
CREATE TABLE `Account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `InitialBalance` decimal(19,4) NOT NULL,
  `Code` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `CreatedOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `AlteredOn` TIMESTAMP,
  `UserId` int(11) NOT NULL,
  `Type` ENUM('REVENUE','EXPENSE','DIVIDEND','SHE','ASSET','LIABILITY'),
  `NormalBalance` ENUM('DEBIT','CREDIT'),
  `Description` varchar(512) NOT NULL,
  `Deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY(`Id`),
  UNIQUE KEY (`Code`),
  KEY `fk_account_user` (`UserId`),
  KEY `fk_accountcategory_category` (`CategoryId`),
  CONSTRAINT `fk_account_user` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_accountcategory_category` FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
ALTER TABLE Account ADD isInventory tinyint(1)
;
----------------------------------------------------------------------------------------------------
--JournalEntries
----------------------------------------------------------------------------------------------------
CREATE TABLE `JournalEntry` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(512) NOT NULL,
  `SupportingDocument` LONGBLOB DEFAULT NULL, 
  `SupportingDocumentName`varchar(512) DEFAULT NULL,
  `SupportingDocumentType` varchar(30) DEFAULT NULL,
  `SupportingDocumentSize` int DEFAULT NULL,
  `CreatedOn` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `PostedOn` TIMESTAMP,
  `Date` TIMESTAMP NOT NULL,
  `Posted`  TINYINT(1) DEFAULT 0,
  `PosterUserId` int(11) NOT NULL,
  `AuthorizerUserId` int(11) ,
  `Deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY(`id`),
  KEY `fk_journalentry_poster` (`PosterUserId`),
  CONSTRAINT `fk_journalentry_poster` FOREIGN KEY (`PosterUserId`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  KEY `fk_journalentry_authorizer` (`AuthorizerUserId`),
  CONSTRAINT `fk_journalentry_authorizer` FOREIGN KEY (`AuthorizerUserId`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
Alter Table JournalEntry Add column DeletedOn timestamp NOT Null DEFAULT '0000-00-00 00:00:00';
----------------------------------------------------------------------------------------------------
--DataPoints
----------------------------------------------------------------------------------------------------
CREATE TABLE `DataPoints` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `JournalEntryId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `DebitOrCredit` varchar(10) NOT NULL,
  `Amount`  decimal(19,4) NOT NULL,
  PRIMARY KEY(`id`),
  KEY `fk_datapoint_journalentry` (`JournalEntryId`),
  KEY `fk_datapoint_account` (`AccountId`),
  CONSTRAINT `fk_datapoint_journalentry` FOREIGN KEY (`JournalEntryId`) REFERENCES `JournalEntry` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_datapoint_account` FOREIGN KEY (`AccountId`) REFERENCES `Account` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
CREATE TABLE `RatioThreshold` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `High`  float(30),
  `Low`	float(30),
  `HigherIsBetter` tinyint(1),
  PRIMARY KEY(`id`),
  UNIQUE KEY (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
;
ALTER TABLE RatioThreshold ADD UserId int(11);
