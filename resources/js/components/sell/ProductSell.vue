<template>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body px-4">
					<form @submit.prevent="saveSale">
						<div class="top mb-4 px-4">
							<div class="form-row">
								<div class="form-group col-md-6 me-auto">
									<label for="customer">Customer Name *</label>
									<select
										name="customer"
										id="customer"
										class="form-control"
										v-model="form.customer"
									>
										<option value="">Select</option>
										<option
											v-for="(customer, index) in Customers"
											:key="index"
											:value="customer.id"
										>
											{{ customer.name }}
										</option>
									</select>
									<HasError :form="form" field="customer" />
								</div>
								<div class="form-group col-md-2">
									<label>Invoice No</label>
									<input
										type="text"
										class="form-control"
										v-model="form.invoice_no"
										readonly
									/>
									<HasError :form="form" field="invoice_no" />
								</div>
								<div class="form-group col-md-2">
									<label>Invoice Date</label>
									<input
										type="date"
										class="form-control"
										v-model="form.invoice_date"
										readonly
									/>
									<HasError :form="form" field="invoice_date" />
								</div>
							</div>
						</div>

						<div class="product mb-4">
							<div class="form-row mb-3">
								<div class="form-group col-md-6">
									<label for="product_name">Product Name *</label>
									<select
										name="product_name"
										id="product_name"
										class="form-control"
										v-model="form.product_name"
									>
										<option value="">Select</option>
										<option
											v-for="(product, index) in Products"
											:key="index"
											:value="product.id"
										>
											{{ product.product_name }}
										</option>
									</select>
									<HasError :form="form" field="product_name" />
								</div>
								<div class="form-group col-md-3">
									<label for="unit_price">Unit Price *</label>
									<input
										type="text"
										class="form-control"
										id="unit_price"
										v-model="form.unit_price"
										readonly
									/>
									<HasError :form="form" field="unit_price" />
								</div>
								<div class="form-group col-md-3">
									<label for="order_tax">Order Tax</label>
									<input
										type="text"
										class="form-control"
										id="order_tax"
										v-model="form.order_tax"
									/>
									<HasError :form="form" field="order_tax" />
								</div>
							</div>

							<div class="form-row mb-3">
								<div class="form-group col-md-4">
									<label for="product_qty">Product Qty *</label>
									<input
										type="text"
										class="form-control"
										id="product_qty"
										v-model="form.product_qty"
									/>
									<HasError :form="form" field="product_qty" />
								</div>

								<div class="form-group col-md-4">
									<label for="order_discount">Order Discount</label>
									<input
										type="text"
										class="form-control"
										id="order_discount"
										v-model="form.order_discount"
									/>
									<HasError :form="form" field="order_discount" />
								</div>
								<div class="form-group col-md-4">
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
						</div>
						<div class="payment">
							<div class="form-row mb-3">
								<div class="form-group col-md-12 mb-3" style="margin-top: -12px">
									<label
										for="payment_status"
										style="margin-bottom: 0px; padding-left: 0px"
										>Payment Status *</label
									>
									<select
										class="form-control col-md-3"
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
							<div v-if="isCheckedPStatus" class="form-row mb-3">
								<div class="form-group col-md-3">
									<label for="paid_amount">Paid Amount</label>
									<input
										type="text"
										class="form-control"
										v-model="form.paid_amount"
										:readonly="isPaidnDue"
									/>
									<p class="text-danger m-0" v-if="isExceed">
										Paid Amount exceed total amount
									</p>
									<HasError :form="form" field="paid_amount" />
								</div>
								<div class="form-group col-md-3">
									<label for="due_amount">Due Amount</label>
									<input
										type="text"
										class="form-control"
										v-model="form.due_amount"
										:readonly="true"
									/>
									<HasError :form="form" field="due_amount" />
								</div>
								<div class="form-group col-md-3">
									<label for="payment_type">Payment Type</label>
									<select
										class="form-control"
										v-model="form.payment_type"
										:disabled="isDue"
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
								<div class="form-group col-md-3">
									<label for="account">Account</label>
									<select class="form-control" v-model="form.account" :disabled="isDue">
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
						</div>

						<div class="text-right mt-4">
							<button type="reset" class="btn btn-warning">Clear</button>
							<button
								v-if="!isExceed"
								type="submit"
								class="btn btn-info"
								:disabled="form.busy"
							>
								Save
							</button>
							<button v-else type="submit" class="btn btn-info" disabled>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
