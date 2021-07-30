<template>
    <div class="row">
        <div class="col-md-7">
            <input class="form-control form-control-lg" type="text" id="form-lg-input" name="search" placeholder="Search..."
            v-on:keyup="getProducts($event.target.value)"/>
            <div class="row py-3">
                <div  v-for="product in products" class="col-md-3 col-6" :key="product.id">
                    <div class="card card-body" v-on:click="addToCart(product)">
                        <img class="img-thumbnail border-0" :src="product.image" alt="" >
                        <div class="card-text">{{ product.name }}</div>
                        <div class="card-footer bg-transparent">${{ (product.price/100).toFixed(2) }}</div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card " style="height:38rem">
            <div class="card-header bg-transparent">Checkout Contents</div>
            <ul class="list-group vh-100 scrollable">
                <li class="list-group-item rounded-0" v-for="item in cartItems" :key="cartItems.indexOf(item)">
                    <div class="row">
                        <div class="col-2">{{ item.id }}</div>
                        <div class="col-7 lead">{{ item.name }}</div>
                        <div class="col-2">${{ (item.price/100).toFixed(2) }}</div>
                        <div class="col-1"  v-on:click="removeItemFromCart(item)"><i class="dripicons-cross"></i></div>
                    </div>
                     
                </li>
            </ul>
            <!--<div class="card-footer bg-transparent"><span class="text-left">Tax:</span><span class="text-right">${{ cartTotal/100 }}</span></div>-->
            <div class="card-footer bg-transparent">
                <button class="btn btn-primary btn-lg btn-block py-4 w-100 p-0" :disabled="cartTotal === 0"
                 data-bs-toggle="modal" data-bs-target=".bs-create-modal-lg">
                    <div class="row">
                        <div class="col-6 text-left">Take payment</div>
                        <div class="col-6 text-right h3"> ${{ (cartTotal/100).toFixed(2) }}</div>
                    </div>
                </button>
                <div class="modal fade bs-create-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body" v-if="!cartChange">
                                <form class="custom-validation" v-on:submit.prevent >
                                    
                                    <div class="row">
                                        <div v-if="errors.length > 0">
                                                <p v-for="error in errors" class="alert alert-danger" :key="error"> {{ error }}</p>
                                        </div>
                                        <div class="col-12 mb-5">
                                            <span class="text-left h2">Total amount due</span>
                                            <span class="text-left h2">${{ (cartTotal/100).toFixed(2) }}</span>
                                        </div>
                                        <div class="col-12 mb-5">
                                            <span class="h2">Amount tendered by customer</span>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <div class="card">
                                                <div class="input-group  input-group-lg">
                                                    <div class="input-group-text">$</div>
                                                    <input type="number" class="form-control" name="amount" id="amount" step=".01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <div class="card">
                                                <input type="button" class="btn btn-primary btn-lg" 
                                                :value="`$${(cartTotal/100).toFixed(2)}`" @click="takeSetMoney($event, cartTotal)" />
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <div class="card">
                                                <input type="button" class="btn btn-primary btn-lg" 
                                                :value="`$${(roundedNumber()/100).toFixed(2)}`" @click="takeSetMoney($event, roundedNumber())" /> 
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <div class="card">
                                                <input type="button" class="btn btn-primary btn-lg" 
                                                :value="`$${(roundedNumber2()/100).toFixed(2)}`" @click="takeSetMoney($event, roundedNumber2())" />                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1 btn-lg" @click="takeMoney($event)">Charge </button>
                                        <button type="reset" class="btn btn-secondary btn-lg" data-bs-dismiss="modal" @click="removeErrs()">Cancel</button>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-body" v-else>
                                <form action="">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h1>Change ${{ changeAmount }}</h1>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1 btn-lg"  data-bs-dismiss="modal" @click="confirmSale($event)">Confirm </button>
                                        <button type="reset" class="btn btn-secondary btn-lg" data-bs-dismiss="modal" @click="removeErrs()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getProducts('default');
            this.cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
            this.cartTotal = localStorage.getItem('cartTotal') ? JSON.parse(localStorage.getItem('cartTotal')) : 0;
            this.manualAmount = document.getElementById("amount").value;
            this.authUser = document.getElementById("auth_user").value;


        },
        data() {
            return {
                products: [],
                cartItems: [],
                cartTotal: 0,
                errors: [],
                cartChange: false,
                changeAmount: 0,
                manualAmount: 0,
                authUser: null,
            
            }
        },
        methods: {
            async getProducts(term) {
                let searchTerm = (term.length >= 2) ? term : 'default';
                let authUser = document.getElementById("auth_user").value;
                try {
                    const response = await fetch(`/api/search/${searchTerm}/${authUser}`);
                    this.products = await response.json(); 
                } catch(err) {
                    console.log(err);
                }           
            },
            async addToCart(cartItem) {
                this.cartItems.push(cartItem);
                this.cartTotal += cartItem.price;
                this.prepCart();
                
            },
            async removeItemFromCart(cartItem) {
                let index = this.cartItems.indexOf(cartItem);
                this.cartTotal -= cartItem.price;
                this.cartItems.splice(index, 1);
                this.prepCart();
            },
            async prepCart() {
                localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
                localStorage.setItem('cartTotal', JSON.stringify(this.cartTotal));
                if (this.cartTotal < 0) {
                    this.cartTotal = 0;
                }
            },
            roundedNumber() {
                let devisor = 100;

                if(this.cartTotal > 100000) {
                     devisor = 1000;
                } else if (this.cartTotal > 10000){
                     devisor = 1000;
                } else if (this.cartTotal > 1000){
                     devisor = 1000;
                 }else if (this.cartTotal > 100){
                     devisor = 100;
                }else if (this.cartTotal > 10){
                     devisor = 10;
                }else if (this.cartTotal > 1){
                     devisor = 1;
                }
                return Math.ceil(this.cartTotal/devisor)* devisor;
            },
            roundedNumber2() {
                let devisor = 1000;

                if(this.cartTotal > 100000) {
                     devisor = 10000;
                } else if (this.cartTotal > 10000){
                     devisor = 10000;
                } else if (this.cartTotal > 1000){
                     devisor = 10000;
                 }else if (this.cartTotal > 100){
                     devisor = 1000;
                }else if (this.cartTotal > 10){
                     devisor = 1000;
                }else if (this.cartTotal > 1){
                     devisor = 10;
                }

                return Math.ceil(this.cartTotal/devisor)* devisor;
            },
            takeSetMoney(e, tendered=null) {
                e.preventDefault();
                if (!tendered) {
                    this.errors.push('Amount is required.');
                }

                this.cartChange = true;
                this.changeAmount = `${((tendered - this.cartTotal)/100).toFixed(2)}`;

                console.log(`Change is ${((tendered - this.cartTotal)/100).toFixed(2)}`);

            },
            takeMoney(e) {
                e.preventDefault();
                let amount =  parseInt((document.getElementById('amount').value) * 100);

                if (!amount) {
                    this.errors.push('Amount is required.');
                    return;
                }
                if (amount < this.cartTotal) {
                    this.errors.push('Amount tendered is insufficient.');
                    return;
                }

                this.takeSetMoney(e, amount);
                console.log(this.cartTotal);
            },
            async confirmSale(e) {
                e.preventDefault();
                 await fetch('/api/confirm', {
                    method: "POST", 
                    body: JSON.stringify({items: localStorage.getItem('cartItems'), authUser: this.authUser})
                }).then(res => {
                    console.log(res);
                    this.cartItems = [];
                    this.cartTotal = 0;
                    localStorage.removeItem('cartItems');
                    localStorage.removeItem('cartTotal');
                    this.removeErrs();
                }).catch(err => {
                    console.log(err);
                });
            },
            removeErrs() {
                this.errors = [];
                this.cartChange = false;
            }
            
        }

    }
</script>

<style scoped>
.scrollable {
  height:150px;
  overflow-y: scroll;
}
</style>
