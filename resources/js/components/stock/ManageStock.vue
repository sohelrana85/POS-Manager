<template>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table id="example" class="cell-border hover stripe" style="width: 100%">
						<thead>
							<tr>
								<th>sl</th>
								<th>Product Name</th>
								<th>Product Code</th>
								<th>Stock Qty</th>
								<th>Stock Value</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(stock, index) in allStocks" :key="index">
								<td>{{ ++index }}</td>
								<td>{{ stock.product.product_name }}</td>
								<td>{{ stock.product.product_code }}</td>
								<td class="text-right">{{ stock.stock_qty }}</td>
								<td class="text-right">{{ stock.stock_value }}</td>
							</tr>
						</tbody>
						<tfoot border>
							<tr class="text-end">
								<th colspan="3">Total =</th>
								<th>{{ sumTotalQty }}</th>
								<th>{{ sumTotalValue }}</th>
							</tr>
						</tfoot>
					</table>
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
		allStocks: "",
		sumTotalQty: "",
		sumTotalValue: ""
	}),
	computed: {},
	mounted() {
		this.allStockData();
		this.jqeuryrun();
	},
	methods: {
		allStockData() {
			axios.get("Get-All-Stock").then(res => {
				let $data = res.data;
				this.allStocks = $data;
				let $qty = null;
				let $value = null;
				$data.forEach(element => {
					$qty += Number(element.stock_qty);
					$value += Number(element.stock_value);
					this.sumTotalQty = Number($qty);
					this.sumTotalValue = Number($value);
				});
			});
		},
		jqeuryrun() {
			$(document).ready(function() {
				$("#example").DataTable();
			});
		}
	}
};
</script>

<style scoped>
thead tr {
	background: #016dc8;
	color: white;
	text-align: center;
}
tbody tr td {
	text-align: center;
}
tbody {
	font-weight: 400;
}
table.dataTable tfoot th {
	border-top: 1px solid #000;
	border-bottom: 1px solid #000;
	border-right: 1px solid #ccc6c6;
}
table.dataTable tfoot th:nth-child(1) {
	border-left: 1px solid #ccc6c6;
}
</style>
