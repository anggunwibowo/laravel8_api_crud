<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Dashboard</h3>
                </div>
                <div class="card-body">
                    <h5>Selamat datang di halaman dashboard, <strong>{{ Auth::user()->name }}</strong></h5>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>


                    <h2>List Users</h2>
                    <p>Menampilkan Semua Data Pengguna :</p>                                                                                 
  
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Position</th>         
                        </tr>
                      </thead>
                      <tbody>
                         <?php $i = 1;
                            if (count($data) > 0) {
                            ?>
                            @foreach($data as $key => $value)         
                                <tr>
                                  <td style="text-align: center;">{{ $key + $data->firstItem() }}</td>
                                  <td> {{$value->name}}</td>
                                  <td> {{$value->email}}</td>
                                  <td> {{$value->status}}</td>
                                  <td> {{$value->position}}</td>      
                                </tr>
                            @endforeach
                        <?php } else { ?>
                        <tr><td colspan="5" style="text-align: center;">Data not found</td></tr><?php } ?>
                      </tbody>
                    </table>
                  </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
