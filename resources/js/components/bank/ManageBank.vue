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
						<h4 class="card-title m-0 pt-2">Manage Bank</h4>
						<button v-if="canAdd" @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage unitType page</p> -->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="">
										<th>Sl</th>
										<th>Bank Name</th>
										<th>Account Name</th>
										<th>Account Number</th>
										<th>Branch Name</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(account, index) in allAccounts.data" :key="index">
										<td>{{ account.id }}</td>
										<td>{{ account.bank_name }}</td>
										<td>{{ account.account_name }}</td>
										<td>{{ account.account_number }}</td>
										<td>{{ account.branch_name }}</td>
										<td>{{ account.status ? "Active" : "Inactive" }}</td>
										<td class="td-actions">
											<!-- <button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button> -->
											<button
												v-if="canEdit"
												type="button"
												class="btn btn-success"
												@click="
													editAccount(account);
													updateModal = true;
												"
											>
												<i class="material-icons">edit</i>
											</button>
											<button
												v-if="canDelete"
												type="button"
												class="btn btn-danger"
												@click="deleteAccount(account.id)"
											>
												<i class="material-icons">close</i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<pagination
							align="right"
							:limit="2"
							:data="allAccounts"
							@pagination-change-page="getAccounts"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Accounts model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-dialog-scrollable modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Add Bank</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="saveAccount" class="m-0">
								<div class="form-group">
									<label for="bank_name">Bank Name</label>
									<input
										type="text"
										class="form-control"
										id="bank_name"
										v-model="form.bank_name"
									/>
									<HasError :form="form" field="bank_name" />
								</div>
								<div class="form-group">
									<label for="account_name">Account Name</label>
									<input
										type="text"
										class="form-control"
										id="account_name"
										v-model="form.account_name"
									/>
									<HasError :form="form" field="account_name" />
								</div>
								<div class="form-group">
									<label for="account_number">Account Number</label>
									<input
										type="text"
										class="form-control"
										id="account_umbere"
										v-model="form.account_number"
									/>
									<HasError :form="form" field="account_number" />
								</div>
								<div class="form-group">
									<label for="branch_name">Branch Name</label>
									<input
										type="text"
										class="form-control"
										id="branch_name"
										v-model="form.branch_name"
									/>
									<HasError :form="form" field="branch_name" />
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
										Save Account
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit Accounts model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-dialog-scrollable modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Update Bank</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateAccount" class="m-0">
								<div class="form-group">
									<label for="bank_name">Bank Name</label>
									<input
										type="text"
										class="form-control"
										id="bank_name"
										v-model="form.bank_name"
									/>
									<HasError :form="form" field="bank_name" />
								</div>
								<div class="form-group">
									<label for="account_name">Account Name</label>
									<input
										type="text"
										class="form-control"
										id="account_name"
										v-model="form.account_name"
									/>
									<HasError :form="form" field="account_name" />
								</div>
								<div class="form-group">
									<label for="account_number">Account Number</label>
									<input
										type="text"
										class="form-control"
										id="account_umbere"
										v-model="form.account_number"
									/>
									<HasError :form="form" field="account_number" />
								</div>
								<div class="form-group">
									<label for="branch_name">Branch Name</label>
									<input
										type="text"
										class="form-control"
										id="branch_name"
										v-model="form.branch_name"
									/>
									<HasError :form="form" field="branch_name" />
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
	name: "PaymentType",
	data: () => ({
		form: new Form({
			id: "",
			bank_name: "",
			account_name: "",
			account_number: "",
			branch_name: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allAccounts: {},
		canAdd: false,
		canEdit: false,
		canDelete: false
	}),
	mounted() {
		this.getAccounts();
		this.rolePermission();
	},
	methods: {
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "bank-account.create") {
						this.canAdd = true;
					} else if (element.name == "bank-account.edit") {
						this.canEdit = true;
					} else if (element.name == "bank-account.delete") {
						this.canDelete = true;
					}
				});
			});
		},
		getAccounts(page = 1) {
			axios.get("All-Bank-Account?page=" + page).then(response => {
				this.allAccounts = response.data;
			});
		},
		saveAccount() {
			this.form.post("Bank-Account").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getAccounts(this.allAccounts.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteAccount(id) {
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
					axios.delete("Bank-Account/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getAccounts(this.allAccounts.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editAccount(data) {
			this.form.id = data.id;
			this.form.bank_name = data.bank_name;
			this.form.account_name = data.account_name;
			this.form.account_number = data.account_number;
			this.form.branch_name = data.branch_name;
			this.form.status = data.status;
		},
		updateAccount() {
			this.form.put("Bank-Account/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getAccounts(this.allAccounts.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.bank_name = ""), (this.form.account_name = "");
			this.form.account_number = "";
			this.form.branch_name = "";
			this.form.status = "";
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
</style>
