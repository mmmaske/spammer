# Email Spammer

A webpage to send batches of emails over a scheduled time period

# Installation

0. Install a working Apache/PHP/MySQL server. [Windows](https://www.apachefriends.org/download.html) [Linux](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)
1. Download/Clone the repository to your webserver (Don't forget to run `composer update` after cloning)
2. Copy the file 'blank-global-config.php' to 'global-config.php' and change the values in the file
3. Run the spammer.sql file in your MySQL instance
4. Set up a scheduled task to query the `Home/send` page every minute

# Usage

0. Create a .csv file from the sample provided after downloading
1. Upload the .csv to the spammer page
2. Wait for the scheduled email to send

