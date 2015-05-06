<?php
namespace Avantime\Social\Services;

class Facebook
{
	public static $singletonRef = NULL;

	public static function getInstance()
	{
	    if (self::$singletonRef == NULL) {
	        self::$singletonRef = new Facebook();
	    }
	    return self::$singletonRef;
	}

	public function InsertFacebookSDK()
	{
		$output = "<div id=\"fb-root\"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = '//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.3';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>";

		echo $output;
	}

	public function InsertFacebookBoxWithSettings($account = 'avantimegroup', $width = 300, $height = 525, $hideCover = 'false', $showFaces = 'false', $showPosts = 'true')
	{
		$output = "<div class=\"fb-page\"
					data-href=\"https://www.facebook.com/{$account}\"
					data-width=\"{$width}\"
					data-height=\"{$height}\"
					data-hide-cover=\"{$hideCover}\"
					data-show-facepile=\"{$showFaces}\"
					data-show-posts=\"{$showPosts}\">
					<div class=\"fb-xfbml-parse-ignore\">
					<blockquote cite=\"https://www.facebook.com/{$account}\">
					<a href=\"https://www.facebook.com/{$account}\">{$account}</a>
					</blockquote>
					</div>
					</div>";

		return $output;
	}
}