@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله،

نفيدكم علما بأنه تم رفض الجهة: {{$office->name}}، وذلك لأسباب: <br>
 {{$office->ban_reason}} <br>
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بالحمر الخيرية.
@endcomponent