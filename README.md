# php-ajax-pagination

##By Ajax
```
// at the top of the index:

include 'functions.php';
$data = [
	'1','2','3','4','5','6','7','8','9','10',
	'11','12','13','14','15','16','17','18','19','20',
	'21','22','23','24','25','26','27','28','29','30',
	'31','32','33','34','35','36','37','38','39','40',
	'41','42','43','44','45','46','47','48','49','50',
	'51','52','53','54','55','56','57','58','59','60',
	'61','62','63','64','65','66','67','68','69','70',
	'81','82','83','84','85','86','87','88','89','90',
	'91','92','93','94','95','96','97','98','99','100',
	'101','102','103','104','105','106','107','108','109','110',
];

$row_counts = count( $data );
$items_per_page = 10;


#--------------------------------------------------------


// In the script tag at the bottom of page
pagination(1);
function pagination(page){
	let url = "functions.php";
	let data = {
		data: '<?= serialize($data) ?>',
		row_counts: '<?= $row_counts ?>',
		items_per_page: '<?= $items_per_page ?>',
		current_page: page,
	};
	$.post(url, data, function(result){
		$(".pagination_result").html("");

		$.each(result['result'], function(index, value){
			$(".pagination_result").append("<span style=''>"+value+"</span><br>");
		});
		$(".pagination_links").html(result['links']);
	}, "json");
}

$(document).on('click', '.pagination_link', function(){
	let page = $(this).attr('id');
	pagination(page);
});
```

### Made By
[Reza Mohebbi1999](https://github.com/rezamohebbi/).