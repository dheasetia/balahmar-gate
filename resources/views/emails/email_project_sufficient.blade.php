@component('mail::message')
 # سعادة مدير  {{$user->office->name}} وفقه الله،<br>
 السلام عليكم ورحمة الله وبركاته. <br>
<span>تفيدكم مؤسسة سالم احمد بالحمر وعائلته الخيرية بانه تم اختيار مشروع آخر وهو <span><strong> {{$other_project->name}} </strong></span>، للمساهمه فيه. وتعتذر عن دعم مشروع <span><strong>{{$project->name}}</strong></span>، ونلقاكم في مشاريع أخرى قادمة بمشيئة الله. </span>
@component('mail::button', ['url' => url('/'), 'color' => 'balahmar'])
الذهاب للبوابة
@endcomponent

  دمتم في رعاية الله...<br>
مع تحية مجلس الأمناء بمؤسسة سالم بن أحمد بالحمر وعائلته الخيرية.
@endcomponent