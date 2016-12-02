# Installation instructions:
This API has been implemented using *Laravel*. The underlying decission to choose this framework amongst other is to make it compatible with the company requirements. This framework also makes it really easy to create API compliant with the REST architecture. It also uses a very powerful ORM to abstract data models. It's also highly scalable and can be used/migrated to a microservices approach using **Lumen**, a micro-framework by Laravel.

Simply run the following command on your console (make sure that you don't have another folder named *gousto*)

    git clone git@github.com:miwels/gousto-recipes-api.git gousto; cd gousto; ./deploy.sh

The **deploy.sh** file contains all the necessary bash commands to set up the API and it's dependencies.

After the app has been deployed you can access it by going to *http://localhost:8000*. Make sure that port 8000 is not binded to any other service.

This API uses **Laravel 5.3** so it requires **PHP >= 5.6.4**

# Data definition

Following the test requirements I have decided to use a SQLite approach. This way I can demonstrate the use of database migrations.
Migrations can be found in the *database/migrations* folder. It creates a basic structure using the *sqlite* driver. The application requires the database file to exist in the *storage* folder but we can also use an in-memory database by editing the *config/database.php* file (I have commented out the necessary fields)

This makes it much easier to bind our data with a model to perform CRUD operations. The data is loaded from the CSV file before the migration using a **seeder** so that we have a fresh set of data every time we deploy our application.

You can reset the database at any time using the following command

    php artisan db:seed --class=RecipesTableSeeder

The API uses the *Repository* and *Factory* patterns so that we can split our business logic and the data access logic.

If you need to run some tests just go to the application folder and run PHPUnit:

    cd gousto/
    phpunit

One of the requirements is to allow rating recipes. Due to our generic implementation of the solution we can do this by using the same *update* method used to change any other properties of our model.

We have added one extra endpoint in the root folder (**/**) which basically calls the **route:list** command and displays a list of available API methods.
The RESTFull approach simplifies data consumption from diferent devices due to the **simplePaginate** method. We can define our own pagination parameters in the URL in case we want to display more or less results in order to adapt the output data to specific devices.