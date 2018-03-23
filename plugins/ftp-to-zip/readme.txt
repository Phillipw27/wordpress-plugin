=== FTP to Zip ===
Author: abhishek_ghosh
Contributors: abhishek_ghosh
URL: https://thecustomizewindows.com/
Tags: backup, ftp, ftp backup
Requires at least: 4.5
Tested up to: 4.6.1
Stable tag: 1.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

FTP to Zip takes browser based FTP backup of WordPress plus other folders. Proper error messages are shown if there is any defect in the installation.

== Description ==

FTP to Zip takes browser based FTP backup of WordPress plus other folders. Basically it uses PHP ZipArchive class ZipArchive(); which can not be used without shell access directly. 

This Plugin is intended for the advanced users - either block the downloadable zip file via .htaccess or take an alternative measure. The Plugin is fail proof and is powerful, but usage must be judicial.

The first script checks and shows up your WordPress Installation root. Depending upon the size of your FTP content, it can taken few minutes to few hours to complete the process and will create a zip file on the root where the script is made to run. On the next screen, you will get the option to download it to your computer as well.

FTP to Zip works nicely on Rackspace Cloud Sites, it should work on any LAMP server (Server component are – Linux Apache PHP MySQL) with good hardware backend.

= Advanced Usages =

'backup.php' is the important file. I have added comments for easy understanding. The important points are given here for reference :

= Specific Functions =
 
For the file 'backup.php' :

Line 23 : $sourcefolder is set to root. You can change it yourself.
Line 25 : $timeout is the maximum php execution timeout. It sets ini_set(‘max_execution_time’, $timeout); on Line 34.
Line 24 : $zipfilename is the name of the backup zip as output. You can change it as you like. Calling another php function will give pretty name increasing the load (its quite logical).
Line 38 : $zip = new ZipArchive(); is the main action we are doing with FTP to Zip.
Line 71 to Line 88 : The PHP functions are wrapped inside h1 to show the page title as per the situation.

Here is detailed guide on **[Official WebPage of FTP To Zip](http://thecustomizewindows.com/ftp-to-zip/)** , Simplify the Backup of FTP Content.

== Installation ==

This is a stable backup script, I have not added WordPress Plugin integration yet, its simple but powerful for work with :


1. Download the plugin.
2. Unzip it on desktop and upload two files of the folder 'backup.php' and 'run.php' to the WordPress Installation root or any directory.
3. There is nothing to activate. Point towards 'http://example.com/run.php'
4. Simply follow the on screen instruction, it absolutely looks like the default WordPress installation screen. 

== Frequently Asked Questions ==

= No WordPress Installation ? =

This is the first version of the Plugin. Definitely there will be lot of features like premium plugins.

= I heard that these Backup Plugins are mostly paid software ? =

Yes they are. But as you can see, this is a fully free plugin, aditionally many features will be added like uploading to Rackspace Cloud Files with cURL, Amazon S3, auto upload to almost all Free Cloud Storages.

= What is the major difference between this WordPress FTP Full Backup Plugin and Others ? =

This Plugin uses the PHP memory from outside WordPress. This is important for servers with low config. In future, there will be API based integration with WordPress Admin panel, but unlike other plugins it will never put stress on the working WordPress installation.

= What is the recomanded settings for .htaccess ? =

Set your PHP memory limit beyond 512 MB for smooth function. Simply add this line at the begining of your .htaccess file of the root :

php_value memory_limit 1024M

Ask your web host, the limit on PHP. If you can set PHP memory to higher yourself, doing alone will suffice.

= Do I need to Donate ? =

Thanks. Not needed. 

== Screenshots ==

1. GUI matches with WordPress


Simply Click Backup Now button and wait.

== Changelog ==

= 1.9 =

* Pre-PHP7.0 checking done.

= 1.8 =

* Security Warning Added.

= 1.6 =

* Description and Help Resources Added.

= 1.5 =

* PHP ZipArchive class will not affect running Cron.

= 1.0 =

* First version released.

== Other Notes ==

Your Feedback is valuable. This plugin will work even if you have lost access to login to WordPress or it is unsafe to login (in case your site is under attack). 

At any issues, please check the plugin's official support page at : 

**[FTP To Zip](http://thecustomizewindows.com/ftp-to-zip/)** official webpage.

Screen Shot Guided Tutorial : 

**[How to use FTP To Zip](http://thecustomizewindows.com/2012/07/wordpress-ftp-full-backup-backup-ftp-to-zip-file/)**
Support is free as well. Simplify Backup of FTP Content. FTP to Zip is available in GitHub and Google Projects as WordPress FTP Full Backup, if you are a developer and want it for usage for other CMS or want to add features, simply download and proceed.
