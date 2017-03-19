<?php
/**
 * Class Helper
 *
 * @since	0.1.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\ground_control;

// Traits.
require_once 'helpers/trait-convert-hashtags-to-twitter-urls.php';
require_once 'helpers/trait-convert-links-to-link-tags.php';
require_once 'helpers/trait-convert-mentions-to-twitter-urls.php';
require_once 'helpers/trait-create-guid.php';
require_once 'helpers/trait-format-bytes.php';
require_once 'helpers/trait-get-category-tags.php';
require_once 'helpers/trait-get-icons.php';
require_once 'helpers/trait-render-view.php';

/**
 * Helper class containing useful static methods.
 *
 * We are using traits, so that only need to 'use' the traits that are valid in
 * this build.
 */
class Helper {
	use Helper_Convert_Hashtags_To_Twitter_URLs;
	use Helper_Convert_Links_To_Link_Tags;
	use Helper_Mentions_To_Twitter_URLs;
	use Helper_Create_GUID;
	use Helper_Format_Bytes;
	use Helper_Get_Category_tags;
	use Helper_Get_Icons;
	use Helper_Render_View;
}
