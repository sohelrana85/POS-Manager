<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div
						class="card-header card-header-primary d-flex justify-content-between py-1"
					>
						<h4 class="card-title m-0 pt-2">Manage Categories</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage Category page</p> -->
					</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr class="">
									<th class="text-center">#</th>
									<th>Name</th>
									<th>status</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(Category, index) in allCategory.data" :key="index">
									<td class="text-center">{{ Category.id }}</td>
									<td>{{ Category.name }}</td>
									<td>{{ Category.status ? "Active" : "Inactive" }}</td>
									<td class="td-actions text-right">
										<button type="button" class="btn btn-info">
											<i class="material-icons">person</i>
										</button>
										<button
											type="button"
											class="btn btn-success"
											@click="
												editCategory(Category);
												updateModal = true;
											"
										>
											<i class="material-icons">edit</i>
										</button>
										<button
											type="button"
											class="btn btn-danger"
											@click="deleteCategory(Category.id)"
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
							:data="allCategory"
							@pagination-change-page="getCategorys"
						></pagination>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Category model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Add Categories</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="saveCategory" class="m-0">
								<div class="form-group">
									<label for="name">Category Name</label>
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
										Save Category
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit Category model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Update Categories</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateCategory" class="m-0">
								<div class="form-group">
									<label for="name">Category Name</label>
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
	name: "Category",
	data: () => ({
		form: new Form({
			id: "",
			name: "",
			status: ""
		}),
		addModal: false,
		updateModal: false,
		allCategory: {}
	}),
	mounted() {
		this.getCategorys();
	},
	methods: {
		getCategorys(page = 1) {
			axios.get("Categories?page=" + page).then(response => {
				this.allCategory = response.data;
			});
		},
		saveCategory() {
			this.form.post("Categories").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getCategorys(this.allCategory.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteCategory(id) {
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
					axios.delete("Categories/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.getCategorys(this.allCategory.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		},
		editCategory(Category) {
			this.form.id = Category.id;
			this.form.name = Category.name;
			this.form.status = Category.status;
		},
		updateCategory() {
			this.form.put("Categories/" + this.form.id).then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.updateModal = false;
					this.getCategorys(this.allCategory.current_page);
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
