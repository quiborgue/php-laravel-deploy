## Laravel Deploy

### Usage:

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `way/generators`.

    "require-dev": {
        "quiborgue/laravel-deploy": "dev-master"
    }

Next, update Composer from the Terminal:

    composer update --dev

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Quiborgue\LaravelDeploy\LaravelDeployServiceProvider'

That's it! You're all set to go. Run the `artisan` command from the Terminal to see the new `generate` commands.

    php artisan