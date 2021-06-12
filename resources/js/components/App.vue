<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Name</th>
							<th>Job Position</th>
							<th>Since</th>
							<th class="text-right">Salary</th>
							<th class="text-right">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">1</td>
							<td>Andrew Mike</td>
							<td>Develop</td>
							<td>2013</td>
							<td class="text-right">&euro; 99,225</td>
							<td class="td-actions text-right">
								<button type="button" rel="tooltip" class="btn btn-info">
									<i class="material-icons">person</i>
								</button>
								<button type="button" rel="tooltip" class="btn btn-success">
									<i class="material-icons">edit</i>
								</button>
								<button type="button" rel="tooltip" class="btn btn-danger">
									<i class="material-icons">close</i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	mounted() {
		console.log("Component mounted.");
	}
};
</script>
