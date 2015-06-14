<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="csrf-token" id="csrf-token" content="{{{ csrf_token() }}}">
<title>{{$title}}</title>

@foreach ($styles as $style)
<link href='{{asset($style)}}' rel='stylesheet' />
@endforeach
@foreach ($scripts as $script)
<script src='{{asset($script)}}' ></script>
@endforeach
</head>
<body>
@yield('content')

<div class="builder_result">
    
  </div>  

</body>
</html>