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
						<h4 class="card-title m-0 p-2">Add Stock</h4>
					</div>
					<div class="card-body">
						<table id="example" class="cell-border hover stripe" style="width: 100%">
							<thead>
								<tr>
									<th>sl</th>
									<th>Memo No</th>
									<th>Supplier</th>
									<th>Product Name</th>
									<th>Product Qty</th>
									<th>Unit Price</th>
									<th>Total Cost</th>
									<th>Add in Stock</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(purchase, index) in AllPurchases" :key="index">
									<td>{{ ++index }}</td>
									<td>{{ purchase.memo_no }}</td>
									<td>{{ purchase.supplier.business_name }}</td>
									<td>{{ purchase.product.product_name }}</td>
									<td class="text-right fw-bold">
										{{ purchase.product_qty + purchase.free_qty }}
									</td>
									<td class="text-right fw-bold">{{ purchase.unit_price }}</td>
									<td class="text-right fw-bold">{{ purchase.total_price }}</td>
									<td class="text-center">
										<button @click="addToStock(purchase.id)" class="btn btn-sm btn-info">
											Add
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
</template>
<script>
import axios from "axios";
export default {
	data: () => ({
		form: new Form({}),
		AllPurchases: ""
		// viewState: false,
		// PurchaseData: ""
	}),
	computed: {},
	created() {
		$(document).ready(function() {
			$("#example").DataTable();
		});
	},
	mounted() {
		this.allPurchaseData();
		// this.jqeuryrun();
	},
	methods: {
		allPurchaseData() {
			axios.get("All-Purchase").then(res => {
				this.AllPurchases = res.data.all_purchase;
			});
		},
		addToStock(id) {
			// axios.get("Add-To-Stock/" + id).then(res => {
			// 	console.log(res);
			// });

			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, Add to Stock!"
			}).then(result => {
				if (result.value == true) {
					axios.get("Add-To-Stock/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Success!", "Product Added Success.", "success");
							this.allPurchaseData();
						} else {
							toastr.error(res.data.error);
						}
					});
				}
			});
		}
	}
};
</script>

<style scoped>
.btn {
	padding: 3px 10px;
}
thead tr {
	background: #016dc8;
	color: white;
}
tbody {
	font-weight: 400;
}
</style>
