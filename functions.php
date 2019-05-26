<?php

if ( isset($_POST['data']) )
{
	$data = unserialize($_POST['data']);
	$row_counts = $_POST['row_counts'];
	$items_per_page = $_POST['items_per_page'];
	$current_page = $_POST['current_page'];

	echo json_encode( paginatorAjax($data, $row_counts, $items_per_page, $current_page) );
}



// This function will return the (result & links) By PHP or Ajax => Both of them




// By PHP
function paginator($data = [], $row_counts, $items_per_page = 10, $current_page = 1){

	$paginationCtrls = '';

	$last_page = ceil($row_counts/$items_per_page);
	$last_page = ($last_page < 1) ? 1 : $last_page;

	$current_page = preg_replace('/[^0-9]/', '', $current_page);
	if ( $current_page < 1 ) {
		$current_page = 1;
	}elseif ( $current_page > $last_page ) {
		$current_page = $last_page;
	}
	$limit_from = ($current_page - 1) * $items_per_page;
	$limit_to = $items_per_page;

	$result = array_slice($data, $limit_from, $limit_to);

	// Start first if
	if ( $last_page != 1 )
	{
		// Start second if
		if ( $current_page > 1 )
		{
			$previous = $current_page -1;
			$paginationCtrls .= '<a href="'. $_SERVER['PHP_SELF']. '?page='. $previous .'">Previous</a> &nbsp;&nbsp;';

			for($i=$current_page-4; $i < $current_page; $i++){
			
				if( $i > 0 ){
					$paginationCtrls .= '<a href="'. $_SERVER['PHP_SELF'] .'?page=' .$i. '">'.$i.'</a> &nbsp;&nbsp; ';
				}
			}
		} // End second if

		$paginationCtrls .= ''.$current_page. ' &nbsp; ';

		
		for($i=$current_page+1; $i <= $last_page ; $i++){
			$paginationCtrls .= '<a href="'. $_SERVER['PHP_SELF'] .'?page=' .$i. '">'.$i.'</a> &nbsp;&nbsp; ';
			
			if( $i >= $current_page+4 ){
				break;
			}
		}




		if( $current_page != $last_page ){

			$next = $current_page + 1;
			$paginationCtrls .= '&nbsp;&nbsp; <a href="'. $_SERVER['PHP_SELF'] .'?page=' .$next. '">Next</a> &nbsp;&nbsp; ';
		}
	}
	// End first if

	// dd( ['last page => '.$last_page, 'current page => '.$current_page, 'limit => '.$limit_from] );

	return ['result' => $result, 'links' => $paginationCtrls];
}




// By Ajax
function paginatorAjax($data = [], $row_counts, $items_per_page = 10, $current_page = 1){

	$paginationCtrls = '';

	$last_page = ceil($row_counts/$items_per_page);
	$last_page = ($last_page < 1) ? 1 : $last_page;

	$current_page = preg_replace('/[^0-9]/', '', $current_page);
	if ( $current_page < 1 ) {
		$current_page = 1;
	}elseif ( $current_page > $last_page ) {
		$current_page = $last_page;
	}
	$limit_from = ($current_page - 1) * $items_per_page;
	$limit_to = $items_per_page;

	$result = array_slice($data, $limit_from, $limit_to);

	// Start first if
	if ( $last_page != 1 )
	{
		// Start second if
		if ( $current_page > 1 )
		{
			$previous = $current_page -1;
			$paginationCtrls .= '<span class="pagination_link" style="cursor: pointer; padding: 6px;border: 1px solid #000;" id="'. $previous .'">Previous</span> &nbsp;&nbsp;';

			for($i=$current_page-4; $i < $current_page; $i++){
			
				if( $i > 0 ){
					$paginationCtrls .= '<span class="pagination_link" style="cursor: pointer; padding: 6px;border: 1px solid #000;" id="'.$i.'">'.$i.'</span> &nbsp;&nbsp; ';
				}
			}
		} // End second if

		$paginationCtrls .= '<span style="text-decoration: underline;color: red;">'.$current_page. '</span> &nbsp; ';
		for($i=$current_page+1; $i <= $last_page ; $i++){
			$paginationCtrls .= '<span class="pagination_link" style="cursor: pointer; padding: 6px;border: 1px solid #000;" id="'.$i.'">'.$i.'</span> &nbsp;&nbsp; ';
			
			if( $i >= $current_page+4 ){
				break;
			}
		}

		if( $current_page != $last_page ){

			$next = $current_page + 1;
			$paginationCtrls .= '&nbsp;&nbsp;
			<span class="pagination_link" style="cursor: pointer; padding: 6px;border: 1px solid #000;" id="'.$next.'">
				Next
			</span> &nbsp;&nbsp; ';
		}


	}
	// End first if

	// dd( ['last page => '.$last_page, 'current page => '.$current_page, 'limit => '.$limit_from] );

	return ['result' => $result, 'links' => $paginationCtrls];
}









function dd($data){

	foreach ($data as $value) {
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	}

}