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
						<h4 class="card-title m-0 pt-2">Manage Customer</h4>
						<button v-if="canAdd" @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage customer page</p> -->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Email</th>
										<th>status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(customer, index) in allcustomers.data" :key="index">
										<td>{{ customer.id }}</td>
										<td>{{ customer.name }}</td>
										<td>{{ customer.phone }}</td>
										<td>{{ customer.email }}</td>
										<td>{{ customer.status ? "Active" : "Inactive" }}</td>
										<td class="td-actions">
											<!-- <button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button> -->
											<button
												v-if="canEdit"
												type="button"
												class="btn btn-success"
												@click="
													editCustomer(customer);
													updateModal = true;
												"
											>
												<i class="material-icons">edit</i>
											</button>
											<button
												v-if="canDelete"
												type="button"
												class="btn btn-danger"
												@click="deleteCustomer(customer.id)"
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
							:data="allcustomers"
							@pagination-change-page="getCustomers"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add customer model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Add Customer</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="saveCustomer" class="m-0">
								<div class="form-row mb-3">
									<div class="form-group col-md-6">
										<label for="name">Name</label>
										<input
											type="text"
											class="form-control"
											id="name"
											v-model="form.name"
										/>
										<HasError :form="form" field="name" />
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input
											type="email"
											class="form-control"
											id="email"
											v-model="form.email"
										/>
										<HasError :form="form" field="email" />
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="phone">Phone <small>(11 digits)</small></label>
										<input
											type="text"
											class="form-control"
											id="phone"
											v-model="form.phone"
										/>
										<HasError :form="form" field="phone" />
									</div>
									<div class="form-group col-md-9">
										<label for="address">Address</label>
										<input
											type="text"
											class="form-control"
											id="address"
											v-model="form.address"
										/>
										<HasError :form="form" field="address" />
									</div>
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
										Save
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit customer model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Update Customer</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateCustomer" class="m-0">
								<div class="form-row mb-3">
									<div class="form-group col-md-6">
										<label for="name">Name</label>
										<input
											type="text"
											class="form-control"
											id="name"
											v-model="form.name"
										/>
										<HasError :form="form" field="name" />
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input
											type="email"
											class="form-control"
											id="email"
											v-model="form.email"
										/>
										<HasError :form="form" field="email" />
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="phone">Phone <small>(11 digits)</small></label>
										<input
											type="text"
											class="form-control"
											id="phone"
											v-model="form.phone"
										/>
										<HasError :form="form" field="phone" />
									</div>
									<div class="form-group col-md-9">
										<label for="address">Address</label>
										<input
											type="text"
											class="form-control"
											id="address"
											v-model="form.address"
										/>
										<HasError :form="form" field="address" />
									</div>
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
										Update
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
	name: "customer",
	data: () => ({
		form: new Form({
			id: "",
			name: "",
			email: "",
			phone: "",
			address: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allcustomers: {},
		canAdd: false,
		canEdit: false,
		canDelete: false
	}),
	mounted() {
		this.getCustomers();
		this.rolePermission();
	},
	methods: {
		getCustomers(page = 1) {
			axios.get("customers?page=" + page).then(response => {
				this.allcustomers = response.data;
			});
		},
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "customer.create") {
						this.canAdd = true;
					} else if (element.name == "customer.edit") {
						this.canEdit = true;
					} else if (element.name == "customer.delete") {
						this.canDelete = true;
					}
				});
			});
		},
		saveCustomer() {
			this.form.post("customers").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getCustomers(this.allcustomers.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteCustomer(id) {
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
					axios.delete("customers/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getCustomers(this.allcustomers.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editCustomer(customer) {
			this.form.id = customer.id;
			this.form.name = customer.name;
			this.form.email = customer.email;
			this.form.phone = customer.phone;
			this.form.address = customer.address;
			this.form.status = customer.status;
		},
		updateCustomer() {
			this.form.put("customers/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getCustomers(this.allcustomers.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.name = ""),
				(this.form.email = ""),
				(this.form.phone = ""),
				(this.form.address = ""),
				(this.form.status = "");
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
