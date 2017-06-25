# gapstarsTechAssignment Documentation

Steps to test the assignment.

1. Run the database bakup file "database/database_backup_isurutempwork.sql" in your database.
2. Open ".env" file in your text editor and change

		DB_USERNAME={to your username}
		DB_PASSWORD={to your password}

3. Go to root folder of the project and open command line from there.
   Then run "php artisan serve" in your command line.
   If you able to successfully up the server you will get
   	"Laravel development server started: <http://127.0.0.1:8000>" message in command prompt.

4. Then go to your browser and run following url.
			"localhost:8000"