<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div
						class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						"
					>
						<h4 class="card-title m-0 pt-2">Manage Type</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage unitType page</p> -->
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="">
									<th>Sl</th>
									<th>Type Name</th>
									<th>status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(expenseType, index) in allExpenseType.data" :key="index">
									<td>{{ expenseType.id }}</td>
									<td>{{ expenseType.expense_type }}</td>
									<td>{{ expenseType.status ? "Active" : "Inactive" }}</td>
									<td class="td-actions">
										<!-- <button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button> -->
										<button
											type="button"
											class="btn btn-success"
											@click="
												editExpenseType(expenseType);
												updateModal = true;
											"
										>
											<i class="material-icons">edit</i>
										</button>
										<button
											type="button"
											class="btn btn-danger"
											@click="deleteExpenseType(expenseType.id)"
										>
											<i class="material-icons">close</i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
						<pagination
							align="right"
							:limit="2"
							:data="allExpenseType"
							@pagination-change-page="getExpenseTypes"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Type model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Add Expense Type</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="addExpenseType" class="m-0">
								<div class="form-group">
									<label for="expense_name">Expense Type</label>
									<input
										type="text"
										class="form-control"
										id="expense_name"
										v-model="form.expense_name"
									/>
									<HasError :form="form" field="expense_name" />
								</div>

								<div class="form-group">
									<label>Status</label>
									<div class="form-row mb-3">
										<div class="form-check-inline">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="status"
													value="1"
													v-model="form.status"
												/>Active
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="status"
													value="0"
													v-model="form.status"
												/>Inactive
											</label>
										</div>
									</div>
									<HasError :form="form" field="status" />
								</div>
								<div class="modal-footer pb-0">
									<button
										@click="
											addModal = false;
											clearError();
										"
										class="btn btn-secondary"
									>
										Close
									</button>
									<button type="submit" class="btn btn-info" :disabled="form.busy">
										Save Type
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit Type model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Update Expense Type</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateExpenseType" class="m-0">
								<div class="form-group">
									<label for="expense_name">Expense Type</label>
									<input
										type="text"
										class="form-control"
										id="expense_name"
										v-model="form.expense_name"
									/>
									<HasError :form="form" field="expense_name" />
								</div>
								<div class="form-group">
									<label>Status</label>
									<div class="form-row mb-3">
										<div class="form-check-inline">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="status"
													value="1"
													v-model="form.status"
												/>Active
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input
													type="radio"
													class="form-check-input"
													name="status"
													value="0"
													v-model="form.status"
												/>Inactive
											</label>
										</div>
									</div>
									<HasError :form="form" field="status" />
								</div>
								<div class="modal-footer pb-0">
									<button
										@click="
											updateModal = false;
											clearForm();
											clearError();
										"
										class="btn btn-secondary"
									>
										Close
									</button>
									<button type="submit" class="btn btn-info" :disabled="form.busy">
										Update Change
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "ManageType",
	data: () => ({
		form: new Form({
			id: "",
			expense_name: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allExpenseType: {}
	}),
	mounted() {
		this.getExpenseTypes();
	},
	methods: {
		getExpenseTypes(page = 1) {
			axios.get("Type?page=" + page).then(response => {
				this.allExpenseType = response.data;
			});
		},
		addExpenseType() {
			this.form.post("Type").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getExpenseTypes(this.allExpenseType.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteExpenseType(id) {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
			}).then(result => {
				if (result.value == true) {
					axios.delete("Type/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getExpenseTypes(this.allExpenseType.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editExpenseType(expenseType) {
			this.form.id = expenseType.id;
			this.form.expense_name = expenseType.expense_type;
			this.form.status = expenseType.status;
		},
		updateExpenseType() {
			this.form.put("Type/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getExpenseTypes(this.allExpenseType.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.expense_name = ""), (this.form.status = "");
		},
		clearError() {
			this.form.errors.errors = "";
		}
	}
};
</script>
<style scoped>
thead tr th {
	padding: 5px;
}
tbody tr td {
	padding: 3px;
}
table {
	text-align: center;
	font-weight: normal;
}
thead {
	background: #0088ff;
	color: white;
	/* font-weight: 600; */
}
input {
	padding-left: 4px;
}
</style>
