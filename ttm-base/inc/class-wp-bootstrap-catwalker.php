<?php
/**
 * WP Bootstrap Catwalker
 *
 * @package WP-Bootstrap-Catwalker
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/* Check if Class Exists. */
if ( ! class_exists('TTM_WP_Bootstrap_Catwalker'))
{
	/**
	 * WP_Bootstrap_CatWalker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class TTM_WP_Bootstrap_Catwalker extends Walker_Category {

		/**
		 * What the class handles.
		 *
		 * @var string
		 */
		public $tree_type = 'rv_services_cat';

		/**
		 * DB fields to use.
		 *
		 * @var array
		 */
		public $db_fields = [
			'parent' => 'parent',
			'id'     => 'term_id',
			'slug'   => 'slug',
		];

		/**
		 * Starts the list before the elements are added.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of category. Used for tab indentation.
		 * @param array $args Will only append content if style argument value is 'list'.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::start_lvl()
		 */
		public function start_lvl(&$output, $depth = 0, $args = [])
		{
			$t = "\t";
			$n = "\n";

			$indent = str_repeat($t, $depth);
			// Default class to add to the file.
			$classes     = ['dropdown-menu'];
			$class_names = ' class="' . esc_attr(implode(' ', $classes)) . '"';

			/**
			 * The `.dropdown-menu` container needs to have a labelledby
			 * attribute which points to it's trigger link.
			 *
			 * Form a string for the labelledby attribute from the the latest
			 * link with an id that was added to the $output.
			 */
			$labelledby = '';
			// find all links with an id in the output.
			preg_match_all('/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches);
			// with pointer at end of array check if we got an ID match.
			if (end($matches[2]))
			{
				// build a string to use as aria-labelledby.
				$labelledby = 'aria-labelledby="' . end($matches[2]) . '"';
			}
			$output .= "{$n}{$indent}<ul$class_names $labelledby role=\"menu\">{$n}";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of category. Used for tab indentation.
		 * @param array $args Will only append content if style argument value is 'list'.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::end_lvl()
		 */
		public function end_lvl(&$output, $depth = 0, $args = [])
		{
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}

		/**
		 * Start the element output.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $cat Category.
		 * @param int $depth Depth of category in reference to parents.
		 * @param array $args Arguments.
		 * @param integer $current_object_id Current object ID.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::start_el()
		 */
		public function start_el(&$output, $cat, $depth = 0, $args = [], $current_object_id = 0)
		{
			$cat_id = (int)$cat->term_id;
			$t      = "\t";
			$n      = "\n";
			$indent = ($depth) ? str_repeat($t, $depth) : '';

			$classes = [];

			// Add .dropdown or .active classes where they are needed.
			if (isset($args['has_children']) && $args['has_children'])
			{
				$classes[] = 'dropdown';
			}
			if ($args['current_category_ancestors'] && $args['current_category'] && in_array($cat_id, $args['current_category_ancestors'], TRUE))
			{
				$classes[] = 'active';
			}

			// Add some additional default classes to the item.
			$classes[] = 'menu-item-' . $cat_id;
			$classes[] = 'nav-item';

			// Form a string of classes in format: class="class_names".
			$class_names = join(' ', $classes);
			$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

			$id = ' id="' . esc_attr('menu-item-' . $cat_id) . '"';

			$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';

			// initialize array for holding the $atts for the link item.
			$atts = [];

			$atts['title'] = strip_tags($cat->name);
			$atts['href']  = get_term_link($cat_id, $args['taxonomy']);
			// If item has_children add atts to <a>.
			if (isset($args['has_children']) && $args['has_children'])
			{
				$icon          = '<i class="d-md-none fa fa-caret-down dropdown-toggle" data-toggle="dropdown" id="menu-item-dropdown-' . $cat_id . '"></i>';
				$atts['aria-haspopup'] = 'true';
				$atts['aria-expanded'] = 'false';
				$atts['class']         = 'nav-link';
			} else
			{
				// Items in dropdowns use .dropdown-item instead of .nav-link.
				if ($depth > 0)
				{
					$atts['class'] = 'dropdown-item';
				} else
				{
					$atts['class'] = 'nav-link';
				}
			}

			// Build a string of html containing all the atts for the item.
			$attributes = '';
			foreach ($atts as $attr => $value)
			{
				if ( ! empty($value))
				{
					$value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$output .= '<a' . $attributes . '><span>' . $cat->name . '</span></a>' . $icon;

		}

		public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
			global $wp_query;
			global $post;
			$thePostID = $post->ID;

			$posts = new WP_Query([
				'post_type' => 'rv_services',
				'tax_query' => [
					'taxonomy' => 'rv_services_cat',
					'term_id' =>  $cat->object_id
				]
			]);

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					the_post();
					$classes = [];
					if ($args['current_category_ancestors'] && $args['current_category'] && in_array($cat_id, $args['current_category_ancestors'], TRUE))
					{
						$classes[] = 'active';
					}

					// Add some additional default classes to the item.
					$classes[] = 'menu-item-' . $cat_id;
					$classes[] = 'nav-item';

					// Form a string of classes in format: class="class_names".
					$class_names = join(' ', $classes);
					$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

					$id = ' id="' . esc_attr('menu-item-' . $cat_id) . '"';

					$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';

					// initialize array for holding the $atts for the link item.
					$atts = [];

					$atts['title'] = strip_tags($cat->name);
					$atts['href']  = get_term_link($cat_id, $args['taxonomy']);
					// If item has_children add atts to <a>.
					if (isset($args['has_children']) && $args['has_children'])
					{
						$icon          = '<i class="d-md-none fa fa-caret-down dropdown-toggle" data-toggle="dropdown" id="menu-item-dropdown-' . $cat_id . '"></i>';
						$atts['aria-haspopup'] = 'true';
						$atts['aria-expanded'] = 'false';
						$atts['class']         = 'nav-link';
					} else
					{
						// Items in dropdowns use .dropdown-item instead of .nav-link.
						if ($depth > 0)
						{
							$atts['class'] = 'dropdown-item';
						} else
						{
							$atts['class'] = 'nav-link';
						}
					}

					// Build a string of html containing all the atts for the item.
					$attributes = '';
					foreach ($atts as $attr => $value)
					{
						if ( ! empty($value))
						{
							$value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
							$attributes .= ' ' . $attr . '="' . $value . '"';
						}
					}

					$output .= '<a' . $attributes . '><span>' . $cat->name . '</span></a>' . $icon;
				}
			}
			wp_reset_postdata();
			$output .= '</ul>';
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth. It is possible to set the
		 * max depth to include all depths, see walk() method.
		 *
		 * This method should not be called directly, use the walk() method instead.
		 *
		 * @param object $element Data object.
		 * @param array $children_elements List of elements to continue traversing (passed by reference).
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args An array of arguments.
		 * @param string $output Used to append additional content (passed by reference).
		 *
		 * @since WP 2.5.0
		 *
		 * @see Walker::start_lvl()
		 *
		 */
		public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
		{
			if ( ! $element)
			{
				return;
			}
			$id_field = $this->db_fields['id'];
			// Display this element.
			if (is_object($args[0]))
			{
				$args[0]->has_children = ! empty($children_elements[$element->$id_field]);
			}
			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}
