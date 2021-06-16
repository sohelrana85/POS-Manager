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
						<h4 class="card-title m-0 pt-2">Manage Expense</h4>
						<button @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
						<!-- <p class="card-category">Manage unitType page</p> -->
					</div>
					<div class="card-body">
						<table id="myTable" class="cell-border hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Date</th>
									<th>Expense Type</th>
									<th>Status</th>
									<th>Paid</th>
									<th>Due</th>
									<th>Pay. Type</th>
									<th>Bank</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Type model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title">Add Expense</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="addExpense">
								<div class="form-row mb-3 pt-4">
									<div class="form-group col-md-6">
										<label for="date">Date *</label>
										<input
											type="date"
											id="date"
											class="form-control"
											v-model="form.date"
										/>
										<HasError :form="form" field="date" />
									</div>
									<div class="form-group col-md-6" style="margin-top: -12px">
										<label
											for="expense_type"
											style="margin-bottom: 0px; padding-left: 0px"
											>Expense Type *</label
										>
										<select
											class="form-control"
											v-model="form.expense_type"
											style="margin-top: -9px"
										>
											<option value="">Select</option>
											<option
												v-for="expenseType in ExpenseTypes"
												:key="expenseType.id"
												:value="expenseType.id"
											>
												{{ expenseType.expense_type }}
											</option>
										</select>
										<HasError :form="form" field="expense_type" />
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="form-group col-md-4" style="margin-top: -12px">
										<label
											for="payment_status"
											style="margin-bottom: 0px; padding-left: 0px"
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
									<div v-if="!isDue" class="form-group col-md-4">
										<label for="paid_amount">Paid Amount</label>
										<input
											type="text"
											class="form-control"
											v-model="form.paid_amount"
											:readonly="isDue"
										/>
										<HasError :form="form" field="paid_amount" />
									</div>
									<div v-if="!isPaid" class="form-group col-md-4">
										<label for="due_amount">Due Amount</label>
										<input
											type="text"
											class="form-control"
											v-model="form.due_amount"
											:readonly="isPaid"
										/>
										<HasError :form="form" field="due_amount" />
									</div>
								</div>
								<div v-if="!isDue" class="form-row mb-3">
									<div class="form-group col-md-6" style="margin-top: -12px">
										<label
											for="payment_type"
											style="margin-bottom: 0px; padding-left: 0px"
											>Payment Type</label
										>
										<select
											class="form-control"
											v-model="form.payment_type"
											:disabled="isDue"
											style="margin-top: -9px"
										>
											<option value="">Select</option>
											<option
												v-for="paymentType in PaymentTypes"
												:key="paymentType.id"
												:value="paymentType.id"
											>
												{{ paymentType.name }}
											</option>
										</select>
										<HasError :form="form" field="payment_type" />
									</div>
									<div class="form-group col-md-6" style="margin-top: -12px">
										<label
											for="bank_account"
											style="margin-bottom: 0px; padding-left: 0px"
											>Account</label
										>
										<select
											class="form-control"
											v-model="form.bank_account"
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
										<HasError :form="form" field="bank_account" />
									</div>
								</div>
								<div class="form-row mt-4">
									<div class="form-group col-md-12" style="margin-top: -12px">
										<label for="remarks">Remarks</label>
										<textarea
											class="form-control"
											cols="30"
											rows="3"
											v-model="form.remarks"
										></textarea>
										<HasError :form="form" field="remarks" />
									</div>
								</div>

								<div class="text-right mt-4">
									<button
										@click="
											addModal = false;
											clearForm();
											clearErrors();
										"
										class="btn btn-warning"
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

		<!-- Edit Type model -->
	</div>
</template>
<script>
import axios from "axios";
export default {
	name: "ManageExpense",
	data: () => ({
		form: new Form({
			id: "",
			date: "",
			expense_type: "",
			payment_status: "",
			paid_amount: "",
			due_amount: "",
			payment_type: "",
			bank_account: "",
			remarks: ""
		}),
		addModal: false,
		isDue: false,
		isPaid: false,

		ExpenseTypes: "",
		PaymentTypes: "",
		Accounts: ""
	}),
	created() {
		$(document).ready(function() {
			$.noConflict();
			$("#myTable").DataTable({
				// scrollX: true,
				processing: true,
				serverSide: true,
				ajax: "Expense",
				columns: [
					{ data: "id" },
					{ data: "date" },
					{ data: "expense.expense_type", className: "dt-body-left" },
					{ data: "payment_status" },
					{ data: "paid_amount", className: "dt-body-right" },
					{ data: "due_amount", className: "dt-body-right" },
					{ data: "p_type.name", defaultContent: "", className: "dt-body-left" },
					{
						data: "b_account.bank_name",
						defaultContent: "",
						className: "dt-body-left"
					},
					{ data: "remarks", className: "dt-body-left", type: "select" }
				]
			});
		});
	},
	mounted() {
		this.loadExpenseTypes();
		this.loadPaymentTypes();
		this.loadAccounts();
	},
	methods: {
		addExpense() {
			this.form.post("Expense").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.$options.created[0]();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		loadExpenseTypes() {
			axios.get("/getExpenseType").then(res => {
				this.ExpenseTypes = res.data.expense_type;
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
			this.form.id = "";
			this.form.date = "";
			this.form.expense_type = "";
			this.form.payment_status = "";
			this.form.paid_amount = "";
			this.form.due_amount = "";
			this.form.payment_type = "";
			this.form.bank_account = "";
			this.form.remarks = "";
		},
		clearErrors() {
			this.form.errors.errors = "";
		}
	},
	watch: {
		"form.payment_status": function(value) {
			this.isDue = false;
			this.isPaid = false;
			if (value == "Paid") {
				this.isPaid = true;
				this.addExpense();
			}
			if (value == "Due") {
				this.isDue = true;
				this.form.payment_type = "";
				this.form.bank_account = "";
				this.addExpense();
			}
			if (value == "Partial") {
				this.addExpense();
			}
			if (value == "") {
				this.clearErrors();
			}
		}
	}
};
</script>
<style scoped>
table {
	text-align: center;
}
tbody {
	font-weight: 400;
}
thead {
	background: #0072ff;
	color: white;
}
</style>
