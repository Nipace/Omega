@extends('layouts.app')
@section('title')
Dashboard | Omega Secondary School
@endsection
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        
        <div class="row mt-3">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">New Students</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($new_students as $n)
                                    <tr>
                                        <th scope="row">
                                            {{$n->name}}
                                        </th>
                                        <td>
                                            {{$n->email}}
                                        </td>
                                        <td>
                                            @if($n->is_password_reset == "1")
                                            <i class="fas fa-arrow-up text-success mr-3">
                                            @else
                                            <i class="fas fa-arrow-down text-danger mr-3">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Recent Books</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Author</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($new_books as $b)
                                <tr>
                                    <th scope="row">
                                        {{$b->book_name}}
                                    </th>
                                    <td>
                                        {{$b->author}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush