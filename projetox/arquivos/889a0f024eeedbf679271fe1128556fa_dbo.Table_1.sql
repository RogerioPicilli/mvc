CREATE TABLE [dbo].[task]
(
	[Id] INT NOT NULL PRIMARY KEY, 
    [name] NVARCHAR(50) NULL, 
    [notes] NVARCHAR(250) NULL, 
    [done] BIT NULL
)
