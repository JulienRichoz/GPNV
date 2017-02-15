@extends('layouts.app')

@section('content')
    <script type="text/javascript">
      function search(){
        alert(document.getElementsByName("search_input")[0].value);
      }
    </script>
    <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Test</div>
                  <div class="panel-body">
                    <input type="text" name="search_input" id="search_input" onKeyUp="search()">
                    <div id="users_list">
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
