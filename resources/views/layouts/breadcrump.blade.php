
<?php  

$route_name = null;
$name = null;
$home = null;

if(isset($route[1])){
 
  $second = $route[1];
  if ( $second === 'index' || $second === 'edit' || $second === 'show' || $second === 'create') {
    
    $name = $route[1];
    $home = route($route[0].'.index');
    if($name === 'index'){
        $route_name = ucfirst($route[0]). ' List';
    } else{
      $route_name = ucfirst($route[0]).' '. ucfirst($name);
  }
}
}
// $main_route = collect(request()->segments())->last()
?>


<div class="row breadcrumbs-top">
<div class="col-12">
  <h5 class="content-header-title float-left pr-1 mb-0">{{ucfirst(str_replace('-', ' ', $route[0]))}}</h5>
  <div class="breadcrumb-wrapper col-12">
    <ol class="breadcrumb p-0 mb-0">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
      </li>
    <li class="breadcrumb-item"><a href="{{ $home }}">{{ucfirst($route[0])}}</a>
      </li>
      <li class="breadcrumb-item active">{{$route_name}}
      </li>
    </ol>
  </div>
</div>
</div>