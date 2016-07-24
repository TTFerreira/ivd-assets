# I.V.D. Assets

I.V.D. Assets is a web application developed with Laravel 5.2, that caters to the needs of I.T. Departments and Help Desks.

* Manage all your I.T. assets
* Ticketing System functionality
* Different User Roles to safeguard Asset Information

### Install

Clone the repository

```bash
git clone https://github.com/TTFerreira/ivd-assets.git
```

Run composer install

```bash
composer install
```

Rename `.env.example` to `.env`

Follow the 'Configuration' instructions on the [Official Laravel Documentation](https://laravel.com/docs/5.2#configuration) to complete the Laravel installation.

## Configuration

### .env

Open `.env` and complete your host, database and email settings.
All lines that have nothing next to `=` must be completed.
[Mailgun](http://www.mailgun.org) works extremely well and it is free.
If you prefer not to use Mailgun, remove the 2 lines for Mailgun from the `.env` file.

```php
MAILGUN_DOMAIN=
MAILGUN_SECRET=
```

### Time Zone

Open `config/app.php` and set your time zone.

## Database Migration and Seeds

### Migrate

Run artisan migrate

```bash
php artisan migrate
```

### Database Seeds

We have included several database seeds to create items required for the application to work.

* Asset Types
* Manufacturers
* Warranty Types
* Ticket Types
* Ticket Statuses
* Ticket Priorities
* Roles

You must run the database seed in order for the application to function.

However, we have also included several extra seeds that you can include if you want some demo content.
The demo content is also required for the Unit Tests to function.

So before running `db:seed` open the `database/seeds/DatabaseSeeder.php` file.
Uncomment any extra seeds you would like to include, then run `db:seed`

```bash
php artisan db:seed
```

## Create Super Administrator User

Run `php tinker`

```bash
php artisan tinker
```

Within `tinker`, create your Super Administrator and assign the `super-admin` role to the new user.

```bash
$user = new App\User();
$user->name = 'Your Name';
$user->email = 'Your Email';
$user->password = bcrypt('Your Password');
$user->api_token = str_random(60);
$user->save();

$superAdmin = App\Role::where('name', '=', 'super-admin')->first();

$user->attachRole($superAdmin);
```

## Tests

Create your test sqlite file.
Within the `database` folder, create file named `testing.sqlite`
If you want to use a different file, make sure to change the `sqlite_testing` section within `config/database.php` to reflect your file.

Run `migrate` on the test Database

```bash
php artisan migrate --database=sqlite_testing
```
Edit `database/seeds/DatabaseSeeder.php`
Uncomment ALL the Seeders

Run `db:seed` on the test Database

```bash
php artisan db:seed --database=sqlite_testing
```

### PHPunit

Run `phpunit` from the root folder to run all the tests for the application.

To run a specific test, first get the name of test file, and the name of the test, from within the `tests` folder.
Then run the command as follows.

```bash
phpunit tests/folder/filename -- filter=testname
```

Example

```bash
phpunit tests/models/StatusTest --filter=testCreateNewStatus
```

There are currently 49 tests, with 419 assertions.

## Credits

[Acacha AdminLTE Laravel](https://github.com/acacha/adminlte-laravel)
[Select2](https://select2.github.io/)
[DataTables](https://datatables.net/)
[toastr](http://codeseven.github.io/toastr/)

## License

Licensed under the [MIT license](http://opensource.org/licenses/MIT).
