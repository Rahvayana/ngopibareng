@extends('layout')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Update Profile</h3>
  
                  <div class="card-tools">
                   
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form>
                        <div class="card-body">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" disabled value="{{$user->name}}" id="name" name="name" placeholder="Enter Name">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" disabled id="email" value="{{$user->email}}" name="email" placeholder="Enter Email">
                          </div>
                          <div class="form-group">
                            <label for="birth">Birth Date</label>
                            <input type="date" class="form-control" disabled value="{{date('Y-m-d',strtotime($user->birth))}}" name="birth" id="birth">
                          </div>
                          <div class="form-group">
                            <label for="Gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" disabled>
                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" disabled value="{{$user->address}}" name="address" id="address" placeholder="Address">
                          </div>
                          <div class="form-group">
                            <label for="address">Role</label>
                            <select name="role" id="role" class="form-control" disabled>
                                <option value="1">User</option>
                                <option value="2">Moderator</option>
                                <option value="3">Admin</option>
                            </select>
                          </div>
                        <!-- /.card-body -->
    
                      </form>
                </div>
                <!-- /.card-body -->
            </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
@endsection