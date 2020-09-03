
<?php  
    
$route_name = null;
$name = null;
$home = $route[0];
if(isset($route[1])){
    $name = $route[1];
}
if($name == 'index'){
    $route_name = ucfirst($route[0]). ' List';
    $home = $route[0].'.index';
}
if($name == 'create'){
    $route_name = ucfirst($route[0]). ' Create';
    $home = $route[0].'.index';
}

if($name == 'edit'){
    $route_name = ucfirst($route[0]). ' Edit';
    $home = $route[0].'.index';
}
?>


<div class="row breadcrumbs-top">
<div class="col-12">
  <h5 class="content-header-title float-left pr-1 mb-0">{{ucfirst(str_replace('-', ' ', $route[0]))}}</h5>
  <div class="breadcrumb-wrapper col-12">
    <ol class="breadcrumb p-0 mb-0">
      <li class="breadcrumb-item"><a href="{{route('store.index')}}"><i class="bx bx-home-alt"></i></a>
      </li>
    <li class="breadcrumb-item"><a href="{{ route($home) }}">{{ucfirst($route[0])}}</a>
      </li>
      <li class="breadcrumb-item active">{{$route_name}}
      </li>
    </ol>
  </div>
</div>
</div>