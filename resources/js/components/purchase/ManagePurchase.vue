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
						<h4 class="card-title m-0 p-2">Manage Purchase</h4>
					</div>
					<div class="card-body">
						<table id="example" class="cell-border hover stripe" style="width: 100%">
							<thead>
								<tr>
									<th>sl</th>
									<th>Memo No</th>
									<!-- <th>Memo Date</th> -->
									<!-- <th>Warehouse</th> -->
									<th>Supplier</th>
									<!-- <th>Purchase Status</th> -->
									<th>Product Name</th>
									<!-- <th>P. Qty</th> -->
									<!-- <th>F. Qty</th> -->
									<th>P. Qty</th>
									<th>U. Price</th>
									<th>T. Cost</th>
									<!-- <th>Order Tax</th> -->
									<!-- <th>Order Discount</th> -->
									<!-- <th>Shipping Cost</th> -->
									<th>Pay Status</th>
									<!-- <th>Paid Amount</th> -->
									<!-- <th>Due Amount</th> -->
									<!-- <th>Payment Type</th> -->
									<!-- <th>Bank Account</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr
									v-for="purchase in AllPurchases"
									:key="purchase.id"
									:class="purchase.status == 1 ? 'stockadded' : ''"
								>
									<td>{{ purchase.id }}</td>
									<td>{{ purchase.memo_no }}</td>
									<!-- <td>{{ purchase.memo_date }}</td> -->
									<!-- <td>{{ purchase.warehouse.name }}</td> -->
									<td>{{ purchase.supplier.business_name }}</td>
									<!-- <td>{{ purchase.purchase_status.name }}</td> -->
									<td>{{ purchase.product.product_name }}</td>
									<!-- <td>{{ purchase.product_qty }}</td> -->
									<!-- <td>{{ purchase.free_qty }}</td> -->
									<td class="text-center">
										{{ purchase.product_qty + purchase.free_qty }}
									</td>
									<td class="text-center">{{ purchase.unit_price }}</td>
									<td class="text-center">{{ purchase.total_price }}</td>
									<!-- <td>{{ purchase.order_tax }}</td> -->
									<!-- <td>{{ purchase.order_discount }}</td> -->
									<!-- <td>{{ purchase.shipping_cost }}</td> -->
									<td class="text-center">
										<span :class="badgeState(purchase.payment_status)">
											{{ purchase.payment_status }}
										</span>
									</td>
									<td class="text-center" style="width: 80px">
										<!-- <i
                                            class="btn btn-sm btn-warning fa fa-edit"
                                            v-if="purchase.status == 0"
                                            style="padding: 3px 11px"
                                        ></i> -->
										<!-- <i
                                            @click="viewPurchase(purchase)"
                                            class="btn btn-sm btn-info fa fa-eye"
                                            style="padding: 3px 11px"
                                        ></i> -->
										<button
											@click="viewPurchase(purchase)"
											type="button"
											class="btn btn-info p-1"
										>
											<i class="material-icons">person</i>
										</button>
										<button
											v-if="(purchase.status == 0, canEdit)"
											type="button"
											class="btn btn-success p-1"
										>
											<i class="material-icons">edit</i>
										</button>
									</td>
									<!-- <td>{{ purchase.due_amount ?? "" }}</td>
                                    <td>{{ purchase.payment_type.name ?? "" }}</td>
                                    <td>{{ purchase.bank_account.bank_name ?? "" }}</td> -->
								</tr>
							</tbody>
						</table>
					</div>

					<!-- View Purchase -->
					<div v-if="viewState">
						<div class="modal d-block" style="background: rgba(0, 0, 0, 0.5)">
							<div class="modal-dialog modal-lg">
								<div class="modal-content px-3 py-0">
									<div class="modal-header">
										<h5 class="modal-title fw-bold">View Purchase</h5>
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
														{{
															PurchaseData.payment_type ? PurchaseData.payment_type.name : ""
														}}
													</td>
												</tr>
												<tr>
													<th>Account</th>
													<td>
														:
														{{
															PurchaseData.bank_account
																? PurchaseData.bank_account.bank_name
																: ""
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
										<button class="btn btn-danger btn-sm" @click="viewState = false">
											Close
										</button>
									</div>
								</div>
							</div>
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
	data: () => ({
		form: new Form({}),
		AllPurchases: "",
		viewState: false,
		PurchaseData: "",
		canEdit: false
	}),
	mounted() {
		this.allPurchaseData();
		this.rolePermission();
	},
	methods: {
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "purchase.edit") {
						this.canEdit = true;
					}
				});
			});
		},
		allPurchaseData() {
			axios.get("Load-Purchase").then(res => {
				this.AllPurchases = res.data.product_purchase;
			});
		},
		badgeColor(value) {
			if (value == 0) {
				return "btn btn-sm btn-success";
			} else {
				return "btn btn-sm disabled";
			}
		},
		badgeState(status) {
			if (status == "Due") {
				return "text-danger";
			} else if (status == "Paid") {
				return "";
			} else {
				return "text-warning";
			}
		},
		viewPurchase(data) {
			this.viewState = true;
			this.PurchaseData = data;
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
		// jqeuryrun() {
		// 	$(document).ready(function() {
		// 		$("#example").DataTable();
		// 	});
		// }
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
