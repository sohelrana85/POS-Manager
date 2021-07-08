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
						<h4 class="card-title m-0 p-2">Manage Expense</h4>
						<button v-if="canAdd" @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card mt-0">
								<div class="card-body">
									<table
										id="example"
										class="cell-border hover stripe nowrap"
										style="width: 100%"
									>
										<thead>
											<tr class="text-center">
												<th>id</th>
												<th>Date</th>
												<th>Expense Type</th>
												<th>Status</th>
												<th>Paid</th>
												<th>Due</th>
												<th>Pay. Type</th>
												<th>Bank</th>
												<th>Remarks</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr
												v-for="(expense, index) in AllExpenses"
												:key="index"
												:class="expense.status == 1 ? 'stockadded' : ''"
											>
												<td>{{ ++index }}</td>
												<td>{{ expense.date }}</td>
												<td>{{ expense.expense.expense_type }}</td>
												<td>{{ expense.payment_status }}</td>
												<td class="text-end">{{ expense.paid_amount }}</td>
												<td class="text-end">{{ expense.due_amount }}</td>
												<td>{{ expense.p_type ? expense.p_type.name : "" }}</td>
												<td>{{ expense.b_account ? expense.b_account.bank_name : "" }}</td>
												<td>{{ expense.remarks }}</td>
												<td class="text-center">
													<button type="button" class="btn btn-info p-1">
														<i class="material-icons">person</i>
													</button>
													<button v-if="canEdit" type="button" class="btn btn-success p-1">
														<i class="material-icons">edit</i>
													</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Expense model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-dialog-scrollable modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Add Expense</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="addExpense">
								<div class="form-row">
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
									<div class="form-group col-md-6">
										<label for="expense_type">Expense Type *</label>
										<select class="form-control" v-model="form.expense_type">
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
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="payment_status">Payment Status *</label>
										<select class="form-control" v-model="form.payment_status">
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
								<div v-if="!isDue" class="form-row">
									<div class="form-group col-md-6">
										<label for="payment_type">Payment Type</label>
										<select
											class="form-control"
											v-model="form.payment_type"
											:disabled="isDue"
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
									<div class="form-group col-md-6">
										<label for="bank_account">Account</label>
										<select
											class="form-control"
											v-model="form.bank_account"
											:disabled="isDue"
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
								<div class="form-row mt-3">
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
		<!-- End Add Expense model -->
	</div>
</template>
<script>
import axios from "axios";
export default {
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
		canAdd: false,
		canEdit: false,

		AllExpenses: "",
		ExpenseTypes: "",
		PaymentTypes: "",
		Accounts: ""
	}),
	computed: {},
	mounted() {
		this.allExpenseData();
		this.loadExpenseTypes();
		this.loadPaymentTypes();
		this.loadAccounts();
		this.rolePermission();
	},
	methods: {
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "expense.create") {
						this.canAdd = true;
					} else if (element.name == "expense.edit") {
						this.canEdit = true;
					}
				});
			});
		},
		allExpenseData() {
			axios.get("/All_Expense").then(res => {
				this.AllExpenses = res.data.expenses;
			});
		},
		addExpense() {
			this.form.post("Expense").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.allExpenseData();
				} else {
					toastr.error(res.data.message);
				}
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
tbody {
	font-weight: 400;
}
.modal th {
	font-weight: 500;
	width: 110px;
}
.modal tr {
	padding: 5px 0px;
}
.dataTable > thead > tr > th,
.dataTable > tbody > tr > th,
.dataTable > tfoot > tr > th,
.dataTable > thead > tr > td,
.dataTable > tbody > tr > td,
.dataTable > tfoot > tr > td {
	padding: 1px 5px !important;
}
</style>
