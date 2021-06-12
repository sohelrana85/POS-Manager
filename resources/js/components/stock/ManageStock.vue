<template>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table id="example" class="display nowrap text-center" style="width: 100%">
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
								<td>{{ stock.product_name }}</td>
								<td>{{ stock.product_code }}</td>
								<td>{{ stock.stock_qty }}</td>
								<td>{{ stock.stock_value }}</td>
							</tr>
						</tbody>
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
		allStocks: ""
	}),
	computed: {},
	mounted() {
		this.allStockData();
	},
	methods: {
		allStockData() {
			axios.get("Get-All-Stock").then(res => {
				this.allStocks = res.data.stock;
			});
		}
	}
};
</script>

<style scoped>
</style>
