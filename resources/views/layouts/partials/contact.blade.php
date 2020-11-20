@extends('main')

@section('content')
<section class="">
    <div class="row d-flex justify-content-center py-3">
        <h1 class="display-3">Contact</h1>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-9">
            <div class="row d-flex justify-content-between">
                <div class="card shadow" style="width: 18rem;">
                    <img class="card-img-top" src="/img/jason.jpg" alt="Card image cap" style="height: 20vw; width: 100%; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Jason Ling</h5>
                        <p class="card-text">MSc Data Science graduate with an interest in Machine Learning, Cloud Computing and Artifial Intelligence</p>
                        <a href="https://www.linkedin.com/in/jasonling1995/" class="btn btn-primary shadow" target="_">LinkedIn</a>
                    </div>
                </div>
                <div class="card shadow" style="width: 18rem;">
                    <img class="card-img-top" src="/img/jason.jpg" alt="Card image cap" style="height: 20vw; width: 100%; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Wan Ahmad Luqman</h5>
                        <p class="card-text">MSc Data Science student from Universiti Teknologi Malaysia</p>
                        <a href="#" class="btn btn-primary shadow" target="_">LinkedIn</a>
                    </div>
                </div>
                <div class="card shadow" style="width: 18rem;">
                    <img class="card-img-top" src="/img/nurnadia.jpeg" alt="Card image cap" style="height: 20vw; width: 100%; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Nurnadia binti Khairul Anuar</h5>
                        <p class="card-text">MSc Data Science student from Universiti Teknologi Malaysia</p>
                        <a href="#" class="btn btn-primary shadow" target="_">LinkedIn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
