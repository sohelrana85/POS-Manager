require("./bootstrap");

import store from "./store/index";

window.Vue = require("vue").default;

//Vform import
import Form from "vform";
//vform globally register
window.Form = Form;
import { Button, HasError } from "vform/src/components/bootstrap5";
// 'vform/src/components/bootstrap4'
// 'vform/src/components/tailwind'

Vue.component(Button.name, Button);
Vue.component(HasError.name, HasError);

//Sweet alert
import Swal from "sweetalert2";
window.Swal = Swal;

//Toastr
import toastr from "toastr";
window.toastr = toastr;

//globally import pagination
Vue.component("pagination", require("laravel-vue-pagination"));

//globally import components
Vue.component(
    "customer",
    require("./components/customer/Customer.vue").default
);

Vue.component("UnitType", require("./components/product/UnitType.vue").default);
Vue.component(
    "PackageSize",
    require("./components/product/PackageSize.vue").default
);
Vue.component(
    "PaymentType",
    require("./components/setting/PaymentType.vue").default
);
Vue.component(
    "BusinessSetting",
    require("./components/setting/BusinessSetting.vue").default
);
Vue.component("Category", require("./components/product/Category.vue").default);
Vue.component("Brand", require("./components/product/Brand.vue").default);

Vue.component(
    "ManageSupplier",
    require("./components/supplier/ManageSupplier.vue").default
);

Vue.component(
    "AddProduct",
    require("./components/product/AddProduct.vue").default
);
Vue.component(
    "ManageProduct",
    require("./components/product/ManageProduct.vue").default
);
Vue.component(
    "ProductPurchase",
    require("./components/purchase/ProductPurchase.vue").default
);
Vue.component(
    "ManagePurchase",
    require("./components/purchase/ManagePurchase.vue").default
);
Vue.component("AddStock", require("./components/stock/AddStock.vue").default);
Vue.component(
    "ManageStock",
    require("./components/stock/ManageStock.vue").default
);
Vue.component(
    "ProductSell",
    require("./components/sell/ProductSell.vue").default
);
Vue.component(
    "ManageSell",
    require("./components/sell/ManageSell.vue").default
);
Vue.component(
    "ManageType",
    require("./components/expense/ManageType.vue").default
);
Vue.component(
    "ManageExpense",
    require("./components/expense/ManageExpense.vue").default
);

const app = new Vue({
    el: "#app",
    store,
    component: {
        customer
    }
});
