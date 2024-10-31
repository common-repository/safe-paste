=== Safe Paste ===
Contributors: samuelaguilera
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H2KN258J2377Q
Tags: strip tags, html, tinymce, post content, editor, wysiwyg
Requires at least: 4.0
Tested up to: 5.4
Stable tag: 1.1.9
License: GPL2

Removes a lot of HTML tags from post and page content before inserting it to database. Preventing users to paste undesired HTML tags to content.

== Description ==

WordPress do a great job by default filtering potentially dangerous code inside your content. So this plugin is NOT about security.

But people can break your site design without compromising your security... That's the purpose of this little plugin.

Do you have users that creates content for you?. Do you own an online Magazine?

If you answer yes to at least one of the above questions, I'm sure you have minor design troubles in your site because of your users using copy/paste (ofcourse without using TinyMCE buttons to remove code) while not being aware of all the HTML tags they are pasting...

This plugin simply removes a lot of HTML tags (and non breaking space HTML entitie) from post and page content before inserting it to database. Preventing users (including you) to paste undesired HTML tags to the content.

It only does his work while you're editing your post/page (it can be in any status). So it'll do the job on the new post/pages you create after the activation of the plugin and in old content that you edit after the plugin activation.

These are the HTML tags that stays:

&lt;p&gt;
&lt;a&gt; (allowed attributes: href, title).
&lt;img&gt; (allowed attributes: src, alt, class).
&lt;h1&gt;
&lt;h2&gt;
&lt;h3&gt;
&lt;h4&gt;
&lt;h5&gt;
&lt;h6&gt;
&lt;blockquote&gt;
&lt;ol&gt;
&lt;ul&gt;
&lt;li&gt;
&lt;em&gt;
&lt;strong&gt;
&lt;del&gt;
&lt;code&gt;
&lt;ins&gt;

Any other HTML tag (or attributes) and &amp;nbsp; (non breaking space) should be removed.

Users with 'unfiltered_html' WP core capability (by default administrator and editor roles), will be excluded from the filter.

**NOTE: This program is distributed under [GPL2](http://www.gnu.org/licenses/gpl-2.0.html) licence in the hope that it will be useful, but WITHOUT ANY WARRANTY. I'm not responsible of ANY trouble or damage your site may have due to the use of this plugin. YOU and only YOU are responsible of your site and having backups and restoration plans. If you use this plugin you're accepting this.** 

= Features =

* <a href="http://en.wikipedia.org/wiki/KISS_principle">KISS</a> philosofy :)

= Requirements =

* WordPress 4.x or higher.
    	
== Installation ==

* Extract the zip file and just drop the contents in the <code>wp-content/plugins/</code> directory of your WordPress installation (or install it directly from your dashboard) and then activate the plugin from Plugins page.
* Nothing more! No settings page (for the moment), just activate or deactivate it.
  
== Frequently Asked Questions ==

= Will this plugin works in WordPress older than 4.x? =

Maybe... But the question is... WTF are you using anything older than that?

= I would like to customize the allowed tags and protocols =

Starting from Safe Paste 1.1.7 you can use the filters safepaste_allowed_tags and safepaste_allowed_protocols to add a snippet to your theme functions.php file (or <a href="https://codex.wordpress.org/Child_Themes">create a child theme</a>).

The format used to pass the tags and protocols is the same that uses the <a href="https://codex.wordpress.org/Function_Reference/wp_kses">wp_kses() function</a>.

Examples:

`add_filter( 'safepaste_allowed_tags', 'my_custom_tags');

function my_custom_tags( $allowed_tags ) {

//Add <b> to allowed tags
$allowed_tags['b'] = array();

return $allowed_tags;

}

add_filter( 'safepaste_allowed_protocols', 'my_custom_protocols');

function my_custom_protocols( $allowed_protocols ) {

//Add ftp to allowed protocols
$allowed_protocols[] = 'ftp';

return $allowed_protocols;

}`

= I want Safe Paste to take care also of my custom post type =

By default only 'post' and 'page' post types are filterd by Safe Paste. But you can use the safepaste_post_types filter to set modify this.

Example:

`add_filter( 'safepaste_post_types', 'my_custom_post_types');

function my_custom_types( $types_to_filter ) {

//Add book post type
$types_to_filter[] = 'book';

return $types_to_filter

}`

== Changelog ==

= 1.1.9 =

* Improved code syntax to make it 100% compliant with WordPress Coding Standards. This doesn't represent any change in the plugin functionality, it's just cosmetic.

= 1.1.8 =

* Minor code change to get the post ID directly from $postarr
* Some code formatting cleanup

= 1.1.7 =

* Checks for 'unfiltered_html' WP core capability to exclude certain users/roles from the cleanup.
* Added filter safepaste_post_types to set the post types where the cleanup will take place, by default is applied to post and pages.
* Added filter safepaste_allowed_tags to allow customization of the allowed tags.
* Added filter safepaste_allowed_protocols to allow customization of the allowed protocols.
* Added code tag to allowed HTML tags.

= 1.1.2 =

* Replaced function that removes all HTML entities with a previous one that only removes &ampnbsp; (non breaking space) to fix issue reported at http://de.forums.wordpress.org/topic/wordpress-loscht-aus-links-von-aspx-seiten?replies=6#post-403093

= 1.1.1 =

* Changed: Allow 'width' and 'height' for img tag. This allow to resize images in the WP editor.

= 1.1 =

* Changed: Now using WP function wp_kses instead of generic PHP strip_tags. This change also allow to use cforms plugin, that uses HTML comments to insert their forms (a very bad method by the way, should use shortcodes instead).
* Added: Allow only http and https protocols in post/page content.

= 1.0 =

* Initial release.

== Upgrade Notice ==

= 1.1.2 =
Replaced function that removes all HTML entities with a previous one that only removes &ampnbsp; (non breaking space) to fix issue reported at http://de.forums.wordpress.org/topic/wordpress-loscht-aus-links-von-aspx-seiten?replies=6#post-403093

= 1.1.1 =
Changed: Allow 'width' and 'height' for img tag. This allow to resize images in the WP editor.
