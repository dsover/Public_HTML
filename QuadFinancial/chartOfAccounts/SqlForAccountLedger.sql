Select 
	je.Id as "JournalId",
	je.Date as "Date",
	je.Description as "Description",
	dp.DebitOrCredit as "DebitOrCredit",
	dp.Amount,
	je.SupportingDocument as "FileBianary",
	je.SupportingDocumentName as "FileName",
	je.SupportingDocumentType as "FileType",
	je.SupportingDocumentSize as "FileSize"
from 
	JournalEntry je
	join 
		DataPoints dp on dp.JournalEntryId = je.Id
where 
	AccountId = 1 
and 
	Posted = TRUE
order By 
	je.Date;

Select * from DataPoints
