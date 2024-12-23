<h4>Thống kê</h4>

<div class="row justify-content-center">
	
	

	<div class="m-1 col-md-4 bg-light rounded shadow border text-center">
		<h1><i class="bi bi-file-post"></i></h1>
		<div>
			Bài Viết
		</div>
		<?php 
			$id = $_SESSION['USER']['id'];
			$query = "select count(id) as num from posts where user_id = $id";
			$res = query_row($query);
		?>
		<h1 class="text-primary"><?=$res['num'] ?? 0?></h1>
	</div>

</div>