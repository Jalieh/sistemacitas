@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

               
              <div class="bienvenido">
              	<h1 class="wilkomen">Welcome!</h1><br><h3>It's good to see you around.<br>What can we help you with?</h3>
              </div>
<div class="circles" style="display: inline-flex; align-items: center;">
              <a href="/citations/">
	              <div class="circleone" style="margin:50px; background:#C6C6C6; height: 150px; width: 150px; border-radius:50%; position: relative; overflow: hidden; " style="content:''; display: block; padding-top: 100%;">
	              	<div class="circleone-content" style="position:  absolute; top: 0; left: 0; bottom: 0; right: 0;"><div style="  display:table;width: 100%;height: 100%;"><span style="display: table-cell;text-align: center;vertical-align: middle; text-transform: capitalize; font-weight: bold;">CITATIONS<span></div></div>
	              </div>
              </a>
              
              <a>
	              <div class="circleone" style="margin:50px; background: #C6C6C6; height: 150px; width: 150px; border-radius:50%; position: relative; overflow: hidden; " style="content:''; display: block; padding-top: 100%;">
	              	<div class="circleone-content" style="position:  absolute; top: 0; left: 0; bottom: 0; right: 0;"><div style="  display:table;width: 100%;height: 100%;"><span style="display: table-cell;text-align: center;vertical-align: middle; text-transform: capitalize; font-weight: bold;">RECORD<span></div></div>
	              </div>
              </a>

              <a>
	              <div class="circleone" style="margin:50px; background: #C6C6C6; height: 150px; width: 150px; border-radius:50%; position: relative; overflow: hidden; " style="content:''; display: block; padding-top: 100%;">
	              	<div class="circleone-content" style="position:  absolute; top: 0; left: 0; bottom: 0; right: 0;"><div style="  display:table;width: 100%;height: 100%;"><span style="display: table-cell;text-align: center;vertical-align: middle; text-transform: capitalize; font-weight: bold;">RECIPES</span></div></div>
	              </div>
              </a>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
