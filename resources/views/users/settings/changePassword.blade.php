@extends('layout.UserMatser')

@section('content')


						<div class="row">
						
                            
							
							<div class="col-md-6 grid-margin stretch-card">
								<div class="card">
									<div class="card-body">
						
										<h6 class="card-title">Change Password</h6>
						
										<form id="changePasswordForm" action="" enctype="multipart/form-data" method="POST">
											<div class="form-group">
												<label for="current_password">Current Password</label>
												<input type="password" name="current_password" class="form-control" required="">
																	</div>
											<br>
											<div class="form-group">
												<label for="new_password">New Password</label>
												<input type="password"  name="new_password" class="form-control" required="">
																	</div>
											<br>
											<div class="form-group">
												<label for="confirm_password">Confirm New Password</label>
												<input type="password"  name="confirm_password" class="form-control" required="">
																	</div>
											<br>
						
						  
						
						
						
											<button type="button"  class="btn btn-primary">Change Password</button>
										</form>
						
										
						
						
						
									</div>
								</div>
							</div>
	
						
						</div>
	
@endsection