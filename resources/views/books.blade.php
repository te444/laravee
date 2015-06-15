@extends('app')

@section('content')
        <div class="container">
            <div class="content">
                <div id="form">
                <form  method="POST">
                    <select name="books">
             @foreach($books as $book)
                <option value="{{$book['id']}}">{{$book['name']}}</option>
            @endforeach
                     </select>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Отобразить авторов и категории" />
                </form>
                
                </div>
                <div id="books">
                    @if(isset($categories)) 
                    @foreach($categories as $categorie)
                     Категория: {{$categorie['name']}}<br/>
                    @endforeach
                    @endif
                    
                     @if(isset($authors)) 
                    @foreach($authors as $author)
                    Автор:  {{$author['first_name']}}{{$author['last_name']}}
                    @endforeach
                    @endif
                </div>
            </div>
             <hr />
            <hr />
            
            
            
              <h3>Извлечь всех авторов и категории по выбранной книге ...</h3>
            <div id="builder"></div>
<button id="btn-get-sql" class="btn btn-primary parse-sql" data-stmt="false" data-target="import_export" >Отобразить книги</button>
<script>
    
$('#builder').queryBuilder({
  filters: [
{
    id: 'books_id',
    label: 'Book',
    type: 'integer',
    input: 'select',
    values: {
     @foreach($books as $book)
      {{$book['id']}}: '{{$book['name']}}',
     @endforeach 
     },
    operators: ['equal']
  }
]
});








function funcok(data){
   
 var res = JSON.parse(data);
 $(".builder_result").html("");
 
  for(var key in res){
      if(res[key]['name'])
      $(".builder_result").append("<p>Категория: <b>"+res[key]['name']+"</b>");
  }
   for(var key in res){
       if(res[key]['last_name'])
   $(".builder_result").append("Автор: <b>"+res[key]['last_name']+"</b></p>");
  }
  }

 $('#btn-get-sql').on('click', function() {
  var result = $('#builder').queryBuilder('getSQL', false, false);
  
  var data = result.sql;
  
   $.ajax({
         headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
        url: 'books',
        type: "POST",
        data: ({
                    sql: data
             }),
        dataType: "html",
        success: funcok,
         error:function(){
            alert("failure");
        }
       
    });
});    
</script>
 

@endsection