<template>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form @submit.prevent="savePurchase">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="memo_no">Memo No *</label>
								<input type="text" class="form-control" v-model="form.memo_no" />
								<HasError :form="form" field="memo_no" />
							</div>
							<div class="form-group col-md-4">
								<label for="memo_date">Memo Date *</label>
								<input type="date" class="form-control" v-model="form.memo_date" />
								<HasError :form="form" field="memo_date" />
							</div>
							<div class="form-group col-md-4" style="margin-top: -12px">
								<label for="warehouse" style="margin-bottom: 0px">Warehouse *</label>
								<select
									class="form-control"
									v-model="form.warehouse"
									style="margin-top: -9px"
								>
									<option value="">Select</option>
									<option
										v-for="warehouse in Warehouses"
										:key="warehouse.id"
										:value="warehouse.id"
									>
										{{ warehouse.name }}
									</option>
								</select>
								<HasError :form="form" field="warehouse" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="supplier">Supplier Name*</label>
								<select id="supplier" class="form-control" v-model="form.supplier">
									<option value="">Select</option>
									<option
										v-for="supplier in Suppliers"
										:key="supplier.id"
										:value="supplier.id"
									>
										{{ supplier.business_name }}
									</option>
								</select>
								<HasError :form="form" field="supplier" />
							</div>
							<div class="form-group col-md-6">
								<label for="purchase_status">Purchase Status*</label>
								<select
									id="purchase_status"
									class="form-control"
									v-model="form.purchase_status"
								>
									<option value="">Select</option>
									<option
										v-for="purchase_status in PurchaseStatus"
										:key="purchase_status.id"
										:value="purchase_status.id"
									>
										{{ purchase_status.name }}
									</option>
								</select>
								<HasError :form="form" field="purchase_status" />
							</div>
							<!-- <div class="form-group col-md-3">
								<label for="purchase_type">Purchase Type*</label>
								<select
									id="purchase_type"
									class="form-control"
									v-model="form.purchase_type"
								>
									<option value="">Select</option>
									<option
										v-for="pType in PurchaseTypes"
										:key="pType.id"
										value="pType.id"
									>
										{{ pType.name }}
									</option>
								</select>
								<HasError :form="form" field="purchase_type" />
							</div> -->
						</div>

						<div class="form-row mt-5">
							<div class="form-group col-md-6">
								<label for="product_name">Product Name *</label>
								<select class="form-control" v-model="form.product_name">
									<option value="">Select</option>
									<option
										v-for="product in Products"
										:key="product.id"
										:value="product.id"
									>
										{{ product.product_name }}
									</option>
								</select>
								<HasError :form="form" field="product_name" />
							</div>
							<!-- <div class="form-group col-md-6">
								<label for="product_code">Product Code *</label>
								<select class="form-control" v-model="form.product_code">
									<option value="">Select</option>
									<option
										v-for="product in Products"
										:key="product.id"
										value="product.id"
									>
										{{ product.product_code }}
									</option>
								</select>
								<HasError :form="form" field="product_code" />
							</div> -->
						</div>

						<div class="form-row mt-3">
							<div class="form-group col-md-3">
								<label for="product_qty">Product Qty *</label>
								<input
									type="text"
									class="form-control"
									id="product_qty"
									placeholder=""
									v-model="form.product_qty"
								/>
								<HasError :form="form" field="product_qty" />
							</div>
							<div class="form-group col-md-3">
								<label for="free_qty">Free Qty *</label>
								<input
									type="text"
									class="form-control"
									id="free_qty"
									placeholder=""
									v-model="form.free_qty"
								/>
								<HasError :form="form" field="free_qty" />
							</div>
							<div class="form-group col-md-3">
								<label for="unit_price">Unit Price *</label>
								<input
									type="text"
									class="form-control"
									id="unit_price"
									placeholder=""
									v-model="form.unit_price"
								/>
								<HasError :form="form" field="unit_price" />
							</div>
							<div class="form-group col-md-3">
								<label for="total_price">Total Price *</label>
								<input
									type="text"
									class="form-control"
									id="total_price"
									placeholder=""
									readonly
									v-model="form.total_price"
								/>
								<HasError :form="form" field="total_price" />
							</div>
						</div>

						<div class="form-row mt-5">
							<div class="form-group col-md-3">
								<label for="order_tax">Order Tax *</label>
								<input type="text" class="form-control" v-model="form.order_tax" />
								<HasError :form="form" field="order_tax" />
							</div>
							<div class="form-group col-md-3">
								<label for="order_discount">Order Discount *</label>
								<input type="text" class="form-control" v-model="form.order_discount" />
								<HasError :form="form" field="order_discount" />
							</div>
							<div class="form-group col-md-3">
								<label for="shipping_cost">Shipping Cost *</label>
								<input type="text" class="form-control" v-model="form.shipping_cost" />
								<HasError :form="form" field="shipping_cost" />
							</div>
							<div class="form-group col-md-3" style="margin-top: -12px">
								<label for="payment_status" style="margin-bottom: 0px"
									>Payment Status *</label
								>
								<select
									class="form-control"
									v-model="form.payment_status"
									style="margin-top: -9px"
								>
									<option value="">Select</option>
									<option value="Paid">Paid</option>
									<option value="Partial">Partial</option>
									<option value="Due">Due</option>
								</select>
								<HasError :form="form" field="payment_status" />
							</div>
						</div>

						<div class="form-row mt-3">
							<div class="form-group col-md-3">
								<label for="paid_amount">Paid Amount *</label>
								<input
									type="text"
									class="form-control"
									v-model="form.paid_amount"
									:readonly="isPaidnDue"
								/>
								<HasError :form="form" field="paid_amount" />
							</div>
							<div class="form-group col-md-3">
								<label for="due_amount">Due Amount *</label>
								<input
									type="text"
									class="form-control"
									v-model="form.due_amount"
									:readonly="isPaidnDue"
								/>
								<HasError :form="form" field="due_amount" />
							</div>
							<div class="form-group col-md-3" style="margin-top: -12px">
								<label for="payment_type" style="margin-bottom: 0px"
									>Payment Type *</label
								>
								<select
									class="form-control"
									v-model="form.payment_type"
									:disabled="isDue"
									style="margin-top: -9px"
								>
									<option value="">Select</option>
									<option
										v-for="payment_type in PaymentTypes"
										:key="payment_type.id"
										:value="payment_type.id"
									>
										{{ payment_type.name }}
									</option>
								</select>
								<HasError :form="form" field="payment_type" />
							</div>
							<div class="form-group col-md-3" style="margin-top: -12px">
								<label for="account" style="margin-bottom: 0px">Account *</label>
								<select
									class="form-control"
									v-model="form.account"
									:disabled="isDue"
									style="margin-top: -9px"
								>
									<option value="">Select</option>
									<option
										v-for="account in Accounts"
										:key="account.id"
										:value="account.id"
									>
										{{ account.bank_name }}
									</option>
								</select>
								<HasError :form="form" field="account" />
							</div>
						</div>

						<div class="text-right mt-4">
							<button type="reset" class="btn btn-warning">Clear</button>
							<button type="submit" class="btn btn-info" :disabled="form.busy">
								Add Purchase
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
export default {
	data: () => ({
		form: new Form({
			memo_no: "",
			memo_date: "",
			warehouse: "",
			supplier: "",
			purchase_status: "",
			product_name: "",
			product_qty: "",
			free_qty: "",
			unit_price: "",
			total_price: "",
			order_tax: "",
			order_discount: "",
			shipping_cost: "",
			payment_status: "",
			paid_amount: "",
			due_amount: "",
			payment_type: "",
			account: ""
		}),
		Warehouses: "",
		Suppliers: "",
		PurchaseStatus: "",
		Products: "",
		// PaymentStatus: "",
		PaymentTypes: "",
		Accounts: "",

		isDue: false,
		isPaidnDue: false
	}),
	mounted() {
		this.loadWarehouse();
		this.loadSupplier();
		this.loadPurchaseStatus();
		this.loadProducts();
		// this.loadPaymentStatus();
		this.loadPaymentTypes();
		this.loadAccounts();
	},

	methods: {
		savePurchase() {
			this.form.post("Purchase").then(res => {
				// console.log(res);
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		loadWarehouse() {
			axios.get("/getWarehouse").then(res => {
				this.Warehouses = res.data.warehouses;
			});
		},
		loadSupplier() {
			axios.get("/getSuppliers").then(res => {
				this.Suppliers = res.data.supplier;
			});
		},
		loadPurchaseStatus() {
			axios.get("/getPurchaseStatus").then(res => {
				this.PurchaseStatus = res.data.purchase_status;
			});
		},
		// loadPaymentStatus() {
		// 	axios.get("/getPaymentStatus").then(res => {
		// 		this.PaymentStatus = res.data.payment_status;
		// 	});
		// },
		loadProducts() {
			axios.get("/getProducts").then(res => {
				this.Products = res.data.products;
			});
		},
		loadPaymentTypes() {
			axios.get("/getPaymentType").then(res => {
				this.PaymentTypes = res.data.payment_type;
			});
		},
		loadAccounts() {
			axios.get("/getBankAccounts").then(res => {
				this.Accounts = res.data.bank_accounts;
			});
		},

		clearForm() {
			(this.form.memo_no = ""),
				(this.form.memo_date = ""),
				(this.form.warehouse = ""),
				(this.form.supplier = ""),
				(this.form.purchase_status = ""),
				(this.form.product_name = ""),
				(this.form.product_qty = ""),
				(this.form.free_qty = ""),
				(this.form.unit_price = ""),
				(this.form.total_price = ""),
				(this.form.order_tax = ""),
				(this.form.order_discount = ""),
				(this.form.shipping_cost = ""),
				(this.form.payment_status = ""),
				(this.form.paid_amount = ""),
				(this.form.due_amount = ""),
				(this.form.payment_type = ""),
				(this.form.account = "");
		},
		totalCal() {
			this.form.total_price =
				Number(this.form.product_qty) * Number(this.form.unit_price) +
				Number(this.form.order_tax) +
				Number(this.form.shipping_cost) -
				Number(this.form.order_discount);
		}
	},
	watch: {
		// "form.product_name": function(value) {
		// 	axios.get("/product-search/" + value).then(result => {
		// 		this.form.product_code = result.data.product_code;
		// 	});
		// }
		// 	"form.product_code": function(value) {
		// 		axios.post("/product-name-search/" + value).then(result => {
		// 			if (result.data.status == 1) {
		// 				this.form.product_name = result.data.product[0].id;
		// 			}
		// 		});
		// 	},
		"form.product_qty": function(value) {
			this.totalCal();
		},
		"form.unit_price": function(value) {
			this.totalCal();
		},
		"form.order_tax": function(value) {
			this.totalCal();
		},
		"form.shipping_cost": function(value) {
			this.totalCal();
		},
		"form.order_discount": function(value) {
			this.totalCal();
		},
		"form.payment_status": function(value) {
			this.isPaidnDue = false;
			this.isDue = false;
			if (value == "Paid") {
				this.form.paid_amount = this.form.total_price;
				this.form.due_amount = 0;
				this.isPaidnDue = true;
			}
			if (value == "Due") {
				this.form.paid_amount = 0;
				this.form.due_amount = this.form.total_price;
				this.isPaidnDue = true;
				this.isDue = true;
			}
			if (value == "Partial") {
				this.form.paid_amount = "";
				this.form.due_amount = "";
			}
			if (value == "") {
				this.isPaidnDue = true;
				this.isDue = true;
			}
		},
		"form.total_price": function(value) {
			if (this.form.payment_status == "Paid") {
				this.form.paid_amount = value;
			}
			if (this.form.payment_status == "Due") {
				this.form.due_amount = value;
			}
		},
		"form.paid_amount": function(value) {
			if (this.form.payment_status == "Partial") {
				this.form.due_amount = this.form.total_price - value;
			}
		}
	}
};
</script>
