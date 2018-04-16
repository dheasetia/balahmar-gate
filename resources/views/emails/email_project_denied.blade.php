@component('mail::message')
    # سعادة مدير  {{$user->office->name}} وفقه الله، <br>
 السلام عليكم ورحمة الله بركاته.<br>
 <span>تعتذر مؤسسة سالم أحمد بالحمر وعائلته الخيرية عن دعم مشروعكم: </span> <span><strong> {{$project->name}} </strong></span> {{$project->ban_reason != '' ? '، وذلك لأسباب: ' . $project->ban_reason . '.' : '.'}} <br>

@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent