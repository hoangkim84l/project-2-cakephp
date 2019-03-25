# project-2-
# laravel
# LTE, adminLTE

###########   HOW TO USE  #####################

1. Installation
Require the package using composer:

composer require jeroennoten/laravel-adminlte
Add the service provider to the providers in config/app.php:

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider

JeroenNoten\LaravelAdminLte\ServiceProvider::class,
Publish the public assets:

php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets
2. Updating
To update this package, first update the composer package:

composer update jeroennoten/laravel-adminlte
Then, publish the public assets with the --force flag to overwrite existing files

php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets --force
3. Usage
To use the template, create a blade file and extend the layout with @extends('adminlte::page'). This template yields the following sections:

title: for in the <title> tag
content_header: title of the page, above the content
content: all of the page's content
css: extra stylesheets (located in <head>)
js: extra javascript (just before </body>)
All sections are in fact optional. Your blade template could look like the following.

{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
Note that in Laravel 5.2 or higher you can also use @stack directive for css and javascript:

{{-- resources/views/admin/dashboard.blade.php --}}

@push('css')

@push('js')
You now just return this view from your controller, as usual. Check out AdminLTE to find out how to build beautiful content for your admin panel.

4. The make:adminlte artisan command
Note: only for Laravel 5.2 and higher

This package ships with a make:adminlte command that behaves exactly like make:auth (introduced in Laravel 5.2) but replaces the authentication views with AdminLTE style views.

php artisan make:adminlte
This command should be used on fresh applications, just like the make:auth command

4.1 Using the authentication views without the make:adminlte command
If you want to use the included authentication related views manually, you can create the following files and only add one line to each file:

resources/views/auth/login.blade.php:
@extends('adminlte::login')
resources/views/auth/register.blade.php
@extends('adminlte::register')
resources/views/auth/passwords/email.blade.php
@extends('adminlte::passwords.email')
resources/views/auth/passwords/reset.blade.php
@extends('adminlte::passwords.reset')
By default, the login form contains a link to the registration form. If you don't want a registration form, set the register_url setting to null and the link will not be displayed.

5. Configuration
First, publish the configuration file:

php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=config
Now, edit config/adminlte.php to configure the title, skin, menu, URLs etc. All configuration options are explained in the comments. However, I want to shed some light on the menu configuration.

5.1 Menu
You can configure your menu as follows:

'menu' => [
    'MAIN NAVIGATION',
    [
        'text' => 'Blog',
        'url' => 'admin/blog',
    ],
    [
        'text' => 'Pages',
        'url' => 'admin/pages',
        'icon' => 'file'
    ],
    [
        'text' => 'Show my website',
        'url' => '/',
        'target' => '_blank'
    ],
    'ACCOUNT SETTINGS',
    [
        'text' => 'Profile',
        'route' => 'admin.profile',
        'icon' => 'user'
    ],
    [
        'text' => 'Change Password',
        'route' => 'admin.password',
        'icon' => 'lock'
    ],
],
With a single string, you specify a menu header item to separate the items. With an array, you specify a menu item. text and url or route are required attributes. The icon is optional, you get an open circle if you leave it out. The available icons that you can use are those from Font Awesome. Just specify the name of the icon and it will appear in front of your menu item.

Use the can option if you want conditionally show the menu item. This integrates with Laravel's Gate functionality. If you need to conditionally show headers as well, you need to wrap it in an array like other menu items, using the header option:

[
    [
        'header' => 'BLOG',
        'can' => 'manage-blog'
    ],
    [
        'text' => 'Add new post',
        'url' => 'admin/blog/new',
        'can' => 'add-blog-post'
    ],
]
Custom Menu Filters
If you need custom filters, you can easily add your own menu filters to this package. This can be useful when you are using a third-party package for authorization (instead of Laravel's Gate functionality).

For example with Laratrust:

<?php

namespace MyApp;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
            return false;
        }

        return $item;
    }
}
And then add to config/adminlte.php:

'filters' => [
    JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
    JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
    //JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class, Comment this line out
    MyApp\MyMenuFilter::class,
]
Menu configuration at runtime
It is also possible to configure the menu at runtime, e.g. in the boot of any service provider. Use this if your menu is not static, for example when it depends on your database or the locale. It is also possible to combine both approaches. The menus will simply be concatenated and the order of service providers determines the order in the menu.

To configure the menu at runtime, register a handler or callback for the MenuBuilding event, for example in the boot() method of a service provider:

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{

    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url' => 'admin/blog',
            ]);
        });
    }

}
The configuration options are the same as in the static configuration files.

A more practical example that actually uses translations and the database:

    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('menu.pages'));

            $items = Page::all()->map(function (Page $page) {
                return [
                    'text' => $page['title'],
                    'url' => route('admin.pages.edit', $page)
                ];
            });

            $event->menu->add(...$items);
        });
    }
This event-based approach is used to make sure that your code that builds the menu runs only when the admin panel is actually displayed and not on every request.

Active menu items
By default, a menu item is considered active if any of the following holds:

The current path matches the url parameter
The current path is a sub-path of the url parameter
If it has a submenu containing an active menu item
To override this behavior, you can specify an active parameter with an array of active URLs, asterisks and regular expressions are supported. Example:

[
    'text' => 'Pages'
    'url' => 'pages',
    'active' => ['pages', 'content', 'content/*']
]
5.2 Plugins
By default the DataTables plugin is supported. If set to true, the necessary javascript CDN script tags will automatically be injected into the adminlte::page.blade file.

'plugins' => [
    'datatables' => true,
]
Also the Select2 plugin is supported. If set to true, the necessary javascript CDN script tags will automatically be injected into the adminlte::page.blade file.

'plugins' => [
    'datatables' => true,
    'select2' => true,
]
Also the ChartJS plugin is supported. If set to true, the necessary javascript CDN script tags will automatically be injected into the adminlte::page.blade file.

'plugins' => [
    'datatables' => true,
    'chartjs' => true,
]
6. Translations
At the moment, English, German, French, Dutch, Portuguese and Spanish translations are available out of the box. Just specifiy the language in config/app.php. If you need to modify the texts or add other languages, you can publish the language files:

php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=translations
Now, you can edit translations or add languages in resources/lang/vendor/adminlte.

7. Customize views
If you need full control over the provided views, you can publish them:

php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=views
Now, you can edit the views in resources/views/vendor/adminlte.

###############################################
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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost you and your team's skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### run create locale
php artisan make:middleware Locale
