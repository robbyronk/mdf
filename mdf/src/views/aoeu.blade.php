<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
@if($toRender instanceof Illuminate\Database\Eloquent\Collection)
<p>This is a collection.</p>
@each('aoeu', $toRender, 'toRender')
@elseif($toRender instanceof Illuminate\Database\Eloquent\Model)
<p>This is a model.</p>
@foreach($toRender->getAttributes() as $k => $v)
<p>{{{ $k }}} => {{{ $v }}}</p>
@endforeach
@else
<p>This is neither a collection or a model.</p>
@endif
</body>
</html>