<?php
    $lastPage = round($events->total()/$qttPerPage);

    $firstNum = 1;
    if(request('page') > 2){
        if(request('page') > $lastPage-1){
            $firstNum = $lastPage-2;
        }else{
            $firstNum = request('page')-1;
        }
    }

    $lastNum = $firstNum+2;
    
    if(request('page') > $lastPage-2){
        $lastNum = $lastPage;
    }
?>

@if(request('page') && request('page') != 1)
    <a href="/{{request()->path()}}?page=1">&laquo;</a>
@endif
@if($firstNum > 1)
    @if($firstNum == 2)
    <a href="/{{request()->path()}}?page=1">1</a>
    @else
        <a href="/{{request()->path()}}?page={{$firstNum-2}}">...</a>
    @endif
@endif
@for($i = $firstNum; $i <= $lastPage && $i < $firstNum+3; $i++)
    <a href="/{{request()->path()}}?page={{$i}}" class="@if(request('page') == $i || (!request('page') && $i == 1)) active @endif">{{$i}}</a>
@endfor
@if($lastNum < $lastPage)
    @if($lastNum+1 == $lastPage)
        <a href="/{{request()->path()}}?page={{$lastNum+2}}">{{$lastPage}}</a>
    @else
        <a href="/{{request()->path()}}?page={{$lastNum+2}}">...</a>
    @endif
@endif
@if(request('page') != $lastPage)
    <a href="/{{request()->path()}}?page={{$lastPage}}">&raquo;</a>
@endif