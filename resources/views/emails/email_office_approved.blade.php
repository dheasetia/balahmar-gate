@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله،<br>
 السلام عليكم ورحمة الله وبركاته.<br>
 تفيدكم مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية بالموافقة على الجهة التي قمتم بتسجيلها لدينا، ويمكنكم الآن تقديم المشاريع الخاصة بجهتكم.

@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent