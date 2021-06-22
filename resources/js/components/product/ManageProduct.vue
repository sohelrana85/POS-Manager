<template>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>sl</th>
						<th>Product Name</th>
						<th>product Code</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Type</th>
						<th>Size</th>
						<th>Price</th>
						<th>VAT</th>
						<!-- <th>Status</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr
						v-for="(product, index) in Products.data"
						:key="index"
						:class="product.status == 1 ? 'disabled' : ''"
					>
						<td>{{ product.id }}</td>
						<td>{{ product.product_name }}</td>
						<td>{{ product.product_code }}</td>
						<td>{{ product.category.name }}</td>
						<td>{{ product.brand.name }}</td>
						<td>{{ product.unit.name }}</td>
						<td>{{ product.package.name }}</td>
						<td>
							{{ product.unit_selling_price }}
						</td>
						<td>{{ product.vat }}</td>
						<!-- <td>
							{{ product.status == 1 ? "Active" : "Inactive" }}
						</td> -->
						<td class="td-actions">
							<!-- <button type="button" class="btn btn-info">
							<i class="material-icons">person</i>
						</button> -->
							<button type="button" class="btn btn-success">
								<i class="material-icons">edit</i>
							</button>
							<button
								type="button"
								class="btn btn-danger"
								@click="deleteItem(product.id)"
							>
								<i class="material-icons">close</i>
							</button>
						</td>
					</tr>
					<tr v-if="!length">
						<td colspan="17">
							<h4 class="text-center p-4">No Record Founded!</h4>
						</td>
					</tr>
				</tbody>
			</table>
			<pagination
				align="right"
				:limit="2"
				:data="Products"
				@pagination-change-page="loadProducts"
			></pagination>
		</div>
	</div>
</template>

<script>
import Form from "vform";
import { Button, HasError, AlertError } from "vform/src/components/bootstrap5";
import axios from "axios";
export default {
	name: "ManageProduct",
	components: {
		Button,
		HasError,
		AlertError
	},
	data: () => ({
		form: new Form({}),
		display: true,
		Products: {}
	}),
	// computed: {
	// 	Products() {
	// 		return this.$store.getters.getAllProduct;
	// 	}
	// },
	mounted() {
		this.loadProducts();
	},
	methods: {
		length() {
			if (this.Products.length > 0) {
				return true;
			} else {
				return false;
			}
		},
		loadProducts(page = 1) {
			axios.get("loadProducts?page=" + page).then(res => {
				this.Products = res.data;
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
					axios.delete("Products/" + id).then(res => {
						if (res.data.status == 1) {
							Swal.fire("Deleted!", "Your file has been deleted.", "success");
							this.loadProducts(this.Products.current_page);
						} else {
							toastr.error(res.data.message);
						}
					});
				}
			});
		}

		// addToStock(id) {
		//     axios.post("add-to-stock/" + id).then(res => {
		//         if (res.data.status == 0) {
		//             Swal.fire({
		//                 icon: "error",
		//                 title: "Oops...",
		//                 text: res.data.message
		//             });
		//         } else {
		//             Toast.fire({
		//                 icon: "success",
		//                 title: res.data.message
		//             });
		//             this.$store.dispatch("loadAllProduct");
		//         }
		//     });
		// }
	},
	watch: {}
};
</script>

<style scoped>
.disabled {
	background-color: #252525;
	pointer-events: none;
	color: #008000;
}
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
</style>
