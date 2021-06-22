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
						<h4 class="card-title m-0 p-2">Bank Ledger</h4>
					</div>
					<div class="card-body">
						<form @submit.prevent="doQuery">
							<div
								class="form-row p-4 my-3 mx-1 justify-content-center"
								style="border: 1px solid #eee"
							>
								<div class="form-group col-md-2">
									<label for="start_date">Data From</label>
									<input
										type="date"
										id="start_date"
										class="form-control"
										v-model="form.start_date"
									/>
									<HasError :form="form" field="start_date" />
								</div>
								<div class="form-group col-md-2">
									<label for="end_date">Data To</label>
									<input
										type="date"
										id="end_date"
										class="form-control"
										v-model="form.end_date"
									/>
									<HasError :form="form" field="end_date" />
								</div>
								<div class="form-group col-md-3 ms-0 ms-lg-4">
									<label for="bank_id" class="ps-0">Bank Name</label>
									<select class="form-control" v-model="form.bank_id">
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
									<HasError :form="form" field="bank_id" />
								</div>

								<div class="form-group d-flex align-items-end">
									<button class="btn btn-primary btn-sm">Search</button>
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="">
										<th>Date</th>
										<th>Description</th>
										<th>Bank Name</th>
										<th>Debit (+)</th>
										<th>Credit (-)</th>
										<th>Balance</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(transaction, index) in allTransactions" :key="index">
										<td>{{ transaction.date }}</td>
										<td>{{ transaction.description }}</td>
										<td>{{ transaction.bank_names.bank_name }}</td>
										<td class="text-end">{{ transaction.debit }}</td>
										<td class="text-end">{{ transaction.credit }}</td>
										<td class="text-end fw-bold">{{ transaction.balance }}</td>
									</tr>
									<tr v-if="allTransactions.length == 0">
										<td colspan="6" class="p-3 fw-bold text-danger">No data Founded</td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- <div class="row">
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
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";
export default {
	name: "BankLedger",
	data: () => ({
		form: new Form({
			start_date: "",
			end_date: "",
			bank_id: ""
		}),
		allTransactions: {},
		allBanks: ""
	}),
	mounted() {
		// this.getTotalBalance();
		this.getBankNames();
	},
	methods: {
		doQuery() {
			this.form.post("Ledger").then(response => {
				// console.log(response);
				this.allTransactions = response.data.result;
			});
		},
		getBankNames() {
			axios.get("/getBankAccounts").then(res => {
				this.allBanks = res.data.bank_accounts;
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
label {
	padding-left: 0px;
}
</style>
