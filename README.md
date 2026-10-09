<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Kessy Brothers Food

The restaurant storefront uses the Kessy Tech Pro logo palette: navy, warm
orange/gold, and cyan blue. The homepage and menu read available meals from the
database; administrators can upload JPG, PNG, or WebP food photos up to 4 MB.

After pulling the application changes, run the database migrations and create
Laravel's public storage link so uploaded food photos can be served:

```sh
php artisan migrate
php artisan storage:link
```

Customers must sign in before opening checkout. They can choose delivery or
pickup and track account orders in the customer dashboard. Completed-sales
reports use the `completed_at` timestamp, so only orders completed after the
new migration contribute to the date-based sales totals.

New customer accounts must verify their email before accessing account,
checkout, or administrator pages. In the production environment, configure
`APP_NAME="Kessy Brothers Food"`, `APP_URL` to the public HTTPS site address,
and set `MAIL_MAILER=smtp`,
`MAIL_SCHEME=smtps`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`,
`MAIL_PASSWORD`, and `MAIL_FROM_ADDRESS` so verification and password-reset
messages reach customers. Both email types use Kessy Brothers Food branding
and do not include Laravel's default logo. Password-reset links expire after
60 minutes by default. Keep SMTP credentials in the server's `.env`, not in
source control.
The default local mailer writes messages to the Laravel log instead of sending
them to an inbox.

Customer registration collects a phone number and gender preference. For
account security, the admin-only customer area stores login IP, an abbreviated
device/platform/browser description, login time, last activity, and explicit
logout time. A session with no explicit logout is shown as inactive after the
configured session lifetime; closing a browser does not provide an exact
logout timestamp. Deactivating an account preserves its orders and login
history, and an administrator can restore it. Customer password assistance
uses a reset link sent to the customer's email; administrators never see a
customer's password.

Online payment processing and delivery fees are not enabled: connect a selected
payment provider and configure the restaurant's actual delivery rules before
collecting money or charging delivery in production.
