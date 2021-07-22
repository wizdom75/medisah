<template>
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
                        <div class="modal-body">
                            <form class="custom-validation" action=" " method="POST">
                                
                                <div class="row">
                                    <div class="col-12 mb-5">
                                        <span class="text-left h2">Total amount due</span>
                                        <span class="text-right h2">${{ (cartTotal/100).toFixed(2) }}</span>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <span class="h2">Amount tendered by customer</span>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <div class="card">
                                            <div class="input-group  input-group-lg">
                                                <div class="input-group-text">$</div>
                                                <input type="text" class="form-control" id="amount" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <div class="card">
                                            <button class="btn btn-primary btn-lg" :value="(cartTotal/100).toFixed(2)"> ${{ (cartTotal/100).toFixed(2) }}</button>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <div class="card">
                                            <button class="btn btn-primary btn-lg" value="320.00"> $320.00</button>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <div class="card">
                                            <button class="btn btn-primary btn-lg" value="350.00"> $350.00</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1 btn-lg">Confirm </button>
                                    <button type="reset" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
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
</template>

<script>
    export default {
        mounted() {
            this.cartItems = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
            this.cartTotal = localStorage.getItem('cartTotal') ? JSON.parse(localStorage.getItem('cartTotal')) : 0;
        },
        data() {
            return {
                cartItems: [],
                cartTotal: 0,
            
            }
        },
        methods: {
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
            }
        }
    }
</script>
