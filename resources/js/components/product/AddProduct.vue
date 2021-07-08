<template>
	<div class="card-body mt-3">
		<form @submit.prevent="addProduct">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="product_name">Product Name *</label>
					<input type="text" class="form-control" v-model="form.product_name" />
					<HasError :form="form" field="product_name" />
				</div>
				<div class="form-group col-md-6">
					<label for="product_code">Product Code *</label>
					<input type="text" class="form-control" v-model="form.product_code" />
					<HasError :form="form" field="product_code" />
				</div>
			</div>
			<div class="form-row mt-3">
				<div class="form-group col-md-12">
					<label for="product_desc">Product Description (Optional)</label>
					<input type="text" class="form-control" v-model="form.product_desc" />
					<HasError :form="form" field="product_desc" />
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
					<label for="category">Category *</label>
					<select name="category" class="form-control px-2" v-model="form.category">
						<option value="">Select</option>
						<option
							v-for="category in categories"
							:key="category.id"
							:value="category.id"
						>
							{{ category.name }}
						</option>
					</select>
					<HasError :form="form" field="category" />
				</div>
				<div class="form-group col-md-3">
					<label for="brand">Brand *</label>
					<select name="brand" class="form-control px-2" v-model="form.brand">
						<option value="">Select</option>
						<option v-for="(brand, index) in brands" :key="index" :value="brand.id">
							{{ brand.name }}
						</option>
					</select>
					<HasError :form="form" field="brand" />
				</div>
				<div class="form-group col-md-3">
					<label for="unit_type">Unit Type *</label>
					<select
						name="unit_type"
						class="form-control px-2"
						v-model="form.unit_type"
					>
						<option value="">Select</option>
						<option
							v-for="(unitType, index) in unitTypes"
							:key="index"
							:value="unitType.id"
						>
							{{ unitType.name }}
						</option>
					</select>
					<HasError :form="form" field="unit_type" />
				</div>
				<div class="form-group col-md-3">
					<label for="package_size">Package Size *</label>
					<select
						name="package_size"
						class="form-control px-2"
						v-model="form.package_size"
					>
						<option value="">Select</option>
						<option
							v-for="(packageSize, index) in packageSizes"
							:key="index"
							:value="packageSize.id"
						>
							{{ packageSize.name }}
						</option>
					</select>
					<HasError :form="form" field="package_size" />
				</div>
			</div>

			<div class="form-row mt-3">
				<div class="form-group col-md-3">
					<label for="unit_selling_price"
						>Unit Sell Price (Changeable later) *</label
					>
					<input
						type="text"
						class="form-control"
						v-model="form.unit_selling_price"
					/>
					<HasError :form="form" field="unit_selling_price" />
				</div>
				<!-- <div class="form-group col-md-3">
									<label for="vat">VAT %</label>
									<input type="text" class="form-control" id="vat" v-model="form.vat" />
									<p style="font-size: 10px; padding-left: 4px">
										(Ex: if 10% then give 10)
									</p>
									<HasError :form="form" field="vat" />
								</div> -->
				<!-- <div class="form-group col-md-3">
					<label for="discount_price">Discount Price</label>
					<input
						type="text"
						class="form-control"
						id="discount_price"
						v-model="form.discount_price"
					/>
					<HasError :form="form" field="discount_price" />
				</div>
				<div class="form-group col-md-3">
					<label for="discount_price_from">Discount Price From</label>
					<input
						type="datetime-local"
						class="form-control"
						id="discount_price_from"
						v-model="form.discount_price_from"
					/>
					<HasError :form="form" field="discount_price_from" />
				</div>
				<div class="form-group col-md-3">
					<label for="discount_price_to">Discount Price To</label>
					<input
						type="datetime-local"
						class="form-control"
						id="discount_price_to"
						v-model="form.discount_price_to"
					/>
					<HasError :form="form" field="discount_price_to" />
				</div> -->
			</div>

			<div class="text-right pt-3">
				<button type="reset" class="btn btn-warning">Clear</button>
				<button type="submit" class="btn btn-info" :disabled="form.busy">
					Add Product
				</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	name: "AddProduct",
	data: () => ({
		form: new Form({
			id: "",
			product_name: "",
			product_code: "",
			product_desc: "",
			category: "",
			brand: "",
			unit_type: "",
			package_size: "",
			unit_selling_price: "",
			discount_price: "",
			discount_price_from: "",
			discount_price_to: ""
		}),
		// addModal: false,
		// updateModal: false,
		categories: "",
		brands: "",
		unitTypes: "",
		packageSizes: ""
	}),
	// computed: {
	// 	customers() {}
	// },
	mounted() {
		this.getCategory();
		this.getBrand();
		this.getUnitType();
	},
	methods: {
		// getCustomers(page = 1) {
		// 	axios.get("customers?page=" + page).then(response => {
		// 		this.allcustomers = response.data;
		// 	});
		// },
		addProduct() {
			this.form.post("/Product/Product").then(res => {
				// console.log(res);
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		getCategory() {
			axios.get("/getCategory").then(res => {
				this.categories = res.data.category;
			});
		},
		getBrand() {
			axios.get("/getBrand").then(res => {
				this.brands = res.data.brand;
			});
		},
		getUnitType() {
			axios.get("/getUnitType").then(res => {
				this.unitTypes = res.data.unit_type;
			});
		},
		// deleteCustomer(id) {
		// 	Swal.fire({
		// 		title: "Are you sure?",
		// 		text: "You won't be able to revert this!",
		// 		icon: "warning",
		// 		showCancelButton: true,
		// 		confirmButtonColor: "#3085d6",
		// 		cancelButtonColor: "#d33",
		// 		confirmButtonText: "Yes, delete it!"
		// 	}).then(result => {
		// 		if (result.value == true) {
		// 			axios.delete("customers/" + id).then(res => {
		// 				if (res.data.status == 1) {
		// 					Swal.fire("Deleted!", "Your file has been deleted.", "success");
		// 					this.getCustomers(this.allcustomers.current_page);
		// 				} else {
		// 					toastr.error(res.data.message);
		// 				}
		// 			});
		// 		}
		// 	});
		// },
		// editCustomer(customer) {
		// 	this.form.id = customer.id;
		// 	this.form.name = customer.name;
		// 	this.form.email = customer.email;
		// 	this.form.phone = customer.phone;
		// 	this.form.address = customer.address;
		// 	this.form.status = customer.status;
		// },
		// updateCustomer() {
		// 	this.form.put("customers/" + this.form.id).then(res => {
		// 		if (res.data.status == 1) {
		// 			toastr.success(res.data.message);
		// 			this.clearForm();
		// 			this.updateModal = false;
		// 			this.getCustomers(this.allcustomers.current_page);
		// 		} else {
		// 			toastr.error(res.data.message);
		// 		}
		// 	});
		// },
		clearForm() {
			(this.form.product_name = ""),
				(this.form.product_code = ""),
				(this.form.product_desc = ""),
				(this.form.category = ""),
				(this.form.brand = ""),
				(this.form.unit_type = ""),
				(this.form.package_size = ""),
				(this.form.unit_selling_price = ""),
				(this.form.discount_price = ""),
				(this.form.discount_price_from = ""),
				(this.form.discount_price_to = "");
		}
	},
	watch: {
		"form.unit_type": function(id) {
			axios.get("/getPackageSize/" + id).then(res => {
				this.packageSizes = res.data.package_size;
			});
		}
	}
};
</script>
