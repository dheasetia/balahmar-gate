@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله،

السلام عليكم ورحمة الله وبركاته.
<br><span>تفيدكم مؤسسة سالم أحمد بالحمر وعائلته الخيرية  بتأجيل النظر في مشروع: </span> <span><strong> {{$project->name}} </strong></span>.
@if($project->pending_reason != '')
<br><span>وذلك لأسباب: </span> {{$project->pending_reason}}.
@endif
<br><span>يمكنكم التواصل معنا عبر الرسائل الداخلية في البوابة.</span>
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
        الذهاب للبوابة
@endcomponent

دمتم في رعاية الله...<br>
    مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent