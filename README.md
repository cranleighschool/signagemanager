= Install Instructions = 
== Conn.php ==
```php
​
try{
	$conn_dbserver = '';
	$conn_dbusername = '';
	$conn_dbpassword = '';
	$conn_database = '';
	
	#$PDO = new PDO("sqlsrv:Server=$conn_dbserver;Database=$conn_database", $conn_dbusername, $conn_dbpassword);  #MS SQL Server
	$PDO = new PDO("mysql:host=$conn_dbserver;dbname=$conn_database", $conn_dbusername, $conn_dbpassword);		  #mySQL Server
}catch(PDOException $e){
	print 'Error!: Failed to connect due to ' . $e->getMessage();
    die();	
}
​
​```
