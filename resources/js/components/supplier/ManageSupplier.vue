<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div
						class="card-header card-header-primary d-flex justify-content-between py-1"
					>
						<h4 class="card-title m-0 pt-2">Manage Supplier</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage supplier page</p> -->
					</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr class="">
									<th class="text-center">#</th>
									<th>Business Name</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>status</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(supplier, index) in allSuppliers.data" :key="index">
									<td class="text-center">{{ supplier.id }}</td>
									<td>{{ supplier.business_name }}</td>
									<td>{{ supplier.name }}</td>
									<td>{{ supplier.phone }}</td>
									<td>{{ supplier.email }}</td>
									<td>{{ supplier.status ? "Active" : "Inactive" }}</td>
									<td class="td-actions text-right">
										<button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button>
										<button
											type="button"
											class="btn btn-success"
											@click="
												editSupplier(supplier);
												updateModal = true;
											"
										>
											<i class="material-icons">edit</i>
										</button>
										<button
											type="button"
											class="btn btn-danger"
											@click="deleteSupplier(supplier.id)"
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
							:data="allSuppliers"
							@pagination-change-page="getSuppliers"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add supplier model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Add Supplier</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="saveSupplier" class="m-0">
								<div class="form-row mb-3">
									<div class="form-group col-md-8">
										<label for="business_name">Business Name</label>
										<input
											type="business_name"
											class="form-control"
											id="business_name"
											v-model="form.business_name"
										/>
										<HasError :form="form" field="business_name" />
									</div>
									<div class="form-group col-md-4">
										<label for="phone">Phone <small>(11 digits)</small></label>
										<input
											type="text"
											class="form-control"
											id="phone"
											v-model="form.phone"
										/>
										<HasError :form="form" field="phone" />
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="form-group col-md-6">
										<label for="s_name">Supplier Name</label>
										<input
											type="text"
											class="form-control"
											id="name"
											v-model="form.s_name"
										/>
										<HasError :form="form" field="s_name" />
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

								<div class="form-group mb-3">
									<label for="address">Address</label>
									<input
										type="text"
										class="form-control"
										id="address"
										v-model="form.address"
									/>
									<HasError :form="form" field="address" />
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
										Save supplier
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit supplier model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Update supplier</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateSupplier" class="m-0">
								<div class="form-row mb-3">
									<div class="form-group col-md-8">
										<label for="business_name">Business Name</label>
										<input
											type="business_name"
											class="form-control"
											id="business_name"
											v-model="form.business_name"
										/>
										<HasError :form="form" field="business_name" />
									</div>
									<div class="form-group col-md-4">
										<label for="phone">Phone <small>(11 digits)</small></label>
										<input
											type="text"
											class="form-control"
											id="phone"
											v-model="form.phone"
										/>
										<HasError :form="form" field="phone" />
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="form-group col-md-6">
										<label for="s_name">Supplier Name</label>
										<input
											type="text"
											class="form-control"
											id="name"
											v-model="form.s_name"
										/>
										<HasError :form="form" field="s_name" />
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

								<div class="form-group mb-3">
									<label for="address">Address</label>
									<input
										type="text"
										class="form-control"
										id="address"
										v-model="form.address"
									/>
									<HasError :form="form" field="address" />
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
	name: "supplier",
	data: () => ({
		form: new Form({
			id: "",
			business_name: "",
			s_name: "",
			email: "",
			phone: "",
			address: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allSuppliers: {}
	}),
	mounted() {
		this.getSuppliers();
	},
	methods: {
		getSuppliers(page = 1) {
			axios.get("Manage-Suppliers?page=" + page).then(response => {
				this.allSuppliers = response.data;
			});
		},
		saveSupplier() {
			this.form.post("Manage-Suppliers").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getSuppliers(this.allSuppliers.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteSupplier(id) {
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
					axios.delete("Manage-Suppliers/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getSuppliers(this.allSuppliers.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editSupplier(supplier) {
			this.form.id = supplier.id;
			this.form.business_name = supplier.business_name;
			this.form.s_name = supplier.name;
			this.form.email = supplier.email;
			this.form.phone = supplier.phone;
			this.form.address = supplier.address;
			this.form.status = supplier.status;
		},
		updateSupplier() {
			this.form.put("Manage-Suppliers/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getSuppliers(this.allSuppliers.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.s_name = ""),
				(this.form.email = ""),
				(this.form.phone = ""),
				(this.form.business_name = ""),
				(this.form.address = ""),
				(this.form.status = "");
		},
		clearError() {
			this.form.errors.errors = "";
		}
	}
};
</script>
