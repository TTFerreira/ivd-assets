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
You must run the database seed in order for the application to function.

However, we have also included several extra seeds that you can include if you want some demo content.
The demo content is also required for the Unit Tests to function.

So before running `db:seed` open the `database/seeds/DatabaseSeeder.php` file.
Uncomment any extra seeds you would like to include, then run `db:seed`

```bash
php artisan db:seed
```

### Create Super Administrator User

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
$user-api_token = str_random(60);
$user->save();

$superAdmin = App\Role::where('name', '=', 'super-admin')->first();

$user->attachRole($superAdmin);
```

## License

Licensed under the [MIT license](http://opensource.org/licenses/MIT).
