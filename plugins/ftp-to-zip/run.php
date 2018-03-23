<?php

/*  Copyright 2013  Dr.Abhishek Ghosh  (email : admin@thecustomizewindows.com)

    This program is free software for WordPress; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="FTP to Zip gives the oppertunity to take backup of FTP directory." />
	<title>WordPress FTP Full Backup</title>
	<link rel="Shortcut Icon" href="./favicon.ico" type="image/x-icon" />
		<meta name="DC.publisher" content="FTP to Zip" />
		<meta name="DC.publisher.url" content="https://thecustomizewindows.com/" />
		<meta name="DC.title" content="FTP to Zip" />
		<meta name="DC.identifier" content="https://thecustomizewindows.com/ftp-to-zip/" />
		<meta name="DC.date.created" scheme="WTN8601" content="2012-07-28T15:32:46" />
		<meta name="DC.created" scheme="WTN8601" content="2012-07-28T15:32:46" />
		<meta name="DC.date" scheme="WTN8601" content="2012-07-28T15:32:46" />
		<meta name="DC.creator.name" content="Ghosh, Abhishek" />
		<meta name="DC.creator" content="Ghosh, Abhishek" />
		<meta name="DC.rights.rightsHolder" content="Abhishek" />		
		<meta name="DC.language" content="en-US" scheme="rfc1766" />
		<meta name="DC.subject" content="FTP to Zip" />
		<meta name="DC.rights.license" content="http://www.gnu.org/licenses/gpl-2.0.txt" />
		<meta name="DC.license" content="http://www.gnu.org/licenses/old-licenses/gpl-2.0-standalone.html" />
	<style>
		html{background:#f7f7f7;}body{color:#333;font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;}#body{background:#fff;margin:2em auto 0 auto;width:700px;padding:1em 2em;-moz-border-radius:11px;-khtml-border-radius:11px;-webkit-border-radius:11px;border-radius:11px;border:1px solid #dfdfdf;}a{color:#2583ad;text-decoration:none;}a:hover{color:#d54e21;}h1{clear:both;color:#666;font:24px Georgia,"Times New Roman",Times,serif;margin:5px 0 0 -4px;padding:0;padding-bottom:7px;}h2{font-size:16px;}p,li{padding-bottom:2px;font-size:12px;line-height:18px;}code{font-size:13px;}ul,ol{padding:5px 5px 5px 22px;}#logo{margin:6px 0 14px 0;border-bottom:none;}.step{margin:20px 0 15px;}.step,th{text-align:left;padding:0;}.submit input,.button,.button-secondary{font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;text-decoration:none;font-size:14px!important;line-height:16px;padding:6px 12px;cursor:pointer;border:1px solid #bbb;color:#464646;-moz-border-radius:15px;-khtml-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;-khtml-box-sizing:content-box;box-sizing:content-box;}.button:hover,.button-secondary:hover,.submit input:hover{color:#000;border-color:#666;}.button,.submit input,.button-secondary{background-color:#f2f2f2;}.button:active,.submit input:active,.button-secondary:active{background-color:#eee;}.form-table{border-collapse:collapse;margin-top:1em;width:100%;}.form-table td{margin-bottom:9px;padding:10px;border-bottom:8px solid #fff;font-size:12px;}.form-table th{font-size:13px;text-align:left;padding:16px 10px 10px 10px;border-bottom:8px solid #fff;width:110px;vertical-align:top;}.form-table tr{background:#f3f3f3;}.form-table code{line-height:18px;font-size:18px;}.form-table p{margin:4px 0 0 0;font-size:11px;}.form-table input{line-height:20px;font-size:15px;padding:2px;}#error-page{margin-top:50px;}#error-page p{font-size:12px;line-height:18px;margin:25px 0 20px;}#error-page code{font-family:Consolas,Monaco,Courier,monospace;}label{color:#666;font-weight:bold;display:block;margin-bottom:3px;}span{font-size:11px;color:#999;}.message{background-color:#fff;padding:10px 20px;-moz-border-radius:7px;-khtml-border-radius:7px;-webkit-border-radius:7px;border-radius:7px;}.message.success {background-color:#cfc;color:green;}.message.error{background-color:#fcc;border:0;color:red;}#footer{width:700px;margin:10px auto 0;font-size:11px;text-align:center;color:#ccc;}
	</style>

</head>
<body>

	<div id="body">

	<h1>FTP to Zip</h1>

	<?php if ($_REQUEST AND !empty($status)): ?>

		<p class="message<?php echo $status['error'] ? ' error' : ' success' ; ?>"><?php echo $status['message']; ?></p>
		<?php if (!$status['error']): ?><p><br/><a class="button" href="<?php echo !empty($wordpress_folder) ? $wordpress_folder : '' ; ?>index.php">Continue to configure WordPress...</a></p><?php endif; ?>

	<?php endif; ?>

	<?php if (empty($status) OR $status['error']): 


// Above checks the WordPress installation and shows appropiate error messages

?>
 

	<p>Lets get started, and hopefully save you a little bit of time!</p>

	<form method="post" action="./backup.php">

		<p><label>This should match with your WordPress Installation path :</label><br/>

		<input style="width:99%" type="text" name="url" value="<?php echo $_SERVER['SERVER_NAME'];?>"/><br/>
		<span>Copy and paste a valid WordPress Server Installation path if it does not matches.</span></p>

		<p>If WordPress Server Installation path if it does not match, browse for the location you want from (S)FTP software and copy the link location by right-clicking (<em>or control-clicking</em>) the <code>path</code> and paste it above.</p>
		<p>By clicking the <code>Backup Now!</code> button below, the backup process will start. It is server intense process and we suggest to turn off all WordPress Cache Plugins and before turning them off <code>clear</code> the cache.</p>
		<p>It will take backup of full root directory where this script is placed.</p>

		<p class="submit"><input type="submit" name="submit" value="Backup Now!"/></p>

	</form>

	<?php endif; ?>

	</div>
<div id="footer"><a href="https://thecustomizewindows.com">The Customize Windows</a> | <a href="https://thecustomizewindows.com/2012/07/wordpress-ftp-full-backup-backup-ftp-to-zip-file/">Guide for FTP to Zip</a></div>

</body>
</html>
