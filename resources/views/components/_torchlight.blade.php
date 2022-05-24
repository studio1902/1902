@switch($mode)
    @case('handlebars')
        @php $language = 'antlers' @endphp
        @break
    @case('htmlmixed')
        @php $language = 'html' @endphp
        @break
    @default
        @php $language = $mode @endphp
@endswitch
<pre><x-torchlight-code :language="$language">{!! $code !!}</x-torchlight-code></pre>
