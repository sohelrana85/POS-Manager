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
						<h4 class="card-title m-0 pt-2">Bank Transaction</h4>
						<button v-if="canAdd" @click="addModal = true" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							Add New
						</button>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="">
										<th>Date</th>
										<th>Description</th>
										<th>Bank Name</th>
										<th>Debit (+)</th>
										<th>Credit (-)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(transaction, index) in allTransactions.data" :key="index">
										<td>{{ transaction.date }}</td>
										<td>{{ transaction.description }}</td>
										<td>{{ transaction.bank_names.bank_name }}</td>
										<td class="text-end">{{ transaction.debit }}</td>
										<td class="text-end">{{ transaction.credit }}</td>
										<td class="td-actions">
											<button
												v-if="canEdit"
												type="button"
												class="btn btn-success"
												@click="
													updateModal = true;
													editItem(transaction);
												"
											>
												<i class="material-icons">edit</i>
											</button>
											<button
												v-if="canDelete"
												type="button"
												class="btn btn-danger"
												@click="deleteItem(transaction.id)"
											>
												<i class="material-icons">close</i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-4">
								Showing {{ allTransactions.from }} to {{ allTransactions.to }} of
								{{ allTransactions.total }} entries
							</div>
							<div class="col-md-8">
								<pagination
									align="right"
									:limit="2"
									:data="allTransactions"
									@pagination-change-page="getTransactions"
								></pagination>
							</div>
						</div>
						<!--
						<div class="row fw-bold">
							<div class="col">
								<p style="border-bottom: 1px solid #eee">Balance:</p>
								City Bank Ltd: 123456.00
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>

		<!-- Add New Bank Transaction model -->
		<div v-if="addModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-dialog-scrollable modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Add Transaction</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="saveTransaction" class="my-3">
								<div class="form-group">
									<label for="transaction_date">Transaction Date</label>
									<input
										type="date"
										class="form-control"
										id="transaction_date"
										v-model="form.transaction_date"
									/>
									<HasError :form="form" field="transaction_date" />
								</div>

								<div class="form-group">
									<label for="transaction_type" class="mb-0">Transaction Type</label>
									<select
										class="form-control px-1"
										id="transaction_type"
										v-model="form.transaction_type"
									>
										<option value="">Select</option>
										<option value="debit">Debit (+)</option>
										<option value="credit">Credit (-)</option>
									</select>
									<HasError :form="form" field="transaction_type" />
								</div>
								<div class="form-group">
									<label for="bank_name" class="mb-0">Bank Name</label>
									<select
										class="form-control px-1"
										id="bank_name"
										v-model="form.bank_name"
									>
										<option value="">Select</option>
										<option
											v-for="(bank, index) in allBanks"
											:key="index"
											:value="bank.id"
										>
											{{ bank.bank_name }} -
											{{ bank.account_number }}
										</option>
									</select>
									<HasError :form="form" field="bank_name" />
								</div>
								<div class="form-group">
									<label for="amount">Amount</label>
									<input
										type="text"
										class="form-control"
										id="amount"
										v-model="form.amount"
									/>
									<HasError :form="form" field="amount" />
								</div>
								<div class="form-group">
									<label for="description">Description</label>
									<textarea
										class="form-control"
										name="description"
										id="description"
										cols="20"
										rows="2"
										v-model="form.description"
									></textarea>
									<HasError :form="form" field="description" />
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

		<!-- Update Bank Transaction model -->
		<div v-if="updateModal">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-dialog-scrollable modal-md">
					<div class="modal-content px-3 py-0">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Update Transaction</h5>
						</div>
						<div class="modal-body">
							<form @submit.prevent="updateTransaction" class="my-3">
								<div class="form-group">
									<label for="transaction_date">Transaction Date</label>
									<input
										type="date"
										class="form-control"
										id="transaction_date"
										v-model="form.transaction_date"
									/>
									<HasError :form="form" field="transaction_date" />
								</div>

								<div class="form-group">
									<label for="transaction_type" class="mb-0">Transaction Type</label>
									<select
										class="form-control px-1"
										id="transaction_type"
										v-model="form.transaction_type"
									>
										<option value="">Select</option>
										<option value="debit">Debit (+)</option>
										<option value="credit">Credit (-)</option>
									</select>
									<HasError :form="form" field="transaction_type" />
								</div>
								<div class="form-group">
									<label for="bank_name" class="mb-0">Bank Name</label>
									<select
										class="form-control px-1"
										id="bank_name"
										v-model="form.bank_name"
									>
										<option value="">Select</option>
										<option
											v-for="(bank, index) in allBanks"
											:key="index"
											:value="bank.id"
										>
											{{ bank.bank_name }} -
											{{ bank.account_number }}
										</option>
									</select>
									<HasError :form="form" field="bank_name" />
								</div>
								<div class="form-group">
									<label for="amount">Amount</label>
									<input
										type="text"
										class="form-control"
										id="amount"
										v-model="form.amount"
									/>
									<HasError :form="form" field="amount" />
								</div>
								<div class="form-group">
									<label for="description">Description</label>
									<textarea
										class="form-control"
										name="description"
										id="description"
										cols="20"
										rows="2"
										v-model="form.description"
									></textarea>
									<HasError :form="form" field="description" />
								</div>

								<div class="modal-footer pb-0">
									<button @click="updateModal = false" class="btn btn-secondary">
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
import axios from "axios";
export default {
	name: "BankTransaction",
	data: () => ({
		form: new Form({
			id: "",
			transaction_date: "",
			transaction_type: "",
			bank_name: "",
			amount: "",
			description: ""
		}),
		addModal: false,
		updateModal: false,
		allTransactions: {},
		allBanks: "",
		totalBalance: "",
		canAdd: false,
		canEdit: false,
		canDelete: false
	}),
	mounted() {
		this.getTransactions();
		this.getBankNames();
		this.getTotalBalance();
		this.rolePermission();
	},
	methods: {
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "bank-transaction.create") {
						this.canAdd = true;
					} else if (element.name == "bank-transaction.edit") {
						this.canEdit = true;
					} else if (element.name == "bank-transaction.delete") {
						this.canDelete = true;
					}
				});
			});
		},
		getTransactions(page = 1) {
			axios.get("All-Bank-Transaction?page=" + page).then(response => {
				this.allTransactions = response.data;
			});
		},
		getTotalBalance() {
			axios.get("/getTotalBalance").then(res => {
				console.log(res.data.total_balance);
			});
		},

		saveTransaction() {
			this.form.post("Bank-Transaction").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getTransactions(this.allTransactions.current_page);
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		deleteItem(id) {
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
					// axios.delete("Transaction/" + id).then(res => {
					// 	if (res.data.status == 1) {
					// 		Swal.fire("Deleted!", "Your file has been deleted.", "success");
					// 		this.getTransactions(this.allTransactions.current_page);
					// 	} else {
					// 		toastr.error(res.data.message);
					// 	}
					// });
				}
			});
		},
		editItem(data) {
			this.form.id = data.id;
			this.form.transaction_date = data.date;
			this.form.transaction_type = data.transaction_type;
			this.form.bank_name = data.bank_name;
			this.form.amount =
				data.transaction_type == "debit" ? data.debit : data.credit;
			this.form.description = data.description;
		},
		// updateAccount() {
		// 	this.form.put("Account/" + this.form.id).then(res => {
		// 		if (res.data.status == 1) {
		// 			toastr.success(res.data.message);
		// 			this.clearForm();
		// 			this.updateModal = false;
		// 			this.getAccounts(this.allAccounts.current_page);
		// 		} else {
		// 			toastr.error(res.data.message);
		// 		}
		// 	});
		// },
		getBankNames() {
			axios.get("/getBankAccounts").then(res => {
				this.allBanks = res.data.bank_accounts;
			});
		},
		clearForm() {
			(this.form.transaction_date = ""), (this.form.transaction_type = "");
			this.form.bank_name = "";
			this.form.amount = "";
			this.form.description = "";
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
label {
	padding-left: 0px;
}
</style>