import axios from "axios";
export default {
	data: () => ({
		form: new Form({
			customer: "",
			invoice_no: "",
			invoice_date: "",
			product_name: "",
			unit_price: "",
			order_tax: "",
			product_qty: "",
			order_discount: "",
			total_price: "",
			payment_status: "",
			paid_amount: "",
			due_amount: "",
			payment_type: "",
			account: ""
		}),
		PaymentTypes: "",
		Accounts: "",
		Customers: "",
		Products: "",

		isDue: false,
		isPaidnDue: false,
		isCheckedPStatus: false,
		isSearchProduct: false,
		isExceed: false
	}),
	mounted() {
		// this.loadWarehouse();
		this.loadCustomers();
		// this.loadPurchaseStatus();
		this.loadProducts();
		// this.loadPaymentStatus();
		this.loadPaymentTypes();
		this.todaysDate();
		this.invoiceNo();
		this.loadAccounts();
	},

	methods: {
		saveSale() {
			this.form.post("Sell").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.todaysDate();
					this.invoiceNo();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		// loadWarehouse() {
		// 	axios.get("/getWarehouse").then(res => {
		// 		this.Warehouses = res.data.warehouses;
		// 	});
		// },
		loadCustomers() {
			axios.get("/getCustomers").then(res => {
				this.Customers = res.data.customers;
			});
		},
		// loadPurchaseStatus() {
		// 	axios.get("/getPurchaseStatus").then(res => {
		// 		this.PurchaseStatus = res.data.purchase_status;
		// 	});
		// },
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
		//invoice date
		todaysDate() {
			this.form.invoice_date = new Date().toISOString().slice(0, 10);
		},
		//invoice no
		invoiceNo() {
			let $date = new Date().toISOString().slice(0, 4);
			axios.get("/Get-Last-Invoice-No").then(res => {
				if (res.data.last_invoice_no == null) {
					this.form.invoice_no = $date + "/" + 10001;
				} else {
					let $last_invoice_no = res.data.last_invoice_no.slice(5, 10);
					let $i_no = Number($last_invoice_no) + Number(1);
					this.form.invoice_no = $date + "/" + $i_no;
				}
			});
		},
		loadAccounts() {
			axios.get("/getBankAccounts").then(res => {
				this.Accounts = res.data.bank_accounts;
			});
		},

		clearForm() {
			this.form.customer = "";
			this.form.invoice_no = "";
			this.form.invoice_date = "";
			this.form.product_name = "";
			this.form.unit_price = "";
			this.form.order_tax = "";
			this.form.product_qty = "";
			this.form.order_discout = "";
			this.form.total_price = "";
			this.form.payment_status = "";
			this.form.paid_amount = "";
			this.form.due_amount = "";
			this.form.payment_type = "";
			this.form.account = "";
		},
		totalCal() {
			this.form.total_price =
				Number(this.form.product_qty) * Number(this.form.unit_price) +
				Number(this.form.order_tax) -
				Number(this.form.order_discount);
		}
	},
	watch: {
		"form.product_name": function(value) {
			this.Products.forEach(element => {
				if (value == element.id) {
					this.form.unit_price = element.unit_selling_price;
					this.form.product_qty = 1;
				}
			});
		},
		"form.product_qty": function(value) {
			this.totalCal();
		},
		"form.unit_price": function(value) {
			this.totalCal();
		},
		"form.order_tax": function(value) {
			this.totalCal();
		},
		"form.order_discount": function(value) {
			this.totalCal();
		},
		"form.payment_status": function(value) {
			this.isPaidnDue = false;
			this.isDue = false;
			this.isCheckedPStatus = false;
			if (value == "Paid") {
				this.form.paid_amount = this.form.total_price;
				this.form.due_amount = 0;
				this.isPaidnDue = true;
				this.isCheckedPStatus = true;
			}
			if (value == "Due") {
				this.form.paid_amount = 0;
				this.form.due_amount = this.form.total_price;
				// this.isPaidnDue = true;
				this.isDue = true;
				this.isCheckedPStatus = true;
			}
			if (value == "Partial") {
				this.form.due_amount = "";
				this.form.paid_amount = "";
				this.isCheckedPStatus = true;
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
			if (this.form.payment_status == "Partial" && this.form.paid_amount != 0) {
				if (this.form.paid_amount > this.form.total_price) {
					this.isExceed = true;
				} else {
					this.form.due_amount = this.form.total_price - value;
					this.isExceed = false;
				}
			}
		}
	}
};
</script>
<style scoped>
div.payment,
div.product {
	padding: 20px;
	border: 1px solid #cecece;
}
select.form-control:not([size]):not([multiple]) {
	height: calc(2.3rem);
}
</style>
