		<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle arrow-none" href="#">
									<i data-bs-toggle="offcanvas" data-bs-target="#cartSideNav" id="secondButton" class="ri-shopping-cart-line fs-22"></i>
									<span class="noti-icon-badge badge text-bg-danger">4</span>

								
							</a>
						</li>
						
						<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSideNav" aria-labelledby="cartSideNavLabel">
							<div class="offcanvas-header">
								<h4 class="offcanvas-title" id="cartSideNavLabel">Shopping Cart</h4>
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<div class="minicart-content">
									
									<div class="cart-items">
										<div class="items">
											<div class="cart-item">
												<div class="row">

													<div class="col-auto">
														<img src="https://foodtiger.mobidonia.com/uploads/restorants/c0895e35-f4f9-4113-96d7-ecae6d27ed2b_thumbnail.jpg" width="80" height="80" alt="" class="productImage">
													</div>
													<div class="col">
														<h6 class="product-item_title">Burrito with beef roast</h6>
														<p class="product-item_quantity">1 x €8.49</p>
													</div>
													<div class="col-auto">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-success btn-sm">
																<i class="ri bi-dash-circle-fill"></i>
															</button>
															<button type="button" class="btn btn-success btn-sm">
																<i class="ri bi-plus-circle-fill"></i>
															</button>
															<button type="button" class="btn btn-danger btn-sm">
																<i class="ri bi-trash-fill"></i>
															</button>
														</div>
													</div>
													<hr>
													<!-- New item -->
													<div class="col-auto">
														<img src="https://foodtiger.mobidonia.com/uploads/restorants/c0895e35-f4f9-4113-96d7-ecae6d27ed2b_thumbnail.jpg" width="80" height="80" alt="" class="productImage">
													</div>
													<div class="col">
														<h6 class="product-item_title">New Item Title</h6>
														<p class="product-item_quantity">1 x €X.XX</p>
													</div>
													<div class="col-auto">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-success btn-sm">
																<i class="ri bi-dash-circle-fill"></i>
															</button>
															<button type="button" class="btn btn-success btn-sm">
																<i class="ri bi-plus-circle-fill"></i>
															</button>
															<button type="button" class="btn btn-danger btn-sm">
																<i class="ri bi-trash-fill"></i>
															</button>
														</div>
													</div>

												</div>
											</div>
										</div>
										<!-- Add more product items here -->
									</div>
								</div>
								<hr>
								<div class="cart-footer py-3 px-4">
									<div class="card border-0 shadow-sm mb-4">
										<div class="card-body py-4" style="background-color:#dadee2">
											<h5 class="card-title text-center mb-0">Subtotal: €998,00</h5>
										</div>
									</div>
									
									<a href="{{route('user.cart.index')}}" class="btn btn-primary btn-block"
                                            style="width:100%;font-size:15px;">Check Out</a>

									

								</div>
								
							</div>
						</div>