@extends('app')

@section('content')
        <div class="container">
            <div class="content">
                <div id="form">
                <form  method="POST">
                    <select name="authors">
             @foreach($authors as $author)
                <option value="{{$author['id']}}">{{$author['first_name']}} {{$author['last_name']}}</option>
            @endforeach
                     </select>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Отобразить книги" />
                </form>
                
                </div>
                <div id="books">
                    @if(isset($books)) 
                    @foreach($books as $book)
                     {{$book['name']}}
                    @endforeach
                    
                    
                    @endif
                </div>
            </div>
            
                <h3>Извлечь все книги выбранного Аавтора ...</h3>
            <div id="builder"></div>
<button id="btn-get-sql" class="btn btn-primary parse-sql" data-stmt="false" data-target="import_export" >Отобразить книги</button>
<script>
$('#builder').queryBuilder({
  filters: [
{
   id: 'authors_id',
    label: 'Authors',
    type: 'integer',
    input: 'select',
    values: {
     @foreach($authors as $author)
      {{$author['id']}}: '{{$author['first_name']}} {{$author['last_name']}}',
     @endforeach 
     },
    operators: ['equal']
  }
]
});





$('#btn-get-sql').on('click', function () {
var result = $('#builder').queryBuilder('getSQL', false, false);

var data = result.sql;
$.ajax({
headers: {
'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
},
url: 'authors',
type: "POST",
data: ({
sql: data
}),
dataType: "html"
}).success(function(data){
var res = JSON.parse(data);

var builderRes = $(".builder_result");

builderRes.empty();

for (var key in res) {
builderRes.append("<p>Название: <b>" + res[key]['name'] + "</b> Описание: <b>" + res[key]['description'] + "</b></p>");
}
}).error(function(){
alert("failure");
});
});
</script>
            
            
        </div>



@endsection