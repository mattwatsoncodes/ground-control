<?php
/**
 * Example
 *
 * If you wish to override this file, you can do so by
 *
 * @package mkdo\ground_control
 */

/**
 * Variables
 *
 * The following variables can be used in this view.
 * $quote     = '';
 * $attribute = '';
 *
 * If we need to define others we can do it here too.
 */

/**
 * Output
 *
 * Here is the HTML output, this can be styled however.
 * Do not alter this file, instead duplicate it into your theme.
 */
?>

<blockquote>
	<p><?php echo esc_html( $quote );?></p>
	<footer>&mdash; <?php echo esc_html( $attribute );?></footer>
</blockquote>
