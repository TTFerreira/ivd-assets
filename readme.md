# I.V.D. Assets

I.V.D. Assets is a web application developed with Laravel 5.2, that caters to the needs of I.T. Departments and Help Desks.

* Manage all your I.T. assets
* Ticketing System functionality
* Different User Roles to safeguard Asset Information

Work In Progress

* Slack Integration for notifications of new Tickets and Asset Movements
* Reports (Currently DataTables can be filtered and exported as .csv, .xslx or copied)
* More functionality for Tickets (Attachments, Reports)

## Demo

[I.V.D. Assets Demo](https://assets-demo.terryferreira.com)

The database is reset every 24 hours.

### Demo Accounts

#### Super Administrator
Can use all functionality, and create/edit Locations, Divisions, Suppliers, Ticket Statuses, Priorities, Types and more.

* User Name: superadmin@terryferreira.com
* Password: superadmin

#### Administrator
Can use Assets and Tickets functionality.

* User Name: adminuser@terryferreira.com
* Password: adminuser

#### End User
Can only use Tickets functionality.

* User Name: useruser@terryferreira.com
* Password: useruser

## Install

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

### Slack Integration

You will find 4 lines for Slack in the `.env` file.
All that you are required to do to get slack to work is to [Create an Incoming Webhook here](https://my.slack.com/services/new/incoming-webhook).
Simply create a new webhook on your slack account and copy and paste it next to `SLACK_WEBHOOK=` in the `.env` file, without any quotes.
You're welcome to change the default channel and bot name there as well.

Slack integration is disabled by default. If you want to use Slack, change `SLACK_ENABLED=flase` to `SLACK_ENABLED=true`
You can also edit the Slack Integration in more detail within `app/config/slack.php`

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
* Default Super Administrator Account
* Super Administrator Role for the Account

You must run the database seed in order for the application to function.

However, we have also included several extra seeds that you can include if you want some demo content.
The demo content is also required for the Unit Tests to function.

So before running `db:seed` open the `database/seeds/DatabaseSeeder.php` file.
Uncomment any extra seeds you would like to include, then run `db:seed`

```bash
php artisan db:seed
```

## Super Administrator User

A Super Administrator account is created during the normal `db:seed` and the role of Super Administrator is assigned to the account.
After logging in to the application, head over to `admin/users/` and edit the user account to match your name, email and password.
Password must be a minimum of 6 characters long.
There must also be one (1) Super Administrator user at all times. So you cannot change the role of the only Super Administrator user account.

The login details for the account are as follows.

* User Name: superadmin@terryferreira.com
* Password: superadmin

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
phpunit tests/folder/filename --filter=testname
```

Example

```bash
phpunit tests/models/StatusTest --filter=testCreateNewStatus
```

There are currently 49 tests, with 419 assertions.

## Credits/Packages

* [Acacha AdminLTE Laravel](https://github.com/acacha/adminlte-laravel)
* [Select2](https://select2.github.io/)
* [DataTables](https://datatables.net/)
* [toastr](http://codeseven.github.io/toastr/)
* [slack-laravel](https://github.com/maknz/slack-laravel)


## License

Licensed under the [MIT license](http://opensource.org/licenses/MIT).
