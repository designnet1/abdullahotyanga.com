<?php
/**
 * Template for displaying header of single course popup.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/header.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();

$user   = learn_press_get_current_user();
$course = LP_Global::course();

if ( ! $course || ! $user ) {
	return;
}

$course_data    = $user->get_course_data( $course->get_id() );
$course_results = $course_data->get_results( false );
$percentage     = $course_results['count_items'] ? absint( $course_results['completed_items'] / $course_results['count_items'] * 100 ) : 0;

?>

<div id="popup-header">
	<div class="popup-header__inner">
		<?php if ( $user->has_enrolled_course( $course->get_id() ) ) : ?>
			<div class="items-progress">
				<span
					class="number"><?php printf( __( '%1$s of %2$d items', 'learnpress' ), '<span class="items-completed">' . $course_results['completed_items'] . '</span>', $course->count_items( '', true ) ); ?></span>
				<div class="learn-press-progress">
					<div class="learn-press-progress__active" data-value="<?php echo $percentage; ?>%;">
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="thim-course-item-popup-right">
			<input type="checkbox" id="sidebar-toggle" class="toggle-content-item"/>
			<a href="<?php echo $course->get_permalink(); ?>" class="back_course"><i class="fa fa-close"></i></a>
		</div>
	</div>
 </div>
