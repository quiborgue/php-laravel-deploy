## Laravel Deploy

### Usage:

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `quiborgue/laravel-deploy`.

    "require-dev": {
        "quiborgue/laravel-deploy": "dev-master"
    }

Next, update Composer from the Terminal:

    composer update --dev

Once this operation completes, the final step is to add the service provider. Open `app/config/local/app.php`, and add a new item to the providers array.

    'Quiborgue\LaravelDeploy\LaravelDeployServiceProvider'

That's it! You're all set to go. Run the `artisan` command from the Terminal to see the new `generate` commands.

    php artisan


## Server initial setup
	# Login to your server
	local # ssh root@remote
        remote# sudo locale-gen pt_BR.UTF-8
        remote# sudo dpkg-reconfigure locales


	# Update system
	remote# apt-get update
	remote#	apt-get upgrade
	
	# Update kernel
	remote#	apt-get dist-upgrade
	remote#	shutdown -r now
	remote#	apt-get autoremove
	
	# Check if everything is updated
	remote#	apt-get update
	remote#	apt-get upgrade
	
	# Install PHP and Database packages
	remote#	apt-get install libapache2-mod-php5
	remote#	apt-get install php5-mcrypt php5-curl
	remote#	apt-get install [php5-sqlite|php5-pgsql postgresql|php-mysql mysql-server]
	remote# apt-get install git
	
	# Create deployment user
	remote#	useradd deploy
	remote#	mkdir /home/deploy
	remote#	chown deploy.deploy /home/deploy
	remote#	chmod 700 /home/deploy

	# Configure deployment user ssh access
	remote#	mkdir /home/deploy/.ssh
	remote#	chown deploy.deploy /home/deploy/.ssh
	remote#	chmod 700 /home/deploy/.ssh
	remote#	echo "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDU0k/rbeaqT87Ac7LPemJGgy55E8VraWeHjobrboUR6tPutqwqykGg3aND5jRMttbBXO2HJYjD7TocHRKVdMX5LFx34mI4MDMaFTHZ1nzyfKbZ0YdjYGafSzXBjC/kKZYCQNTaTjkQ54Y4ouGVs48xvW1h7FJF8lg474FY3xfhpo9WasJI6GyWIJbLPJyRz/VN7PqN+s2ruQdowvMsHCAFbv4SKdXXbFvThVaYPqGc9vH574IWS1ZOekRnqhjs0PUAFsPtN+T5hTUPkB0cQ+MJzjN9AZnX5G0zXoeM2u+WwQwyKT2bqht92ePOjF+pNNAeiWZPd2bM6wRwstoCvnS7" >> /home/deploy/.ssh/authorized_keys
	remote#	chmod 600 /home/deploy/.ssh/authorized_keys
	remote#	chown deploy.deploy /home/deploy/.ssh/authorized_keys
	remote#	exit
	local # ssh -i ~/.ssh/deploy.pem deploy@remote
	remote$ exit

	# Configure PHP application folder
	remote#	chown deploy.www-data /var/www
	remote#	chmod g+s /var/www

	# Configure Composer dependencies
	remote#	su deploy
	remote#	composer global require "fxp/composer-asset-plugin:dev-master"
        remote#   exit

        # Configure swap memory
        remote#  fallocate -l 4G /swapfile
        remote#  chmod 600 /swapfile
        remote#  mkswap /swapfile
        remote#  echo "/swapfile   none    swap    sw    0   0" >> /etc/fstab
        remote#  shutdown -r now

	# Exit and teste your deploy
	remote# exit
	local # cd /laravel/project/path
	local # php artisan deploy
