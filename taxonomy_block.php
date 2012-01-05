<?php
/**
 * Show a a list of a palin taxonomy term with the count.
 * It will not work for hierarchal taxonomy
 */

    $vid = 4; //vocabulary id
    $num_term = 20; //limit maximum terms
    $parent = 0;
    $max_depth = NULL;

    /**
     * Counts the number of nodes assigned to a term.
     * @param integer $tid - term id
     * @return integer $count - number of nodes
     */
    function taxonomy_block_count_nodes_term2($tid) {
        return db_select('taxonomy_index', 'ti')
            ->condition('tid', (int) $tid)
            ->countQuery()
            ->execute()
            ->fetchField();
    }

    $data = taxonomy_get_tree($vid, $parent, $max_depth);
    $terms = array();
    $items = array();

    foreach ($data as $term) {
        $terms[$term->tid] = $term;
        $title = $term->name;
        $title .= t(' (@count)', array('@count' => taxonomy_block_count_nodes_term2($term->tid)));
        $item = l($title, 'taxonomy/term/' . $term->tid);
        $items[] = $item;
      //print taxonomy_block_count_nodes_term2( $term->tid );
    }

    return theme('item_list', array('items' => $items));
?>