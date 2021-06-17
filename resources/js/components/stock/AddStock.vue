<template>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
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

		<!-- View Purchase -->
		<!-- <div v-if="viewState">
			<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
				<div class="modal-dialog modal-lg">
					<div class="modal-content px-3 py-0">
						<div class="modal-header bg-primary">
							<h5 class="modal-title text-light fw-bold fs-4">View Purchase</h5>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<table>
										<tr>
											<th>Memo No</th>
											<td>: {{ PurchaseData.memo_no }}</td>
										</tr>
										<tr>
											<th>Memo Date</th>
											<td>: {{ PurchaseData.memo_date }}</td>
										</tr>
										<tr>
											<th>Ware House</th>
											<td>: {{ PurchaseData.warehouse.name }}</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table>
										<tr>
											<th>Supplier</th>
											<td>: {{ PurchaseData.supplier.business_name }}</td>
										</tr>
										<tr>
											<th>Purchase Status</th>
											<td>: {{ PurchaseData.purchase_status.name }}</td>
										</tr>
										<tr>
											<th>Product Name</th>
											<td>: {{ PurchaseData.product.product_name }}</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-6">
									<table>
										<tr>
											<th>Product Qty</th>
											<td>: {{ PurchaseData.product_qty }}</td>
										</tr>
										<tr>
											<th>Free Qty</th>
											<td>: {{ PurchaseData.free_qty }}</td>
										</tr>
										<tr>
											<th>Unit Price</th>
											<td>: {{ PurchaseData.unit_price }}</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table>
										<tr>
											<th>Order Tax</th>
											<td>: {{ PurchaseData.order_tax }}</td>
										</tr>
										<tr>
											<th>Order Discount</th>
											<td>: {{ PurchaseData.order_discount }}</td>
										</tr>
										<tr>
											<th>Shipping Cost</th>
											<td>: {{ PurchaseData.shipping_cost }}</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-6">
									<tr>
										<th>Paid Amount</th>
										<td>
											: {{ PurchaseData.paid_amount ? PurchaseData.paid_amount : "0" }}
										</td>
									</tr>
									<tr>
										<th>Due Amount</th>
										<td>
											: {{ PurchaseData.due_amount ? PurchaseData.due_amount : "0" }}
										</td>
									</tr>
								</div>
								<div class="col-md-6">
									<tr>
										<th>Payment Type</th>
										<td>
											:
											{{ PurchaseData.payment_type ? PurchaseData.payment_type.name : "" }}
										</td>
									</tr>
									<tr>
										<th>Account</th>
										<td>
											:
											{{
												PurchaseData.bank_account ? PurchaseData.bank_account.bank_name : ""
											}}
										</td>
									</tr>
								</div>
							</div>
							<div class="row mt-4 fw-bold">
								<div class="col-md-6">
									<tr>
										<th>Total Amount</th>
										<td>: {{ PurchaseData.total_price }}</td>
									</tr>
								</div>
								<div class="col-md-6">
									<tr>
										<th>Payment Status</th>
										<td>: {{ PurchaseData.payment_status }}</td>
									</tr>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger" @click="viewState = false">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div> -->
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
