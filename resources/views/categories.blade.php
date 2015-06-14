@extends('app')

@section('content')
        <div class="container">
            <h3>Извлечь все книги из категории ...</h3>
            <div class="content">
                <div id="form">
                <form  method="POST">
                    <select name="categories">
             @foreach($categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
            @endforeach
                     </select>
                    <br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <br />
                    <p> <input type="submit" value="Отобразить книги" /></p> 
                </form>
                
                </div>
                <div id="books">
                    @if(isset($books)) 
                    @foreach($books as $book)
                    <b>{{$book['name']}} ,</b> 
                    @endforeach
                     @endif
                </div>
            </div>
            <hr />
            <hr />
            
            
            <h3>Извлечь все книги из категории ...</h3>
            <div id="builder"></div>
<button id="btn-get-sql" class="btn btn-primary parse-sql" data-stmt="false" data-target="import_export" >Отобразить книги</button>
<script>
$('#builder').queryBuilder({
  filters: [
{
    id: 'categories_id',
    label: 'Category',
    type: 'integer',
    input: 'select',
    values: {
     @foreach($categories as $category)
      {{$category['id']}}: '{{$category['name']}}',
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
      $(".builder_result").append("<p>Название: <b>"+res[key]['name']+"</b> Описание: <b>"+res[key]['description']+"</b></p>");
  }
  }



 $('#btn-get-sql').on('click', function() {
  var result = $('#builder').queryBuilder('getSQL', false, false);
  
  var data = result.sql;
  
   $.ajax({
         headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
        url: 'Categories_bilder',
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
            
            
  </div>
 
  
 
@endsection