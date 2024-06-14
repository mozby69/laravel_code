<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">CRUD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FACE-API</a>
                </li>
                <li class="nav-item">
                  
              </li>
            </ul>
        </div>
        <button type="button" class="btn btn-md px-4" data-bs-toggle="modal" data-bs-target="#logout" style="border-radius:1rem;border:1px solid black;"> Logout </button>
    </div>
</nav>











<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Logout</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  
        <h5>Are you sure you want to logout?</h5>
        <div class="container" style="display: flex; flex-direction: column; align-items: center;">

        
       </div>
      

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        @auth  <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger btn-outline-white">Logout</button>
        </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Login</a>
        @endauth

     
      </div>

    </div>
  </div>
</div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>