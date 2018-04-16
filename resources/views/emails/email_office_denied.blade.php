@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله،
 السلام عليكم ورحمة الله وبركاته.<br>
    للتعميد والموافقة على جهتكم ترجو مؤسسة سالم أحمد بالحمر وعائلته الخيرية إكمال الملاحظات التالية: <br>
 <div class="strong" style="white-space: pre">{{$office->ban_reason}}</div>

@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent