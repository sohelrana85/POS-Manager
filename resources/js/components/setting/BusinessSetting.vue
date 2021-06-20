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
						<h4 class="card-title m-0 pt-2">Business Setting</h4>
					</div>
					<div class="card-body mt-3">
						<form v-if="!isUploaded" @submit.prevent="saveBusiness">
							<div class="form-row">
								<div class="form-group col-md-5">
									<label for="business_name">Business Name *</label>
									<input type="text" class="form-control" v-model="form.business_name" />
									<HasError :form="form" field="business_name" />
								</div>
								<div class="form-group col-md-7">
									<label for="business_address">Business Address *</label>
									<input
										type="text"
										class="form-control"
										v-model="form.business_address"
									/>
									<HasError :form="form" field="business_address" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-4">
									<label for="country">Country *</label>
									<input type="text" class="form-control" v-model="form.country" />
									<HasError :form="form" field="country" />
								</div>
								<div class="form-group col-md-4">
									<label for="city">City *</label>
									<input type="text" class="form-control" v-model="form.city" />
									<HasError :form="form" field="city" />
								</div>
								<div class="form-group col-md-4">
									<label for="mobile">Mobile (11 digit) *</label>
									<input type="text" class="form-control" v-model="form.mobile" />
									<HasError :form="form" field="mobile" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-6">
									<label for="email">Email</label>
									<input type="text" class="form-control" v-model="form.email" />
									<HasError :form="form" field="email" />
								</div>
								<div class="form-group col-md-6">
									<label for="website">Website</label>
									<input type="text" class="form-control" v-model="form.website" />
									<HasError :form="form" field="website" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-4">
									<label for="start_date">Start Date *</label>
									<input type="date" class="form-control" v-model="form.start_date" />
									<HasError :form="form" field="start_date" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="currency" class="ps-0">Currency *</label>
									<select
										class="form-control"
										v-model="form.currency"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="bdt">BDT</option>
										<option value="usd">USD</option>
										<option value="others">Others</option>
									</select>
									<HasError :form="form" field="currency" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="currency_symbol" class="ps-0">Currency Symbol *</label>
									<select
										class="form-control"
										v-model="form.currency_symbol"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="sign">&#2547;</option>
										<option value="bdt">BDT</option>
									</select>
									<HasError :form="form" field="currency_symbol" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div
									class="form-group form-file-upload form-file-multiple col-md-4"
									style="margin-top: -16px"
								>
									<label for="upload_logo" class="mb-0"
										>Upload Logo (<small>min: w 260 x h 70</small>) *</label
									>
									<input
										type="file"
										id="upload_logo"
										name="upload_logo"
										class="form-control"
										@change="onFileSelected"
									/>
									<HasError :form="form" field="upload_logo" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="date_format" class="ps-0">Date Format *</label>
									<select
										class="form-control"
										v-model="form.date_format"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="yyyy-mm-dd">yyyy-mm-dd</option>
										<option value="mm-dd-yyyy">mm-dd-yyyy</option>
										<option value="mm/dd/yyyy">mm/dd/yyyy</option>
									</select>
									<HasError :form="form" field="date_format" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="time_format" class="ps-0">Time Format *</label>
									<select
										class="form-control"
										v-model="form.time_format"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="12">12 Hours</option>
										<option value="24">24 Hours</option>
									</select>
									<HasError :form="form" field="time_format" />
								</div>
							</div>

							<div class="text-right pt-3">
								<button type="reset" class="btn btn-warning">Clear</button>
								<button type="submit" class="btn btn-info" :disabled="form.busy">
									Add Setting
								</button>
							</div>
						</form>
						<form v-else @submit.prevent="updateBusiness">
							<div class="form-row">
								<div class="form-group col-md-5">
									<label for="business_name">Business Name *</label>
									<input type="text" class="form-control" v-model="form.business_name" />
									<HasError :form="form" field="business_name" />
								</div>
								<div class="form-group col-md-7">
									<label for="business_address">Business Address *</label>
									<input
										type="text"
										class="form-control"
										v-model="form.business_address"
									/>
									<HasError :form="form" field="business_address" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-4">
									<label for="country">Country *</label>
									<input type="text" class="form-control" v-model="form.country" />
									<HasError :form="form" field="country" />
								</div>
								<div class="form-group col-md-4">
									<label for="city">City *</label>
									<input type="text" class="form-control" v-model="form.city" />
									<HasError :form="form" field="city" />
								</div>
								<div class="form-group col-md-4">
									<label for="mobile">Mobile (11 digit) *</label>
									<input type="text" class="form-control" v-model="form.mobile" />
									<HasError :form="form" field="mobile" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-6">
									<label for="email">Email</label>
									<input type="text" class="form-control" v-model="form.email" />
									<HasError :form="form" field="email" />
								</div>
								<div class="form-group col-md-6">
									<label for="website">Website</label>
									<input type="text" class="form-control" v-model="form.website" />
									<HasError :form="form" field="website" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div class="form-group col-md-4">
									<label for="start_date">Start Date *</label>
									<input type="date" class="form-control" v-model="form.start_date" />
									<HasError :form="form" field="start_date" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="currency" class="ps-0">Currency *</label>
									<select
										class="form-control"
										v-model="form.currency"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="bdt">BDT</option>
										<option value="usd">USD</option>
										<option value="others">Others</option>
									</select>
									<HasError :form="form" field="currency" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="currency_symbol" class="ps-0">Currency Symbol *</label>
									<select
										class="form-control"
										v-model="form.currency_symbol"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="sign">&#2547;</option>
										<option value="bdt">BDT</option>
									</select>
									<HasError :form="form" field="currency_symbol" />
								</div>
							</div>
							<div class="form-row mt-3">
								<div
									class="form-group form-file-upload form-file-multiple col-md-4"
									style="margin-top: -16px"
								>
									<label for="upload_logo" class="mb-0"
										>Upload Logo (<small>min: w 260 x h 70</small>) *</label
									>
									<input
										type="file"
										id="upload_logo"
										name="upload_logo"
										class="form-control"
										@change="onFileSelected"
									/>
									<HasError :form="form" field="upload_logo" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="date_format" class="ps-0">Date Format *</label>
									<select
										class="form-control"
										v-model="form.date_format"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="yyyy-mm-dd">yyyy-mm-dd</option>
										<option value="mm-dd-yyyy">mm-dd-yyyy</option>
										<option value="mm/dd/yyyy">mm/dd/yyyy</option>
									</select>
									<HasError :form="form" field="date_format" />
								</div>
								<div class="form-group col-md-4" style="margin-top: -7px">
									<label for="time_format" class="ps-0">Time Format *</label>
									<select
										class="form-control"
										v-model="form.time_format"
										style="margin-top: -15px"
									>
										<option value="">Select</option>
										<option value="12">12 Hours</option>
										<option value="24">24 Hours</option>
									</select>
									<HasError :form="form" field="time_format" />
								</div>
							</div>

							<div class="text-right pt-3">
								<button type="reset" class="btn btn-warning">Clear</button>
								<button type="submit" class="btn btn-info" :disabled="form.busy">
									Update Setting
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";
export default {
	name: "BusinessSetting",
	data: () => ({
		form: new Form({
			id: "",
			business_name: "",
			business_address: "",
			country: "",
			city: "",
			mobile: "",
			email: "",
			website: "",
			start_date: "",
			currency: "",
			currency_symbol: "",
			upload_logo: "",
			date_format: "",
			time_format: ""
		}),
		isUploaded: false
	}),
	mounted() {
		this.getData();
	},
	methods: {
		onFileSelected(event) {
			this.form.upload_logo = event.target.files[0];
			console.log(event.target.files[0]);
		},
		saveBusiness() {
			this.form.post("Save-Business-Setting").then(res => {
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.clearForm();
					this.getData();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		updateBusiness() {
			this.form.post("Update-Business-Setting").then(res => {
				console.log(res);
				if (res.data.status == 1) {
					toastr.success(res.data.message);
					this.getData();
				} else {
					toastr.error(res.data.message);
				}
			});
		},
		getData() {
			axios.get("Get-Business-Setting").then(res => {
				// console.log(res.data.bs.length);
				if (res.data.bs.length) {
					this.isUploaded = true;
					this.loadForm(res.data.bs);
				} else {
					console.log("no data have");
				}
			});
		},
		clearForm() {
			this.form.business_name = "";
			this.form.business_address = "";
			this.form.country = "";
			this.form.city = "";
			this.form.mobile = "";
			this.form.email = "";
			this.form.website = "";
			this.form.start_date = "";
			this.form.currency = "";
			this.form.currency_symbol = "";
			this.form.upload_logo = "";
			this.form.date_format = "";
			this.form.time_format = "";
		},
		loadForm(data) {
			console.log(data);
			this.form.id = data[0].id;
			this.form.business_name = data[0].business_name;
			this.form.business_address = data[0].address;
			this.form.country = data[0].country;
			this.form.city = data[0].city;
			this.form.mobile = data[0].mobile;
			this.form.email = data[0].email;
			this.form.website = data[0].website;
			this.form.start_date = data[0].start_date;
			this.form.currency = data[0].currency;
			this.form.currency_symbol = data[0].currency_symbol;
			// this.form.upload_logo = data[0].logo;
			this.form.date_format = data[0].date_format;
			this.form.time_format = data[0].time_format;
		}
	},
	watch: {}
};
</script>
