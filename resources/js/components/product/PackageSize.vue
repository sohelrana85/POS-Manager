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
						<h4 class="card-title m-0 pt-2">Manage Package Size</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="">
									<th>Sl</th>
									<th>Unit Name</th>
									<th>Package Name</th>
									<th>status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(packageSize, index) in allPackageSize.data" :key="index">
									<td>{{ packageSize.id }}</td>
									<td>{{ packageSize.unit_types.name }}</td>
									<td>{{ packageSize.name }}</td>
									<td>{{ packageSize.status ? "Active" : "Inactive" }}</td>
									<td class="td-actions">
										<!-- <button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button> -->
										<button
											type="button"
											class="btn btn-success"
											@click="
												editPackageSize(packageSize);
												updateModal = true;
											"
										>
											<i class="material-icons">edit</i>
										</button>
										<button
											type="button"
											class="btn btn-danger"
											@click="deletePackageSize(packageSize.id)"
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
							:data="allPackageSize"
							@pagination-change-page="getPackageSizes"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add packageSize model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Add Package Size</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="savePackageSize" class="m-0">
								<div class="form-group mb-3">
									<label for="name">Select Unit Type</label>
									<select name="unit_type" class="form-control" v-model="form.unit_type">
										<option value="">Select Unit Type</option>
										<option
											v-for="(item, index) in unitTypes"
											:key="index"
											:value="item.id"
										>
											{{ item.name }}
										</option>
									</select>
									<HasError :form="form" field="unit_type" />
								</div>
								<div class="form-group">
									<label for="name">Package Name</label>
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
										Save packageSize
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit packageSize model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Update Package Size</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updatePackageSize" class="m-0">
								<div class="form-group mb-3">
									<label for="name">Select Unit Type</label>
									<select name="unit_type" class="form-control" v-model="form.unit_type">
										<option value="">Select Unit Type</option>
										<option
											v-for="(item, index) in unitTypes"
											:key="index"
											:value="item.id"
										>
											{{ item.name }}
										</option>
									</select>
									<HasError :form="form" field="unit_type" />
								</div>
								<div class="form-group">
									<label for="name">Package Name</label>
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
	name: "packageSize",
	data: () => ({
		form: new Form({
			id: "",
			unit_type: "",
			name: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allPackageSize: {},
		unitTypes: []
	}),
	mounted() {
		this.loadUnitTypes();
		this.getPackageSizes();
	},
	methods: {
		getPackageSizes(page = 1) {
			axios.get("Package-Sizes?page=" + page).then(response => {
				this.allPackageSize = response.data;
			});
		},
		savePackageSize() {
			this.form.post("Package-Sizes").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getPackageSizes(this.allPackageSize.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deletePackageSize(id) {
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
					axios.delete("Package-Sizes/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getPackageSizes(this.allPackageSize.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editPackageSize(packageSize) {
			this.form.id = packageSize.id;
			this.form.name = packageSize.name;
			this.form.unit_type = packageSize.unit_id;
			this.form.status = packageSize.status;
		},
		updatePackageSize() {
			this.form.put("Package-Sizes/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getPackageSizes(this.allPackageSize.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		clearForm() {
			(this.form.name = ""), (this.form.unit_type = ""), (this.form.status = "");
		},
		clearError() {
			this.form.errors.errors = "";
		},
		loadUnitTypes() {
			axios.get("/getUnitType").then(result => {
				this.unitTypes = result.data.unit_type;
			});
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
