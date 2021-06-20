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
						<h4 class="card-title m-0 pt-2">Print Barcode</h4>
						<a href="" class="btn btn-info px-3">
							<i class="fa fa-plus pr-1 font-weight-lighter"></i>
							List Barcode
						</a>
						<!-- <p class="card-category">Manage customer page</p> -->
					</div>
					<div class="card-body mt-4">
						<form @submit.prevent="printBarcode">
							<div class="form-row justify-content-center">
								<div class="col-md-3 form-group">
									<label for="">Product Code</label>
									<input type="text" class="form-control" v-model="form.value" />
								</div>
								<div class="col-md-3 form-group">
									<label for="">Number of Barcode</label>
									<input type="text" class="form-control" v-model="form.number" />
								</div>
								<div class="col-md-2 text-center">
									<button class="btn btn-primary btn-sm ms-2">Generate</button>
								</div>
							</div>
						</form>
						<div class="row">
							<div v-for="(number, index) in printNumber" :key="index" class="col">
								<barcode v-bind:value="barcodeValue" :height="height"></barcode>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import VueBarcode from "vue-barcode";
export default {
	name: "Barcode",
	components: {
		barcode: VueBarcode
	},
	data: () => ({
		form: new Form({
			value: "",
			number: ""
		}),
		barcodeValue: "",
		// format: "CODE128A",
		format: "ean13",
		flat: true,
		height: 80,
		printNumber: []
	}),
	methods: {
		printBarcode() {
			this.barcodeValue = this.form.value;
			this.printNumber = [];
			let i = 0;
			for (i; i < this.form.number; i++) {
				this.printNumber.push(i);
			}
		}
	}
};
</script>
