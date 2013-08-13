Insert Into UserType (Id,Name) values
('1','manager'),
('2','employee')
;
Insert Into User (Id,UserName,Password,ResetNextLogin,PasswordDate,UserTypeId,IsLocked) Values
(1,'QuadManager1',md5('123!trueSeed'),0,NOW(),1,0),
(2,'QuadEmployee1',md5('123!trueSeed'),0,NOW(),2,0)
;
Insert Into Category (Id,Name,Description,UserId) Values
(1,'Current Assets','test',1),
(2,'Property, Plant & Equipment','test',1),
(3,'Other Assets','test',1),
(4,'Current Liabilities','test',1),
(5,'Long Term Liabilities','test',1),
(6,'Equity','test',1),
(7,'Revenue','test',1),
(8,'Direct Program Costs','test',1),
(9,'Fringe Benefit Costs','test',1),
(10,'Overhead Costs','test',1),
(11,'General & Administrative (G&A) Costs','test',1),
(12,'Unallowable Costs','test',1)
;
Insert Into Account (Id,Name,InitialBalance,Code,CategoryId,UserId,Description,NormalBalance,Type) Values
(1,'Cash',0.00,1000,1,1,'test','DEBIT','ASSET'),
(2,'Accounts Receivable',0.00,1020,1,1,'test','DEBIT','ASSET'),
(3,'Inventory - Work in Progress',0.00,1040,1,1,'test','DEBIT','ASSET'),
(4,'Prepayments',0.00,1060,1,1,'test','DEBIT','ASSET'),
(5,'Equipment - Lab',0.00,1100,2,1,'test','DEBIT','ASSET'),
(6,'Equipment - Office',0.00,1110,2,1,'test','DEBIT','ASSET'),
(7,'Current Notes Payable',0.00,2000,4,1,'test','CREDIT','LIABILITY'),
(8,'Accounts Payable',0.00,2010,4,1,'test','CREDIT','LIABILITY'),
(9,'Notes Payable',0.00,2100,5,1,'test','CREDIT','LIABILITY'),
(10,'Common Stock',0.00,3000,6,1,'test','CREDIT','SHE'),
(11,'Retained Earnings',0.00,3001,6,1,'test','CREDIT','SHE'),
(12,'Commercial Sales',0.00,4000,7,1,'test','CREDIT','REVENUE'),
(13,'Grant Revenue',0.00,4010,7,1,'test','CREDIT','REVENUE'),
(14,'Interest Income',0.00,4020,7,1,'test','CREDIT','REVENUE'),
(15,'Direct Labor',0.00,5000,8,1,'test','DEBIT','EXPENSE'),
(16,'Consultants',0.00,5100,8,1,'test','DEBIT','EXPENSE'),
(17,'Other/Miscellaneous',0.00,5500,8,1,'test','DEBIT','EXPENSE'),
(18,'Payroll Taxes',0.00,6025,9,1,'Test','DEBIT','EXPENSE'),
(19,'Group Insurance',0.00,6035,9,1,'Test','DEBIT','EXPENSE'),
(20,'Overhead Labor',0.00,7000,10,1,'Test','DEBIT','EXPENSE'),
(21,'Utilities',0.00,7150,10,1,'Test','DEBIT','EXPENSE'),
(22,'Telephone',0.00,7160,10,1,'Test','DEBIT','EXPENSE'),
(23,'Repairs & Maintenance',0.00,7190,10,1,'Test','DEBIT','EXPENSE'),
(24,'General Lab Supplies',0.00,7200,10,1,'Test','DEBIT','EXPENSE'),
(25,'Travel',0.00,7210,10,1,'Test','DEBIT','EXPENSE'),
(26,'G&A Labor',0.00,8000,11,1,'Test','DEBIT','EXPENSE'),
(27,'Rent',0.00,8020,11,1,'Test','DEBIT','EXPENSE'),
(28,'Utilities',0.00,8030,11,1,'Test','DEBIT','EXPENSE'),
(29,'Telephone',0.00,8040,11,1,'Test','DEBIT','EXPENSE'),
(30,'Equipment Rental',0.00,8050,11,1,'Test','DEBIT','EXPENSE'),
(31,'Expendable Equipment',0.00,8060,11,1,'Test','DEBIT','EXPENSE'),
(32,'Repairs & Maintenance',0.00,8070,11,1,'Test','DEBIT','EXPENSE'),
(33,'Office Supplies',0.00,8080,11,1,'Test','DEBIT','EXPENSE'),
(34,'Travel',0.00,8090,11,1,'Test','DEBIT','EXPENSE'),
(35,'Dues & Subscriptions',0.00,8140,11,1,'Test','DEBIT','EXPENSE'),
(36,'Postage',0.00,8150,11,1,'Test','DEBIT','EXPENSE'),
(37,'Drawing',0.00,3500,6,1,'Test','DEBIT','DIVIDEND')
;
UPDATE Account set isInventory = 1 WHERE Id in (3)
;
INSERT INTO RatioThreshold (Name,High,Low,HigherIsBetter) values
('debtToEquity',100,50,1),
('current',100,50,1),
('quick',100,50,0),
('returnOnEquity',100,50,0),
('netProfitMargin',100,50,1)
;

