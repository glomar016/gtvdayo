1. Copy all files inside sqldriver folder to your
xampp/php/ext

2. Modify your php.ini 
Find extension=pdo_sqlite
Make a new line and add this lines:
extension=php_sqlsrv_74_nts_x64.dll
extension=php_sqlsrv_74_ts_x64.dll

3. Run the database script in the folder using ssms.

Version to download
SQL SERVER 2014
https://www.microsoft.com/en-sg/download/confirmation.aspx?id=42299

XAMPP VERSION 7.4.12
https://www.apachefriends.org/download.html

OPTIONAL:
SSMS 2018:
https://docs.microsoft.com/en-us/sql/ssms/download-sql-server-management-studio-ssms?view=sql-server-ver15