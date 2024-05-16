@extends('layout.UserMatser')
@section('content')

<div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Orders</h4>
										<form action method="POST" enctype="multipart/form-data">
											<a href="#" type="button" class="btn btn-secondary">Export Orders</a> 
											
											</form>
                                    </div>
                                    
                                    <div class="card-body">
										<input id="myInput" onkeyup="myFunction()" type="search" placeholder="search For Order Code  ..." class="form-control"/>

                                        <br>
                                        <div class="table-responsive-sm">
                                            <table id="myTable" class="table table-centered mb-0">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th># Order Code</th>
														<th>Customer</th>
														<th>Phone</th>
														<th>Status</th>
														<th></th>
														<th>Total Price</th>
                                                        <th>Date Purchased </th>
														<th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    <tr style="background-color: #fcdfa8">
														
														<td><strong>ODR20240573</strong>	</td>
														<td>Mohammed Jameel</td>
														<td>0599094210</td>
														<td><span class="badge bg-warning rounded-pill">Pending</span></td>
														<td>
                                                    <div class="spinner-grow text-warning m-2" role="status"></div>
                                                    </td>
                                                        <td>1815 $</td>
                                                        <td>2 days ago</td>
														<td>
															<a href="{{route('user.orderDetails.index')}}" class="text-reset fs-16 px-1">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            
															
                                                            
														</td>
													</tr>


                                                    <tr style="background-color: #cfe8da">
														
														<td><strong>ODR20240533</strong></td>
														<td>Mohammed Ali</td>
														<td>0599094210</td>
														<td><span class="badge bg-success rounded-pill">Shipped</span></td>
														<td>
                                                    </td>
                                                        <td>1815 $</td>
                                                        <td>2 days ago</td>
														<td>
															<a href="javascript:void(0);" class="text-reset fs-16 px-1">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            
															
                                                            
														</td>
													</tr>


                                                    <tr style="background-color: #d9f2f2">
														
														<td><strong>ODR23240573</strong>	</td>
														<td>Mohammed Ali</td>
														<td>0599094210</td>
														<td><span class="badge bg-info rounded-pill">Delivered</span></td>
														<td>
                                                    <div class="spinner-grow text-info m-2" role="status"></div>
                                                    </td>
                                                        <td>1815 $</td>
                                                        <td>2 days ago</td>
														<td>
															<a href="javascript:void(0);" class="text-reset fs-16 px-1">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            
                                                            
														</td>
													</tr>

                                                    <tr style="background-color: #f5b6c6">
														
														<td><strong>ODR25240573</strong>	</td>
														<td>Mohammed Ali</td>
														<td>0599094210</td>
														<td><span class="badge bg-danger rounded-pill">Cancelled</span></td>
														<td>
                                                    </td>
                                                        <td>1815 $</td>
                                                        <td>2 days ago</td>
														<td>
															<a href="javascript:void(0);" class="text-reset fs-16 px-1">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            
															
                                                            
														</td>
													</tr>


                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
    
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div>

						</div>
<script>
			function myFunction() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					tr[i].style.display = "none";
				  }
				}       
			  }
			}
			</script>
	
@endsection