@extends('layout.UserMatser')

@section('content')


						<div class="input-group">
							<input id="myInput" onkeyup="myFunction()" type="search" placeholder="Search for Product Name..." class="form-control">
							<div class="input-group-append">
							  <button class="btn btn-secondary" type="button">Search</button>
							</div>
						  </div>
                            <br>		


						
								
										  


						<div class="row">

							@foreach ($items as $item)
							<div class="col-xl-3">
								<div class="card">
									<div class="position-relative img-overlay">
										<img src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}"
										 alt="" height="150" width="100%" class="object-fit-cover">
									</div>
									<div class="card-body">
										<div class="text-center">
											<div class="pt-4">
												<h4 class="mb-1"> {{ $item->title[app()->getLocale()] }}</h4>
												<p class="mb-2">Price: <strong>€ {{ $item->total_price }}</strong></p>
											</div>
											<ul class="d-flex justify-content-around list-unstyled border-top border-dark-subtle pt-2 text-center mb-0">
												<li>
													<button type="button" data-bs-toggle="modal"data-bs-target="#exampleModal-{{$item->id}}"
													 class="btn btn-primary"><i class="ri bi-cart-fill"></i></button>

													<a href="{{route('user.wishlist.index')}}" class="btn btn-light ml-2"><i class="ri bi-heart-fill"></i></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>

									<!--Model-->
					<div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 id="modalTitle" class="modal-title title">{{ $item->title[app()->getLocale()] }}</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body p-0">
									<div class="card shadow border-0">
										<div class="card-body px-lg-5 py-lg-5">
											<div class="row">
												<div class="col-lg-6 text-center" id="modalImgPart">
													<img id="modalImg" src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}"
													 class="img-fluid image " alt=" Image Not Found">
												</div>
												<div class="col-lg-6" id="modalItemDetailsPart">
													<input id="modalID" type="hidden">
													<div id="modalItemDetailsPart">
														<input id="modalID" type="hidden">
														<br>
														<h5 id="modalDescription"><strong>Description</strong> </h5>
														<p class="description">{{ $item->description[app()->getLocale()] }}</p>
														<br>
				
														<ul class="list-group">
															<li class="list-group-item ">Unit  : {{$item->unit[app()->getLocale()]}} <span class="unit"></span></li>
															<li class="list-group-item ">Unit Price : €{{ number_format($item->total_price, 2, ',', '.') }} <span
																	class="total badge bg-primary"></span></li>
															
														</ul>
														<br>
														<div class="quantity-area">
															<div class="form-group">
																<label style="color: goldenrod" class="form-control-label"
																	for="quantity">Quantity</label>
																<form method="POST" id="" action="">
																	
																	<input type="number" name="quantity" id="quantity"
																		class="form-control form-control-alternative" min="1"
																		name="quantity" placeholder="1" value="1" required autofocus>
																	<input placeholder="item id" type="hidden" name="item_id"
																		value="" />
																</form>
															</div>
															<br>
															<div class="quantity-btn">
																<button data-bs-toggle="offcanvas" data-bs-target="#cartSideNav" type="submit" id="secondButton" 
																	class="btn btn-primary ">Add To Cart</button>
															</div>
				
														</div>
														<!-- Inform if closed -->
														<!-- End inform -->
													</div>
													<!-- Inform if closed -->
													<!-- End inform -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					@endforeach	

							</div>

					
							
	

				
							


					
							
	
					
							
	
	
						
					



<!-- Second Button and Offcanvas Modal -->

  
  <script>
	document.getElementById("secondButton").click();

  </script> 
    
@endsection