<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('images/pursuit-tmr-1.jpg')}}" width="100%" class="logo" alt="Pursuit TMR">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
