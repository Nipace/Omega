@extends('layouts.app')

@section('title')
E-Library | Omega Secondary School
@endsection
@section('content')
    @include('layouts.headers.cards')
    <div class="loader"></div>
    <div class="container-fluid mt--7">
   <div class="row justify-content-center">
       <div class="col-xl-12 mb-xl-0">
       @include('flash-message')
           <div class="card shadow">
               <div class="card-header border-0">
                   <div class="row align-items-center">
                       <div class="col">
                           <h3 class="mb-0">E-Library</h3>
                       </div>
                     @role('Admin|Teacher')
                       <div class="col text-right">
                           <a href="{{route('library.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add a Book</a>
                       </div>
                      @endrole
                   </div>
                   <div class="row pt-2">
                       <div class="col-md-6">
                           @if (session('status'))
                               <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   {{ session('status') }}
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                           @endif
                       </div>
                   </div>
                   
               </div>

               <div class="container-fluid">
              <div class="row mt-2">
                <div class="col-md-12">
                        <form  method="get" action="/library/search/data">
                                  <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Enter a Book Name to Search">
                                    <span class="input-group-btn">
                                      <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                  </div>
                                  </form>
                      </div>
              </div>
                <div class="row float-right mt-3 mr-2">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Advanced Search
                        </button>
              <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="GET" action="/library/filter/data">  

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advanced Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                                <label class="form-control-label" for="input-grade">Grade</label>
                                                                <select class="form-control" name="grade" id="grade"  required >
                                                                <option value="11" selected >XI</option>
                                                                <option value="12" >XII</option>

                                                                        </select>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group  ">
                                                            <label class="form-control-label" for="input-faculty">Select a Faculty</label>
                                                                <select class="form-control faculty" name="faculty" id="faculty"  required >
                                                                <option value="" selected hidden></option>
                                                                        </select>
                                                        
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 stream">
                                                            <div class="form-group">
                                                            <label class="form-control-label" for="stream">Select a Stream</label>
                                                                <select class="form-control" name="stream" id="stream"   >
                                                                <option value="" selected hidden></option>


                                                                        </select>
                                                      
                                                            </div>
                                                        </div>
                                         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Search</button>
      </div>
      </form>
    </div>
  </div>
</div>
            
                      </div>
                      
                     
                </div>
                <h3 class="pt-4">Found {{$library->count()}} results</h3>
        

                <div class="row mt-5">
                @foreach($library as $l)
          <a href="{{route('library.show',$l->id)}}" target="_blank">
                      <div class="card mx-1 book-card mb-3 mx-2" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset('/images/'.$l->book_thumbnails)}}" alt="Card image cap">
                        <div class="book-card-overlay text-center" style="padding-top:130px;color:white;font-weight:700;">
                        {{$l->book_name}}<br>   
                          
                         <form method="POST" action="{{route('library.destroy',$l->id)}}">@csrf{{method_field('DELETE')}}<button type="submit" class="btn btn-danger mt-3 py-2 px-2" onclick="return confirm('Do you want to delete this book?')"><i class="far fa-trash-alt px-2"></i></button></form>
</div>
</div>
</a>
   

        
                @endforeach

          
                </div>
<!-- /.row -->

<!-- Pagination -->
<!-- <ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#">1</a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#">2</a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#">3</a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
  </li>
</ul> -->

</div>
<!-- /.container -->
                </div>
       </div>
    
   </div>
 
@endsection

@push('js')
<script>
 $(document).ready(function () {              
  $('.faculty').on('change', function() {
                    if( this.value == 2 || this.value== 3 ||this.value== 4 || this.value== 5 ) $('.stream').hide();
                    if( this.value == 0 || this.value== 1) $('.stream').show();
                });
 
    });

               
         
  
var selectableValues = [
	{
  	'title' : 'Science' ,
    'values' : [
   'Physical',
   'Biological'
    ]
  } ,
  {
  	'title' : 'Management' ,
    'values' : [
        'Computer',
        'Business Maths',
        'Business Studies',
        'Economics',
        'Marketing ',
    'Travel and Mountaineering ',
    'Hotel Management '
    ]
  },
  {
  	'title' : 'Humanities' ,
   
  },
  {
  	'title' : 'Law' ,
    
  },  {
  	'title' : 'Science (All)' ,
    
  },
  {
  	'title' : 'Management (All)' ,
    
  },
 
];

var $faculty = $stream = false;

jQuery(function($){

	$faculty = $('#faculty');
  $stream = $('#stream');
  
	// Populate Select One
  $.each(selectableValues, function(k,v){
  	$faculty.append('<option value="'+k+'">'+v.title+'</option>');
  });

  $faculty.on('change',function(){
  	populateSelectTwo(this.value);
  });

});

function populateSelectTwo( parentKey ){
	$('option',$stream).remove();

  $.each(selectableValues[parentKey].values, function(k,v){
  	$stream.append('<option value="'+v+'">'+v+'</option>');
  });
}

</script>
<script>


</script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush