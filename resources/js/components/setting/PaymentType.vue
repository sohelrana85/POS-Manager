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
						<h4 class="card-title m-0 p-2">Manage Payment Type</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="">
										<th>Sl</th>
										<th>Unit Name</th>
										<th>status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(pType, index) in allPaymentType.data" :key="index">
										<td>{{ pType.id }}</td>
										<td>{{ pType.name }}</td>
										<td>{{ pType.status ? "Active" : "Inactive" }}</td>
										<td class="td-actions">
											<!-- <button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button> -->
											<button
												type="button"
												class="btn btn-success"
												@click="
													editPaymentType(pType);
													updateModal = true;
												"
											>
												<i class="material-icons">edit</i>
											</button>
											<button
												type="button"
												class="btn btn-danger"
												@click="deletePaymentType(pType.id)"
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
							:data="allPaymentType"
							@pagination-change-page="getPaymentTypes"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Payment model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Add Payment Type</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="savePaymentType" class="m-0">
								<div class="form-group">
									<label for="name">Payment Type</label>
									<input
										type="text"
										class="form-control"
										id="name"
										v-model="form.name"
									/>
									<HasError :form="form" field="name" />
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

		<!-- Edit Payment Type model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Update Payment Type</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updatePaymentType" class="m-0">
								<div class="form-group">
									<label for="name">Payment Type</label>
									<input
										type="text"
										class="form-control"
										id="name"
										v-model="form.name"
									/>
									<HasError :form="form" field="name" />
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
	name: "PaymentType",
	data: () => ({
		form: new Form({
			id: "",
			name: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allPaymentType: {}
	}),
	mounted() {
		this.getPaymentTypes();
	},
	methods: {
		getPaymentTypes(page = 1) {
			axios.get("pType?page=" + page).then(response => {
				this.allPaymentType = response.data;
			});
		},
		savePaymentType() {
			this.form.post("pType").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getPaymentTypes(this.allPaymentType.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deletePaymentType(id) {
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
					axios.delete("pType/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getPaymentTypes(this.allPaymentType.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editPaymentType(data) {
			this.form.id = data.id;
			this.form.name = data.name;
			this.form.status = data.status;
		},
		updatePaymentType() {
			this.form.put("pType/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getPaymentTypes(this.allPaymentType.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.name = ""), (this.form.status = "");
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
