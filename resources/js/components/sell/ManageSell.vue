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
						<h4 class="card-title m-0 p-2">Manage Sell</h4>
					</div>

					<div class="card-body">
						<table
							id="example"
							class="cell-border hover stripe nowrap"
							style="width: 100%"
						>
							<thead>
								<tr style="text-center">
									<th>sl</th>
									<th>Invoice No</th>
									<th>Invoice Date</th>
									<th>Product Name</th>
									<th>Customer Name</th>
									<th>Qty</th>
									<th>Unit Price</th>
									<th>Discount</th>
									<th>Total Amount</th>
									<th>Pay Status</th>
									<th>Rec. Amount</th>
									<th>Due Amount</th>
									<th>Payment Type</th>
									<th>Account Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(sell, index) in Sells" :key="index">
									<td>{{ ++index }}</td>
									<td>{{ sell.invoice_no }}</td>
									<td>{{ sell.invoice_date }}</td>
									<td>{{ sell.product_name.product_name }}</td>
									<td>{{ sell.customers.name }}</td>
									<td>{{ sell.product_qty }}</td>
									<td>{{ sell.product_price }}</td>
									<td>{{ sell.product_discount }}</td>
									<td>{{ sell.total_amount }}</td>
									<td>{{ sell.payment_status }}</td>
									<td>{{ sell.receive_amount }}</td>
									<td>{{ sell.due_amount }}</td>
									<td>{{ sell.payment_type }}</td>
									<td>{{ sell.account_name }}</td>
									<td class="text-center">
										<!-- <i
                                            class="btn btn-sm btn-warning fa fa-edit"
                                            style="padding: 3px 11px"
                                        ></i>
                                        <i class="btn btn-sm btn-info fa fa-eye" style="padding: 3px 11px"></i> -->
										<button type="button" class="btn btn-info p-1">
											<i class="material-icons">person</i>
										</button>
										<button v-if="canEdit" type="button" class="btn btn-success p-1">
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
			</div>
		</div>
	</div>
</template>
<script>
import axios from "axios";
export default {
	data: () => ({
		form: new Form({}),
		Sells: "",
		canEdit: false
		// viewState: false,
		// PurchaseData: ""
	}),
	computed: {},
	mounted() {
		this.allSells();
		this.rolePermission();
	},
	methods: {
		rolePermission() {
			axios.get("/role-permissions").then(response => {
				response.data.forEach(element => {
					if (element.name == "sell.edit") {
						this.canEdit = true;
					}
				});
			});
		},
		allSells() {
			axios.get("all-sell").then(res => {
				this.Sells = res.data.sells;
			});
		}
		// badgeColor(value) {
		// 	if (value == 0) {
		// 		return "btn btn-sm btn-success";
		// 	} else {
		// 		return "btn btn-sm disabled";
		// 	}
		// },
		// badgeState(status) {
		// 	if (status == "Due") {
		// 		return "badge-danger";
		// 	} else if (status == "Paid") {
		// 		return "badge-success";
		// 	} else {
		// 		return "badge-warning";
		// 	}
		// },
		// viewPurchase(data) {
		// 	this.viewState = true;
		// 	this.PurchaseData = data;
		// },
		// addToStock(id) {
		// axios.get("Add-To-Stock/" + id).then(res => {
		// 	console.log(res);
		// });

		// 	Swal.fire({
		// 		title: "Are you sure?",
		// 		text: "You won't be able to revert this!",
		// 		icon: "warning",
		// 		showCancelButton: true,
		// 		confirmButtonColor: "#3085d6",
		// 		cancelButtonColor: "#d33",
		// 		confirmButtonText: "Yes, Add to Stock!"
		// 	}).then(result => {
		// 		if (result.value == true) {
		// 			axios.get("Add-To-Stock/" + id).then(res => {
		// 				if (res.data.status == 1) {
		// 					Swal.fire("Success!", "Product Added Success.", "success");
		// 					this.allPurchaseData();
		// 				} else {
		// 					toastr.error(res.data.error);
		// 				}
		// 			});
		// 		}
		// 	});
		// }
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
